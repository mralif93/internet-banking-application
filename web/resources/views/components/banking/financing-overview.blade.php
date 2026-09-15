<div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4" id="financings">
    <!-- Header -->
    <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
        <div>
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                <i data-lucide="home" class="w-4 h-4 text-emerald-600"></i>
                Islamic Financing & Facilities
            </h3>
            <p class="text-[11px] text-slate-500 dark:text-slate-400">
                Shariah-compliant Murabahah Home & Vehicle Financing
            </p>
        </div>

        <button
            type="button"
            onclick="window.showAppAlert ? window.showAppAlert({ title: 'Islamic Financing Facilities', subtitle: 'Shariah Murabahah & AITAB', message: 'Explore Home Financing-i (from 3.85% p.a.), Vehicle Financing-i (from 2.25% flat), and Personal Financing-i with instant pre-qualification.', type: 'info' }) : alert('Explore New Islamic Financing: Home Financing-i, Auto Financing-i, and Personal Financing-i with competitive profit rates.')"
            class="px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 text-xs font-semibold hover:bg-emerald-100 transition-colors cursor-pointer"
        >
            + Apply Facility
        </button>
    </div>

    <!-- Active Facilities Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- 1. Home Financing-i -->
        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-800 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 flex items-center justify-center">
                        <i data-lucide="home" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100">Home Financing-i (Murabahah)</p>
                        <p class="text-[10px] font-mono text-slate-400">ACC: 8812-4421-99</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                    Active
                </span>
            </div>

            <!-- Balance & Next Installment -->
            <div class="grid grid-cols-2 gap-2 pt-1">
                <div>
                    <span class="block text-[10px] text-slate-400">Outstanding Principal</span>
                    <span class="text-sm font-extrabold text-slate-900 dark:text-slate-100">RM 348,250.00</span>
                </div>
                <div class="text-right">
                    <span class="block text-[10px] text-slate-400">Next Monthly Due</span>
                    <span class="text-sm font-extrabold text-emerald-600">RM 1,845.00</span>
                </div>
            </div>

            <!-- Repayment Progress Bar -->
            <div>
                <div class="flex justify-between text-[10px] text-slate-500 mb-1">
                    <span>Tenure: 120 of 360 mos</span>
                    <span class="font-semibold text-emerald-600">33.3% Paid</span>
                </div>
                <div class="w-full bg-slate-200 dark:bg-slate-700 h-2 rounded-full overflow-hidden">
                    <div class="bg-emerald-600 h-full rounded-full" style="width: 33.3%"></div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-slate-200/60 dark:border-slate-700/60 text-xs">
                <span class="text-[11px] text-slate-400">Due on: <strong>01 Oct 2026</strong></span>
                <button
                    type="button"
                    onclick="window.showAppConfirm ? window.showAppConfirm({ title: 'Pay Home Financing Installment?', subtitle: 'Murabahah ACC: 8812-4421-99', message: 'Monthly installment of RM 1,845.00 will be deducted from your Savings Account-i.', type: 'info', confirmText: 'Authorize Payment', cancelText: 'Cancel', onConfirm: function() { window.showAppAlert({ title: 'Installment Paid', subtitle: 'Receipt Generated', message: 'Monthly repayment of RM 1,845.00 cleared successfully.', type: 'success' }); } }) : alert('Auto-debit setup: Monthly installment RM1,845 will be deducted from Savings Account-i.')"
                    class="font-semibold text-emerald-600 hover:underline text-[11px] cursor-pointer"
                >
                    Pay Installment &rarr;
                </button>
            </div>
        </div>

        <!-- 2. Vehicle Financing-i -->
        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-800 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-sky-100 dark:bg-sky-950 text-sky-700 dark:text-sky-300 flex items-center justify-center">
                        <i data-lucide="car" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100">Vehicle Financing-i (AITAB)</p>
                        <p class="text-[10px] font-mono text-slate-400">ACC: 8841-0021-33</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-sky-100 dark:bg-sky-950 text-sky-700 dark:text-sky-300">
                    Active
                </span>
            </div>

            <!-- Balance & Next Installment -->
            <div class="grid grid-cols-2 gap-2 pt-1">
                <div>
                    <span class="block text-[10px] text-slate-400">Outstanding Principal</span>
                    <span class="text-sm font-extrabold text-slate-900 dark:text-slate-100">RM 52,140.00</span>
                </div>
                <div class="text-right">
                    <span class="block text-[10px] text-slate-400">Next Monthly Due</span>
                    <span class="text-sm font-extrabold text-sky-600">RM 920.00</span>
                </div>
            </div>

            <!-- Repayment Progress Bar -->
            <div>
                <div class="flex justify-between text-[10px] text-slate-500 mb-1">
                    <span>Tenure: 48 of 84 mos</span>
                    <span class="font-semibold text-sky-600">57.1% Paid</span>
                </div>
                <div class="w-full bg-slate-200 dark:bg-slate-700 h-2 rounded-full overflow-hidden">
                    <div class="bg-sky-600 h-full rounded-full" style="width: 57.1%"></div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-slate-200/60 dark:border-slate-700/60 text-xs">
                <span class="text-[11px] text-slate-400">Due on: <strong>25 Sep 2026</strong></span>
                <button
                    type="button"
                    onclick="window.showAppConfirm ? window.showAppConfirm({ title: 'Pay Vehicle Installment?', subtitle: 'AITAB ACC: 8841-0021-33', message: 'Monthly vehicle installment of RM 920.00 will be deducted from your Savings Account-i.', type: 'info', confirmText: 'Authorize Payment', cancelText: 'Cancel', onConfirm: function() { window.showAppAlert({ title: 'Installment Paid', subtitle: 'Receipt Generated', message: 'Monthly vehicle installment of RM 920.00 cleared successfully.', type: 'success' }); } }) : alert('Auto-debit setup: Monthly installment RM920 will be deducted from Savings Account-i.')"
                    class="font-semibold text-sky-600 hover:underline text-[11px] cursor-pointer"
                >
                    Pay Installment &rarr;
                </button>
            </div>
        </div>
    </div>
</div>
