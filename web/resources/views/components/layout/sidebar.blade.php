<!-- Backdrop for Mobile & Tablet Drawer (< lg) -->
<div
    id="mobile-drawer-backdrop"
    class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 hidden lg:hidden transition-opacity duration-300"
    onclick="window.toggleMobileDrawer()"
></div>

<!-- Drawer Container: Mobile & Tablet off-canvas (slide in) -->
<aside
    id="mobile-navigation-drawer"
    class="fixed top-0 bottom-0 left-0 z-50 w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-5 transform -translate-x-full lg:hidden transition-transform duration-300 ease-in-out flex flex-col justify-between shadow-2xl"
>
    <div>
        <!-- Drawer Header with Close Button (Mobile Only) -->
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5H4.5V21" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-slate-900 dark:text-slate-100 text-sm">CentraBank</span>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500">Retail Banking Menu</span>
                </div>
            </div>
            <button
                type="button"
                onclick="window.toggleMobileDrawer()"
                class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                aria-label="Close menu"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Quick DuitNow Action Button in Mobile Drawer -->
        <div class="mb-5">
            <x-ui.button
                variant="primary"
                size="sm"
                fullWidth
                onclick="window.toggleMobileDrawer(); window.openModal('quick-transfer-modal');"
            >
                <x-slot:icon>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </x-slot:icon>
                DuitNow Transfer
            </x-ui.button>
        </div>

        <!-- Navigation Categories -->
        <div class="space-y-6">
            <div>
                <p class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">
                    Banking Portfolios
                </p>
                <ul class="space-y-1">
                    <li>
                        <a
                            href="#banking-overview"
                            onclick="window.toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50/80 dark:bg-emerald-950/40"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                            <span>Accounts & Balances</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#security-features"
                            onclick="window.toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                            <span>RMiT Security</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="/ui-kit"
                            onclick="window.toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.39 48.39 0 01-4.163-.3c.186 1.613.46 3.559.848 5.753a.75.75 0 01-.738.882H4.5A2.25 2.25 0 002.25 17.25v.75c0 .414.336.75.75.75h18a.75.75 0 00.75-.75v-.75a2.25 2.25 0 00-2.25-2.25h-1.69a.75.75 0 01-.738-.882c.388-2.194.662-4.14.848-5.753-1.379.13-2.772.23-4.163.3a.64.64 0 01-.657-.643v0z" />
                            </svg>
                            <span>UI Kit Showcase</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('admin.dashboard') }}"
                            onclick="window.toggleMobileDrawer()"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold text-rose-600 dark:text-rose-400 bg-rose-50/70 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 transition-colors"
                        >
                            <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <span>Admin Portal</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <p class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">
                    Security Protection
                </p>
                <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 space-y-2">
                    <div class="flex items-center gap-1.5 text-xs text-emerald-600 dark:text-emerald-400 font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                        <span>Security Enclave Verified</span>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-normal">
                        Zero SMS OTP vulnerability. Authenticated strictly via bound mobile Soft Token.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom: Emergency Kill Switch -->
    <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
        <x-banking.security-badge type="kill_switch" />
    </div>
</aside>
