<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\TransactionLimit;
use Carbon\Carbon;
use Exception;

class TransactionLimitService
{
    /**
     * Verify if customer has enough daily limit for a transaction type.
     */
    public function checkLimit(Customer $customer, string $limitType, float $amount): bool
    {
        $limit = $this->getOrCreateLimit($customer, $limitType);

        // Reset if date is old
        if (!$limit->last_reset_date || Carbon::parse($limit->last_reset_date)->isBefore(Carbon::today())) {
            $limit->spent_today = 0.00;
            $limit->last_reset_date = Carbon::today();
            $limit->save();
        }

        return ($limit->spent_today + $amount) <= $limit->daily_limit;
    }

    /**
     * Deduct from the daily limit after a successful transaction.
     */
    public function consumeLimit(Customer $customer, string $limitType, float $amount): void
    {
        $limit = $this->getOrCreateLimit($customer, $limitType);

        if (!$limit->last_reset_date || Carbon::parse($limit->last_reset_date)->isBefore(Carbon::today())) {
            $limit->spent_today = 0.00;
            $limit->last_reset_date = Carbon::today();
        }

        $limit->spent_today += $amount;
        $limit->save();
    }

    /**
     * Get or create a limit record for the given type.
     */
    public function getOrCreateLimit(Customer $customer, string $limitType): TransactionLimit
    {
        $defaultLimits = [
            'duitnow' => 10000.00,
            'jompay' => 5000.00,
            'qr_pay' => 2000.00,
            'fpx' => 10000.00,
            'atm_withdrawal' => 5000.00,
        ];

        return TransactionLimit::firstOrCreate(
            [
                'customer_id' => $customer->id,
                'limit_type' => $limitType,
            ],
            [
                'daily_limit' => $defaultLimits[$limitType] ?? 5000.00,
                'spent_today' => 0.00,
                'last_reset_date' => Carbon::today(),
            ]
        );
    }
}
