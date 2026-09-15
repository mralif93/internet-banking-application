@props([
    'title' => 'BankFlow MY — Enterprise Admin & Fraud Operations Center',
    'activeNav' => 'parameters',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#991b1b">
    <meta name="description" content="BankFlow MY Admin & Fraud Security Center - Real-time AML/CFT monitoring, Parameter Management, Kill Switch circuit breaker, and security compliance telemetry.">
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
<body class="h-full bg-slate-100/75 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-200 flex flex-col min-h-screen selection:bg-rose-600 selection:text-white">

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
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-rose-600 to-red-700 flex items-center justify-center text-white font-bold text-sm shadow-sm shadow-rose-900/30">
                            <i data-lucide="shield-alert" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="font-bold text-base tracking-tight text-white flex items-center gap-1.5">
                                BankFlow <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-rose-500/20 text-rose-300 border border-rose-500/30">Admin Portal</span>
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Admin Navigation -->
                <nav class="hidden md:flex items-center gap-1.5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ $activeNav === 'fraud' ? 'bg-rose-950/80 text-rose-300 border border-rose-800/80' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                        AML Radar
                    </a>
                    <a href="{{ route('admin.parameters') }}" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ $activeNav === 'parameters' ? 'bg-rose-950/80 text-rose-300 border border-rose-800/80' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                        System Parameters
                    </a>
                    <a href="{{ route('admin.customers') }}" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ $activeNav === 'customers' ? 'bg-rose-950/80 text-rose-300 border border-rose-800/80' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                        Customer Accounts
                    </a>
                    <a href="{{ route('admin.audit-logs') }}" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ $activeNav === 'audit' ? 'bg-rose-950/80 text-rose-300 border border-rose-800/80' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                        <i data-lucide="file-check" class="w-3.5 h-3.5"></i>
                        Audit Logs
                    </a>
                    <span class="text-slate-700 dark:text-slate-700 px-1">|</span>
                    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-400 hover:text-emerald-400 hover:bg-slate-800/60 transition-all">
                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                        Customer Portal
                    </a>
                </nav>

                <!-- Right Actions: Security Clearance & Admin Profile -->
                <div class="flex items-center gap-2.5">
                    <x-ui.dark-toggle class="border-slate-700 bg-slate-800 text-slate-300 hover:bg-slate-700" />

                    <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-rose-950/80 border border-rose-800 text-rose-300 text-xs font-semibold shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                        DEFCON: NORMAL
                    </div>

                    <!-- Admin User Pill & Logout -->
                    @php
                        $adminUser = Auth::guard('web')->user();
                        $initials = $adminUser ? strtoupper(substr($adminUser->name, 0, 2)) : 'AD';
                    @endphp
                    <div class="flex items-center gap-2 pl-2 border-l border-slate-800">
                        <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-xs shadow-xs">
                            {{ $initials }}
                        </div>
                        <div class="hidden lg:block text-left">
                            <span class="block text-xs font-bold text-white leading-tight">{{ $adminUser->name ?? 'Enterprise Admin' }}</span>
                            <span class="block text-[10px] text-rose-300">{{ $adminUser->department ?? 'Fraud Operations' }}</span>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline-block ml-1">
                            @csrf
                            <button
                                type="submit"
                                title="Terminate Clearance Session"
                                class="p-1.5 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-800 transition-colors cursor-pointer"
                                aria-label="Sign out admin session"
                            >
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                            </button>
                        </form>
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
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-rose-600 flex items-center justify-center text-white">
                        <i data-lucide="shield-alert" class="w-4 h-4"></i>
                    </div>
                    <span class="font-bold text-sm text-white">Admin Operations</span>
                </div>
                <button type="button" onclick="window.toggleMobileDrawer()" class="p-1 rounded-lg text-slate-400 hover:text-white cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <ul class="space-y-1.5 text-sm font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ $activeNav === 'fraud' ? 'bg-rose-950 text-rose-300 font-bold border border-rose-800' : 'text-slate-300 hover:bg-slate-800' }}">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                        AML Radar &amp; Telemetry
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.parameters') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ $activeNav === 'parameters' ? 'bg-rose-950 text-rose-300 font-bold border border-rose-800' : 'text-slate-300 hover:bg-slate-800' }}">
                        <i data-lucide="sliders" class="w-4 h-4"></i>
                        System Parameters
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ $activeNav === 'customers' ? 'bg-rose-950 text-rose-300 font-bold border border-rose-800' : 'text-slate-300 hover:bg-slate-800' }}">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        Customer Accounts
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.audit-logs') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ $activeNav === 'audit' ? 'bg-rose-950 text-rose-300 font-bold border border-rose-800' : 'text-slate-300 hover:bg-slate-800' }}">
                        <i data-lucide="file-check" class="w-4 h-4"></i>
                        Compliance Audit Trail
                    </a>
                </li>
                <li class="pt-2 border-t border-slate-800">
                    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-emerald-400 hover:bg-slate-800">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Customer Portal &rarr;
                    </a>
                </li>
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
            <span class="font-mono">IP: 10.142.8.29 (VPN Gateway) &bull; BNM RMiT Compliant</span>
        </div>
    </footer>

</body>
</html>
