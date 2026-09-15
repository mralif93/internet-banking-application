@props([
    'title' => 'BankFlow MY — Enterprise Admin & Fraud Operations Center',
    'activeNav' => 'dashboard',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#991b1b">
    <meta name="description" content="BankFlow MY Admin & Fraud Security Center - Real-time AML/CFT monitoring, Kill Switch circuit breaker, and security compliance telemetry.">
    <title>{{ $title }}</title>

    <!-- Theme hydration -->
    <script>
        (function() {
            try {
                const storedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (_) {}
        })();
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-100/70 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-200 flex flex-col min-h-screen selection:bg-rose-600 selection:text-white">

    <!-- Admin Top High-Security Navigation Bar -->
    <header class="sticky top-0 z-30 w-full bg-slate-900 text-white border-b border-slate-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand & Security Clearance Tag -->
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        onclick="window.toggleMobileDrawer()"
                        class="md:hidden p-2 rounded-xl text-slate-300 hover:bg-slate-800"
                        aria-label="Open admin drawer"
                    >
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <a href="/admin" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-rose-600 to-red-700 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-base tracking-tight text-white flex items-center gap-1.5">
                                BankFlow <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-rose-500/20 text-rose-300 border border-rose-500/30">Admin Center</span>
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Admin Navigation -->
                <nav class="hidden md:flex items-center gap-1">
                    <a href="/admin" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium {{ $activeNav === 'fraud' ? 'bg-rose-950/80 text-rose-300 border border-rose-800/80 font-semibold' : 'text-slate-300 hover:bg-slate-800' }}">
                        AML / Fraud Radar
                    </a>
                    <a href="#kill-switches" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium {{ $activeNav === 'kill' ? 'bg-rose-950/80 text-rose-300 border border-rose-800/80 font-semibold' : 'text-slate-300 hover:bg-slate-800' }}">
                        Kill Switch Triggers
                    </a>
                    <a href="#audit-vault" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium {{ $activeNav === 'audit' ? 'bg-rose-950/80 text-rose-300 border border-rose-800/80 font-semibold' : 'text-slate-300 hover:bg-slate-800' }}">
                        WORM Audit Logs
                    </a>
                    <a href="/" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium text-slate-400 hover:text-emerald-400 transition-colors">
                        &larr; Public View
                    </a>
                </nav>

                <!-- Right Actions: High-Security Indicators & Clearance Badge -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <x-ui.dark-toggle class="border-slate-700 bg-slate-800 text-slate-300 hover:bg-slate-700" />

                    <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-rose-950/80 border border-rose-800 text-rose-300 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                        DEFCON: NORMAL
                    </div>

                    <!-- Admin User Pill -->
                    <div class="flex items-center gap-2 pl-2 border-l border-slate-800">
                        <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-xs shadow-xs">
                            FA
                        </div>
                        <div class="hidden lg:block text-left">
                            <span class="block text-xs font-bold text-white leading-tight">Farhan Azman</span>
                            <span class="block text-[10px] text-rose-300">Lead Fraud Operations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer for Admin -->
    <div
        id="mobile-drawer-backdrop"
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 hidden md:hidden"
        onclick="window.toggleMobileDrawer()"
    ></div>
    <aside
        id="mobile-navigation-drawer"
        class="fixed top-0 bottom-0 left-0 z-50 w-72 bg-slate-900 border-r border-slate-800 p-5 transform -translate-x-full md:hidden transition-transform duration-300 ease-in-out flex flex-col justify-between shadow-2xl text-white"
    >
        <div class="space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                <span class="font-bold text-sm text-white">Admin Operations Menu</span>
                <button type="button" onclick="window.toggleMobileDrawer()" class="p-1 rounded-lg text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <ul class="space-y-1 text-sm font-medium">
                <li><a href="/admin" class="block px-3 py-2 rounded-xl bg-rose-950 text-rose-300">AML / Fraud Radar</a></li>
                <li><a href="#kill-switches" class="block px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800">Kill Switch Triggers</a></li>
                <li><a href="#audit-vault" class="block px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800">WORM Audit Logs</a></li>
                <li><a href="/staff" class="block px-3 py-2 rounded-xl text-blue-400">Staff Service Desk &rarr;</a></li>
                <li><a href="/" class="block px-3 py-2 rounded-xl text-emerald-400">&larr; Public Banking Portal</a></li>
            </ul>
        </div>
        <div class="pt-4 border-t border-slate-800">
            <x-banking.security-badge type="kill_switch" />
        </div>
    </aside>

    <!-- Admin Main Viewport -->
    <div class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col">
        <main class="flex-1 min-w-0">
            {{ $slot }}
        </main>
    </div>

    <!-- Admin High-Security Footer -->
    <footer class="mt-auto border-t border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/70 text-slate-500 dark:text-slate-400 text-xs py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left text-[11px]">
            <span>BankFlow MY Administrative Tier &bull; Access Level 4 Strict &bull; Immutable Audit Active</span>
            <span class="font-mono">IP: 10.142.8.29 (VPN Gateway)</span>
        </div>
    </footer>

</body>
</html>
