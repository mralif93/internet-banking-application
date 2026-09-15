<?php

namespace App\Services;

use App\Models\Customer;
use Carbon\Carbon;
use Exception;

class QrPayService
{
    public function __construct(
        protected LedgerService $ledgerService,
        protected TransactionLimitService $limitService
    ) {}

    /**
     * Execute DuitNow QR payment.
     */
    public function payQr(Customer $customer, array $data): array
    {
        $amount = (float) $data['amount'];
        $merchantName = $data['merchant_name'] ?? 'DuitNow QR Merchant';
        $merchantRef = $data['merchant_ref'] ?? 'QR-PAY-' . date('His');

        // Check Limit
        if (!$this->limitService->checkLimit($customer, 'qr_pay', $amount)) {
            $limit = $this->limitService->getOrCreateLimit($customer, 'qr_pay');
            $remaining = max(0, $limit->daily_limit - $limit->spent_today);
            throw new Exception("Payment exceeds your daily DuitNow QR limit. Remaining: RM " . number_format($remaining, 2));
        }

        $sourceAccount = $customer->accounts()->where('status', 'active')->firstOrFail();
        $reference = LedgerService::generateReference('RPP');

        $txn = $this->ledgerService->debit($sourceAccount, $amount, 'qr_pay', [
            'reference_number' => $reference,
            'recipient_name' => $merchantName,
            'payment_reference' => 'DuitNow QR Payment',
            'recipient_reference' => $merchantRef,
            'description' => "DuitNow QR - {$merchantName}",
            'metadata' => [
                'merchant_ref' => $merchantRef,
                'ip_address' => request()->ip(),
            ],
        ]);

        $this->limitService->consumeLimit($customer, 'qr_pay', $amount);

        return [
            'success' => true,
            'reference' => $reference,
            'merchant_name' => $merchantName,
            'amount' => $amount,
            'date' => Carbon::now()->format('d M Y, h:i A'),
            'balance_after' => $txn->balance_after,
        ];
    }
}
