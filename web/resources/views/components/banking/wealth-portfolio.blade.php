<div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs space-y-4" id="wealth">
    <!-- Header -->
    <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
        <div>
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                <i data-lucide="trending-up" class="w-4 h-4 text-emerald-600"></i>
                Wealth & Islamic Investments
            </h3>
            <p class="text-[11px] text-slate-500 dark:text-slate-400">
                Gold Investment Account-i, Shariah Unit Trusts & Sukuk
            </p>
        </div>

        <div class="text-right">
            <span class="block text-[10px] text-slate-400">Total Portfolio Value</span>
            <span class="text-sm font-extrabold text-emerald-600">RM 38,920.00</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
        <!-- 1. Gold Investment Account-i (GIA-i) -->
        <div class="p-3.5 rounded-xl bg-gradient-to-br from-amber-500/10 via-amber-500/5 to-transparent border border-amber-500/20 space-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                        <i data-lucide="coins" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200">Physical Gold (GIA-i)</span>
                </div>
                <span class="text-[10px] font-bold text-emerald-600">+14.2%</span>
            </div>

            <div>
                <p class="text-sm font-extrabold text-slate-900 dark:text-slate-100">50.00 grams</p>
                <p class="text-[11px] text-slate-500">Valued at: <strong>RM 18,420.00</strong></p>
            </div>

            <div class="pt-1.5 border-t border-amber-500/15 flex items-center justify-between text-[11px]">
                <span class="text-slate-400">Rate: RM 368.40/g</span>
                <button type="button" onclick="window.showAppAlert ? window.showAppAlert({ title: 'Gold Investment-i', subtitle: 'Live Shariah Gold Bullion', message: 'Current purchase spot rate is RM 368.40/gram (999.9 physical gold backing). Trading portal opening.', type: 'warning' }) : alert('Buy/Sell Gold Investment Account-i.')" class="font-bold text-amber-600 dark:text-amber-400 hover:underline cursor-pointer">Trade &rarr;</button>
            </div>
        </div>

        <!-- 2. Shariah Global ESG Sukuk Fund -->
        <div class="p-3.5 rounded-xl bg-gradient-to-br from-emerald-500/10 via-emerald-500/5 to-transparent border border-emerald-500/20 space-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <i data-lucide="line-chart" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200">Global ESG Sukuk</span>
                </div>
                <span class="text-[10px] font-bold text-emerald-600">+7.8%</span>
            </div>

            <div>
                <p class="text-sm font-extrabold text-slate-900 dark:text-slate-100">12,500 Units</p>
                <p class="text-[11px] text-slate-500">Valued at: <strong>RM 14,250.00</strong></p>
            </div>

            <div class="pt-1.5 border-t border-emerald-500/15 flex items-center justify-between text-[11px]">
                <span class="text-slate-400">NAV: RM 1.140</span>
                <button type="button" onclick="window.showAppAlert ? window.showAppAlert({ title: 'Top Up Sukuk Portfolio', subtitle: 'Global ESG Sukuk Fund', message: 'Minimum investment unit top-up is RM 100.00. Settles immediately from Savings Account-i.', type: 'success' }) : alert('Top up Sukuk portfolio.')" class="font-bold text-emerald-600 dark:text-emerald-400 hover:underline cursor-pointer">Top Up &rarr;</button>
            </div>
        </div>

        <!-- 3. Islamic Money Market Fund -->
        <div class="p-3.5 rounded-xl bg-gradient-to-br from-blue-500/10 via-blue-500/5 to-transparent border border-blue-500/20 space-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                        <i data-lucide="pie-chart" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200">Money Market-i</span>
                </div>
                <span class="text-[10px] font-bold text-blue-600">3.65% p.a.</span>
            </div>

            <div>
                <p class="text-sm font-extrabold text-slate-900 dark:text-slate-100">Liquid Cash Fund</p>
                <p class="text-[11px] text-slate-500">Valued at: <strong>RM 6,250.00</strong></p>
            </div>

            <div class="pt-1.5 border-t border-blue-500/15 flex items-center justify-between text-[11px]">
                <span class="text-slate-400">Instant Liquidity</span>
                <button type="button" onclick="window.showAppAlert ? window.showAppAlert({ title: 'Money Market Liquidity', subtitle: 'Same-Day Redemption', message: 'Instant transfer from Money Market-i to Savings Account-i available up to RM 10,000 daily with zero exit fee.', type: 'info' }) : alert('Transfer from Money Market to Savings Account-i.')" class="font-bold text-blue-600 dark:text-blue-400 hover:underline cursor-pointer">Manage &rarr;</button>
            </div>
        </div>
    </div>
</div>
