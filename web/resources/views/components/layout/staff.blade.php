@props([
    'title' => 'BankFlow MY — Staff Operations & Customer Support',
    'activeNav' => 'customers',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#1e3a8a">
    <meta name="description" content="BankFlow MY Staff Portal - Customer Service, Branch Verification, and Ticket Escalations.">
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
<body class="h-full bg-slate-100/70 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-200 flex flex-col min-h-screen selection:bg-blue-600 selection:text-white">

    <!-- Staff Top Navigation Bar -->
    <header class="sticky top-0 z-30 w-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand & Role Tag -->
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        onclick="window.toggleMobileDrawer()"
                        class="md:hidden p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                        aria-label="Open staff drawer"
                    >
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <a href="/staff" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-700 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-base tracking-tight text-slate-900 dark:text-slate-100 flex items-center gap-1.5">
                                BankFlow <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300">Staff Ops</span>
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Staff Links -->
                <nav class="hidden md:flex items-center gap-1">
                    <a href="/staff" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium {{ $activeNav === 'desk' ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300 font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                        Service Desk
                    </a>
                    <a href="#ekyc" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium {{ $activeNav === 'ekyc' ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300 font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                        eKYC Verification
                    </a>
                    <a href="#cooling" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium {{ $activeNav === 'cooling' ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300 font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                        Cooling-Off Holds
                    </a>
                    <a href="/" class="px-3 py-1.5 rounded-xl text-xs sm:text-sm font-medium text-slate-500 hover:text-emerald-600 transition-colors">
                        &larr; Public View
                    </a>
                </nav>

                <!-- Right Actions: Theme, Hotline & User Profile -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <x-ui.dark-toggle class="w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center p-0 border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300" />

                    <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-blue-700 dark:text-blue-300 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Branch ID: MY-KL-004
                    </div>

                    <!-- Staff User Pill -->
                    <div class="flex items-center gap-2 pl-2 border-l border-slate-200 dark:border-slate-800">
                        <div class="w-8 h-8 rounded-xl bg-blue-700 text-white flex items-center justify-center font-bold text-xs shadow-xs">
                            SO
                        </div>
                        <div class="hidden lg:block text-left">
                            <span class="block text-xs font-bold text-slate-800 dark:text-slate-200 leading-tight">Sarah Osman</span>
                            <span class="block text-[10px] text-slate-400">Branch Operations Officer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer for Staff -->
    <div
        id="mobile-drawer-backdrop"
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 hidden md:hidden"
        onclick="window.toggleMobileDrawer()"
    ></div>
    <aside
        id="mobile-navigation-drawer"
        class="fixed top-0 bottom-0 left-0 z-50 w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-5 transform -translate-x-full md:hidden transition-transform duration-300 ease-in-out flex flex-col justify-between shadow-2xl"
    >
        <div class="space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <span class="font-bold text-sm text-slate-900 dark:text-slate-100">Staff Portal Menu</span>
                <button type="button" onclick="window.toggleMobileDrawer()" class="p-1 rounded-lg text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <ul class="space-y-1 text-sm font-medium">
                <li><a href="/staff" class="block px-3 py-2 rounded-xl bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300">Service Desk</a></li>
                <li><a href="#ekyc" class="block px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">eKYC Verification</a></li>
                <li><a href="#cooling" class="block px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">Cooling-Off Holds</a></li>
                <li><a href="/" class="block px-3 py-2 rounded-xl text-emerald-600 dark:text-emerald-400">&larr; Public Banking Portal</a></li>
                <li><a href="/admin" class="block px-3 py-2 rounded-xl text-rose-600 dark:text-rose-400">Admin Control Center &rarr;</a></li>
            </ul>
        </div>
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
            <x-banking.security-badge type="kill_switch" />
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col">
        <main class="flex-1 min-w-0">
            {{ $slot }}
        </main>
    </div>

    <!-- Staff Operations Footer -->
    <footer class="mt-auto border-t border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/70 text-slate-500 dark:text-slate-400 text-xs py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left text-[11px]">
            <span>BankFlow MY Staff Subsystem &bull; Authorized Personnel Only &bull; Monitored Session</span>
            <span>Internal Compliance Hotline: ext 4402</span>
        </div>
    </footer>

</body>
</html>
