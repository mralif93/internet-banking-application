<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\AuditLog;
use App\Models\Customer;
use App\Models\Account;
use App\Services\SystemParameterService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected SystemParameterService $parameterService
    ) {}

    public function index()
    {
        // Telemetry metrics
        $flaggedCount = Transaction::where('amount', '>=', 10000)->count();
        $frozenAccountsCount = Account::where('status', 'frozen')->count();
        $recentAuditLogs = AuditLog::latest()->take(5)->get();
        $systemParameters = $this->parameterService->getAllGrouped();

        // High value / suspicious transactions
        $flaggedTransactions = Transaction::with(['account.customer'])
            ->where('amount', '>=', 5000)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'flaggedCount',
            'frozenAccountsCount',
            'recentAuditLogs',
            'systemParameters',
            'flaggedTransactions'
        ));
    }
}
