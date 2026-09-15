<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Exception;

class LedgerService
{
    /**
     * Generate unique reference number.
     */
    public static function generateReference(string $prefix = 'TRX'): string
    {
        return sprintf('%s-%s-%s', $prefix, date('Ymd'), strtoupper(substr(bin2hex(random_bytes(4)), 0, 8)));
    }

    /**
     * Execute an atomic debit from an account.
     *
     * @param Account $account
     * @param float $amount
     * @param string $type
     * @param array $details
     * @return Transaction
     * @throws Exception
     */
    public function debit(Account $account, float $amount, string $type, array $details = []): Transaction
    {
        if ($amount <= 0) {
            throw new Exception('Debit amount must be greater than zero.');
        }

        return DB::transaction(function () use ($account, $amount, $type, $details) {
            // Pessimistic lock on source account
            /** @var Account $lockedAccount */
            $lockedAccount = Account::where('id', $account->id)->lockForUpdate()->firstOrFail();

            if ($lockedAccount->status !== 'active') {
                throw new Exception('Account is not active. Status: ' . $lockedAccount->status);
            }

            if ($lockedAccount->available_balance < $amount) {
                throw new Exception('Insufficient account balance. Available: RM ' . number_format($lockedAccount->available_balance, 2));
            }

            $lockedAccount->balance -= $amount;
            $lockedAccount->available_balance -= $amount;
            $lockedAccount->save();

            // Sync customer account_balance column for backward compatibility
            if ($lockedAccount->customer) {
                $lockedAccount->customer->account_balance = $lockedAccount->balance;
                $lockedAccount->customer->save();
            }

            $ref = $details['reference_number'] ?? self::generateReference('RPP');

            return Transaction::create([
                'reference_number' => $ref,
                'account_id' => $lockedAccount->id,
                'transaction_type' => $type,
                'direction' => 'debit',
                'amount' => $amount,
                'fee' => $details['fee'] ?? 0.00,
                'recipient_name' => $details['recipient_name'] ?? null,
                'recipient_bank' => $details['recipient_bank'] ?? null,
                'recipient_account' => $details['recipient_account'] ?? null,
                'payment_reference' => $details['payment_reference'] ?? null,
                'recipient_reference' => $details['recipient_reference'] ?? null,
                'biller_code' => $details['biller_code'] ?? null,
                'biller_name' => $details['biller_name'] ?? null,
                'ref_1' => $details['ref_1'] ?? null,
                'ref_2' => $details['ref_2'] ?? null,
                'status' => $details['status'] ?? 'completed',
                'cooling_off_until' => $details['cooling_off_until'] ?? null,
                'balance_after' => $lockedAccount->balance,
                'description' => $details['description'] ?? "Payment / Debit of RM {$amount}",
                'metadata' => $details['metadata'] ?? null,
            ]);
        });
    }

    /**
     * Execute an atomic credit to an account.
     */
    public function credit(Account $account, float $amount, string $type, array $details = []): Transaction
    {
        if ($amount <= 0) {
            throw new Exception('Credit amount must be greater than zero.');
        }

        return DB::transaction(function () use ($account, $amount, $type, $details) {
            /** @var Account $lockedAccount */
            $lockedAccount = Account::where('id', $account->id)->lockForUpdate()->firstOrFail();

            $lockedAccount->balance += $amount;
            $lockedAccount->available_balance += $amount;
            $lockedAccount->save();

            if ($lockedAccount->customer) {
                $lockedAccount->customer->account_balance = $lockedAccount->balance;
                $lockedAccount->customer->save();
            }

            $ref = $details['reference_number'] ?? self::generateReference('CRD');

            return Transaction::create([
                'reference_number' => $ref,
                'account_id' => $lockedAccount->id,
                'transaction_type' => $type,
                'direction' => 'credit',
                'amount' => $amount,
                'fee' => 0.00,
                'recipient_name' => $details['sender_name'] ?? 'Incoming Transfer',
                'recipient_bank' => $details['sender_bank'] ?? 'BankFlow MY',
                'recipient_account' => $details['sender_account'] ?? null,
                'payment_reference' => $details['payment_reference'] ?? null,
                'recipient_reference' => $details['recipient_reference'] ?? null,
                'status' => 'completed',
                'balance_after' => $lockedAccount->balance,
                'description' => $details['description'] ?? "Credit transfer of RM {$amount}",
                'metadata' => $details['metadata'] ?? null,
            ]);
        });
    }
}
