<x-layout.admin title="Compliance Audit Logs — BankFlow MY" activeNav="audit">

    <div class="space-y-6">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm animate__animated animate__fadeInDown">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-rose-100 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0 border border-rose-200/60 dark:border-rose-800/60 shadow-2xs">
                    <i data-lucide="file-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <h1 class="text-base sm:text-lg font-black text-slate-900 dark:text-slate-100 tracking-tight">
                        WORM Compliance Audit Trail
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                        Write Once, Read Many (WORM) immutable event streaming for security compliance and audit oversight.
                    </p>
                </div>
            </div>
        </div>

        <!-- Reusable Search & Filter Component Section -->
        <x-ui.search-filter
            :action="route('admin.audit-logs')"
            :search="request('search', '')"
            searchPlaceholder="Search event type, target user, NRIC, or origin IP..."
            :resetUrl="route('admin.audit-logs')"
            :activeFiltersCount="request()->filled('event') ? 1 : 0"
            :totalResults="$logs->total()"
            totalLabel="immutable audit records"
            focusRing="rose"
        >
            <x-slot:filters>
                <div class="sm:w-56">
                    <select
                        name="event"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 focus:outline-rose-500"
                    >
                        <option value="">All Event Categories</option>
                        <option value="SYSTEM_PARAMETER_MODIFIED" {{ request('event') === 'SYSTEM_PARAMETER_MODIFIED' ? 'selected' : '' }}>System Parameters</option>
                        <option value="EMERGENCY_KILL_SWITCH" {{ request('event') === 'EMERGENCY_KILL_SWITCH' ? 'selected' : '' }}>Emergency Kill Switch</option>
                        <option value="ADMIN_CUSTOMER" {{ request('event') === 'ADMIN_CUSTOMER' ? 'selected' : '' }}>Admin Account Freeze</option>
                        <option value="ADMIN_LOGIN" {{ request('event') === 'ADMIN_LOGIN' ? 'selected' : '' }}>Admin Session Events</option>
                    </select>
                </div>
            </x-slot:filters>
        </x-ui.search-filter>

        <!-- Audit Log Table -->
        <div class="rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                        <tr>
                            <th class="px-4 py-3">Timestamp</th>
                            <th class="px-4 py-3">Event Type</th>
                            <th class="px-4 py-3">Target / Actor</th>
                            <th class="px-4 py-3">Metadata &amp; Invariants</th>
                            <th class="px-4 py-3">Origin IP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @foreach($logs as $log)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="px-4 py-3 font-mono text-xs text-slate-500 whitespace-nowrap">
                                    {{ $log->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md font-mono text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                        {{ $log->event }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">
                                    {{ $log->customer ? $log->customer->name : 'System / Global' }}
                                </td>
                                <td class="px-4 py-3 font-mono text-[11px] text-slate-500 max-w-xs truncate">
                                    {{ json_encode($log->details) }}
                                </td>
                                <td class="px-4 py-3 font-mono text-xs text-slate-400">
                                    {{ $log->ip_address ?? '127.0.0.1' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($logs->hasPages())
                <div class="p-3 border-t border-slate-100 dark:border-slate-800">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>

    </div>

</x-layout.admin>
