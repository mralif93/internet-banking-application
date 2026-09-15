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

<x-layout.customer title="DuitNow Instant Transfer — BankFlow MY" activeNav="transfer">
    <div class="space-y-6 sm:space-y-8">

        <!-- STANDARD PAGE HEADER (Matching Dashboard Style) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            PayNet DuitNow 2.0
                        </span>
                        <span class="text-[11px] sm:text-xs font-mono text-slate-500 dark:text-slate-400">
                            Instant Interbank
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        DuitNow Instant Transfer
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">From: {{ $customer->account_type }}</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            Hardware Enclave Protected
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0">
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

        <!-- Success Receipt Banner (Only shown once completed) -->
        <div id="transfer-success-card" class="hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xl p-6 sm:p-8 space-y-6 animate__animated animate__fadeIn">
            <div class="text-center space-y-2">
                <div class="mx-auto w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center ring-8 ring-emerald-50 dark:ring-emerald-950/30 animate__animated animate__bounceIn">
                    <i data-lucide="check" class="w-8 h-8 stroke-[3]"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-slate-50 tracking-tight">Transfer Completed!</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Funds transferred instantly via PayNet Real-time Retail Payments Platform</p>
            </div>

            <!-- Official Receipt Card -->
            <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/80 space-y-4 text-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-200/70 dark:border-slate-700/70">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="font-black tracking-wider text-[11px] text-slate-800 dark:text-slate-200 uppercase">BankFlow MY Official Receipt</span>
                    </div>
                    <span class="text-[10px] font-mono text-slate-400" id="receipt-timestamp">10 Sep 2026, 2:45 PM</span>
                </div>

                <div class="text-center py-2">
                    <span class="text-xs text-slate-400 font-medium">Amount Transferred</span>
                    <h3 id="receipt-amount" class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight mt-0.5">RM 0.00</h3>
                </div>

                <div class="divide-y divide-slate-200/50 dark:divide-slate-700/50 space-y-2.5 pt-2">
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Reference Number</span>
                        <span id="receipt-ref-no" class="font-mono font-bold text-slate-900 dark:text-slate-100">RPP-20260910-882104</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Recipient Name</span>
                        <span id="receipt-recipient-name" class="font-bold text-slate-900 dark:text-slate-100">Sarah Binti Zulkifli</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Recipient ID / Bank</span>
                        <span id="receipt-recipient-proxy" class="font-medium text-slate-700 dark:text-slate-300">Maybank (012-8821941)</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Sender Account</span>
                        <span class="font-medium text-slate-700 dark:text-slate-300">{{ $customer->account_type }} (•••• 5678)</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Recipient Reference</span>
                        <span id="receipt-reference" class="font-semibold text-slate-800 dark:text-slate-200">—</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Security Signing</span>
                        <span class="font-mono text-[11px] text-emerald-600 dark:text-emerald-400">ECDSA P-256 Hardware Enclave</span>
                    </div>
                </div>
            </div>

            <!-- Receipt Actions -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 pt-2">
                <button
                    type="button"
                    onclick="window.print()"
                    class="p-3 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs transition-all flex items-center justify-center gap-1.5 cursor-pointer active:scale-95"
                >
                    <i data-lucide="printer" class="w-4 h-4 text-slate-400"></i>
                    <span>Print Receipt</span>
                </button>

                <button
                    type="button"
                    onclick="window.showAppAlert({ title: 'Receipt Link Copied', subtitle: 'PayNet DuitNow Receipt', message: 'Cryptographic receipt verification URL has been copied to your clipboard.', type: 'success' });"
                    class="p-3 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs transition-all flex items-center justify-center gap-1.5 cursor-pointer active:scale-95"
                >
                    <i data-lucide="share-2" class="w-4 h-4 text-slate-400"></i>
                    <span>Share Receipt</span>
                </button>

                <button
                    type="button"
                    onclick="window.resetAccordionTransfer()"
                    class="col-span-2 sm:col-span-1 p-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition-all shadow-xs shadow-emerald-600/20 flex items-center justify-center gap-1.5 cursor-pointer active:scale-95"
                >
                    <i data-lucide="repeat" class="w-4 h-4"></i>
                    <span>New Transfer</span>
                </button>
            </div>

            <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                <a
                    href="{{ route('customer.dashboard') }}"
                    class="w-full py-3.5 rounded-2xl bg-slate-900 hover:bg-slate-800 dark:bg-white dark:hover:bg-slate-100 text-white dark:text-slate-900 font-bold text-sm transition-all flex items-center justify-center gap-2 cursor-pointer shadow-md"
                >
                    <span>Return to Dashboard</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        <!-- =====================================================================
             ACCORDION CONTAINER
             ===================================================================== -->
        <div id="transfer-accordion-container" class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-950/5 overflow-hidden animate__animated animate__fadeInUp animate__faster">

            <!-- ── ACCORDION ITEM 1: RECIPIENT DETAILS ── -->
            <div class="accordion-item transition-all duration-300" id="acc-item-1">
                <!-- Accordion Header -->
                <button
                    type="button"
                    onclick="window.toggleAccordionItem(1)"
                    class="w-full p-5 sm:p-6 flex items-center justify-between text-left cursor-pointer hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors group"
                >
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div id="acc-icon-1" class="w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all">
                            1
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 tracking-tight">Recipient &amp; Account</h3>
                                <span id="acc-badge-1" class="text-[10px] sm:text-[11px] font-bold px-2 sm:px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">Active</span>
                            </div>
                            <p id="acc-summary-1" class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">Select payee or enter DuitNow proxy</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 ml-3">
                        <span id="acc-change-btn-1" class="hidden text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Edit</span>
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-200 transition-colors">
                            <i data-lucide="chevron-down" id="acc-chevron-1" class="w-4 h-4 transition-transform duration-300 transform rotate-180"></i>
                        </div>
                    </div>
                </button>

                <!-- Accordion Body -->
                <div id="acc-body-1" class="p-5 sm:p-6 pt-4 sm:pt-5 border-t border-slate-100 dark:border-slate-800 space-y-5 transition-all">
                    
                    <!-- Transfer Destination Type Option Cards -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-xs font-bold text-slate-700 dark:text-slate-300 flex items-center gap-1.5 font-sans tracking-tight">
                                <i data-lucide="layers" class="w-3.5 h-3.5 text-emerald-500"></i>
                                <span>Transfer Destination Type</span>
                            </label>
                            <span class="text-[11px] text-slate-400 font-medium">Instant PayNet Clearing</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3">
                            <!-- Card 1: DuitNow Proxy -->
                            <button
                                type="button"
                                id="tab-duitnow-btn"
                                onclick="window.switchProxyType('duitnow')"
                                class="p-3 sm:p-3.5 pr-8 rounded-2xl border-2 border-emerald-500 bg-gradient-to-br from-emerald-50/90 via-emerald-50/40 to-white dark:from-emerald-950/40 dark:via-slate-900 dark:to-slate-900 text-left transition-all cursor-pointer group active:scale-[0.98] shadow-sm shadow-emerald-500/5 relative flex items-start gap-3"
                            >
                                <div id="tab-duitnow-icon-wrap" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-600/25">
                                    <i data-lucide="smartphone" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">DuitNow ID</h4>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium mt-0.5 leading-snug">Mobile, NRIC, Passport</p>
                                </div>
                                <span id="tab-duitnow-check" class="absolute top-2.5 right-2.5 w-4.5 h-4.5 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-xs ring-2 ring-white dark:ring-slate-900">
                                    <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                </span>
                            </button>

                            <!-- Card 2: Bank Account -->
                            <button
                                type="button"
                                id="tab-bank-btn"
                                onclick="window.switchProxyType('bank')"
                                class="p-3 sm:p-3.5 pr-8 rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-white hover:bg-slate-50/80 dark:bg-slate-900/60 dark:hover:bg-slate-800/80 text-left transition-all cursor-pointer group active:scale-[0.98] shadow-xs relative flex items-start gap-3 hover:border-slate-300 dark:hover:border-slate-700"
                            >
                                <div id="tab-bank-icon-wrap" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 group-hover:bg-emerald-50 dark:group-hover:bg-emerald-950/40 flex items-center justify-center shrink-0 transition-colors">
                                    <i data-lucide="landmark" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">Bank Account</h4>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium mt-0.5 leading-snug">All 42 Malaysian Banks</p>
                                </div>
                                <span id="tab-bank-check" class="hidden absolute top-2.5 right-2.5 w-4.5 h-4.5 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-xs ring-2 ring-white dark:ring-slate-900">
                                    <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Quick Select Saved Payees -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-xs font-bold text-slate-700 dark:text-slate-300 flex items-center gap-1.5 font-sans tracking-tight">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-500"></i>
                                <span>Quick Select Saved Payee</span>
                            </label>
                            <div class="flex items-center gap-2">
                                <button
                                    type="button"
                                    onclick="window.openAddPayeeModal()"
                                    class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors cursor-pointer"
                                >
                                    <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
                                    <span>Add Payee</span>
                                </button>
                                <span class="text-slate-300 dark:text-slate-700 hidden xs:inline">•</span>
                                <span class="text-[11px] text-slate-400 font-medium hidden xs:inline">Tap to auto-fill</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-2.5" id="saved-payee-list">
                            @if(isset($beneficiaries) && $beneficiaries->isNotEmpty())
                                @foreach($beneficiaries as $index => $ben)
                                    @php
                                        $initials = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $ben->nickname), 0, 2)) ?: 'BF';
                                        $proxyVal = $ben->duitnow_id_value ?: $ben->account_number;
                                        $proxyType = $ben->duitnow_id_type ? ucfirst($ben->duitnow_id_type) : 'Account';
                                    @endphp
                                    <div class="relative group/card">
                                        <button
                                            type="button"
                                            onclick="window.selectSavedPayee('{{ addslashes($ben->nickname) }}', '{{ $proxyVal }}', '{{ $proxyType }}', '{{ addslashes($ben->bank_name) }}', this)"
                                            class="saved-payee-btn w-full {{ $index === 0 ? 'active' : '' }} p-3 sm:p-3.5 pr-8 rounded-2xl border {{ $index === 0 ? 'border-2 border-emerald-500 bg-gradient-to-br from-emerald-50/90 via-emerald-50/40 to-white dark:from-emerald-950/40 dark:via-slate-900 dark:to-slate-900' : 'border-slate-200/90 dark:border-slate-800 bg-white hover:bg-slate-50/80 dark:bg-slate-900 dark:hover:bg-slate-850 hover:border-slate-300 dark:hover:border-slate-700' }} text-left transition-all group cursor-pointer active:scale-[0.98] shadow-xs relative flex items-center gap-2.5"
                                        >
                                            <div class="flex items-center gap-2.5 min-w-0 flex-1">
                                                <div class="w-9 h-9 sm:w-8 sm:h-8 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-200 dark:from-emerald-950 dark:to-teal-900 text-emerald-700 dark:text-emerald-300 font-bold text-xs flex items-center justify-center shrink-0 shadow-2xs">
                                                    {{ $initials }}
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="flex items-center gap-1">
                                                        <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight truncate">{{ $ben->nickname }}</p>
                                                        @if($ben->is_favorite)
                                                            <i data-lucide="star" class="w-3 h-3 text-amber-400 fill-amber-400 shrink-0"></i>
                                                        @endif
                                                    </div>
                                                    <span class="inline-block text-[11px] font-medium text-slate-400 mt-0.5 truncate">{{ $ben->bank_name }} • {{ $proxyVal }}</span>
                                                </div>
                                            </div>
                                            <span class="saved-check-badge {{ $index === 0 ? '' : 'hidden' }} absolute top-2.5 right-2.5 w-4.5 h-4.5 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-xs ring-2 ring-white dark:ring-slate-900">
                                                <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                            </span>
                                        </button>
                                        <div class="absolute bottom-1 right-2 opacity-0 group-hover/card:opacity-100 transition-opacity flex items-center gap-1 bg-white/90 dark:bg-slate-850/90 rounded-lg px-1 py-0.5 shadow-2xs z-10">
                                            <button
                                                type="button"
                                                title="Toggle Favorite"
                                                onclick="window.togglePayeeFavorite({{ $ben->id }}, event)"
                                                class="text-slate-400 hover:text-amber-500 p-0.5 transition-colors"
                                            >
                                                <i data-lucide="star" class="w-3 h-3 {{ $ben->is_favorite ? 'text-amber-400 fill-amber-400' : '' }}"></i>
                                            </button>
                                            <button
                                                type="button"
                                                title="Delete Payee"
                                                onclick="window.deletePayee({{ $ben->id }}, event)"
                                                class="text-slate-400 hover:text-rose-500 p-0.5 transition-colors"
                                            >
                                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Card 1: Sarah -->
                                <button
                                    type="button"
                                    onclick="window.selectSavedPayee('Sarah Binti Zulkifli', '012-8821941', 'Mobile', 'Maybank', this)"
                                    class="saved-payee-btn active p-3 sm:p-3.5 pr-8 rounded-2xl border-2 border-emerald-500 bg-gradient-to-br from-emerald-50/90 via-emerald-50/40 to-white dark:from-emerald-950/40 dark:via-slate-900 dark:to-slate-900 text-left transition-all group cursor-pointer active:scale-[0.98] shadow-sm shadow-emerald-500/10 relative flex items-center gap-2.5"
                                >
                                    <div class="flex items-center gap-2.5 min-w-0 flex-1">
                                        <div class="w-9 h-9 sm:w-8 sm:h-8 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-200 dark:from-emerald-950 dark:to-teal-900 text-emerald-700 dark:text-emerald-300 font-bold text-xs flex items-center justify-center shrink-0 shadow-2xs">
                                            SZ
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight truncate">Sarah Zulkifli</p>
                                            <span class="inline-block text-[11px] font-medium text-slate-400 mt-0.5 truncate">Maybank • 012-8821941</span>
                                        </div>
                                    </div>
                                    <span class="saved-check-badge absolute top-2.5 right-2.5 w-4.5 h-4.5 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-xs ring-2 ring-white dark:ring-slate-900">
                                        <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- DuitNow Proxy Form -->
                    <div id="proxy-duitnow-section" class="space-y-3">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold text-slate-700 dark:text-slate-300 flex items-center gap-1.5 font-sans tracking-tight">
                                    <span>Recipient Proxy Number</span>
                                </label>
                                <span class="text-[11px] font-medium text-slate-400">Mobile / NRIC / Passport</span>
                            </div>
                            <div class="relative">
                                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                    <i data-lucide="smartphone" class="w-4 h-4"></i>
                                </div>
                                <input
                                    type="text"
                                    id="recipient-id-input"
                                    placeholder="e.g. 012-3456789"
                                    value="012-8821941"
                                    oninput="window.onProxyInputChange()"
                                    class="w-full py-2.5 sm:py-3 pl-10 pr-28 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 transition-all font-sans shadow-2xs placeholder:font-normal placeholder:text-slate-400"
                                />
                                <button
                                    type="button"
                                    id="btn-verify-proxy"
                                    onclick="window.verifyDuitNowRecipient()"
                                    class="absolute right-1.5 top-1/2 -translate-y-1/2 px-3 sm:px-3.5 py-1.5 sm:py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-white font-bold text-xs shadow-xs shadow-emerald-600/20 transition-all cursor-pointer flex items-center gap-1.5"
                                >
                                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                    <span>Verify ID</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Account Form -->
                    <div id="proxy-bank-section" class="space-y-3.5 hidden">
                        <div>
                            @php
                            $bankOptions = [
                                ['value' => 'Maybank', 'label' => 'Malayan Banking Berhad', 'sub' => 'Maybank • Instant Transfer / DuitNow'],
                                ['value' => 'CIMB Bank', 'label' => 'CIMB Bank Berhad', 'sub' => 'CIMB Clicks • Instant Transfer / DuitNow'],
                                ['value' => 'Public Bank', 'label' => 'Public Bank Berhad', 'sub' => 'PBe • Instant Transfer / DuitNow'],
                                ['value' => 'RHB Bank', 'label' => 'RHB Bank Berhad', 'sub' => 'RHB Now • Instant Transfer / DuitNow'],
                                ['value' => 'Hong Leong Bank', 'label' => 'Hong Leong Bank Berhad', 'sub' => 'HLB Connect • Instant Transfer / DuitNow'],
                                ['value' => 'AmBank', 'label' => 'AmBank (M) Berhad', 'sub' => 'AmOnline • Instant Transfer / DuitNow'],
                                ['value' => 'Bank Islam', 'label' => 'Bank Islam Malaysia Berhad', 'sub' => 'BIMB • Instant Transfer / DuitNow'],
                                ['value' => 'Bank Muamalat', 'label' => 'Bank Muamalat Malaysia Berhad', 'sub' => 'i-Muamalat • Instant Transfer / DuitNow'],
                                ['value' => 'Affin Bank', 'label' => 'Affin Bank Berhad', 'sub' => 'Affin Always • Instant Transfer / DuitNow'],
                                ['value' => 'Alliance Bank', 'label' => 'Alliance Bank Malaysia Berhad', 'sub' => 'allianceonline • Instant Transfer / DuitNow'],
                                ['value' => 'Standard Chartered', 'label' => 'Standard Chartered Bank', 'sub' => 'StanChart MY • Instant Transfer / DuitNow'],
                                ['value' => 'HSBC Bank', 'label' => 'HSBC Bank Malaysia Berhad', 'sub' => 'HSBC Online • Instant Transfer / DuitNow'],
                                ['value' => 'OCBC Bank', 'label' => 'OCBC Bank (Malaysia) Berhad', 'sub' => 'OCBC Online • Instant Transfer / DuitNow'],
                                ['value' => 'UOB Bank', 'label' => 'United Overseas Bank (Malaysia)', 'sub' => 'UOB TMRW • Instant Transfer / DuitNow'],
                            ];
                            @endphp

                            <x-ui.searchable-select
                                id="bank-select"
                                name="bank_select"
                                label="Receiving Bank"
                                placeholder="Select recipient's bank"
                                searchPlaceholder="Search by bank name (e.g. Maybank, CIMB)..."
                                :options="$bankOptions"
                                selected="Maybank"
                                focusRing="emerald"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Account Number</label>
                            <div class="relative">
                                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                    <i data-lucide="credit-card" class="w-4 h-4"></i>
                                </div>
                                <input
                                    type="text"
                                    id="bank-account-input"
                                    placeholder="e.g. 1540 1234 5678"
                                    oninput="window.onBankAccountInputChange()"
                                    class="w-full py-2.5 sm:py-3 pl-10 pr-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none text-slate-900 dark:text-slate-100 transition-all font-sans shadow-2xs placeholder:font-normal placeholder:text-slate-400"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Verified Recipient Card (Fintech receipt card) -->
                    <div id="verified-recipient-card" class="p-3.5 sm:p-4 rounded-2xl bg-gradient-to-br from-emerald-50/90 via-teal-50/40 to-white dark:from-emerald-950/40 dark:via-slate-900 dark:to-slate-900 border border-emerald-300/80 dark:border-emerald-800/80 transition-all flex items-center justify-between shadow-xs animate__animated animate__fadeIn">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-500/20">
                                <i data-lucide="check" class="w-5 h-5 stroke-[3]"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="inline-flex items-center gap-1 text-[10px] sm:text-[11px] font-bold text-emerald-700 dark:text-emerald-300 uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        PayNet Verified Payee
                                    </span>
                                </div>
                                <h4 id="verified-recipient-name" class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 truncate tracking-tight mt-0.5">SARAH BINTI ZULKIFLI</h4>
                                <p id="verified-recipient-meta" class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">Maybank • Mobile: 012-8821941</p>
                            </div>
                        </div>
                        <span class="hidden xs:inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-700 dark:text-emerald-300 text-[10px] sm:text-[11px] font-bold shrink-0 ml-2">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                            Verified
                        </span>
                    </div>

                    <!-- Accordion Section 1 Footer Action -->
                    <div class="pt-1 flex justify-end">
                        <button
                            type="button"
                            onclick="window.completeAccordionStep1()"
                            class="w-full sm:w-auto px-5 sm:px-6 py-2.5 sm:py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 active:scale-[0.98] text-white font-bold text-xs sm:text-sm shadow-xs shadow-emerald-600/20 transition-all flex items-center justify-center gap-2 cursor-pointer group"
                        >
                            <span>Save &amp; Enter Amount</span>
                            <i data-lucide="arrow-down" class="w-4 h-4 group-hover:translate-y-0.5 transition-transform"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ── ACCORDION ITEM 2: TRANSFER AMOUNT & REFERENCE ── -->
            <div class="accordion-item border-t border-slate-200/80 dark:border-slate-800 transition-all duration-300" id="acc-item-2">
                <!-- Accordion Header -->
                <button
                    type="button"
                    onclick="window.toggleAccordionItem(2)"
                    class="w-full p-5 sm:p-6 flex items-center justify-between text-left cursor-pointer hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors group"
                >
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div id="acc-icon-2" class="w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all">
                            2
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 tracking-tight">Amount &amp; Reference</h3>
                                <span id="acc-badge-2" class="text-[10px] sm:text-[11px] font-bold px-2 sm:px-2.5 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">Pending</span>
                            </div>
                            <p id="acc-summary-2" class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">Specify transfer value and note</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 ml-3">
                        <span id="acc-change-btn-2" class="hidden text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Edit</span>
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-200 transition-colors">
                            <i data-lucide="chevron-down" id="acc-chevron-2" class="w-4 h-4 transition-transform duration-300"></i>
                        </div>
                    </div>
                </button>

                <!-- Accordion Body -->
                <div id="acc-body-2" class="p-5 sm:p-6 pt-4 sm:pt-5 border-t border-slate-100 dark:border-slate-800 space-y-5 hidden transition-all">
                    <!-- Source Account Pill -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 flex items-center justify-between text-xs font-sans">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                <i data-lucide="wallet" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200">{{ $customer->account_type }} (•••• 5678)</p>
                                <p class="text-[11px] text-slate-400">Available: RM {{ number_format($customer->account_balance, 2) }}</p>
                            </div>
                        </div>
                        <span class="text-[10px] sm:text-[11px] font-bold px-2 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">Sufficient</span>
                    </div>

                    <!-- Amount Entry -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Amount (RM)</label>
                        <div class="relative mb-2">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-2xl font-bold text-slate-400">RM</span>
                            <input
                                type="number"
                                id="transfer-amount-input"
                                placeholder="0.00"
                                value="250.00"
                                min="1"
                                max="50000"
                                step="0.01"
                                class="w-full py-3.5 pl-16 pr-4 text-2xl sm:text-3xl font-bold rounded-2xl border-2 border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none text-slate-900 dark:text-slate-50 transition-all font-sans"
                            />
                        </div>

                        <!-- Quick Chips -->
                        <div class="flex items-center gap-2 overflow-x-auto pt-1">
                            <button type="button" onclick="document.getElementById('transfer-amount-input').value = '50.00'" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-emerald-500 hover:text-emerald-600 text-xs font-bold transition-all cursor-pointer font-sans">
                                +RM 50
                            </button>
                            <button type="button" onclick="document.getElementById('transfer-amount-input').value = '100.00'" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-emerald-500 hover:text-emerald-600 text-xs font-bold transition-all cursor-pointer font-sans">
                                +RM 100
                            </button>
                            <button type="button" onclick="document.getElementById('transfer-amount-input').value = '250.00'" class="px-3 py-1.5 rounded-xl border border-emerald-300 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 text-xs font-bold transition-all cursor-pointer font-sans">
                                +RM 250
                            </button>
                            <button type="button" onclick="document.getElementById('transfer-amount-input').value = '500.00'" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-emerald-500 hover:text-emerald-600 text-xs font-bold transition-all cursor-pointer font-sans">
                                +RM 500
                            </button>
                        </div>
                    </div>

                    <!-- Reference Input -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">
                            Recipient Reference <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="transfer-reference-input"
                            value="Project Allowance & Support"
                            placeholder="e.g. Dinner share, Rent, Invoice"
                            class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 transition-all font-sans shadow-2xs placeholder:font-normal placeholder:text-slate-400"
                        />
                    </div>

                    <!-- Accordion Section 2 Footer Action -->
                    <div class="pt-2 flex justify-end">
                        <button
                            type="button"
                            onclick="window.completeAccordionStep2()"
                            class="w-full sm:w-auto px-5 sm:px-6 py-2.5 sm:py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 active:scale-[0.98] text-white font-bold text-xs sm:text-sm shadow-xs shadow-emerald-600/20 transition-all flex items-center justify-center gap-2 cursor-pointer font-sans"
                        >
                            <span>Save &amp; Review Transfer</span>
                            <i data-lucide="arrow-down" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ── ACCORDION ITEM 3: SECURITY REVIEW & AUTHENTICATION ── -->
            <div class="accordion-item border-t border-slate-200/80 dark:border-slate-800 transition-all duration-300" id="acc-item-3">
                <!-- Accordion Header -->
                <button
                    type="button"
                    onclick="window.toggleAccordionItem(3)"
                    class="w-full p-5 sm:p-6 flex items-center justify-between text-left cursor-pointer hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors group"
                >
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div id="acc-icon-3" class="w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all">
                            3
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 tracking-tight">Security Review &amp; Authenticate</h3>
                                <span id="acc-badge-3" class="text-[10px] sm:text-[11px] font-bold px-2 sm:px-2.5 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">Locked</span>
                            </div>
                            <p id="acc-summary-3" class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">Scam Guard check &amp; biometric approval</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 ml-3">
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-200 transition-colors">
                            <i data-lucide="chevron-down" id="acc-chevron-3" class="w-4 h-4 transition-transform duration-300"></i>
                        </div>
                    </div>
                </button>

                <!-- Accordion Body -->
                <div id="acc-body-3" class="p-5 sm:p-6 pt-4 sm:pt-5 border-t border-slate-100 dark:border-slate-800 space-y-5 hidden transition-all">
                    <!-- Summary Table -->
                    <div class="bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 divide-y divide-slate-200/60 dark:divide-slate-700/60 text-xs font-sans">
                        <div class="flex items-center justify-between p-3.5">
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Total Transfer Amount</span>
                            <span id="review-amount" class="text-base sm:text-lg font-bold text-emerald-600 dark:text-emerald-400">RM 250.00</span>
                        </div>
                        <div class="flex items-center justify-between p-3.5">
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Recipient Name</span>
                            <span id="review-recipient-name" class="font-bold text-slate-900 dark:text-slate-100">SARAH BINTI ZULKIFLI</span>
                        </div>
                        <div class="flex items-center justify-between p-3.5">
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Channel / Proxy</span>
                            <span id="review-recipient-proxy" class="font-medium text-slate-700 dark:text-slate-300">Maybank (012-8821941)</span>
                        </div>
                        <div class="flex items-center justify-between p-3.5">
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Payment Reference</span>
                            <span id="review-reference" class="font-semibold text-slate-800 dark:text-slate-200">Project Allowance &amp; Support</span>
                        </div>
                        <div class="flex items-center justify-between p-3.5">
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Clearing Fee</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">RM 0.00 (Instant Free)</span>
                        </div>
                    </div>

                    <!-- Scam Guard Security Pill -->
                    <div class="p-3.5 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200/80 dark:border-amber-900/60 text-amber-800 dark:text-amber-300 text-xs flex items-start gap-2.5 font-sans">
                        <i data-lucide="shield-alert" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                        <div>
                            <p class="font-bold text-xs">National Scam Guard Protocol</p>
                            <p class="text-[11px] text-amber-700 dark:text-amber-300/90 mt-0.5">BankFlow never requests passwords via phone or WhatsApp. Verification requires your physical hardware key.</p>
                        </div>
                    </div>

                    <!-- Biometric Confirmation Trigger -->
                    <div class="pt-2">
                        <button
                            type="button"
                            id="auth-confirm-btn"
                            onclick="window.executeAccordionBiometricTransfer()"
                            class="w-full py-3.5 sm:py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-500 active:scale-[0.98] text-white font-bold text-xs sm:text-sm shadow-lg shadow-emerald-600/25 transition-all flex items-center justify-center gap-2.5 cursor-pointer font-sans"
                        >
                            <i data-lucide="fingerprint" class="w-5 h-5"></i>
                            <span>Authorize Transfer with Face ID / Enclave</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Accordion Script -->
    <script>
    (function() {
        let transferData = {
            recipientType: 'duitnow',
            recipientName: 'SARAH BINTI ZULKIFLI',
            recipientDetail: 'Maybank • 012-8821941',
            amount: 250.00,
            reference: 'Project Allowance & Support',
        };

        window.toggleAccordionItem = function(itemNum) {
            const body = document.getElementById(`acc-body-${itemNum}`);
            const chevron = document.getElementById(`acc-chevron-${itemNum}`);
            if (!body) return;

            const isHidden = body.classList.contains('hidden');

            // Close all items
            for (let i = 1; i <= 3; i++) {
                const b = document.getElementById(`acc-body-${i}`);
                const c = document.getElementById(`acc-chevron-${i}`);
                if (b) b.classList.add('hidden');
                if (c) c.classList.remove('rotate-180');
            }

            // If it was hidden, open it
            if (isHidden) {
                body.classList.remove('hidden');
                if (chevron) chevron.classList.add('rotate-180');
            }
        };

        window.switchProxyType = function(type) {
            transferData.recipientType = type;
            const tabDuitnow = document.getElementById('tab-duitnow-btn');
            const tabBank = document.getElementById('tab-bank-btn');
            const iconDuitnow = document.getElementById('tab-duitnow-icon-wrap');
            const iconBank = document.getElementById('tab-bank-icon-wrap');
            const checkDuitnow = document.getElementById('tab-duitnow-check');
            const checkBank = document.getElementById('tab-bank-check');
            const proxyDuitnow = document.getElementById('proxy-duitnow-section');
            const proxyBank = document.getElementById('proxy-bank-section');

            const activeCardClass = "p-3 sm:p-3.5 rounded-2xl border-2 border-emerald-500 bg-gradient-to-br from-emerald-50/90 via-emerald-50/40 to-white dark:from-emerald-950/40 dark:via-slate-900 dark:to-slate-900 text-left transition-all cursor-pointer group active:scale-[0.98] shadow-sm shadow-emerald-500/5 relative flex items-start gap-3";
            const inactiveCardClass = "p-3 sm:p-3.5 rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-white hover:bg-slate-50/80 dark:bg-slate-900/60 dark:hover:bg-slate-800/80 text-left transition-all cursor-pointer group active:scale-[0.98] shadow-xs relative flex items-start gap-3 hover:border-slate-300 dark:hover:border-slate-700";

            const activeIconClass = "w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-600/25";
            const inactiveIconClass = "w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 group-hover:bg-emerald-50 dark:group-hover:bg-emerald-950/40 flex items-center justify-center shrink-0 transition-colors";

            if (type === 'duitnow') {
                tabDuitnow.className = activeCardClass;
                iconDuitnow.className = activeIconClass;
                if (checkDuitnow) checkDuitnow.classList.remove('hidden');

                tabBank.className = inactiveCardClass;
                iconBank.className = inactiveIconClass;
                if (checkBank) checkBank.classList.add('hidden');

                proxyDuitnow.classList.remove('hidden');
                proxyBank.classList.add('hidden');
            } else {
                tabBank.className = activeCardClass;
                iconBank.className = activeIconClass;
                if (checkBank) checkBank.classList.remove('hidden');

                tabDuitnow.className = inactiveCardClass;
                iconDuitnow.className = inactiveIconClass;
                if (checkDuitnow) checkDuitnow.classList.add('hidden');

                proxyBank.classList.remove('hidden');
                proxyDuitnow.classList.add('hidden');
            }
            if (window.refreshLucideIcons) {
                window.refreshLucideIcons();
            } else if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons();
            }
        };

        window.selectSavedPayee = function(name, id, type, bank, el) {
            transferData.recipientName = name.toUpperCase();
            transferData.recipientDetail = `${bank} • ${id}`;
            document.getElementById('verified-recipient-name').textContent = name.toUpperCase();
            document.getElementById('verified-recipient-meta').textContent = `${bank} • ${type}: ${id}`;
            document.getElementById('recipient-id-input').value = id;

            const inactivePayeeClass = "saved-payee-btn p-3 sm:p-3.5 pr-8 rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-white hover:bg-slate-50/80 dark:bg-slate-900 dark:hover:bg-slate-850 hover:border-slate-300 dark:hover:border-slate-700 text-left transition-all group cursor-pointer active:scale-[0.98] shadow-xs relative flex items-center gap-2.5";
            const activePayeeClass = "saved-payee-btn active p-3 sm:p-3.5 pr-8 rounded-2xl border-2 border-emerald-500 bg-gradient-to-br from-emerald-50/90 via-emerald-50/40 to-white dark:from-emerald-950/40 dark:via-slate-900 dark:to-slate-900 text-left transition-all group cursor-pointer active:scale-[0.98] shadow-sm shadow-emerald-500/10 relative flex items-center gap-2.5";

            // Highlight selected button
            document.querySelectorAll('.saved-payee-btn').forEach(btn => {
                btn.className = inactivePayeeClass;
                const check = btn.querySelector('.saved-check-badge');
                if (check) check.classList.add('hidden');
            });

            if (el) {
                el.className = activePayeeClass;
                const check = el.querySelector('.saved-check-badge');
                if (check) check.classList.remove('hidden');
            }

            // Animate verified card
            const verifiedCard = document.getElementById('verified-recipient-card');
            if (verifiedCard) {
                verifiedCard.classList.remove('animate__fadeIn');
                void verifiedCard.offsetWidth; // trigger reflow
                verifiedCard.classList.add('animate__fadeIn');
            }
        };

        window.onProxyInputChange = function() {
            // Remove active style from saved payees when typing custom input
            const inactivePayeeClass = "saved-payee-btn p-3 sm:p-3.5 pr-8 rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-white hover:bg-slate-50/80 dark:bg-slate-900 dark:hover:bg-slate-850 hover:border-slate-300 dark:hover:border-slate-700 text-left transition-all group cursor-pointer active:scale-[0.98] shadow-xs relative flex items-center gap-2.5";
            document.querySelectorAll('.saved-payee-btn').forEach(btn => {
                btn.className = inactivePayeeClass;
                const check = btn.querySelector('.saved-check-badge');
                if (check) check.classList.add('hidden');
            });
        };

        window.onBankSelectChange = function() {
            const bankSelect = document.getElementById('bank-select');
            const bankName = bankSelect ? bankSelect.value : 'Maybank';
            const accInput = document.getElementById('bank-account-input');
            const accNo = accInput && accInput.value.trim() ? accInput.value.trim() : '•••• ••••';
            
            transferData.recipientDetail = `${bankName} • Acc: ${accNo}`;
            document.getElementById('verified-recipient-meta').textContent = transferData.recipientDetail;
        };

        window.onBankAccountInputChange = function() {
            const bankSelect = document.getElementById('bank-select');
            const bankName = bankSelect ? bankSelect.value : 'Maybank';
            const accInput = document.getElementById('bank-account-input');
            const accNo = accInput && accInput.value.trim() ? accInput.value.trim() : '•••• ••••';

            transferData.recipientDetail = `${bankName} • Acc: ${accNo}`;
            document.getElementById('verified-recipient-meta').textContent = transferData.recipientDetail;
        };

        window.verifyDuitNowRecipient = function() {
            const val = document.getElementById('recipient-id-input').value.trim();
            if (!val) {
                alert('Please enter a proxy number.');
                return;
            }
            transferData.recipientName = 'AHMAD SYAFIQ BIN RAMLI';
            transferData.recipientDetail = `Maybank • Mobile: ${val}`;
            document.getElementById('verified-recipient-name').textContent = transferData.recipientName;
            document.getElementById('verified-recipient-meta').textContent = transferData.recipientDetail;

            const btn = document.getElementById('btn-verify-proxy');
            if (btn) {
                const originalHtml = btn.innerHTML;
                const originalBgClass = 'bg-emerald-600 hover:bg-emerald-500';
                const verifiedBgClass = 'bg-teal-600 hover:bg-teal-500';

                // Inline SVG check icon ensures icon is never missing even if lucide createIcons isn't re-invoked
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg><span>Verified</span>`;
                btn.className = btn.className.replace(originalBgClass, verifiedBgClass);

                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.className = btn.className.replace(verifiedBgClass, originalBgClass);
                    if (window.refreshLucideIcons) {
                        window.refreshLucideIcons();
                    } else if (window.lucide && window.lucide.createIcons) {
                        window.lucide.createIcons();
                    }
                }, 2000);
            }
            if (window.refreshLucideIcons) {
                window.refreshLucideIcons();
            } else if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons();
            }
        };

        window.completeAccordionStep1 = function() {
            // Update Accordion 1 summary and badge
            const badge1 = document.getElementById('acc-badge-1');
            badge1.textContent = 'Completed ✓';
            badge1.className = 'text-[10px] sm:text-[11px] font-bold px-2 sm:px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300';
            
            document.getElementById('acc-icon-1').className = 'w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 font-bold text-sm flex items-center justify-center shrink-0';
            document.getElementById('acc-icon-1').innerHTML = '✓';
            document.getElementById('acc-summary-1').textContent = `${transferData.recipientName} (${transferData.recipientDetail})`;
            document.getElementById('acc-change-btn-1').classList.remove('hidden');

            // Activate Step 2
            const badge2 = document.getElementById('acc-badge-2');
            badge2.textContent = 'Active';
            badge2.className = 'text-[10px] sm:text-[11px] font-bold px-2 sm:px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300';
            document.getElementById('acc-icon-2').className = 'w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold text-sm flex items-center justify-center shrink-0';

            window.toggleAccordionItem(2);
        };

        window.completeAccordionStep2 = function() {
            const amt = parseFloat(document.getElementById('transfer-amount-input').value);
            const ref = document.getElementById('transfer-reference-input').value.trim() || 'Payment';
            if (isNaN(amt) || amt <= 0) {
                alert('Please enter a valid transfer amount.');
                return;
            }

            transferData.amount = amt;
            transferData.reference = ref;

            // Update Accordion 2
            const badge2 = document.getElementById('acc-badge-2');
            badge2.textContent = 'Completed ✓';
            badge2.className = 'text-[10px] sm:text-[11px] font-bold px-2 sm:px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300';

            document.getElementById('acc-icon-2').className = 'w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 font-bold text-sm flex items-center justify-center shrink-0';
            document.getElementById('acc-icon-2').innerHTML = '✓';
            document.getElementById('acc-summary-2').textContent = `RM ${amt.toFixed(2)} • Ref: ${ref}`;
            document.getElementById('acc-change-btn-2').classList.remove('hidden');

            // Populate Review in Accordion 3
            document.getElementById('review-amount').textContent = 'RM ' + amt.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('review-recipient-name').textContent = transferData.recipientName;
            document.getElementById('review-recipient-proxy').textContent = transferData.recipientDetail;
            document.getElementById('review-reference').textContent = ref;

            // Activate Step 3
            const badge3 = document.getElementById('acc-badge-3');
            badge3.textContent = 'Ready';
            badge3.className = 'text-[10px] sm:text-[11px] font-bold px-2 sm:px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300';
            document.getElementById('acc-icon-3').className = 'w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 font-bold text-sm flex items-center justify-center shrink-0';

            window.toggleAccordionItem(3);
        };

        window.executeAccordionBiometricTransfer = function() {
            const btn = document.getElementById('auth-confirm-btn');
            btn.innerHTML = `<span class="animate-spin mr-2">◌</span> Validating Hardware Enclave Face ID...`;
            btn.disabled = true;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch('{{ route("customer.transfer.submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    amount: transferData.amount,
                    recipient_name: transferData.recipientName,
                    recipient_bank: transferData.recipientBank || 'PayNet Interbank',
                    recipient_account: transferData.recipientAccount || transferData.recipientDetail,
                    payment_reference: transferData.reference || 'DuitNow Transfer',
                    is_trusted_payee: true,
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('receipt-amount').textContent = 'RM ' + parseFloat(data.amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('receipt-ref-no').textContent = data.reference;
                    document.getElementById('receipt-recipient-name').textContent = data.recipient_name;
                    document.getElementById('receipt-recipient-proxy').textContent = transferData.recipientDetail;
                    document.getElementById('receipt-reference').textContent = transferData.reference;
                    document.getElementById('receipt-timestamp').textContent = data.date;

                    // Hide accordion, show receipt
                    document.getElementById('transfer-accordion-container').classList.add('hidden');
                    document.getElementById('transfer-success-card').classList.remove('hidden');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    if (window.lucide) window.lucide.createIcons();
                } else {
                    alert(data.message || 'Transfer could not be completed.');
                    btn.innerHTML = `<span>Authorize &amp; Transfer</span>`;
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Transfer submission encountered a network error. Please try again.');
                btn.innerHTML = `<span>Authorize &amp; Transfer</span>`;
                btn.disabled = false;
            });
        };

        window.resetAccordionTransfer = function() {
            window.location.reload();
        };

        // Payee Management Handlers
        window.openAddPayeeModal = function() {
            document.getElementById('add-payee-modal').classList.remove('hidden');
        };

        window.closeAddPayeeModal = function() {
            document.getElementById('add-payee-modal').classList.add('hidden');
            document.getElementById('add-payee-form').reset();
        };

        window.submitAddPayee = function(e) {
            e.preventDefault();
            const btn = document.getElementById('save-payee-btn');
            btn.disabled = true;
            btn.innerHTML = `<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Saving...`;
            if (window.lucide) window.lucide.createIcons();

            const nickname = document.getElementById('new-payee-nickname').value;
            const bankName = document.getElementById('new-payee-bank').value;
            const type = document.getElementById('new-payee-type').value;
            const value = document.getElementById('new-payee-val').value;
            const isFavorite = document.getElementById('new-payee-fav').checked;

            const payload = {
                nickname: nickname,
                bank_name: bankName,
                is_favorite: isFavorite,
            };

            if (type === 'account') {
                payload.account_number = value;
            } else {
                payload.duitnow_id_type = type;
                payload.duitnow_id_value = value;
            }

            fetch('{{ route('customer.beneficiaries.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(payload),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.showAppAlert({
                        title: 'Payee Added',
                        subtitle: 'DuitNow Directory',
                        message: `${nickname} has been saved to your favorite payees list.`,
                        type: 'success'
                    });
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    alert(data.message || 'Failed to save payee.');
                    btn.disabled = false;
                    btn.innerHTML = `<span>Save Payee</span>`;
                }
            })
            .catch(err => {
                console.error(err);
                alert('An error occurred while saving payee.');
                btn.disabled = false;
                btn.innerHTML = `<span>Save Payee</span>`;
            });
        };

        window.togglePayeeFavorite = function(payeeId, event) {
            event.stopPropagation();
            fetch(`/customer/beneficiaries/${payeeId}/favorite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        };

        window.deletePayee = function(payeeId, event) {
            event.stopPropagation();
            if (!confirm('Are you sure you want to remove this payee from your saved list?')) {
                return;
            }
            fetch(`/customer/beneficiaries/${payeeId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        };

        // Wire up change listener for bank-select
        document.addEventListener('DOMContentLoaded', () => {
            const bankSelect = document.getElementById('bank-select');
            if (bankSelect) {
                bankSelect.addEventListener('change', () => {
                    if (window.onBankSelectChange) window.onBankSelectChange();
                });
            }
        });
    })();
    </script>

    <!-- Add Payee Modal -->
    <div id="add-payee-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden animate__animated animate__fadeIn animate__faster">
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl max-w-md w-full p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Add Saved Payee</h3>
                        <p class="text-[11px] text-slate-400">Save for instant transfers &amp; DuitNow</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeAddPayeeModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form id="add-payee-form" onsubmit="window.submitAddPayee(event)" class="space-y-3.5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Payee Nickname / Name</label>
                    <input type="text" id="new-payee-nickname" required placeholder="e.g. Sarah Zulkifli" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:outline-emerald-500 font-medium">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Bank Name</label>
                    <select id="new-payee-bank" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:outline-emerald-500 font-medium">
                        <option value="Maybank (Malayan Banking Berhad)">Maybank (Malayan Banking Berhad)</option>
                        <option value="CIMB Bank Berhad">CIMB Bank Berhad</option>
                        <option value="Public Bank Berhad">Public Bank Berhad</option>
                        <option value="RHB Bank Berhad">RHB Bank Berhad</option>
                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                        <option value="Bank Islam Malaysia Berhad">Bank Islam Malaysia Berhad</option>
                        <option value="AmBank (M) Berhad">AmBank (M) Berhad</option>
                        <option value="BankFlow MY (Internal Transfer)">BankFlow MY (Internal Transfer)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Identifier Type</label>
                    <select id="new-payee-type" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:outline-emerald-500 font-medium">
                        <option value="account">Account Number</option>
                        <option value="mobile">DuitNow Mobile Number</option>
                        <option value="nric">NRIC / MyKad</option>
                        <option value="passport">Passport Number</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Account Number / DuitNow ID</label>
                    <input type="text" id="new-payee-val" required placeholder="e.g. 114012345678 or 0123456789" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:outline-emerald-500 font-mono">
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="new-payee-fav" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <label for="new-payee-fav" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Mark as favorite payee (pin to front)</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="window.closeAddPayeeModal()" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" id="save-payee-btn" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-xs shadow-emerald-600/25 transition-all cursor-pointer">
                        Save Payee
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout.customer>
