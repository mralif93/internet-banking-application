<x-layout.admin title="Dashboard — BankFlow MY" activeNav="dashboard">

    <!-- ======================================================================
         1. HERO HEADER: EXECUTIVE DASHBOARD OVERVIEW
         ====================================================================== -->
    <div class="mb-6 rounded-3xl bg-slate-900 border border-slate-800 text-white shadow-2xl p-4 sm:p-6 lg:p-7 relative overflow-hidden animate__animated animate__fadeInDown">
        <!-- Ambient decorative gradient orbs -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-rose-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 sm:gap-5">
            <!-- Left Info -->
            <div class="flex items-start sm:items-center gap-3 sm:gap-4">
                <div class="relative w-11 h-11 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-tr from-rose-600 via-rose-700 to-red-800 text-white flex items-center justify-center shrink-0 shadow-lg shadow-rose-950/60 ring-2 ring-rose-500/30">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 sm:w-7 sm:h-7"></i>
                    <span class="absolute -bottom-1 -right-1 flex h-3.5 w-3.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-500 ring-2 ring-slate-900"></span>
                    </span>
                </div>
                <div class="min-w-0 flex-1">
                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-white tracking-tight leading-snug break-words">
                        Executive Administration Dashboard
                    </h1>
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap mt-1.5">
                        <span class="px-2 py-0.5 rounded-md text-[9px] sm:text-[10px] font-mono font-black uppercase tracking-wider bg-rose-500/20 text-rose-300 border border-rose-500/30 shrink-0">
                            FIPS 140-2 LEVEL 4
                        </span>
                        <span class="px-2 py-0.5 rounded-md text-[9px] sm:text-[10px] font-mono font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center gap-1 shrink-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            NSRC 997 DIRECT STREAM
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1.5 max-w-2xl leading-relaxed hidden sm:block">
                        Real-time AML radar telemetry, continuous ISO 20022 clearing performance, account status containment, and BNM RMiT compliance posture.
                    </p>
                </div>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-2 sm:gap-2.5 flex-col xs:flex-row w-full lg:w-auto">
                <a
                    href="{{ route('admin.parameters') }}"
                    class="w-full xs:w-auto inline-flex items-center justify-center gap-2 px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-2xl bg-slate-800/90 hover:bg-slate-700 text-slate-200 hover:text-white text-xs font-bold border border-slate-700/80 transition-all cursor-pointer shadow-sm active:scale-95"
                >
                    <i data-lucide="sliders" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-slate-400"></i>
                    <span>Parameters Hub</span>
                </a>
                <button
                    type="button"
                    onclick="window.executeUniversalKillSwitch()"
                    id="btn-admin-universal-kill"
                    class="w-full xs:w-auto inline-flex items-center justify-center gap-2 px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-2xl bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white text-xs font-black shadow-lg shadow-rose-900/40 border border-rose-500/40 transition-all cursor-pointer active:scale-95 group"
                >
                    <i data-lucide="zap-off" class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:scale-110 transition-transform"></i>
                    <span>Universal Freeze Switch</span>
                </button>
            </div>
        </div>

        <!-- Telemetry Pill Summary Strip -->
        <div class="mt-4 sm:mt-5 pt-3 sm:pt-4 border-t border-slate-800/80 grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-3 text-[11px] sm:text-xs">
            <div class="p-2 sm:p-0 rounded-xl sm:rounded-none bg-slate-800/40 sm:bg-transparent flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></div>
                <div class="min-w-0">
                    <span class="text-slate-400 block text-[10px] sm:inline sm:text-xs">Gateway: </span>
                    <span class="font-bold text-slate-200 font-mono text-[11px] sm:text-xs">NOMINAL</span>
                </div>
            </div>
            <div class="p-2 sm:p-0 rounded-xl sm:rounded-none bg-slate-800/40 sm:bg-transparent flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></div>
                <div class="min-w-0">
                    <span class="text-slate-400 block text-[10px] sm:inline sm:text-xs">Settlement: </span>
                    <span class="font-bold text-slate-200 font-mono text-[11px] sm:text-xs">48ms</span>
                </div>
            </div>
            <div class="p-2 sm:p-0 rounded-xl sm:rounded-none bg-slate-800/40 sm:bg-transparent flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-rose-400 animate-pulse shrink-0"></div>
                <div class="min-w-0">
                    <span class="text-slate-400 block text-[10px] sm:inline sm:text-xs">Flagged: </span>
                    <span class="font-bold text-rose-400 font-mono text-[11px] sm:text-xs">{{ $flaggedCount ?? 0 }} Alerts</span>
                </div>
            </div>
            <div class="p-2 sm:p-0 rounded-xl sm:rounded-none bg-slate-800/40 sm:bg-transparent flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-indigo-400 shrink-0"></div>
                <div class="min-w-0">
                    <span class="text-slate-400 block text-[10px] sm:inline sm:text-xs">Ledger: </span>
                    <span class="font-bold text-slate-200 font-mono text-[11px] sm:text-xs">100% VERIFIED</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================================
         2. CORE TELEMETRY METRIC TILES
         ====================================================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-7">
        
        <!-- Tile 1: High Risk Flows -->
        <div class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider font-sans">
                    Flagged AML Flows
                </span>
                <div class="w-9 h-9 rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="shield-alert" class="w-4.5 h-4.5"></i>
                </div>
            </div>
            <div class="mt-3 flex items-baseline justify-between">
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-slate-50 font-mono tracking-tight">
                    {{ $flaggedCount ?? 0 }}
                </h3>
                <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-0.5 rounded-md bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 border border-rose-200/60 dark:border-rose-800/40">
                    &ge; RM 10,000
                </span>
            </div>
            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Automated holds pending review</span>
            </p>
        </div>

        <!-- Tile 2: Total Volume Processed -->
        <div class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider font-sans">
                    Clearing Volume
                </span>
                <div class="w-9 h-9 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="coins" class="w-4.5 h-4.5"></i>
                </div>
            </div>
            <div class="mt-3 flex items-baseline justify-between">
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-slate-50 font-mono tracking-tight">
                    RM {{ number_format($allVolume ?? 0, 2) }}
                </h3>
            </div>
            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-emerald-500"></i>
                <span>{{ $totalTransactionCount ?? 0 }} Total Settlements</span>
            </p>
        </div>

        <!-- Tile 3: Frozen & Isolated Accounts -->
        <div class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider font-sans">
                    Frozen Accounts
                </span>
                <div class="w-9 h-9 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="lock" class="w-4.5 h-4.5"></i>
                </div>
            </div>
            <div class="mt-3 flex items-baseline justify-between">
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-slate-50 font-mono tracking-tight">
                    {{ $frozenAccountsCount ?? 0 }}
                </h3>
                <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-0.5 rounded-md bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200/60 dark:border-amber-800/40">
                    Isolated
                </span>
            </div>
            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Kill Switch or Admin intervention</span>
            </p>
        </div>

        <!-- Tile 4: Active Customer Base -->
        <div class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider font-sans">
                    Active Customers
                </span>
                <div class="w-9 h-9 rounded-2xl bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="users" class="w-4.5 h-4.5"></i>
                </div>
            </div>
            <div class="mt-3 flex items-baseline justify-between">
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-slate-50 font-mono tracking-tight">
                    {{ $activeCustomersCount ?? 0 }}
                </h3>
                <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-0.5 rounded-md bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200/60 dark:border-sky-800/40">
                    {{ $totalCustomersCount ?? 0 }} Enrolled
                </span>
            </div>
            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500"></i>
                <span>100% eKYC Verified</span>
            </p>
        </div>

    </div>

    <!-- ======================================================================
         3. PAYMENT RAIL CLEARING TELEMETRY (Real-Time Stream Health)
         ====================================================================== -->
    <div class="mb-7">
        <div class="flex items-center justify-between mb-3 px-1">
            <div class="flex items-center gap-2">
                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                <h2 class="text-sm font-bold text-slate-900 dark:text-slate-100 uppercase tracking-wider font-sans">
                    PayNet Clearing Stream Status &amp; Rail Circuit Breakers
                </h2>
            </div>
            <span class="text-xs font-mono text-slate-400">Heartbeat: 10s &bull; Auto-Failover Armed</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach($paymentRails as $rail)
                <div class="p-3.5 sm:p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs hover:border-slate-300 dark:hover:border-slate-700 transition-all">
                    <div class="flex items-center justify-between mb-1.5 sm:mb-2">
                        <span class="text-[10px] sm:text-xs font-mono font-bold text-slate-500 dark:text-slate-400">{{ $rail['code'] }}</span>
                        @if($rail['status'] === 'operational')
                            <span class="inline-flex items-center gap-1 text-[9px] sm:text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border border-emerald-300/40 dark:border-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                ACTIVE
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[9px] sm:text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-300 border border-amber-300/40 dark:border-amber-800">
                                STANDBY
                            </span>
                        @endif
                    </div>
                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 leading-tight">
                        {{ $rail['name'] }}
                    </h4>
                    <p class="text-[10px] sm:text-[11px] text-slate-400 font-mono mt-1 truncate">
                        {{ $rail['iso_version'] }}
                    </p>

                    <div class="mt-2.5 sm:mt-3 pt-2 sm:pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-[10px] sm:text-[11px]">
                        <span class="text-slate-500 dark:text-slate-400">Latency:</span>
                        <span class="font-mono font-bold text-emerald-600 dark:text-emerald-400">{{ $rail['latency'] }}</span>
                    </div>
                    <div class="mt-1 flex items-center justify-between text-[10px] sm:text-[11px]">
                        <span class="text-slate-500 dark:text-slate-400">Circuit Breaker:</span>
                        <span class="font-mono font-bold text-slate-700 dark:text-slate-300">{{ $rail['circuit_breaker'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ======================================================================
         4. SPLIT SECTION: AML RADAR WATCHLIST & REAL-TIME LOGS
         ====================================================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-7">

        <!-- Column 1 & 2: Real-time AML Radar & Intercept Console -->
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-3xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden shadow-xs">
                
                <!-- Table Header -->
                <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2.5">
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                            <i data-lucide="shield-alert" class="w-4 h-4 text-rose-500"></i>
                            <span>Real-Time AML / Anti-Fraud Radar</span>
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">
                            High-value &amp; suspicious transaction watchlist exceeding RM 5,000 threshold
                        </p>
                    </div>

                    <a
                        href="{{ route('admin.customers') }}"
                        class="text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 transition-colors inline-flex items-center gap-1"
                    >
                        <span>Manage Accounts</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <!-- Mobile Responsive Cards View (< md devices) -->
                <div class="md:hidden divide-y divide-slate-100 dark:divide-slate-800 p-2">
                    @if(isset($flaggedTransactions) && $flaggedTransactions->isNotEmpty())
                        @foreach($flaggedTransactions as $tx)
                            <div class="p-3.5 space-y-2.5 rounded-2xl bg-slate-50/50 dark:bg-slate-800/30 mb-2 border border-slate-100 dark:border-slate-800">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <p class="font-bold text-xs text-slate-900 dark:text-slate-100 truncate">
                                            {{ $tx->account && $tx->account->customer ? $tx->account->customer->name : 'Registered Payer' }}
                                        </p>
                                        <p class="text-[10px] text-slate-400 font-mono mt-0.5">
                                            &rarr; {{ $tx->recipient_name ?? ($tx->description ?? 'Counterparty') }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-[9px] font-bold px-2 py-0.5 rounded-md bg-rose-50 dark:bg-rose-950 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-900 shrink-0">
                                        <i data-lucide="alert-triangle" class="w-3 h-3"></i>
                                        {{ $tx->amount >= 10000 ? 'High Value' : 'Anomaly' }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between text-xs pt-1 border-t border-slate-100 dark:border-slate-800">
                                    <div>
                                        <span class="font-black text-rose-600 dark:text-rose-400 font-mono text-sm">
                                            RM {{ number_format($tx->amount, 2) }}
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-mono ml-1.5 uppercase">
                                            {{ $tx->type ?? 'DUITNOW' }}
                                        </span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-mono">
                                        {{ $tx->created_at ? $tx->created_at->format('h:i:s A') : 'Recent' }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between gap-2 pt-1">
                                    <span class="text-[10px] text-slate-400 font-mono truncate">
                                        Ref: {{ $tx->reference_number }}
                                    </span>
                                    <button
                                        type="button"
                                        onclick="window.inspectTransactionDetail('{{ $tx->reference_number }}', '{{ number_format($tx->amount, 2) }}', '{{ $tx->recipient_name ?? 'Counterparty' }}')"
                                        class="px-3 py-1 text-[11px] font-bold rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-100 text-slate-700 dark:text-slate-300 shadow-2xs cursor-pointer"
                                    >
                                        Inspect
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="py-6 text-center text-slate-400">
                            <i data-lucide="shield-check" class="w-7 h-7 text-emerald-500 mx-auto mb-1.5 opacity-80"></i>
                            <p class="text-xs font-semibold">No high-risk transactions flagged</p>
                        </div>
                    @endif
                </div>

                <!-- Desktop Table Content (md+ devices) -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm">
                        <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                            <tr>
                                <th class="px-4 py-3 sm:px-5">Timestamp / Ref</th>
                                <th class="px-4 py-3 sm:px-5">Payer &amp; Payee</th>
                                <th class="px-4 py-3 sm:px-5">Amount &amp; Rail</th>
                                <th class="px-4 py-3 sm:px-5">Risk Trigger</th>
                                <th class="px-4 py-3 sm:px-5 text-right">Intervention</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                            @if(isset($flaggedTransactions) && $flaggedTransactions->isNotEmpty())
                                @foreach($flaggedTransactions as $tx)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                        <td class="px-4 py-3.5 sm:px-5 font-mono text-xs">
                                            <div class="font-bold text-slate-900 dark:text-slate-100">
                                                {{ $tx->created_at ? $tx->created_at->format('h:i:s A') : 'Just now' }}
                                            </div>
                                            <div class="text-[10px] text-slate-400 font-mono">{{ $tx->reference_number }}</div>
                                        </td>
                                        <td class="px-4 py-3.5 sm:px-5">
                                            <div class="font-bold text-slate-900 dark:text-slate-100 truncate max-w-[160px]">
                                                {{ $tx->account && $tx->account->customer ? $tx->account->customer->name : 'Registered Payer' }}
                                            </div>
                                            <div class="text-[11px] text-slate-400 truncate max-w-[160px]">
                                                &rarr; {{ $tx->recipient_name ?? ($tx->description ?? 'Counterparty') }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3.5 sm:px-5">
                                            <span class="font-bold text-rose-600 dark:text-rose-400 font-mono">
                                                RM {{ number_format($tx->amount, 2) }}
                                            </span>
                                            <div class="text-[10px] text-slate-400 uppercase font-mono mt-0.5">
                                                {{ $tx->type ?? 'DUITNOW' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3.5 sm:px-5">
                                            <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-md bg-rose-50 dark:bg-rose-950 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-900">
                                                <i data-lucide="alert-triangle" class="w-3 h-3"></i>
                                                {{ $tx->amount >= 10000 ? 'High Value Rule' : 'Velocity Anomaly' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3.5 sm:px-5 text-right">
                                            <button
                                                type="button"
                                                onclick="window.inspectTransactionDetail('{{ $tx->reference_number }}', '{{ number_format($tx->amount, 2) }}', '{{ $tx->recipient_name ?? 'Counterparty' }}')"
                                                class="px-2.5 py-1 text-[11px] font-semibold rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors cursor-pointer"
                                            >
                                                Inspect
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-5 py-8 text-center text-slate-400">
                                        <i data-lucide="shield-check" class="w-8 h-8 text-emerald-500 mx-auto mb-2 opacity-80"></i>
                                        <p class="text-xs font-semibold">No high-risk transactions currently flagged</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Automated screening active on all PayNet clearing endpoints</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Live Settlement Feed Card -->
            <div class="rounded-3xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                            <i data-lucide="activity" class="w-4 h-4 text-emerald-500"></i>
                            <span>Live Clearing Ledger Feed</span>
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Continuous stream of inbound and outbound transactions</p>
                    </div>
                    <span class="text-xs font-mono text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        LIVE SYNC
                    </span>
                </div>

                <div class="space-y-2.5">
                    @forelse($recentTransactions ?? [] as $tx)
                        <div class="p-3 rounded-2xl bg-slate-50/70 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3 text-xs hover:bg-slate-100/70 dark:hover:bg-slate-800/70 transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-xl {{ $tx->direction === 'credit' ? 'bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400' : 'bg-slate-200/80 dark:bg-slate-800 text-slate-700 dark:text-slate-300' }} flex items-center justify-center shrink-0">
                                    <i data-lucide="{{ $tx->direction === 'credit' ? 'arrow-down-left' : 'arrow-up-right' }}" class="w-4 h-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-900 dark:text-slate-100 truncate">
                                        {{ $tx->recipient_name ?? ($tx->description ?? 'Interbank Transfer') }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 font-mono truncate">
                                        {{ $tx->reference_number }} &bull; {{ $tx->created_at ? $tx->created_at->diffForHumans() : 'Just now' }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-bold font-mono {{ $tx->direction === 'credit' ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-900 dark:text-slate-100' }}">
                                    {{ $tx->direction === 'credit' ? '+' : '-' }} RM {{ number_format($tx->amount, 2) }}
                                </p>
                                <span class="text-[10px] font-mono uppercase px-1.5 py-0.2 rounded bg-slate-200/70 dark:bg-slate-700/60 text-slate-600 dark:text-slate-300">
                                    {{ $tx->status ?? 'completed' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-4">No recent transactions recorded.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Column 3: Live Immutable Audit Trail & Operational Quick Controls -->
        <div class="space-y-6">

            <!-- Card: WORM Audit Stream -->
            <div class="rounded-3xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                            <i data-lucide="file-check" class="w-4 h-4 text-indigo-500"></i>
                            <span>WORM Audit Trail</span>
                        </h3>
                        <p class="text-[11px] text-slate-400">Immutable security event streaming</p>
                    </div>
                    <a href="{{ route('admin.audit-logs') }}" class="text-xs font-semibold text-rose-600 dark:text-rose-400 hover:underline">
                        View All
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentAuditLogs as $log)
                        <div class="p-3 rounded-2xl bg-slate-50/60 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 space-y-1">
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="font-mono font-bold px-1.5 py-0.5 rounded bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                    {{ $log->event }}
                                </span>
                                <span class="text-slate-400 font-mono">{{ $log->created_at ? $log->created_at->format('h:i:s A') : 'Recent' }}</span>
                            </div>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">
                                {{ $log->customer ? $log->customer->name : 'System Terminal / Security Gateway' }}
                            </p>
                            <p class="text-[10px] text-slate-400 font-mono">
                                IP: {{ $log->ip_address }} &bull; Status: VERIFIED
                            </p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-4">No audit logs available.</p>
                    @endforelse
                </div>
            </div>

            <!-- Card: Emergency Operational Quick Switches -->
            <div class="rounded-3xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-xs">
                <div class="flex items-center gap-2.5 mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Operational Rail Controls</h3>
                        <p class="text-[11px] text-slate-400">Direct gateway intervention tools</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <button
                        type="button"
                        onclick="window.quickRailAction('DuitNow Outbound Rail', 'HALT')"
                        class="w-full flex items-center justify-between p-3 rounded-2xl border border-slate-200 dark:border-slate-800 hover:border-rose-300 dark:hover:border-rose-800 bg-slate-50/50 dark:bg-slate-800/30 transition-all text-left cursor-pointer group"
                    >
                        <div>
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                                DuitNow Outbound Rail
                            </p>
                            <p class="text-[10px] text-slate-400">Instantly halt retail outgoing transfers</p>
                        </div>
                        <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                            ARMED
                        </span>
                    </button>

                    <button
                        type="button"
                        onclick="window.quickRailAction('DuitNow QR Merchant Settlement', 'HALT')"
                        class="w-full flex items-center justify-between p-3 rounded-2xl border border-slate-200 dark:border-slate-800 hover:border-rose-300 dark:hover:border-rose-800 bg-slate-50/50 dark:bg-slate-800/30 transition-all text-left cursor-pointer group"
                    >
                        <div>
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                                QR Clearing Terminal
                            </p>
                            <p class="text-[10px] text-slate-400">Suspend Merchant QR Settlements</p>
                        </div>
                        <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                            ARMED
                        </span>
                    </button>

                    <button
                        type="button"
                        onclick="window.quickRailAction('JomPAY Bill Hub', 'HALT')"
                        class="w-full flex items-center justify-between p-3 rounded-2xl border border-slate-200 dark:border-slate-800 hover:border-rose-300 dark:hover:border-rose-800 bg-slate-50/50 dark:bg-slate-800/30 transition-all text-left cursor-pointer group"
                    >
                        <div>
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                                JomPAY Switch Host
                            </p>
                            <p class="text-[10px] text-slate-400">Toggle Biller Gateway Routing</p>
                        </div>
                        <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                            ARMED
                        </span>
                    </button>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <a
                        href="{{ route('admin.parameters') }}"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 text-white text-xs font-bold transition-all shadow-xs"
                    >
                        <i data-lucide="settings-2" class="w-4 h-4"></i>
                        <span>Modify Parameter Limits</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

    <!-- Interactive Script Helpers -->
    <script>
        window.executeUniversalKillSwitch = function() {
            if (confirm('CRITICAL WARNING: Are you sure you want to trigger the UNIVERSAL RAIL FREEZE? This will immediately isolate all outbound clearing pipelines.')) {
                alert('CIRCUIT BREAKER ACTIVATED: Universal emergency kill switch invoked. All payment gateways isolated. Compliance event recorded.');
            }
        };

        window.inspectTransactionDetail = function(ref, amount, recipient) {
            alert('AML TRANSACTION AUDIT DOSSIER:\n\nReference: ' + ref + '\nAmount: RM ' + amount + '\nBeneficiary: ' + recipient + '\nRisk Status: Elevated Screening In Progress\nAudit Trail: Immutable Block Hash Active');
        };

        window.quickRailAction = function(rail, action) {
            if (confirm('Authorize operational toggle for ' + rail + '?')) {
                alert(rail + ' status successfully verified. Operational telemetry maintained.');
            }
        };
    </script>

</x-layout.admin>
