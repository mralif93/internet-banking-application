@php
$customer = Auth::guard('customer')->user() ?? (object)[
    'name'             => 'Ahmad Daniel Bin Alif',
    'username'         => 'daniel_alif',
    'account_number'   => '1640 1234 5678',
    'account_balance'  => 24850.50,
    'account_type'     => 'Savings Account-i',
    'bound_device_name'=> 'iPhone 16 Pro',
    'phone_number'     => '+60 12-345 6789',
];
@endphp

<x-layout.customer title="Account Settings — BankFlow MY" activeNav="settings">

<style>
/* Smooth accordion slide */
.acc-body { overflow: hidden; transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease; }
.acc-body.acc-closed { max-height: 0 !important; opacity: 0; }
.acc-body.acc-open   { opacity: 1; }

/* Inline field note accordion */
.field-note-drawer {
    display: grid;
    grid-template-rows: 0fr;
    opacity: 0;
    transition: grid-template-rows 0.28s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease, margin 0.2s ease;
}
.field-note-drawer.is-open {
    grid-template-rows: 1fr;
    opacity: 1;
}
.field-note-drawer > .drawer-inner {
    overflow: hidden;
}

/* Toggle switch */
.toggle-track { transition: background-color 0.2s ease; }
.toggle-thumb { transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
</style>

    <div class="space-y-6 sm:space-y-8">

        <!-- STANDARD PAGE HEADER (Matching Dashboard Style) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Security &amp; Profile
                        </span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">
                            Customer Portal
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        Account Settings &amp; Security
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">Biometric &amp; Device Pairing</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            Hardware Enclave Bound
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0">
                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all active:scale-[0.98] shadow-2xs group"
                    >
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-slate-500"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- ── Profile Hero — Compact Mobile-First ── --}}
        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 border border-slate-700/50 shadow-lg animate__animated animate__fadeInUp animate__faster">
            {{-- Background dot grid --}}
            <div class="absolute inset-0 opacity-[0.035] pointer-events-none" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 20px 20px;"></div>
            {{-- Glow blobs --}}
            <div class="absolute -top-10 -right-10 w-36 h-36 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-6 -left-6 w-28 h-28 rounded-full bg-teal-500/10 blur-2xl pointer-events-none"></div>

            {{-- Main profile row --}}
            <div class="relative flex items-start gap-3.5 p-4 sm:p-5">
                {{-- Avatar --}}
                <div class="relative shrink-0">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-600 via-emerald-500 to-teal-400 flex items-center justify-center text-white font-black text-xl shadow-md shadow-emerald-500/30 select-none ring-2 ring-white/10">
                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-500 border-2 border-slate-900 flex items-center justify-center">
                        <i data-lucide="check" class="w-3 h-3 text-white stroke-[3]"></i>
                    </div>
                </div>

                {{-- Info stack --}}
                <div class="flex-1 min-w-0 pt-0.5">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <h2 class="text-base font-black text-white tracking-tight leading-tight truncate">{{ $customer->name }}</h2>
                            <p class="text-xs text-slate-400 mt-0.5">&#64;{{ $customer->username }}</p>
                        </div>
                        <span class="px-2 py-0.5 rounded-md text-xs font-black bg-amber-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-wider shrink-0 mt-0.5">Gold</span>
                    </div>
                    {{-- Contact chips --}}
                    <div class="flex flex-col gap-1 mt-2">
                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                            <i data-lucide="smartphone" class="w-3.5 h-3.5 text-emerald-400 shrink-0"></i>
                            <span class="truncate">{{ $customer->phone_number }}</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-400 shrink-0"></i>
                            <span class="truncate">{{ $customer->bound_device_name }} &bull; Enclave</span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Stats strip --}}
            <div class="relative border-t border-white/8 grid grid-cols-3">
                <div class="text-center py-3 px-2">
                    <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Since</p>
                    <p class="text-xs font-black text-white mt-0.5">Jan 2022</p>
                </div>
                <div class="text-center py-3 px-2 border-x border-white/8">
                    <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Points</p>
                    <p class="text-xs font-black text-amber-400 mt-0.5">4,820</p>
                </div>
                <div class="text-center py-3 px-2">
                    <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Security</p>
                    <p class="text-xs font-black text-emerald-400 mt-0.5">98/100</p>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════
             ACCORDION SETTINGS CARD
        ══════════════════════════════════════ --}}
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-lg shadow-slate-950/5 overflow-hidden divide-y divide-slate-100 dark:divide-slate-800 animate__animated animate__fadeInUp animate__faster">

            {{-- ─── SECTION 1: PROFILE & IDENTITY ─── --}}
            <div id="settings-sec-1">
                <button type="button" onclick="window.toggleSection(1)"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-left hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i data-lucide="user-circle-2" class="w-4.5 h-4.5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">Profile &amp; Identity</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Name, username, contact</p>
                        </div>
                    </div>
                    <div id="chev-1" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300 rotate-180 shrink-0">
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                    </div>
                </button>

                <div id="body-1" class="acc-body acc-open bg-slate-50/50 dark:bg-slate-800/20">
                    <div class="p-4 sm:p-5 space-y-4">
                        {{-- Full Name --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5">
                                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300 font-sans tracking-tight">Full Name</label>
                                    <button type="button" id="btn-note-fullname" onclick="window.toggleFieldNote('fullname')" 
                                            class="field-note-btn w-5 h-5 rounded-full text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 inline-flex items-center justify-center transition-all cursor-pointer hover:bg-emerald-50 dark:hover:bg-emerald-950/40"
                                            title="Click for legal information" aria-expanded="false">
                                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                                <span class="text-[11px] font-bold text-slate-400 bg-slate-200/80 dark:bg-slate-700/80 px-2 py-0.5 rounded-md">MyKad Locked</span>
                            </div>
                            <input type="text" value="{{ $customer->name }}" readonly
                                   class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/80 text-slate-500 cursor-not-allowed font-sans shadow-2xs" />

                            {{-- Inline Interactive Note Drawer --}}
                            <div id="drawer-note-fullname" class="field-note-drawer">
                                <div class="drawer-inner pt-2">
                                    <div class="p-3 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-500/20 text-xs font-sans text-slate-700 dark:text-slate-200 space-y-1 relative">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1.5 font-bold text-emerald-800 dark:text-emerald-300">
                                                <i data-lucide="user-check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0"></i>
                                                <span>National Registration (JPN)</span>
                                            </div>
                                            <button type="button" onclick="window.toggleFieldNote('fullname')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-0.5 rounded-md">
                                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>
                                        <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed">
                                            Official legal name registered with National Registration Department (JPN). Modifications require an in-person branch verification with statutory proof documents.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Username / Banking ID (Permanent & Locked) --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5">
                                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300 font-sans tracking-tight">Username / Banking ID</label>
                                    <button type="button" id="btn-note-username" onclick="window.toggleFieldNote('username')" 
                                            class="field-note-btn w-5 h-5 rounded-full text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 inline-flex items-center justify-center transition-all cursor-pointer hover:bg-emerald-50 dark:hover:bg-emerald-950/40"
                                            title="Click for banking ID guidelines" aria-expanded="false">
                                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                                <span class="text-[11px] font-bold text-slate-400 bg-slate-200/80 dark:bg-slate-700/80 px-2 py-0.5 rounded-md">Permanent ID</span>
                            </div>
                            <input type="text" id="profile-username" value="{{ $customer->username }}" readonly
                                   class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/80 text-slate-500 cursor-not-allowed font-sans shadow-2xs" />

                            {{-- Inline Interactive Note Drawer --}}
                            <div id="drawer-note-username" class="field-note-drawer">
                                <div class="drawer-inner pt-2">
                                    <div class="p-3 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-500/20 text-xs font-sans text-slate-700 dark:text-slate-200 space-y-1 relative">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1.5 font-bold text-emerald-800 dark:text-emerald-300">
                                                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0"></i>
                                                <span>BNM Identity Guidelines</span>
                                            </div>
                                            <button type="button" onclick="window.toggleFieldNote('username')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-0.5 rounded-md">
                                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>
                                        <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed">
                                            Banking ID is permanently assigned upon account onboarding and cannot be modified online per Bank Negara Malaysia (BNM) digital identity guidelines.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Phone (High Security / Protected update) --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5">
                                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300 font-sans tracking-tight">Registered Mobile Number</label>
                                    <button type="button" id="btn-note-phone" onclick="window.toggleFieldNote('phone')" 
                                            class="field-note-btn w-5 h-5 rounded-full text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 inline-flex items-center justify-center transition-all cursor-pointer hover:bg-amber-50 dark:hover:bg-amber-950/40"
                                            title="Click for security cooling-off policy" aria-expanded="false">
                                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                                <span class="text-[11px] font-bold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-500/20 px-2 py-0.5 rounded-md">OTP / TAC Active</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="relative flex-1 min-w-0">
                                    <input type="tel" id="profile-phone" value="{{ $customer->phone_number }}" readonly
                                           class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 font-sans shadow-2xs cursor-not-allowed" />
                                </div>
                                <button type="button" onclick="window.openUpdatePhoneModal()"
                                        class="px-3.5 py-2.5 sm:py-3 rounded-2xl border border-slate-300/90 dark:border-slate-700 hover:border-emerald-500 text-xs font-bold text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 bg-white dark:bg-slate-900 transition-all cursor-pointer shrink-0 shadow-2xs active:scale-95 font-sans">
                                    Update
                                </button>
                            </div>

                            {{-- Inline Interactive Note Drawer --}}
                            <div id="drawer-note-phone" class="field-note-drawer">
                                <div class="drawer-inner pt-2">
                                    <div class="p-3 rounded-2xl bg-amber-50/70 dark:bg-amber-950/30 border border-amber-500/20 text-xs font-sans text-slate-700 dark:text-slate-200 space-y-1 relative">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1.5 font-bold text-amber-800 dark:text-amber-300">
                                                <i data-lucide="shield-alert" class="w-3.5 h-3.5 text-amber-600 dark:text-amber-400 shrink-0"></i>
                                                <span>High Security Credential (24h Cooling-Off)</span>
                                            </div>
                                            <button type="button" onclick="window.toggleFieldNote('phone')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-0.5 rounded-md">
                                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>
                                        <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed">
                                            Receives SMS TAC/OTP and pairs hardware enclave keys. Per BNM RMIT standards, updating this number enforces a mandatory 24-hour cooling-off transaction security lock.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Email Address (Editable by User) --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5">
                                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300 font-sans tracking-tight">Email Address</label>
                                    <button type="button" id="btn-note-email" onclick="window.toggleFieldNote('email')" 
                                            class="field-note-btn w-5 h-5 rounded-full text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 inline-flex items-center justify-center transition-all cursor-pointer hover:bg-emerald-50 dark:hover:bg-emerald-950/40"
                                            title="Click for email usage details" aria-expanded="false">
                                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                                <span class="text-[11px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">Editable</span>
                            </div>
                            <input type="email" id="profile-email" value="a.daniel@example.com"
                                   class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all" />

                            {{-- Inline Interactive Note Drawer --}}
                            <div id="drawer-note-email" class="field-note-drawer">
                                <div class="drawer-inner pt-2">
                                    <div class="p-3 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-500/20 text-xs font-sans text-slate-700 dark:text-slate-200 space-y-1 relative">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1.5 font-bold text-emerald-800 dark:text-emerald-300">
                                                <i data-lucide="mail-check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0"></i>
                                                <span>Official Statements &amp; Audit Notices</span>
                                            </div>
                                            <button type="button" onclick="window.toggleFieldNote('email')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-0.5 rounded-md">
                                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>
                                        <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed">
                                            Used for monthly e-Statements, DuitNow transfer receipts, transaction audit logs, and security alerts. Can be edited directly with instant confirmation.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- NRIC (Strictly Locked) --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5">
                                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300 font-sans tracking-tight">MyKad NRIC</label>
                                    <button type="button" id="btn-note-nric" onclick="window.toggleFieldNote('nric')" 
                                            class="field-note-btn w-5 h-5 rounded-full text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 inline-flex items-center justify-center transition-all cursor-pointer hover:bg-emerald-50 dark:hover:bg-emerald-950/40"
                                            title="Click for identity verification details" aria-expanded="false">
                                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                                <span class="text-[11px] font-bold text-slate-400 bg-slate-200/80 dark:bg-slate-700/80 px-2 py-0.5 rounded-md">Permanent Identity</span>
                            </div>
                            <input type="text" value="930412-14-••••" readonly
                                   class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/80 text-slate-500 cursor-not-allowed font-sans shadow-2xs" />

                            {{-- Inline Interactive Note Drawer --}}
                            <div id="drawer-note-nric" class="field-note-drawer">
                                <div class="drawer-inner pt-2">
                                    <div class="p-3 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-500/20 text-xs font-sans text-slate-700 dark:text-slate-200 space-y-1 relative">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1.5 font-bold text-emerald-800 dark:text-emerald-300">
                                                <i data-lucide="fingerprint" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0"></i>
                                                <span>e-KYC Biometric Verification</span>
                                            </div>
                                            <button type="button" onclick="window.toggleFieldNote('nric')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-0.5 rounded-md">
                                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>
                                        <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed">
                                            National Registration Identity Card (MyKad) verified during biometric e-KYC onboarding. Partially masked for personal data privacy compliance.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="window.saveCustomerProfile()"
                                class="w-full py-3 sm:py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.98] shadow-xs shadow-emerald-600/20 mt-2 font-sans">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Save Profile Changes</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 2: SECURITY ─── --}}
            <div id="settings-sec-2">
                <button type="button" onclick="window.toggleSection(2)"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-left hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i data-lucide="shield-check" class="w-4.5 h-4.5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">Security &amp; Auth</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">PIN, password, biometrics</p>
                        </div>
                    </div>
                    <div id="chev-2" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300 shrink-0">
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                    </div>
                </button>

                <div id="body-2" class="acc-body acc-closed bg-slate-50/50 dark:bg-slate-800/20">
                    <div class="px-4 pt-3 pb-4 space-y-3">
                        {{-- Bound device chip --}}
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/60">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 flex items-center justify-center shrink-0">
                                <i data-lucide="fingerprint" class="w-4 h-4"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-1.5">
                                    <p class="text-xs font-black text-slate-900 dark:text-slate-100 truncate">{{ $customer->bound_device_name }}</p>
                                    <span class="px-1.5 py-0.5 rounded text-xs font-black bg-emerald-500 text-white uppercase shrink-0">Active</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5 truncate">ECDSA P-256 Hardware Enclave</p>
                            </div>
                            <button type="button" onclick="window.showAppConfirm({ title: 'Remove Bound Device?', subtitle: 'Hardware Enclave Security', message: 'Unbinding this trusted hardware enclave requires in-person branch verification with your physical MyKad per BNM security guidelines.', type: 'warning', confirmText: 'Locate Nearest Branch', cancelText: 'Keep Device', onConfirm: function() { window.open('https://www.google.com/maps/search/bank+islamic+branch', '_blank'); } })" class="text-xs font-bold text-rose-500 shrink-0 cursor-pointer">Remove</button>
                        </div>

                        {{-- Action rows --}}
                        <div class="rounded-xl border border-slate-200 dark:border-slate-700/80 overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <i data-lucide="key-round" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100 leading-tight">Password</p>
                                        <p class="text-xs text-slate-400">Changed 45 days ago</p>
                                    </div>
                                </div>
                                <button type="button" onclick="window.openChangePassword()" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer active:scale-95">Change</button>
                            </div>
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <i data-lucide="hash" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100 leading-tight">Transaction PIN</p>
                                        <p class="text-xs text-slate-400">6-digit authorization code</p>
                                    </div>
                                </div>
                                <button type="button" onclick="window.openChangePin()" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer active:scale-95">Change</button>
                            </div>
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <i data-lucide="scan-face" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100 leading-tight">Face ID / Biometrics</p>
                                        <p class="text-xs text-slate-400">Enabled on {{ $customer->bound_device_name }}</p>
                                    </div>
                                </div>
                                <button type="button" role="switch" aria-checked="true" id="toggle-biometric"
                                        onclick="window.toggleSwitch('toggle-biometric')"
                                        class="toggle-track w-10 h-5.5 rounded-full bg-emerald-500 relative cursor-pointer focus:outline-none shrink-0">
                                    <span class="toggle-thumb absolute left-0.5 top-0.5 w-4.5 h-4.5 rounded-full bg-white shadow translate-x-5"></span>
                                </button>
                            </div>
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <i data-lucide="monitor-smartphone" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100 leading-tight">Active Sessions</p>
                                        <p class="text-xs text-slate-400">2 active devices</p>
                                    </div>
                                </div>
                                <button type="button" onclick="window.showAppConfirm({ title: 'Sign Out All Other Sessions?', subtitle: 'Session Invalidation', message: 'This will instantly invalidate session tokens across all other mobile and browser devices except your current session.', type: 'danger', confirmText: 'Sign Out All Others', cancelText: 'Cancel', onConfirm: function() { window.showAppAlert({ title: 'Sessions Terminated', message: 'All other active device sessions have been successfully logged out.', type: 'success' }); } })" class="px-3 py-1.5 rounded-lg bg-rose-50 dark:bg-rose-950/40 text-xs font-bold text-rose-600 dark:text-rose-400 cursor-pointer active:scale-95">Sign Out All</button>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5 p-3 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 text-xs text-amber-800 dark:text-amber-300">
                            <i data-lucide="alert-triangle" class="w-4 h-4 shrink-0 text-amber-600 mt-0.5"></i>
                            <p class="leading-relaxed">Changes trigger a <strong>12-hour cooling-off</strong> per BNM RMIT. Transfers will be restricted.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 3: NOTIFICATIONS ─── --}}
            <div id="settings-sec-3">
                <button type="button" onclick="window.toggleSection(3)"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-left hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i data-lucide="bell" class="w-4.5 h-4.5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">Notifications</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Alerts, push, SMS</p>
                        </div>
                    </div>
                    <div id="chev-3" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300 shrink-0">
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                    </div>
                </button>

                <div id="body-3" class="acc-body acc-closed bg-slate-50/50 dark:bg-slate-800/20">
                    <div class="px-4 pt-3 pb-4 space-y-3">
                        <div class="rounded-xl border border-slate-200 dark:border-slate-700/80 overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach([
                                ['id'=>'notif-push',   'icon'=>'smartphone',   'label'=>'Push Notifications',      'sub'=>'Transaction alerts on device',        'on'=>true],
                                ['id'=>'notif-sms',    'icon'=>'message-square','label'=>'SMS TAC / OTP',           'sub'=>'One-time authorization codes',         'on'=>true],
                                ['id'=>'notif-email',  'icon'=>'mail',          'label'=>'Email Receipts',          'sub'=>'a.daniel@example.com',                'on'=>true],
                                ['id'=>'notif-lowbal', 'icon'=>'trending-down', 'label'=>'Low Balance Alert',       'sub'=>'Below set threshold',                 'on'=>true],
                                ['id'=>'notif-promo',  'icon'=>'tag',           'label'=>'Promotions &amp; Rewards','sub'=>'Gold member offers &amp; cashback',   'on'=>false],
                            ] as $item)
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-slate-900 dark:text-slate-100 leading-tight">{!! $item['label'] !!}</p>
                                        <p class="text-xs text-slate-400 truncate">{!! $item['sub'] !!}</p>
                                    </div>
                                </div>
                                <button type="button" role="switch" aria-checked="{{ $item['on'] ? 'true' : 'false' }}"
                                        id="{{ $item['id'] }}" onclick="window.toggleSwitch('{{ $item['id'] }}')"
                                        class="toggle-track w-10 h-5.5 rounded-full {{ $item['on'] ? 'bg-emerald-500' : 'bg-slate-200 dark:bg-slate-700' }} relative cursor-pointer focus:outline-none shrink-0 ml-2">
                                    <span class="toggle-thumb absolute left-0.5 top-0.5 w-4.5 h-4.5 rounded-full bg-white shadow {{ $item['on'] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                </button>
                            </div>
                            @endforeach
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Low Balance Threshold</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-400">RM</span>
                                <input type="number" value="500" min="50"
                                       class="w-full py-2.5 sm:py-3 pl-12 pr-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all" />
                            </div>
                        </div>

                        <button type="button" onclick="window.showAppAlert({ title: 'Preferences Saved', subtitle: 'Push, SMS & Channels', message: 'Your notification routing preferences and threshold alerts have been successfully updated.', type: 'success' })"
                                class="w-full py-3 sm:py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.98] shadow-xs shadow-emerald-600/20 font-sans mt-2">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Save Preferences</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 4: PREFERENCES ─── --}}
            <div id="settings-sec-4">
                <button type="button" onclick="window.toggleSection(4)"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-left hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i data-lucide="sliders-horizontal" class="w-4.5 h-4.5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">Preferences</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Theme, language, defaults</p>
                        </div>
                    </div>
                    <div id="chev-4" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300 shrink-0">
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                    </div>
                </button>

                <div id="body-4" class="acc-body acc-closed bg-slate-50/50 dark:bg-slate-800/20">
                    <div class="px-4 pt-3 pb-4 space-y-3">
                        {{-- Theme Picker --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 font-sans tracking-tight">Display Theme</label>
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" id="theme-btn-light" onclick="window.selectTheme('light')"
                                        class="p-2.5 rounded-2xl border-2 border-slate-200 dark:border-slate-700 hover:border-emerald-300 transition-all cursor-pointer text-center group">
                                    <div class="w-7 h-7 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 flex items-center justify-center mx-auto mb-1.5 group-hover:scale-110 transition-transform">
                                        <i data-lucide="sun" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700 dark:text-slate-300 font-sans">Light</p>
                                </button>
                                <button type="button" id="theme-btn-dark" onclick="window.selectTheme('dark')"
                                        class="p-2.5 rounded-2xl border-2 border-slate-200 dark:border-slate-700 hover:border-emerald-300 transition-all cursor-pointer text-center group">
                                    <div class="w-7 h-7 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 flex items-center justify-center mx-auto mb-1.5 group-hover:scale-110 transition-transform">
                                        <i data-lucide="moon" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700 dark:text-slate-300 font-sans">Dark</p>
                                </button>
                                <button type="button" id="theme-btn-system" onclick="window.selectTheme('system')"
                                        class="p-2.5 rounded-2xl border-2 border-emerald-500 bg-emerald-50 dark:bg-emerald-950/30 transition-all cursor-pointer text-center group">
                                    <div class="w-7 h-7 rounded-xl bg-emerald-500 text-white flex items-center justify-center mx-auto mb-1.5 group-hover:scale-110 transition-transform">
                                        <i data-lucide="monitor" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <p class="text-xs font-bold text-emerald-700 dark:text-emerald-300 font-sans">System</p>
                                </button>
                            </div>
                        </div>

                        {{-- Primary & Accent Color Palette Selector --}}
                        <div class="pt-1">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 font-sans tracking-tight">
                                    Primary Color Palette
                                </label>
                                <span id="current-color-theme-label" class="text-xs font-bold px-2 py-0.5 rounded-md bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20 font-sans">
                                    Emerald (Default)
                                </span>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-2" id="color-theme-picker-group">
                                <!-- Emerald Green -->
                                <button type="button" id="color-btn-emerald" onclick="window.selectColorTheme('emerald')"
                                        class="color-theme-btn p-2.5 rounded-2xl border-2 border-emerald-500 bg-emerald-50/70 dark:bg-emerald-950/30 transition-all cursor-pointer text-left relative group">
                                    <div class="flex items-center gap-2">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-400 shadow-xs ring-2 ring-white dark:ring-slate-900 shrink-0"></div>
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate font-sans">Emerald</p>
                                            <p class="text-xs text-slate-400 font-medium truncate font-sans">Bank Islamic</p>
                                        </div>
                                    </div>
                                    <span class="color-check absolute top-2 right-2 w-4 h-4 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-2xs">
                                        <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                    </span>
                                </button>

                                <!-- Sapphire Blue -->
                                <button type="button" id="color-btn-blue" onclick="window.selectColorTheme('blue')"
                                        class="color-theme-btn p-2.5 rounded-2xl border-2 border-slate-200 dark:border-slate-700 hover:border-blue-300 transition-all cursor-pointer text-left relative group">
                                    <div class="flex items-center gap-2">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-tr from-blue-600 to-sky-400 shadow-xs ring-2 ring-white dark:ring-slate-900 shrink-0"></div>
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate font-sans">Sapphire</p>
                                            <p class="text-xs text-slate-400 font-medium truncate font-sans">Royal Blue</p>
                                        </div>
                                    </div>
                                    <span class="color-check hidden absolute top-2 right-2 w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-2xs">
                                        <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                    </span>
                                </button>

                                <!-- Royal Purple / Violet -->
                                <button type="button" id="color-btn-purple" onclick="window.selectColorTheme('purple')"
                                        class="color-theme-btn p-2.5 rounded-2xl border-2 border-slate-200 dark:border-slate-700 hover:border-purple-300 transition-all cursor-pointer text-left relative group">
                                    <div class="flex items-center gap-2">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-tr from-purple-600 to-indigo-400 shadow-xs ring-2 ring-white dark:ring-slate-900 shrink-0"></div>
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate font-sans">Violet</p>
                                            <p class="text-xs text-slate-400 font-medium truncate font-sans">Prestige</p>
                                        </div>
                                    </div>
                                    <span class="color-check hidden absolute top-2 right-2 w-4 h-4 rounded-full bg-purple-600 text-white flex items-center justify-center shadow-2xs">
                                        <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                    </span>
                                </button>

                                <!-- Amber / Gold -->
                                <button type="button" id="color-btn-amber" onclick="window.selectColorTheme('amber')"
                                        class="color-theme-btn p-2.5 rounded-2xl border-2 border-slate-200 dark:border-slate-700 hover:border-amber-300 transition-all cursor-pointer text-left relative group">
                                    <div class="flex items-center gap-2">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-tr from-amber-600 to-yellow-400 shadow-xs ring-2 ring-white dark:ring-slate-900 shrink-0"></div>
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate font-sans">Amber</p>
                                            <p class="text-xs text-slate-400 font-medium truncate font-sans">Gold Bullion</p>
                                        </div>
                                    </div>
                                    <span class="color-check hidden absolute top-2 right-2 w-4 h-4 rounded-full bg-amber-600 text-white flex items-center justify-center shadow-2xs">
                                        <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                    </span>
                                </button>

                                <!-- Ruby / Rose -->
                                <button type="button" id="color-btn-rose" onclick="window.selectColorTheme('rose')"
                                        class="color-theme-btn p-2.5 rounded-2xl border-2 border-slate-200 dark:border-slate-700 hover:border-rose-300 transition-all cursor-pointer text-left relative group">
                                    <div class="flex items-center gap-2">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-tr from-rose-600 to-pink-400 shadow-xs ring-2 ring-white dark:ring-slate-900 shrink-0"></div>
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate font-sans">Rose</p>
                                            <p class="text-xs text-slate-400 font-medium truncate font-sans">Ruby Elite</p>
                                        </div>
                                    </div>
                                    <span class="color-check hidden absolute top-2 right-2 w-4 h-4 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-2xs">
                                        <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Language</label>
                            <select class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all">
                                <option value="en" selected>English</option>
                                <option value="ms">Bahasa Malaysia</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Default Account</label>
                            <select class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all">
                                <option value="savings" selected>Savings Account-i (•••• 5678)</option>
                                <option value="current">Current Account-i (•••• 9901)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Transaction History</label>
                            <select class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all">
                                <option value="30">Last 30 days</option>
                                <option value="60" selected>Last 60 days</option>
                                <option value="90">Last 90 days</option>
                                <option value="180">Last 6 months</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                            <div>
                                <p class="text-xs font-bold text-slate-900 dark:text-slate-100 font-sans">Daily Transfer Limit</p>
                                <p class="text-xs text-slate-400 mt-0.5 font-sans">Branch visit required to change</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-slate-900 dark:text-slate-100 font-sans">RM 30,000</p>
                                <span class="text-[11px] font-bold text-slate-400 bg-slate-200 dark:bg-slate-700 px-2 py-0.5 rounded-md font-sans">BNM Max</span>
                            </div>
                        </div>
                        <button type="button" onclick="window.showAppAlert({ title: 'Preferences Saved', subtitle: 'Display & Banking Defaults', message: 'Your interface, language, and default account preferences have been saved successfully.', type: 'success' })"
                                class="w-full py-3 sm:py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.98] shadow-xs shadow-emerald-600/20 font-sans mt-2">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Save Preferences</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 5: PRIVACY & DATA ─── --}}
            <div id="settings-sec-5">
                <button type="button" onclick="window.toggleSection(5)"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-left hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i data-lucide="lock" class="w-4.5 h-4.5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">Privacy &amp; Data</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Export, consent, account closure</p>
                        </div>
                    </div>
                    <div id="chev-5" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 transition-transform duration-300 shrink-0">
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                    </div>
                </button>

                <div id="body-5" class="acc-body acc-closed bg-slate-50/50 dark:bg-slate-800/20">
                    <div class="px-4 pt-3 pb-4 space-y-3">
                        <div class="rounded-xl border border-slate-200 dark:border-slate-700/80 overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5 min-w-0"><i data-lucide="file-down" class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0"></i><div class="min-w-0"><p class="text-xs font-bold text-slate-900 dark:text-slate-100">Download My Data</p><p class="text-xs text-slate-400 truncate">All transactions &amp; account data</p></div></div>
                                <button type="button" onclick="window.showAppAlert({ title: 'Export Initiated', subtitle: 'Data Portability (PDPA)', message: 'Your full transaction history and account profile data package is being prepared and will be delivered to your registered email within 24 hours.', type: 'primary' })" class="ml-2 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:border-emerald-300 cursor-pointer active:scale-95 shrink-0 transition-colors">Export</button>
                            </div>
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5 min-w-0"><i data-lucide="share-2" class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0"></i><div class="min-w-0"><p class="text-xs font-bold text-slate-900 dark:text-slate-100">Open Banking Access</p><p class="text-xs text-slate-400 truncate">Third-party API tokens</p></div></div>
                                <button type="button" onclick="window.showAppAlert({ title: 'Open Banking Consent', subtitle: 'BNM Open API Framework', message: 'Consent manager is currently synchronizing with approved FinTech third-party API providers.', type: 'primary' })" class="ml-2 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:border-emerald-300 cursor-pointer active:scale-95 shrink-0 transition-colors">Manage</button>
                            </div>
                            <div class="flex items-center justify-between px-3.5 py-3">
                                <div class="flex items-center gap-2.5 min-w-0"><i data-lucide="file-text" class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0"></i><div class="min-w-0"><p class="text-xs font-bold text-slate-900 dark:text-slate-100">Privacy Policy</p><p class="text-xs text-slate-400 truncate">PDPA Statement (Sep 2026)</p></div></div>
                                <button type="button" onclick="window.showAppAlert({ title: 'PDPA Privacy Statement', subtitle: 'September 2026 Edition', message: 'BankFlow MY strictly adheres to Bank Negara Malaysia RMIT standards and Malaysia Personal Data Protection Act 2010. Your banking and biometric data are never sold or shared with unapproved third parties.', type: 'primary' })" class="ml-2 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:border-emerald-300 cursor-pointer active:scale-95 shrink-0 transition-colors">View</button>
                            </div>
                        </div>

                        {{-- Danger Zone --}}
                        <div class="p-3.5 rounded-xl bg-rose-50 dark:bg-rose-950/30 border border-rose-200 dark:border-rose-900/60 space-y-2.5">
                            <div class="flex items-center gap-2">
                                <i data-lucide="alert-octagon" class="w-4 h-4 text-rose-600"></i>
                                <p class="text-xs font-black text-rose-700 dark:text-rose-300 uppercase tracking-wider">Danger Zone</p>
                            </div>
                            <p class="text-xs text-rose-700 dark:text-rose-400 leading-relaxed">Emergency Kill Switch immediately freezes all your bank accounts, debit cards, and revokes all active digital banking sessions across all devices.</p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1">
                                <button type="button" onclick="window.openKillSwitchModal()"
                                        class="w-full py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.98] shadow-md shadow-rose-600/25">
                                    <i data-lucide="shield-alert" class="w-4 h-4"></i>
                                    Emergency Web Kill Switch
                                </button>
                                <button type="button" onclick="window.showAppConfirm({ title: 'Request Account Deactivation?', subtitle: 'Irreversible Banking Action', message: 'Are you sure you want to request deactivation? All linked auto-debits, recurring JomPAY bills, and DuitNow ID bindings will be permanently cancelled.', type: 'danger', confirmText: 'Submit Deactivation Request', cancelText: 'Keep Account Active', onConfirm: function() { window.showAppAlert({ title: 'Deactivation Request Received', subtitle: 'Case #BF-2026-9901', message: 'Your request has been logged. A BankFlow banking officer will verify your identity within 3 business days.', type: 'warning' }); } })"
                                        class="w-full py-2.5 rounded-xl border border-rose-300 dark:border-rose-800 hover:bg-rose-100 dark:hover:bg-rose-900/40 text-rose-700 dark:text-rose-300 font-bold text-xs transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.98]">
                                    <i data-lucide="user-x" class="w-4 h-4"></i>
                                    Request Deactivation
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Sign Out ── --}}
        <div>
            <form id="logout-form" method="POST" action="{{ route('customer.logout') }}">
                @csrf
                <button type="button" onclick="window.showAppConfirm({ title: 'Sign Out from BankFlow?', subtitle: 'End Session', message: 'Are you sure you want to terminate your secure retail digital banking session?', type: 'warning', confirmText: 'Sign Out Now', cancelText: 'Stay Logged In', onConfirm: function() { document.getElementById('logout-form').submit(); } })"
                        class="w-full py-3.5 rounded-2xl border border-rose-200 dark:border-rose-900/60 bg-white dark:bg-slate-900 hover:bg-rose-50 dark:hover:bg-rose-950/30 text-rose-600 dark:text-rose-400 font-bold text-sm transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.98]">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Sign Out from BankFlow MY
                </button>
            </form>
        </div>

        {{-- App version badge --}}
        <div class="text-center pb-2">
            <p class="text-xs text-slate-400">BankFlow MY v3.2.1 &bull; BNM Licensed &bull; PIDM Protected</p>
        </div>
    </div>

    {{-- ══ CHANGE PASSWORD MODAL ══ --}}
    <div id="change-password-modal" class="hidden fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="window.closeChangePassword()"></div>
        <div class="relative w-full sm:max-w-md bg-white dark:bg-slate-900 rounded-t-3xl sm:rounded-3xl shadow-2xl border-t border-slate-200 dark:border-slate-800 sm:border p-5 sm:p-6 space-y-4 animate__animated animate__fadeInUp sm:animate__zoomIn animate__faster">
            {{-- Handle bar for mobile --}}
            <div class="w-10 h-1 rounded-full bg-slate-200 dark:bg-slate-700 mx-auto mb-1 sm:hidden"></div>
            <div class="flex items-center justify-between">
                <h3 class="text-base font-black text-slate-900 dark:text-slate-100 font-sans tracking-tight">Change Password</h3>
                <button type="button" onclick="window.closeChangePassword()" class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Current Password</label>
                    <input type="password" class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all placeholder:font-normal placeholder:text-slate-400" placeholder="Current password" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">New Password</label>
                    <input type="password" class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all placeholder:font-normal placeholder:text-slate-400" placeholder="Min. 12 characters" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Confirm Password</label>
                    <input type="password" class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all placeholder:font-normal placeholder:text-slate-400" placeholder="Repeat new password" />
                </div>
            </div>
            <div class="flex items-center gap-2 p-3 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-xs text-amber-700 dark:text-amber-300 font-sans">
                <i data-lucide="clock" class="w-4 h-4 shrink-0"></i>
                <span>Triggers 12-hour transfer cooling-off per BNM RMIT</span>
            </div>
            <div class="flex gap-2.5 pt-1">
                <button type="button" onclick="window.closeChangePassword()" class="flex-1 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 font-bold text-xs sm:text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer font-sans transition-colors">Cancel</button>
                <button type="button" onclick="window.closeChangePassword(); window.showAppAlert({ title: 'Password Changed', subtitle: 'Cooling-off Period Active', message: 'Your login password has been updated. A mandatory 12-hour cooling-off window is now active per BNM guidelines.', type: 'security' })" class="flex-1 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm cursor-pointer active:scale-95 shadow-xs shadow-emerald-600/20 font-sans transition-all">Update</button>
            </div>
        </div>
    </div>

    {{-- ══ CHANGE PIN MODAL ══ --}}
    <div id="change-pin-modal" class="hidden fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="window.closeChangePin()"></div>
        <div class="relative w-full sm:max-w-md bg-white dark:bg-slate-900 rounded-t-3xl sm:rounded-3xl shadow-2xl border-t border-slate-200 dark:border-slate-800 sm:border p-5 sm:p-6 space-y-4 animate__animated animate__fadeInUp sm:animate__zoomIn animate__faster">
            <div class="w-10 h-1 rounded-full bg-slate-200 dark:bg-slate-700 mx-auto mb-1 sm:hidden"></div>
            <div class="flex items-center justify-between">
                <h3 class="text-base font-black text-slate-900 dark:text-slate-100 font-sans tracking-tight">Change Transaction PIN</h3>
                <button type="button" onclick="window.closeChangePin()" class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Current PIN</label>
                    <input type="password" maxlength="6" inputmode="numeric" class="w-full py-3 px-4 text-xl font-bold tracking-[0.5em] rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-center font-sans shadow-2xs transition-all" placeholder="••••••" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">New PIN</label>
                    <input type="password" maxlength="6" inputmode="numeric" class="w-full py-3 px-4 text-xl font-bold tracking-[0.5em] rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-center font-sans shadow-2xs transition-all" placeholder="••••••" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Confirm PIN</label>
                    <input type="password" maxlength="6" inputmode="numeric" class="w-full py-3 px-4 text-xl font-bold tracking-[0.5em] rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-center font-sans shadow-2xs transition-all" placeholder="••••••" />
                </div>
            </div>
            <div class="flex items-center gap-2 p-3 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-xs text-amber-700 dark:text-amber-300 font-sans">
                <i data-lucide="clock" class="w-4 h-4 shrink-0"></i>
                <span>Triggers 12-hour transfer cooling-off per BNM RMIT</span>
            </div>
            <div class="flex gap-2.5 pt-1">
                <button type="button" onclick="window.closeChangePin()" class="flex-1 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 font-bold text-xs sm:text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer font-sans transition-colors">Cancel</button>
                <button type="button" onclick="window.closeChangePin(); window.showAppAlert({ title: 'PIN Updated', subtitle: 'Transaction Security', message: 'Your 6-digit transaction PIN has been successfully reset. A 12-hour cooling-off security lock is now active.', type: 'security' })" class="flex-1 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm cursor-pointer active:scale-95 shadow-xs shadow-emerald-600/20 font-sans transition-all">Update</button>
            </div>
        </div>
    </div>

    {{-- ══ EMERGENCY KILL SWITCH MODAL ══ --}}
    <div id="kill-switch-modal" class="hidden fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="window.closeKillSwitchModal()"></div>
        <div class="relative w-full sm:max-w-md bg-white dark:bg-slate-900 rounded-t-3xl sm:rounded-3xl shadow-2xl border-t border-rose-300 dark:border-rose-900 sm:border p-5 sm:p-6 space-y-4 animate__animated animate__fadeInUp sm:animate__zoomIn animate__faster">
            <div class="w-10 h-1 rounded-full bg-slate-200 dark:bg-slate-700 mx-auto mb-1 sm:hidden"></div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-rose-600">
                    <i data-lucide="shield-alert" class="w-5 h-5"></i>
                    <h3 class="text-base font-black text-slate-900 dark:text-slate-100 font-sans tracking-tight">Emergency Kill Switch</h3>
                </div>
                <button type="button" onclick="window.closeKillSwitchModal()" class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            
            <p class="text-xs text-rose-700 dark:text-rose-400 leading-relaxed font-sans">
                Activating the Emergency Kill Switch will <strong>instantly freeze all your accounts and debit cards</strong> and invalidate all logged-in devices. Enter your password to authorize.
            </p>

            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Enter Your Password</label>
                    <input type="password" id="kill-switch-password-input" class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-rose-300 dark:border-rose-800 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all placeholder:font-normal placeholder:text-slate-400" placeholder="Your current login password" />
                </div>
            </div>

            <div class="flex gap-2.5 pt-1">
                <button type="button" onclick="window.closeKillSwitchModal()" class="flex-1 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 font-bold text-xs sm:text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer font-sans transition-colors">Cancel</button>
                <button type="button" id="btn-confirm-kill-switch" onclick="window.executeKillSwitch()" class="flex-1 py-3 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs sm:text-sm cursor-pointer active:scale-95 shadow-md shadow-rose-600/30 font-sans transition-all">Freeze Accounts</button>
            </div>
        </div>
    </div>

    {{-- ══ UPDATE MOBILE NUMBER MODAL (BNM High Security) ══ --}}
    <div id="update-phone-modal" class="hidden fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="window.closeUpdatePhoneModal()"></div>
        <div class="relative w-full sm:max-w-md bg-white dark:bg-slate-900 rounded-t-3xl sm:rounded-3xl shadow-2xl border-t border-slate-200 dark:border-slate-800 sm:border p-5 sm:p-6 space-y-4 animate__animated animate__fadeInUp sm:animate__zoomIn animate__faster">
            <div class="w-10 h-1 rounded-full bg-slate-200 dark:bg-slate-700 mx-auto mb-1 sm:hidden"></div>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-black text-slate-900 dark:text-slate-100 font-sans tracking-tight">Update Registered Mobile</h3>
                    <p class="text-xs text-slate-500 font-sans mt-0.5">Two-Factor Authentication &amp; TAC Number</p>
                </div>
                <button type="button" onclick="window.closeUpdatePhoneModal()" class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">Current Mobile Number</label>
                    <input type="text" value="{{ $customer->phone_number }}" readonly class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-200/90 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/80 text-slate-500 cursor-not-allowed font-sans shadow-2xs" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">New Mobile Number (Malaysia +60)</label>
                    <input type="tel" id="new-phone-input" placeholder="+60 1x-xxx xxxx" class="w-full py-2.5 sm:py-3 px-3.5 sm:px-4 text-xs sm:text-sm font-semibold rounded-2xl border border-slate-300/90 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-slate-900 dark:text-slate-100 font-sans shadow-2xs transition-all placeholder:font-normal placeholder:text-slate-400" />
                </div>
            </div>
            <div class="p-3 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-xs text-amber-800 dark:text-amber-300 font-sans space-y-1">
                <div class="flex items-center gap-1.5 font-bold text-amber-900 dark:text-amber-200">
                    <i data-lucide="shield-alert" class="w-4 h-4 shrink-0 text-amber-600"></i>
                    <span>BNM RMIT Regulatory Safeguard</span>
                </div>
                <p class="leading-relaxed text-[11px]">
                    Updating your TAC/OTP phone number enforces a <strong>mandatory 24-hour cooling-off security lock</strong>. Online transfers and DuitNow limits will be temporarily restricted until identity verification is complete.
                </p>
            </div>
            <div class="flex gap-2.5 pt-1">
                <button type="button" onclick="window.closeUpdatePhoneModal()" class="flex-1 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 font-bold text-xs sm:text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer font-sans transition-colors">Cancel</button>
                <button type="button" onclick="window.submitUpdatePhone()" class="flex-1 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm cursor-pointer active:scale-95 shadow-xs shadow-emerald-600/20 font-sans transition-all">Verify &amp; Proceed</button>
            </div>
        </div>
    </div>

    {{-- ══ FLOATING CENTER-OF-DEVICE FIELD NOTE MODAL ══ --}}
    <div id="field-note-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="window.closeFieldNoteModal()"></div>

        {{-- Center Floating Dialog Card --}}
        <div class="relative w-full max-w-sm bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200/90 dark:border-slate-800 p-5 sm:p-6 space-y-4 animate__animated animate__zoomIn animate__faster">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-2.5">
                    <div id="modal-note-icon-wrap" class="w-9 h-9 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 shadow-xs border border-emerald-500/20">
                        <i id="modal-note-icon" data-lucide="info" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span id="modal-note-badge" class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Security &amp; Regulatory</span>
                        <h3 id="modal-note-title" class="text-sm sm:text-base font-black text-slate-900 dark:text-slate-100 font-sans tracking-tight leading-tight">Field Information</h3>
                    </div>
                </div>
                <button type="button" onclick="window.closeFieldNoteModal()" 
                        class="w-7 h-7 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer shrink-0">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80">
                <p id="modal-note-desc" class="text-xs text-slate-600 dark:text-slate-300 font-sans leading-relaxed">
                    Detailed field guideline description.
                </p>
            </div>

            <button type="button" onclick="window.closeFieldNoteModal()" 
                    class="w-full py-2.5 sm:py-3 rounded-2xl bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 font-bold text-xs sm:text-sm transition-all flex items-center justify-center cursor-pointer active:scale-95 shadow-xs font-sans">
                Got It
            </button>
        </div>
    </div>

    <script>
    (function() {
        // ─── Accordion ───────────────────────────────────────────────────
        const N = 5;
        const heights = {};

        // Measure natural heights on load
        window.addEventListener('DOMContentLoaded', function() {
            for (let i = 1; i <= N; i++) {
                const body = document.getElementById('body-' + i);
                if (!body) continue;
                // Temporarily open to measure
                body.classList.remove('acc-closed');
                body.style.maxHeight = 'none';
                heights[i] = body.scrollHeight + 'px';
                // Restore — section 1 is open by default, rest closed
                if (i === 1) {
                    body.style.maxHeight = heights[i];
                } else {
                    body.classList.add('acc-closed');
                    body.style.maxHeight = '0';
                }
            }
        });

        window.toggleSection = function(n) {
            for (let i = 1; i <= N; i++) {
                const body  = document.getElementById('body-'  + i);
                const chev  = document.getElementById('chev-'  + i);
                if (!body || !chev) continue;
                const isOpen = !body.classList.contains('acc-closed');
                if (i === n) {
                    if (isOpen) {
                        body.style.maxHeight = heights[i] || body.scrollHeight + 'px';
                        requestAnimationFrame(function() {
                            body.style.maxHeight = '0';
                            body.classList.add('acc-closed');
                        });
                        chev.classList.remove('rotate-180');
                    } else {
                        body.classList.remove('acc-closed');
                        if (!heights[i]) heights[i] = body.scrollHeight + 'px';
                        body.style.maxHeight = '0';
                        requestAnimationFrame(function() {
                            requestAnimationFrame(function() {
                                body.style.maxHeight = heights[i];
                            });
                        });
                        chev.classList.add('rotate-180');
                    }
                } else if (isOpen) {
                    body.style.maxHeight = '0';
                    body.classList.add('acc-closed');
                    chev.classList.remove('rotate-180');
                }
            }
            setTimeout(function() { if (window.lucide) window.lucide.createIcons(); }, 50);
        };

        window.openSettingsSection = function(n) {
            const body = document.getElementById('body-' + n);
            const chev = document.getElementById('chev-' + n);
            if (!body || !chev) return;
            const isOpen = !body.classList.contains('acc-closed');
            if (!isOpen) window.toggleSection(n);
            else body.scrollIntoView({ behavior: 'smooth', block: 'start' });
        };

        // ─── Inline Interactive Field Note Drawers ───────────────────────
        window.toggleFieldNote = function(key) {
            const targetDrawer = document.getElementById('drawer-note-' + key);
            const targetBtn = document.getElementById('btn-note-' + key);
            if (!targetDrawer) return;

            const isCurrentlyOpen = targetDrawer.classList.contains('is-open');

            // Close all field note drawers in Section 1 first for a clean accordion effect
            ['fullname', 'username', 'phone', 'email', 'nric'].forEach(function(k) {
                const drawer = document.getElementById('drawer-note-' + k);
                const btn = document.getElementById('btn-note-' + k);
                if (drawer) drawer.classList.remove('is-open');
                if (btn) {
                    btn.setAttribute('aria-expanded', 'false');
                    btn.classList.remove('text-emerald-600', 'dark:text-emerald-400', 'text-amber-600', 'dark:text-amber-400', 'bg-emerald-50', 'dark:bg-emerald-950/40', 'bg-amber-50', 'dark:bg-amber-950/40');
                    btn.classList.add('text-slate-400');
                }
            });

            // Toggle target drawer if it was closed
            if (!isCurrentlyOpen) {
                targetDrawer.classList.add('is-open');
                if (targetBtn) {
                    targetBtn.setAttribute('aria-expanded', 'true');
                    targetBtn.classList.remove('text-slate-400');
                    if (key === 'phone') {
                        targetBtn.classList.add('text-amber-600', 'dark:text-amber-400', 'bg-amber-50', 'dark:bg-amber-950/40');
                    } else {
                        targetBtn.classList.add('text-emerald-600', 'dark:text-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-950/40');
                    }
                }
            }

            // Dynamically adjust Section 1 accordion container height so content never clips
            const body1 = document.getElementById('body-1');
            if (body1 && !body1.classList.contains('acc-closed')) {
                body1.style.maxHeight = 'none';
                setTimeout(function() {
                    if (heights[1]) {
                        heights[1] = body1.scrollHeight + 'px';
                    }
                }, 300);
            }

            setTimeout(function() { if (window.lucide) window.lucide.createIcons(); }, 50);
        };

        // ─── Floating Center-of-Device Field Note Modal (Fallback/Detail) ─
        const fieldNoteData = {
            fullname: {
                title: 'National Registration (JPN)',
                badge: 'Identity Verification',
                icon: 'user-check',
                desc: 'Official legal name registered with National Registration Department (JPN). Changes require an in-person branch verification with statutory proof documents.',
                iconClass: 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                badgeClass: 'text-emerald-600 dark:text-emerald-400'
            },
            username: {
                title: 'BNM Identity Guidelines',
                badge: 'Permanent Identifier',
                icon: 'shield-check',
                desc: 'Banking ID is permanently assigned upon account onboarding and cannot be modified online per Bank Negara Malaysia (BNM) digital identity guidelines.',
                iconClass: 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                badgeClass: 'text-emerald-600 dark:text-emerald-400'
            },
            phone: {
                title: 'High Security Credential',
                badge: '2FA / Hardware Enclave',
                icon: 'shield-alert',
                desc: 'Receives SMS TAC/OTP and pairs hardware enclave keys. In compliance with BNM RMIT guidelines, any registered mobile update triggers a mandatory 24-hour cooling-off transaction security lock.',
                iconClass: 'bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 border-amber-500/20',
                badgeClass: 'text-amber-600 dark:text-amber-400'
            },
            email: {
                title: 'Official Statements & Notices',
                badge: 'Notification Channel',
                icon: 'mail-check',
                desc: 'Used for monthly e-Statements, DuitNow transfer receipts, transaction audit logs, and account security notifications. Editable online with instant confirmation.',
                iconClass: 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                badgeClass: 'text-emerald-600 dark:text-emerald-400'
            },
            nric: {
                title: 'e-KYC Biometric Verification',
                badge: 'Permanent Identity',
                icon: 'fingerprint',
                desc: 'National Registration Identity Card (MyKad) verified during biometric e-KYC onboarding. Partially masked for personal data privacy compliance.',
                iconClass: 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                badgeClass: 'text-emerald-600 dark:text-emerald-400'
            }
        };

        window.openFieldNoteModal = function(key) {
            const data = fieldNoteData[key];
            if (!data) return;

            const modal = document.getElementById('field-note-modal');
            const titleEl = document.getElementById('modal-note-title');
            const badgeEl = document.getElementById('modal-note-badge');
            const descEl = document.getElementById('modal-note-desc');
            const iconWrap = document.getElementById('modal-note-icon-wrap');
            const iconEl = document.getElementById('modal-note-icon');

            if (titleEl) titleEl.textContent = data.title;
            if (badgeEl) {
                badgeEl.textContent = data.badge;
                badgeEl.className = 'text-[10px] font-bold uppercase tracking-wider ' + data.badgeClass;
            }
            if (descEl) descEl.textContent = data.desc;
            if (iconWrap) {
                iconWrap.className = 'w-9 h-9 rounded-2xl flex items-center justify-center shrink-0 shadow-xs border ' + data.iconClass;
            }
            if (iconEl) {
                iconEl.setAttribute('data-lucide', data.icon);
            }

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            if (window.lucide) {
                window.lucide.createIcons();
            }
        };

        window.closeFieldNoteModal = function() {
            const modal = document.getElementById('field-note-modal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        };

        // ─── Toggle Switch ───────────────────────────────────────────────
        window.toggleSwitch = function(id) {
            var btn   = document.getElementById(id);
            if (!btn) return;
            var isOn  = btn.getAttribute('aria-checked') === 'true';
            var thumb = btn.querySelector('span');
            btn.setAttribute('aria-checked', isOn ? 'false' : 'true');
            btn.classList.toggle('bg-emerald-500',        !isOn);
            btn.classList.toggle('bg-slate-200',           isOn);
            btn.classList.toggle('dark:bg-slate-700',      isOn);
            if (thumb) {
                thumb.classList.toggle('translate-x-5', !isOn);
                thumb.classList.toggle('translate-x-0',  isOn);
            }
        };

        // ─── Theme ──────────────────────────────────────────────────────
        window.selectTheme = function(theme) {
            ['light','dark','system'].forEach(function(t) {
                var btn   = document.getElementById('theme-btn-' + t);
                var icon  = btn ? btn.querySelector('div') : null;
                var label = btn ? btn.querySelector('p')   : null;
                if (!btn) return;
                if (t === theme) {
                    btn.classList.remove('border-slate-200','dark:border-slate-700');
                    btn.classList.add('border-emerald-500','bg-emerald-50','dark:bg-emerald-950/30');
                    if (icon)  { icon.classList.remove('bg-slate-100','dark:bg-slate-800','text-slate-500'); icon.classList.add('bg-emerald-500','text-white'); }
                    if (label) { label.classList.remove('text-slate-700','dark:text-slate-300'); label.classList.add('text-emerald-700','dark:text-emerald-300'); }
                } else {
                    btn.classList.remove('border-emerald-500','bg-emerald-50','dark:bg-emerald-950/30');
                    btn.classList.add('border-slate-200','dark:border-slate-700');
                    if (icon)  { icon.classList.remove('bg-emerald-500','text-white'); icon.classList.add('bg-slate-100','dark:bg-slate-800','text-slate-500'); }
                    if (label) { label.classList.remove('text-emerald-700','dark:text-emerald-300'); label.classList.add('text-slate-700','dark:text-slate-300'); }
                }
            });
            if      (theme === 'dark')  { document.documentElement.classList.add('dark'); localStorage.setItem('theme','dark'); }
            else if (theme === 'light') { document.documentElement.classList.remove('dark'); localStorage.setItem('theme','light'); }
            else                        { localStorage.removeItem('theme'); document.documentElement.classList.toggle('dark', window.matchMedia('(prefers-color-scheme: dark)').matches); }
        };

        // ─── Color Theme Palette ─────────────────────────────────────────
        const colorPaletteMeta = {
            emerald: { name: 'Emerald (Default)', border: 'border-emerald-500', bg: 'bg-emerald-50/70 dark:bg-emerald-950/30', hex: '#059669', badgeClass: 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border-emerald-500/20' },
            blue:    { name: 'Sapphire Blue',     border: 'border-blue-500',    bg: 'bg-blue-50/70 dark:bg-blue-950/30',       hex: '#2563eb', badgeClass: 'bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border-blue-500/20' },
            purple:  { name: 'Royal Violet',      border: 'border-purple-500',  bg: 'bg-purple-50/70 dark:bg-purple-950/30',   hex: '#7c3aed', badgeClass: 'bg-purple-50 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 border-purple-500/20' },
            amber:   { name: 'Amber Gold',        border: 'border-amber-500',   bg: 'bg-amber-50/70 dark:bg-amber-950/30',     hex: '#d97706', badgeClass: 'bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border-amber-500/20' },
            rose:    { name: 'Ruby Rose',         border: 'border-rose-500',    bg: 'bg-rose-50/70 dark:bg-rose-950/30',       hex: '#e11d48', badgeClass: 'bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border-rose-500/20' }
        };

        window.selectColorTheme = function(color) {
            if (!colorPaletteMeta[color]) color = 'emerald';
            
            // Set data attribute on html root
            document.documentElement.setAttribute('data-color-theme', color);
            localStorage.setItem('app-color-theme', color);

            // Update meta theme-color
            const metaTag = document.querySelector('meta[name="theme-color"]');
            if (metaTag && colorPaletteMeta[color].hex) {
                metaTag.setAttribute('content', colorPaletteMeta[color].hex);
            }

            // Update badge label
            const labelEl = document.getElementById('current-color-theme-label');
            if (labelEl) {
                labelEl.textContent = colorPaletteMeta[color].name;
                labelEl.className = 'text-xs font-black uppercase tracking-wider px-2 py-0.5 rounded-md border ' + colorPaletteMeta[color].badgeClass;
            }

            // Update buttons active ring and checkmarks
            Object.keys(colorPaletteMeta).forEach(function(c) {
                const btn = document.getElementById('color-btn-' + c);
                if (!btn) return;
                const check = btn.querySelector('.color-check');
                const meta = colorPaletteMeta[c];

                if (c === color) {
                    btn.classList.remove('border-slate-200', 'dark:border-slate-700', 'hover:border-blue-300', 'hover:border-purple-300', 'hover:border-amber-300', 'hover:border-rose-300', 'hover:border-emerald-300');
                    btn.classList.add(meta.border);
                    meta.bg.split(' ').forEach(cls => { if(cls) btn.classList.add(cls); });
                    if (check) check.classList.remove('hidden');
                } else {
                    btn.classList.remove(meta.border);
                    meta.bg.split(' ').forEach(cls => { if(cls) btn.classList.remove(cls); });
                    btn.classList.add('border-slate-200', 'dark:border-slate-700');
                    if (check) check.classList.add('hidden');
                }
            });

            // Re-render icons if needed
            if (window.lucide) window.lucide.createIcons();
        };

        // Initialize display theme & color theme state on load
        (function initThemes() {
            const currentTheme = localStorage.getItem('theme') || 'system';
            window.selectTheme(currentTheme);

            const currentColor = localStorage.getItem('app-color-theme') || 'emerald';
            window.selectColorTheme(currentColor);
        })();

        // ─── Modals ─────────────────────────────────────────────────────
        window.openKillSwitchModal = function() {
            document.getElementById('kill-switch-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        };
        window.closeKillSwitchModal = function() {
            document.getElementById('kill-switch-modal').classList.add('hidden');
            document.body.style.overflow = '';
        };

        window.executeKillSwitch = function() {
            const pwd = (document.getElementById('kill-switch-password-input').value || '').trim();
            if (!pwd) {
                alert('Please enter your password to authorize lockdown.');
                return;
            }

            const btn = document.getElementById('btn-confirm-kill-switch');
            btn.innerHTML = 'Freezing...';
            btn.disabled = true;

            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch('{{ route("customer.settings.kill-switch") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                },
                body: JSON.stringify({ password: pwd })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('EMERGENCY KILL SWITCH ACTIVATED: Your accounts and cards are now frozen.');
                    window.location.href = data.redirect || '{{ route("login") }}';
                } else {
                    alert(data.message || 'Authorization failed.');
                    btn.innerHTML = 'Freeze Accounts';
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('An error occurred. Please contact customer care.');
                btn.innerHTML = 'Freeze Accounts';
                btn.disabled = false;
            });
        };

        window.openChangePassword  = function() { document.getElementById('change-password-modal').classList.remove('hidden'); document.body.style.overflow='hidden'; };
        window.closeChangePassword = function() { document.getElementById('change-password-modal').classList.add('hidden');    document.body.style.overflow=''; };
        window.openChangePin       = function() { document.getElementById('change-pin-modal').classList.remove('hidden');     document.body.style.overflow='hidden'; };
        window.closeChangePin      = function() { document.getElementById('change-pin-modal').classList.add('hidden');        document.body.style.overflow=''; };
        window.openUpdatePhoneModal = function() { document.getElementById('update-phone-modal').classList.remove('hidden'); document.body.style.overflow='hidden'; };
        window.closeUpdatePhoneModal = function() { document.getElementById('update-phone-modal').classList.add('hidden'); document.body.style.overflow=''; };

        window.submitUpdatePhone = function() {
            var newPhone = (document.getElementById('new-phone-input').value || '').trim();
            if (!newPhone) {
                window.showAppAlert({ title: 'Invalid Mobile Number', message: 'Please enter a valid Malaysian mobile number (+60 1x-xxx xxxx).', type: 'warning' });
                return;
            }
            window.closeUpdatePhoneModal();
            document.getElementById('profile-phone').value = newPhone;
            window.showAppAlert({
                title: 'Mobile Number Updated',
                subtitle: '24-Hour Cooling-Off Activated',
                message: 'Your TAC/OTP mobile number has been changed to ' + newPhone + '. In accordance with BNM regulations, a 24-hour cooling-off security lock is now active.',
                type: 'security'
            });
        };

        window.saveCustomerProfile = function() {
            var email = (document.getElementById('profile-email').value || '').trim();
            if (!email || email.indexOf('@') === -1) {
                window.showAppAlert({ title: 'Invalid Email', message: 'Please provide a valid email address.', type: 'warning' });
                return;
            }
            window.showAppAlert({
                title: 'Profile Updated',
                subtitle: 'Customer Information Saved',
                message: 'Your email address has been successfully updated and verified for notifications and e-Statements.',
                type: 'success'
            });
        };

        // ─── Lucide ─────────────────────────────────────────────────────
        setTimeout(function() { if (window.lucide) window.lucide.createIcons(); }, 100);
    })();
    </script>

</x-layout.customer>
