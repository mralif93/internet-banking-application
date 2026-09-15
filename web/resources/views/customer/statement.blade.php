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

<x-layout.customer title="Official e-Statement — BankFlow MY" activeNav="statement">
    <div class="space-y-6 sm:space-y-8">

        <!-- STANDARD PAGE HEADER (Matching Dashboard Style) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Digital e-Statement
                        </span>
                        <span class="text-[10px] sm:text-xs font-mono text-slate-500 dark:text-slate-400">
                            BNM Standard
                        </span>
                    </div>

                    <h1 class="text-lg sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        Official e-Statement
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">Cryptographically Signed</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            Verified Bank Seal
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 pt-2.5 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0 w-full sm:w-auto">
                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all active:scale-[0.98] shadow-2xs group"
                    >
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-slate-500"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter & Statement Customizer Card -->
        <div class="rounded-2xl sm:rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-4 sm:p-5 shadow-sm space-y-4 animate__animated animate__fadeInUp animate__faster">
            <div class="flex items-center gap-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <i data-lucide="file-text" class="w-4.5 h-4.5"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm sm:text-base font-black text-slate-900 dark:text-slate-50 tracking-tight truncate">Generate &amp; Download e-Statement</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Cryptographically signed official bank statement</p>
                </div>
            </div>

            <!-- Configuration Filters Grid (Compact Modern Dropdowns) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Account</label>
                    <div class="relative">
                        <select
                            id="stmt-page-account"
                            onchange="window.updatePageStatement()"
                            class="w-full py-2 pl-3 pr-8 text-xs rounded-xl border border-slate-200/80 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 hover:bg-slate-100/70 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-200 font-semibold focus:ring-1.5 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none appearance-none cursor-pointer transition-colors"
                        >
                            <option value="savings">Savings Account-i (•••• 5678)</option>
                            <option value="current">Current Account-i (•••• 9901)</option>
                            <option value="card">Visa Infinite-i (•••• 8842)</option>
                        </select>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Statement Cycle</label>
                    <div class="relative">
                        <select
                            id="stmt-page-period"
                            onchange="window.updatePageStatement()"
                            class="w-full py-2 pl-3 pr-8 text-xs rounded-xl border border-slate-200/80 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 hover:bg-slate-100/70 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-200 font-semibold focus:ring-1.5 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none appearance-none cursor-pointer transition-colors"
                        >
                            <option value="2026-09" {{ ($year ?? 2026) == 2026 && ($month ?? 9) == 9 ? 'selected' : '' }}>September 2026 (Current Cycle)</option>
                            <option value="2026-08" {{ ($year ?? 2026) == 2026 && ($month ?? 9) == 8 ? 'selected' : '' }}>August 2026 (01 Aug - 31 Aug)</option>
                            <option value="2026-07" {{ ($year ?? 2026) == 2026 && ($month ?? 9) == 7 ? 'selected' : '' }}>July 2026 (01 Jul - 31 Jul)</option>
                            <option value="2026-06" {{ ($year ?? 2026) == 2026 && ($month ?? 9) == 6 ? 'selected' : '' }}>June 2026 (01 Jun - 30 Jun)</option>
                            <option value="2026-05" {{ ($year ?? 2026) == 2026 && ($month ?? 9) == 5 ? 'selected' : '' }}>May 2026 (01 May - 31 May)</option>
                        </select>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Export Format</label>
                    <div class="relative">
                        <select
                            id="stmt-page-format"
                            class="w-full py-2 pl-3 pr-8 text-xs rounded-xl border border-slate-200/80 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 hover:bg-slate-100/70 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-200 font-semibold focus:ring-1.5 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none appearance-none cursor-pointer transition-colors"
                        >
                            <option value="pdf">Official Signed PDF</option>
                            <option value="csv">CSV Spreadsheet (Excel)</option>
                        </select>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <!-- Action Buttons: Responsive Full Width Grid on Mobile -->
            <div class="grid grid-cols-2 sm:flex sm:items-center sm:justify-end gap-2 pt-2.5 border-t border-slate-100 dark:border-slate-800">
                <button
                    type="button"
                    onclick="window.printStatement()"
                    class="w-full sm:w-auto px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-semibold flex items-center justify-center gap-1.5 transition-all cursor-pointer shadow-2xs active:scale-[0.98]"
                >
                    <i data-lucide="printer" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                    <span>Print</span>
                </button>

                <button
                    type="button"
                    onclick="window.downloadStatement()"
                    class="w-full sm:w-auto px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-xs shadow-emerald-600/25 transition-all cursor-pointer active:scale-[0.98]"
                >
                    <i data-lucide="download" class="w-3.5 h-3.5 shrink-0"></i>
                    <span class="truncate">Download e-Statement</span>
                </button>
            </div>
        </div>

        <!-- Statement Document Paper Preview -->
        <div class="rounded-2xl sm:rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-4 sm:p-7 lg:p-8 shadow-xl shadow-slate-950/5 space-y-5 sm:space-y-6 animate__animated animate__fadeInUp animate__faster">

            <!-- Bank Letterhead -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 sm:pb-5 border-b-2 border-slate-900 dark:border-slate-100 gap-3.5 sm:gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-base shadow-sm shrink-0">
                        BF
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-sm sm:text-base font-black text-slate-900 dark:text-slate-50 tracking-tight leading-tight">BANKFLOW MALAYSIA BERHAD</h3>
                        <p class="text-[10px] text-slate-400 mt-0.5 leading-snug">Reg No: 202601004921 (142099-M) &bull; Licensed Islamic Commercial Bank</p>
                    </div>
                </div>

                <div class="flex sm:flex-col sm:items-end justify-between items-center text-xs pt-1 sm:pt-0 border-t border-slate-100 dark:border-slate-800 sm:border-0">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-bold text-[10px] border border-emerald-300 dark:border-emerald-800">
                        <i data-lucide="shield-check" class="w-3 h-3"></i> Certified Official Copy
                    </span>
                    <p class="text-[10px] font-mono text-slate-400 sm:mt-1">UUID: BF-MY-STMT-2026-98124</p>
                </div>
            </div>

            <!-- Customer & Statement Metadata Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs">
                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800 space-y-1 shadow-2xs">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Account Holder Details</span>
                    <p class="font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm">{{ $customer->name }}</p>
                    <p class="text-slate-500 font-mono text-[11px]" id="stmt-disp-account">{{ $account->account_name ?? $customer->account_type }}: {{ $account->account_number ?? $customer->account_number }}</p>
                    <p class="text-slate-400 text-[10px] pt-0.5">Registered Phone: {{ $customer->phone_number }}</p>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800 space-y-1 sm:text-right shadow-2xs">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Statement Period</span>
                    <p class="font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm" id="stmt-disp-period">{{ $statement['month_name'] ?? 'September 2026' }}</p>
                    <p class="text-slate-500 text-[11px]">Currency: Malaysian Ringgit (MYR)</p>
                    <p class="text-emerald-600 dark:text-emerald-400 font-bold text-[10px] pt-0.5">PIDM Protected up to RM250,000</p>
                </div>
            </div>

            <!-- Account Summary Metrics: Standardized Uniform Metric Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 sm:gap-3">
                <!-- Opening Balance -->
                <div class="p-3 sm:p-3.5 rounded-xl sm:rounded-2xl bg-slate-50/90 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800 flex sm:flex-col justify-between sm:justify-start items-center sm:items-start transition-all shadow-2xs">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-slate-200/70 dark:bg-slate-700/60 flex items-center justify-center text-slate-600 dark:text-slate-300">
                            <i data-lucide="wallet" class="w-3.5 h-3.5"></i>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Opening Balance</span>
                    </div>
                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 sm:mt-2 font-mono">RM {{ number_format($statement['opening_balance'] ?? 19450.00, 2) }}</p>
                </div>

                <!-- Total Credits -->
                <div class="p-3 sm:p-3.5 rounded-xl sm:rounded-2xl bg-slate-50/90 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800 flex sm:flex-col justify-between sm:justify-start items-center sm:items-start transition-all shadow-2xs">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-slate-200/70 dark:bg-slate-700/60 flex items-center justify-center text-slate-600 dark:text-slate-300">
                            <i data-lucide="arrow-down-left" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Credits</span>
                    </div>
                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 sm:mt-2 font-mono">+RM {{ number_format($statement['total_credits'] ?? 8950.00, 2) }}</p>
                </div>

                <!-- Closing Balance -->
                <div class="p-3 sm:p-3.5 rounded-xl sm:rounded-2xl bg-slate-50/90 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800 flex sm:flex-col justify-between sm:justify-start items-center sm:items-start transition-all shadow-2xs">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-slate-200/70 dark:bg-slate-700/60 flex items-center justify-center text-slate-600 dark:text-slate-300">
                            <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Closing Balance</span>
                    </div>
                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 sm:mt-2 font-mono">RM {{ number_format($statement['closing_balance'] ?? 24850.50, 2) }}</p>
                </div>
            </div>

            <!-- Statement Line Item Ledger: Standard Card Container with Consistent Border -->
            <div class="rounded-xl sm:rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900/70 overflow-hidden shadow-2xs">
                <div class="p-3 sm:p-4 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                    <div class="flex items-center gap-2">
                        <i data-lucide="receipt" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i>
                        <span class="text-xs font-bold text-slate-900 dark:text-slate-100">Transaction Entries</span>
                    </div>
                    <span class="text-[10px] font-mono text-slate-400">{{ isset($statement['transactions']) ? $statement['transactions']->count() : 4 }} records</span>
                </div>

                <div class="divide-y divide-slate-100 dark:divide-slate-800/70 px-3 sm:px-4">
                    @if(isset($statement['transactions']) && $statement['transactions']->isNotEmpty())
                        @foreach($statement['transactions'] as $stTx)
                            <div class="py-3 sm:py-3.5 flex items-center justify-between gap-3 hover:bg-slate-50/70 dark:hover:bg-slate-800/40 px-1 sm:px-2 rounded-xl transition-colors">
                                <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 flex-1">
                                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 {{ $stTx->direction === 'credit' ? 'bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-slate-100/90 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-slate-700/60' }} shadow-2xs">
                                        <i data-lucide="{{ $stTx->direction === 'credit' ? 'arrow-down-left' : 'arrow-up-right' }}" class="w-4 h-4 sm:w-4.5 sm:h-4.5 stroke-[2.5] {{ $stTx->direction === 'credit' ? 'text-emerald-600' : 'text-rose-500' }}"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                                            <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-snug break-words">{{ $stTx->recipient_name ?? $stTx->description }}</p>
                                            <span class="text-[9px] sm:text-[10px] font-mono font-bold px-1.5 py-0.5 rounded-md border shrink-0 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200/80 dark:border-slate-700">{{ $stTx->reference_number }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 mt-1 flex-wrap">
                                            <span class="text-[9px] sm:text-[10px] font-extrabold px-1.5 py-0.5 rounded-md border shrink-0 bg-purple-50 text-purple-700 dark:bg-purple-950/60 dark:text-purple-300 border-purple-200/60 dark:border-purple-900/50">{{ ucfirst(str_replace('_', ' ', $stTx->transaction_type)) }}</span>
                                            <span class="text-slate-300 dark:text-slate-700">•</span>
                                            <span>{{ $stTx->created_at->format('d M Y, h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right shrink-0 pl-2">
                                    <p class="text-xs sm:text-sm font-black {{ $stTx->direction === 'credit' ? 'text-emerald-600' : 'text-rose-600' }} font-mono tracking-tight">{{ $stTx->direction === 'credit' ? '+' : '-' }}RM {{ number_format($stTx->amount, 2) }}</p>
                                    <p class="text-[10px] sm:text-[11px] font-mono text-slate-400 mt-0.5">Bal: <span class="font-bold text-slate-700 dark:text-slate-300">RM {{ number_format($stTx->balance_after, 2) }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <!-- Tx 1: PETRONAS -->
                    <div class="py-3 sm:py-3.5 flex items-center justify-between gap-3 hover:bg-slate-50/70 dark:hover:bg-slate-800/40 px-1 sm:px-2 rounded-xl transition-colors">
                        <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 flex-1">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 bg-slate-100/90 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-slate-700/60 shadow-2xs">
                                <i data-lucide="arrow-up-right" class="w-4 h-4 sm:w-4.5 sm:h-4.5 stroke-[2.5] text-rose-500"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-snug break-words">PETRONAS Dagangan Berhad</p>
                                    <span class="text-[9px] sm:text-[10px] font-mono font-bold px-1.5 py-0.5 rounded-md border shrink-0 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200/80 dark:border-slate-700">RPP-20260909-082104</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 mt-1 flex-wrap">
                                    <span class="text-[9px] sm:text-[10px] font-extrabold px-1.5 py-0.5 rounded-md border shrink-0 bg-purple-50 text-purple-700 dark:bg-purple-950/60 dark:text-purple-300 border-purple-200/60 dark:border-purple-900/50">DuitNow QR</span>
                                    <span class="text-slate-300 dark:text-slate-700">•</span>
                                    <span>10 Sep 2026</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-xs sm:text-sm font-black text-rose-600 font-mono tracking-tight">-RM 85.00</p>
                            <p class="text-[10px] sm:text-[11px] font-mono text-slate-400 mt-0.5">Bal: <span class="font-bold text-slate-700 dark:text-slate-300">RM 24,850.50</span></p>
                        </div>
                    </div>

                    <!-- Tx 2: Transfer from Sarah -->
                    <div class="py-3 sm:py-3.5 flex items-center justify-between gap-3 hover:bg-slate-50/70 dark:hover:bg-slate-800/40 px-1 sm:px-2 rounded-xl transition-colors">
                        <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 flex-1">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 shadow-2xs">
                                <i data-lucide="arrow-down-left" class="w-4 h-4 sm:w-4.5 sm:h-4.5 stroke-[2.5]"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-snug break-words">Transfer from Sarah Binti Zulkifli</p>
                                    <span class="text-[9px] sm:text-[10px] font-mono font-bold px-1.5 py-0.5 rounded-md border shrink-0 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200/80 dark:border-slate-700">DN-MY-9921048821</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 mt-1 flex-wrap">
                                    <span class="text-[9px] sm:text-[10px] font-extrabold px-1.5 py-0.5 rounded-md border shrink-0 bg-pink-50 text-pink-700 dark:bg-pink-950/60 dark:text-pink-300 border-pink-200/60 dark:border-pink-900/50">DuitNow</span>
                                    <span class="text-slate-300 dark:text-slate-700">•</span>
                                    <span>10 Sep 2026</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-xs sm:text-sm font-black text-emerald-600 font-mono tracking-tight">+RM 450.00</p>
                            <p class="text-[10px] sm:text-[11px] font-mono text-slate-400 mt-0.5">Bal: <span class="font-bold text-slate-700 dark:text-slate-300">RM 24,935.50</span></p>
                        </div>
                    </div>

                    <!-- Tx 3: TNB -->
                    <div class="py-3 sm:py-3.5 flex items-center justify-between gap-3 hover:bg-slate-50/70 dark:hover:bg-slate-800/40 px-1 sm:px-2 rounded-xl transition-colors">
                        <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 flex-1">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 bg-slate-100/90 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-slate-700/60 shadow-2xs">
                                <i data-lucide="arrow-up-right" class="w-4 h-4 stroke-[2.5] text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-snug break-words">Tenaga Nasional Berhad (TNB)</p>
                                    <span class="text-[9px] sm:text-[10px] font-mono font-bold px-1.5 py-0.5 rounded-md border shrink-0 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200/80 dark:border-slate-700">JOM-5454-99210</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 mt-1 flex-wrap">
                                    <span class="text-[9px] sm:text-[10px] font-extrabold px-1.5 py-0.5 rounded-md border shrink-0 bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200/60 dark:border-amber-900/50">JomPAY</span>
                                    <span class="text-slate-300 dark:text-slate-700">•</span>
                                    <span>05 Sep 2026</span>
                                    <span class="text-slate-300 dark:text-slate-700">•</span>
                                    <span class="font-mono text-[9px] sm:text-[10px] text-slate-400">Ref: 220194881021</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-xs sm:text-sm font-black text-rose-600 font-mono tracking-tight">-RM 178.40</p>
                            <p class="text-[10px] sm:text-[11px] font-mono text-slate-400 mt-0.5">Bal: <span class="font-bold text-slate-700 dark:text-slate-300">RM 24,485.50</span></p>
                        </div>
                    </div>

                    <!-- Tx 4: Salary TECHSOL -->
                    <div class="py-3 sm:py-3.5 flex items-center justify-between gap-3 hover:bg-slate-50/70 dark:hover:bg-slate-800/40 px-1 sm:px-2 rounded-xl transition-colors">
                        <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 flex-1">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 shadow-2xs">
                                <i data-lucide="arrow-down-left" class="w-4 h-4 sm:w-4.5 sm:h-4.5 stroke-[2.5]"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-snug break-words">Salary Crediting: TECHSOL CORP</p>
                                    <span class="text-[9px] sm:text-[10px] font-mono font-bold px-1.5 py-0.5 rounded-md border shrink-0 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200/80 dark:border-slate-700">PAYROLL-SAL-202608</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 mt-1 flex-wrap">
                                    <span class="text-[9px] sm:text-[10px] font-extrabold px-1.5 py-0.5 rounded-md border shrink-0 bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300 border-blue-200/60 dark:border-blue-900/50">Direct Credit</span>
                                    <span class="text-slate-300 dark:text-slate-700">•</span>
                                    <span>28 Aug 2026</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-xs sm:text-sm font-black text-emerald-600 font-mono tracking-tight">+RM 8,500.00</p>
                            <p class="text-[10px] sm:text-[11px] font-mono text-slate-400 mt-0.5">Bal: <span class="font-bold text-slate-700 dark:text-slate-300">RM 24,663.90</span></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Verification & Digital Seal Footer -->
            <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-400 gap-2">
                <div class="flex items-center gap-2">
                    <i data-lucide="award" class="w-4 h-4 text-blue-500"></i>
                    <span>This statement is computer generated and requires no physical signature. Verified via BankFlow PKI.</span>
                </div>
                <span class="font-mono">Page 1 of 1</span>
            </div>

        </div>

    </div>

    <script>
    (function() {
        window.updatePageStatement = function() {
            const periodVal = document.getElementById('stmt-page-period').value;
            if (periodVal) {
                const parts = periodVal.split('-');
                const year = parts[0];
                const month = parts[1];
                window.location.href = `{{ route('customer.statement') }}?year=${year}&month=${month}`;
            }
        };

        window.downloadStatement = function() {
            const periodVal = document.getElementById('stmt-page-period').value;
            const format = document.getElementById('stmt-page-format').value;
            let year = 2026, month = 9;
            if (periodVal) {
                const parts = periodVal.split('-');
                year = parts[0];
                month = parts[1];
            }

            if (format === 'csv') {
                window.location.href = `{{ route('customer.statement.export') }}?year=${year}&month=${month}&format=csv`;
            } else {
                // Open official print / PDF certified certificate view
                window.open(`{{ route('customer.statement.export') }}?year=${year}&month=${month}&format=pdf&autoprint=1`, '_blank');
            }
        };

        window.printStatement = function() {
            const periodVal = document.getElementById('stmt-page-period').value;
            let year = 2026, month = 9;
            if (periodVal) {
                const parts = periodVal.split('-');
                year = parts[0];
                month = parts[1];
            }
            window.open(`{{ route('customer.statement.export') }}?year=${year}&month=${month}&format=pdf&autoprint=1`, '_blank');
        };
    })();
    </script>

</x-layout.customer>
