<x-layout.admin title="PayNet Participating Banks — BankFlow MY" activeNav="banks">

    <!-- Page Top Action Bar -->
    <div class="mb-6 sm:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <i data-lucide="landmark" class="w-3 h-3 text-emerald-500"></i>
                    PayNet MEPS &amp; Interbank Gateway
                </span>
                <span class="text-xs text-slate-400">&bull;</span>
                <span class="text-xs font-mono text-slate-500 dark:text-slate-400">DuitNow &amp; IBG Routing</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-slate-100 tracking-tight flex items-center gap-3">
                PayNet Participating Banks
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-3xl">
                Manage approved interbank routing destinations, SWIFT/BIC codes, display prioritization order, and control per-institution maintenance isolations.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-2.5 flex-wrap">
            <a
                href="{{ route('admin.parameters') }}"
                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold transition-all shadow-2xs"
            >
                <i data-lucide="sliders" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Parameters Hub</span>
            </a>
            <button
                type="button"
                onclick="window.openAddBankModal()"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-all cursor-pointer shadow-sm shadow-emerald-600/20"
            >
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Register New Bank</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Institutions</span>
                <div class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 flex items-center justify-center">
                    <i data-lucide="landmark" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 dark:text-slate-100 font-mono mt-2">
                {{ $stats['total'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">PayNet participating banks</div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Online &amp; Active</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-emerald-600 dark:text-emerald-400 font-mono mt-2">
                {{ $stats['active'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Accepting outbound transfers</div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">DuitNow Supported</span>
                <div class="w-8 h-8 rounded-xl bg-pink-50 dark:bg-pink-950/60 text-pink-600 dark:text-pink-400 flex items-center justify-center">
                    <i data-lucide="zap" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-pink-600 dark:text-pink-400 font-mono mt-2">
                {{ $stats['duitnow_active'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Real-time instant settlements</div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Offline / Hold</span>
                <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                    <i data-lucide="pause-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-rose-600 dark:text-rose-400 font-mono mt-2">
                {{ $stats['offline'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Maintenance / isolated</div>
        </div>
    </div>

    <!-- Filter & Search Controls Bar -->
    <x-ui.search-filter
        :action="route('admin.banks')"
        :search="$search"
        searchPlaceholder="Search by code (e.g. MBB, CIMB), short name, full title, or SWIFT/BIC..."
        :resetUrl="route('admin.banks')"
        :activeFiltersCount="(!empty($rail) ? 1 : 0) + (!empty($status) ? 1 : 0)"
        :totalResults="count($banks)"
        totalLabel="member institutions"
        focusRing="emerald"
        class="mb-6"
    >
        <x-slot:filters>
            <!-- Rail Filter -->
            <div class="sm:w-44">
                <select
                    name="rail"
                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 focus:outline-emerald-500"
                >
                    <option value="">All Routing Rails</option>
                    <option value="duitnow" {{ $rail === 'duitnow' ? 'selected' : '' }}>DuitNow Only</option>
                    <option value="ibg" {{ $rail === 'ibg' ? 'selected' : '' }}>IBG Only</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div class="sm:w-36">
                <select
                    name="status"
                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 focus:outline-emerald-500"
                >
                    <option value="">All Status</option>
                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active Only</option>
                    <option value="offline" {{ $status === 'offline' ? 'selected' : '' }}>Offline Only</option>
                </select>
            </div>
        </x-slot:filters>
    </x-ui.search-filter>

    <!-- Bank Directory Table Card -->
    <div class="rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden shadow-xs">
        <div class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                <i data-lucide="landmark" class="w-4 h-4 text-emerald-500"></i>
                PayNet Participating Banks &amp; Online Banking Directory
            </h2>
            <span class="text-xs text-slate-400 font-mono font-semibold">
                Showing {{ count($banks) }} institutions
            </span>
        </div>

        <!-- Mobile Card View (< md) -->
        <div class="md:hidden divide-y divide-slate-100 dark:divide-slate-800">
            @forelse($banks as $b)
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-slate-900 dark:text-slate-100 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs">
                                    {{ $b->bank_code }}
                                </span>
                                <span class="font-medium text-emerald-600 dark:text-emerald-400 text-xs">
                                    {{ $b->short_name }}
                                </span>
                            </div>
                            <div class="font-bold text-slate-900 dark:text-slate-100 text-sm">
                                {{ $b->bank_name }}
                            </div>
                            <div class="text-[10px] font-mono text-slate-400 mt-0.5">
                                SWIFT: {{ $b->swift_code ?? '-' }} &bull; Order: {{ $b->display_order ?? 20 }}
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold shrink-0 {{ $b->is_active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $b->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                            {{ $b->is_active ? 'Active' : 'Offline' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-xs">
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Active Rails:</span>
                        <div class="flex items-center gap-1.5">
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-pink-50 text-pink-700 dark:bg-pink-950/60 dark:text-pink-300 border border-pink-200/60">DuitNow</span>
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200/60">IBG</span>
                        </div>
                    </div>

                    <div class="pt-1">
                        <button
                            type="button"
                            onclick="window.toggleBankState({{ $b->id }})"
                            class="w-full py-2 text-xs font-bold rounded-xl border {{ $b->is_active ? 'border-rose-200 text-rose-600 bg-rose-50/50 hover:bg-rose-50 dark:border-rose-900/60 dark:text-rose-400 dark:bg-rose-950/30' : 'border-emerald-200 text-emerald-600 bg-emerald-50/50 hover:bg-emerald-50 dark:border-emerald-900/60 dark:text-emerald-400 dark:bg-emerald-950/30' }} transition-colors cursor-pointer text-center"
                        >
                            {{ $b->is_active ? 'Take Offline' : 'Enable Rail' }}
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400">
                    <i data-lucide="landmark" class="w-8 h-8 mx-auto mb-2 text-slate-300 dark:text-slate-600"></i>
                    <p class="text-sm font-semibold">No member banks match your filter criteria</p>
                    <p class="text-xs text-slate-400 mt-1">Try refining your keyword or clearing filters.</p>
                </div>
            @endforelse
        </div>

        <!-- Desktop Table View (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                    <tr>
                        <th class="px-4 py-3">Code / SWIFT</th>
                        <th class="px-4 py-3">Institution Name</th>
                        <th class="px-4 py-3">Brand Identifier</th>
                        <th class="px-4 py-3">Routing Rails</th>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Gateway Status</th>
                        <th class="px-4 py-3 text-right">Maintenance Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($banks as $b)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-4 py-3.5 font-mono text-xs">
                                <div class="font-bold text-slate-900 dark:text-slate-100">{{ $b->bank_code }}</div>
                                <div class="text-[10px] text-slate-400">{{ $b->swift_code ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-3.5 font-semibold text-slate-900 dark:text-slate-100">
                                {{ $b->bank_name }}
                            </td>
                            <td class="px-4 py-3.5 font-medium text-emerald-600 dark:text-emerald-400">
                                {{ $b->short_name }}
                            </td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-pink-50 text-pink-700 dark:bg-pink-950/60 dark:text-pink-300 border border-pink-200/60">DuitNow</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200/60">IBG</span>
                                </div>
                            </td>
                            <td class="px-4 py-3.5 font-mono text-xs text-slate-500">
                                {{ $b->display_order ?? 20 }}
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $b->is_active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $b->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ $b->is_active ? 'Active' : 'Offline / Hold' }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <button
                                    type="button"
                                    onclick="window.toggleBankState({{ $b->id }})"
                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-lg border {{ $b->is_active ? 'border-rose-200 text-rose-600 hover:bg-rose-50 dark:border-rose-900/60 dark:text-rose-400' : 'border-emerald-200 text-emerald-600 hover:bg-emerald-50 dark:border-emerald-900/60 dark:text-emerald-400' }} cursor-pointer transition-colors"
                                >
                                    {{ $b->is_active ? 'Take Offline' : 'Enable Rail' }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-slate-400">
                                <i data-lucide="landmark" class="w-8 h-8 mx-auto mb-2 text-slate-300 dark:text-slate-600"></i>
                                <p class="text-sm font-semibold">No member banks match your filter criteria</p>
                                <p class="text-xs text-slate-400 mt-1">Try refining your keyword or clearing filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal: Register New Bank -->
    <div id="add-bank-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl max-w-md w-full p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <i data-lucide="landmark" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Register Bank Institution</h3>
                        <p class="text-[11px] text-slate-400">PayNet MEPS / DuitNow Interbank Routing</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeAddBankModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form id="add-bank-form" onsubmit="window.submitAddBank(event)" class="space-y-3.5">
                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Bank Code</label>
                        <input type="text" id="bank-code-input" required placeholder="e.g. BSN" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-mono font-bold focus:outline-emerald-500 uppercase">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">SWIFT / BIC</label>
                        <input type="text" id="bank-swift-input" placeholder="e.g. BSNAMYKL" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-mono focus:outline-emerald-500 uppercase">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Full Legal Institution Name</label>
                    <input type="text" id="bank-name-input" required placeholder="e.g. Bank Simpanan Nasional" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-emerald-500">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Short Brand Name (Display in UI)</label>
                    <input type="text" id="bank-short-input" required placeholder="e.g. BSN" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-emerald-500">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Display Priority Order (Ascending)</label>
                    <input type="number" id="bank-order-input" value="20" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-mono focus:outline-emerald-500">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="window.closeAddBankModal()" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" id="save-bank-btn" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold cursor-pointer shadow-xs shadow-emerald-600/20">
                        Register Bank
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script handlers -->
    <script>
    (function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

        window.openAddBankModal = function() {
            document.getElementById('add-bank-modal').classList.remove('hidden');
        };

        window.closeAddBankModal = function() {
            document.getElementById('add-bank-modal').classList.add('hidden');
            document.getElementById('add-bank-form').reset();
        };

        window.submitAddBank = function(e) {
            e.preventDefault();
            const btn = document.getElementById('save-bank-btn');
            btn.disabled = true;

            const payload = {
                bank_code: document.getElementById('bank-code-input').value,
                swift_code: document.getElementById('bank-swift-input').value,
                bank_name: document.getElementById('bank-name-input').value,
                short_name: document.getElementById('bank-short-input').value,
                display_order: parseInt(document.getElementById('bank-order-input').value) || 20,
            };

            fetch('{{ route('admin.parameters.bank.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(payload),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Bank registered successfully.');
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to register bank.');
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Network error while saving bank.');
                btn.disabled = false;
            });
        };

        window.toggleBankState = function(id) {
            fetch(`/admin/parameters/bank/${id}/toggle`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(res => res.json())
            .then(data => {
                window.location.reload();
            });
        };
    })();
    </script>

</x-layout.admin>
