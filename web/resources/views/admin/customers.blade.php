<x-layout.admin title="Customer Accounts Administration — BankFlow MY" activeNav="customers">

    <div class="space-y-6">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm animate__animated animate__fadeInDown">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-rose-100 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0 border border-rose-200/60 dark:border-rose-800/60 shadow-2xs">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <div>
                    <h1 class="text-base sm:text-lg font-black text-slate-900 dark:text-slate-100 tracking-tight">
                        Customer Account Administration
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                        Inspect customer balances, active status, card bindings, and perform administrative suspensions.
                    </p>
                </div>
            </div>
        </div>

        <!-- Reusable Search & Filter Component Section -->
        <x-ui.search-filter
            :action="route('admin.customers')"
            :search="request('search', '')"
            searchPlaceholder="Search customer name, NRIC, username, email, phone..."
            :resetUrl="route('admin.customers')"
            :activeFiltersCount="request()->filled('status') ? 1 : 0"
            :totalResults="$customers->total()"
            totalLabel="registered customer accounts"
            focusRing="rose"
        >
            <x-slot:filters>
                <div class="sm:w-44">
                    <select
                        name="status"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 focus:outline-rose-500"
                    >
                        <option value="">All Account Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active Only</option>
                        <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended / Frozen</option>
                    </select>
                </div>
            </x-slot:filters>
        </x-ui.search-filter>

        <!-- Customer List Table -->
        <div class="rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                        <tr>
                            <th class="px-4 py-3">Customer Profile</th>
                            <th class="px-4 py-3">NRIC / Identification</th>
                            <th class="px-4 py-3">Deposit Account</th>
                            <th class="px-4 py-3">Total Balance</th>
                            <th class="px-4 py-3">Account Status</th>
                            <th class="px-4 py-3 text-right">Intervention</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @foreach($customers as $c)
                            @php
                                $acc = $c->accounts->first();
                            @endphp
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="px-4 py-3.5">
                                    <div class="font-bold text-slate-900 dark:text-slate-100">{{ $c->name }}</div>
                                    <div class="text-[11px] text-slate-400 font-mono">&#64;{{ $c->username }} &bull; {{ $c->phone_number }}</div>
                                </td>
                                <td class="px-4 py-3.5 font-mono text-xs text-slate-600 dark:text-slate-300">
                                    {{ $c->nric }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="font-mono text-xs font-semibold text-slate-900 dark:text-slate-100">
                                        {{ $acc ? $acc->account_number : 'No Active Account' }}
                                    </div>
                                    <div class="text-[10px] text-slate-400">{{ $acc ? $acc->account_name : '-' }}</div>
                                </td>
                                <td class="px-4 py-3.5 font-mono font-bold text-slate-900 dark:text-slate-100">
                                    RM {{ number_format($acc ? $acc->balance : 0, 2) }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $c->status === 'active' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-rose-50 text-rose-700 dark:bg-rose-950 dark:text-rose-300' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $c->status === 'active' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                        {{ ucfirst($c->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-right">
                                    <button
                                        type="button"
                                        onclick="window.toggleCustomerFreeze({{ $c->id }}, '{{ $c->status }}')"
                                        class="px-3 py-1 text-[11px] font-bold rounded-xl border {{ $c->status === 'active' ? 'border-rose-200 text-rose-600 hover:bg-rose-50 dark:border-rose-900/60 dark:text-rose-400' : 'border-emerald-200 text-emerald-600 hover:bg-emerald-50 dark:border-emerald-900/60 dark:text-emerald-400' }} transition-colors cursor-pointer"
                                    >
                                        {{ $c->status === 'active' ? 'Freeze / Suspend' : 'Reactivate Access' }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($customers->hasPages())
                <div class="p-3 border-t border-slate-100 dark:border-slate-800">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>

    </div>

    <script>
    (function() {
        const csrfToken = '{{ csrf_token() }}';

        window.toggleCustomerFreeze = function(customerId, currentStatus) {
            const action = currentStatus === 'active' ? 'SUSPEND and FREEZE' : 'REACTIVATE';
            if (!confirm(`Are you sure you want to ${action} this customer account?`)) {
                return;
            }

            fetch(`/admin/customers/${customerId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                window.location.reload();
            });
        };
    })();
    </script>

</x-layout.admin>
