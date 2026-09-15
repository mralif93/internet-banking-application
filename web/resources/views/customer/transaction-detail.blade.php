@php
$customer = Auth::guard('customer')->user() ?? (object)[
    'name' => 'Ahmad Daniel Bin Alif',
    'username' => 'daniel_alif',
    'account_number' => '1640 1234 5678',
    'account_balance' => 24850.50,
    'account_type' => 'Savings Account-i',
    'bound_device_name' => 'iPhone 16 Pro',
    'phone_number' => '+60 12-345 6789',
];

// Sample transaction dataset matching dashboard records
$transactions = [
    'RPP-20260909-082104' => [
        'id' => 'RPP-20260909-082104',
        'title' => 'PETRONAS Dagangan Berhad',
        'type' => 'qr',
        'type_label' => 'DuitNow QR',
        'category' => 'Fuel & Retail Payment',
        'amount' => 85.00,
        'is_credit' => false,
        'status' => 'completed',
        'status_label' => 'Completed',
        'timestamp' => '10 Sep 2026, 1:15 PM',
        'recipient_name' => 'PETRONAS DAGANGAN BHD (STATION 1042)',
        'recipient_account' => 'DuitNow QR Merchant ID: 93200192834',
        'sender_account' => 'Savings Account-i (1640 •••• 5678)',
        'bank_name' => 'BankFlow Malaysia Berhad',
        'clearing_channel' => 'PayNet Real-time Retail Payments Platform (RPP)',
        'auth_method' => 'Biometric Face ID (Hardware Enclave ECDSA P-256)',
        'fee' => 'RM 0.00 (Waived)',
        'reference_note' => 'Pump #4 Ron95 Fuel Dispense',
    ],
    'DN-MY-9921048821' => [
        'id' => 'DN-MY-9921048821',
        'title' => 'Transfer from Sarah Binti Zulkifli',
        'type' => 'duitnow',
        'type_label' => 'DuitNow Transfer',
        'category' => 'Peer-to-Peer Transfer',
        'amount' => 450.00,
        'is_credit' => true,
        'status' => 'completed',
        'status_label' => 'Completed',
        'timestamp' => '10 Sep 2026, 10:30 AM',
        'recipient_name' => 'AHMAD DANIEL BIN ALIF',
        'recipient_account' => 'Savings Account-i (1640 •••• 5678)',
        'sender_account' => 'Maybank &bull; Sarah Binti Zulkifli (•••• 4412)',
        'bank_name' => 'Malayan Banking Berhad &rarr; BankFlow MY',
        'clearing_channel' => 'PayNet DuitNow 2.0 (Instant Clearing)',
        'auth_method' => 'Interbank PayNet Clearing Token',
        'fee' => 'RM 0.00',
        'reference_note' => 'Weekend trip accommodation share',
    ],
    'COOL-HOLD-992184' => [
        'id' => 'COOL-HOLD-992184',
        'title' => 'New Payee: Lim Wei Seng',
        'type' => 'duitnow',
        'type_label' => 'DuitNow Instant',
        'category' => 'Third-Party Transfer (First-Time Payee)',
        'amount' => 1200.00,
        'is_credit' => false,
        'status' => 'cooling_off',
        'status_label' => 'Cooling-Off Window (12h Guard)',
        'timestamp' => '09 Sep 2026, 8:45 PM',
        'recipient_name' => 'LIM WEI SENG',
        'recipient_account' => 'CIMB Bank &bull; 7012 •••• 9921',
        'sender_account' => 'Savings Account-i (1640 •••• 5678)',
        'bank_name' => 'CIMB Bank Berhad',
        'clearing_channel' => 'PayNet DuitNow with Enhanced Scam Guard',
        'auth_method' => 'Smartphone Hardware Enclave Bound Confirmation',
        'fee' => 'RM 0.00',
        'reference_note' => 'Downpayment for MacBook M3 purchase',
        'cooling_off_notice' => 'As part of our anti-scam safeguards, outward transfers to newly bound payees are held for 12 hours before final settlement. You can cancel this transfer anytime before 8:45 AM today if suspicious.',
    ],
    'JOM-5454-99210' => [
        'id' => 'JOM-5454-99210',
        'title' => 'Tenaga Nasional Berhad',
        'type' => 'jompay',
        'type_label' => 'JomPAY Bill Payment',
        'category' => 'Utility Bill Payment',
        'amount' => 178.40,
        'is_credit' => false,
        'status' => 'completed',
        'status_label' => 'Completed',
        'timestamp' => '05 Sep 2026, 4:20 PM',
        'recipient_name' => 'TENAGA NASIONAL BERHAD (TNB)',
        'recipient_account' => 'Biller Code: 5454 &bull; Ref-1: 220194881021',
        'sender_account' => 'Savings Account-i (1640 •••• 5678)',
        'bank_name' => 'PayNet JomPAY National Clearing Network',
        'clearing_channel' => 'JomPAY Real-time Settlement Hub',
        'auth_method' => 'BankFlow Mobile Soft Token Active',
        'fee' => 'RM 0.00 (Free Biller Transaction)',
        'reference_note' => 'Residential Electricity Account August 2026',
    ],
    'PAYROLL-SAL-202608' => [
        'id' => 'PAYROLL-SAL-202608',
        'title' => 'Salary Crediting: TECHSOL CORP',
        'type' => 'fpx',
        'type_label' => 'FPX Corporate Direct Credit',
        'category' => 'Salary & Payroll Inward Clearing',
        'amount' => 8500.00,
        'is_credit' => true,
        'status' => 'completed',
        'status_label' => 'Completed',
        'timestamp' => '28 Aug 2026, 12:05 AM',
        'recipient_name' => 'AHMAD DANIEL BIN ALIF',
        'recipient_account' => 'Savings Account-i (1640 •••• 5678)',
        'sender_account' => 'TECHSOL TECHNOLOGIES SDN BHD (Corporate Payroll Ref #9928)',
        'bank_name' => 'Public Bank Berhad &rarr; BankFlow MY',
        'clearing_channel' => 'PayNet Interbank GIRO / Corporate RPP Hub',
        'auth_method' => 'Corporate Electronic Batch Signing (PKI)',
        'fee' => 'RM 0.00',
        'reference_note' => 'Monthly Salary Crediting August 2026',
    ],
];

$ref = request()->query('ref', 'RPP-20260909-082104');
$tx = $transactions[$ref] ?? $transactions['RPP-20260909-082104'];
@endphp

<x-layout.customer title="Transaction Receipt: {{ $tx['id'] }} — BankFlow MY" activeNav="transactions">
    <div class="space-y-6 sm:space-y-8">

        <!-- STANDARD PAGE HEADER (Matching Dashboard Style) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold {{ $tx['is_credit'] ? 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $tx['is_credit'] ? 'bg-emerald-500' : 'bg-slate-500' }} animate-pulse"></span>
                            {{ $tx['type_label'] }}
                        </span>
                        <span class="text-[11px] sm:text-xs font-mono text-slate-500 dark:text-slate-400">
                            {{ $tx['id'] }}
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        Official Transaction Receipt
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">{{ $tx['timestamp'] }}</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            Cryptographically Verified
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0 flex-wrap">
                    <a
                        href="{{ route('customer.dashboard') }}#transactions"
                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all active:scale-[0.98] shadow-2xs group"
                    >
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-slate-500"></i>
                        <span>Dashboard</span>
                    </a>
                    <button
                        type="button"
                        onclick="window.print()"
                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all active:scale-[0.98] shadow-2xs"
                        title="Print transaction receipt"
                    >
                        <i data-lucide="printer" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span class="hidden sm:inline">Print</span>
                    </button>
                    <button
                        type="button"
                        onclick="window.showAppAlert({ title: 'e-Receipt Downloaded', subtitle: 'PayNet Cleared Hash: {{ substr(md5($tx['id']), 0, 12) }}', message: 'Signed official digital PDF receipt has been generated and saved to your device.', type: 'success' });"
                        class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-all shadow-xs shadow-emerald-600/20 active:scale-[0.98] cursor-pointer"
                        title="Download Official PDF Receipt"
                    >
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        <span>e-Receipt</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Official Digital Bank Receipt Card -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/90 dark:border-slate-800 shadow-md p-6 sm:p-8 relative overflow-hidden animate__animated animate__fadeInUp animate__faster">
            <!-- Decorative Top Gradient Accent Bar -->
            <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r {{ $tx['is_credit'] ? 'from-emerald-500 via-teal-500 to-emerald-600' : 'from-slate-700 via-indigo-600 to-slate-900' }}"></div>

            <!-- Receipt Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 shrink-0">
                        <i data-lucide="landmark" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-extrabold text-base tracking-tight text-slate-900 dark:text-slate-100">
                                BankFlow Malaysia
                            </span>
                            <span class="text-[9px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                                Official Receipt
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                            PIDM Protected Member &bull; Licensed Commercial Islamic Bank
                        </p>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="self-start sm:self-center">
                    @if ($tx['status'] === 'completed')
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/70 border border-emerald-500/20 text-emerald-700 dark:text-emerald-300 text-xs font-extrabold">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            <span>Transaction Successful</span>
                        </div>
                    @elseif ($tx['status'] === 'cooling_off')
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 dark:bg-amber-950/70 border border-amber-500/30 text-amber-700 dark:text-amber-300 text-xs font-extrabold">
                            <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                            <span>Cooling-Off Window (12 Hours)</span>
                        </div>
                    @else
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold">
                            <span>{{ $tx['status_label'] }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Prominent Amount Display -->
            <div class="py-7 text-center border-b border-dashed border-slate-200 dark:border-slate-800">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-400 block mb-1">
                    {{ $tx['is_credit'] ? 'Amount Credited' : 'Total Amount Transferred' }}
                </span>
                <div class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight {{ $tx['is_credit'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-900 dark:text-slate-100' }}">
                    {{ $tx['is_credit'] ? '+' : '-' }}RM {{ number_format($tx['amount'], 2) }}
                </div>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mt-2">
                    {{ $tx['title'] }}
                </p>
            </div>

            @if (!empty($tx['cooling_off_notice']))
                <!-- Anti-Scam Cooling-Off Safeguard Banner -->
                <div class="my-6 p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/50 border border-amber-300/80 dark:border-amber-900/60 flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-amber-500/20 text-amber-700 dark:text-amber-300 flex items-center justify-center shrink-0 mt-0.5">
                        <i data-lucide="shield-alert" class="w-4 h-4"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-xs font-bold text-amber-900 dark:text-amber-200 uppercase tracking-wider">
                            12-Hour Anti-Scam Cooling-Off Safeguard
                        </h3>
                        <p class="text-xs text-amber-800 dark:text-amber-300 mt-1 leading-relaxed">
                            {{ $tx['cooling_off_notice'] }}
                        </p>
                        <div class="mt-3 flex items-center gap-2">
                            <button
                                type="button"
                                onclick="window.showAppConfirm({ title: 'Cancel & Reverse Transfer?', subtitle: 'Cooling-Off Period', message: 'Would you like to abort this transaction? Full amount of RM {{ number_format($tx['amount'], 2) }} will be returned immediately to your Savings Account-i.', type: 'danger', confirmText: 'Yes, Reverse Transfer', cancelText: 'No, Keep Transfer', onConfirm: function() { window.showAppAlert({ title: 'Transfer Reversed', subtitle: 'Funds Returned', message: 'Transaction cancelled. Funds have been returned immediately to Savings Account-i.', type: 'success', onConfirm: function() { window.location.href='{{ route('customer.dashboard') }}#transactions'; } }); } });"
                                class="px-3 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-xs cursor-pointer active:scale-95 transition-all"
                            >
                                Cancel &amp; Reverse Transfer
                            </button>
                            <a
                                href="tel:997"
                                class="px-3 py-1.5 rounded-lg bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 font-bold text-xs shadow-2xs hover:bg-slate-50 transition-all"
                            >
                                Report to NSRC 997
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Detailed Breakdown Data Grid -->
            <!-- Detailed Breakdown Data Grid (Organized into Visual Cards) -->
            <div class="py-6 space-y-3 sm:space-y-4">

                <!-- Row 1: Transaction ID & Payment Rail -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3">
                    <div class="p-3.5 rounded-2xl bg-slate-50/80 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/60 flex flex-col justify-between">
                        <span class="text-[11px] uppercase font-bold tracking-wider text-slate-400 dark:text-slate-500 mb-1">
                            Transaction Reference
                        </span>
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-mono text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 select-all truncate">
                                {{ $tx['id'] }}
                            </span>
                            <button
                                type="button"
                                onclick="navigator.clipboard.writeText('{{ $tx['id'] }}'); alert('Reference copied to clipboard!');"
                                class="p-1 text-slate-400 hover:text-emerald-600 cursor-pointer rounded transition-colors shrink-0"
                                title="Copy reference"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-slate-50/80 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/60 flex flex-col justify-between">
                        <span class="text-[11px] uppercase font-bold tracking-wider text-slate-400 dark:text-slate-500 mb-1">
                            Payment Rail / Channel
                        </span>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100">
                                {{ $tx['type_label'] }}
                            </span>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60">
                                {{ $tx['category'] }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Recipient Card & Originating Account -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3">
                    <!-- Recipient -->
                    <div class="p-4 rounded-2xl bg-slate-50/80 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/60">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center shrink-0">
                                <i data-lucide="user-check" class="w-3.5 h-3.5"></i>
                            </div>
                            <span class="text-[11px] uppercase font-bold tracking-wider text-slate-400 dark:text-slate-500">
                                Recipient / Beneficiary
                            </span>
                        </div>
                        <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ $tx['recipient_name'] }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                            {!! $tx['recipient_account'] !!}
                        </p>
                        <div class="mt-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/50 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Bank</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-200">{!! $tx['bank_name'] !!}</span>
                        </div>
                    </div>

                    <!-- Originating Account -->
                    <div class="p-4 rounded-2xl bg-slate-50/80 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/60">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center shrink-0">
                                <i data-lucide="wallet" class="w-3.5 h-3.5"></i>
                            </div>
                            <span class="text-[11px] uppercase font-bold tracking-wider text-slate-400 dark:text-slate-500">
                                Originating Account
                            </span>
                        </div>
                        <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {!! $tx['sender_account'] !!}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                            Account Holder: {{ $customer->name }}
                        </p>
                        <div class="mt-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/50 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Date &amp; Time</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $tx['timestamp'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Reference Note & Settlement Details -->
                <div class="p-4 rounded-2xl bg-slate-50/80 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/60 space-y-2.5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 pb-2 border-b border-slate-200/60 dark:border-slate-700/50 text-xs sm:text-sm">
                        <span class="text-slate-400 font-medium">Payment Description / Note</span>
                        <span class="font-bold text-slate-900 dark:text-slate-100">{{ $tx['reference_note'] }}</span>
                    </div>

                    <div class="flex items-center justify-between text-xs pb-2 border-b border-slate-200/60 dark:border-slate-700/50">
                        <span class="text-slate-400 font-medium">Clearing Network</span>
                        <span class="font-medium text-slate-700 dark:text-slate-300">{{ $tx['clearing_channel'] }}</span>
                    </div>

                    <div class="flex items-center justify-between text-xs pb-2 border-b border-slate-200/60 dark:border-slate-700/50">
                        <span class="text-slate-400 font-medium">Transaction Fee &amp; SST</span>
                        <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $tx['fee'] }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 text-xs pt-0.5">
                        <span class="text-slate-400 font-medium">Hardware Authorization</span>
                        <span class="font-mono text-xs font-semibold text-slate-700 dark:text-slate-200 inline-flex items-center gap-1.5">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500"></i>
                            {{ $tx['auth_method'] }}
                        </span>
                    </div>
                </div>

            </div>

            <!-- Receipt Footer & Security Watermark -->
            <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-400">
                <div class="flex items-center gap-2">
                    <i data-lucide="lock" class="w-3.5 h-3.5 text-emerald-600"></i>
                    <span>Cryptographically signed by BankFlow RPP Gateway</span>
                </div>
                <div class="font-mono text-[10px]">
                    SHA-256: {{ strtoupper(substr(hash('sha256', $tx['id']), 0, 24)) }}...
                </div>
            </div>
        </div>

        <!-- Quick Actions Card Below Receipt -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-300">
                    <i data-lucide="repeat" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100">Need to make another transfer?</h4>
                    <p class="text-xs text-slate-400">Repeat this payment or return to accounts overview.</p>
                </div>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button
                    type="button"
                    onclick="window.location.href='{{ route('customer.dashboard') }}';"
                    class="flex-1 sm:flex-initial px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-xs cursor-pointer active:scale-95"
                >
                    Back to Overview
                </button>
            </div>
        </div>

    </div>

</x-layout.customer>
