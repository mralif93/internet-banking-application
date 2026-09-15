<x-layout.admin title="JomPAY Biller Directory — BankFlow MY" activeNav="jompay">

    <!-- Page Top Action Bar -->
    <div class="mb-6 sm:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                    <i data-lucide="receipt" class="w-3 h-3 text-amber-500"></i>
                    PayNet National Invoicing Directory
                </span>
                <span class="text-xs text-slate-400">&bull;</span>
                <span class="text-xs font-mono text-slate-500 dark:text-slate-400">Scheme 02-01</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-slate-100 tracking-tight flex items-center gap-3">
                JomPAY Biller Directory
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-3xl">
                Maintain accredited billers, categorize invoice templates, customize reference 1 and 2 label requirements, and activate or isolate specific biller settlement endpoints.
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
                onclick="window.openAddBillerModal()"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold transition-all cursor-pointer shadow-sm shadow-amber-600/20"
            >
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Register New Biller</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Billers</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                    <i data-lucide="receipt" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 dark:text-slate-100 font-mono mt-2">
                {{ $stats['total'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Approved PayNet institutions</div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Active Routing</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-emerald-600 dark:text-emerald-400 font-mono mt-2">
                {{ $stats['active'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Accepting customer payments</div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Disabled / Inactive</span>
                <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                    <i data-lucide="ban" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-rose-600 dark:text-rose-400 font-mono mt-2">
                {{ $stats['disabled'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Transactions rejected</div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Categories</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-blue-600 dark:text-blue-400 font-mono mt-2">
                {{ $stats['categories_count'] }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Industry classifications</div>
        </div>
    </div>

    <!-- Filter & Search Controls Bar -->
    <div class="mb-5 p-3.5 sm:p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
        <form method="GET" action="{{ route('admin.jompay') }}" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
            <div class="flex-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                <!-- Search Input -->
                <div class="relative flex-1">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search by biller code (e.g. 5454), biller name, or ref-1 format..."
                        class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:outline-amber-500"
                    />
                </div>

                <!-- Category Filter -->
                <div class="sm:w-48">
                    <select
                        name="category"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 focus:outline-amber-500"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="sm:w-36">
                    <select
                        name="status"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 focus:outline-amber-500"
                    >
                        <option value="">All Status</option>
                        <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active Only</option>
                        <option value="disabled" {{ $status === 'disabled' ? 'selected' : '' }}>Disabled Only</option>
                    </select>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-2 shrink-0">
                <button
                    type="submit"
                    class="px-4 py-2 rounded-xl bg-slate-900 dark:bg-slate-800 hover:bg-slate-800 text-white text-xs font-bold transition-all cursor-pointer shadow-2xs"
                >
                    Apply Filter
                </button>
                @if(!empty($search) || !empty($category) || !empty($status))
                    <a
                        href="{{ route('admin.jompay') }}"
                        class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                    >
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- JomPAY Biller Directory Table Card -->
    <div class="rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden shadow-xs">
        <div class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                <i data-lucide="receipt" class="w-4 h-4 text-amber-500"></i>
                Registered JomPAY Biller Directory
            </h2>
            <span class="text-xs text-slate-400 font-mono font-semibold">
                Showing {{ count($billers) }} billers
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                    <tr>
                        <th class="px-4 py-3">Biller Code</th>
                        <th class="px-4 py-3">Biller Name</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Ref-1 Format</th>
                        <th class="px-4 py-3">Ref-2 Requirement</th>
                        <th class="px-4 py-3">Routing Status</th>
                        <th class="px-4 py-3 text-right">Maintenance Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse($billers as $biller)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-4 py-3.5 font-mono font-bold text-amber-600 dark:text-amber-400 text-xs">
                                <span class="px-2 py-1 rounded-md bg-amber-50 dark:bg-amber-950/60 border border-amber-200/60 dark:border-amber-800/60">
                                    {{ $biller->biller_code }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 font-bold text-slate-900 dark:text-slate-100">
                                {{ $biller->biller_name }}
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                                    {{ $biller->category }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-xs font-mono text-slate-600 dark:text-slate-300">
                                {{ $biller->ref_1_label }}
                            </td>
                            <td class="px-4 py-3.5 text-xs">
                                @if($biller->is_ref_2_required)
                                    <span class="inline-flex items-center gap-1 font-mono text-[11px] font-bold text-rose-600 dark:text-rose-400">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                        Required ({{ $biller->ref_2_label ?? 'Ref 2' }})
                                    </span>
                                @elseif($biller->ref_2_label)
                                    <span class="text-slate-400 font-mono text-[11px]">
                                        Optional ({{ $biller->ref_2_label }})
                                    </span>
                                @else
                                    <span class="text-slate-400 font-mono text-[11px]">None</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $biller->is_active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $biller->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ $biller->is_active ? 'Active' : 'Disabled' }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <button
                                    type="button"
                                    onclick="window.toggleBillerState({{ $biller->id }})"
                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-lg border {{ $biller->is_active ? 'border-rose-200 text-rose-600 hover:bg-rose-50 dark:border-rose-900/60 dark:text-rose-400' : 'border-emerald-200 text-emerald-600 hover:bg-emerald-50 dark:border-emerald-900/60 dark:text-emerald-400' }} cursor-pointer transition-colors"
                                >
                                    {{ $biller->is_active ? 'Disable' : 'Enable' }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-slate-400">
                                <i data-lucide="receipt" class="w-8 h-8 mx-auto mb-2 text-slate-300 dark:text-slate-600"></i>
                                <p class="text-sm font-semibold">No JomPAY billers match your search criteria</p>
                                <p class="text-xs text-slate-400 mt-1">Try refining your keyword or clearing filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal: Add JomPAY Biller -->
    <div id="add-biller-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl max-w-md w-full p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                        <i data-lucide="receipt" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Register JomPAY Biller</h3>
                        <p class="text-[11px] text-slate-400">PayNet National Invoicing Directory</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeAddBillerModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form id="add-biller-form" onsubmit="window.submitAddBiller(event)" class="space-y-3.5">
                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Biller Code</label>
                        <input type="text" id="biller-code-input" required placeholder="e.g. 5454" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-mono font-bold focus:outline-amber-500">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Category</label>
                        <select id="biller-cat-input" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:outline-amber-500">
                            <option value="Utilities">Utilities</option>
                            <option value="Telecommunication">Telecommunication</option>
                            <option value="Assessment & Tax">Assessment & Tax</option>
                            <option value="Education">Education</option>
                            <option value="Insurance / Takaful">Insurance / Takaful</option>
                            <option value="Assessment & Municipal">Assessment & Municipal</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Biller Registered Name</label>
                    <input type="text" id="biller-name-input" required placeholder="e.g. Tenaga Nasional Berhad" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-amber-500">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Ref-1 Label Name</label>
                    <input type="text" id="biller-ref1-input" required placeholder="e.g. Electricity Account No" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-amber-500">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Ref-2 Label Name (Optional)</label>
                    <input type="text" id="biller-ref2-input" placeholder="e.g. Phone Number or IC" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-amber-500">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="window.closeAddBillerModal()" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" id="save-biller-btn" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold cursor-pointer shadow-xs shadow-amber-600/20">
                        Save Biller
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script handlers -->
    <script>
    (function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

        window.openAddBillerModal = function() {
            document.getElementById('add-biller-modal').classList.remove('hidden');
        };

        window.closeAddBillerModal = function() {
            document.getElementById('add-biller-modal').classList.add('hidden');
            document.getElementById('add-biller-form').reset();
        };

        window.submitAddBiller = function(e) {
            e.preventDefault();
            const btn = document.getElementById('save-biller-btn');
            btn.disabled = true;

            const payload = {
                biller_code: document.getElementById('biller-code-input').value,
                biller_name: document.getElementById('biller-name-input').value,
                category: document.getElementById('biller-cat-input').value,
                ref_1_label: document.getElementById('biller-ref1-input').value,
                ref_2_label: document.getElementById('biller-ref2-input').value || null,
            };

            fetch('{{ route('admin.parameters.biller.store') }}', {
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
                    alert('JomPAY Biller registered successfully.');
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to register biller.');
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Network error while saving biller.');
                btn.disabled = false;
            });
        };

        window.toggleBillerState = function(id) {
            fetch(`/admin/parameters/biller/${id}/toggle`, {
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
