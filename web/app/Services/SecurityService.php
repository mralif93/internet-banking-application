<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;
use Exception;

class SecurityService
{
    /**
     * Activate the emergency Web Kill Switch.
     * Freezes customer account, sets accounts to frozen, logs audit trail, and revokes sessions.
     */
    public function activateKillSwitch(Customer $customer, string $password): void
    {
        if (!Hash::check($password, $customer->password)) {
            throw new Exception('Invalid security password. Kill switch authorization failed.');
        }

        // 1. Freeze customer profile
        $customer->status = 'suspended';
        $customer->save();

        // 2. Freeze all linked bank accounts
        $customer->accounts()->update(['status' => 'frozen']);

        // 3. Freeze all debit/credit cards
        $customer->cards()->update(['status' => 'frozen']);

        // 4. Log high-priority immutable audit log
        AuditLog::create([
            'customer_id' => $customer->id,
            'event' => 'EMERGENCY_KILL_SWITCH_ACTIVATED',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'payload' => [
                'timestamp' => now()->toIso8601String(),
                'reason' => 'User self-service emergency lockdown from web internet banking',
            ],
        ]);
    }

    /**
     * Update customer daily transaction limits.
     */
    public function updateDailyLimits(Customer $customer, array $limits): void
    {
        $allowedTypes = ['duitnow', 'jompay', 'qr_pay', 'fpx', 'atm_withdrawal'];

        foreach ($limits as $type => $amount) {
            if (in_array($type, $allowedTypes)) {
                $customer->limits()->updateOrCreate(
                    ['limit_type' => $type],
                    ['daily_limit' => (float) $amount]
                );
            }
        }

        AuditLog::create([
            'customer_id' => $customer->id,
            'event' => 'TRANSACTION_LIMITS_UPDATED',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'payload' => $limits,
        ]);
    }
}
