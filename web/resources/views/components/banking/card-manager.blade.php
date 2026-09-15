<div class="space-y-4" id="cards-management">
    <!-- Header with Card Switcher Pills -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100 flex items-center gap-1.5">
                <i data-lucide="credit-card" class="w-4 h-4 text-emerald-600"></i>
                Card Management
            </h3>
            <p class="text-[11px] text-slate-500 dark:text-slate-400">
                Contactless limits, online security & card lock
            </p>
        </div>

        <div class="flex items-center gap-1 p-0.5 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700">
            <button
                type="button"
                id="btn-card-debit"
                onclick="switchCardTab('debit')"
                class="px-2.5 py-1 rounded-md text-[11px] font-semibold transition-all cursor-pointer bg-white dark:bg-slate-900 text-emerald-700 dark:text-emerald-400 shadow-xs"
            >
                Debit-i
            </button>
            <button
                type="button"
                id="btn-card-credit"
                onclick="switchCardTab('credit')"
                class="px-2.5 py-1 rounded-md text-[11px] font-semibold transition-all cursor-pointer text-slate-500 hover:text-slate-800 dark:hover:text-slate-200"
            >
                Virtual Visa
            </button>
        </div>
    </div>

    <!-- 1. DEBIT CARD VIEW -->
    <div id="card-view-debit" class="space-y-3">
        <!-- Interactive 3D Realistic Bank Card -->
        <div class="relative rounded-2xl p-5 bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 text-white shadow-xl border border-emerald-500/30 overflow-hidden min-h-[175px] flex flex-col justify-between group transition-all duration-300">
            <!-- Subtle Hologram Pattern -->
            <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full bg-emerald-500/15 blur-2xl pointer-events-none"></div>

            <div class="flex items-center justify-between z-10">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold tracking-widest text-emerald-300">BANKFLOW DEBIT-i</span>
                    <span class="text-[9px] px-1.5 py-0.5 rounded bg-white/10 text-white font-mono">MYDEBIT</span>
                </div>
                <!-- Status & Card Freeze Toggle -->
                <button
                    type="button"
                    onclick="toggleCardFreeze(this, 'Debit Mastercard-i')"
                    class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center gap-1 hover:bg-emerald-500/30 transition-colors cursor-pointer"
                >
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span class="card-status-text">Active</span>
                </button>
            </div>

            <!-- Card Number with Mask Toggle -->
            <div class="my-2 z-10">
                <div class="flex items-center gap-2">
                    <span class="font-mono text-sm sm:text-base tracking-[0.2em] text-slate-100 card-pan-display" data-pan="5421 •••• •••• 9012" data-full="5421 8812 3456 9012">
                        5421 &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; 9012
                    </span>
                    <button
                        type="button"
                        onclick="toggleCardNumber(this)"
                        class="text-slate-400 hover:text-white p-1 rounded transition-colors cursor-pointer"
                        title="Show full number"
                    >
                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-[10px] text-slate-300 z-10 border-t border-white/10 pt-2">
                <div>
                    <span class="block text-[8px] text-slate-400 uppercase">Cardholder</span>
                    <span class="font-medium tracking-wide text-white uppercase truncate max-w-[130px] block">Ahmad Daniel Bin Alif</span>
                </div>
                <div>
                    <span class="block text-[8px] text-slate-400 uppercase">Expires</span>
                    <span class="font-mono font-semibold text-white">08/29</span>
                </div>
                <div>
                    <span class="block text-[8px] text-slate-400 uppercase">CVV</span>
                    <span class="font-mono font-semibold text-white">•••</span>
                </div>
            </div>
        </div>

        <!-- Controls Grid -->
        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-800 space-y-2.5 text-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-slate-800 dark:text-slate-200">E-Commerce Online Spending</p>
                    <p class="text-[10px] text-slate-400">Limit: RM 3,000 daily</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-8 h-4.5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-600"></div>
                </label>
            </div>

            <div class="flex items-center justify-between pt-1 border-t border-slate-100 dark:border-slate-800">
                <div>
                    <p class="font-medium text-slate-800 dark:text-slate-200">Overseas & Cross-Border</p>
                    <p class="text-[10px] text-slate-400">Foreign currency & ATM overseas</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-8 h-4.5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-600"></div>
                </label>
            </div>

            <div class="flex items-center justify-between pt-1 border-t border-slate-100 dark:border-slate-800">
                <div>
                    <p class="font-medium text-slate-800 dark:text-slate-200">Contactless Wave Limit</p>
                    <p class="text-[10px] text-slate-400">PIN-less limit per tap</p>
                </div>
                <span class="font-mono font-bold text-slate-800 dark:text-slate-200">RM 250</span>
            </div>
        </div>
    </div>

    <!-- 2. VIRTUAL VISA CREDIT CARD VIEW (Hidden by default) -->
    <div id="card-view-credit" class="hidden space-y-3">
        <!-- Interactive 3D Realistic Visa Card -->
        <div class="relative rounded-2xl p-5 bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 text-white shadow-xl border border-indigo-500/30 overflow-hidden min-h-[175px] flex flex-col justify-between group transition-all duration-300">
            <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full bg-indigo-500/20 blur-2xl pointer-events-none"></div>

            <div class="flex items-center justify-between z-10">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold tracking-widest text-indigo-300">BANKFLOW INFINITE-i</span>
                    <span class="text-[9px] px-1.5 py-0.5 rounded bg-white/10 text-white font-mono">VISA VIRTUAL</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    <span>Active</span>
                </span>
            </div>

            <div class="my-2 z-10">
                <div class="flex items-center gap-2">
                    <span class="font-mono text-sm sm:text-base tracking-[0.2em] text-slate-100 card-pan-display" data-pan="4111 •••• •••• 8842" data-full="4111 2948 9912 8842">
                        4111 &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; 8842
                    </span>
                    <button
                        type="button"
                        onclick="toggleCardNumber(this)"
                        class="text-slate-400 hover:text-white p-1 rounded transition-colors cursor-pointer"
                        title="Show full number"
                    >
                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
                <p class="text-[10px] text-indigo-300 mt-1">Available Credit: <strong>RM 18,450.00</strong> / RM 20,000</p>
            </div>

            <div class="flex items-center justify-between text-[10px] text-slate-300 z-10 border-t border-white/10 pt-2">
                <div>
                    <span class="block text-[8px] text-slate-400 uppercase">Cardholder</span>
                    <span class="font-medium tracking-wide text-white uppercase truncate max-w-[130px] block">Ahmad Daniel Bin Alif</span>
                </div>
                <div>
                    <span class="block text-[8px] text-slate-400 uppercase">Expires</span>
                    <span class="font-mono font-semibold text-white">11/30</span>
                </div>
                <div>
                    <span class="block text-[8px] text-slate-400 uppercase">CVV</span>
                    <span class="font-mono font-semibold text-white">•••</span>
                </div>
            </div>
        </div>

        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-800 space-y-2 text-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-slate-800 dark:text-slate-200">Dynamic 3D CVV Auto-Rotate</p>
                    <p class="text-[10px] text-slate-400">Rotates every 4 hours for anti-fraud</p>
                </div>
                <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 dark:bg-emerald-950 px-2 py-0.5 rounded">Enabled</span>
            </div>
        </div>
    </div>
</div>

<script>
    window.switchCardTab = function(type) {
        const debitView = document.getElementById('card-view-debit');
        const creditView = document.getElementById('card-view-credit');
        const btnDebit = document.getElementById('btn-card-debit');
        const btnCredit = document.getElementById('btn-card-credit');

        if (type === 'credit') {
            debitView.classList.add('hidden');
            creditView.classList.remove('hidden');
            btnCredit.className = 'px-2.5 py-1 rounded-md text-[11px] font-semibold transition-all cursor-pointer bg-white dark:bg-slate-900 text-emerald-700 dark:text-emerald-400 shadow-xs';
            btnDebit.className = 'px-2.5 py-1 rounded-md text-[11px] font-semibold transition-all cursor-pointer text-slate-500 hover:text-slate-800 dark:hover:text-slate-200';
        } else {
            creditView.classList.add('hidden');
            debitView.classList.remove('hidden');
            btnDebit.className = 'px-2.5 py-1 rounded-md text-[11px] font-semibold transition-all cursor-pointer bg-white dark:bg-slate-900 text-emerald-700 dark:text-emerald-400 shadow-xs';
            btnCredit.className = 'px-2.5 py-1 rounded-md text-[11px] font-semibold transition-all cursor-pointer text-slate-500 hover:text-slate-800 dark:hover:text-slate-200';
        }

        if (window.refreshLucideIcons) {
            window.refreshLucideIcons();
        }
    };

    window.toggleCardNumber = function(btn) {
        const panEl = btn.closest('.my-2').querySelector('.card-pan-display');
        if (!panEl) return;
        const isMasked = panEl.innerText.includes('•');
        if (isMasked) {
            panEl.innerText = panEl.getAttribute('data-full');
        } else {
            panEl.innerText = panEl.getAttribute('data-pan');
        }
    };

    window.toggleCardFreeze = function(btn, cardName) {
        const statusText = btn.querySelector('.card-status-text');
        const dot = btn.querySelector('.rounded-full');
        if (statusText.innerText === 'Active') {
            statusText.innerText = 'Frozen';
            btn.className = 'px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30 flex items-center gap-1 hover:bg-rose-500/30 transition-colors cursor-pointer';
            dot.className = 'w-1.5 h-1.5 rounded-full bg-rose-400';
            alert(cardName + ' has been temporarily frozen. All e-commerce and POS transactions are blocked.');
        } else {
            statusText.innerText = 'Active';
            btn.className = 'px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center gap-1 hover:bg-emerald-500/30 transition-colors cursor-pointer';
            dot.className = 'w-1.5 h-1.5 rounded-full bg-emerald-400';
            alert(cardName + ' is now reactivated.');
        }
    };
</script>
