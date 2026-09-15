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
@endphp

<x-layout.customer title="Retail Banking Dashboard — BankFlow MY" activeNav="dashboard">

    <div class="space-y-6 sm:space-y-8">

        @php
            $sysParamService = app(\App\Services\SystemParameterService::class);
            $isMaintenance = $sysParamService->isMaintenanceMode();
            $noticeMessage = $sysParamService->get('maintenance_banner_message');
        @endphp

        @if($isMaintenance || !empty($noticeMessage))
            <div class="p-3.5 sm:p-4 rounded-2xl {{ $isMaintenance ? 'bg-amber-500/10 border-amber-500/30 text-amber-900 dark:text-amber-200' : 'bg-blue-500/10 border-blue-500/30 text-blue-900 dark:text-blue-200' }} border flex items-center justify-between gap-3 animate__animated animate__fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl {{ $isMaintenance ? 'bg-amber-500 text-white' : 'bg-blue-500 text-white' }} flex items-center justify-center shrink-0 shadow-xs">
                        <i data-lucide="{{ $isMaintenance ? 'alert-triangle' : 'info' }}" class="w-4 h-4"></i>
                    </div>
                    <div class="text-xs">
                        <span class="font-bold {{ $isMaintenance ? 'text-amber-700 dark:text-amber-300' : 'text-blue-700 dark:text-blue-300' }} uppercase tracking-wider text-[10px]">
                            {{ $isMaintenance ? 'Scheduled Maintenance Notice' : 'Bank Advisory' }}
                        </span>
                        <p class="font-medium mt-0.5 leading-relaxed">{{ $noticeMessage }}</p>
                    </div>
                </div>
                <div class="text-[10px] font-mono shrink-0 hidden sm:block">
                    24/7 Hotline: 997
                </div>
            </div>
        @endif

        <!-- DASHBOARD PAGE HEADER (Simple, Clean, Adaptive for All Devices) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <!-- User Greeting & Account Telemetry -->
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Online Banking
                        </span>
                        <span class="text-[11px] sm:text-xs font-mono text-slate-500 dark:text-slate-400">
                            {{ $customer->account_number }}
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        Welcome, {{ $customer->name }}
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">{{ $customer->account_type }}</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            Verified
                        </span>
                        <span class="text-slate-300 dark:text-slate-700 hidden xs:inline">•</span>
                        <span class="text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 hidden xs:inline">Today, {{ date('h:i A') }}</span>
                    </div>
                </div>

                <!-- Quick Action Buttons: Adaptive Side-by-Side -->
                <div class="grid grid-cols-2 sm:flex sm:items-center gap-2 sm:gap-2.5 shrink-0 pt-2 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0">
                    <a
                        href="{{ route('customer.statement') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all active:scale-[0.98] shadow-2xs"
                    >
                        <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400"></i>
                        <span>e-Statement</span>
                    </a>
                    <a
                        href="{{ route('customer.transfer') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-all shadow-xs shadow-emerald-600/20 active:scale-[0.98]"
                    >
                        <i data-lucide="send" class="w-3.5 h-3.5"></i>
                        <span>Transfer</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Master Digital Banking Portfolio & Category Deck -->
        <section id="cards" aria-label="Digital Banking Portfolio" class="relative z-10 isolate scroll-mt-20 animate__animated animate__fadeInUp animate__faster">
            <x-banking.portfolio-hub />
        </section>

        <!-- SECTION 3: Quick Banking Services -->
        <section aria-labelledby="section-quick-services" class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInUp animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 mb-4 border-b border-slate-100 dark:border-slate-800/80 gap-2">
                <div>
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 border border-amber-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Instant Actions
                        </span>
                        <span class="text-[11px] sm:text-xs text-slate-400 font-medium hidden xs:inline">PayNet Clearing</span>
                    </div>
                    <h2 id="section-quick-services" class="text-sm sm:text-lg lg:text-xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1">
                        Quick Banking Services
                    </h2>
                </div>
                <div class="flex items-center gap-1.5 text-[11px] sm:text-xs font-semibold text-slate-500 dark:text-slate-400">
                    <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i>
                    <span>Zero Transaction Fee</span>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2.5 sm:gap-3.5">
                <!-- DuitNow Transfer Page Link -->
                <a
                    href="{{ route('customer.transfer') }}"
                    class="relative p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-slate-50/70 hover:bg-white dark:bg-slate-800/50 dark:hover:bg-slate-800 hover:border-emerald-500/40 hover:shadow-md hover:shadow-emerald-500/5 transition-all text-left group cursor-pointer active:scale-[0.98] flex flex-col justify-between min-h-[110px] sm:min-h-[125px] overflow-hidden"
                >
                    <div class="flex items-center justify-between w-full mb-2">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all shadow-2xs">
                            <i data-lucide="send" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                            Fast
                        </span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            DuitNow
                        </p>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                            Transfer &amp; Proxy
                        </p>
                    </div>
                </a>

                <!-- JomPAY Bill Payment Page Link -->
                <a
                    href="{{ route('customer.jompay') }}"
                    class="relative p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-slate-50/70 hover:bg-white dark:bg-slate-800/50 dark:hover:bg-slate-800 hover:border-emerald-500/40 hover:shadow-md hover:shadow-emerald-500/5 transition-all text-left group cursor-pointer active:scale-[0.98] flex flex-col justify-between min-h-[110px] sm:min-h-[125px] overflow-hidden"
                >
                    <div class="flex items-center justify-between w-full mb-2">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all shadow-2xs">
                            <i data-lucide="receipt" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                            Bills
                        </span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            JomPAY
                        </p>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                            Bills &amp; Utilities
                        </p>
                    </div>
                </a>

                <!-- DuitNow QR Page Link -->
                <a
                    href="{{ route('customer.qr-pay') }}"
                    class="relative p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-slate-50/70 hover:bg-white dark:bg-slate-800/50 dark:hover:bg-slate-800 hover:border-emerald-500/40 hover:shadow-md hover:shadow-emerald-500/5 transition-all text-left group cursor-pointer active:scale-[0.98] flex flex-col justify-between min-h-[110px] sm:min-h-[125px] overflow-hidden"
                >
                    <div class="flex items-center justify-between w-full mb-2">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all shadow-2xs">
                            <i data-lucide="qr-code" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                            Scan
                        </span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            QR Pay
                        </p>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                            Scan &amp; Pay
                        </p>
                    </div>
                </a>

                <!-- e-Statement Page Link -->
                <a
                    href="{{ route('customer.statement') }}"
                    class="relative p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-slate-50/70 hover:bg-white dark:bg-slate-800/50 dark:hover:bg-slate-800 hover:border-emerald-500/40 hover:shadow-md hover:shadow-emerald-500/5 transition-all text-left group cursor-pointer active:scale-[0.98] flex flex-col justify-between min-h-[110px] sm:min-h-[125px] overflow-hidden"
                >
                    <div class="flex items-center justify-between w-full mb-2">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all shadow-2xs">
                            <i data-lucide="file-text" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300">
                            PDF
                        </span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            e-Statement
                        </p>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                            Official Statement
                        </p>
                    </div>
                </a>
                <!-- Manage Cards & Limits Page Link -->
                <a
                    href="{{ route('customer.cards') }}"
                    class="relative p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-slate-50/70 hover:bg-white dark:bg-slate-800/50 dark:hover:bg-slate-800 hover:border-emerald-500/40 hover:shadow-md hover:shadow-emerald-500/5 transition-all text-left group cursor-pointer active:scale-[0.98] flex flex-col justify-between min-h-[110px] sm:min-h-[125px] overflow-hidden"
                >
                    <div class="flex items-center justify-between w-full mb-2">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all shadow-2xs">
                            <i data-lucide="credit-card" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-md bg-indigo-100 dark:bg-indigo-950/80 text-indigo-700 dark:text-indigo-300">
                            Cards
                        </span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            Cards &amp; Limits
                        </p>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                            Controls &amp; Freeze
                        </p>
                    </div>
                </a>
            </div>
        </section>

        <!-- SECTION 4: Activity & Device Security Enclave Status -->
        <section aria-label="Activity and Security Status" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start animate__animated animate__fadeInUp animate__faster">
            
            <!-- Left: Transaction History (2 Cols) -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs" id="transactions">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 mb-3 border-b border-slate-100 dark:border-slate-800/80 gap-3">
                    <div>
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Real-time Stream
                            </span>
                            <span class="text-[11px] sm:text-xs text-slate-400 font-medium hidden xs:inline">PayNet Clearing</span>
                        </div>
                        <h2 class="text-sm sm:text-lg lg:text-xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1">
                            Recent Activity
                        </h2>
                    </div>
                    
                    <!-- Mobile Filter Dropdown (Visible on mobile screens) -->
                    <div class="sm:hidden relative w-full mt-1">
                        <select
                            id="mobile-activity-filter"
                            onchange="window.filterTransactions(this.value)"
                            class="w-full px-3.5 py-2 rounded-xl text-xs font-bold border border-slate-200/90 dark:border-slate-700 bg-slate-50/90 dark:bg-slate-800/80 text-slate-800 dark:text-slate-100 shadow-2xs focus:outline-none focus:ring-2 focus:ring-emerald-500 appearance-none cursor-pointer"
                        >
                            <option value="all">Filter: All Transactions</option>
                            <option value="duitnow">DuitNow Transfers</option>
                            <option value="jompay">JomPAY Bills</option>
                            <option value="qr">QR Pay Transactions</option>
                            <option value="credits">Income (+RM Credit)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                        </div>
                    </div>

                    <!-- Desktop Filter Pills (Visible on sm+ screens) -->
                    <div class="hidden sm:flex items-center gap-1.5 overflow-x-auto pb-0.5 sm:pb-0 scrollbar-none" id="activity-filters">
                        <button type="button" onclick="window.filterTransactions('all', this)" class="tx-filter-btn px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 text-white shadow-2xs transition-all cursor-pointer" data-filter="all">
                            All
                        </button>
                        <button type="button" onclick="window.filterTransactions('duitnow', this)" class="tx-filter-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-filter="duitnow">
                            DuitNow
                        </button>
                        <button type="button" onclick="window.filterTransactions('jompay', this)" class="tx-filter-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-filter="jompay">
                            JomPAY
                        </button>
                        <button type="button" onclick="window.filterTransactions('qr', this)" class="tx-filter-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-filter="qr">
                            QR Pay
                        </button>
                        <button type="button" onclick="window.filterTransactions('credits', this)" class="tx-filter-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer" data-filter="credits">
                            Income (+RM)
                        </button>
                    </div>
                </div>

                <div class="divide-y divide-slate-100 dark:divide-slate-800/60" id="transaction-items-list">
                    @if(isset($recentTransactions) && $recentTransactions->isNotEmpty())
                        @foreach($recentTransactions as $tx)
                            @php
                                $typeKey = match($tx->transaction_type) {
                                    'duitnow_transfer' => 'duitnow',
                                    'jompay' => 'jompay',
                                    'qr_pay' => 'qr',
                                    default => 'other',
                                };
                                $categoryLabel = match($tx->transaction_type) {
                                    'duitnow_transfer' => 'DuitNow',
                                    'jompay' => 'JomPAY Bill',
                                    'qr_pay' => 'DuitNow QR',
                                    'deposit' => 'Direct Credit',
                                    default => ucfirst($tx->transaction_type),
                                };
                            @endphp
                            <x-banking.transaction-item
                                :title="$tx->recipient_name ?? $tx->description"
                                :category="$tx->payment_reference ?? $categoryLabel"
                                :type="$typeKey"
                                :amount="number_format($tx->amount, 2, '.', '')"
                                :isCredit="$tx->direction === 'credit'"
                                :date="$tx->created_at->diffForHumans()"
                                :status="$tx->status"
                                :reference="$tx->reference_number"
                            />
                        @endforeach
                    @else
                        <x-banking.transaction-item
                            title="PETRONAS Dagangan Berhad"
                            category="DuitNow QR"
                            type="qr"
                            amount="85.00"
                            :isCredit="false"
                            date="Today, 1:15 PM"
                            status="completed"
                            reference="RPP-20260909-082104"
                        />

                        <x-banking.transaction-item
                            title="Transfer from Sarah Binti Zulkifli"
                            category="DuitNow"
                            type="duitnow"
                            amount="450.00"
                            :isCredit="true"
                            date="Today, 10:30 AM"
                            status="completed"
                            reference="DN-MY-9921048821"
                        />

                        <x-banking.transaction-item
                            title="New Payee: Lim Wei Seng"
                            category="DuitNow Instant"
                            type="duitnow"
                            amount="1200.00"
                            :isCredit="false"
                            date="Yesterday, 8:45 PM"
                            status="cooling_off"
                            reference="COOL-HOLD-992184"
                        />

                        <x-banking.transaction-item
                            title="Tenaga Nasional Berhad"
                            category="JomPAY Bill"
                            type="jompay"
                            amount="178.40"
                            :isCredit="false"
                            date="05 Sep 2026, 4:20 PM"
                            status="completed"
                            reference="JOM-5454-99210"
                        />

                        <x-banking.transaction-item
                            title="Salary Crediting: TECHSOL CORP"
                            category="Direct Credit"
                            type="fpx"
                            amount="8500.00"
                            :isCredit="true"
                            date="28 Aug 2026, 12:05 AM"
                            status="completed"
                            reference="SAL-20260828-9901"
                        />
                    @endif
                </div>

                <!-- Link to Dedicated Full Transaction History Page -->
                <div class="pt-3 mt-1 border-t border-slate-100 dark:border-slate-800/80 text-center">
                    <a
                        href="{{ route('customer.history') }}"
                        class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 hover:border-emerald-500/30 hover:text-emerald-700 dark:hover:text-emerald-400 text-xs font-bold text-slate-700 dark:text-slate-200 transition-all active:scale-[0.99] group shadow-2xs"
                    >
                        <span>View All Transactions &amp; Statements</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform text-slate-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400"></i>
                    </a>
                </div>
            </div>

            <!-- Right: Bound Enclave Security Status & Help -->
            <div class="space-y-4">
                
                <!-- Bound Enclave Device -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-emerald-500/40 transition-colors">
                    <div class="flex items-center justify-between pb-3.5 mb-3.5 border-b border-slate-100 dark:border-slate-800/80">
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] sm:text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                1:1 Device Bound
                            </span>
                            <h3 class="text-sm sm:text-base font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 flex items-center gap-1.5">
                                <i data-lucide="smartphone" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-emerald-600"></i>
                                Security Enclave
                            </h3>
                        </div>
                    </div>

                    <div class="p-3.5 rounded-xl sm:rounded-2xl bg-slate-50/70 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 space-y-2 text-xs">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium">Model</span>
                            <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $customer->bound_device_name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium">Key Security</span>
                            <span class="font-mono text-[11px] text-emerald-600 font-bold">ECDSA P-256 Validated</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium">SMS OTP Status</span>
                            <span class="font-bold text-rose-600 text-[11px]">Eliminated (Compliant)</span>
                        </div>
                    </div>

                    <div class="mt-3.5 text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                        <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-500 shrink-0"></i>
                        <span>12h cooling-off enforced on new third-party payees.</span>
                    </div>
                </div>

                <!-- PIDM & Security Protection Note -->
                <div class="p-4 rounded-2xl sm:rounded-3xl bg-emerald-500/5 border border-emerald-500/15 text-xs space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-emerald-800 dark:text-emerald-300 text-xs">
                        <i data-lucide="shield" class="w-4 h-4 text-emerald-600"></i>
                        <span class="font-black tracking-wide">PIDM Protected Member</span>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                        Eligible deposits are protected by PIDM up to RM250,000 for each depositor.
                    </p>
                </div>

            </div>

        </section>

    </div>

    <!-- Emergency Kill Switch Confirmation Dialog -->
    <x-ui.alert-dialog
        id="kill-switch-dialog"
        type="danger"
        size="md"
        title="Activate Emergency Kill Switch?"
        confirm="true"
        confirmText="Yes, Freeze Account"
        cancelText="Cancel"
        onConfirm="window.showAppAlert({ title: 'Emergency Freeze Engaged', subtitle: 'National Scam Response Center (NSRC)', message: 'All outward PayNet transfers and card authorizations have been frozen immediately. Contact 997 or visit a branch to reactivate.', type: 'danger', onConfirm: function() { window.location.reload(); } });"
    >
        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-3">
            If you suspect fraud, phone loss, or unauthorized activity, activating the <strong>Emergency Kill Switch</strong> will immediately:
        </p>
        <ul class="text-xs space-y-1.5 list-disc list-inside text-rose-600 dark:text-rose-400 font-medium mb-3">
            <li>Freeze all outgoing DuitNow, FPX, and JomPAY transfers</li>
            <li>Instantly lock physical and virtual Debit cards</li>
            <li>Terminate all active web and mobile device sessions</li>
        </ul>
        <p class="text-[11px] text-slate-500 dark:text-slate-400">
            Reactivation requires contacting customer service or branch identity verification.
        </p>
    </x-ui.alert-dialog>

    <!-- ======================================================================
         1. Transaction Details & Receipt Slide-Over Drawer
         ====================================================================== -->
    <div
        id="tx-detail-modal"
        class="fixed inset-0 z-50 overflow-y-auto hidden"
        aria-labelledby="tx-drawer-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-all duration-300" onclick="window.closeModal('tx-detail-modal')"></div>

        <div class="flex min-h-full items-end justify-center p-0 text-center sm:items-center sm:p-4 sm:pb-8">
            <div class="modal-bottom-sheet relative w-full transform overflow-hidden rounded-t-[2.25rem] sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl text-left shadow-2xl shadow-slate-950/40 sm:max-w-md border border-slate-200/80 dark:border-slate-800 animate__animated animate__fadeInUp sm:animate__zoomIn animate__faster transition-all duration-300">
                
                <div class="sm:hidden w-12 h-1.5 bg-slate-300 dark:bg-slate-700 rounded-full mx-auto mt-3.5 mb-1 cursor-pointer" onclick="window.closeModal('tx-detail-modal')"></div>

                <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 id="tx-drawer-title" class="text-base font-bold text-slate-900 dark:text-slate-100">Transaction Receipt</h3>
                    <button type="button" onclick="window.closeModal('tx-detail-modal')" class="p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <div class="p-5 sm:p-6 space-y-4">
                    <!-- Status & Amount Hero -->
                    <div class="text-center pb-2">
                        <div id="tx-drawer-badge-icon" class="w-12 h-12 rounded-full mx-auto flex items-center justify-center bg-emerald-100 dark:bg-emerald-950 text-emerald-600 mb-2">
                            <i data-lucide="check-circle" class="w-6 h-6"></i>
                        </div>
                        <h4 id="tx-drawer-amount" class="text-2xl font-black text-slate-900 dark:text-slate-100">-RM 85.00</h4>
                        <p id="tx-drawer-status" class="text-xs font-bold text-emerald-600 mt-0.5">Successful Payment</p>
                        <p id="tx-drawer-title-sub" class="text-xs text-slate-500 dark:text-slate-400 mt-1">PETRONAS Dagangan Berhad</p>
                    </div>

                    <!-- Meta Details Table -->
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-800 space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Payment Channel</span>
                            <span id="tx-drawer-category" class="font-bold text-slate-700 dark:text-slate-200">DuitNow QR</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Reference No.</span>
                            <span id="tx-drawer-ref" class="font-mono text-[11px] font-semibold text-slate-700 dark:text-slate-200">RPP-20260909-082104</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Date &amp; Time</span>
                            <span id="tx-drawer-date" class="font-medium text-slate-700 dark:text-slate-200">Today, 1:15 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Source Account</span>
                            <span class="font-medium text-slate-700 dark:text-slate-200">Savings Account-i (•••• 5678)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Service Charge</span>
                            <span class="font-bold text-emerald-600">RM 0.00 (Free)</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="grid grid-cols-2 gap-2.5 pt-2">
                        <button type="button" onclick="window.showAppAlert({ title: 'e-Receipt Downloaded', subtitle: 'PayNet Cleared Record', message: 'Signed official digital PDF receipt has been saved to your downloads folder.', type: 'success' });" class="py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 font-bold text-xs text-slate-700 dark:text-slate-200 flex items-center justify-center gap-1.5 transition-all cursor-pointer">
                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                            Download PDF
                        </button>
                        <a id="tx-drawer-full-link" href="#" class="py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-1.5 transition-all shadow-xs">
                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                            Full Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================================
         2. Card Management & Security Controls Modal
         ====================================================================== -->
    <div
        id="card-controls-modal"
        class="fixed inset-0 z-50 overflow-y-auto hidden"
        aria-labelledby="card-controls-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-all duration-300" onclick="window.closeModal('card-controls-modal')"></div>

        <div class="flex min-h-full items-end justify-center p-0 text-center sm:items-center sm:p-4 sm:pb-8">
            <div class="modal-bottom-sheet relative w-full transform overflow-hidden rounded-t-[2.25rem] sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl text-left shadow-2xl shadow-slate-950/40 sm:max-w-lg border border-slate-200/80 dark:border-slate-800 animate__animated animate__fadeInUp sm:animate__zoomIn animate__faster transition-all duration-300">
                
                <div class="sm:hidden w-12 h-1.5 bg-slate-300 dark:bg-slate-700 rounded-full mx-auto mt-3.5 mb-1 cursor-pointer" onclick="window.closeModal('card-controls-modal')"></div>

                <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                            <i data-lucide="shield" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 id="card-controls-title" class="text-base sm:text-lg font-bold text-slate-900 dark:text-slate-100">Card Controls &amp; Limits</h3>
                            <p class="text-[11px] text-slate-400 dark:text-slate-500" id="card-modal-subtitle">Debit Mastercard-i (•••• 9012)</p>
                        </div>
                    </div>
                    <button type="button" onclick="window.closeModal('card-controls-modal')" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <div class="p-5 sm:p-6 space-y-4">
                    <!-- Instant Freeze Card Toggle (Hero) -->
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/80 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div id="card-freeze-icon" class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center">
                                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 dark:text-slate-100">Card Status: <span id="card-freeze-text" class="text-emerald-600">Active</span></h4>
                                <p class="text-[10px] text-slate-400 dark:text-slate-500">Temporarily freeze this card anytime if misplaced</p>
                            </div>
                        </div>
                        <button type="button" id="card-freeze-btn" onclick="window.toggleCardFreeze()" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-rose-50 hover:text-rose-600 transition-all cursor-pointer">
                            Freeze
                        </button>
                    </div>

                    <!-- Toggles: Overseas, Online, Contactless -->
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between p-3 rounded-xl border border-slate-200/70 dark:border-slate-800">
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Overseas / International Usage</p>
                                <p class="text-[10px] text-slate-400">Allow card transactions outside Malaysia</p>
                            </div>
                            <input type="checkbox" id="card-toggle-overseas" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-xl border border-slate-200/70 dark:border-slate-800">
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Online &amp; E-Commerce Purchases</p>
                                <p class="text-[10px] text-slate-400">Allow payments on web, apps, and Shopee/Lazada</p>
                            </div>
                            <input type="checkbox" id="card-toggle-online" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-xl border border-slate-200/70 dark:border-slate-800">
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Contactless (PayWave / PayPass)</p>
                                <p class="text-[10px] text-slate-400">Tap-and-pay for purchases up to RM250</p>
                            </div>
                            <input type="checkbox" id="card-toggle-contactless" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                        </div>
                    </div>

                    <!-- Daily Limits Sliders -->
                    <div class="space-y-3 pt-1">
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-slate-700 dark:text-slate-300">Daily ATM Withdrawal Limit</span>
                                <span id="atm-limit-label" class="text-emerald-600 dark:text-emerald-400">RM 3,000</span>
                            </div>
                            <input type="range" id="atm-limit-range" min="1000" max="10000" step="500" value="3000" oninput="document.getElementById('atm-limit-label').textContent = 'RM ' + parseInt(this.value).toLocaleString()" class="w-full accent-emerald-600 cursor-pointer">
                            <div class="flex justify-between text-[9px] text-slate-400">
                                <span>RM 1,000</span>
                                <span>RM 10,000</span>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-slate-700 dark:text-slate-300">Daily Purchase / POS Limit</span>
                                <span id="purchase-limit-label" class="text-emerald-600 dark:text-emerald-400">RM 5,000</span>
                            </div>
                            <input type="range" id="purchase-limit-range" min="1000" max="20000" step="1000" value="5000" oninput="document.getElementById('purchase-limit-label').textContent = 'RM ' + parseInt(this.value).toLocaleString()" class="w-full accent-emerald-600 cursor-pointer">
                            <div class="flex justify-between text-[9px] text-slate-400">
                                <span>RM 1,000</span>
                                <span>RM 20,000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Save changes button -->
                    <button type="button" onclick="window.saveCardSettings()" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">
                        Save Card Security Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================================
         JavaScript Controllers for all Interactive Modals
         ====================================================================== -->
    <script>
    (function() {
        // --- 1. RECENT ACTIVITY FILTERS & RECEIPT DRAWER ---
        window.filterTransactions = function(category, btn) {
            // Synchronize mobile select dropdown value
            const mobileSelect = document.getElementById('mobile-activity-filter');
            if (mobileSelect && mobileSelect.value !== category) {
                mobileSelect.value = category;
            }

            // Synchronize desktop filter pills
            document.querySelectorAll('.tx-filter-btn').forEach(b => {
                const bFilter = b.getAttribute('data-filter');
                if (bFilter === category) {
                    b.className = 'tx-filter-btn px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 text-white shadow-2xs transition-all cursor-pointer';
                } else {
                    b.className = 'tx-filter-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-50 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer';
                }
            });

            const items = document.querySelectorAll('.transaction-row');
            items.forEach(item => {
                const itemType = item.getAttribute('data-type');
                const isCredit = item.getAttribute('data-credit') === '1';

                if (category === 'all') {
                    item.classList.remove('hidden');
                    item.classList.add('animate__animated', 'animate__fadeIn', 'animate__faster');
                } else if (category === 'credits') {
                    const match = isCredit;
                    item.classList.toggle('hidden', !match);
                    if (match) item.classList.add('animate__animated', 'animate__fadeIn', 'animate__faster');
                } else {
                    const match = itemType === category;
                    item.classList.toggle('hidden', !match);
                    if (match) item.classList.add('animate__animated', 'animate__fadeIn', 'animate__faster');
                }
            });
        };

        window.showTransactionReceipt = function(data) {
            document.getElementById('tx-drawer-amount').textContent = (data.isCredit ? '+' : '-') + 'RM ' + parseFloat(data.amount).toFixed(2);
            document.getElementById('tx-drawer-amount').className = 'text-2xl font-black ' + (data.isCredit ? 'text-emerald-600' : 'text-slate-900 dark:text-slate-100');
            document.getElementById('tx-drawer-title-sub').textContent = data.title;
            document.getElementById('tx-drawer-category').textContent = data.category;
            document.getElementById('tx-drawer-ref').textContent = data.id || 'RPP-2026-N/A';
            document.getElementById('tx-drawer-date').textContent = data.date;
            document.getElementById('tx-drawer-full-link').setAttribute('href', data.detailUrl);

            window.openModal('tx-detail-modal');
            if (window.lucide) window.lucide.createIcons();
        };

        // --- 2. CARD CONTROLS MODAL LOGIC ---
        let isCardFrozen = false;
        window.openCardControls = function(cardType) {
            const subtitle = document.getElementById('card-modal-subtitle');
            if (cardType === 'visa') {
                subtitle.textContent = 'Virtual Visa Infinite-i (•••• 8842)';
                document.getElementById('atm-limit-range').value = 5000;
                document.getElementById('purchase-limit-range').value = 15000;
                document.getElementById('atm-limit-label').textContent = 'RM 5,000';
                document.getElementById('purchase-limit-label').textContent = 'RM 15,000';
            } else if (cardType === 'world') {
                subtitle.textContent = 'World Mastercard-i Metal (•••• 1009)';
                document.getElementById('atm-limit-range').value = 10000;
                document.getElementById('purchase-limit-range').value = 20000;
                document.getElementById('atm-limit-label').textContent = 'RM 10,000';
                document.getElementById('purchase-limit-label').textContent = 'RM 20,000';
            } else {
                subtitle.textContent = 'Debit Mastercard-i (•••• 9012)';
                document.getElementById('atm-limit-range').value = 3000;
                document.getElementById('purchase-limit-range').value = 5000;
                document.getElementById('atm-limit-label').textContent = 'RM 3,000';
                document.getElementById('purchase-limit-label').textContent = 'RM 5,000';
            }

            window.openModal('card-controls-modal');
            if (window.lucide) window.lucide.createIcons();
        };

        window.toggleCardFreeze = function() {
            isCardFrozen = !isCardFrozen;
            const statusText = document.getElementById('card-freeze-text');
            const freezeBtn = document.getElementById('card-freeze-btn');
            const icon = document.getElementById('card-freeze-icon');

            if (isCardFrozen) {
                statusText.textContent = 'Frozen';
                statusText.className = 'text-rose-600';
                freezeBtn.textContent = 'Unfreeze';
                freezeBtn.className = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-600 text-white hover:bg-emerald-700 transition-all cursor-pointer';
                icon.className = 'w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-950 text-rose-600 flex items-center justify-center';
                alert('Card has been frozen immediately. Authorizations will be declined.');
            } else {
                statusText.textContent = 'Active';
                statusText.className = 'text-emerald-600';
                freezeBtn.textContent = 'Freeze';
                freezeBtn.className = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-rose-50 hover:text-rose-600 transition-all cursor-pointer';
                icon.className = 'w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center';
                alert('Card unfreezed. Transactions are active.');
            }
        };

        window.saveCardSettings = function() {
            const atm = document.getElementById('atm-limit-label').textContent;
            const purchase = document.getElementById('purchase-limit-label').textContent;
            window.closeModal('card-controls-modal');
            alert('Card security settings updated successfully!\nATM Limit: ' + atm + '\nPurchase Limit: ' + purchase);
        };
    })();
    </script>

    <style>
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

</x-layout.customer>
