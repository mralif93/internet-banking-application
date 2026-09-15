<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Account;
use App\Models\Beneficiary;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class TransferService
{
    public function __construct(
        protected LedgerService $ledgerService,
        protected TransactionLimitService $limitService,
        protected ?SystemParameterService $parameterService = null
    ) {
        $this->parameterService = $parameterService ?? app(SystemParameterService::class);
    }

    /**
     * Execute a DuitNow or Interbank funds transfer.
     */
    public function executeTransfer(Customer $sender, array $data): array
    {
        // 0. Verify DuitNow Rail Circuit Breaker
        if (!$this->parameterService->isDuitNowRailActive()) {
            throw new Exception("PayNet DuitNow Clearing Rail is temporarily suspended by BankFlow Network Operations.");
        }

        $amount = (float) $data['amount'];
        $sourceAccountId = $data['source_account_id'] ?? null;

        // 1. Resolve source account
        $sourceAccount = $sourceAccountId
            ? $sender->accounts()->where('id', $sourceAccountId)->firstOrFail()
            : $sender->accounts()->where('status', 'active')->firstOrFail();

        // 2. Validate Daily Limit
        if (!$this->limitService->checkLimit($sender, 'duitnow', $amount)) {
            $limit = $this->limitService->getOrCreateLimit($sender, 'duitnow');
            $remaining = max(0, $limit->daily_limit - $limit->spent_today);
            throw new Exception("Transfer exceeds your daily DuitNow limit. Remaining limit: RM " . number_format($remaining, 2));
        }

        // 3. Check BNM Cooling-off requirement dynamically from System Parameters
        $coolingThreshold = $this->parameterService->getCoolingOffThreshold();
        $coolingHours = $this->parameterService->getCoolingOffHours();
        $isHighRisk = ($amount >= $coolingThreshold && empty($data['is_trusted_payee']));
        $status = $isHighRisk ? 'cooling_off' : 'completed';
        $coolingOffUntil = $isHighRisk ? Carbon::now()->addHours($coolingHours) : null;

        $reference = LedgerService::generateReference('DN');

        return DB::transaction(function () use ($sender, $sourceAccount, $amount, $data, $reference, $status, $coolingOffUntil) {
            // Debit sender
            $debitTxn = $this->ledgerService->debit($sourceAccount, $amount, 'duitnow_transfer', [
                'reference_number' => $reference,
                'recipient_name' => $data['recipient_name'],
                'recipient_bank' => $data['recipient_bank'] ?? 'PayNet Interbank',
                'recipient_account' => $data['recipient_account'] ?? null,
                'payment_reference' => $data['payment_reference'] ?? 'DuitNow Transfer',
                'recipient_reference' => $data['recipient_reference'] ?? null,
                'status' => $status,
                'cooling_off_until' => $coolingOffUntil,
                'description' => "DuitNow Transfer to {$data['recipient_name']} ({$data['recipient_bank']})",
                'metadata' => [
                    'duitnow_id_type' => $data['duitnow_id_type'] ?? null,
                    'duitnow_id_value' => $data['duitnow_id_value'] ?? null,
                    'ip_address' => request()->ip(),
                ],
            ]);

            // Deduct limit
            $this->limitService->consumeLimit($sender, 'duitnow', $amount);

            // If destination is internal BankFlow account and status is completed, credit recipient
            if (($data['recipient_bank'] ?? '') === 'BankFlow MY' && !empty($data['recipient_account'])) {
                $recipientAcc = Account::where('account_number', $data['recipient_account'])->first();
                if ($recipientAcc && $status === 'completed') {
                    $this->ledgerService->credit($recipientAcc, $amount, 'duitnow_transfer', [
                        'reference_number' => 'CRD-' . substr($reference, 3),
                        'sender_name' => $sender->name,
                        'sender_bank' => 'BankFlow MY',
                        'sender_account' => $sourceAccount->account_number,
                        'payment_reference' => $data['payment_reference'] ?? null,
                        'recipient_reference' => $data['recipient_reference'] ?? null,
                        'description' => "DuitNow Inward from {$sender->name}",
                    ]);
                }
            }

            // Save beneficiary if requested
            if (!empty($data['save_payee'])) {
                Beneficiary::updateOrCreate(
                    [
                        'customer_id' => $sender->id,
                        'account_number' => $data['recipient_account'] ?? null,
                    ],
                    [
                        'nickname' => $data['recipient_name'],
                        'bank_name' => $data['recipient_bank'] ?? 'Interbank',
                        'is_favorite' => false,
                        'last_transferred_at' => Carbon::now(),
                    ]
                );
            }

            return [
                'success' => true,
                'status' => $status,
                'cooling_off_until' => $coolingOffUntil ? $coolingOffUntil->format('d M Y, h:i A') : null,
                'reference' => $reference,
                'amount' => $amount,
                'recipient_name' => $data['recipient_name'],
                'recipient_bank' => $data['recipient_bank'] ?? 'PayNet Interbank',
                'recipient_account' => $data['recipient_account'] ?? '',
                'date' => Carbon::now()->format('d M Y, h:i A'),
                'balance_after' => $debitTxn->balance_after,
            ];
        });
    }
}
