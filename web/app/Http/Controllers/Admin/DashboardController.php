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
        $activeCustomersCount = Customer::where('status', 'active')->count();
        $totalCustomersCount = Customer::count();
        $totalTransactionCount = Transaction::count();
        $todayVolume = Transaction::whereDate('created_at', today())->sum('amount');
        $allVolume = Transaction::sum('amount');
        
        $recentAuditLogs = AuditLog::latest()->take(6)->get();
        $systemParameters = $this->parameterService->getAllGrouped();

        // High value / suspicious transactions
        $flaggedTransactions = Transaction::with(['account.customer'])
            ->where('amount', '>=', 5000)
            ->latest()
            ->take(10)
            ->get();

        // Live recent transaction stream (all types)
        $recentTransactions = Transaction::with(['account.customer'])
            ->latest()
            ->take(8)
            ->get();

        // Payment Rail Clearing telemetry
        $paymentRails = [
            [
                'name' => 'PayNet DuitNow Instant (RPP)',
                'code' => 'DUITNOW_RPP',
                'status' => 'operational',
                'latency' => '42ms',
                'iso_version' => 'ISO 20022 camt.053',
                'active_threads' => 14,
                'circuit_breaker' => 'ARMED',
            ],
            [
                'name' => 'PayNet DuitNow QR (Merchant Clearing)',
                'code' => 'DUITNOW_QR',
                'status' => 'operational',
                'latency' => '58ms',
                'iso_version' => 'EMVCo / PayNet 2.1',
                'active_threads' => 28,
                'circuit_breaker' => 'ARMED',
            ],
            [
                'name' => 'PayNet JomPAY Bill Settlement Hub',
                'code' => 'JOMPAY_RTGS',
                'status' => 'operational',
                'latency' => '115ms',
                'iso_version' => 'ISO 8583 / Host-to-Host',
                'active_threads' => 6,
                'circuit_breaker' => 'ARMED',
            ],
            [
                'name' => 'Interbank GIRO (IBG Batch Clearing)',
                'code' => 'IBG_BATCH',
                'status' => 'standby',
                'latency' => 'Batch (11:00 AM)',
                'iso_version' => 'Standard IBG 1.0',
                'active_threads' => 2,
                'circuit_breaker' => 'ARMED',
            ],
        ];

        return view('admin.dashboard', compact(
            'flaggedCount',
            'frozenAccountsCount',
            'activeCustomersCount',
            'totalCustomersCount',
            'totalTransactionCount',
            'todayVolume',
            'allVolume',
            'recentAuditLogs',
            'systemParameters',
            'flaggedTransactions',
            'recentTransactions',
            'paymentRails'
        ));
    }
}
