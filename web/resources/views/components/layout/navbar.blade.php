<header class="sticky top-0 z-30 w-full bg-white/85 dark:bg-slate-900/85 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 sm:h-16">
            <!-- Left: Mobile/Tablet Menu Trigger + Brand Logo -->
            <div class="flex items-center gap-1.5 sm:gap-4 min-w-0">
                <!-- Hamburger Button (Mobile & Tablet: < lg) -->
                <button
                    type="button"
                    onclick="window.toggleMobileDrawer()"
                    class="lg:hidden p-1.5 sm:p-2 rounded-lg sm:rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 shrink-0"
                    aria-label="Open Navigation Drawer"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Bank Brand Logo -->
                <a href="/" class="flex items-center gap-2 group min-w-0">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5H4.5V21" />
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-bold text-sm sm:text-base lg:text-lg tracking-tight text-slate-900 dark:text-slate-100 flex items-center gap-1.5 truncate">
                            <span>BankFlow MY</span>
                        </span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500 -mt-0.5 hidden xl:block">Personal Retail Digital Banking</span>
                    </div>
                </a>
            </div>

            <!-- Center: Desktop Navigation Links (Only on lg+ desktops) -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                <a href="/#anti-scam" class="px-2.5 xl:px-3 py-1.5 rounded-xl text-xs xl:text-sm font-medium text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">
                    Anti-Scam Policies
                </a>
                <a href="/#tech-stack" class="px-2.5 xl:px-3 py-1.5 rounded-xl text-xs xl:text-sm font-medium text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">
                    Architecture & Stack
                </a>
                <a href="/#compliance-matrix" class="px-2.5 xl:px-3 py-1.5 rounded-xl text-xs xl:text-sm font-medium text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">
                    Compliance Matrix
                </a>
                <a href="/#live-demo" class="px-2.5 xl:px-3 py-1.5 rounded-xl text-xs xl:text-sm font-medium text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">
                    Live Demo
                </a>
                <a href="/ui-kit" class="px-2.5 xl:px-3 py-1.5 rounded-xl text-xs xl:text-sm font-medium text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">
                    UI Kit
                </a>
                <a href="{{ route('admin.dashboard') }}" class="px-2.5 xl:px-3 py-1.5 rounded-xl text-xs xl:text-sm font-semibold text-rose-600 dark:text-rose-400 bg-rose-50/80 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors whitespace-nowrap flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <span>Admin Ops</span>
                </a>
            </nav>


            <!-- Right: Dark Mode Toggle, Notifications & Sign In -->
            <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                <!-- Theme Mode Toggle (Circle Icon Button) -->
                <x-ui.dark-toggle class="w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center p-0" />

                <!-- Notifications Button (Circle Icon Button with Ping Badge) -->
                <button
                    type="button"
                    class="relative w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-all duration-150 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-emerald-500 active:scale-95"
                    title="Notifications"
                    aria-label="View notifications"
                >
                    <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <!-- Unread Notification Badge -->
                    <span class="absolute top-1 right-1 sm:top-1.5 sm:right-1.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white dark:ring-slate-900"></span>
                </button>

                @if (Auth::guard('customer')->check())
                    <!-- Customer Dashboard Link -->
                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="inline-flex items-center gap-2 pl-1.5 pr-3 sm:pr-4 py-1.5 rounded-full bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-semibold text-xs sm:text-sm shadow-xs hover:shadow-md shadow-emerald-600/20 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                        aria-label="Go to Customer Dashboard"
                    >
                        <span class="w-7 h-7 sm:w-7.5 sm:h-7.5 rounded-full bg-white/20 flex items-center justify-center text-white shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                        </span>
                        <span class="font-medium">Dashboard</span>
                    </a>
                @else
                    <!-- User-Friendly Standard Sign In Button (Pill with circular icon badge & label) -->
                    <a
                        href="/login"
                        class="inline-flex items-center gap-2 pl-1.5 pr-3 sm:pr-4 py-1.5 rounded-full bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-semibold text-xs sm:text-sm shadow-xs hover:shadow-md shadow-emerald-600/20 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                        aria-label="Sign In to Account"
                    >
                        <!-- Inner Circle Icon Background -->
                        <span class="w-7 h-7 sm:w-7.5 sm:h-7.5 rounded-full bg-white/20 flex items-center justify-center text-white shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                            </svg>
                        </span>
                        <span class="font-medium">Sign In</span>
                    </a>
                @endif
            </div>

        </div>
    </div>
</header>
