<x-layout.public title="BankFlow MY — Enterprise Malaysian Digital Retail Banking Platform">

    <!-- Top Regulatory Compliance & National Scam Response Banner -->
    <div class="mb-8 space-y-3 animate__animated animate__fadeInDown">
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 transition-all duration-300 hover:border-emerald-500/30">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 ring-1 ring-emerald-500/20 shadow-sm animate-pulse-subtle">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100">
                            BankFlow MY Architecture & Standards
                        </h2>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 ring-1 ring-emerald-500/20">
                            v2.3.0 Enterprise
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                        Financial Services Act 2013 &bull; PayNet Certified Clearing Rails &bull; ISO/IEC 27001
                    </p>
                </div>
            </div>

            <!-- Hotline & Quick Status Indicators -->
            <div class="flex items-center gap-2.5 flex-wrap w-full md:w-auto justify-start md:justify-end pt-2 md:pt-0 border-t md:border-t-0 border-slate-100 dark:border-slate-800">
                <a
                    href="tel:997"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold transition-all active:scale-95 shadow-xs"
                    title="National Scam Response Centre Hotline"
                >
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>NSRC Hotline: 997</span>
                </a>
                <x-banking.security-badge type="kill_switch" />
            </div>
        </div>

        <x-ui.alert variant="info" title="System Specification: Dual-Channel Digital Banking Architecture">
            BankFlow MY demonstrates full compliance with modern mandatory Anti-Scam Measures: single hardware device binding, mandatory 12-hour cooling-off, complete SMS OTP elimination, emergency Kill Switch circuit breaker, and immutable SHA-256 financial audit chains.
        </x-ui.alert>
    </div>

    <!-- Hero Section: Project Purpose & Mission -->
    <section class="relative overflow-hidden pt-4 pb-12 sm:pt-10 sm:pb-16 animate__animated animate__fadeIn">
        <!-- Ambient Animated Glows -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[320px] sm:w-[600px] h-[320px] sm:h-[600px] bg-emerald-500/10 dark:bg-emerald-500/15 rounded-full blur-3xl pointer-events-none -z-10 animate-pulse-subtle"></div>
        <div class="absolute top-1/3 right-10 w-64 h-64 bg-blue-500/10 dark:bg-blue-500/15 rounded-full blur-3xl pointer-events-none -z-10 animate-float"></div>

        <div class="max-w-4xl mx-auto text-center space-y-6">
            <!-- Project Badge with subtle bounce -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 text-xs font-semibold shadow-md animate__animated animate__fadeInDown animate__delay-1s">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>Production Reference System &bull; Next-Gen Retail Banking</span>
            </div>

            <!-- Headline with gradient text -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100 leading-[1.14]">
                Architected for Safety, <br class="hidden sm:inline"/>
                <span class="bg-gradient-to-r from-emerald-600 via-teal-500 to-blue-600 bg-clip-text text-transparent">
                    Engineered for Instant PayNet Clearing
                </span>
            </h1>

            <!-- Narrative Subtext -->
            <p class="text-sm sm:text-base lg:text-lg text-slate-600 dark:text-slate-400 max-w-3xl mx-auto leading-relaxed px-2">
                A unified personal retail digital banking ecosystem engineered across <strong>Flutter Mobile</strong> (iOS/Android hardware enclave) and <strong>Laravel 11+ Octane Web Portal</strong>, backed by an enterprise dual-database architecture (PostgreSQL 16 for production and SQLite 3 for zero-dependency local testing).
            </p>

            <!-- Interactive Jump Links -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 pt-2 px-4 sm:px-0">
                <x-ui.button
                    variant="primary"
                    size="lg"
                    onclick="document.getElementById('tech-stack').scrollIntoView({ behavior: 'smooth' })"
                    class="w-full sm:w-auto shadow-lg shadow-emerald-600/25 transition-transform hover:scale-105"
                >
                    <x-slot:icon>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </x-slot:icon>
                    System Architecture & Stack
                </x-ui.button>

                <x-ui.button
                    variant="outline"
                    size="lg"
                    onclick="document.getElementById('compliance-matrix').scrollIntoView({ behavior: 'smooth' })"
                    class="w-full sm:w-auto transition-transform hover:scale-105"
                >
                    Compliance Standards &rarr;
                </x-ui.button>

                <x-ui.button
                    variant="secondary"
                    size="lg"
                    onclick="document.getElementById('live-demo').scrollIntoView({ behavior: 'smooth' })"
                    class="w-full sm:w-auto transition-transform hover:scale-105"
                >
                    Interactive Banking Sandbox
                </x-ui.button>
            </div>
        </div>
    </section>

    <!-- Section 1: The 5 Anti-Scam Policy Mandates (Key Project Highlight) -->
    <section class="mb-16" id="anti-scam">
        <div class="text-center max-w-2xl mx-auto mb-8 px-2">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                5 Mandatory Anti-Scam Directives
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                Built-in safeguards addressing real-world cyber fraud, social engineering, and unauthorized credential abuse.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Mandate 1 -->
            <x-ui.card class="space-y-3 interactive-card group border-slate-200/80 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <span class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-700 dark:text-emerald-300 font-bold text-xs flex items-center justify-center group-hover:scale-110 transition-transform">
                        01
                    </span>
                    <x-ui.badge variant="success" dot>Hardware Enclave</x-ui.badge>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                    Single Bound Device Policy
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Only one physical mobile device can be registered per customer. Non-exportable EC P-256 keys generated in Apple Secure Enclave / Android Keystore sign every high-value challenge.
                </p>
            </x-ui.card>

            <!-- Mandate 2 -->
            <x-ui.card class="space-y-3 interactive-card group border-slate-200/80 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <span class="w-8 h-8 rounded-xl bg-amber-100 dark:bg-amber-950/70 text-amber-700 dark:text-amber-300 font-bold text-xs flex items-center justify-center group-hover:scale-110 transition-transform">
                        02
                    </span>
                    <x-ui.badge variant="warning" dot>12-Hour Lock</x-ui.badge>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                    12-Hour Operational Cooling-Off
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    New device enrolments and transaction limit escalations automatically enter a state-machine locked cooling-off countdown, preventing instant account drainage.
                </p>
            </x-ui.card>

            <!-- Mandate 3 -->
            <x-ui.card class="space-y-3 interactive-card group border-slate-200/80 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <span class="w-8 h-8 rounded-xl bg-sky-100 dark:bg-sky-950/70 text-sky-700 dark:text-sky-300 font-bold text-xs flex items-center justify-center group-hover:scale-110 transition-transform">
                        03
                    </span>
                    <x-ui.badge variant="info" dot>SMS Deprecated</x-ui.badge>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100 group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">
                    Out-of-Band (OOB) Push Token
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Zero SMS OTP. Transactions initiated on web portal trigger an instant biometric push challenge to the customer's registered smartphone for single-tap cryptographic approval.
                </p>
            </x-ui.card>

            <!-- Mandate 4 -->
            <x-ui.card class="space-y-3 interactive-card group border-slate-200/80 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <span class="w-8 h-8 rounded-xl bg-rose-100 dark:bg-rose-950/70 text-rose-700 dark:text-rose-300 font-bold text-xs flex items-center justify-center group-hover:scale-110 transition-transform">
                        04
                    </span>
                    <x-ui.badge variant="danger" dot>Circuit Breaker</x-ui.badge>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                    Universal Emergency Kill Switch
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Customers can immediately freeze accounts, revoke active Sanctum JWT sessions, and suspend debit cards via mobile app or web portal with automated NSRC hotline dispatch.
                </p>
            </x-ui.card>

            <!-- Mandate 5 -->
            <x-ui.card class="space-y-3 interactive-card group border-slate-200/80 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <span class="w-8 h-8 rounded-xl bg-purple-100 dark:bg-purple-950/70 text-purple-700 dark:text-purple-300 font-bold text-xs flex items-center justify-center group-hover:scale-110 transition-transform">
                        05
                    </span>
                    <x-ui.badge variant="purple">SHA-256 WORM</x-ui.badge>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                    Immutable Audit Chains
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Append-only audit ledger where database triggers prohibit modifications and deletions (`WORM`), linking all financial events in a sequential cryptographic hash chain.
                </p>
            </x-ui.card>

            <!-- 24/7 NSRC Link -->
            <x-ui.card class="space-y-3 interactive-card group bg-gradient-to-br from-slate-900 to-slate-800 text-white dark:border-slate-700 shadow-lg">
                <div class="flex items-center justify-between">
                    <span class="w-8 h-8 rounded-xl bg-white/20 text-white font-bold text-xs flex items-center justify-center group-hover:scale-110 transition-transform">
                        24/7
                    </span>
                    <span class="text-[10px] font-semibold uppercase px-2 py-0.5 rounded bg-amber-400/20 text-amber-300">
                        Rapid Intercept
                    </span>
                </div>
                <h3 class="text-base font-bold text-white group-hover:text-amber-300 transition-colors">
                    National Scam Response Centre (NSRC)
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Direct operational hotline integration (997) enabling immediate PayNet interbank tracing and rapid fund freezing within the critical golden hour of an incident.
                </p>
            </x-ui.card>
        </div>
    </section>

    <!-- Section 2: End-to-End Technology Stack Architecture -->
    <section class="mb-16" id="tech-stack">
        <div class="text-center max-w-2xl mx-auto mb-8 px-2">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                Full-Stack Architecture & Dual-Tier Data Engine
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                Engineered for maximum reliability, speed, developer onboarding ease, and regulatory audit compliance.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Tier 1: Client Channels -->
            <x-ui.card class="space-y-4 interactive-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/70 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Client Tier</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Mobile App + Responsive Web</p>
                    </div>
                </div>

                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Flutter 3.22+ (Dart):</strong> Native ARM64 cross-platform mobile binary with `local_auth` biometrics.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Hardware Enclave / Keystore:</strong> On-device EC P-256 keypair generation via MethodChannels.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Laravel Web Portal:</strong> Responsive Blade & Tailwind CSS v4 design with zero FOUC dark mode.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Security:</strong> Anti-Screen Capture, RASP integrity checks, and CSP header enforcement.</span>
                    </li>
                </ul>
            </x-ui.card>

            <!-- Tier 2: Application Gateway -->
            <x-ui.card class="space-y-4 interactive-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-950/70 text-red-600 dark:text-red-400 flex items-center justify-center shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45c.582.776.9 1.724.9 2.7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Application Tier</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Laravel 11+ / Octane Engine</p>
                    </div>
                </div>

                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>PHP 8.4+ / Laravel 11+:</strong> Sub-millisecond execution overhead via Octane high-concurrency runtime.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Double-Entry Ledger Engine:</strong> Balanced multi-leg financial transactions enforcing strict ACID integrity.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Asynchronous Queues:</strong> Laravel Horizon + Redis Cluster for PayNet ISO 20022 message dispatch.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Asymmetric Token Signing:</strong> RS256 token verification stored in `HttpOnly, SameSite=Strict` cookies.</span>
                    </li>
                </ul>
            </x-ui.card>

            <!-- Tier 3: Persistence Engine -->
            <x-ui.card class="space-y-4 interactive-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Persistence Tier</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">PostgreSQL 16 + Local SQLite</p>
                    </div>
                </div>

                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Production PostgreSQL 16:</strong> Monthly table range-partitioning for statutory 84-month statement archives.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Local Dev / CI SQLite 3:</strong> Zero-dependency file or in-memory testing with foreign keys enforced.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>PII Encryption:</strong> AES-256-GCM application encryption on NRIC & phone with HMAC blind indexing.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500 font-bold">&bull;</span>
                        <span><strong>Patroni High Availability:</strong> Multi-zone streaming replication with sub-second failover.</span>
                    </li>
                </ul>
            </x-ui.card>
        </div>
    </section>

    <!-- Section 3: Regulatory Compliance Standards Table -->
    <section class="mb-16" id="compliance-matrix">
        <x-ui.card
            title="Regulatory & Financial Standards Compliance Matrix"
            subtitle="Formally mapped against statutory banking frameworks and industry guidelines"
            padding="none"
            class="interactive-card"
        >
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                        <tr>
                            <th class="px-4 py-3 sm:px-6">Standard / Framework</th>
                            <th class="px-4 py-3 sm:px-6">Policy / Section</th>
                            <th class="px-4 py-3 sm:px-6">Technical Implementation in BankFlow MY</th>
                            <th class="px-4 py-3 sm:px-6 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-4 py-3.5 sm:px-6 font-bold text-slate-900 dark:text-slate-100">
                                Risk Management (RMiT)
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 font-mono text-xs text-slate-500 dark:text-slate-400">
                                Standard 10.49
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                Strict 1-device binding enforcement via hardware UUID and Secure Enclave public key registration.
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.badge variant="success" dot>Enforced</x-ui.badge>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-4 py-3.5 sm:px-6 font-bold text-slate-900 dark:text-slate-100">
                                Risk Management (RMiT)
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 font-mono text-xs text-slate-500 dark:text-slate-400">
                                Standard 10.50 & 10.51
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                Universal deprecation of SMS OTP. Replaced with asymmetric OOB biometric push challenges.
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.badge variant="success" dot>Certified</x-ui.badge>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-4 py-3.5 sm:px-6 font-bold text-slate-900 dark:text-slate-100">
                                PayNet Malaysia
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 font-mono text-xs text-slate-500 dark:text-slate-400">
                                DuitNow & NAD Spec
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                ISO 20022 message structure (`pain.001` / `pacs.008`) with instant proxy ID recipient resolution.
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.badge variant="purple">Connected</x-ui.badge>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-4 py-3.5 sm:px-6 font-bold text-slate-900 dark:text-slate-100">
                                FSA 2013 / IFSA 2013
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 font-mono text-xs text-slate-500 dark:text-slate-400">
                                Record Retention
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                84-month (7 statutory years) transaction ledger retention leveraging PostgreSQL range partitions.
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.badge variant="info">84-Month</x-ui.badge>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-4 py-3.5 sm:px-6 font-bold text-slate-900 dark:text-slate-100">
                                PDPA 2010
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 font-mono text-xs text-slate-500 dark:text-slate-400">
                                Security Principle
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                Application-level AES-256-GCM encryption on MyKad NRIC with salted HMAC blind indexing.
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.badge variant="success" dot>Compliant</x-ui.badge>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </section>

    <!-- Section 4: Interactive Live Demo & Account Sandbox -->
    <section class="mb-16" id="live-demo">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                        Interactive Retail Banking Sandbox
                    </h2>
                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                        Simulated PayNet
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Test live account cards, balance masking, and launch the interactive instant DuitNow transfer simulator
                </p>
            </div>
            
            <div class="flex items-center gap-2.5 flex-wrap">
                <x-ui.button
                    variant="primary"
                    size="md"
                    onclick="window.openModal('quick-transfer-modal')"
                    class="shadow-md shadow-emerald-600/20"
                >
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </x-slot:icon>
                    <span>Launch DuitNow Sandbox</span>
                </x-ui.button>
                <x-banking.security-badge type="cooling_off" remaining="11h 24m" />
            </div>
        </div>


        <!-- Account Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
            <x-banking.account-card
                accountType="Premier Savings Account-i"
                accountNumber="1640 9821 7842"
                balance="RM 48,250.80"
                holderName="AHMAD DANIEL BIN ALIF"
                gradient="emerald"
                :isPrimary="true"
            />

            <x-banking.account-card
                accountType="Current Account / Salary"
                accountNumber="5140 2819 9012"
                balance="RM 8,420.15"
                holderName="AHMAD DANIEL BIN ALIF"
                gradient="sapphire"
                :isPrimary="false"
            />

            <x-banking.account-card
                accountType="Commodity Murabahah Deposit-i"
                accountNumber="7821 0029 4519"
                balance="RM 120,000.00"
                holderName="AHMAD DANIEL BIN ALIF"
                gradient="slate"
                :isPrimary="false"
            />
        </div>

        <!-- Financial Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-ui.stat-card
                title="Total Liquid Balance"
                value="RM 176,670.95"
                trend="+4.2%"
                trendType="up"
                subtitle="Consolidated 3 accounts"
            />
            <x-ui.stat-card
                title="This Month's Spending"
                value="RM 3,840.20"
                trend="-8.1%"
                trendType="down"
                subtitle="Within budget limit"
            />
            <x-ui.stat-card
                title="DuitNow Daily Limit"
                value="RM 10,000"
                subtitle="RM 1,250 utilized today"
            />
            <x-ui.stat-card
                title="Scheduled Mandates"
                value="4 Bills"
                subtitle="Next JomPAY due in 3 days"
            />
        </div>
    </section>

    <!-- Section 5: Real-Time Clearing Feed & UI Tokens Gallery -->
    <section class="mb-14" id="component-gallery">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left: Transaction Activity -->
            <div class="lg:col-span-7 space-y-6">
                <x-ui.card
                    title="Real-Time Transaction Activity"
                    subtitle="Live record of instant DuitNow and PayNet clearing events"
                    padding="none"
                    class="interactive-card"
                >
                    <x-slot:action>
                        <x-ui.button variant="ghost" size="xs" onclick="window.openModal('transaction-receipt-modal')">
                            Sample Receipt
                        </x-ui.button>
                    </x-slot:action>

                    <div class="divide-y divide-slate-100 dark:divide-slate-800">
                        <x-banking.transaction-item
                            title="Transfer to SITI NURHALIZA"
                            type="duitnow"
                            amount="150.00"
                            :isCredit="false"
                            date="Today, 08:45 AM"
                            reference="DN-202609090129"
                            status="completed"
                        />

                        <x-banking.transaction-item
                            title="Payroll Salary Credit - Tech Corp"
                            type="fpx"
                            amount="12500.00"
                            :isCredit="true"
                            date="Yesterday, 11:30 PM"
                            reference="SAL-202609-883"
                            status="completed"
                        />

                        <x-banking.transaction-item
                            title="Tenaga Nasional Berhad (TNB)"
                            type="jompay"
                            amount="342.60"
                            :isCredit="false"
                            date="07 Sep 2026"
                            reference="JP-5454-0012"
                            status="completed"
                        />

                        <x-banking.transaction-item
                            title="Family Mart Mid Valley (QR)"
                            type="qr"
                            amount="18.90"
                            :isCredit="false"
                            date="06 Sep 2026"
                            reference="QR-98102381"
                            status="completed"
                        />

                        <x-banking.transaction-item
                            title="Pending Investment Transfer"
                            type="duitnow"
                            amount="5000.00"
                            :isCredit="false"
                            date="05 Sep 2026"
                            reference="DN-77182910"
                            status="cooling_off"
                        />
                    </div>

                    <x-slot:footer>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-slate-500 dark:text-slate-400">PayNet clearing connected</span>
                            <x-ui.button variant="link" size="xs" onclick="window.openModal('transaction-receipt-modal')">
                                View Full Receipt Sample &rarr;
                            </x-ui.button>
                        </div>
                    </x-slot:footer>
                </x-ui.card>
            </div>

            <!-- Right: UI Tokens Gallery -->
            <div class="lg:col-span-5 space-y-6">
                <x-ui.card
                    title="Component Design Tokens"
                    subtitle="Interactive elements catering for mobile responsiveness & dark mode"
                    class="interactive-card"
                >
                    <div class="space-y-5">
                        <!-- Buttons -->
                        <div>
                            <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">
                                Button Tokens
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <x-ui.button variant="primary" size="sm">Primary</x-ui.button>
                                <x-ui.button variant="secondary" size="sm">Secondary</x-ui.button>
                                <x-ui.button variant="outline" size="sm">Outline</x-ui.button>
                                <x-ui.button variant="danger" size="sm">Danger</x-ui.button>
                                <x-ui.button variant="ghost" size="sm">Ghost</x-ui.button>
                            </div>
                        </div>

                        <!-- Status Badges -->
                        <div>
                            <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">
                                Status Badges & Indicators
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <x-ui.badge variant="success" dot>Approved</x-ui.badge>
                                <x-ui.badge variant="warning" dot>Cooling Off</x-ui.badge>
                                <x-ui.badge variant="danger" dot>Rejected</x-ui.badge>
                                <x-ui.badge variant="info" dot>Processing</x-ui.badge>
                                <x-ui.badge variant="purple">PayNet EMV</x-ui.badge>
                            </div>
                        </div>

                        <!-- Form Input Example -->
                        <div class="space-y-3 pt-2">
                            <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                Form Controls
                            </p>

                            <x-ui.input
                                label="DuitNow Proxy ID"
                                placeholder="Mobile No. or MyKad NRIC"
                                prefix='<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>'
                                helper="Verified against JPN / PayNet NAD registry"
                            />

                            <x-ui.select
                                label="Primary Source Account"
                                :options="[
                                    '1' => 'Premier Savings Account-i (RM 48,250.80)',
                                    '2' => 'Salary Current Account (RM 8,420.15)',
                                ]"
                                selected="1"
                            />
                        </div>

                        <!-- Launch Interactive Modal -->
                        <div class="pt-2">
                            <x-ui.button
                                variant="primary"
                                fullWidth
                                onclick="window.openModal('quick-transfer-modal')"
                                class="transition-transform hover:scale-[1.02] shadow-sm"
                            >
                                Test DuitNow Transfer Flow
                            </x-ui.button>
                        </div>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>

    <!-- Quick DuitNow Transfer Modal Component -->
    <x-ui.modal id="quick-transfer-modal" title="Quick DuitNow Transfer" size="md">
        <form class="space-y-4" onsubmit="event.preventDefault(); window.closeModal('quick-transfer-modal'); window.openModal('transaction-receipt-modal');">
            <x-ui.select
                label="Transfer From"
                :options="[
                    'acc1' => 'Premier Savings Account-i (RM 48,250.80)',
                    'acc2' => 'Salary Account (RM 8,420.15)',
                ]"
                selected="acc1"
                required
            />

            <x-ui.select
                label="DuitNow ID Type"
                :options="[
                    'mobile' => 'Mobile Number (+60)',
                    'nric' => 'NRIC / MyKad Number',
                    'passport' => 'Passport Number',
                    'brn' => 'Business Registration (BRN)',
                    'account' => 'Bank Account Number',
                ]"
                selected="mobile"
                required
            />

            <x-ui.input
                label="Recipient DuitNow ID"
                placeholder="e.g. 0123456789"
                required
            />

            <x-ui.input
                label="Transfer Amount"
                placeholder="0.00"
                prefix="RM"
                required
            />

            <x-ui.input
                label="Payment Description / Recipient Reference"
                placeholder="e.g. Monthly rent or dinner"
                required
            />

            <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-xs text-emerald-800 dark:text-emerald-300 flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Instant clearing via PayNet DuitNow network. Zero transaction fees.</span>
            </div>

            <div class="pt-2 flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-ui.button variant="secondary" size="md" onclick="window.closeModal('quick-transfer-modal')">
                    Cancel
                </x-ui.button>
                <x-ui.button variant="primary" size="md" type="submit">
                    Confirm & Authorize
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>

    <!-- Transaction Receipt Modal Component -->
    <x-banking.receipt-modal
        id="transaction-receipt-modal"
        amount="150.00"
        recipientName="SITI NURHALIZA BINTI TARUDIN"
        recipientBank="Maybank Berhad (514012345678)"
        paymentType="DuitNow Transfer"
    />

</x-layout.public>
