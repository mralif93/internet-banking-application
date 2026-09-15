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

// Cards Portfolio Dataset
$cards = [
    [
        'id' => 'card-debit',
        'type' => 'debit',
        'brand' => 'Mastercard',
        'name' => 'Debit Mastercard-i',
        'tier' => 'Primary Linked',
        'number_masked' => '5421 •••• •••• 9012',
        'number_full' => '5421 8841 9012 9012',
        'expiry' => '08/29',
        'cvv' => '382',
        'holder' => 'AHMAD DANIEL BIN ALIF',
        'status' => 'active', // active, frozen, locked
        'theme' => 'emerald',
        'bg_gradient' => 'from-emerald-700 via-emerald-800 to-teal-950',
        'border_color' => 'border-emerald-500/40',
        'account_linked' => 'Savings Account-i (1640 1234 5678)',
        'limits' => [
            'atm_withdrawal' => ['current' => 3000, 'min' => 500, 'max' => 10000, 'step' => 500],
            'pos_purchase' => ['current' => 5000, 'min' => 1000, 'max' => 20000, 'step' => 1000],
            'online_purchase' => ['current' => 3000, 'min' => 0, 'max' => 10000, 'step' => 500],
            'contactless_wave' => ['current' => 250, 'min' => 50, 'max' => 500, 'step' => 50],
        ],
        'toggles' => [
            'online' => true,
            'overseas' => false,
            'contactless' => true,
            'atm' => true,
        ],
        'recent_spends' => [
            ['title' => 'PETRONAS Dagangan Berhad', 'date' => 'Today, 1:15 PM', 'amount' => '85.00', 'status' => 'Success'],
            ['title' => 'FamilyMart Nu Sentral', 'date' => '26 Aug 2026', 'amount' => '24.60', 'status' => 'Success'],
            ['title' => 'Jaya Grocer Bangsar', 'date' => '18 May 2026', 'amount' => '142.30', 'status' => 'Success'],
        ]
    ],
    [
        'id' => 'card-visa',
        'type' => 'virtual',
        'brand' => 'Visa',
        'name' => 'Virtual Visa Infinite-i',
        'tier' => '3D Secure Virtual',
        'number_masked' => '4111 •••• •••• 8842',
        'number_full' => '4111 6204 8842 8842',
        'expiry' => '12/28',
        'cvv' => '914',
        'holder' => 'AHMAD DANIEL BIN ALIF',
        'status' => 'active',
        'theme' => 'indigo',
        'bg_gradient' => 'from-indigo-950 via-slate-900 to-purple-950',
        'border_color' => 'border-indigo-500/40',
        'account_linked' => 'Credit Facility-i (Credit Limit: RM 20,000)',
        'limits' => [
            'atm_withdrawal' => ['current' => 5000, 'min' => 1000, 'max' => 10000, 'step' => 500],
            'pos_purchase' => ['current' => 15000, 'min' => 1000, 'max' => 20000, 'step' => 1000],
            'online_purchase' => ['current' => 10000, 'min' => 0, 'max' => 20000, 'step' => 1000],
            'contactless_wave' => ['current' => 250, 'min' => 50, 'max' => 500, 'step' => 50],
        ],
        'toggles' => [
            'online' => true,
            'overseas' => true,
            'contactless' => true,
            'atm' => false,
        ],
        'recent_spends' => [
            ['title' => 'Apple Services Malaysia', 'date' => '02 Sep 2026', 'amount' => '49.90', 'status' => 'Success'],
            ['title' => 'Netflix Subscription', 'date' => '25 Aug 2026', 'amount' => '55.00', 'status' => 'Success'],
            ['title' => 'GrabFood Delivery', 'date' => '21 Aug 2026', 'amount' => '38.40', 'status' => 'Success'],
        ]
    ],
    [
        'id' => 'card-world',
        'type' => 'credit',
        'brand' => 'Mastercard',
        'name' => 'World Mastercard-i (Metal)',
        'tier' => 'Premier Banking',
        'number_masked' => '5218 •••• •••• 1009',
        'number_full' => '5218 9012 3410 1009',
        'expiry' => '04/30',
        'cvv' => '501',
        'holder' => 'AHMAD DANIEL BIN ALIF',
        'status' => 'active',
        'theme' => 'slate',
        'bg_gradient' => 'from-slate-900 via-slate-800 to-indigo-950',
        'border_color' => 'border-slate-700',
        'account_linked' => 'Premier Multi-Currency Account (RM 45,000)',
        'limits' => [
            'atm_withdrawal' => ['current' => 10000, 'min' => 1000, 'max' => 20000, 'step' => 1000],
            'pos_purchase' => ['current' => 20000, 'min' => 2000, 'max' => 50000, 'step' => 2000],
            'online_purchase' => ['current' => 15000, 'min' => 1000, 'max' => 30000, 'step' => 1000],
            'contactless_wave' => ['current' => 500, 'min' => 100, 'max' => 1000, 'step' => 100],
        ],
        'toggles' => [
            'online' => true,
            'overseas' => true,
            'contactless' => true,
            'atm' => true,
        ],
        'recent_spends' => [
            ['title' => 'Plaza Premium Lounge KLIA', 'date' => '10 Aug 2026', 'amount' => '0.00', 'status' => 'Complimentary'],
            ['title' => 'The St. Regis Kuala Lumpur', 'date' => '04 Aug 2026', 'amount' => '1250.00', 'status' => 'Success'],
            ['title' => 'Samsonite Suria KLCC', 'date' => '29 Jul 2026', 'amount' => '890.00', 'status' => 'Success'],
        ]
    ]
];
@endphp

<x-layout.customer title="Manage Cards &amp; Limits — BankFlow MY" activeNav="cards">

    <div class="space-y-4 sm:space-y-6 pb-2 sm:pb-4">

        <!-- STANDARD PAGE HEADER -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            3 Cards Active
                        </span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">
                            Customer: {{ $customer->username }}
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        Manage Cards &amp; Limits
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">Instant Freeze, PIN Change &amp; Spending Limits</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            EMV 3D-Secure 2.2
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0">
                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all active:scale-[0.98] shadow-2xs group cursor-pointer"
                    >
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-slate-500"></i>
                        <span>Dashboard</span>
                    </a>
                    <button
                        type="button"
                        onclick="window.requestNewCardModal()"
                        class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-xs shadow-emerald-600/25 transition-all active:scale-[0.98] cursor-pointer"
                    >
                        <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
                        <span>Apply New Card</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- CARDS SELECTOR STRIP (Mobile Dropdown + Desktop Card Selector Tabs) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInUp animate__faster">
            <!-- Mobile Selector Dropdown (< sm) -->
            <div class="sm:hidden">
                <label for="mobile-card-select" class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                    Select Active Card
                </label>
                <div class="relative">
                    <select
                        id="mobile-card-select"
                        onchange="window.selectActiveCard(this.value)"
                        class="w-full px-3.5 py-2.5 rounded-xl text-xs font-bold border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-emerald-500 appearance-none cursor-pointer"
                    >
                        @foreach ($cards as $idx => $c)
                            <option value="{{ $c['id'] }}" {{ $idx === 0 ? 'selected' : '' }}>
                                {{ $c['name'] }} ({{ substr($c['number_masked'], -4) }}) • {{ $c['tier'] }}
                            </option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <!-- Desktop / Tablet Pill Buttons (sm+) -->
            <div class="hidden sm:flex items-center gap-2.5 overflow-x-auto pb-0.5" id="desktop-card-pills">
                @foreach ($cards as $idx => $c)
                    <button
                        type="button"
                        onclick="window.selectActiveCard('{{ $c['id'] }}')"
                        id="card-tab-btn-{{ $c['id'] }}"
                        class="card-tab-btn flex-1 min-w-[200px] p-3 rounded-xl border text-left transition-all cursor-pointer {{ $idx === 0 ? 'border-emerald-500 bg-emerald-50/60 dark:bg-emerald-950/30 text-emerald-900 dark:text-emerald-100 ring-1 ring-emerald-500/30 shadow-xs' : 'border-slate-200/80 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/40 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-wider {{ $idx === 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400' }}">
                                {{ $c['brand'] }}
                            </span>
                            <span class="text-[9px] px-1.5 py-0.2 rounded-full font-bold {{ $c['status'] === 'active' ? 'bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300' : 'bg-rose-100 text-rose-700' }}">
                                {{ ucfirst($c['status']) }}
                            </span>
                        </div>
                        <p class="text-xs font-bold mt-1 truncate">{{ $c['name'] }}</p>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">{{ $c['number_masked'] }}</p>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- MAIN CARDS MANAGEMENT PANEL (Two Column Layout: Card Visual Left + Controls Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-start animate__animated animate__fadeInUp animate__faster">

            <!-- LEFT COLUMN: Card Showcase, Sensitive Data Reveal & Quick Actions (lg:col-span-5) -->
            <div class="lg:col-span-5 space-y-4">

                <!-- Dynamic Visual Card Display -->
                <div id="active-card-visual" class="relative rounded-2xl sm:rounded-3xl p-5 sm:p-6 text-white overflow-hidden shadow-2xl transition-all duration-300 border bg-gradient-to-br from-emerald-700 via-emerald-800 to-teal-950 border-emerald-500/40">
                    <!-- Glow Accents -->
                    <div class="absolute -right-10 -bottom-10 w-44 h-44 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                    <div class="absolute -left-10 -top-10 w-36 h-36 rounded-full bg-emerald-400/10 blur-xl pointer-events-none"></div>

                    <!-- Top Bar: Bank Logo & Freeze Status Badge -->
                    <div class="relative z-10 flex items-center justify-between mb-8">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white font-black text-xs shadow-inner">
                                <i data-lucide="landmark" class="w-4 h-4"></i>
                            </div>
                            <span class="font-black text-sm tracking-tight text-white/95">BankFlow MY</span>
                            <span class="text-[9px] font-black uppercase px-1.5 py-0.5 rounded bg-white/15 text-emerald-200">ISLAMIC</span>
                        </div>

                        <div class="flex items-center gap-1.5">
                            <span id="visual-card-frozen-badge" class="hidden px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-500/90 text-white shadow-xs animate-pulse">
                                <i data-lucide="lock" class="w-3 h-3 inline mr-1"></i> FROZEN
                            </span>
                            <span id="visual-card-brand-badge" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-white/15 text-white backdrop-blur-xs">
                                Mastercard
                            </span>
                        </div>
                    </div>

                    <!-- EMV Chip & Contactless Wave -->
                    <div class="relative z-10 flex items-center justify-between mb-6">
                        <div class="w-10 h-7 rounded-md bg-amber-300/90 border border-amber-200 flex items-center justify-center shadow-inner">
                            <div class="w-5 h-4 border border-amber-700/40 rounded-xs"></div>
                        </div>
                        <i data-lucide="wifi" class="w-5 h-5 text-white/80 rotate-90"></i>
                    </div>

                    <!-- Card Number (Masked / Revealed) -->
                    <div class="relative z-10 mb-4">
                        <p class="text-[10px] font-mono uppercase text-emerald-200/80 tracking-wider">Card Number</p>
                        <div class="flex items-center justify-between gap-2 mt-0.5">
                            <p id="visual-card-number" class="font-mono text-base sm:text-lg font-bold tracking-widest text-white drop-shadow-sm">
                                5421 •••• •••• 9012
                            </p>
                            <button
                                type="button"
                                id="btn-toggle-reveal-card"
                                onclick="window.toggleCardNumberReveal()"
                                class="p-1.5 rounded-lg bg-white/15 hover:bg-white/25 text-white transition-colors cursor-pointer text-xs flex items-center gap-1"
                                title="Show / Hide Full Card Details"
                            >
                                <i data-lucide="eye" id="icon-reveal-card" class="w-3.5 h-3.5"></i>
                                <span class="text-[10px] font-semibold" id="text-reveal-card">Reveal</span>
                            </button>
                        </div>
                    </div>

                    <!-- Bottom Bar: Expiry, CVV & Holder -->
                    <div class="relative z-10 flex items-end justify-between border-t border-white/15 pt-3 mt-2 text-xs">
                        <div>
                            <p class="text-[9px] uppercase tracking-wider text-emerald-200/80">Cardholder</p>
                            <p id="visual-card-holder" class="font-bold tracking-tight text-white truncate max-w-[170px] sm:max-w-[200px]">
                                AHMAD DANIEL BIN ALIF
                            </p>
                        </div>

                        <div class="flex items-center gap-4 text-right">
                            <div>
                                <p class="text-[9px] uppercase tracking-wider text-emerald-200/80">Expires</p>
                                <p id="visual-card-expiry" class="font-mono font-bold text-white">08/29</p>
                            </div>
                            <div>
                                <p class="text-[9px] uppercase tracking-wider text-emerald-200/80">CVV</p>
                                <p id="visual-card-cvv" class="font-mono font-bold text-white">•••</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Quick Actions Box (Freeze, PIN, Replace) -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-3">
                    <h3 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        Security Quick Actions
                    </h3>

                    <!-- Instant Lock Toggle Hero -->
                    <div class="p-3.5 rounded-xl sm:rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div id="quick-action-lock-icon" class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <i data-lucide="shield-check" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-100">
                                    Card State: <span id="quick-action-status-text" class="text-emerald-600 font-extrabold">Active</span>
                                </p>
                                <p class="text-[10px] text-slate-400 truncate">Instantly decline authorizations if misplaced</p>
                            </div>
                        </div>
                        <button
                            type="button"
                            id="btn-toggle-freeze"
                            onclick="window.toggleCurrentCardFreeze()"
                            class="px-3 py-1.5 rounded-xl text-xs font-bold bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-950/40 dark:hover:text-rose-400 transition-all cursor-pointer shrink-0 shadow-2xs"
                        >
                            Freeze Card
                        </button>
                    </div>

                    <!-- Quick buttons grid -->
                    <div class="grid grid-cols-2 gap-2.5">
                        <button
                            type="button"
                            onclick="window.openChangePinModal()"
                            class="p-3 rounded-xl border border-slate-200/90 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-800/40 hover:bg-slate-100 dark:hover:bg-slate-800 text-left transition-colors cursor-pointer group"
                        >
                            <i data-lucide="key-round" class="w-4 h-4 text-emerald-600 mb-1 group-hover:scale-110 transition-transform"></i>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Change PIN</p>
                            <p class="text-[10px] text-slate-400">Update 6-digit ATM PIN</p>
                        </button>

                        <button
                            type="button"
                            onclick="window.openReplaceCardModal()"
                            class="p-3 rounded-xl border border-slate-200/90 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-800/40 hover:bg-slate-100 dark:hover:bg-slate-800 text-left transition-colors cursor-pointer group"
                        >
                            <i data-lucide="refresh-cw" class="w-4 h-4 text-indigo-600 mb-1 group-hover:rotate-180 transition-transform duration-500"></i>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Replace Card</p>
                            <p class="text-[10px] text-slate-400">Damaged, stolen or renew</p>
                        </button>
                    </div>
                </div>

                <!-- Recent Card Spending Activity Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            Recent Card Spends
                        </h3>
                        <a href="{{ route('customer.history') }}" class="text-[11px] font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                            Full History &rarr;
                        </a>
                    </div>
                    <div class="divide-y divide-slate-100 dark:divide-slate-800/60 mt-1" id="card-recent-spends-container">
                        <!-- Populated by JS on card switch -->
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Daily Transaction Limits Sliders & Channel Toggles (lg:col-span-7) -->
            <div class="lg:col-span-7 space-y-4 sm:space-y-6">

                <!-- 1. DAILY SPENDING & WITHDRAWAL LIMITS -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 border-b border-slate-100 dark:border-slate-800/80 gap-2">
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Instant Real-Time Effect
                                </span>
                            </div>
                            <h2 class="text-sm sm:text-lg font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1">
                                Daily Spending &amp; Withdrawal Limits
                            </h2>
                        </div>
                        <span class="text-xs text-slate-400 font-medium">Bank Negara MY Regulated</span>
                    </div>

                    <!-- Limit Sliders -->
                    <div class="space-y-5">
                        <!-- ATM Withdrawal Limit -->
                        <div class="p-3.5 sm:p-4 rounded-xl bg-slate-50/70 dark:bg-slate-800/40 border border-slate-200/70 dark:border-slate-800">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-emerald-50 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center">
                                        <i data-lucide="banknote" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100">Daily ATM Cash Withdrawal</p>
                                        <p class="text-[10px] text-slate-400">MEPS, BankFlow &amp; International ATMs</p>
                                    </div>
                                </div>
                                <span id="label-atm-limit" class="text-sm font-black text-emerald-600 dark:text-emerald-400">RM 3,000</span>
                            </div>
                            <input
                                type="range"
                                id="range-atm-limit"
                                min="500"
                                max="10000"
                                step="500"
                                value="3000"
                                oninput="document.getElementById('label-atm-limit').textContent = 'RM ' + parseInt(this.value).toLocaleString()"
                                class="w-full accent-emerald-600 cursor-pointer mt-2"
                            />
                            <div class="flex justify-between text-[10px] text-slate-400 font-mono mt-1">
                                <span id="min-atm-limit">RM 500</span>
                                <span>Max: <strong id="max-atm-limit">RM 10,000</strong></span>
                            </div>
                        </div>

                        <!-- POS & Retail Merchant Purchases -->
                        <div class="p-3.5 sm:p-4 rounded-xl bg-slate-50/70 dark:bg-slate-800/40 border border-slate-200/70 dark:border-slate-800">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 dark:bg-indigo-950 text-indigo-600 flex items-center justify-center">
                                        <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100">Daily In-Store POS Purchases</p>
                                        <p class="text-[10px] text-slate-400">Physical terminal chip &amp; PIN purchases</p>
                                    </div>
                                </div>
                                <span id="label-pos-limit" class="text-sm font-black text-emerald-600 dark:text-emerald-400">RM 5,000</span>
                            </div>
                            <input
                                type="range"
                                id="range-pos-limit"
                                min="1000"
                                max="20000"
                                step="1000"
                                value="5000"
                                oninput="document.getElementById('label-pos-limit').textContent = 'RM ' + parseInt(this.value).toLocaleString()"
                                class="w-full accent-emerald-600 cursor-pointer mt-2"
                            />
                            <div class="flex justify-between text-[10px] text-slate-400 font-mono mt-1">
                                <span id="min-pos-limit">RM 1,000</span>
                                <span>Max: <strong id="max-pos-limit">RM 20,000</strong></span>
                            </div>
                        </div>

                        <!-- Online & E-Commerce Purchases Limit -->
                        <div class="p-3.5 sm:p-4 rounded-xl bg-slate-50/70 dark:bg-slate-800/40 border border-slate-200/70 dark:border-slate-800">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-pink-50 dark:bg-pink-950 text-pink-600 flex items-center justify-center">
                                        <i data-lucide="globe" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100">Daily Online &amp; E-Commerce</p>
                                        <p class="text-[10px] text-slate-400">Shopee, Lazada, Grab, Apple &amp; web checkouts</p>
                                    </div>
                                </div>
                                <span id="label-online-limit" class="text-sm font-black text-emerald-600 dark:text-emerald-400">RM 3,000</span>
                            </div>
                            <input
                                type="range"
                                id="range-online-limit"
                                min="0"
                                max="10000"
                                step="500"
                                value="3000"
                                oninput="document.getElementById('label-online-limit').textContent = 'RM ' + parseInt(this.value).toLocaleString()"
                                class="w-full accent-emerald-600 cursor-pointer mt-2"
                            />
                            <div class="flex justify-between text-[10px] text-slate-400 font-mono mt-1">
                                <span id="min-online-limit">RM 0 (Disabled)</span>
                                <span>Max: <strong id="max-online-limit">RM 10,000</strong></span>
                            </div>
                        </div>

                        <!-- Contactless PayWave / Tap Limit -->
                        <div class="p-3.5 sm:p-4 rounded-xl bg-slate-50/70 dark:bg-slate-800/40 border border-slate-200/70 dark:border-slate-800">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950 text-teal-600 flex items-center justify-center">
                                        <i data-lucide="radio" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100">Contactless PIN-less Limit per Transaction</p>
                                        <p class="text-[10px] text-slate-400">Tap without PIN (Max RM 250 without PIN by default)</p>
                                    </div>
                                </div>
                                <span id="label-wave-limit" class="text-sm font-black text-emerald-600 dark:text-emerald-400">RM 250</span>
                            </div>
                            <input
                                type="range"
                                id="range-wave-limit"
                                min="50"
                                max="500"
                                step="50"
                                value="250"
                                oninput="document.getElementById('label-wave-limit').textContent = 'RM ' + parseInt(this.value).toLocaleString()"
                                class="w-full accent-emerald-600 cursor-pointer mt-2"
                            />
                            <div class="flex justify-between text-[10px] text-slate-400 font-mono mt-1">
                                <span id="min-wave-limit">RM 50</span>
                                <span>Max: <strong id="max-wave-limit">RM 500</strong></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. CHANNEL CONTROLS & SECURITY PERMISSIONS -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4">
                    <div class="pb-3 border-b border-slate-100 dark:border-slate-800/80">
                        <h2 class="text-sm sm:text-base font-black text-slate-900 dark:text-slate-100 tracking-tight">
                            Usage &amp; Channel Permissions
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Toggle specific transaction channels on or off instantly</p>
                    </div>

                    <div class="space-y-2.5">
                        <!-- Overseas / Cross-border Toggle -->
                        <div class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200/80 dark:border-slate-800 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 flex items-center justify-center shrink-0">
                                    <i data-lucide="plane-takeoff" class="w-4.5 h-4.5"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Overseas / International Usage</p>
                                    <p class="text-[10px] text-slate-400">Allow card transactions and foreign ATM withdrawals outside Malaysia</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-overseas" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </label>
                        </div>

                        <!-- Online & CNP Purchases Toggle -->
                        <div class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200/80 dark:border-slate-800 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-pink-50 dark:bg-pink-950/60 text-pink-600 flex items-center justify-center shrink-0">
                                    <i data-lucide="shopping-cart" class="w-4.5 h-4.5"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Online &amp; Card-Not-Present (CNP)</p>
                                    <p class="text-[10px] text-slate-400">Permit internet checkouts and mail-order/telephone transactions</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-online" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </label>
                        </div>

                        <!-- Contactless / PayWave Toggle -->
                        <div class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200/80 dark:border-slate-800 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 flex items-center justify-center shrink-0">
                                    <i data-lucide="wifi" class="w-4.5 h-4.5 rotate-90"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Contactless Wave / PayPass</p>
                                    <p class="text-[10px] text-slate-400">Enable NFC tap-to-pay on retail point-of-sale terminals</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-contactless" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Save Card Settings Button -->
                    <div class="pt-2">
                        <button
                            type="button"
                            onclick="window.saveCurrentCardLimits()"
                            class="w-full py-3 sm:py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm shadow-md shadow-emerald-600/25 transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.99]"
                        >
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Save Card Limits &amp; Permissions</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- CHANGE CARD PIN MODAL -->
    <div id="change-pin-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden" role="dialog" aria-modal="true">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-sm w-full p-5 sm:p-6 border border-slate-200 dark:border-slate-800 shadow-2xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="key-round" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Change 6-Digit PIN</h3>
                </div>
                <button type="button" onclick="window.closeModal('change-pin-modal')" class="p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-lg">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Current PIN</label>
                    <input type="password" maxlength="6" id="input-old-pin" placeholder="••••••" class="w-full text-center text-lg tracking-widest py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">New 6-Digit PIN</label>
                    <input type="password" maxlength="6" id="input-new-pin" placeholder="••••••" class="w-full text-center text-lg tracking-widest py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Confirm New PIN</label>
                    <input type="password" maxlength="6" id="input-confirm-pin" placeholder="••••••" class="w-full text-center text-lg tracking-widest py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <button type="button" onclick="window.submitPinChange()" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-xs transition-all cursor-pointer">
                Confirm &amp; Update PIN
            </button>
        </div>
    </div>

    <!-- REPLACE CARD MODAL -->
    <div id="replace-card-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden" role="dialog" aria-modal="true">
        <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-sm w-full p-5 sm:p-6 border border-slate-200 dark:border-slate-800 shadow-2xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-indigo-100 dark:bg-indigo-950 text-indigo-600 flex items-center justify-center">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Request Card Replacement</h3>
                </div>
                <button type="button" onclick="window.closeModal('replace-card-modal')" class="p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-lg">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Reason for Replacement</label>
                    <select id="select-replace-reason" class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200">
                        <option value="damaged">Damaged / Chip Defective</option>
                        <option value="lost">Lost or Misplaced Card</option>
                        <option value="fraud">Suspected Compromise / Fraud</option>
                        <option value="upgrade">Upgrade to Metal Card</option>
                    </select>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800 text-[11px] text-slate-500 space-y-1">
                    <p><strong>Delivery Address:</strong></p>
                    <p>Ahmad Daniel, No. 12 Jalan Bangsar Utama 3, 59000 Kuala Lumpur.</p>
                    <p class="text-emerald-600 font-semibold mt-1">Delivery ETA: 3-5 Working Days (PosLaju Courier)</p>
                </div>
            </div>

            <button type="button" onclick="window.submitCardReplacement()" class="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs shadow-xs transition-all cursor-pointer">
                Confirm Replacement (RM 12.00 Waived)
            </button>
        </div>
    </div>

    <!-- Client-Side State & Controller Script -->
    <script>
    (function() {
        const cardsData = @json($cards);
        let activeCardId = 'card-debit';
        let isCardDetailsRevealed = false;

        window.selectActiveCard = function(cardId) {
            activeCardId = cardId;
            const card = cardsData.find(c => c.id === cardId);
            if (!card) return;

            // 1. Sync mobile select & desktop pills
            const mobileSelect = document.getElementById('mobile-card-select');
            if (mobileSelect) mobileSelect.value = cardId;

            document.querySelectorAll('#desktop-card-pills .card-tab-btn').forEach(b => {
                b.classList.remove('border-emerald-500', 'bg-emerald-50/60', 'dark:bg-emerald-950/30', 'text-emerald-900', 'dark:text-emerald-100', 'ring-1', 'ring-emerald-500/30', 'shadow-xs');
                b.classList.add('border-slate-200/80', 'dark:border-slate-800', 'bg-slate-50/50', 'dark:bg-slate-800/40', 'text-slate-600', 'dark:text-slate-300');
            });
            const activeTab = document.getElementById(`card-tab-btn-${cardId}`);
            if (activeTab) {
                activeTab.classList.remove('border-slate-200/80', 'dark:border-slate-800', 'bg-slate-50/50', 'dark:bg-slate-800/40', 'text-slate-600', 'dark:text-slate-300');
                activeTab.classList.add('border-emerald-500', 'bg-emerald-50/60', 'dark:bg-emerald-950/30', 'text-emerald-900', 'dark:text-emerald-100', 'ring-1', 'ring-emerald-500/30', 'shadow-xs');
            }

            // 2. Update Visual Card
            const visual = document.getElementById('active-card-visual');
            if (visual) {
                // remove existing gradient
                visual.className = `relative rounded-2xl sm:rounded-3xl p-5 sm:p-6 text-white overflow-hidden shadow-2xl transition-all duration-300 border bg-gradient-to-br ${card.bg_gradient} ${card.border_color}`;
            }

            document.getElementById('visual-card-brand-badge').textContent = card.brand;
            document.getElementById('visual-card-number').textContent = isCardDetailsRevealed ? card.number_full : card.number_masked;
            document.getElementById('visual-card-holder').textContent = card.holder;
            document.getElementById('visual-card-expiry').textContent = card.expiry;
            document.getElementById('visual-card-cvv').textContent = isCardDetailsRevealed ? card.cvv : '•••';

            // 3. Update Status Badge & Freeze Button
            updateFreezeUI(card.status === 'frozen');

            // 4. Update Sliders
            const atmSlider = document.getElementById('range-atm-limit');
            const posSlider = document.getElementById('range-pos-limit');
            const onlineSlider = document.getElementById('range-online-limit');
            const waveSlider = document.getElementById('range-wave-limit');

            if (atmSlider) {
                atmSlider.min = card.limits.atm_withdrawal.min;
                atmSlider.max = card.limits.atm_withdrawal.max;
                atmSlider.step = card.limits.atm_withdrawal.step;
                atmSlider.value = card.limits.atm_withdrawal.current;
                document.getElementById('label-atm-limit').textContent = 'RM ' + parseInt(card.limits.atm_withdrawal.current).toLocaleString();
                document.getElementById('min-atm-limit').textContent = 'RM ' + card.limits.atm_withdrawal.min;
                document.getElementById('max-atm-limit').textContent = 'RM ' + card.limits.atm_withdrawal.max.toLocaleString();
            }

            if (posSlider) {
                posSlider.min = card.limits.pos_purchase.min;
                posSlider.max = card.limits.pos_purchase.max;
                posSlider.step = card.limits.pos_purchase.step;
                posSlider.value = card.limits.pos_purchase.current;
                document.getElementById('label-pos-limit').textContent = 'RM ' + parseInt(card.limits.pos_purchase.current).toLocaleString();
                document.getElementById('min-pos-limit').textContent = 'RM ' + card.limits.pos_purchase.min;
                document.getElementById('max-pos-limit').textContent = 'RM ' + card.limits.pos_purchase.max.toLocaleString();
            }

            if (onlineSlider) {
                onlineSlider.min = card.limits.online_purchase.min;
                onlineSlider.max = card.limits.online_purchase.max;
                onlineSlider.step = card.limits.online_purchase.step;
                onlineSlider.value = card.limits.online_purchase.current;
                document.getElementById('label-online-limit').textContent = 'RM ' + parseInt(card.limits.online_purchase.current).toLocaleString();
                document.getElementById('max-online-limit').textContent = 'RM ' + card.limits.online_purchase.max.toLocaleString();
            }

            if (waveSlider) {
                waveSlider.min = card.limits.contactless_wave.min;
                waveSlider.max = card.limits.contactless_wave.max;
                waveSlider.step = card.limits.contactless_wave.step;
                waveSlider.value = card.limits.contactless_wave.current;
                document.getElementById('label-wave-limit').textContent = 'RM ' + parseInt(card.limits.contactless_wave.current).toLocaleString();
                document.getElementById('max-wave-limit').textContent = 'RM ' + card.limits.contactless_wave.max.toLocaleString();
            }

            // 5. Update Toggles
            document.getElementById('toggle-overseas').checked = card.toggles.overseas;
            document.getElementById('toggle-online').checked = card.toggles.online;
            document.getElementById('toggle-contactless').checked = card.toggles.contactless;

            // 6. Update Recent Spends
            renderRecentSpends(card.recent_spends);

            if (window.lucide) window.lucide.createIcons();
        };

        function renderRecentSpends(spends) {
            const container = document.getElementById('card-recent-spends-container');
            if (!container) return;

            if (!spends || spends.length === 0) {
                container.innerHTML = `<p class="py-3 text-xs text-slate-400 text-center">No recent spends on this card.</p>`;
                return;
            }

            container.innerHTML = spends.map(s => `
                <div class="py-2.5 flex items-center justify-between">
                    <div class="min-w-0 pr-2">
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">${s.title}</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">${s.date} • <span class="text-emerald-600">${s.status}</span></p>
                    </div>
                    <span class="text-xs font-bold text-slate-900 dark:text-slate-100 shrink-0 font-mono">
                        -RM ${parseFloat(s.amount).toFixed(2)}
                    </span>
                </div>
            `).join('');
        }

        function updateFreezeUI(isFrozen) {
            const badge = document.getElementById('visual-card-frozen-badge');
            const freezeBtn = document.getElementById('btn-toggle-freeze');
            const statusText = document.getElementById('quick-action-status-text');
            const lockIcon = document.getElementById('quick-action-lock-icon');

            if (isFrozen) {
                if (badge) badge.classList.remove('hidden');
                if (statusText) {
                    statusText.textContent = 'Temporarily Frozen';
                    statusText.className = 'text-rose-600 font-extrabold';
                }
                if (freezeBtn) {
                    freezeBtn.textContent = 'Unfreeze Card';
                    freezeBtn.className = 'px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-500 text-white transition-all cursor-pointer shrink-0 shadow-xs shadow-emerald-600/30';
                }
                if (lockIcon) {
                    lockIcon.className = 'w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-950 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0';
                }
            } else {
                if (badge) badge.classList.add('hidden');
                if (statusText) {
                    statusText.textContent = 'Active';
                    statusText.className = 'text-emerald-600 font-extrabold';
                }
                if (freezeBtn) {
                    freezeBtn.textContent = 'Freeze Card';
                    freezeBtn.className = 'px-3 py-1.5 rounded-xl text-xs font-bold bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-950/40 dark:hover:text-rose-400 transition-all cursor-pointer shrink-0 shadow-2xs';
                }
                if (lockIcon) {
                    lockIcon.className = 'w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0';
                }
            }
            if (window.lucide) window.lucide.createIcons();
        }

        window.toggleCurrentCardFreeze = function() {
            const card = cardsData.find(c => c.id === activeCardId);
            if (!card) return;

            const willFreeze = (card.status !== 'frozen');
            card.status = willFreeze ? 'frozen' : 'active';
            updateFreezeUI(willFreeze);

            if (window.showAppAlert) {
                window.showAppAlert({
                    title: willFreeze ? 'Card Frozen' : 'Card Unfrozen & Active',
                    subtitle: card.name,
                    message: willFreeze
                        ? 'All POS, ATM and online transactions for this card have been blocked instantly.'
                        : 'Your card is reactivated. Transactions and contactless authorizations are now permitted.',
                    type: willFreeze ? 'warning' : 'success'
                });
            }
        };

        window.toggleCardNumberReveal = function() {
            isCardDetailsRevealed = !isCardDetailsRevealed;
            const card = cardsData.find(c => c.id === activeCardId);
            if (!card) return;

            const numberEl = document.getElementById('visual-card-number');
            const cvvEl = document.getElementById('visual-card-cvv');
            const iconEl = document.getElementById('icon-reveal-card');
            const textEl = document.getElementById('text-reveal-card');

            if (isCardDetailsRevealed) {
                if (numberEl) numberEl.textContent = card.number_full;
                if (cvvEl) cvvEl.textContent = card.cvv;
                if (textEl) textEl.textContent = 'Hide';
                if (iconEl) iconEl.setAttribute('data-lucide', 'eye-off');
            } else {
                if (numberEl) numberEl.textContent = card.number_masked;
                if (cvvEl) cvvEl.textContent = '•••';
                if (textEl) textEl.textContent = 'Reveal';
                if (iconEl) iconEl.setAttribute('data-lucide', 'eye');
            }
            if (window.lucide) window.lucide.createIcons();
        };

        window.saveCurrentCardLimits = function() {
            const card = cardsData.find(c => c.id === activeCardId);
            if (!card) return;

            const atm = document.getElementById('label-atm-limit').textContent;
            const pos = document.getElementById('label-pos-limit').textContent;
            const online = document.getElementById('label-online-limit').textContent;
            const wave = document.getElementById('label-wave-limit').textContent;
            const overseas = document.getElementById('toggle-overseas').checked;

            if (window.showAppAlert) {
                window.showAppAlert({
                    title: 'Card Limits Updated',
                    subtitle: card.name,
                    message: `Daily limits set to ATM: ${atm}, POS: ${pos}, Online: ${online}, PayWave: ${wave}. Overseas usage: ${overseas ? 'Enabled' : 'Disabled'}.`,
                    type: 'success'
                });
            }
        };

        window.openChangePinModal = function() {
            window.openModal('change-pin-modal');
        };

        window.submitPinChange = function() {
            const oldP = document.getElementById('input-old-pin')?.value;
            const newP = document.getElementById('input-new-pin')?.value;
            const confP = document.getElementById('input-confirm-pin')?.value;

            if (!oldP || !newP || newP.length !== 6 || newP !== confP) {
                alert('Please enter a valid 6-digit PIN and ensure confirmation matches.');
                return;
            }

            window.closeModal('change-pin-modal');
            if (window.showAppAlert) {
                window.showAppAlert({
                    title: 'PIN Changed Successfully',
                    subtitle: 'BankFlow ATM & POS Chip',
                    message: 'Your new 6-digit PIN has been synchronized across all MEPS & Visa/Mastercard terminals.',
                    type: 'success'
                });
            }
        };

        window.openReplaceCardModal = function() {
            window.openModal('replace-card-modal');
        };

        window.submitCardReplacement = function() {
            window.closeModal('replace-card-modal');
            if (window.showAppAlert) {
                window.showAppAlert({
                    title: 'Replacement Dispatched',
                    subtitle: 'PosLaju Tracking ID: MY992014829',
                    message: 'Your replacement debit/credit card has been processed and will arrive within 3-5 business days.',
                    type: 'success'
                });
            }
        };

        window.requestNewCardModal = function() {
            if (window.showAppAlert) {
                window.showAppAlert({
                    title: 'Apply for New Card',
                    subtitle: 'Cards Portfolio',
                    message: 'Choose from BankFlow Islamic Visa Signature, Petronas Debit, or Cash Rebate Mastercard.',
                    type: 'info'
                });
            }
        };

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            window.selectActiveCard('card-debit');
        });
        setTimeout(function() {
            window.selectActiveCard('card-debit');
            if (window.lucide) window.lucide.createIcons();
        }, 50);
    })();
    </script>

</x-layout.customer>
