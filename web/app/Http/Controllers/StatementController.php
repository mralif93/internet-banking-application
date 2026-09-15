<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Account;
use App\Services\StatementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StatementController extends Controller
{
    public function __construct(
        protected StatementService $statementService
    ) {}

    public function show(Request $request)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();

        $year = (int) $request->query('year', date('Y'));
        $month = (int) $request->query('month', date('n'));

        $statement = $this->statementService->getMonthlyStatement($account, $year, $month);

        return view('customer.statement', compact('customer', 'account', 'statement', 'year', 'month'));
    }

    public function export(Request $request)
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $account = $customer->accounts()->where('status', 'active')->first();

        $year = (int) $request->query('year', date('Y'));
        $month = (int) $request->query('month', date('n'));
        $format = $request->query('format', 'csv');

        $statement = $this->statementService->getMonthlyStatement($account, $year, $month);

        if ($format === 'csv') {
            $filename = sprintf('BankFlow_Statement_%s_%d_%02d.csv', $account ? $account->account_number : 'account', $year, $month);
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0',
            ];

            $callback = function () use ($customer, $account, $statement, $year, $month) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['BANKFLOW MALAYSIA BERHAD - OFFICIAL DIGITAL E-STATEMENT']);
                fputcsv($file, ['Customer Name', $customer->name]);
                fputcsv($file, ['Account Number', $account->account_number ?? 'N/A']);
                fputcsv($file, ['Account Type', $account->account_type ?? 'Savings']);
                fputcsv($file, ['Statement Period', sprintf('%s %d', Carbon::createFromDate($year, $month, 1)->format('F'), $year)]);
                fputcsv($file, ['PIDM Protection', 'Protected up to RM 250,000 per depositor']);
                fputcsv($file, ['Opening Balance (MYR)', number_format($statement['opening_balance'] ?? 0, 2)]);
                fputcsv($file, ['Total Credits (MYR)', number_format($statement['total_credits'] ?? 0, 2)]);
                fputcsv($file, ['Total Debits (MYR)', number_format($statement['total_debits'] ?? 0, 2)]);
                fputcsv($file, ['Closing Balance (MYR)', number_format($statement['closing_balance'] ?? 0, 2)]);
                fputcsv($file, []);
                fputcsv($file, ['Date', 'Reference No', 'Transaction Type', 'Description', 'Direction', 'Amount (MYR)', 'Balance After (MYR)', 'Status']);

                if (isset($statement['transactions'])) {
                    foreach ($statement['transactions'] as $tx) {
                        fputcsv($file, [
                            $tx->created_at ? $tx->created_at->format('Y-m-d H:i:s') : '',
                            $tx->reference_number,
                            $tx->transaction_type,
                            $tx->recipient_name ?? $tx->description,
                            strtoupper($tx->direction),
                            number_format($tx->amount, 2),
                            number_format($tx->balance_after, 2),
                            strtoupper($tx->status),
                        ]);
                    }
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // Return print / certification view for PDF printing
        return view('customer.statement-print', compact('customer', 'account', 'statement', 'year', 'month'));
    }
}
