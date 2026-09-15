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

// Rich Transaction History Dataset
$allTransactions = [
    [
        'id' => 'RPP-20260909-082104',
        'title' => 'PETRONAS Dagangan Berhad',
        'type' => 'qr',
        'type_label' => 'DuitNow QR',
        'category' => 'Fuel & Retail Payment',
        'amount' => '85.00',
        'is_credit' => false,
        'date' => 'Today, 1:15 PM',
        'date_iso' => '2026-09-14',
        'status' => 'completed',
        'reference' => 'RPP-20260909-082104',
    ],
    [
        'id' => 'DN-MY-9921048821',
        'title' => 'Transfer from Sarah Binti Zulkifli',
        'type' => 'duitnow',
        'type_label' => 'DuitNow',
        'category' => 'Peer-to-Peer Transfer',
        'amount' => '450.00',
        'is_credit' => true,
        'date' => 'Today, 10:30 AM',
        'date_iso' => '2026-09-14',
        'status' => 'completed',
        'reference' => 'DN-MY-9921048821',
    ],
    [
        'id' => 'COOL-HOLD-992184',
        'title' => 'New Payee: Lim Wei Seng',
        'type' => 'duitnow',
        'type_label' => 'DuitNow Instant',
        'category' => 'Third-Party Transfer',
        'amount' => '1200.00',
        'is_credit' => false,
        'date' => 'Yesterday, 8:45 PM',
        'date_iso' => '2026-09-13',
        'status' => 'cooling_off',
        'reference' => 'COOL-HOLD-992184',
    ],
    [
        'id' => 'JOM-5454-99210',
        'title' => 'Tenaga Nasional Berhad',
        'type' => 'jompay',
        'type_label' => 'JomPAY Bill',
        'category' => 'Utility Payment (5454)',
        'amount' => '178.40',
        'is_credit' => false,
        'date' => '05 Sep 2026, 4:20 PM',
        'date_iso' => '2026-09-05',
        'status' => 'completed',
        'reference' => 'JOM-5454-99210',
    ],
    [
        'id' => 'PAYROLL-SAL-202608',
        'title' => 'Salary Crediting: TECHSOL CORP',
        'type' => 'fpx',
        'type_label' => 'Direct Credit',
        'category' => 'Corporate Payroll',
        'amount' => '8500.00',
        'is_credit' => true,
        'date' => '28 Aug 2026, 12:05 AM',
        'date_iso' => '2026-08-28',
        'status' => 'completed',
        'reference' => 'PAYROLL-SAL-202608',
    ],
    [
        'id' => 'QR-MY-88129031',
        'title' => 'FamilyMart Nu Sentral',
        'type' => 'qr',
        'type_label' => 'DuitNow QR',
        'category' => 'Food & Dining',
        'amount' => '24.60',
        'is_credit' => false,
        'date' => '26 Aug 2026, 7:15 PM',
        'date_iso' => '2026-08-26',
        'status' => 'completed',
        'reference' => 'QR-MY-88129031',
    ],
    [
        'id' => 'JOM-AIR-338291',
        'title' => 'Air Selangor Water Board',
        'type' => 'jompay',
        'type_label' => 'JomPAY Bill',
        'category' => 'Utility Payment (4200)',
        'amount' => '36.80',
        'is_credit' => false,
        'date' => '22 Aug 2026, 11:10 AM',
        'date_iso' => '2026-08-22',
        'status' => 'completed',
        'reference' => 'JOM-AIR-338291',
    ],
    [
        'id' => 'DN-RENT-202608',
        'title' => 'Monthly Rental: Tan Ah Kau',
        'type' => 'duitnow',
        'type_label' => 'DuitNow Transfer',
        'category' => 'Property & Housing',
        'amount' => '1800.00',
        'is_credit' => false,
        'date' => '01 Aug 2026, 9:00 AM',
        'date_iso' => '2026-08-01',
        'status' => 'completed',
        'reference' => 'DN-RENT-202608',
    ],
    [
        'id' => 'DIV-ASB-202607',
        'title' => 'ASNB Dividend Distribution',
        'type' => 'fpx',
        'type_label' => 'Direct Credit',
        'category' => 'Investment Yield',
        'amount' => '620.00',
        'is_credit' => true,
        'date' => '15 Jul 2026, 3:45 PM',
        'date_iso' => '2026-07-15',
        'status' => 'completed',
        'reference' => 'DIV-ASB-202607',
    ],
    [
        'id' => 'JOM-TM-992019',
        'title' => 'Telekom Malaysia (Unifi Home)',
        'type' => 'jompay',
        'type_label' => 'JomPAY Bill',
        'category' => 'Broadband & Telecom',
        'amount' => '136.75',
        'is_credit' => false,
        'date' => '10 Jul 2026, 2:30 PM',
        'date_iso' => '2026-07-10',
        'status' => 'completed',
        'reference' => 'JOM-TM-992019',
    ],
    [
        'id' => 'DN-FOOD-202607',
        'title' => 'GrabFood Order: Nasi Kandar Pelita',
        'type' => 'duitnow',
        'type_label' => 'DuitNow',
        'category' => 'Food & Dining',
        'amount' => '32.50',
        'is_credit' => false,
        'date' => '04 Jul 2026, 8:15 PM',
        'date_iso' => '2026-07-04',
        'status' => 'completed',
        'reference' => 'DN-FOOD-202607',
    ],
    [
        'id' => 'PAYROLL-SAL-202606',
        'title' => 'Salary Crediting: TECHSOL CORP',
        'type' => 'fpx',
        'type_label' => 'Direct Credit',
        'category' => 'Corporate Payroll',
        'amount' => '8500.00',
        'is_credit' => true,
        'date' => '28 Jun 2026, 12:05 AM',
        'date_iso' => '2026-06-28',
        'status' => 'completed',
        'reference' => 'PAYROLL-SAL-202606',
    ],
    [
        'id' => 'QR-WAT-202606',
        'title' => 'Watsons Personal Care Pavilion',
        'type' => 'qr',
        'type_label' => 'DuitNow QR',
        'category' => 'Health & Beauty',
        'amount' => '64.90',
        'is_credit' => false,
        'date' => '21 Jun 2026, 4:50 PM',
        'date_iso' => '2026-06-21',
        'status' => 'completed',
        'reference' => 'QR-WAT-202606',
    ],
    [
        'id' => 'JOM-INSU-202606',
        'title' => 'Great Eastern Life Assurance',
        'type' => 'jompay',
        'type_label' => 'JomPAY Bill',
        'category' => 'Insurance Premium',
        'amount' => '285.00',
        'is_credit' => false,
        'date' => '15 Jun 2026, 10:00 AM',
        'date_iso' => '2026-06-15',
        'status' => 'completed',
        'reference' => 'JOM-INSU-202606',
    ],
    [
        'id' => 'DN-CASHBACK-202606',
        'title' => 'BankFlow Monthly Profit & Cashback',
        'type' => 'fpx',
        'type_label' => 'Direct Credit',
        'category' => 'Account Profit (Hibah)',
        'amount' => '48.20',
        'is_credit' => true,
        'date' => '01 Jun 2026, 12:00 AM',
        'date_iso' => '2026-06-01',
        'status' => 'completed',
        'reference' => 'DN-CASHBACK-202606',
    ],
    [
        'id' => 'DN-ZUL-202605',
        'title' => 'Transfer to Zulkifli Bin Ahmad',
        'type' => 'duitnow',
        'type_label' => 'DuitNow Transfer',
        'category' => 'Family Allowance',
        'amount' => '500.00',
        'is_credit' => false,
        'date' => '25 May 2026, 6:30 PM',
        'date_iso' => '2026-05-25',
        'status' => 'completed',
        'reference' => 'DN-ZUL-202605',
    ],
    [
        'id' => 'QR-JAYA-202605',
        'title' => 'Jaya Grocer Bangsar Market',
        'type' => 'qr',
        'type_label' => 'DuitNow QR',
        'category' => 'Groceries & Household',
        'amount' => '142.30',
        'is_credit' => false,
        'date' => '18 May 2026, 11:40 AM',
        'date_iso' => '2026-05-18',
        'status' => 'completed',
        'reference' => 'QR-JAYA-202605',
    ]
];

$totalIn = 9570.00;
$totalOut = 3424.80;
$netFlow = $totalIn - $totalOut;
@endphp

<x-layout.customer title="Transaction History &amp; Activity — BankFlow MY" activeNav="history">

    <div class="space-y-4 sm:space-y-6 pb-2 sm:pb-4">

        <!-- STANDARD PAGE HEADER -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Real-time Stream
                        </span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">
                            Account: {{ $customer->account_number }}
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        Transaction History &amp; Activity
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">PayNet RPP &amp; Clearing 24/7</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            Cryptographically Verified Logs
                        </span>
                    </div>
                </div>

                <!-- Action Buttons: Responsive Adaptive Layout -->
                <div class="grid grid-cols-3 sm:flex sm:items-center gap-1.5 sm:gap-2 shrink-0 pt-2.5 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0 w-full sm:w-auto">
                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2.5 sm:px-3.5 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-[11px] sm:text-xs font-bold transition-all active:scale-[0.98] shadow-2xs group whitespace-nowrap"
                    >
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-slate-500 shrink-0"></i>
                        <span>Dashboard</span>
                    </a>
                    <a
                        href="{{ route('customer.statement') }}"
                        class="inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2.5 sm:px-3.5 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-[11px] sm:text-xs font-bold transition-all active:scale-[0.98] shadow-2xs group whitespace-nowrap"
                    >
                        <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-500 shrink-0"></i>
                        <span>Statement</span>
                    </a>
                    <button
                        type="button"
                        onclick="window.exportTransactionsCsv()"
                        class="inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2.5 sm:px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-[11px] sm:text-xs font-bold transition-all shadow-xs shadow-emerald-600/20 active:scale-[0.98] cursor-pointer whitespace-nowrap"
                    >
                        <i data-lucide="download" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>Export CSV</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- CASH FLOW TELEMETRY CARDS (Money In / Money Out / Net Cash) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-4 animate__animated animate__fadeInUp animate__faster">
            {{-- Money In --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs relative overflow-hidden group hover:border-emerald-500/40 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Received</span>
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                        <i data-lucide="arrow-down-left" class="w-4 h-4 stroke-[2.5]"></i>
                    </div>
                </div>
                <div class="mt-2.5">
                    <h3 class="text-xl sm:text-2xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight">
                        +RM {{ number_format($totalIn, 2) }}
                    </h3>
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5">3 credits recorded this cycle</p>
                </div>
            </div>

            {{-- Money Out --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs relative overflow-hidden group hover:border-rose-500/40 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Spent</span>
                    <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center border border-rose-500/20">
                        <i data-lucide="arrow-up-right" class="w-4 h-4 stroke-[2.5]"></i>
                    </div>
                </div>
                <div class="mt-2.5">
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight">
                        -RM {{ number_format($totalOut, 2) }}
                    </h3>
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5">7 transactions cleared</p>
                </div>
            </div>

            {{-- Net Cash Flow --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs relative overflow-hidden group hover:border-emerald-500/40 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Net Cash Flow</span>
                    <div class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 flex items-center justify-center border border-slate-200 dark:border-slate-700">
                        <i data-lucide="wallet-cards" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="mt-2.5">
                    <h3 class="text-xl sm:text-2xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight">
                        +RM {{ number_format($netFlow, 2) }}
                    </h3>
                    <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold mt-0.5 flex items-center gap-1">
                        <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                        <span>Positive cash flow balance</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- SEARCH & INTERACTIVE FILTER CONTROL BAR -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4 animate__animated animate__fadeInUp animate__faster">
            <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
                {{-- Search Bar --}}
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input
                        type="text"
                        id="history-search-input"
                        oninput="window.applyHistoryFilters()"
                        placeholder="Search by payee, merchant, reference ID, or category..."
                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all font-sans shadow-2xs"
                    />
                </div>

                {{-- Date Period & Direction Selectors: Full width grid on mobile, inline on sm+ --}}
                <div class="grid grid-cols-2 sm:flex sm:items-center gap-2 w-full sm:w-auto">
                    <div class="relative w-full sm:w-auto">
                        <select
                            id="history-date-filter"
                            onchange="window.applyHistoryFilters()"
                            class="w-full sm:w-auto px-3 py-2.5 sm:px-3.5 sm:py-3 rounded-2xl text-xs font-bold border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 shadow-2xs focus:outline-none focus:ring-2 focus:ring-emerald-500 appearance-none pr-8 cursor-pointer font-sans"
                        >
                            <option value="all">All Dates</option>
                            <option value="30">Last 30 Days</option>
                            <option value="60">Last 60 Days</option>
                            <option value="90">Last 90 Days</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                        </div>
                    </div>

                    <div class="relative w-full sm:w-auto">
                        <select
                            id="history-direction-filter"
                            onchange="window.applyHistoryFilters()"
                            class="w-full sm:w-auto px-3 py-2.5 sm:px-3.5 sm:py-3 rounded-2xl text-xs font-bold border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 shadow-2xs focus:outline-none focus:ring-2 focus:ring-emerald-500 appearance-none pr-8 cursor-pointer font-sans"
                        >
                            <option value="all">All Directions</option>
                            <option value="in">Money In (+Credit)</option>
                            <option value="out">Money Out (-Debit)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                            <i data-lucide="arrow-up-down" class="w-3.5 h-3.5"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Channel Filter: Mobile Dropdown (< sm) --}}
            <div class="sm:hidden border-t border-slate-100 dark:border-slate-800/80 pt-3">
                <div class="relative w-full">
                    <select
                        id="history-channel-mobile-select"
                        onchange="window.setChannelFilterFromMobile(this.value)"
                        class="w-full px-3.5 py-2.5 rounded-2xl text-xs font-bold border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 shadow-2xs focus:outline-none focus:ring-2 focus:ring-emerald-500 appearance-none pr-8 cursor-pointer font-sans"
                    >
                        <option value="all">Channel: All Channels</option>
                        <option value="duitnow">DuitNow Transfers</option>
                        <option value="jompay">JomPAY Bills</option>
                        <option value="qr">DuitNow QR Pay</option>
                        <option value="fpx">FPX / Direct Credit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>
            </div>

            {{-- Channel Filter: Desktop Filter Pills (sm+) --}}
            <div class="hidden sm:flex items-center gap-1.5 overflow-x-auto pb-1 scrollbar-none border-t border-slate-100 dark:border-slate-800/80 pt-3" id="history-channel-pills">
                <button type="button" onclick="window.setChannelFilter('all', this)" class="hist-pill px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 text-white shadow-2xs transition-all cursor-pointer" data-channel="all">
                    All Channels
                </button>
                <button type="button" onclick="window.setChannelFilter('duitnow', this)" class="hist-pill px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-channel="duitnow">
                    DuitNow
                </button>
                <button type="button" onclick="window.setChannelFilter('jompay', this)" class="hist-pill px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-channel="jompay">
                    JomPAY
                </button>
                <button type="button" onclick="window.setChannelFilter('qr', this)" class="hist-pill px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-channel="qr">
                    QR Pay
                </button>
                <button type="button" onclick="window.setChannelFilter('fpx', this)" class="hist-pill px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-channel="fpx">
                    FPX / Direct Credit
                </button>
            </div>
        </div>

        <!-- TRANSACTIONS STREAM TABLE / LIST -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-xs overflow-hidden animate__animated animate__fadeInUp animate__faster">
            <div class="flex items-center justify-between p-4 sm:p-5 border-b border-slate-100 dark:border-slate-800">
                <div>
                    <h2 class="text-sm sm:text-base font-black text-slate-900 dark:text-slate-100 tracking-tight">
                        Activity Stream
                    </h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5" id="history-record-count">
                        Showing {{ count($allTransactions) }} verified transactions
                    </p>
                </div>

                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-lg">
                    <i data-lucide="shield-check" class="w-3 h-3 text-emerald-500"></i>
                    <span>Bank Negara Compliant</span>
                </span>
            </div>

            <div class="divide-y divide-slate-100 dark:divide-slate-800/60" id="history-items-container">
                @foreach ($allTransactions as $tx)
                    <div
                        class="history-tx-item"
                        data-type="{{ $tx['type'] }}"
                        data-credit="{{ $tx['is_credit'] ? '1' : '0' }}"
                        data-title="{{ strtolower($tx['title']) }}"
                        data-ref="{{ strtolower($tx['reference']) }}"
                        data-category="{{ strtolower($tx['category']) }}"
                    >
                        <x-banking.transaction-item
                            :title="$tx['title']"
                            :category="$tx['category']"
                            :type="$tx['type']"
                            :amount="$tx['amount']"
                            :isCredit="$tx['is_credit']"
                            :date="$tx['date']"
                            :status="$tx['status']"
                            :reference="$tx['reference']"
                        />
                    </div>
                @endforeach
            </div>

            <!-- Interactive Pagination Bar -->
            <div id="history-pagination-bar" class="p-3.5 sm:p-4 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 bg-slate-50/50 dark:bg-slate-800/30">
                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium text-center sm:text-left" id="pagination-info-text">
                    Showing <span id="page-start-idx" class="font-bold text-slate-700 dark:text-slate-200">1</span> to <span id="page-end-idx" class="font-bold text-slate-700 dark:text-slate-200">6</span> of <span id="page-total-idx" class="font-bold text-slate-700 dark:text-slate-200">18</span> transactions
                </div>

                <div class="flex items-center gap-1.5 shrink-0" id="pagination-nav-controls">
                    <button
                        type="button"
                        id="pagination-btn-prev"
                        onclick="window.goToHistoryPage(currentPage - 1)"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                        title="Previous Page"
                    >
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </button>

                    <div id="pagination-page-pills" class="flex items-center gap-1">
                        <!-- Dynamic page number buttons generated by JS -->
                    </div>

                    <button
                        type="button"
                        id="pagination-btn-next"
                        onclick="window.goToHistoryPage(currentPage + 1)"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                        title="Next Page"
                    >
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Client-Side Filter, Search & Pagination Script -->
    <script>
    (function() {
        let activeChannel = 'all';
        let currentPage = 1;
        const pageSize = 6;
        let filteredItems = [];

        window.setChannelFilter = function(channel, btn) {
            activeChannel = channel;
            document.querySelectorAll('#history-channel-pills .hist-pill').forEach(function(b) {
                b.classList.remove('bg-emerald-600', 'text-white');
                b.classList.add('bg-slate-50', 'dark:bg-slate-800/70', 'border', 'border-slate-200/70', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
            });
            if (btn) {
                btn.classList.remove('bg-slate-50', 'dark:bg-slate-800/70', 'border', 'border-slate-200/70', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
                btn.classList.add('bg-emerald-600', 'text-white');
            }

            // Sync with mobile select dropdown
            const mobileSelect = document.getElementById('history-channel-mobile-select');
            if (mobileSelect) mobileSelect.value = channel;

            currentPage = 1;
            window.applyHistoryFilters();
        };

        window.setChannelFilterFromMobile = function(channel) {
            activeChannel = channel;
            // Sync with desktop pills
            const targetBtn = document.querySelector(`#history-channel-pills .hist-pill[data-channel="${channel}"]`);
            document.querySelectorAll('#history-channel-pills .hist-pill').forEach(function(b) {
                b.classList.remove('bg-emerald-600', 'text-white');
                b.classList.add('bg-slate-50', 'dark:bg-slate-800/70', 'border', 'border-slate-200/70', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
            });
            if (targetBtn) {
                targetBtn.classList.remove('bg-slate-50', 'dark:bg-slate-800/70', 'border', 'border-slate-200/70', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
                targetBtn.classList.add('bg-emerald-600', 'text-white');
            }

            currentPage = 1;
            window.applyHistoryFilters();
        };

        window.renderPagination = function(matchingItems) {
            const totalCount = matchingItems.length;
            const paginationBar = document.getElementById('history-pagination-bar');
            if (!paginationBar) return;

            if (totalCount === 0) {
                paginationBar.classList.add('hidden');
                return;
            }
            paginationBar.classList.remove('hidden');

            const totalPages = Math.ceil(totalCount / pageSize);
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const startIdx = (currentPage - 1) * pageSize + 1;
            const endIdx = Math.min(currentPage * pageSize, totalCount);

            // Update range text
            const startEl = document.getElementById('page-start-idx');
            const endEl = document.getElementById('page-end-idx');
            const totalEl = document.getElementById('page-total-idx');
            if (startEl) startEl.textContent = startIdx;
            if (endEl) endEl.textContent = endIdx;
            if (totalEl) totalEl.textContent = totalCount;

            // Update Prev / Next buttons
            const prevBtn = document.getElementById('pagination-btn-prev');
            const nextBtn = document.getElementById('pagination-btn-next');
            if (prevBtn) {
                prevBtn.disabled = (currentPage <= 1);
            }
            if (nextBtn) {
                nextBtn.disabled = (currentPage >= totalPages);
            }

            // Build page pill numbers
            const pillsContainer = document.getElementById('pagination-page-pills');
            if (pillsContainer) {
                let html = '';
                for (let p = 1; p <= totalPages; p++) {
                    const isActive = (p === currentPage);
                    html += `
                        <button
                            type="button"
                            onclick="window.goToHistoryPage(${p})"
                            class="w-7 h-7 sm:w-8 sm:h-8 text-xs font-bold rounded-lg sm:rounded-xl transition-all cursor-pointer ${
                                isActive
                                    ? 'bg-emerald-600 text-white shadow-xs shadow-emerald-600/30'
                                    : 'border border-slate-200/80 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800'
                            }"
                        >
                            ${p}
                        </button>
                    `;
                }
                pillsContainer.innerHTML = html;
            }

            // Show only the items of the current page slice
            matchingItems.forEach((el, index) => {
                if (index >= (startIdx - 1) && index < endIdx) {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });
        };

        window.goToHistoryPage = function(page) {
            currentPage = page;
            window.renderPagination(filteredItems);
            // Smoothly scroll items card into comfortable view if scrolled far down
            const card = document.getElementById('history-items-container');
            if (card && card.getBoundingClientRect().top < 100) {
                card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        };

        window.applyHistoryFilters = function() {
            const query = (document.getElementById('history-search-input')?.value || '').trim().toLowerCase();
            const direction = document.getElementById('history-direction-filter')?.value || 'all';

            const allItems = Array.from(document.querySelectorAll('.history-tx-item'));
            filteredItems = [];

            allItems.forEach(function(el) {
                const type = el.getAttribute('data-type');
                const isCredit = el.getAttribute('data-credit') === '1';
                const title = el.getAttribute('data-title') || '';
                const ref = el.getAttribute('data-ref') || '';
                const category = el.getAttribute('data-category') || '';

                // Channel Match
                const channelMatch = (activeChannel === 'all') || (type === activeChannel);

                // Direction Match
                let dirMatch = true;
                if (direction === 'in') dirMatch = isCredit;
                else if (direction === 'out') dirMatch = !isCredit;

                // Query Match
                let queryMatch = true;
                if (query.length > 0) {
                    queryMatch = title.includes(query) || ref.includes(query) || category.includes(query);
                }

                if (channelMatch && dirMatch && queryMatch) {
                    filteredItems.push(el);
                } else {
                    el.classList.add('hidden');
                }
            });

            // Update Counter & Empty State
            const totalMatched = filteredItems.length;
            const countEl = document.getElementById('history-record-count');
            if (countEl) countEl.textContent = `Showing ${totalMatched} verified transaction${totalMatched === 1 ? '' : 's'}`;

            const emptyEl = document.getElementById('history-empty-state');
            if (emptyEl) {
                if (totalMatched === 0) emptyEl.classList.remove('hidden');
                else emptyEl.classList.add('hidden');
            }

            // Render paginated items
            window.renderPagination(filteredItems);
        };

        window.resetHistoryFilters = function() {
            const searchInput = document.getElementById('history-search-input');
            const dirSelect = document.getElementById('history-direction-filter');
            const dateSelect = document.getElementById('history-date-filter');
            if (searchInput) searchInput.value = '';
            if (dirSelect) dirSelect.value = 'all';
            if (dateSelect) dateSelect.value = 'all';

            const firstPill = document.querySelector('#history-channel-pills .hist-pill[data-channel="all"]');
            window.setChannelFilter('all', firstPill);
        };

        window.exportTransactionsCsv = function() {
            const rows = [
                ["Transaction ID", "Date", "Title / Payee", "Type", "Category", "Amount (RM)", "Direction", "Status"],
                ["RPP-20260909-082104", "14 Sep 2026", "PETRONAS Dagangan Berhad", "DuitNow QR", "Fuel & Retail", "85.00", "DEBIT", "Completed"],
                ["DN-MY-9921048821", "14 Sep 2026", "Sarah Binti Zulkifli", "DuitNow", "P2P Transfer", "450.00", "CREDIT", "Completed"],
                ["COOL-HOLD-992184", "13 Sep 2026", "Lim Wei Seng", "DuitNow", "Third-Party Transfer", "1200.00", "DEBIT", "Cooling-Off"],
                ["JOM-5454-99210", "05 Sep 2026", "Tenaga Nasional Berhad", "JomPAY", "Utility Bill", "178.40", "DEBIT", "Completed"],
                ["PAYROLL-SAL-202608", "28 Aug 2026", "Salary: TECHSOL CORP", "Direct Credit", "Corporate Payroll", "8500.00", "CREDIT", "Completed"],
                ["QR-MY-88129031", "26 Aug 2026", "FamilyMart Nu Sentral", "DuitNow QR", "Food & Dining", "24.60", "DEBIT", "Completed"],
                ["JOM-AIR-338291", "22 Aug 2026", "Air Selangor Water Board", "JomPAY", "Utility Bill", "36.80", "DEBIT", "Completed"],
                ["DN-RENT-202608", "01 Aug 2026", "Monthly Rental: Tan Ah Kau", "DuitNow", "Housing", "1800.00", "DEBIT", "Completed"],
                ["DIV-ASB-202607", "15 Jul 2026", "ASNB Dividend Distribution", "Direct Credit", "Investment Yield", "620.00", "CREDIT", "Completed"],
                ["JOM-TM-992019", "10 Jul 2026", "Telekom Malaysia (Unifi Home)", "JomPAY", "Telecom", "136.75", "DEBIT", "Completed"]
            ];

            let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
            let encodedUri = encodeURI(csvContent);
            let link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "BankFlow_Transaction_History_2026.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            if (window.showAppAlert) {
                window.showAppAlert({
                    title: 'Export Successful',
                    subtitle: 'Audit & Statements',
                    message: 'Your filtered transaction activity has been downloaded as a CSV spreadsheet.',
                    type: 'success'
                });
            }
        };

        // Initial trigger to paginate dataset on page load
        document.addEventListener('DOMContentLoaded', function() {
            window.applyHistoryFilters();
        });
        setTimeout(function() {
            window.applyHistoryFilters();
            if (window.lucide) window.lucide.createIcons();
        }, 50);
    })();
    </script>

</x-layout.customer>
