<x-layout.staff title="BankFlow MY — Staff Service Desk & Branch Operations" activeNav="desk">

    <!-- Top Alert / Session Status -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/70 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.364a4.125 4.125 0 00-6.338 0 .375.375 0 01-.58-.337 5.25 5.25 0 0110.5 0 .375.375 0 01-.582.337z" />
                </svg>
            </div>
            <div>
                <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100">
                    Branch Customer Queue & Service Desk
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Counter 04 &bull; Menara BankFlow, Jalan Tun Perak, Kuala Lumpur
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                JPN MyKad Biometric Online
            </span>
        </div>
    </div>

    <!-- Metrics Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <x-ui.stat-card
            title="Pending eKYC Reviews"
            value="14 Profiles"
            trend="-3"
            trendType="down"
            subtitle="Target SLA: < 15 mins"
        />
        <x-ui.stat-card
            title="Active 12h Cooling Holds"
            value="28 Holds"
            subtitle="Limit upgrades & devices"
        />
        <x-ui.stat-card
            title="Branch Enquiries Today"
            value="86 Served"
            trend="+12%"
            trendType="up"
            subtitle="Avg. handle: 4.2m"
        />
        <x-ui.stat-card
            title="Assisted DuitNow NAD"
            value="19 Proxies"
            subtitle="100% verified via MyKad"
        />
    </div>

    <!-- Active Service Table -->
    <div class="space-y-6">
        <x-ui.card
            title="Active Customer Identity Verification Queue"
            subtitle="Assisted on-boarding, eKYC 3D facial liveness review, and device re-binding requests"
            padding="none"
        >
            <x-slot:action>
                <x-ui.button variant="outline" size="xs">
                    Refresh Queue
                </x-ui.button>
            </x-slot:action>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                        <tr>
                            <th class="px-4 py-3 sm:px-6">Customer Name / MyKad</th>
                            <th class="px-4 py-3 sm:px-6">Request Type</th>
                            <th class="px-4 py-3 sm:px-6">Verification Channel</th>
                            <th class="px-4 py-3 sm:px-6">Cooling Status</th>
                            <th class="px-4 py-3 sm:px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-4 py-3.5 sm:px-6 font-medium text-slate-900 dark:text-slate-100">
                                <div>Ahmad Daniel Bin Alif</div>
                                <div class="text-xs text-slate-400 font-mono">930412-14-5555</div>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <span class="font-medium">Device Re-binding</span>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <x-ui.badge variant="info">Mobile eKYC</x-ui.badge>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <span class="text-xs font-mono text-amber-600 dark:text-amber-400 font-semibold">11h 24m remaining</span>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.button variant="primary" size="xs">
                                    Review Docs
                                </x-ui.button>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-4 py-3.5 sm:px-6 font-medium text-slate-900 dark:text-slate-100">
                                <div>NURUL HUDA BINTI ISMAIL</div>
                                <div class="text-xs text-slate-400 font-mono">880922-10-6124</div>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <span class="font-medium">New Account-i Onboarding</span>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <x-ui.badge variant="success" dot>Branch Verified</x-ui.badge>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <span class="text-xs text-slate-400">Not Applicable</span>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.button variant="secondary" size="xs">
                                    Approved
                                </x-ui.button>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-4 py-3.5 sm:px-6 font-medium text-slate-900 dark:text-slate-100">
                                <div>TAN WEI JIE</div>
                                <div class="text-xs text-slate-400 font-mono">950311-08-5911</div>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <span class="font-medium">Limit Increase (RM 20k)</span>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <x-ui.badge variant="purple">Web Portal OOB</x-ui.badge>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6">
                                <span class="text-xs font-mono text-amber-600 dark:text-amber-400 font-semibold">04h 12m remaining</span>
                            </td>
                            <td class="px-4 py-3.5 sm:px-6 text-right">
                                <x-ui.button variant="outline" size="xs">
                                    Audit Trail
                                </x-ui.button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </div>

</x-layout.staff>
