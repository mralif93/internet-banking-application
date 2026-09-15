@props([
    'title' => 'BankFlow MY — Retail Digital Banking',
    'activeNav' => 'dashboard',
])

@php
$customer = Auth::guard('customer')->user();
$customerName = $customer ? $customer->name : 'Ahmad Daniel Bin Alif';
$customerUsername = $customer ? $customer->username : 'daniel_alif';
$customerInitial = strtoupper(substr($customerName, 0, 2));
$firstName = explode(' ', $customerName)[0];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#059669">
    <meta name="description" content="BankFlow MY - Modern Retail Online Banking with PayNet DuitNow, instant transfers, and biometric security.">
    <title>{{ $title }}</title>

    <!-- Theme & Color Theme hydration to prevent FOUC -->
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
                
                const metaThemeColorMap = {
                    emerald: '#059669',
                    blue: '#2563eb',
                    purple: '#7c3aed',
                    amber: '#d97706',
                    rose: '#e11d48'
                };
                const metaTag = document.querySelector('meta[name="theme-color"]');
                if (metaTag && metaThemeColorMap[storedColor]) {
                    metaTag.setAttribute('content', metaThemeColorMap[storedColor]);
                }
            } catch (_) {}
        })();
    </script>

    <!-- Universal Dynamic Color Palette Overrides (guaranteed instant styling) -->
    <style id="theme-dynamic-styles">
        :root, html, html[data-color-theme="emerald"] {
            --color-primary: #059669;
            --color-primary-hover: #047857;
            --color-primary-light: #ecfdf5;
            --color-primary-dark: #10b981;
            --color-secondary: #0d9488;
            --theme-ring: rgba(5, 150, 105, 0.35);
            --theme-gradient: linear-gradient(135deg, #059669, #10b981, #14b8a6);
        }
        html[data-color-theme="blue"] {
            --color-primary: #2563eb !important;
            --color-primary-hover: #1d4ed8 !important;
            --color-primary-light: #eff6ff !important;
            --color-primary-dark: #3b82f6 !important;
            --color-secondary: #0284c7 !important;
            --theme-ring: rgba(37, 99, 235, 0.35) !important;
            --theme-gradient: linear-gradient(135deg, #1d4ed8, #2563eb, #38bdf8) !important;
        }
        html[data-color-theme="purple"] {
            --color-primary: #7c3aed !important;
            --color-primary-hover: #6d28d9 !important;
            --color-primary-light: #f5f3ff !important;
            --color-primary-dark: #8b5cf6 !important;
            --color-secondary: #9333ea !important;
            --theme-ring: rgba(124, 58, 237, 0.35) !important;
            --theme-gradient: linear-gradient(135deg, #6d28d9, #7c3aed, #c084fc) !important;
        }
        html[data-color-theme="amber"] {
            --color-primary: #d97706 !important;
            --color-primary-hover: #b45309 !important;
            --color-primary-light: #fffbeb !important;
            --color-primary-dark: #f59e0b !important;
            --color-secondary: #ea580c !important;
            --theme-ring: rgba(217, 119, 6, 0.35) !important;
            --theme-gradient: linear-gradient(135deg, #b45309, #d97706, #fbbf24) !important;
        }
        html[data-color-theme="rose"] {
            --color-primary: #e11d48 !important;
            --color-primary-hover: #be123c !important;
            --color-primary-light: #fff1f2 !important;
            --color-primary-dark: #f43f5e !important;
            --color-secondary: #db2777 !important;
            --theme-ring: rgba(225, 29, 72, 0.35) !important;
            --theme-gradient: linear-gradient(135deg, #be123c, #e11d48, #fb7185) !important;
        }

        /* Enforce universal overrides when data-color-theme is NOT emerald */
        html[data-color-theme]:not([data-color-theme="emerald"]) .bg-emerald-600,
        html[data-color-theme]:not([data-color-theme="emerald"]) .bg-emerald-500 {
            background-color: var(--color-primary) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .hover\:bg-emerald-700:hover,
        html[data-color-theme]:not([data-color-theme="emerald"]) .hover\:bg-emerald-500:hover {
            background-color: var(--color-primary-hover) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .text-emerald-600,
        html[data-color-theme]:not([data-color-theme="emerald"]) .text-emerald-700,
        html[data-color-theme]:not([data-color-theme="emerald"]) .text-emerald-500 {
            color: var(--color-primary) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:text-emerald-400,
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:text-emerald-300 {
            color: var(--color-primary-dark) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .hover\:text-emerald-600:hover,
        html[data-color-theme]:not([data-color-theme="emerald"]) .hover\:text-emerald-700:hover {
            color: var(--color-primary-hover) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .border-emerald-500,
        html[data-color-theme]:not([data-color-theme="emerald"]) .border-emerald-600 {
            border-color: var(--color-primary) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .bg-emerald-50 {
            background-color: var(--color-primary-light) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .bg-emerald-500\/10 {
            background-color: color-mix(in srgb, var(--color-primary) 12%, transparent) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .bg-emerald-500\/20 {
            background-color: color-mix(in srgb, var(--color-primary) 22%, transparent) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .border-emerald-500\/20,
        html[data-color-theme]:not([data-color-theme="emerald"]) .border-emerald-200,
        html[data-color-theme]:not([data-color-theme="emerald"]) .border-emerald-300 {
            border-color: color-mix(in srgb, var(--color-primary) 30%, transparent) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:bg-emerald-950\/30,
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:bg-emerald-950\/40,
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:bg-emerald-950\/60,
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:bg-emerald-950\/80,
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:bg-emerald-900\/60 {
            background-color: color-mix(in srgb, var(--color-primary) 22%, #0f172a) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:border-emerald-900\/60,
        html[data-color-theme]:not([data-color-theme="emerald"]).dark .dark\:border-emerald-800\/40 {
            border-color: color-mix(in srgb, var(--color-primary) 35%, transparent) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .focus\:ring-emerald-500:focus,
        html[data-color-theme]:not([data-color-theme="emerald"]) .focus\:ring-emerald-500:focus-within {
            --tw-ring-color: var(--theme-ring) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .focus\:border-emerald-500:focus {
            border-color: var(--color-primary) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .shadow-emerald-600\/20,
        html[data-color-theme]:not([data-color-theme="emerald"]) .shadow-emerald-600\/25,
        html[data-color-theme]:not([data-color-theme="emerald"]) .shadow-emerald-500\/25,
        html[data-color-theme]:not([data-color-theme="emerald"]) .shadow-emerald-500\/35,
        html[data-color-theme]:not([data-color-theme="emerald"]) .shadow-emerald-500\/30 {
            box-shadow: 0 10px 15px -3px var(--theme-ring) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .group:hover .group-hover\:bg-emerald-600 {
            background-color: var(--color-primary) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .group:hover .group-hover\:text-emerald-600 {
            color: var(--color-primary) !important;
        }
        html[data-color-theme]:not([data-color-theme="emerald"]) .from-emerald-600.via-emerald-500.to-teal-400,
        html[data-color-theme]:not([data-color-theme="emerald"]) .from-emerald-600.to-teal-500,
        html[data-color-theme]:not([data-color-theme="emerald"]) .from-emerald-700.to-teal-900 {
            background-image: var(--theme-gradient) !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Header search expand animation */
        .header-search-input {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
        }
        /* Notification & Profile dropdown slide */
        .notif-dropdown, .profile-dropdown {
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
        /* Notification badge pulse */
        @keyframes badge-ping {
            0% { transform: scale(1); opacity: 1; }
            75% { transform: scale(1.8); opacity: 0; }
            100% { transform: scale(1.8); opacity: 0; }
        }
        .badge-ping::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: inherit;
            animation: badge-ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        /* Greeting wave animation */
        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            15% { transform: rotate(14deg); }
            30% { transform: rotate(-8deg); }
            45% { transform: rotate(14deg); }
            60% { transform: rotate(-4deg); }
            75% { transform: rotate(10deg); }
        }
        .wave-hand {
            display: inline-block;
            animation: wave 2s ease-in-out 1;
            transform-origin: 70% 70%;
        }
    </style>
</head>
<body class="h-full bg-slate-100/75 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-200 flex flex-col min-h-screen selection:bg-emerald-600 selection:text-white">

    <!-- ======================================================================
         MODERN RESPONSIVE APP HEADER (Mobile, Tablet & Desktop Unified)
         ====================================================================== -->
    <header class="sticky top-0 z-40 w-full bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 transition-all duration-200 shadow-xs">
        <div class="max-w-6xl mx-auto px-3.5 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-[68px] gap-2.5 sm:gap-4">

                <!-- Left: Bank Brand & User Greeting -->
                <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0">
                    <!-- Brand Icon & Mark -->
                    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2.5 shrink-0 group" title="BankFlow MY Home">
                        <div class="relative w-9.5 h-9.5 sm:w-10.5 sm:h-10.5 rounded-2xl bg-gradient-to-tr from-emerald-600 via-emerald-500 to-teal-400 flex items-center justify-center text-white shadow-md shadow-emerald-500/25 group-hover:scale-105 group-hover:shadow-emerald-500/35 transition-all">
                            <i data-lucide="landmark" class="w-5 h-5 sm:w-5.5 sm:h-5.5"></i>
                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-400 ring-2 ring-white dark:ring-slate-900 animate-pulse"></span>
                        </div>
                        <div class="hidden sm:flex flex-col">
                            <div class="flex items-center gap-1.5">
                                <span class="font-black text-sm sm:text-base tracking-tight text-slate-900 dark:text-slate-50">
                                    BankFlow
                                </span>
                                <span class="text-[9px] font-black uppercase tracking-wider px-1.5 py-0.5 rounded-md bg-emerald-50 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20 shadow-2xs">MY</span>
                            </div>
                            <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 tracking-tight">Internet Banking</span>
                        </div>
                    </a>
                </div>

                <!-- Right Controls: Quick Search + Dark Mode + Notifications + Profile Dropdown -->
                <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">

                    <!-- Search Trigger (Circle w-10 h-10) -->
                    <button
                        type="button"
                        onclick="window.toggleHeaderSearch()"
                        class="w-10 h-10 rounded-full flex items-center justify-center bg-slate-100/80 dark:bg-slate-800/70 hover:bg-slate-200/80 dark:hover:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-all cursor-pointer text-xs group shadow-2xs shrink-0"
                        aria-label="Search banking services and transactions"
                        title="Search services (⌘K)"
                    >
                        <i data-lucide="search" class="w-4.5 h-4.5 text-slate-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors shrink-0"></i>
                    </button>

                    <!-- Dark Mode Toggle (Circle w-10 h-10) -->
                    <div class="flex items-center justify-center shrink-0">
                        <x-ui.dark-toggle class="w-10 h-10 rounded-full flex items-center justify-center p-0 border border-slate-200/80 dark:border-slate-700/80 bg-slate-100/70 dark:bg-slate-800/70 hover:bg-slate-200/80 dark:hover:bg-slate-800 transition-all shadow-2xs" />
                    </div>

                    <!-- Notification Bell & Dynamic Popover (Circle w-10 h-10) -->
                    <div class="relative shrink-0" id="notif-container">
                        <button
                            type="button"
                            id="notif-bell-btn"
                            onclick="window.toggleNotifications()"
                            class="relative w-10 h-10 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-slate-700/80 bg-slate-100/70 dark:bg-slate-800/70 hover:bg-slate-200/80 dark:hover:bg-slate-800 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all cursor-pointer shadow-2xs"
                            aria-label="Notifications"
                            title="Notifications"
                        >
                            <i data-lucide="bell" class="w-4.5 h-4.5"></i>
                            <span id="notif-badge" class="absolute -top-1 -right-1 w-4.5 h-4.5 rounded-full bg-rose-500 text-white text-[9px] font-black flex items-center justify-center shadow-xs ring-2 ring-white dark:ring-slate-900">
                                3
                            </span>
                        </button>

                        <!-- Notification Dropdown -->
                        <div id="notif-dropdown" class="notif-dropdown hidden-dropdown absolute right-0 top-full mt-2 w-80 sm:w-96 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-2xl shadow-slate-900/10 dark:shadow-slate-950/40 overflow-hidden z-50">
                            <!-- Dropdown Header -->
                            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/40">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-xs font-bold text-slate-900 dark:text-slate-100 uppercase tracking-wider">Notifications</h3>
                                    <span class="px-1.5 py-0.5 rounded-md text-[9px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">3 New</span>
                                </div>
                                <button type="button" onclick="window.markAllRead()" class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors cursor-pointer">
                                    Mark all read
                                </button>
                            </div>

                            <!-- Notification Items -->
                            <div class="max-h-72 overflow-y-auto divide-y divide-slate-100 dark:divide-slate-800/60">
                                <!-- Notification 1 — Unread -->
                                <div class="notif-item px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer flex items-start gap-3" data-unread="true">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="arrow-down-left" class="w-4 h-4"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Transfer Received</p>
                                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">RM 450.00 from Sarah Binti Zulkifli via DuitNow</p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">2 min ago</p>
                                    </div>
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0 mt-2"></span>
                                </div>

                                <!-- Notification 2 — Unread -->
                                <div class="notif-item px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer flex items-start gap-3" data-unread="true">
                                    <div class="w-8 h-8 rounded-xl bg-amber-100 dark:bg-amber-950/80 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="clock" class="w-4 h-4"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Cooling-Off Active</p>
                                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">RM 1,200 to Lim Wei Seng — holds for 12h</p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">1 hour ago</p>
                                    </div>
                                    <span class="w-2 h-2 rounded-full bg-amber-500 shrink-0 mt-2"></span>
                                </div>

                                <!-- Notification 3 — Unread -->
                                <div class="notif-item px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer flex items-start gap-3" data-unread="true">
                                    <div class="w-8 h-8 rounded-xl bg-blue-100 dark:bg-blue-950/80 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100">Security Enclave Verified</p>
                                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">Device binding re-validated successfully</p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">Today, 9:00 AM</p>
                                    </div>
                                    <span class="w-2 h-2 rounded-full bg-blue-500 shrink-0 mt-2"></span>
                                </div>

                                <!-- Notification 4 — Read -->
                                <div class="notif-item px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer flex items-start gap-3 opacity-60" data-unread="false">
                                    <div class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="receipt" class="w-4 h-4"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">Bill Paid</p>
                                        <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5 truncate">Tenaga Nasional — RM 178.40 via JomPAY</p>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">Yesterday</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Dropdown Footer -->
                            <div class="px-4 py-2.5 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30">
                                <button type="button" class="w-full text-center text-[11px] font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 transition-colors cursor-pointer">
                                    View All Notifications
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- User Profile Dropdown & Mobile Drawer Trigger -->
                    <div class="relative" id="profile-menu-container">
                        <!-- Mobile / Tablet Drawer Button (Unified h-10 standard height) -->
                        <button
                            type="button"
                            onclick="window.toggleCustomerDrawer()"
                            class="md:hidden w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center font-black text-xs shadow-sm shadow-emerald-600/25 hover:scale-105 active:scale-95 transition-transform cursor-pointer ring-2 ring-emerald-500/20"
                            aria-label="Open navigation menu"
                            title="Open menu"
                        >
                            {{ $customerInitial }}
                        </button>

                        <!-- Desktop / Tablet Profile Trigger Button (Unified h-10 standard height) -->
                        <button
                            type="button"
                            id="profile-dropdown-btn"
                            onclick="window.toggleProfileDropdown()"
                            class="hidden md:flex items-center gap-2.5 pl-1.5 pr-3 h-10 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 bg-slate-100/60 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer shadow-2xs group"
                            aria-label="User profile menu"
                            aria-expanded="false"
                        >
                            <div class="w-7.5 h-7.5 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center font-black text-xs shadow-sm shadow-emerald-600/25 group-hover:scale-105 transition-transform shrink-0">
                                {{ $customerInitial }}
                            </div>
                            <div class="text-left leading-none">
                                <span class="block text-xs font-bold text-slate-800 dark:text-slate-100 truncate max-w-[120px] lg:max-w-[150px] xl:max-w-[170px]">{{ $customerName }}</span>
                                <span class="block text-[10px] text-emerald-600 dark:text-emerald-400 font-mono font-semibold mt-0.5 truncate max-w-[120px] lg:max-w-[150px]">&#64;{{ $customerUsername }}</span>
                            </div>
                            <i data-lucide="chevron-down" id="profile-chevron-icon" class="w-3.5 h-3.5 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200 transition-transform shrink-0"></i>
                        </button>

                        <!-- Desktop Profile Popover Dropdown -->
                        <div
                            id="profile-dropdown-menu"
                            class="hidden-dropdown absolute right-0 top-full mt-2 w-72 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-2xl shadow-slate-900/10 dark:shadow-slate-950/40 p-2 z-50 transition-all duration-200"
                        >
                            <!-- User Header Card -->
                            <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800/80 mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center font-black text-sm shadow-sm">
                                        {{ $customerInitial }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate">{{ $customerName }}</p>
                                        <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-mono font-semibold">&#64;{{ $customerUsername }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-2.5 pt-2 border-t border-slate-200/60 dark:border-slate-700/60 text-[10px]">
                                    <span class="text-slate-500 dark:text-slate-400">Security Tier</span>
                                    <span class="font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                                        <i data-lucide="shield-check" class="w-3 h-3"></i> Tier 3 (Hardware Enclave)
                                    </span>
                                </div>
                            </div>

                            <!-- Menu Links -->
                            <div class="space-y-0.5">
                                <a href="{{ route('customer.settings') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                    <i data-lucide="settings-2" class="w-4 h-4 text-slate-400"></i>
                                    Account Settings
                                </a>
                                <a href="{{ route('customer.statement') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                    <i data-lucide="file-text" class="w-4 h-4 text-slate-400"></i>
                                    e-Statements &amp; Tax
                                </a>
                                <a href="{{ route('customer.cards') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-400"></i>
                                    Manage Cards &amp; Limits
                                </a>
                            </div>

                            <!-- Security Circuit Breaker / Kill Switch Trigger -->
                            <div class="mt-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                                <button
                                    type="button"
                                    onclick="window.toggleProfileDropdown(); window.openModal('kill-switch-dialog')"
                                    class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors cursor-pointer text-left group"
                                >
                                    <span class="flex items-center gap-2.5">
                                        <i data-lucide="alert-octagon" class="w-4 h-4 text-rose-500 group-hover:scale-110 transition-transform"></i>
                                        Emergency Kill Switch
                                    </span>
                                    <span class="text-[9px] px-1.5 py-0.5 rounded bg-rose-100 dark:bg-rose-950/80 font-mono font-bold text-rose-700 dark:text-rose-300">SOS</span>
                                </button>
                            </div>

                            <!-- Sign Out -->
                            <div class="mt-1 pt-1 border-t border-slate-100 dark:border-slate-800">
                                <form method="POST" action="{{ route('customer.logout') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-rose-600 dark:hover:text-rose-400 transition-colors cursor-pointer"
                                    >
                                        <i data-lucide="log-out" class="w-4 h-4"></i>
                                        Sign Out Safely
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- Search Overlay (Command Palette Style) -->
    <div id="search-overlay" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div id="search-overlay-backdrop" onclick="window.toggleHeaderSearch()" class="fixed inset-0 bg-slate-900/50 dark:bg-slate-950/70 backdrop-blur-sm transition-opacity duration-200 opacity-0"></div>
        <div class="fixed inset-x-0 top-0 sm:top-20 flex justify-center px-4 sm:px-6">
            <div id="search-overlay-panel" class="w-full max-w-lg bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-2xl overflow-hidden transform -translate-y-4 opacity-0 transition-all duration-200">
                <!-- Search Input -->
                <div class="flex items-center gap-3 px-4 py-3.5 border-b border-slate-100 dark:border-slate-800">
                    <i data-lucide="search" class="w-5 h-5 text-slate-400 shrink-0"></i>
                    <input
                        type="text"
                        id="search-overlay-input"
                        placeholder="Search transactions, services, settings…"
                        class="flex-1 bg-transparent text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none"
                        autocomplete="off"
                    />
                    <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[10px] font-mono text-slate-400">ESC</kbd>
                </div>

                <!-- Quick Actions -->
                <div class="p-2">
                    <p class="px-2 py-1.5 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Quick Banking Services</p>
                    <a href="{{ route('customer.transfer') }}" onclick="window.toggleHeaderSearch();" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors cursor-pointer text-left group">
                        <div class="w-8 h-8 rounded-lg bg-pink-100 dark:bg-pink-950/60 text-pink-600 dark:text-pink-400 flex items-center justify-center">
                            <i data-lucide="send" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-800 dark:text-slate-200 group-hover:text-emerald-600 transition-colors">DuitNow Transfer</p>
                            <p class="text-[10px] text-slate-400">Send money instantly via proxy or account</p>
                        </div>
                    </a>
                    <a href="{{ route('customer.jompay') }}" onclick="window.toggleHeaderSearch();" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors cursor-pointer text-left group">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                            <i data-lucide="receipt" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-800 dark:text-slate-200 group-hover:text-emerald-600 transition-colors">JomPAY Bills</p>
                            <p class="text-[10px] text-slate-400">Pay TNB, Unifi, Astro & water bills</p>
                        </div>
                    </a>
                    <a href="{{ route('customer.qr-pay') }}" onclick="window.toggleHeaderSearch();" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors cursor-pointer text-left group">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                            <i data-lucide="qr-code" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-800 dark:text-slate-200 group-hover:text-emerald-600 transition-colors">DuitNow QR Pay</p>
                            <p class="text-[10px] text-slate-400">Scan & pay or receive funds via QR</p>
                        </div>
                    </a>
                    <a href="{{ route('customer.cards') }}" onclick="window.toggleHeaderSearch();" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors cursor-pointer text-left group">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                            <i data-lucide="credit-card" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-800 dark:text-slate-200 group-hover:text-emerald-600 transition-colors">Cards &amp; Limits</p>
                            <p class="text-[10px] text-slate-400">Freeze cards, adjust ATM &amp; POS daily limits</p>
                        </div>
                    </a>
                    <a href="{{ route('customer.statement') }}" onclick="window.toggleHeaderSearch();" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/60 transition-colors cursor-pointer text-left group">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-800 dark:text-slate-200 group-hover:text-emerald-600 transition-colors">e-Statement</p>
                            <p class="text-[10px] text-slate-400">Download official digitally signed PDF</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Slide Drawer -->
    <div
        id="customer-drawer"
        class="fixed inset-0 z-50 lg:hidden hidden"
        aria-modal="true"
        role="dialog"
    >
        <div
            id="customer-drawer-backdrop"
            onclick="window.toggleCustomerDrawer()"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 opacity-0"
        ></div>

        <div
            id="customer-drawer-panel"
            class="fixed inset-y-0 left-0 w-72 bg-white dark:bg-slate-900 shadow-2xl p-5 flex flex-col justify-between transform -translate-x-full transition-transform duration-300 ease-in-out border-r border-slate-200 dark:border-slate-800"
        >
            <div class="space-y-4">
                <!-- Drawer Header -->
                <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white font-bold text-xs shadow-xs">
                            <i data-lucide="landmark" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-sm text-slate-900 dark:text-slate-100">BankFlow Retail</span>
                    </div>
                    <button
                        type="button"
                        onclick="window.toggleCustomerDrawer()"
                        class="p-1.5 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer"
                    >
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- User Profile Card -->
                <div class="p-3.5 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-50/50 dark:from-emerald-950/40 dark:to-teal-950/20 border border-emerald-200/60 dark:border-emerald-900/40">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center font-bold text-sm shadow-sm shadow-emerald-600/20">
                            {{ $customerInitial }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate">{{ $customerName }}</p>
                            <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-mono">&#64;{{ $customerUsername }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 mt-2.5 pt-2.5 border-t border-emerald-200/40 dark:border-emerald-800/40">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[10px] font-semibold text-emerald-700 dark:text-emerald-300">eKYC Verified • Enclave Active</span>
                    </div>
                </div>

                <!-- Drawer Nav Links -->
                <div class="space-y-1">
                    <a
                        href="{{ route('customer.dashboard') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200/50 dark:border-emerald-800/40"
                    >
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        Dashboard
                    </a>
                    <a
                        href="{{ route('customer.transfer') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ $activeNav === 'transfer' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                    >
                        <i data-lucide="send" class="w-4 h-4"></i>
                        DuitNow Transfer
                    </a>
                    <a
                        href="{{ route('customer.jompay') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ $activeNav === 'jompay' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                    >
                        <i data-lucide="receipt" class="w-4 h-4"></i>
                        JomPAY Bills
                    </a>
                    <a
                        href="{{ route('customer.qr-pay') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ $activeNav === 'qr-pay' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                    >
                        <i data-lucide="qr-code" class="w-4 h-4"></i>
                        DuitNow QR Pay
                    </a>
                    <a
                        href="{{ route('customer.statement') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ $activeNav === 'statement' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                    >
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                        e-Statement
                    </a>
                    <a
                        href="{{ route('customer.history') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ $activeNav === 'history' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                    >
                        <i data-lucide="receipt" class="w-4 h-4"></i>
                        Transaction History
                    </a>
                    <a
                        href="{{ route('customer.cards') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ $activeNav === 'cards' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                    >
                        <i data-lucide="credit-card" class="w-4 h-4"></i>
                        Debit Cards &amp; Limits
                    </a>
                    <a
                        href="{{ route('customer.settings') }}"
                        onclick="window.toggleCustomerDrawer()"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ $activeNav === 'settings' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                    >
                        <i data-lucide="settings-2" class="w-4 h-4"></i>
                        Account Settings
                    </a>
                    <a
                        href="/"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-colors"
                    >
                        <i data-lucide="globe" class="w-4 h-4"></i>
                        Public Portal
                    </a>
                </div>

                <!-- Drawer Security Actions -->
                <div class="pt-3 border-t border-slate-200 dark:border-slate-800 space-y-1.5">
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider px-1 mb-1">Security</p>
                    <button
                        type="button"
                        onclick="window.toggleCustomerDrawer(); window.openModal('kill-switch-dialog')"
                        class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors text-left cursor-pointer"
                    >
                        <i data-lucide="alert-octagon" class="w-4 h-4"></i>
                        Emergency Kill Switch
                    </button>
                    <a
                        href="tel:997"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                    >
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        NSRC Hotline 997
                    </a>
                </div>
            </div>

            <!-- Drawer Bottom: Sign Out -->
            <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
                <form method="POST" action="{{ route('customer.logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 font-semibold text-xs border border-rose-200 dark:border-rose-900/60 hover:bg-rose-100 transition-colors cursor-pointer"
                    >
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Viewport Content with clean standard clearance for the floating navigation dock -->
    <div class="flex-1 w-full max-w-6xl mx-auto px-3.5 sm:px-6 lg:px-8 py-4 sm:py-7 pb-28 sm:pb-24 flex flex-col">
        <main class="flex-1 min-w-0">
            {{ $slot }}
        </main>
    </div>

    <!-- Standardized Floating Bottom Navigation Bar (Unified for Mobile, Tablet & Desktop) -->
    <nav aria-label="Quick Action Navigation" class="fixed bottom-0 sm:bottom-4 inset-x-0 z-40 px-2 sm:px-4 pointer-events-none flex justify-center pb-[env(safe-area-inset-bottom,0px)]">
        <div class="pointer-events-auto w-full max-w-sm sm:max-w-md bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/90 dark:border-slate-800 rounded-t-2xl sm:rounded-2xl px-3 sm:px-6 py-1.5 sm:py-2 shadow-xl shadow-slate-900/10">
            <div class="flex items-center justify-around">
                <!-- Home -->
                <a href="{{ route('customer.dashboard') }}" class="flex flex-col items-center gap-0.5 sm:gap-1 px-2 py-1 {{ $activeNav === 'dashboard' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-emerald-600' }} transition-colors">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] sm:text-[10px] font-semibold">Home</span>
                </a>

                <!-- Transfer -->
                <a
                    href="{{ route('customer.transfer') }}"
                    class="flex flex-col items-center gap-0.5 sm:gap-1 px-2 py-1 {{ $activeNav === 'transfer' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-emerald-600' }} transition-colors"
                >
                    <i data-lucide="send" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] sm:text-[10px] font-semibold">Transfer</span>
                </a>

                <!-- Centered QR Scan Hero Button -->
                <a
                    href="{{ route('customer.qr-pay') }}"
                    class="flex flex-col items-center gap-0.5 sm:gap-1 px-2 cursor-pointer group"
                    aria-label="DuitNow QR Scan"
                >
                    <div class="w-10 h-10 sm:w-12 sm:h-12 -mt-4 sm:-mt-5 rounded-full bg-gradient-to-tr from-emerald-600 via-emerald-500 to-teal-400 text-white flex items-center justify-center shadow-lg shadow-emerald-600/35 ring-4 ring-white dark:ring-slate-900 group-hover:scale-105 group-hover:shadow-xl group-hover:shadow-emerald-600/50 transition-all">
                        <i data-lucide="qr-code" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    </div>
                    <span class="text-[9px] sm:text-[10px] font-bold tracking-tight {{ $activeNav === 'qr-pay' ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-300' }}">QR Pay</span>
                </a>

                <!-- History -->
                <a href="{{ route('customer.history') }}" class="flex flex-col items-center gap-0.5 sm:gap-1 px-2 py-1 {{ $activeNav === 'history' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-emerald-600' }} transition-colors">
                    <i data-lucide="receipt" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] sm:text-[10px] font-semibold">History</span>
                </a>

                <!-- Settings -->
                <a href="{{ route('customer.settings') }}" class="flex flex-col items-center gap-0.5 sm:gap-1 px-2 py-1 {{ $activeNav === 'settings' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-emerald-600' }} transition-colors">
                    <i data-lucide="settings-2" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-[9px] sm:text-[10px] font-semibold">Settings</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Global Component-based Alert & Confirmation Dialog Container -->
    <div id="global-app-alert-dialog" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="global-dialog-title" role="alertdialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-all duration-300" onclick="window.closeAppDialog()"></div>

        <div class="flex min-h-full items-end justify-center p-0 text-center sm:items-center sm:p-4 sm:pb-8">
            <div class="modal-bottom-sheet relative w-full sm:max-w-md transform overflow-hidden rounded-t-[2.25rem] sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl text-left shadow-2xl shadow-slate-950/40 border border-slate-200/80 dark:border-slate-800 animate__animated animate__fadeInUp sm:animate__zoomIn animate__faster transition-all duration-300">
                <!-- Mobile pull indicator -->
                <div class="sm:hidden w-12 h-1.5 bg-slate-300 dark:bg-slate-700 rounded-full mx-auto mt-3.5 mb-1 cursor-pointer" onclick="window.closeAppDialog()"></div>

                <div class="p-6 sm:p-7 text-center">
                    <!-- Icon badge -->
                    <div id="global-dialog-icon-container" class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30 ring-8 ring-emerald-500/5 mb-4 shadow-xs">
                        <i id="global-dialog-icon" data-lucide="check-circle-2" class="w-8 h-8"></i>
                    </div>

                    <h3 id="global-dialog-title" class="text-lg sm:text-xl font-black text-slate-900 dark:text-slate-50 tracking-tight">
                        Notice
                    </h3>

                    <p id="global-dialog-subtitle" class="text-xs text-slate-400 dark:text-slate-500 font-medium mt-1 hidden"></p>

                    <div id="global-dialog-message" class="mt-3 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed max-w-sm mx-auto">
                    </div>

                    <!-- Action buttons -->
                    <div id="global-dialog-actions" class="mt-6 flex gap-2.5 sm:gap-3">
                        <button
                            type="button"
                            id="global-dialog-cancel-btn"
                            class="hidden w-full sm:w-1/2 py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 font-bold text-xs transition-all active:scale-[0.98] cursor-pointer"
                            onclick="window.closeAppDialog(false)"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            id="global-dialog-confirm-btn"
                            class="w-full sm:w-auto sm:min-w-[140px] mx-auto py-2.5 px-5 rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20"
                            onclick="window.closeAppDialog(true)"
                        >
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================================
         SCRIPTS: Greeting, Drawer, Notifications, Search, Keyboard Shortcuts
         ====================================================================== -->
    <script>
        // ─── Time-Based Greeting ───
        (function setGreeting() {
            const el = document.getElementById('greeting-text');
            if (!el) return;
            const h = new Date().getHours();
            if (h < 12) el.textContent = 'Good morning';
            else if (h < 17) el.textContent = 'Good afternoon';
            else el.textContent = 'Good evening';
        })();

        // ─── Mobile Drawer ───
        window.toggleCustomerDrawer = function() {
            const drawer = document.getElementById('customer-drawer');
            const backdrop = document.getElementById('customer-drawer-backdrop');
            const panel = document.getElementById('customer-drawer-panel');

            if (drawer.classList.contains('hidden')) {
                drawer.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    panel.classList.remove('-translate-x-full');
                    panel.classList.add('translate-x-0');
                }, 10);
            } else {
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                panel.classList.remove('translate-x-0');
                panel.classList.add('-translate-x-full');
                document.body.style.overflow = '';
                setTimeout(() => {
                    drawer.classList.add('hidden');
                }, 300);
            }
        };

        // ─── Notification Dropdown ───
        window.toggleNotifications = function() {
            const dropdown = document.getElementById('notif-dropdown');
            if (dropdown.classList.contains('hidden-dropdown')) {
                dropdown.classList.remove('hidden-dropdown');
                dropdown.classList.add('visible-dropdown');
            } else {
                dropdown.classList.remove('visible-dropdown');
                dropdown.classList.add('hidden-dropdown');
            }
        };

        window.markAllRead = function() {
            const badge = document.getElementById('notif-badge');
            if (badge) {
                badge.style.display = 'none';
            }
            document.querySelectorAll('.notif-item[data-unread="true"]').forEach(item => {
                item.setAttribute('data-unread', 'false');
                item.classList.add('opacity-60');
                const dot = item.querySelector('.rounded-full.bg-emerald-500, .rounded-full.bg-amber-500, .rounded-full.bg-blue-500');
                if (dot && dot.classList.contains('shrink-0') && dot.classList.contains('mt-2')) {
                    dot.style.display = 'none';
                }
            });
        };

        // Close notification dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const container = document.getElementById('notif-container');
            const dropdown = document.getElementById('notif-dropdown');
            if (container && dropdown && !container.contains(e.target)) {
                dropdown.classList.remove('visible-dropdown');
                dropdown.classList.add('hidden-dropdown');
            }
        });

        // ─── Profile Dropdown ───
        window.toggleProfileDropdown = function() {
            const menu = document.getElementById('profile-dropdown-menu');
            const chevron = document.getElementById('profile-chevron-icon');
            const btn = document.getElementById('profile-dropdown-btn');
            if (!menu) return;

            const isHidden = menu.classList.contains('hidden-dropdown');
            if (isHidden) {
                menu.classList.remove('hidden-dropdown');
                menu.classList.add('visible-dropdown');
                if (btn) btn.setAttribute('aria-expanded', 'true');
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            } else {
                menu.classList.remove('visible-dropdown');
                menu.classList.add('hidden-dropdown');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (chevron) chevron.style.transform = 'rotate(0deg)';
            }
        };

        // Close profile dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const container = document.getElementById('profile-menu-container');
            const menu = document.getElementById('profile-dropdown-menu');
            const chevron = document.getElementById('profile-chevron-icon');
            const btn = document.getElementById('profile-dropdown-btn');
            if (container && menu && !container.contains(e.target)) {
                menu.classList.remove('visible-dropdown');
                menu.classList.add('hidden-dropdown');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (chevron) chevron.style.transform = 'rotate(0deg)';
            }
        });

        // ─── Search Overlay (Command Palette) ───
        let searchOpen = false;
        window.toggleHeaderSearch = function() {
            const overlay = document.getElementById('search-overlay');
            const backdrop = document.getElementById('search-overlay-backdrop');
            const panel = document.getElementById('search-overlay-panel');
            const input = document.getElementById('search-overlay-input');

            if (!searchOpen) {
                searchOpen = true;
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    panel.classList.remove('-translate-y-4', 'opacity-0');
                    panel.classList.add('translate-y-0', 'opacity-100');
                    if (input) input.focus();
                }, 10);
            } else {
                searchOpen = false;
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                panel.classList.remove('translate-y-0', 'opacity-100');
                panel.classList.add('-translate-y-4', 'opacity-0');
                document.body.style.overflow = '';
                setTimeout(() => {
                    overlay.classList.add('hidden');
                    if (input) input.value = '';
                }, 200);
            }
        };

        // ─── Keyboard Shortcuts ───
        document.addEventListener('keydown', function(e) {
            // ⌘K / Ctrl+K → open search
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                window.toggleHeaderSearch();
            }
            // ESC → close search / notifications
            if (e.key === 'Escape') {
                if (searchOpen) {
                    window.toggleHeaderSearch();
                }
                const dropdown = document.getElementById('notif-dropdown');
                if (dropdown && dropdown.classList.contains('visible-dropdown')) {
                    window.toggleNotifications();
                }
            }
        });

        // ─── Global Component Alert, Popup & Confirmation API ───
        let dialogConfirmCallback = null;
        let dialogCancelCallback = null;

        window.showAppAlert = function(options) {
            if (typeof options === 'string') {
                options = { message: options };
            }
            const type = options.type || 'success'; // success, info, warning, danger, security
            const title = options.title || (type === 'danger' ? 'Attention' : (type === 'warning' ? 'Warning' : 'Notice'));
            const subtitle = options.subtitle || '';
            const confirmText = options.confirmText || 'Understood';
            const message = options.message || '';
            
            const dialog = document.getElementById('global-app-alert-dialog');
            const titleEl = document.getElementById('global-dialog-title');
            const subEl = document.getElementById('global-dialog-subtitle');
            const msgEl = document.getElementById('global-dialog-message');
            const iconContainer = document.getElementById('global-dialog-icon-container');
            const iconEl = document.getElementById('global-dialog-icon');
            const cancelBtn = document.getElementById('global-dialog-cancel-btn');
            const confirmBtn = document.getElementById('global-dialog-confirm-btn');

            if (!dialog) {
                alert(message);
                return;
            }

            titleEl.textContent = title;
            if (subtitle) {
                subEl.textContent = subtitle;
                subEl.classList.remove('hidden');
            } else {
                subEl.classList.add('hidden');
            }
            msgEl.innerHTML = message;

            // Icon & colors
            const styleMap = {
                success: {
                    icon: 'check-circle-2',
                    containerClass: 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/30 ring-emerald-500/5',
                    btnClass: 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20'
                },
                info: {
                    icon: 'info',
                    containerClass: 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/30 ring-blue-500/5',
                    btnClass: 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/20'
                },
                warning: {
                    icon: 'alert-triangle',
                    containerClass: 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/30 ring-amber-500/5',
                    btnClass: 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/20'
                },
                danger: {
                    icon: 'shield-alert',
                    containerClass: 'bg-rose-500/10 text-rose-600 dark:text-rose-400 border-rose-500/30 ring-rose-500/5',
                    btnClass: 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-600/20'
                },
                security: {
                    icon: 'fingerprint',
                    containerClass: 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-500/30 ring-purple-500/5',
                    btnClass: 'bg-purple-600 hover:bg-purple-700 text-white shadow-purple-600/20'
                }
            };
            const activeStyle = styleMap[type] || styleMap.info;

            iconContainer.className = 'mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border ring-8 mb-4 shadow-xs ' + activeStyle.containerClass;
            iconEl.setAttribute('data-lucide', activeStyle.icon);

            // Single button mode
            cancelBtn.classList.add('hidden');
            confirmBtn.className = 'w-full sm:w-auto sm:min-w-[140px] mx-auto py-2.5 px-5 rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer ' + activeStyle.btnClass;
            confirmBtn.textContent = confirmText;

            dialogConfirmCallback = options.onConfirm || null;
            dialogCancelCallback = null;

            dialog.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            if (window.lucide) window.lucide.createIcons();
        };

        window.showAppConfirm = function(options) {
            const type = options.type || 'warning';
            const title = options.title || 'Please Confirm';
            const subtitle = options.subtitle || '';
            const confirmText = options.confirmText || 'Confirm';
            const cancelText = options.cancelText || 'Cancel';
            const message = options.message || '';

            const dialog = document.getElementById('global-app-alert-dialog');
            const titleEl = document.getElementById('global-dialog-title');
            const subEl = document.getElementById('global-dialog-subtitle');
            const msgEl = document.getElementById('global-dialog-message');
            const iconContainer = document.getElementById('global-dialog-icon-container');
            const iconEl = document.getElementById('global-dialog-icon');
            const cancelBtn = document.getElementById('global-dialog-cancel-btn');
            const confirmBtn = document.getElementById('global-dialog-confirm-btn');

            if (!dialog) {
                if (confirm(message)) { if (options.onConfirm) options.onConfirm(); }
                return;
            }

            titleEl.textContent = title;
            if (subtitle) {
                subEl.textContent = subtitle;
                subEl.classList.remove('hidden');
            } else {
                subEl.classList.add('hidden');
            }
            msgEl.innerHTML = message;

            const styleMap = {
                success: { icon: 'check-circle-2', container: 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/30 ring-emerald-500/5', btn: 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20' },
                info:    { icon: 'info',           container: 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/30 ring-blue-500/5',       btn: 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/20' },
                warning: { icon: 'alert-triangle', container: 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/30 ring-amber-500/5', btn: 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/20' },
                danger:  { icon: 'shield-alert',   container: 'bg-rose-500/10 text-rose-600 dark:text-rose-400 border-rose-500/30 ring-rose-500/5',       btn: 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-600/20' },
                security:{ icon: 'fingerprint',    container: 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-500/30 ring-purple-500/5', btn: 'bg-purple-600 hover:bg-purple-700 text-white shadow-purple-600/20' }
            };
            const activeStyle = styleMap[type] || styleMap.warning;

            iconContainer.className = 'mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border ring-8 mb-4 shadow-xs ' + activeStyle.container;
            iconEl.setAttribute('data-lucide', activeStyle.icon);

            // Double button mode
            cancelBtn.classList.remove('hidden');
            cancelBtn.textContent = cancelText;
            confirmBtn.className = 'w-full sm:w-1/2 py-2.5 px-4 rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer ' + activeStyle.btn;
            confirmBtn.textContent = confirmText;

            dialogConfirmCallback = options.onConfirm || null;
            dialogCancelCallback = options.onCancel || null;

            dialog.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            if (window.lucide) window.lucide.createIcons();
        };

        window.closeAppDialog = function(isConfirmed) {
            const dialog = document.getElementById('global-app-alert-dialog');
            if (dialog) dialog.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');

            if (isConfirmed === true && typeof dialogConfirmCallback === 'function') {
                const cb = dialogConfirmCallback;
                dialogConfirmCallback = null;
                cb();
            } else if (isConfirmed === false && typeof dialogCancelCallback === 'function') {
                const cb = dialogCancelCallback;
                dialogCancelCallback = null;
                cb();
            }
        };

        // ─── Lucide Icons Init ───
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
