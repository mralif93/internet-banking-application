<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Account;
use Carbon\Carbon;

class StatementService
{
    /**
     * Compile statement summary and transaction list for a given month/year.
     */
    public function getMonthlyStatement(Account $account, int $year, int $month): array
    {
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // Fetch transactions for this month
        $transactions = $account->transactions()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed')
            ->orderBy('created_at', 'asc')
            ->get();

        $totalDebits = $transactions->where('direction', 'debit')->sum('amount');
        $totalCredits = $transactions->where('direction', 'credit')->sum('amount');

        // Estimate opening balance
        $firstTxn = $transactions->first();
        if ($firstTxn) {
            $openingBalance = $firstTxn->direction === 'debit'
                ? $firstTxn->balance_after + $firstTxn->amount
                : $firstTxn->balance_after - $firstTxn->amount;
        } else {
            $openingBalance = $account->balance;
        }

        $closingBalance = $openingBalance + $totalCredits - $totalDebits;

        return [
            'account' => $account,
            'year' => $year,
            'month' => $month,
            'month_name' => $startDate->format('F Y'),
            'opening_balance' => $openingBalance,
            'closing_balance' => $closingBalance,
            'total_debits' => $totalDebits,
            'total_credits' => $totalCredits,
            'transactions' => $transactions,
            'total_count' => $transactions->count(),
        ];
    }
}
