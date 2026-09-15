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

    <!-- Universal Dynamic Color Palette Overrides (guaranteed instant styling & theme adaptation) -->
    <style id="theme-dynamic-styles">
        :root, html, html[data-color-theme="emerald"] {
            --color-primary: #059669;
            --color-primary-hover: #047857;
            --color-primary-light: #ecfdf5;
            --color-primary-dark: #10b981;
            --theme-ring: rgba(5, 150, 105, 0.35);
        }
        html[data-color-theme="blue"] {
            --color-primary: #2563eb !important;
            --color-primary-hover: #1d4ed8 !important;
            --color-primary-light: #eff6ff !important;
            --color-primary-dark: #3b82f6 !important;
            --theme-ring: rgba(37, 99, 235, 0.35) !important;
        }
        html[data-color-theme="purple"] {
            --color-primary: #7c3aed !important;
            --color-primary-hover: #6d28d9 !important;
            --color-primary-light: #f5f3ff !important;
            --color-primary-dark: #8b5cf6 !important;
            --theme-ring: rgba(124, 58, 237, 0.35) !important;
        }
        html[data-color-theme="amber"] {
            --color-primary: #d97706 !important;
            --color-primary-hover: #b45309 !important;
            --color-primary-light: #fffbeb !important;
            --color-primary-dark: #f59e0b !important;
            --theme-ring: rgba(217, 119, 6, 0.35) !important;
        }
        html[data-color-theme="rose"] {
            --color-primary: #e11d48 !important;
            --color-primary-hover: #be123c !important;
            --color-primary-light: #fff1f2 !important;
            --color-primary-dark: #f43f5e !important;
            --theme-ring: rgba(225, 29, 72, 0.35) !important;
        }
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
<body class="h-full bg-slate-50/80 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-200 flex flex-col min-h-screen selection:bg-rose-600 selection:text-white">

    <!-- ======================================================================
         1. ENTERPRISE ADMIN TOP COMMAND HEADER
         ====================================================================== -->
    <header class="sticky top-0 z-40 w-full bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl text-slate-900 dark:text-slate-100 border-b border-slate-200/80 dark:border-slate-800/80 shadow-xs transition-colors">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-[68px] gap-2.5 sm:gap-4">
                
                <!-- Left: Hamburger (Mobile) + Desktop Sidebar Toggle + Brand Identity -->
                <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                    <!-- Mobile Hamburger -->
                    <button
                        type="button"
                        onclick="window.toggleAdminDrawer()"
                        class="lg:hidden p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500 cursor-pointer transition-colors"
                        aria-label="Open navigation drawer"
                    >
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <!-- Desktop Sidebar Collapse Toggle -->
                    <button
                        type="button"
                        id="desktop-sidebar-toggle-btn"
                        onclick="window.toggleDesktopSidebar()"
                        class="hidden lg:flex p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none transition-colors cursor-pointer"
                        title="Toggle Sidebar (⌘B)"
                        aria-label="Toggle Desktop Sidebar"
                    >
                        <i data-lucide="panel-left" class="w-5 h-5"></i>
                    </button>

                    <!-- Brand Mark -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group shrink-0">
                        <div class="relative w-9.5 h-9.5 sm:w-10.5 sm:h-10.5 rounded-2xl bg-gradient-to-tr from-rose-600 via-rose-700 to-red-800 flex items-center justify-center text-white shadow-md shadow-rose-950/20 dark:shadow-rose-950/60 group-hover:scale-105 transition-transform shrink-0 ring-1 ring-rose-500/40">
                            <i data-lucide="shield-alert" class="w-5 h-5 sm:w-5.5 sm:h-5.5"></i>
                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-rose-500 ring-2 ring-white dark:ring-slate-900 animate-pulse"></span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center gap-2 truncate">
                                <span class="font-black text-sm sm:text-base text-slate-900 dark:text-white tracking-tight">BankFlow</span>
                                <span class="text-[9px] uppercase font-mono font-black tracking-wider px-1.5 py-0.5 rounded bg-rose-500/10 dark:bg-rose-500/20 text-rose-600 dark:text-rose-300 border border-rose-500/20 dark:border-rose-500/30 shrink-0">DEFENSE OPS</span>
                            </div>
                            <span class="text-[10px] text-slate-500 dark:text-slate-400 font-medium hidden sm:block truncate">Enterprise Clearing &amp; Fraud Telemetry</span>
                        </div>
                    </a>
                </div>

                <!-- Center: Global Command Search Palette (⌘K) -->
                <div class="hidden md:flex items-center flex-1 max-w-md mx-4">
                    <div class="relative w-full">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                        <input
                            type="text"
                            placeholder="Search parameters, customer NRIC, or transaction reference (Press ⌘K)..."
                            onclick="window.openAdminCommandPalette()"
                            readonly
                            class="w-full pl-9.5 pr-14 py-2 text-xs rounded-2xl bg-slate-100/90 dark:bg-slate-950/70 border border-slate-200/80 dark:border-slate-800 text-slate-800 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-rose-500 transition-all cursor-pointer shadow-2xs"
                        />
                        <div class="absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center gap-1">
                            <kbd class="px-1.5 py-0.5 rounded bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[10px] font-mono text-slate-500 dark:text-slate-400 shadow-2xs">⌘K</kbd>
                        </div>
                    </div>
                </div>

                <!-- Right Actions: DEFCON Status, Portal Switch, Theme Toggle & Profile -->
                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- Customer Portal Jump Link -->
                    <a
                        href="{{ route('customer.dashboard') }}"
                        target="_blank"
                        title="Open Retail Customer Portal in new window"
                        class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 border border-emerald-200 dark:border-emerald-800/60 transition-colors shadow-2xs"
                    >
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span>Retail Portal</span>
                    </a>

                    <!-- DEFCON Indicator Badge -->
                    <div class="hidden xl:flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl bg-slate-100/80 dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 text-rose-600 dark:text-rose-300 text-[11px] font-mono font-bold shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                        DEFCON: 5 (MONITOR)
                    </div>

                    <!-- Dark / Light Theme Toggle (Circle Icon Button matching public layout) -->
                    <x-ui.dark-toggle class="w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center p-0 border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300" />

                    <!-- Profile Dropdown Trigger -->
                    <div class="relative">
                        <button
                            type="button"
                            id="admin-profile-btn"
                            onclick="window.toggleAdminProfileDropdown()"
                            class="flex items-center gap-2 pl-1.5 pr-2 sm:pr-3 py-1 rounded-2xl bg-slate-100/90 dark:bg-slate-800/80 hover:bg-slate-200/90 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 transition-all cursor-pointer shadow-xs group"
                            aria-label="Admin User Profile Menu"
                        >
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-rose-600 to-red-600 text-white flex items-center justify-center font-black text-xs shadow-xs group-hover:scale-105 transition-transform shrink-0">
                                {{ $initials }}
                            </div>
                            <div class="hidden lg:block text-left min-w-0 max-w-[130px]">
                                <span class="block text-xs font-bold text-slate-800 dark:text-white truncate leading-tight">{{ $adminName }}</span>
                                <span class="block text-[10px] text-rose-600 dark:text-rose-300 truncate font-mono uppercase font-semibold">{{ $adminRole }}</span>
                            </div>
                            <i data-lucide="chevron-down" id="admin-profile-chevron" class="w-3.5 h-3.5 text-slate-400 group-hover:text-slate-800 dark:group-hover:text-white transition-transform shrink-0"></i>
                        </button>

                        <!-- Profile Dropdown Menu -->
                        <div
                            id="admin-profile-dropdown"
                            class="admin-dropdown-menu hidden-dropdown absolute right-0 top-full mt-2 w-72 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xl p-2 z-50 transition-colors"
                        >
                            <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-950/80 border border-slate-200/80 dark:border-slate-800/80 mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center font-black text-sm shadow-xs shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $adminName }}</p>
                                        <p class="text-[10px] text-rose-600 dark:text-rose-300 font-mono font-semibold">{{ $adminDepartment }}</p>
                                        <p class="text-[10px] text-slate-500 font-mono mt-0.5">{{ $adminEmployeeId }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-2.5 pt-2 border-t border-slate-200 dark:border-slate-800 text-[10px]">
                                    <span class="text-slate-500 dark:text-slate-400">Clearance Tier</span>
                                    <span class="font-bold text-rose-600 dark:text-rose-400 font-mono">TIER-1 (FIPS 140-2)</span>
                                </div>
                            </div>

                            <div class="space-y-0.5 text-xs">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                    <i data-lucide="activity" class="w-4 h-4 text-slate-400"></i>
                                    <span>Command Center</span>
                                </a>
                                <a href="{{ route('admin.parameters') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                    <i data-lucide="sliders" class="w-4 h-4 text-slate-400"></i>
                                    <span>System Parameters</span>
                                </a>
                                <a href="{{ route('admin.audit-logs') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                    <i data-lucide="file-check" class="w-4 h-4 text-slate-400"></i>
                                    <span>Compliance Audit Trail</span>
                                </a>
                                <a href="{{ route('customer.dashboard') }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 transition-colors">
                                    <i data-lucide="external-link" class="w-4 h-4 text-emerald-500"></i>
                                    <span>Open Customer Portal</span>
                                </a>
                            </div>

                            <div class="mt-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/60 hover:text-rose-700 dark:hover:text-rose-300 transition-colors cursor-pointer"
                                    >
                                        <span class="flex items-center gap-2">
                                             <i data-lucide="log-out" class="w-4 h-4"></i>
                                             Sign Out Terminal
                                        </span>
                                        <span class="text-[9px] font-mono text-slate-400 dark:text-slate-500">ESC</span>
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
         2. MAIN BODY WRAPPER (Desktop Sidebar + Main Content Layout)
         ====================================================================== -->
    <div class="flex-1 flex w-full">

        <!-- DESKTOP SIDEBAR (Visible on lg+ screens, collapsible) -->
        <aside
            id="admin-desktop-sidebar"
            class="hidden lg:flex flex-col w-64 xl:w-72 bg-white/95 dark:bg-slate-900/95 text-slate-900 dark:text-slate-100 border-r border-slate-200/80 dark:border-slate-800/80 transition-all duration-300 ease-in-out shrink-0 sticky top-16 sm:top-[68px] h-[calc(100vh-68px)] select-none z-30"
        >
            <div class="flex-1 flex flex-col justify-between p-4 overflow-y-auto space-y-6">
                
                <div class="space-y-5">
                    <!-- Clearance Status Card -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/80 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-rose-600 to-red-700 text-white flex items-center justify-center font-bold text-sm shadow-md shrink-0 ring-1 ring-rose-500/30">
                                {{ $initials }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $adminName }}</p>
                                <p class="text-[10px] text-rose-600 dark:text-rose-300 font-mono font-semibold truncate">{{ $adminDepartment }}</p>
                                <p class="text-[10px] text-slate-500 font-mono mt-0.5 truncate">{{ $adminEmployeeId }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-3 pt-2.5 border-t border-slate-200/80 dark:border-slate-800 text-[10px]">
                            <span class="text-slate-500 dark:text-slate-400">Clearance:</span>
                            <span class="text-emerald-600 dark:text-emerald-400 font-mono font-bold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                ACTIVE TIER-1
                            </span>
                        </div>
                    </div>

                    <!-- Main Navigation Links Group -->
                    <nav class="space-y-1 text-xs">
                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500 px-3 mb-2 font-mono">
                            Administrative Portfolios
                        </p>
                        
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl font-bold transition-all group {{ $activeNav === 'fraud' || $activeNav === 'dashboard' ? 'bg-rose-600 text-white shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}"
                        >
                            <div class="flex items-center gap-3">
                                <i data-lucide="activity" class="w-4 h-4 {{ $activeNav === 'fraud' || $activeNav === 'dashboard' ? 'text-white' : 'text-slate-400 group-hover:text-slate-800 dark:group-hover:text-white' }}"></i>
                                <span>Command Center</span>
                            </div>
                            @if($activeNav === 'fraud' || $activeNav === 'dashboard')
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            @endif
                        </a>

                        <a
                            href="{{ route('admin.parameters') }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl font-bold transition-all group {{ $activeNav === 'parameters' ? 'bg-rose-600 text-white shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}"
                        >
                            <div class="flex items-center gap-3">
                                <i data-lucide="sliders" class="w-4 h-4 {{ $activeNav === 'parameters' ? 'text-white' : 'text-slate-400 group-hover:text-slate-800 dark:group-hover:text-white' }}"></i>
                                <span>System Parameters</span>
                            </div>
                            @if($activeNav === 'parameters')
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            @endif
                        </a>

                        <a
                            href="{{ route('admin.customers') }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl font-bold transition-all group {{ $activeNav === 'customers' ? 'bg-rose-600 text-white shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}"
                        >
                            <div class="flex items-center gap-3">
                                <i data-lucide="users" class="w-4 h-4 {{ $activeNav === 'customers' ? 'text-white' : 'text-slate-400 group-hover:text-slate-800 dark:group-hover:text-white' }}"></i>
                                <span>Customer Accounts</span>
                            </div>
                            @if($activeNav === 'customers')
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            @endif
                        </a>

                        <a
                            href="{{ route('admin.audit-logs') }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl font-bold transition-all group {{ $activeNav === 'audit' ? 'bg-rose-600 text-white shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-slate-800/70' }}"
                        >
                            <div class="flex items-center gap-3">
                                <i data-lucide="file-check" class="w-4 h-4 {{ $activeNav === 'audit' ? 'text-white' : 'text-slate-400 group-hover:text-slate-800 dark:group-hover:text-white' }}"></i>
                                <span>Compliance Audit Trail</span>
                            </div>
                            @if($activeNav === 'audit')
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            @endif
                        </a>
                    </nav>

                    <!-- Fast Operational Actions -->
                    <div class="pt-2">
                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500 px-3 mb-2 font-mono">
                            Gateway Operations
                        </p>
                        <div class="space-y-1.5 text-xs">
                            <a
                                href="{{ route('admin.parameters') }}#biller-directory-card"
                                class="flex items-center justify-between px-3.5 py-2 rounded-2xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-slate-800/70 transition-colors"
                            >
                                <span class="flex items-center gap-2.5">
                                    <i data-lucide="receipt" class="w-4 h-4 text-slate-400"></i>
                                    <span>JomPAY Directory</span>
                                </span>
                            </a>
                            <a
                                href="{{ route('admin.parameters') }}#bank-directory-card"
                                class="flex items-center justify-between px-3.5 py-2 rounded-2xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-slate-800/70 transition-colors"
                            >
                                <span class="flex items-center gap-2.5">
                                    <i data-lucide="building-2" class="w-4 h-4 text-slate-400"></i>
                                    <span>Member Banks</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Footer Status -->
                <div class="pt-4 border-t border-slate-200/80 dark:border-slate-800">
                    <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/80 dark:border-slate-800 text-[11px] space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500 dark:text-slate-400">Audit Protocol:</span>
                            <span class="font-mono font-bold text-emerald-600 dark:text-emerald-400">WORM Active</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500 dark:text-slate-400">Encryption:</span>
                            <span class="font-mono text-slate-700 dark:text-slate-300">TLS 1.3 / FIPS</span>
                        </div>
                    </div>
                </div>

            </div>
        </aside>

        <!-- MAIN VIEWPORT CONTENT (Full Width Enterprise Layout) -->
        <div class="flex-1 flex flex-col min-w-0 w-full">
            <main class="flex-1 w-full px-4 sm:px-6 lg:px-8 xl:px-10 py-5 sm:py-7 pb-24 md:pb-10">
                {{ $slot }}
            </main>

            <!-- ======================================================================
                 3. HIGH-SECURITY ENTERPRISE FOOTER (Full Width)
                 ====================================================================== -->
            <footer class="mt-auto border-t border-slate-200 dark:border-slate-800/80 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md text-slate-500 dark:text-slate-400 text-xs py-5 transition-colors">
                <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 space-y-3">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-center md:text-left text-[11px]">
                        <!-- Left Status & Entity -->
                        <div class="flex items-center gap-2 flex-wrap justify-center md:justify-start">
                            <div class="w-5 h-5 rounded-md bg-rose-600 text-white flex items-center justify-center font-black text-[10px] shadow-xs">
                                BF
                            </div>
                            <span class="font-bold text-slate-800 dark:text-slate-200">BankFlow Malaysia Berhad</span>
                            <span class="text-slate-300 dark:text-slate-700">&bull;</span>
                            <span class="font-medium text-slate-500 dark:text-slate-400">Enterprise Administration &amp; Compliance Center</span>
                            <span class="text-slate-300 dark:text-slate-700">&bull;</span>
                            <span class="inline-flex items-center gap-1 text-emerald-600 dark:text-emerald-400 font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Level 4 FIPS Clearance
                            </span>
                        </div>

                        <!-- Right Quick Telemetry Status -->
                        <div class="flex items-center gap-3 font-mono text-[10px] text-slate-400 dark:text-slate-500 flex-wrap justify-center">
                            <span>ISO 20022 camt.053</span>
                            <span>&bull;</span>
                            <span>BNM RMiT Audit: VERIFIED</span>
                            <span>&bull;</span>
                            <span>&copy; {{ date('Y') }} BankFlow MY</span>
                        </div>
                    </div>

                    <!-- Bottom fine-print disclaimer for bank compliance -->
                    <div class="pt-2.5 border-t border-slate-100 dark:border-slate-800/60 flex flex-col sm:flex-row items-center justify-between gap-2 text-[10px] text-slate-400 dark:text-slate-500">
                        <p>
                            RESTRICTED ACCESS: This operational console is restricted to authorized risk and fraud officers. All actions, parameter adjustments, and account isolation events are cryptographically sealed in WORM ledger storage.
                        </p>
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-600 dark:hover:text-slate-300 transition-colors">Command</a>
                            <span>&bull;</span>
                            <a href="{{ route('admin.parameters') }}" class="hover:text-slate-600 dark:hover:text-slate-300 transition-colors">Parameters</a>
                            <span>&bull;</span>
                            <a href="{{ route('admin.audit-logs') }}" class="hover:text-slate-600 dark:hover:text-slate-300 transition-colors">Audit Trail</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <!-- ======================================================================
         MOBILE SLIDE-OVER DRAWER FOR ADMIN (< lg devices)
         ====================================================================== -->
    <div
        id="admin-drawer"
        class="fixed inset-0 z-50 lg:hidden hidden"
        aria-modal="true"
        role="dialog"
    >
        <!-- Backdrop -->
        <div
            id="admin-drawer-backdrop"
            onclick="window.toggleAdminDrawer()"
            class="fixed inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-xs transition-opacity duration-300 opacity-0"
        ></div>

        <!-- Drawer Panel -->
        <div
            id="admin-drawer-panel"
            class="fixed inset-y-0 left-0 w-72 sm:w-80 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-5 flex flex-col justify-between shadow-2xl text-slate-900 dark:text-white transform -translate-x-full transition-transform duration-300 ease-in-out"
        >
            <div class="space-y-4">
                <!-- Drawer Top Header -->
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-rose-600 to-red-700 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                            <i data-lucide="shield-alert" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900 dark:text-white leading-tight">BankFlow MY</h3>
                            <p class="text-[10px] text-rose-600 dark:text-rose-300 font-mono font-semibold">Enterprise Fraud Ops</p>
                        </div>
                    </div>
                    <button
                        type="button"
                        onclick="window.toggleAdminDrawer()"
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-800 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer transition-colors"
                        aria-label="Close drawer"
                    >
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Admin Profile Card -->
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/80 border border-slate-200/80 dark:border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                            {{ $initials }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $adminName }}</p>
                            <p class="text-[10px] text-rose-600 dark:text-rose-300 font-mono font-semibold">{{ $adminRole }}</p>
                            <p class="text-[10px] text-slate-500 font-mono mt-0.5">{{ $adminEmployeeId }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2.5 pt-2 border-t border-slate-200 dark:border-slate-800 text-[10px]">
                        <span class="text-slate-500 dark:text-slate-400">Clearance:</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-mono font-bold">ACTIVE TIER-1</span>
                    </div>
                </div>

                <!-- Drawer Navigation Links -->
                <nav class="space-y-1 text-sm font-medium">
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider px-2 mb-1 font-mono">
                        Administrative Portfolios
                    </p>
                    <a
                        href="{{ route('admin.dashboard') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ $activeNav === 'fraud' || $activeNav === 'dashboard' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}"
                    >
                        <i data-lucide="activity" class="w-4 h-4"></i>
                        <span>Command Center &amp; Radar</span>
                    </a>
                    <a
                        href="{{ route('admin.parameters') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ $activeNav === 'parameters' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}"
                    >
                        <i data-lucide="sliders" class="w-4 h-4"></i>
                        <span>System Parameters</span>
                    </a>
                    <a
                        href="{{ route('admin.customers') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ $activeNav === 'customers' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}"
                    >
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Customer Accounts</span>
                    </a>
                    <a
                        href="{{ route('admin.audit-logs') }}"
                        onclick="window.toggleAdminDrawer()"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ $activeNav === 'audit' ? 'bg-rose-600 text-white font-bold shadow-md shadow-rose-950/20 dark:shadow-rose-950' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}"
                    >
                        <i data-lucide="file-check" class="w-4 h-4"></i>
                        <span>Compliance Audit Trail</span>
                    </a>

                    <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                        <a
                            href="{{ route('customer.dashboard') }}"
                            target="_blank"
                            class="flex items-center justify-between px-3.5 py-2 rounded-2xl text-xs font-semibold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-slate-800 transition-colors"
                        >
                            <span class="flex items-center gap-2">
                                <i data-lucide="external-link" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i>
                                Open Customer Portal
                            </span>
                            <span class="text-[10px] font-mono font-bold bg-emerald-100 dark:bg-emerald-950/60 px-1.5 py-0.5 rounded text-emerald-800 dark:text-emerald-300">Retail</span>
                        </a>
                    </div>
                </nav>
            </div>

            <!-- Drawer Bottom: Sign Out Button -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-3 rounded-2xl bg-rose-50 hover:bg-rose-600 dark:bg-rose-600/20 dark:hover:bg-rose-600 text-rose-700 dark:text-rose-400 hover:text-white dark:hover:text-white font-bold text-xs border border-rose-200/80 dark:border-rose-600/30 transition-all cursor-pointer"
                    >
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Terminate Clearance Session</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ======================================================================
         MOBILE BOTTOM FLOATING ACTION BAR (Visible on < lg devices)
         ====================================================================== -->
    <nav aria-label="Admin Mobile Navigation" class="lg:hidden fixed bottom-0 inset-x-0 z-30 px-2 sm:px-4 pointer-events-none flex justify-center pb-[env(safe-area-inset-bottom,0px)]">
        <div class="pointer-events-auto w-full max-w-sm bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/90 dark:border-slate-800 text-slate-900 dark:text-white rounded-t-2xl px-3 py-1.5 shadow-2xl transition-colors">
            <div class="flex items-center justify-around">
                <!-- Command Radar -->
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'fraud' || $activeNav === 'dashboard' ? 'text-rose-600 dark:text-rose-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }} transition-colors"
                >
                    <i data-lucide="activity" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] font-medium">Command</span>
                </a>

                <!-- Parameters -->
                <a
                    href="{{ route('admin.parameters') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'parameters' ? 'text-rose-600 dark:text-rose-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }} transition-colors"
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
                    <div class="w-10 h-10 -mt-4 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-lg shadow-rose-900/40 ring-4 ring-white dark:ring-slate-900 group-hover:scale-105 transition-all">
                        <i data-lucide="zap-off" class="w-4 h-4"></i>
                    </div>
                    <span class="text-[9px] font-bold text-rose-600 dark:text-rose-400">Freeze</span>
                </button>

                <!-- Customers -->
                <a
                    href="{{ route('admin.customers') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'customers' ? 'text-rose-600 dark:text-rose-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }} transition-colors"
                >
                    <i data-lucide="users" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] font-medium">Customers</span>
                </a>

                <!-- Audit Logs -->
                <a
                    href="{{ route('admin.audit-logs') }}"
                    class="flex flex-col items-center gap-0.5 px-2 py-1 {{ $activeNav === 'audit' ? 'text-rose-600 dark:text-rose-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }} transition-colors"
                >
                    <i data-lucide="file-check" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] font-medium">Audit</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Global Admin Command Palette Modal -->
    <div id="admin-command-palette-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-xs" onclick="window.closeAdminCommandPalette()"></div>
        <div class="fixed inset-0 flex items-start justify-center pt-16 sm:pt-24 px-4 pointer-events-none">
            <div class="w-full max-w-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-3xl shadow-2xl p-4 pointer-events-auto animate__animated animate__fadeInDown animate__faster transition-colors">
                <div class="flex items-center gap-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <i data-lucide="search" class="w-5 h-5 text-rose-500 shrink-0"></i>
                    <input
                        type="text"
                        id="admin-palette-input"
                        placeholder="Type a command or jump to screen..."
                        class="w-full bg-transparent text-sm font-semibold text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none"
                    />
                    <kbd class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-[10px] font-mono text-slate-500 dark:text-slate-400 cursor-pointer border border-slate-200 dark:border-slate-700" onclick="window.closeAdminCommandPalette()">ESC</kbd>
                </div>
                <div class="py-2 space-y-1 text-xs">
                    <p class="px-2 py-1 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase font-mono">Quick Navigation</p>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
                        <i data-lucide="activity" class="w-4 h-4 text-rose-500"></i>
                        <span>Command Center &amp; AML Radar</span>
                    </a>
                    <a href="{{ route('admin.parameters') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
                        <i data-lucide="sliders" class="w-4 h-4 text-rose-500"></i>
                        <span>System Parameters Management</span>
                    </a>
                    <a href="{{ route('admin.customers') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
                        <i data-lucide="users" class="w-4 h-4 text-rose-500"></i>
                        <span>Customer Directory &amp; Account Status</span>
                    </a>
                    <a href="{{ route('admin.audit-logs') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white transition-colors">
                        <i data-lucide="file-check" class="w-4 h-4 text-rose-500"></i>
                        <span>WORM Compliance Audit Logs</span>
                    </a>
                    <a href="{{ route('customer.dashboard') }}" target="_blank" class="flex items-center gap-3 px-3 py-2 rounded-xl text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 transition-colors">
                        <i data-lucide="external-link" class="w-4 h-4 text-emerald-500"></i>
                        <span>Launch Retail Customer Portal</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts for Interactive Drawer, Sidebar, Search & Dropdown -->
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

        window.toggleDesktopSidebar = function() {
            const sidebar = document.getElementById('admin-desktop-sidebar');
            if (!sidebar) return;
            if (sidebar.classList.contains('lg:flex')) {
                sidebar.classList.remove('lg:flex');
                sidebar.classList.add('hidden');
                localStorage.setItem('admin-sidebar-collapsed', 'true');
            } else {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('lg:flex');
                localStorage.setItem('admin-sidebar-collapsed', 'false');
            }
        };

        // Restore sidebar preference
        (function restoreSidebar() {
            if (localStorage.getItem('admin-sidebar-collapsed') === 'true') {
                const sidebar = document.getElementById('admin-desktop-sidebar');
                if (sidebar) {
                    sidebar.classList.remove('lg:flex');
                    sidebar.classList.add('hidden');
                }
            }
        })();

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

        // Command Palette
        window.openAdminCommandPalette = function() {
            const modal = document.getElementById('admin-command-palette-modal');
            const input = document.getElementById('admin-palette-input');
            if (modal) {
                modal.classList.remove('hidden');
                if (input) setTimeout(() => input.focus(), 50);
            }
        };
        window.closeAdminCommandPalette = function() {
            const modal = document.getElementById('admin-command-palette-modal');
            if (modal) modal.classList.add('hidden');
        };

        // Keyboard Shortcuts (⌘K for palette, ⌘B for sidebar)
        document.addEventListener('keydown', function(e) {
            if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                window.openAdminCommandPalette();
            } else if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'b') {
                e.preventDefault();
                window.toggleDesktopSidebar();
            } else if (e.key === 'Escape') {
                window.closeAdminCommandPalette();
                const menu = document.getElementById('admin-profile-dropdown');
                if (menu && !menu.classList.contains('hidden-dropdown')) {
                    menu.classList.add('hidden-dropdown');
                    menu.classList.remove('visible-dropdown');
                }
            }
        });
    </script>
</body>
</html>

