@props([
    'title' => 'BankFlow MY — Enterprise Admin & Fraud Operations Center',
    'activeNav' => 'parameters',
])

@php
    $adminUser = Auth::guard('web')->user();
    $adminName = $adminUser ? $adminUser->name : 'Farhan Azman';
    $adminRole = $adminUser ? $adminUser->role : 'superadmin';
    $adminDepartment = $adminUser ? $adminUser->department : 'Fraud & Risk Operations';
    $adminEmployeeId = $adminUser ? ($adminUser->employee_id ?? 'EMP-BF-001') : 'EMP-BF-001';
    $initials = $adminUser ? strtoupper(substr($adminUser->name, 0, 2)) : 'FA';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
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

                const storedColor = localStorage.getItem('app-color-theme') || 'emerald';
                document.documentElement.setAttribute('data-color-theme', storedColor);

                const storedFontSize = localStorage.getItem('app-font-size') || 'standard';
                document.documentElement.setAttribute('data-font-size', storedFontSize);
            } catch (_) {}
        })();
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .admin-dropdown-menu {
            transition: opacity 0.2s ease, transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hidden-dropdown {
            display: none !important;
            opacity: 0 !important;
            transform: translateY(-8px) scale(0.97) !important;
            pointer-events: none !important;
        }
        .visible-dropdown {
            display: block !important;
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
            pointer-events: auto !important;
        }
    </style>
</head>
<body class="h-full bg-slate-100/75 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-200 flex flex-col min-h-screen selection:bg-rose-600 selection:text-white">

    <!-- ======================================================================
         ENTERPRISE ADMIN TOP HIGH-SECURITY NAVBAR
         ====================================================================== -->
    <header class="sticky top-0 z-40 w-full bg-slate-900 text-white border-b border-slate-800 shadow-md">
        <div class="max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-[68px] gap-2.5 sm:gap-4">
                
                <!-- Left: Hamburger Trigger + Brand Mark -->
                <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0">
                    <button
                        type="button"
                        onclick="window.toggleAdminDrawer()"
                        class="md:hidden p-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500 cursor-pointer"
                        aria-label="Open navigation drawer"
                    >
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group shrink-0">
                        <div class="relative w-9.5 h-9.5 sm:w-10.5 sm:h-10.5 rounded-2xl bg-gradient-to-tr from-rose-600 to-red-700 flex items-center justify-center text-white shadow-md shadow-rose-950/50 group-hover:scale-105 transition-transform shrink-0">
                            <i data-lucide="shield-alert" class="w-5 h-5"></i>
                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-rose-500 ring-2 ring-slate-900 animate-pulse"></span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center gap-1.5 truncate">
                                <span class="font-bold text-sm sm:text-base text-white tracking-tight">BankFlow</span>
                                <span class="text-[9px] uppercase font-mono font-bold tracking-wider px-1.5 py-0.5 rounded bg-rose-500/20 text-rose-300 border border-rose-500/30 shrink-0">Admin Ops</span>
                            </div>
                            <span class="text-[10px] text-slate-400 font-medium hidden sm:block truncate">Enterprise Fraud &amp; Clearing Control</span>
                        </div>
                    </a>
                </div>

                <!-- Center: Desktop High-Security Navigation (Pill Nav) -->
                <nav class="hidden md:flex items-center gap-1 bg-slate-950/60 p-1.5 rounded-2xl border border-slate-800/80 shadow-inner">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $activeNav === 'fraud' ? 'bg-rose-600 text-white shadow-sm shadow-rose-900/50' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}"
                    >
                        <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                        <span>AML Radar</span>
                    </a>
                    <a
                        href="{{ route('admin.parameters') }}"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $activeNav === 'parameters' ? 'bg-rose-600 text-white shadow-sm shadow-rose-900/50' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}"
                    >
                        <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                        <span>Parameters</span>
                    </a>
                    <a
                        href="{{ route('admin.customers') }}"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $activeNav === 'customers' ? 'bg-rose-600 text-white shadow-sm shadow-rose-900/50' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}"
                    >
                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                        <span>Customers</span>
                    </a>
                    <a
                        href="{{ route('admin.audit-logs') }}"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $activeNav === 'audit' ? 'bg-rose-600 text-white shadow-sm shadow-rose-900/50' : 'text-slate-300 hover:text-white hover:bg-slate-800/70' }}"
                    >
                        <i data-lucide="file-check" class="w-3.5 h-3.5"></i>
                        <span>Audit Trail</span>
                    </a>
                </nav>

                <!-- Right Actions: Clearance Status & Profile Dropdown -->
                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- Customer Portal Jump Link -->
                    <a
                        href="{{ route('customer.dashboard') }}"
                        target="_blank"
                        title="Switch to Customer Retail Banking Portal"
                        class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-emerald-400 bg-emerald-950/40 hover:bg-emerald-900/50 border border-emerald-800/60 transition-colors shadow-2xs"
                    >
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span>Retail Portal</span>
                    </a>

                    <!-- DEFCON Indicator -->
                    <div class="hidden lg:flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl bg-slate-950/80 border border-slate-800 text-rose-300 text-xs font-mono font-bold shadow-inner">
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                        DEFCON: NORMAL
                    </div>

                    <!-- Dark Mode Toggle -->
                    <x-ui.dark-toggle class="border-slate-700 bg-slate-800 text-slate-300 hover:bg-slate-700 w-9 h-9 sm:w-10 sm:h-10 rounded-xl" />

                    <!-- Profile Dropdown Trigger -->
                    <div class="relative">
                        <button
                            type="button"
                            id="admin-profile-btn"
                            onclick="window.toggleAdminProfileDropdown()"
                            class="flex items-center gap-2 pl-1.5 pr-2 sm:pr-3 py-1 rounded-2xl bg-slate-800/80 hover:bg-slate-800 border border-slate-700 transition-all cursor-pointer shadow-xs group"
                            aria-label="Admin User Profile Menu"
                        >
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-rose-600 to-red-600 text-white flex items-center justify-center font-black text-xs shadow-xs group-hover:scale-105 transition-transform shrink-0">
                                {{ $initials }}
                            </div>
                            <div class="hidden lg:block text-left min-w-0 max-w-[130px]">
                                <span class="block text-xs font-bold text-white truncate leading-tight">{{ $adminName }}</span>
                                <span class="block text-[10px] text-rose-300 truncate font-medium">{{ $adminRole }}</span>
                            </div>
                            <i data-lucide="chevron-down" id="admin-profile-chevron" class="w-3.5 h-3.5 text-slate-400 group-hover:text-white transition-transform shrink-0"></i>
                        </button>

                        <!-- Profile Dropdown Menu -->
                        <div
                            id="admin-profile-dropdown"
                            class="admin-dropdown-menu hidden-dropdown absolute right-0 top-full mt-2 w-72 bg-slate-900 text-white rounded-2xl border border-slate-800 shadow-2xl p-2 z-50"
                        >
                            <div class="p-3 rounded-xl bg-slate-950/80 border border-slate-800/80 mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center font-black text-sm shadow-xs shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-white truncate">{{ $adminName }}</p>
                                        <p class="text-[10px] text-rose-300 font-mono">{{ $adminDepartment }}</p>
                                        <p class="text-[10px] text-slate-500 font-mono mt-0.5">{{ $adminEmployeeId }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-2.5 pt-2 border-t border-slate-800 text-[10px]">
                                    <span class="text-slate-400">Clearance Tier</span>
                                    <span class="font-bold text-rose-400 font-mono">TIER-1 (FIPS 140-2)</span>
                                </div>
                            </div>

                            <div class="space-y-0.5 text-xs">
                                <a href="{{ route('admin.parameters') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">
                                    <i data-lucide="sliders" class="w-4 h-4 text-slate-400"></i>
                                    <span>System Parameters</span>
                                </a>
                                <a href="{{ route('admin.audit-logs') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">
                                    <i data-lucide="file-check" class="w-4 h-4 text-slate-400"></i>
                                    <span>Compliance Audit Trail</span>
                                </a>
                                <a href="{{ route('customer.dashboard') }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-emerald-400 hover:bg-emerald-950/30 transition-colors">
                                    <i data-lucide="external-link" class="w-4 h-4 text-emerald-400"></i>
                                    <span>Open Customer Portal</span>
                                </a>
                            </div>

                            <div class="mt-2 pt-2 border-t border-slate-800">
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold text-rose-400 hover:bg-rose-950/60 hover:text-rose-300 transition-colors cursor-pointer"
                                    >
                                        <span class="flex items-center gap-2">
                                            <i data-lucide="log-out" class="w-4 h-4"></i>
                                            Sign Out Terminal
                                        </span>
                                        <span class="text-[9px] font-mono text-slate-500">ESC</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </header>

    <!-- ======================================================================
         MOBILE SLIDE-OVER DRAWER FOR ADMIN
         ====================================================================== -->
    <div
        id="admin-drawer"
        class="fixed inset-0 z-50 md:hidden hidden"
        aria-modal="true"
        role="dialog"
    >
        <!-- Backdrop -->
        <div
            id="admin-drawer-backdrop"
            onclick="window.toggleAdminDrawer()"
            class="fixed inset-0 bg-slate-950/75 backdrop-blur-xs transition-opacity duration-300 opacity-0"
        ></div>

        <!-- Drawer Panel -->
        <div
            id="admin-drawer-panel"
            class="fixed inset-y-0 left-0 w-72 sm:w-80 bg-slate-900 border-r border-slate-800 p-5 flex flex-col justify-between shadow-2xl text-white transform -translate-x-full transition-transform duration-300 ease-in-out"
        >
            <div class="space-y-4">
                <!-- Drawer Top Header -->
                <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-rose-600 to-red-700 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                            <i data-lucide="shield-alert" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-white leading-tight">BankFlow MY</h3>
                            <p class="text-[10px] text-rose-300 font-mono">Enterprise Fraud Ops</p>
                        </div>
                    </div>
                    <button
                        type="button"
                        onclick="window.toggleAdminDrawer()"
                        class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 cursor-pointer"
                        aria-label="Close drawer"
                    >
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Admin Profile Card -->
                <div class="p-3 rounded-xl bg-slate-950/80 border border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                            {{ $initials }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-white truncate">{{ $adminName }}</p>
                            <p class="text-[10px] text-rose-300 font-mono">{{ $adminRole }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-800 text-[10px]">
                        <span class="text-slate-400">Clearance:</span>
                        <span class="text-emerald-400 font-mono font-bold">ACTIVE TIER-1</span>
                    </div>
                </div>

                <!-- Drawer Navigation Links -->
                <nav class="space-y-1 text-sm font-medium">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-2 mb-1">Administrative Portfolios</p>
                    <a
                        href="{{ route('admin.dashboard') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'fraud' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >
                        <i data-lucide="activity" class="w-4 h-4"></i>
                        <span>AML Radar &amp; Telemetry</span>
                    </a>
                    <a
                        href="{{ route('admin.parameters') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'parameters' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >
                        <i data-lucide="sliders" class="w-4 h-4"></i>
                        <span>System Parameters</span>
                    </a>
                    <a
                        href="{{ route('admin.customers') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'customers' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Customer Accounts</span>
                    </a>
                    <a
                        href="{{ route('admin.audit-logs') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ $activeNav === 'audit' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >
                        <i data-lucide="file-check" class="w-4 h-4"></i>
                        <span>Compliance Audit Trail</span>
                    </a>

                    <div class="pt-2 border-t border-slate-800">
                        <a
                            href="{{ route('customer.dashboard') }}"
                            target="_blank"
                            class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold text-emerald-400 hover:bg-slate-800"
                        >
                            <span class="flex items-center gap-2">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                                Open Customer Portal
                            </span>
                            <span class="text-[10px] font-mono">Retail</span>
                        </a>
                    </div>
                </nav>
            </div>

            <!-- Drawer Bottom: Sign Out Button -->
            <div class="pt-4 border-t border-slate-800">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-rose-600/20 text-rose-400 hover:bg-rose-600 hover:text-white font-bold text-xs border border-rose-600/30 transition-all cursor-pointer"
                    >
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Terminate Clearance Session</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ======================================================================
         MAIN VIEWPORT CONTAINER
         ====================================================================== -->
    <div class="flex-1 w-full max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8 py-4 sm:py-7 pb-24 md:pb-8 flex flex-col">
        <main class="flex-1 min-w-0">
            {{ $slot }}
        </main>
    </div>

    <!-- ======================================================================
         MOBILE BOTTOM FLOATING ACTION BAR (Only Visible on < md devices)
         ====================================================================== -->
    <nav aria-label="Admin Mobile Navigation" class="md:hidden fixed bottom-0 inset-x-0 z-30 px-2 sm:px-4 pointer-events-none flex justify-center pb-[env(safe-area-inset-bottom,0px)]">
        <div class="pointer-events-auto w-full max-w-sm bg-slate-900/95 backdrop-blur-md border border-slate-800 text-white rounded-t-2xl px-3 py-1.5 shadow-2xl">
            <div class="flex items-center justify-around">
                <!-- AML Radar -->
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'fraud' ? 'text-rose-400 font-bold' : 'text-slate-400 hover:text-white' }} transition-colors"
                >
                    <i data-lucide="activity" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] font-medium">Radar</span>
                </a>

                <!-- Parameters -->
                <a
                    href="{{ route('admin.parameters') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'parameters' ? 'text-rose-400 font-bold' : 'text-slate-400 hover:text-white' }} transition-colors"
                >
                    <i data-lucide="sliders" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] font-medium">Parameters</span>
                </a>

                <!-- Emergency Freeze Action -->
                <button
                    type="button"
                    onclick="alert('BROADCAST CIRCUIT BREAKER: Universal PayNet Outbound rail freeze test simulated.');"
                    class="flex flex-col items-center gap-0.5 px-2 cursor-pointer group"
                    aria-label="Universal Kill Switch"
                >
                    <div class="w-10 h-10 -mt-4 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-lg shadow-rose-900/60 ring-4 ring-slate-900 group-hover:scale-105 transition-all">
                        <i data-lucide="zap-off" class="w-4 h-4"></i>
                    </div>
                    <span class="text-[9px] font-bold text-rose-400">Freeze</span>
                </button>

                <!-- Customers -->
                <a
                    href="{{ route('admin.customers') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'customers' ? 'text-rose-400 font-bold' : 'text-slate-400 hover:text-white' }} transition-colors"
                >
                    <i data-lucide="users" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] font-medium">Customers</span>
                </a>

                <!-- Audit Logs -->
                <a
                    href="{{ route('admin.audit-logs') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'audit' ? 'text-rose-400 font-bold' : 'text-slate-400 hover:text-white' }} transition-colors"
                >
                    <i data-lucide="file-check" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] font-medium">Audit</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- ======================================================================
         HIGH-SECURITY ENTERPRISE FOOTER
         ====================================================================== -->
    <footer class="mt-auto border-t border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/70 text-slate-500 dark:text-slate-400 text-xs py-3.5 sm:py-4 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2.5 text-center sm:text-left text-[11px]">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>BankFlow MY Administrative Tier &bull; Level 4 Clearance &bull; Immutable Audit Active</span>
            </div>
            <div class="flex items-center gap-2 font-mono text-slate-400 dark:text-slate-500">
                <span>Session: Encrypted (TLS 1.3)</span>
                <span>&bull;</span>
                <span>BNM RMiT Compliant</span>
            </div>
        </div>
    </footer>

    <!-- Scripts for Interactive Drawer & Dropdown -->
    <script>
        window.toggleAdminDrawer = function() {
            const drawer = document.getElementById('admin-drawer');
            const backdrop = document.getElementById('admin-drawer-backdrop');
            const panel = document.getElementById('admin-drawer-panel');

            if (drawer.classList.contains('hidden')) {
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    panel.classList.remove('-translate-x-full');
                    panel.classList.add('translate-x-0');
                }, 10);
                document.body.style.overflow = 'hidden';
            } else {
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                panel.classList.remove('translate-x-0');
                panel.classList.add('-translate-x-full');
                setTimeout(() => {
                    drawer.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }
        };

        window.toggleAdminProfileDropdown = function() {
            const menu = document.getElementById('admin-profile-dropdown');
            const chevron = document.getElementById('admin-profile-chevron');
            if (menu.classList.contains('hidden-dropdown')) {
                menu.classList.remove('hidden-dropdown');
                menu.classList.add('visible-dropdown');
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            } else {
                menu.classList.remove('visible-dropdown');
                menu.classList.add('hidden-dropdown');
                if (chevron) chevron.style.transform = '';
            }
        };

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('admin-profile-btn');
            const menu = document.getElementById('admin-profile-dropdown');
            if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('visible-dropdown');
                menu.classList.add('hidden-dropdown');
                const chevron = document.getElementById('admin-profile-chevron');
                if (chevron) chevron.style.transform = '';
            }
        });
    </script>
</body>
</html>

