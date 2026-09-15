<x-layout.admin title="Enterprise Admin & Fraud Operations — BankFlow MY" activeNav="fraud">

    <!-- Top Threat Level Alert -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 sm:p-5 rounded-2xl bg-slate-900 border border-slate-800 text-white shadow-xl animate__animated animate__fadeInDown">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 border border-rose-500/30 shadow-inner">
                <i data-lucide="shield-alert" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-sm sm:text-base font-bold text-white flex items-center gap-2">
                    Real-Time AML / Anti-Fraud Radar &amp; Kill Switch Center
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">
                    PayNet ISO 20022 Clearing Stream &bull; Mule Account Detection &bull; NSRC 997 Direct Intercept Active
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a
                href="{{ route('admin.parameters') }}"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-all cursor-pointer"
            >
                <i data-lucide="sliders" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Configure Parameters</span>
            </a>
            <button
                type="button"
                onclick="alert('BROADCAST CIRCUIT BREAKER: Universal PayNet Outbound rail freeze test simulated.');"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold shadow-md shadow-rose-600/30 transition-all cursor-pointer"
            >
                <i data-lucide="zap-off" class="w-3.5 h-3.5"></i>
                <span>Universal Freeze Switch</span>
            </button>
        </div>
    </div>

    <!-- Telemetry Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <x-ui.stat-card
            title="High-Risk Flagged Flows"
            value="{{ $flaggedCount ?? 3 }} Transfers"
            trend="+1 (Last 1h)"
            trendType="down"
            subtitle="Transactions >= RM 10,000"
        />
        <x-ui.stat-card
            title="Frozen Accounts"
            value="{{ $frozenAccountsCount ?? 0 }} Locked"
            subtitle="Kill Switch or Admin intervention"
        />
        <x-ui.stat-card
            title="NSRC Golden Hour Intercepts"
            value="100% Intercepted"
            trend="Active"
            trendType="up"
            subtitle="Rapid mule account freeze"
        />
        <x-ui.stat-card
            title="WORM Ledger Invariants"
            value="100% Verified"
            subtitle="Immutable Audit Log Active"
        />
    </div>

    <!-- Active AML Incidents Table -->
    <div class="space-y-6">
        <x-ui.card
            title="Real-Time Automated Fraud & Scam Intercept Radar"
            subtitle="Immediate PayNet transaction halts requiring senior fraud analyst review"
            padding="none"
        >
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                        <tr>
                            <th class="px-4 py-3 sm:px-6">Timestamp / Ref</th>
                            <th class="px-4 py-3 sm:px-6">Payer &amp; Beneficiary</th>
                            <th class="px-4 py-3 sm:px-6">Amount &amp; Channel</th>
                            <th class="px-4 py-3 sm:px-6">Risk Trigger</th>
                            <th class="px-4 py-3 sm:px-6 text-right">Intervention</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @if(isset($flaggedTransactions) && $flaggedTransactions->isNotEmpty())
                            @foreach($flaggedTransactions as $tx)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                    <td class="px-4 py-3.5 sm:px-6 font-mono text-xs">
                                        <div>{{ $tx->created_at ? $tx->created_at->format('h:i:s A') : 'Just now' }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $tx->reference_number }}</div>
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6">
                                        <div class="font-bold text-slate-900 dark:text-slate-100">
                                            {{ $tx->account && $tx->account->customer ? $tx->account->customer->name : 'Consumer Account' }}
                                        </div>
                                        <div class="text-xs text-slate-400">&rarr; {{ $tx->recipient_name ?? $tx->description }}</div>
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6">
                                        <span class="font-bold text-rose-600 dark:text-rose-400 font-mono">RM {{ number_format($tx->amount, 2) }}</span>
                                        <div class="text-xs text-slate-400">{{ ucfirst(str_replace('_', ' ', $tx->transaction_type)) }}</div>
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6">
                                        <x-ui.badge variant="{{ $tx->amount >= 10000 ? 'danger' : 'warning' }}" dot>
                                            {{ $tx->amount >= 10000 ? 'High-Value Flow (>RM10k)' : 'First-time Payee Hold' }}
                                        </x-ui.badge>
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 text-right space-x-1">
                                        <button
                                            type="button"
                                            onclick="alert('Intervention logged for reference: {{ $tx->reference_number }}');"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-500 text-white text-[11px] font-bold cursor-pointer"
                                        >
                                            <i data-lucide="shield" class="w-3 h-3"></i>
                                            <span>Inspect Flow</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="px-4 py-3.5 sm:px-6 font-mono text-xs">
                                    <div>11:14:02 AM</div>
                                    <div class="text-[10px] text-slate-400">TXN-8819201</div>
                                </td>
                                <td class="px-4 py-3.5 sm:px-6">
                                    <div class="font-bold text-slate-900 dark:text-slate-100">KHOR KENG HIN</div>
                                    <div class="text-xs text-slate-400">&rarr; Unknown Beneficiary (Mule Pattern)</div>
                                </td>
                                <td class="px-4 py-3.5 sm:px-6">
                                    <span class="font-bold text-rose-600 dark:text-rose-400">RM 45,000.00</span>
                                    <div class="text-xs text-slate-400">DuitNow Instant</div>
                                </td>
                                <td class="px-4 py-3.5 sm:px-6">
                                    <x-ui.badge variant="danger" dot>New Device + Limit Bump</x-ui.badge>
                                </td>
                                <td class="px-4 py-3.5 sm:px-6 text-right space-x-1">
                                    <button type="button" class="px-2.5 py-1.5 rounded-lg bg-rose-600 text-white text-[11px] font-bold" onclick="alert('Transaction Blocked & Account Intercepted');">
                                        Halt &amp; Freeze
                                    </button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </div>

</x-layout.admin>
