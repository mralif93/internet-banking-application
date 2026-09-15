<x-layout.admin title="BankFlow MY — Enterprise Admin & Fraud Operations Center" activeNav="fraud">

    <!-- Top Threat Level Alert -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 rounded-2xl bg-slate-900 border border-slate-800 text-white shadow-lg animate__animated animate__fadeInDown">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 border border-rose-500/30">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                </svg>
            </div>
            <div>
                <h2 class="text-sm sm:text-base font-bold text-white flex items-center gap-2">
                    Real-Time AML / Anti-Fraud Radar & Kill Switch Center
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                </h2>
                <p class="text-xs text-slate-400">
                    PayNet ISO 20022 Clearing Stream &bull; Mule Account Detection &bull; NSRC Link Active
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <x-ui.button
                type="button"
                variant="danger"
                size="sm"
                onclick="alert('BROADCAST CIRCUIT BREAKER: Universal PayNet Outbound rail freeze test simulated.');"
                class="shadow-md"
            >
                Emergency Broadcast Freeze
            </x-ui.button>
        </div>
    </div>

    <!-- Telemetry Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <x-ui.stat-card
            title="High-Risk Flagged Flows"
            value="3 Transfers"
            trend="+1 (Last 1h)"
            trendType="down"
            subtitle="Rapid multi-recipient velocity"
        />
        <x-ui.stat-card
            title="Active Account Kill Switches"
            value="12 Locked"
            subtitle="Frozen via customer/staff"
        />
        <x-ui.stat-card
            title="NSRC Golden Hour Traces"
            value="4 Direct"
            trend="100% Intercepted"
            trendType="up"
            subtitle="Mule accounts frozen < 15m"
        />
        <x-ui.stat-card
            title="WORM Ledger Invariants"
            value="100% Verified"
            subtitle="Zero tamper anomalies"
        />
    </div>

    <!-- Active AML Incidents Table -->
    <div class="space-y-6">
        <x-ui.card
            title="Real-Time Automated Fraud & Scam Intercept Radar"
            subtitle="Immediate PayNet transaction halts requiring senior fraud analyst sign-off"
            padding="none"
        >
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                        <tr>
                            <th class="px-4 py-3 sm:px-6">Timestamp / Tx ID</th>
                            <th class="px-4 py-3 sm:px-6">Payer & Beneficiary</th>
                            <th class="px-4 py-3 sm:px-6">Amount & Channel</th>
                            <th class="px-4 py-3 sm:px-6">Trigger Reason</th>
                            <th class="px-4 py-3 sm:px-6 text-right">Intervention</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
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
                                <x-ui.button variant="danger" size="xs" onclick="alert('Transaction Blocked & Account Intercepted');">
                                    Halt & Freeze
                                </x-ui.button>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-4 py-3.5 sm:px-6 font-mono text-xs">
                                <div>10:52:19 AM</div>
                                <div class="text-[10px] text-slate-400">TXN-7721839</div>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <div class="font-bold text-slate-900 dark:text-slate-100">ROSLAN BIN MAHMUD</div>
                                <div class="text-xs text-slate-400">&rarr; Foreign E-Wallet Merchant</div>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <span class="font-bold text-slate-900 dark:text-slate-100">RM 12,500.00</span>
                                <div class="text-xs text-slate-400">Cross-Border QR</div>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <x-ui.badge variant="warning" dot>Anomalous GeoIP</x-ui.badge>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right space-x-1">
                                <x-ui.button variant="outline" size="xs">
                                    Investigate
                                </x-ui.button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </div>

</x-layout.admin>
