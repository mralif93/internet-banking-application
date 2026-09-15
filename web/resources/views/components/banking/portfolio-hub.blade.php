<div class="space-y-4" id="portfolio-overview">
    <!-- Clean Compact Category Selector Bar (Matching Header Style) -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-3 sm:p-4 border border-slate-200/80 dark:border-slate-800 shadow-xs">
        <div class="flex items-center gap-2 sm:gap-3">
            <!-- Dropdown Trigger Container -->
            <div class="relative flex-1 min-w-0">
                <button
                    type="button"
                    id="category-menu-btn"
                    onclick="toggleCategoryMenu()"
                    class="w-full px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl sm:rounded-2xl border border-slate-200/90 dark:border-slate-700/80 bg-slate-50/70 hover:bg-slate-100/80 dark:bg-slate-800/60 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-100 text-xs sm:text-sm font-bold flex items-center justify-between gap-2 transition-all shadow-xs cursor-pointer active:scale-[0.99] group"
                    title="Switch portfolio category"
                    aria-haspopup="true"
                >
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div id="selected-category-icon" class="w-6 h-6 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 shadow-2xs">
                            <i data-lucide="wallet" class="w-3.5 h-3.5"></i>
                        </div>
                        <span class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold hidden xs:inline">Category:</span>
                        <span id="selected-category-label" class="truncate text-xs font-bold text-slate-800 dark:text-slate-100">Accounts &amp; Deposits</span>
                        <span id="selected-category-badge" class="text-[9px] px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-bold whitespace-nowrap shadow-2xs">3 items</span>
                    </div>

                    <div class="flex items-center gap-1 text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-200 transition-colors">
                        <span class="text-[10px] text-slate-400 font-medium hidden sm:inline">Switch</span>
                        <i data-lucide="chevron-down" id="category-chevron-icon" class="w-3.5 h-3.5 transition-transform duration-200"></i>
                    </div>
                </button>

                <!-- Dropdown Popover Menu -->
                <div
                    id="category-dropdown-menu"
                    class="hidden absolute left-0 right-0 sm:right-auto sm:w-80 mt-2 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-2xl p-2 z-50 transition-all duration-150"
                >
                    <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">All 9 Portfolios</span>
                        <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold">Tap to switch</span>
                    </div>
                    <div class="py-1 space-y-1 max-h-80 overflow-y-auto">
                        <button type="button" onclick="selectCategoryFromDropdown('accounts')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors bg-slate-100 dark:bg-slate-800 font-bold" data-cat="accounts">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 flex items-center justify-center shrink-0"><i data-lucide="wallet" class="w-4 h-4"></i></span>
                                Accounts &amp; Deposits
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-bold">3 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('cards')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="cards">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 flex items-center justify-center shrink-0"><i data-lucide="credit-card" class="w-4 h-4"></i></span>
                                Cards Portfolio
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">3 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('financings')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="financings">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-amber-50 dark:bg-amber-950/50 text-amber-600 flex items-center justify-center shrink-0"><i data-lucide="home" class="w-4 h-4"></i></span>
                                Financing
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">3 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('deposits')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="deposits">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center shrink-0"><i data-lucide="lock" class="w-4 h-4"></i></span>
                                Term Deposits
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">2 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('investments')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="investments">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 flex items-center justify-center shrink-0"><i data-lucide="trending-up" class="w-4 h-4"></i></span>
                                Investments &amp; Wealth
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">3 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('takaful')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="takaful">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-sky-50 dark:bg-sky-950/50 text-sky-600 flex items-center justify-center shrink-0"><i data-lucide="shield-check" class="w-4 h-4"></i></span>
                                Takaful Protection
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">3 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('pockets')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="pockets">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-pink-50 dark:bg-pink-950/50 text-pink-600 flex items-center justify-center shrink-0"><i data-lucide="piggy-bank" class="w-4 h-4"></i></span>
                                Pockets / Tabung
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">3 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('tabunghaji')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="tabunghaji">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950/50 text-teal-600 flex items-center justify-center shrink-0"><i data-lucide="landmark" class="w-4 h-4"></i></span>
                                Tabung Haji
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">2 items</span>
                        </button>
                        <button type="button" onclick="selectCategoryFromDropdown('zakat')" class="category-dropdown-item w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-between cursor-pointer transition-colors" data-cat="zakat">
                            <span class="flex items-center gap-2.5 text-slate-800 dark:text-slate-200 font-semibold">
                                <span class="w-7 h-7 rounded-lg bg-amber-50 dark:bg-amber-950/50 text-amber-600 flex items-center justify-center shrink-0"><i data-lucide="heart-handshake" class="w-4 h-4"></i></span>
                                Zakat &amp; Waqf
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-bold">2 items</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Prev / Next Category Navigation Buttons -->
            <div class="flex items-center gap-1.5 shrink-0">
                <button
                    type="button"
                    onclick="stepCategory(-1)"
                    class="h-9 w-9 sm:w-auto sm:px-2.5 rounded-xl border border-slate-200/90 dark:border-slate-700/80 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs font-semibold flex items-center justify-center gap-1 shadow-xs cursor-pointer transition-all active:scale-95"
                    title="Previous category"
                    aria-label="Previous category"
                >
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    <span class="hidden sm:inline text-xs">Prev</span>
                </button>
                <button
                    type="button"
                    onclick="stepCategory(1)"
                    class="h-9 w-9 sm:w-auto sm:px-2.5 rounded-xl border border-slate-200/90 dark:border-slate-700/80 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs font-semibold flex items-center justify-center gap-1 shadow-xs cursor-pointer transition-all active:scale-95"
                    title="Next category"
                    aria-label="Next category"
                >
                    <span class="hidden sm:inline text-xs">Next</span>
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- TAB CONTENT CONTAINER (Standardized Cards Across All 9 Categories) -->
    <div>

            <!-- 1. ACCOUNTS TAB (Stacked Deck) -->
            <div id="portfolio-panel-accounts" class="portfolio-tab-panel">
                <x-banking.stacked-cards
                    id="accounts"
                    title="Accounts & Deposits"
                    total="RM 87,270.50"
                />
            </div>

            <!-- 2. CARDS TAB (Stacked Deck) -->
            <div id="portfolio-panel-cards" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="cards"
                    title="Cards Portfolio"
                    total="3 Cards Active"
                    :accounts="[
                        [
                            'id' => 'card-debit',
                            'name' => 'Debit Mastercard-i',
                            'number' => '5421 •••• •••• 9012',
                            'badge' => 'Active',
                            'isPrimary' => true,
                            'balance' => 'RM 24,850.50',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Linked: Savings Account-i &bull; PIN-less Limit: RM250',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-700 via-emerald-800 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'emv',
                            'primaryActionText' => 'Card Controls',
                            'primaryActionClick' => 'window.openCardControls(\'debit\');',
                            'secondaryActionIcon' => 'shield',
                            'secondaryActionClick' => 'window.openCardControls(\'debit\');',
                        ],
                        [
                            'id' => 'card-visa',
                            'name' => 'Virtual Visa Infinite-i',
                            'number' => '4111 •••• •••• 8842',
                            'badge' => '3D Secure',
                            'isPrimary' => false,
                            'balance' => 'RM 18,450.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Credit Limit: RM 20,000 &bull; Auto-Rotating Dynamic CVV',
                            'theme' => 'indigo',
                            'bgClass' => 'bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 border-indigo-500/30 text-white shadow-indigo-950/30',
                            'chipIcon' => 'emv',
                            'primaryActionText' => 'Manage Limits',
                            'primaryActionClick' => 'window.openCardControls(\'visa\');',
                            'secondaryActionIcon' => 'sliders',
                            'secondaryActionClick' => 'window.openCardControls(\'visa\');',
                        ],
                        [
                            'id' => 'card-world',
                            'name' => 'World Mastercard-i (Metal)',
                            'number' => '5218 •••• •••• 1009',
                            'badge' => 'Premier',
                            'isPrimary' => false,
                            'balance' => 'RM 45,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Takaful Travel Cover: RM 2,000,000 &bull; Airport Lounge Access',
                            'theme' => 'dark',
                            'bgClass' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 border-slate-700 text-white shadow-slate-950/40',
                            'chipIcon' => 'emv',
                            'primaryActionText' => 'Card Controls',
                            'primaryActionClick' => 'window.openCardControls(\'world\');',
                            'secondaryActionIcon' => 'sliders',
                            'secondaryActionClick' => 'window.openCardControls(\'world\');',
                        ],
                    ]"
                />
            </div>

            <!-- 3. FINANCING TAB (Stacked Deck) -->
            <div id="portfolio-panel-financings" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="financings"
                    title="Financing Facilities"
                    total="RM 415,390.00"
                    :accounts="[
                        [
                            'id' => 'fin-home',
                            'name' => 'Home Financing-i (Murabahah)',
                            'number' => 'ACC: 8812-4421-99',
                            'badge' => 'Current',
                            'isPrimary' => false,
                            'balance' => 'RM 348,250.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Next Due: <strong>RM 1,845.00</strong> on 01 Oct 2026',
                            'progress' => 33.3,
                            'progressLabel' => 'Repayment: 120 of 360 mos',
                            'theme' => 'dark',
                            'bgClass' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 border-slate-700 text-white shadow-slate-950/40',
                            'chipIcon' => 'icon',
                            'customIcon' => 'home',
                            'primaryActionText' => 'Pay Installment',
                            'primaryActionClick' => 'alert(\'Monthly installment payment of RM 1,845.00 initiated.\');',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Downloading annual financing statement.\');',
                        ],
                        [
                            'id' => 'fin-car',
                            'name' => 'Vehicle Financing-i (AITAB)',
                            'number' => 'ACC: 8841-0021-33',
                            'badge' => 'Current',
                            'isPrimary' => false,
                            'balance' => 'RM 52,140.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Next Due: <strong>RM 920.00</strong> on 25 Sep 2026',
                            'progress' => 57.1,
                            'progressLabel' => 'Repayment: 48 of 84 mos',
                            'theme' => 'sky',
                            'bgClass' => 'bg-gradient-to-br from-sky-900 via-slate-900 to-blue-950 border-sky-600/30 text-white shadow-sky-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'car',
                            'primaryActionText' => 'Pay Installment',
                            'primaryActionClick' => 'alert(\'Monthly installment payment of RM 920.00 initiated.\');',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Vehicle financing settlement balance: RM 52,140.00.\');',
                        ],
                        [
                            'id' => 'fin-personal',
                            'name' => 'Personal Financing-i (Cash Line)',
                            'number' => 'ACC: 8872-1100-45',
                            'badge' => 'Current',
                            'isPrimary' => false,
                            'balance' => 'RM 15,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Next Due: <strong>RM 480.00</strong> on 28 Sep 2026',
                            'progress' => 75.0,
                            'progressLabel' => 'Repayment: 36 of 48 mos',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'coins',
                            'primaryActionText' => 'Pay Installment',
                            'primaryActionClick' => 'alert(\'Monthly installment payment of RM 480.00 initiated.\');',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Personal financing settlement balance: RM 15,000.00.\');',
                        ],
                    ]"
                />
            </div>

            <!-- 4. TERM DEPOSITS TAB (Stacked Deck) -->
            <div id="portfolio-panel-deposits" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="deposits"
                    title="Term Deposits Portfolio"
                    total="RM 70,000.00"
                    :accounts="[
                        [
                            'id' => 'dep-12m',
                            'name' => 'Term Deposit-i (Commodity Murabahah)',
                            'number' => 'Cert: FD-MY-2026-8899',
                            'badge' => '3.85% p.a.',
                            'isPrimary' => false,
                            'balance' => 'RM 50,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Maturity: <strong>14 Mar 2027</strong> &bull; Profit: RM 1,925.00',
                            'progress' => 45.0,
                            'progressLabel' => 'Tenure Elapsed: 5.4 of 12 mos',
                            'theme' => 'dark',
                            'bgClass' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 border-slate-700 text-white shadow-slate-950/40',
                            'chipIcon' => 'icon',
                            'customIcon' => 'lock',
                            'primaryActionText' => 'Deposit Placements',
                            'primaryActionClick' => 'alert(\'Place new Term Deposit-i from Savings Account-i.\');',
                            'secondaryActionIcon' => 'refresh-cw',
                            'secondaryActionClick' => 'alert(\'Auto-renewal upon maturity: Principal + Profit rollover.\');',
                        ],
                        [
                            'id' => 'dep-6m',
                            'name' => 'e-Fixed Deposit-i (6 Months)',
                            'number' => 'Cert: FD-MY-2026-1044',
                            'badge' => '3.60% p.a.',
                            'isPrimary' => false,
                            'balance' => 'RM 20,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Maturity: <strong>28 Dec 2026</strong> &bull; PIDM Protected',
                            'progress' => 68.0,
                            'progressLabel' => 'Tenure Elapsed: 4.1 of 6 mos',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'calendar-check',
                            'primaryActionText' => 'Deposit Placements',
                            'primaryActionClick' => 'alert(\'Place new e-Fixed Deposit.\');',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Certificate of Deposit PDF download ready.\');',
                        ],
                    ]"
                />
            </div>

            <!-- 5. INVESTMENTS & WEALTH TAB (Stacked Deck) -->
            <div id="portfolio-panel-investments" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="investments"
                    title="Investments &amp; Wealth"
                    total="RM 38,920.00"
                    :accounts="[
                        [
                            'id' => 'inv-gold',
                            'name' => 'Physical Gold (GIA-i)',
                            'number' => 'Holding: 50.00 grams',
                            'badge' => '+14.2% Gain',
                            'isPrimary' => false,
                            'balance' => 'RM 18,420.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Live Price: RM 368.40/g &bull; Allocated 999.9 Gold',
                            'theme' => 'amber',
                            'bgClass' => 'bg-gradient-to-br from-amber-950 via-slate-900 to-neutral-950 border-amber-500/30 text-white shadow-amber-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'coins',
                            'primaryActionText' => 'Trade Gold',
                            'primaryActionClick' => 'alert(\'Buy/Sell Gold Investment Account-i.\');',
                            'secondaryActionIcon' => 'trending-up',
                            'secondaryActionClick' => 'alert(\'View 12-month historical gold price chart.\');',
                        ],
                        [
                            'id' => 'inv-sukuk',
                            'name' => 'Global ESG Sukuk Fund',
                            'number' => 'Units: 12,500 units',
                            'badge' => '+7.8% Gain',
                            'isPrimary' => false,
                            'balance' => 'RM 14,250.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Current NAV: RM 1.140 &bull; Shariah ESG Compliant',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'line-chart',
                            'primaryActionText' => 'Top Up Units',
                            'primaryActionClick' => 'alert(\'Top up Sukuk fund holding.\');',
                            'secondaryActionIcon' => 'receipt',
                            'secondaryActionClick' => 'alert(\'View Sukuk dividend and distribution history.\');',
                        ],
                        [
                            'id' => 'inv-mmf',
                            'name' => 'Money Market-i Fund',
                            'number' => 'Liquid Cash Reserve',
                            'badge' => '3.65% p.a.',
                            'isPrimary' => false,
                            'balance' => 'RM 6,250.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Zero lock-in period &bull; Daily profit accrual',
                            'theme' => 'dark',
                            'bgClass' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 border-slate-700 text-white shadow-slate-950/40',
                            'chipIcon' => 'icon',
                            'customIcon' => 'pie-chart',
                            'primaryActionText' => 'Transfer Out',
                            'primaryActionClick' => 'alert(\'Instant redemption to Savings Account-i.\');',
                            'secondaryActionIcon' => 'arrow-left-right',
                            'secondaryActionClick' => 'alert(\'Auto-sweep configuration.\');',
                        ],
                    ]"
                />
            </div>

            <!-- 6. TAKAFUL & INSURANCE PROTECTION TAB (Stacked Deck) -->
            <div id="portfolio-panel-takaful" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="takaful"
                    title="Takaful Protection Plans"
                    total="Sum Covered: RM 1,005,000"
                    :accounts="[
                        [
                            'id' => 'tak-family',
                            'name' => 'Takaful Warisan-i (Family)',
                            'number' => 'Cert: TAK-MY-8921004',
                            'badge' => 'Active Cover',
                            'isPrimary' => false,
                            'balance' => 'RM 500,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Monthly Contribution: <strong>RM 185.00</strong> &bull; Sum Covered',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'shield-check',
                            'primaryActionText' => 'View e-Policy',
                            'primaryActionClick' => 'alert(\'Viewing Takaful Warisan-i Certificate details.\');',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Medical card and hospital admission guarantee letter generator.\');',
                        ],
                        [
                            'id' => 'tak-home',
                            'name' => 'Home Owner Takaful Plan',
                            'number' => 'Cert: TAK-MY-5521908',
                            'badge' => 'Sum: RM 420k',
                            'isPrimary' => false,
                            'balance' => 'RM 420,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Annual Contribution: <strong>RM 480.00</strong> &bull; Valid till 2027',
                            'theme' => 'sky',
                            'bgClass' => 'bg-gradient-to-br from-sky-900 via-slate-900 to-blue-950 border-sky-600/30 text-white shadow-sky-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'umbrella',
                            'primaryActionText' => 'Renewal Info',
                            'primaryActionClick' => 'alert(\'Auto-renewal active through mortgage financing facility.\');',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Download fire & flood insurance certificate.\');',
                        ],
                        [
                            'id' => 'tak-motor',
                            'name' => 'Motor Takaful Comprehensive',
                            'number' => 'Plate: VAA 9081 &bull; Cert: TAK-MT-4402',
                            'badge' => '55% NCD',
                            'isPrimary' => false,
                            'balance' => 'RM 85,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Market Agreed Value: RM 85,000 &bull; 24/7 Roadside Assist',
                            'theme' => 'indigo',
                            'bgClass' => 'bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 border-indigo-500/30 text-white shadow-indigo-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'car',
                            'primaryActionText' => 'Renew Roadtax',
                            'primaryActionClick' => 'alert(\'Instant digital roadtax renewal via MyJPJ integration.\');',
                            'secondaryActionIcon' => 'shield',
                            'secondaryActionClick' => 'alert(\'Emergency Breakdown Assist: Dial 1-800-88-TAFUL.\');',
                        ],
                    ]"
                />
            </div>

            <!-- 7. POCKETS / TABUNG (Goal Savings) TAB (Stacked Deck) -->
            <div id="portfolio-panel-pockets" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="pockets"
                    title="Goal Pockets / Tabung"
                    total="RM 14,500.00"
                    :accounts="[
                        [
                            'id' => 'pkt-vault',
                            'name' => 'Emergency Cash Vault',
                            'number' => 'Pocket ID: PKT-88210',
                            'badge' => '6 Months Target',
                            'isPrimary' => false,
                            'balance' => 'RM 8,500.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Goal: RM 15,000.00 &bull; Auto-Save: RM 500.00/month',
                            'progress' => 56.7,
                            'progressLabel' => 'Goal Progress: RM 8.5k / 15k',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'piggy-bank',
                            'primaryActionText' => 'Add Funds',
                            'primaryActionClick' => 'alert(\'Instant top-up to Emergency Vault from Savings-i.\');',
                            'secondaryActionIcon' => 'target',
                            'secondaryActionClick' => 'alert(\'Auto-lock setting: Lock withdrawals until target date.\');',
                        ],
                        [
                            'id' => 'pkt-umrah',
                            'name' => 'Umrah 2027 Journey',
                            'number' => 'Pocket ID: PKT-11944',
                            'badge' => 'Target: Nov 2027',
                            'isPrimary' => false,
                            'balance' => 'RM 4,800.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Goal: RM 12,000.00 &bull; Group Savings Active',
                            'progress' => 40.0,
                            'progressLabel' => 'Goal Progress: RM 4.8k / 12k',
                            'theme' => 'indigo',
                            'bgClass' => 'bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 border-indigo-500/30 text-white shadow-indigo-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'compass',
                            'primaryActionText' => 'Add Funds',
                            'primaryActionClick' => 'alert(\'Add savings to Umrah Journey pocket.\');',
                            'secondaryActionIcon' => 'sparkles',
                            'secondaryActionClick' => 'alert(\'Package comparison: View Tabung Haji travel partner rates.\');',
                        ],
                        [
                            'id' => 'pkt-booster',
                            'name' => 'Debit Round-Up Booster',
                            'number' => 'Auto-Save Spare Change',
                            'badge' => 'Active (+RM45 this wk)',
                            'isPrimary' => false,
                            'balance' => 'RM 1,200.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Rounds up every card purchase to nearest RM 10.00',
                            'theme' => 'amber',
                            'bgClass' => 'bg-gradient-to-br from-amber-950 via-slate-900 to-neutral-950 border-amber-500/30 text-white shadow-amber-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'coins',
                            'primaryActionText' => 'Booster Settings',
                            'primaryActionClick' => 'alert(\'Adjust round-up multiplier: 1x, 2x, or 5x spare change.\');',
                            'secondaryActionIcon' => 'refresh-cw',
                            'secondaryActionClick' => 'alert(\'Recent round-ups: RM 4.50 (Jaya Grocer), RM 6.20 (Shell).\');',
                        ],
                    ]"
                />
            </div>

            <!-- 8. TABUNG HAJI TAB (Stacked Deck) -->
            <div id="portfolio-panel-tabunghaji" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="tabunghaji"
                    title="Tabung Haji Accounts"
                    total="RM 37,900.00"
                    :accounts="[
                        [
                            'id' => 'th-main',
                            'name' => 'Lembaga Tabung Haji (TH)',
                            'number' => 'Acc: 1204-5892-0012',
                            'badge' => 'Hajj Registered',
                            'isPrimary' => false,
                            'balance' => 'RM 32,500.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Queue: <strong>1452H / 2030M</strong> &bull; Shariah Profit',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'landmark',
                            'primaryActionText' => 'Transfer to TH',
                            'primaryActionClick' => 'window.openModal(\'quick-transfer-modal\')',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Viewing official Tabung Haji pilgrimage status & queue confirmation.\');',
                        ],
                        [
                            'id' => 'th-child',
                            'name' => 'TH Junior Account-i',
                            'number' => 'Acc: 1204-9912-3341',
                            'badge' => 'Dependent',
                            'isPrimary' => false,
                            'balance' => 'RM 5,400.00',
                            'holder' => 'NUR AISYAH BINTI AHMAD DANIEL',
                            'subValue' => 'Hajj Registration: Active &bull; Monthly Auto-Debit: RM 100',
                            'theme' => 'dark',
                            'bgClass' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 border-slate-700 text-white shadow-slate-950/40',
                            'chipIcon' => 'icon',
                            'customIcon' => 'sparkles',
                            'primaryActionText' => 'Deposit Funds',
                            'primaryActionClick' => 'window.openModal(\'quick-transfer-modal\')',
                            'secondaryActionIcon' => 'refresh-cw',
                            'secondaryActionClick' => 'alert(\'Scheduled monthly contribution active on 1st of every month.\');',
                        ],
                    ]"
                />
            </div>

            <!-- 9. ZAKAT & WAQF TAB (Stacked Deck) -->
            <div id="portfolio-panel-zakat" class="portfolio-tab-panel hidden">
                <x-banking.stacked-cards
                    id="zakat"
                    title="Zakat &amp; Waqf"
                    total="Contributions: RM 1,621.25"
                    :accounts="[
                        [
                            'id' => 'zkt-savings',
                            'name' => 'Zakat on Savings & Wealth',
                            'number' => 'Haul Year: 1447H / 2026M',
                            'badge' => 'Nisab Met',
                            'isPrimary' => false,
                            'balance' => 'RM 621.25',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Nisab: RM 24,000.00 &bull; Net Wealth: RM 24,850.00 (2.5%)',
                            'theme' => 'amber',
                            'bgClass' => 'bg-gradient-to-br from-amber-950 via-slate-900 to-neutral-950 border-amber-500/30 text-white shadow-amber-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'heart-handshake',
                            'primaryActionText' => 'Pay Zakat Now',
                            'primaryActionClick' => 'alert(\'Direct Zakat payment to PPZ-MAIWP with official tax exemption receipt.\');',
                            'secondaryActionIcon' => 'file-text',
                            'secondaryActionClick' => 'alert(\'Download LHDN income tax zakat rebate assessment statement.\');',
                        ],
                        [
                            'id' => 'wqf-cash',
                            'name' => 'Cash Waqf Endowment',
                            'number' => 'Waqf ID: WQF-MY-88001',
                            'badge' => 'Perpetual',
                            'isPrimary' => false,
                            'balance' => 'RM 1,000.00',
                            'holder' => 'AHMAD DANIEL BIN ALIF',
                            'subValue' => 'Beneficiary: Islamic Education & Healthcare Endowment',
                            'theme' => 'emerald',
                            'bgClass' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
                            'chipIcon' => 'icon',
                            'customIcon' => 'heart-handshake',
                            'primaryActionText' => 'Contribute Waqf',
                            'primaryActionClick' => 'alert(\'Place new Waqf share contribution from Savings Account-i.\');',
                            'secondaryActionIcon' => 'receipt',
                            'secondaryActionClick' => 'alert(\'View digital Waqf certificate certified by State Islamic Council.\');',
                        ],
                    ]"
                />
            </div>

        </div>
</div>

<script>
    const PORTFOLIO_CATEGORIES = [
        { id: 'accounts', label: 'Accounts & Deposits', count: '3 items', icon: 'wallet', colorClass: 'text-emerald-600 bg-emerald-50 dark:bg-emerald-950/50' },
        { id: 'cards', label: 'Cards', count: '3 items', icon: 'credit-card', colorClass: 'text-indigo-600 bg-indigo-50 dark:bg-indigo-950/50' },
        { id: 'financings', label: 'Financing', count: '3 items', icon: 'home', colorClass: 'text-amber-600 bg-amber-50 dark:bg-amber-950/50' },
        { id: 'deposits', label: 'Term Deposits', count: '2 items', icon: 'lock', colorClass: 'text-slate-600 bg-slate-100 dark:bg-slate-800' },
        { id: 'investments', label: 'Investments & Wealth', count: '3 items', icon: 'trending-up', colorClass: 'text-emerald-600 bg-emerald-50 dark:bg-emerald-950/50' },
        { id: 'takaful', label: 'Takaful Protection', count: '3 items', icon: 'shield-check', colorClass: 'text-sky-600 bg-sky-50 dark:bg-sky-950/50' },
        { id: 'pockets', label: 'Pockets / Tabung', count: '3 items', icon: 'piggy-bank', colorClass: 'text-pink-600 bg-pink-50 dark:bg-pink-950/50' },
        { id: 'tabunghaji', label: 'Tabung Haji', count: '2 items', icon: 'landmark', colorClass: 'text-teal-600 bg-teal-50 dark:bg-teal-950/50' },
        { id: 'zakat', label: 'Zakat & Waqf', count: '2 items', icon: 'heart-handshake', colorClass: 'text-amber-600 bg-amber-50 dark:bg-amber-950/50' }
    ];

    window.currentPortfolioCategory = 'accounts';

    window.switchPortfolioTab = function(tabName) {
        window.currentPortfolioCategory = tabName;

        PORTFOLIO_CATEGORIES.forEach(cat => {
            const panel = document.getElementById('portfolio-panel-' + cat.id);
            if (panel) {
                if (cat.id === tabName) {
                    panel.classList.remove('hidden');
                } else {
                    panel.classList.add('hidden');
                }
            }
        });

        // Update trigger button and top heading
        const activeCat = PORTFOLIO_CATEGORIES.find(c => c.id === tabName);
        if (activeCat) {
            const headingEl = document.getElementById('selected-category-heading');
            const labelEl = document.getElementById('selected-category-label');
            const badgeEl = document.getElementById('selected-category-badge');
            const iconEl = document.getElementById('selected-category-icon');

            if (headingEl) headingEl.innerText = activeCat.label;
            if (labelEl) labelEl.innerText = activeCat.label;
            if (badgeEl) badgeEl.innerText = activeCat.count;
            if (iconEl) {
                iconEl.className = `w-6 h-6 rounded-lg flex items-center justify-center shrink-0 shadow-2xs ${activeCat.colorClass}`;
                iconEl.innerHTML = `<i data-lucide="${activeCat.icon}" class="w-3.5 h-3.5"></i>`;
            }
        }

        // Update active category dropdown item styling
        document.querySelectorAll('.category-dropdown-item').forEach(item => {
            const catId = item.getAttribute('data-cat');
            if (catId === tabName) {
                item.classList.add('bg-slate-100', 'dark:bg-slate-800', 'font-bold');
            } else {
                item.classList.remove('bg-slate-100', 'dark:bg-slate-800', 'font-bold');
            }
        });

        // Re-calculate stack positions for the newly visible category
        if (window.deckControllers && window.deckControllers[tabName]) {
            setTimeout(() => window.deckControllers[tabName].render(), 20);
        }

        if (window.refreshLucideIcons) {
            window.refreshLucideIcons();
        }
    };

    window.stepCategory = function(direction) {
        const currentIndex = PORTFOLIO_CATEGORIES.findIndex(c => c.id === window.currentPortfolioCategory);
        let nextIndex = currentIndex + direction;
        if (nextIndex < 0) nextIndex = PORTFOLIO_CATEGORIES.length - 1;
        if (nextIndex >= PORTFOLIO_CATEGORIES.length) nextIndex = 0;
        window.switchPortfolioTab(PORTFOLIO_CATEGORIES[nextIndex].id);
    };

    window.toggleCategoryMenu = function() {
        const menu = document.getElementById('category-dropdown-menu');
        const chevron = document.getElementById('category-chevron-icon');
        if (!menu) return;
        const isHidden = menu.classList.toggle('hidden');
        if (chevron) {
            chevron.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    };

    window.selectCategoryFromDropdown = function(tabName) {
        window.switchPortfolioTab(tabName);
        const menu = document.getElementById('category-dropdown-menu');
        const chevron = document.getElementById('category-chevron-icon');
        if (menu) menu.classList.add('hidden');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
    };

    // Close category dropdown on outside click
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('category-dropdown-menu');
        const btn = document.getElementById('category-menu-btn');
        const chevron = document.getElementById('category-chevron-icon');
        if (!menu || !btn) return;
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        }
    });

    window.toggleTotalPortfolioPrivacy = function(btn) {
        const el = document.getElementById('portfolio-networth-val');
        if (!el) return;
        if (el.innerText.includes('•')) {
            el.innerText = el.getAttribute('data-real');
        } else {
            el.innerText = 'RM ••••••••';
        }
    };
</script>
