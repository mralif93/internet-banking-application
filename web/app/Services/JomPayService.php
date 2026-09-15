<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\JompayBiller;
use Carbon\Carbon;
use Exception;

class JomPayService
{
    public function __construct(
        protected LedgerService $ledgerService,
        protected TransactionLimitService $limitService,
        protected ?SystemParameterService $parameterService = null
    ) {
        $this->parameterService = $parameterService ?? app(SystemParameterService::class);
    }

    /**
     * Validate a JomPAY biller code.
     */
    public function validateBiller(string $billerCode): ?JompayBiller
    {
        return JompayBiller::where('biller_code', trim($billerCode))->where('is_active', true)->first();
    }

    /**
     * Execute a JomPAY bill payment.
     */
    public function payBill(Customer $customer, array $data): array
    {
        if (!$this->parameterService->isJompayRailActive()) {
            throw new Exception("JomPAY Settlement Gateway is temporarily offline for maintenance.");
        }

        $amount = (float) $data['amount'];
        $billerCode = trim($data['biller_code']);
        $ref1 = trim($data['ref_1']);
        $ref2 = isset($data['ref_2']) ? trim($data['ref_2']) : null;

        $biller = $this->validateBiller($billerCode);
        if (!$biller) {
            throw new Exception("Invalid or inactive JomPAY Biller Code ({$billerCode}). Please verify with your bill invoice.");
        }

        if ($biller->is_ref_2_required && empty($ref2)) {
            throw new Exception("Ref-2 ({$biller->ref_2_label}) is mandatory for this biller.");
        }

        // Limit validation
        if (!$this->limitService->checkLimit($customer, 'jompay', $amount)) {
            $limit = $this->limitService->getOrCreateLimit($customer, 'jompay');
            $remaining = max(0, $limit->daily_limit - $limit->spent_today);
            throw new Exception("Bill payment exceeds your daily JomPAY limit. Remaining: RM " . number_format($remaining, 2));
        }

        $sourceAccount = $customer->accounts()->where('status', 'active')->firstOrFail();
        $reference = LedgerService::generateReference('JOM');

        $txn = $this->ledgerService->debit($sourceAccount, $amount, 'jompay', [
            'reference_number' => $reference,
            'recipient_name' => $biller->biller_name,
            'biller_code' => $biller->biller_code,
            'biller_name' => $biller->biller_name,
            'ref_1' => $ref1,
            'ref_2' => $ref2,
            'payment_reference' => "JomPAY {$biller->biller_code} - {$ref1}",
            'description' => "JomPAY Bill Payment: {$biller->biller_name}",
            'metadata' => [
                'biller_category' => $biller->category,
                'ref_1_label' => $biller->ref_1_label,
                'ip_address' => request()->ip(),
            ],
        ]);

        $this->limitService->consumeLimit($customer, 'jompay', $amount);

        return [
            'success' => true,
            'reference' => $reference,
            'biller_code' => $biller->biller_code,
            'biller_name' => $biller->biller_name,
            'ref_1' => $ref1,
            'ref_2' => $ref2,
            'amount' => $amount,
            'date' => Carbon::now()->format('d M Y, h:i A'),
            'balance_after' => $txn->balance_after,
        ];
    }
}
