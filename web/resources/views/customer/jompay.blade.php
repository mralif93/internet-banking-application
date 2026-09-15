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

<x-layout.customer title="JomPAY Bill Payment — BankFlow MY" activeNav="jompay">
    <div class="space-y-6 sm:space-y-8">

        <!-- STANDARD PAGE HEADER (Matching Dashboard Style) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            PayNet JomPAY
                        </span>
                        <span class="text-[11px] sm:text-xs font-mono text-slate-500 dark:text-slate-400">
                            National Biller Network
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        JomPAY Bill Payment
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">Over 5,000+ Registered Billers</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            Zero Transaction Fee
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
        <div id="jompay-success-card" class="hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xl p-6 sm:p-8 space-y-6 animate__animated animate__fadeIn">
            <div class="text-center space-y-2">
                <div class="mx-auto w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center ring-8 ring-emerald-50 dark:ring-emerald-950/30 animate__animated animate__bounceIn">
                    <i data-lucide="check" class="w-8 h-8 stroke-[3]"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-slate-50 tracking-tight">Bill Paid Successfully!</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Settled instantly via PayNet JomPAY National Biller Network</p>
            </div>

            <!-- Official JomPAY Statement -->
            <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/80 space-y-4 text-xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-200/70 dark:border-slate-700/70">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="font-black tracking-wider text-[11px] text-slate-800 dark:text-slate-200 uppercase">JomPAY Official Statement</span>
                    </div>
                    <span class="text-[10px] font-mono text-slate-400" id="jompay-receipt-time">10 Sep 2026, 2:48 PM</span>
                </div>

                <div class="text-center py-2">
                    <span class="text-xs text-slate-400 font-medium">Total Paid</span>
                    <h3 id="jompay-receipt-amount" class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight mt-0.5">RM 178.40</h3>
                </div>

                <div class="divide-y divide-slate-200/50 dark:divide-slate-700/50 space-y-2.5 pt-2">
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">JomPAY Reference</span>
                        <span id="jompay-receipt-ref" class="font-mono font-bold text-slate-900 dark:text-slate-100">JOM-5454-882910</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Biller Name</span>
                        <span id="jompay-receipt-biller" class="font-bold text-slate-900 dark:text-slate-100">Tenaga Nasional Berhad</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Biller Code / Ref-1</span>
                        <span id="jompay-receipt-code-ref" class="font-mono font-medium text-slate-700 dark:text-slate-300">5454 &bull; 220194881021</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Debited Account</span>
                        <span class="font-medium text-slate-700 dark:text-slate-300">{{ $customer->account_type }} (•••• 5678)</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-slate-400">Clearing Status</span>
                        <span class="font-bold text-emerald-600 dark:text-emerald-400">REALTIME SETTLED (FREE)</span>
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
                    onclick="window.showAppAlert({ title: 'JomPAY Receipt Link Copied', subtitle: 'Biller Verification URL', message: 'PayNet JomPAY receipt verification link copied to clipboard.', type: 'success' });"
                    class="p-3 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs transition-all flex items-center justify-center gap-1.5 cursor-pointer active:scale-95"
                >
                    <i data-lucide="share-2" class="w-4 h-4 text-slate-400"></i>
                    <span>Share Receipt</span>
                </button>

                <button
                    type="button"
                    onclick="window.resetJompayAccordion()"
                    class="col-span-2 sm:col-span-1 p-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-950/50 dark:hover:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-bold text-xs transition-all flex items-center justify-center gap-1.5 cursor-pointer active:scale-95"
                >
                    <i data-lucide="repeat" class="w-4 h-4"></i>
                    <span>Pay Another</span>
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
        <div id="jompay-accordion-container" class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-950/5 overflow-hidden animate__animated animate__fadeInUp animate__faster">

            <!-- ── ACCORDION ITEM 1: SELECT BILLER ── -->
            <div class="accordion-item transition-all duration-300" id="jompay-acc-item-1">
                <!-- Accordion Header -->
                <button
                    type="button"
                    onclick="window.toggleJompayAccordionItem(1)"
                    class="w-full p-5 sm:p-6 flex items-center justify-between text-left cursor-pointer hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors group"
                >
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div id="jompay-acc-icon-1" class="w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all">
                            1
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 tracking-tight">Select Biller</h3>
                                <span id="jompay-acc-status-1" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300">
                                    Active
                                </span>
                            </div>
                            <p id="jompay-acc-summary-1" class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">
                                TNB (Code: 5454) • Electricity
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 ml-3">
                        <span id="jompay-acc-edit-1" class="hidden text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Edit</span>
                        <div id="jompay-acc-chevron-1" class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300 rotate-180">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </button>

                <!-- Accordion Body -->
                <div id="jompay-acc-body-1" class="border-t border-slate-100 dark:border-slate-800 p-5 sm:p-6 space-y-6">
                    <!-- Popular Billers Grid -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">Popular Malaysian Billers</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            <button
                                type="button"
                                onclick="window.quickSelectBiller('5454', 'Tenaga Nasional Berhad (TNB)', 'Electricity')"
                                class="p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 hover:border-emerald-500 hover:bg-emerald-50/40 dark:hover:bg-emerald-950/20 text-left transition-all group cursor-pointer active:scale-95"
                            >
                                <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <i data-lucide="zap" class="w-4 h-4"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-900 dark:text-slate-100">TNB</p>
                                <p class="text-[10px] text-slate-400">Code: 5454</p>
                            </button>

                            <button
                                type="button"
                                onclick="window.quickSelectBiller('8888', 'Telekom Malaysia (Unifi)', 'Broadband')"
                                class="p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 hover:border-emerald-500 hover:bg-emerald-50/40 dark:hover:bg-emerald-950/20 text-left transition-all group cursor-pointer active:scale-95"
                            >
                                <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <i data-lucide="wifi" class="w-4 h-4"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Unifi / TM</p>
                                <p class="text-[10px] text-slate-400">Code: 8888</p>
                            </button>

                            <button
                                type="button"
                                onclick="window.quickSelectBiller('9639', 'Astro Malaysia Holdings', 'Satellite TV')"
                                class="p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 hover:border-emerald-500 hover:bg-emerald-50/40 dark:hover:bg-emerald-950/20 text-left transition-all group cursor-pointer active:scale-95"
                            >
                                <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <i data-lucide="tv" class="w-4 h-4"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Astro</p>
                                <p class="text-[10px] text-slate-400">Code: 9639</p>
                            </button>

                            <button
                                type="button"
                                onclick="window.quickSelectBiller('4200', 'Pengurusan Air Selangor', 'Water Utility')"
                                class="p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 hover:border-emerald-500 hover:bg-emerald-50/40 dark:hover:bg-emerald-950/20 text-left transition-all group cursor-pointer active:scale-95"
                            >
                                <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <i data-lucide="droplet" class="w-4 h-4"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Air Selangor</p>
                                <p class="text-[10px] text-slate-400">Code: 4200</p>
                            </button>
                        </div>
                    </div>

                    <!-- Manual Biller Code Search -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">Or Enter Biller Code</label>
                        <div class="relative">
                            <input
                                type="text"
                                id="jompay-biller-code-input"
                                value="5454"
                                placeholder="e.g. 5454 or 8888"
                                maxlength="6"
                                class="w-full py-3.5 pl-4 pr-24 text-base font-bold font-mono tracking-wider rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                            />
                            <button
                                type="button"
                                onclick="window.searchBillerCode()"
                                class="absolute right-2 top-1/2 -translate-y-1/2 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-all cursor-pointer active:scale-95"
                            >
                                Search
                            </button>
                        </div>
                    </div>

                    <!-- Verified Biller Feedback Card -->
                    <div id="verified-biller-card" class="p-4 rounded-2xl bg-emerald-50/80 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/60 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">JomPAY Verified Biller</span>
                                <h4 id="verified-biller-name" class="text-sm font-black text-slate-900 dark:text-slate-100">TENAGA NASIONAL BERHAD (TNB)</h4>
                                <p id="verified-biller-code-text" class="text-[11px] text-slate-500 dark:text-slate-400">Biller Code: 5454 • Electricity</p>
                            </div>
                        </div>
                    </div>

                    <!-- Forward to Step 2 -->
                    <div class="pt-2 flex justify-end">
                        <button
                            type="button"
                            onclick="window.completeJompayAccordionStep1()"
                            class="w-full sm:w-auto px-7 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 active:scale-98 text-white font-bold text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <span>Continue to Bill Account</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ── ACCORDION ITEM 2: BILL ACCOUNT & AMOUNT ── -->
            <div class="accordion-item border-t border-slate-200/80 dark:border-slate-800 transition-all duration-300" id="jompay-acc-item-2">
                <!-- Accordion Header -->
                <button
                    type="button"
                    onclick="window.toggleJompayAccordionItem(2)"
                    class="w-full p-5 sm:p-6 flex items-center justify-between text-left cursor-pointer hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors group"
                >
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div id="jompay-acc-icon-2" class="w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all">
                            2
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 tracking-tight">Bill Account &amp; Amount</h3>
                                <span id="jompay-acc-status-2" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-400">
                                    Pending
                                </span>
                            </div>
                            <p id="jompay-acc-summary-2" class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">
                                Ref-1: 220194881021 • RM 178.40
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 ml-3">
                        <span id="jompay-acc-edit-2" class="hidden text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Edit</span>
                        <div id="jompay-acc-chevron-2" class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </button>

                <!-- Accordion Body -->
                <div id="jompay-acc-body-2" class="hidden border-t border-slate-100 dark:border-slate-800 p-5 sm:p-6 space-y-6">
                    <!-- Selected Biller Badge -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 flex items-center justify-between text-xs">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Target Biller</span>
                            <p id="acc-step2-biller-name" class="font-bold text-slate-900 dark:text-slate-100 text-sm">Tenaga Nasional Berhad (TNB)</p>
                            <p id="acc-step2-biller-code" class="text-[11px] text-slate-500">Biller Code: 5454</p>
                        </div>
                        <button type="button" onclick="window.toggleJompayAccordionItem(1)" class="text-xs font-bold text-emerald-600 hover:underline cursor-pointer">
                            Change Biller
                        </button>
                    </div>

                    <!-- Ref-1 & Ref-2 -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                Ref-1 (Account / Bill No) <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="jompay-ref1-input"
                                value="220194881021"
                                placeholder="Found on your physical or e-bill"
                                class="w-full py-3.5 px-4 text-sm font-mono font-bold tracking-wider rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                Ref-2 <span class="text-slate-400 font-normal">(Optional by Biller)</span>
                            </label>
                            <input
                                type="text"
                                id="jompay-ref2-input"
                                placeholder="Optional reference"
                                class="w-full py-3 px-4 text-xs sm:text-sm rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                            />
                        </div>
                    </div>

                    <!-- Amount Input -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Amount to Pay</label>
                        <div class="relative mb-2.5">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-2xl font-black text-slate-400">RM</span>
                            <input
                                type="number"
                                id="jompay-amount-input"
                                value="178.40"
                                step="0.01"
                                class="w-full py-4 pl-16 pr-4 text-2xl sm:text-3xl font-black rounded-2xl border-2 border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none text-slate-900 dark:text-slate-50 transition-all"
                            />
                        </div>

                        <div class="flex items-center gap-2 overflow-x-auto pb-1">
                            <button type="button" onclick="document.getElementById('jompay-amount-input').value = '50.00'" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 text-xs font-bold hover:border-emerald-500 hover:text-emerald-600 transition-all cursor-pointer shrink-0">
                                RM 50
                            </button>
                            <button type="button" onclick="document.getElementById('jompay-amount-input').value = '100.00'" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 text-xs font-bold hover:border-emerald-500 hover:text-emerald-600 transition-all cursor-pointer shrink-0">
                                RM 100
                            </button>
                            <button type="button" onclick="document.getElementById('jompay-amount-input').value = '178.40'" class="px-3 py-1.5 rounded-xl border border-emerald-300 bg-emerald-50 dark:bg-emerald-950/40 text-xs font-bold text-emerald-700 dark:text-emerald-300 transition-all cursor-pointer shrink-0">
                                Current Outstanding (RM 178.40)
                            </button>
                        </div>
                    </div>

                    <!-- Forward to Step 3 -->
                    <div class="pt-2 flex justify-end">
                        <button
                            type="button"
                            onclick="window.completeJompayAccordionStep2()"
                            class="w-full sm:w-auto px-7 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 active:scale-98 text-white font-bold text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <span>Review Payment</span>
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ── ACCORDION ITEM 3: CONFIRM & BIOMETRIC AUTH ── -->
            <div class="accordion-item border-t border-slate-200/80 dark:border-slate-800 transition-all duration-300" id="jompay-acc-item-3">
                <!-- Accordion Header -->
                <button
                    type="button"
                    onclick="window.toggleJompayAccordionItem(3)"
                    class="w-full p-5 sm:p-6 flex items-center justify-between text-left cursor-pointer hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors group"
                >
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div id="jompay-acc-icon-3" class="w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all">
                            3
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 tracking-tight">Review &amp; Authorize</h3>
                                <span id="jompay-acc-status-3" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-400">
                                    Pending
                                </span>
                            </div>
                            <p id="jompay-acc-summary-3" class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">
                                Ready for PayNet Secure Biometric Verification
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 ml-3">
                        <div id="jompay-acc-chevron-3" class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </button>

                <!-- Accordion Body -->
                <div id="jompay-acc-body-3" class="hidden border-t border-slate-100 dark:border-slate-800 p-5 sm:p-6 space-y-6">
                    <!-- Breakdown Summary -->
                    <div class="bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 divide-y divide-slate-200/60 dark:divide-slate-700/60 text-xs">
                        <div class="flex items-center justify-between p-4">
                            <span class="text-slate-500 dark:text-slate-400">Total Settlement</span>
                            <span id="jompay-review-amount" class="text-lg sm:text-xl font-black text-emerald-600 dark:text-emerald-400">RM 178.40</span>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-slate-500 dark:text-slate-400">Biller</span>
                            <span id="jompay-review-biller" class="font-bold text-slate-900 dark:text-slate-100">TENAGA NASIONAL BERHAD (TNB)</span>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-slate-500 dark:text-slate-400">Biller Code</span>
                            <span id="jompay-review-code" class="font-mono text-slate-700 dark:text-slate-300">5454</span>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-slate-500 dark:text-slate-400">Ref-1 Account</span>
                            <span id="jompay-review-ref1" class="font-mono font-bold text-slate-800 dark:text-slate-200">220194881021</span>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-slate-500 dark:text-slate-400">From Account</span>
                            <span class="font-medium text-slate-700 dark:text-slate-300">{{ $customer->account_type }} (•••• 5678)</span>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-slate-500 dark:text-slate-400">Service Fee</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">FREE (PayNet JomPAY)</span>
                        </div>
                    </div>

                    <!-- Security Info Box -->
                    <div class="p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/60 flex items-start gap-3 text-xs text-emerald-800 dark:text-emerald-300">
                        <i data-lucide="shield-check" class="w-5 h-5 shrink-0 text-emerald-600 mt-0.5"></i>
                        <div>
                            <p class="font-bold">Instant Clearing Settlement</p>
                            <p class="text-[11px] text-emerald-700 dark:text-emerald-400 mt-0.5 leading-relaxed">
                                Official receipt will be updated with your biller within minutes. This transaction is authenticated via your registered {{ $customer->bound_device_name }}.
                            </p>
                        </div>
                    </div>

                    <!-- Biometric Action -->
                    <div class="pt-2">
                        <button
                            type="button"
                            id="jompay-auth-btn"
                            onclick="window.executeJompayAccordionBiometric()"
                            class="w-full py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 active:scale-98 text-white font-bold text-sm shadow-lg shadow-emerald-600/25 transition-all flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <i data-lucide="fingerprint" class="w-5 h-5"></i>
                            <span>Authorize &amp; Pay Bill</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- JomPAY Accordion Controller Scripts -->
    <script>
    (function() {
        let billerState = {
            code: '5454',
            name: 'TENAGA NASIONAL BERHAD (TNB)',
            category: 'Electricity',
            ref1: '220194881021',
            ref2: '',
            amount: 178.40,
        };

        const knownBillers = {
            '5454': { name: 'Tenaga Nasional Berhad (TNB)', cat: 'Electricity' },
            '8888': { name: 'Telekom Malaysia (Unifi)', cat: 'Broadband' },
            '9639': { name: 'Astro Malaysia Holdings', cat: 'Satellite TV' },
            '4200': { name: 'Pengurusan Air Selangor', cat: 'Water Utility' },
            '1020': { name: 'Indah Water Konsortium', cat: 'Sewerage' },
            '2345': { name: 'CelcomDigi Berhad', cat: 'Telco' },
            '1122': { name: 'Maxis Broadband', cat: 'Telco' },
            '8821': { name: 'PTPTN Loan Repayment', cat: 'Education Loan' },
        };

        let currentActiveItem = 1;

        window.toggleJompayAccordionItem = function(n) {
            for (let i = 1; i <= 3; i++) {
                const body = document.getElementById(`jompay-acc-body-${i}`);
                const chevron = document.getElementById(`jompay-acc-chevron-${i}`);
                if (i === n) {
                    const isOpening = body.classList.contains('hidden');
                    if (isOpening) {
                        body.classList.remove('hidden');
                        chevron.classList.add('rotate-180');
                        currentActiveItem = i;
                    } else {
                        body.classList.add('hidden');
                        chevron.classList.remove('rotate-180');
                    }
                } else {
                    body.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
                }
            }
        };

        function openItem(n) {
            for (let i = 1; i <= 3; i++) {
                const body = document.getElementById(`jompay-acc-body-${i}`);
                const chevron = document.getElementById(`jompay-acc-chevron-${i}`);
                if (i === n) {
                    body.classList.remove('hidden');
                    chevron.classList.add('rotate-180');
                    currentActiveItem = i;
                } else {
                    body.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
                }
            }
        }

        window.quickSelectBiller = function(code, name, category) {
            billerState.code = code;
            billerState.name = name;
            billerState.category = category;
            document.getElementById('jompay-biller-code-input').value = code;
            document.getElementById('verified-biller-name').textContent = name.toUpperCase();
            document.getElementById('verified-biller-code-text').textContent = `Biller Code: ${code} • ${category}`;
            document.getElementById('jompay-acc-summary-1').textContent = `${name} (Code: ${code})`;
        };

        window.searchBillerCode = function() {
            const code = document.getElementById('jompay-biller-code-input').value.trim();
            if (!code) {
                alert('Please enter a Biller Code.');
                return;
            }
            const info = knownBillers[code] || { name: 'Verified National JomPAY Merchant', cat: 'Utility / Service' };
            billerState.code = code;
            billerState.name = info.name;
            billerState.category = info.cat;
            document.getElementById('verified-biller-name').textContent = info.name.toUpperCase();
            document.getElementById('verified-biller-code-text').textContent = `Biller Code: ${code} • ${info.cat}`;
            document.getElementById('jompay-acc-summary-1').textContent = `${info.name} (Code: ${code})`;
        };

        window.completeJompayAccordionStep1 = function() {
            // Update summary
            document.getElementById('jompay-acc-summary-1').textContent = `${billerState.name} (Code: ${billerState.code})`;
            
            // Mark Step 1 complete
            const icon1 = document.getElementById('jompay-acc-icon-1');
            icon1.className = "w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all";
            icon1.innerHTML = '<i data-lucide="check" class="w-5 h-5 stroke-[2.5]"></i>';
            
            const status1 = document.getElementById('jompay-acc-status-1');
            status1.className = "px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300";
            status1.textContent = "Completed ✓";
            document.getElementById('jompay-acc-edit-1').classList.remove('hidden');

            // Sync step 2 preview
            document.getElementById('acc-step2-biller-name').textContent = billerState.name;
            document.getElementById('acc-step2-biller-code').textContent = 'Biller Code: ' + billerState.code;

            // Activate Step 2
            const icon2 = document.getElementById('jompay-acc-icon-2');
            icon2.className = "w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all";
            const status2 = document.getElementById('jompay-acc-status-2');
            status2.className = "px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300";
            status2.textContent = "Active";

            openItem(2);
            if (window.lucide) window.lucide.createIcons();
        };

        window.completeJompayAccordionStep2 = function() {
            const ref1 = document.getElementById('jompay-ref1-input').value.trim();
            const amt = parseFloat(document.getElementById('jompay-amount-input').value);
            if (!ref1) {
                alert('Please enter Ref-1 (Account or Bill Number).');
                return;
            }
            if (isNaN(amt) || amt <= 0) {
                alert('Please enter a valid payment amount.');
                return;
            }

            billerState.ref1 = ref1;
            billerState.amount = amt;

            // Update Step 2 summary
            document.getElementById('jompay-acc-summary-2').textContent = `Ref-1: ${ref1} • RM ${amt.toFixed(2)}`;

            // Mark Step 2 complete
            const icon2 = document.getElementById('jompay-acc-icon-2');
            icon2.className = "w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all";
            icon2.innerHTML = '<i data-lucide="check" class="w-5 h-5 stroke-[2.5]"></i>';

            const status2 = document.getElementById('jompay-acc-status-2');
            status2.className = "px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300";
            status2.textContent = "Completed ✓";
            document.getElementById('jompay-acc-edit-2').classList.remove('hidden');

            // Populate Step 3 review
            document.getElementById('jompay-review-amount').textContent = 'RM ' + amt.toFixed(2);
            document.getElementById('jompay-review-biller').textContent = billerState.name;
            document.getElementById('jompay-review-code').textContent = billerState.code;
            document.getElementById('jompay-review-ref1').textContent = ref1;

            // Activate Step 3
            const icon3 = document.getElementById('jompay-acc-icon-3');
            icon3.className = "w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all";
            const status3 = document.getElementById('jompay-acc-status-3');
            status3.className = "px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300";
            status3.textContent = "Ready";

            openItem(3);
            if (window.lucide) window.lucide.createIcons();
        };

        window.executeJompayAccordionBiometric = function() {
            const btn = document.getElementById('jompay-auth-btn');
            btn.innerHTML = `<span class="animate-spin mr-2">◌</span> Authorizing via Hardware Enclave...`;
            btn.disabled = true;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch('{{ route("customer.jompay.submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    biller_code: billerState.code,
                    ref_1: billerState.ref1,
                    ref_2: billerState.ref2 || null,
                    amount: billerState.amount,
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('jompay-receipt-amount').textContent = 'RM ' + parseFloat(data.amount).toFixed(2);
                    document.getElementById('jompay-receipt-ref').textContent = data.reference;
                    document.getElementById('jompay-receipt-biller').textContent = data.biller_name;
                    document.getElementById('jompay-receipt-code-ref').textContent = `${data.biller_code} • ${data.ref_1}`;
                    document.getElementById('jompay-receipt-time').textContent = data.date;

                    // Hide Accordion & Show Receipt
                    document.getElementById('jompay-accordion-container').classList.add('hidden');
                    document.getElementById('jompay-success-card').classList.remove('hidden');
                    window.scrollTo({ top: 0, behavior: 'smooth' });

                    if (window.lucide) window.lucide.createIcons();
                } else {
                    alert(data.message || 'Payment failed.');
                    btn.innerHTML = `<i data-lucide="fingerprint" class="w-5 h-5"></i><span>Authorize &amp; Pay Bill</span>`;
                    btn.disabled = false;
                    if (window.lucide) window.lucide.createIcons();
                }
            })
            .catch(err => {
                console.error(err);
                alert('JomPAY submission failed due to a network or server issue.');
                btn.innerHTML = `<i data-lucide="fingerprint" class="w-5 h-5"></i><span>Authorize &amp; Pay Bill</span>`;
                btn.disabled = false;
                if (window.lucide) window.lucide.createIcons();
            });
        };

        window.resetJompayAccordion = function() {
            document.getElementById('jompay-success-card').classList.add('hidden');
            document.getElementById('jompay-accordion-container').classList.remove('hidden');

            const btn = document.getElementById('jompay-auth-btn');
            btn.innerHTML = `<i data-lucide="fingerprint" class="w-5 h-5"></i><span>Authorize &amp; Pay Bill</span>`;
            btn.disabled = false;

            // Reset Item 1
            const icon1 = document.getElementById('jompay-acc-icon-1');
            icon1.className = "w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all";
            icon1.textContent = "1";
            const status1 = document.getElementById('jompay-acc-status-1');
            status1.className = "px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300";
            status1.textContent = "Active";
            document.getElementById('jompay-acc-edit-1').classList.add('hidden');

            // Reset Item 2
            const icon2 = document.getElementById('jompay-acc-icon-2');
            icon2.className = "w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all";
            icon2.textContent = "2";
            const status2 = document.getElementById('jompay-acc-status-2');
            status2.className = "px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-400";
            status2.textContent = "Pending";
            document.getElementById('jompay-acc-edit-2').classList.add('hidden');

            // Reset Item 3
            const icon3 = document.getElementById('jompay-acc-icon-3');
            icon3.className = "w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm shrink-0 transition-all";
            icon3.textContent = "3";
            const status3 = document.getElementById('jompay-acc-status-3');
            status3.className = "px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-400";
            status3.textContent = "Pending";

            openItem(1);
            if (window.lucide) window.lucide.createIcons();
        };

        // Initialize icons on mount
        setTimeout(() => {
            if (window.lucide) window.lucide.createIcons();
        }, 100);
    })();
    </script>

</x-layout.customer>

