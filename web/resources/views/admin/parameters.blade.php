<x-layout.admin title="System Parameter Management — BankFlow MY" activeNav="parameters">

    <!-- Header Alert Banner -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 sm:p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm animate__animated animate__fadeInDown">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-rose-100 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0 border border-rose-200/60 dark:border-rose-800/60 shadow-2xs">
                <i data-lucide="sliders" class="w-5 h-5"></i>
            </div>
            <div>
                <h1 class="text-base sm:text-lg font-black text-slate-900 dark:text-slate-100 tracking-tight flex items-center gap-2">
                    System Parameter &amp; Operational Controls
                    <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300 border border-rose-300 dark:border-rose-800">BNM RMiT Compliant</span>
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    Configure BNM 12h cooling-off duration, payment rail circuit breakers, daily limit caps, and JomPAY billers.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button
                type="button"
                onclick="window.submitParameterForm()"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold shadow-sm shadow-rose-600/30 transition-all cursor-pointer active:scale-[0.98]"
            >
                <i data-lucide="save" class="w-3.5 h-3.5"></i>
                <span>Save All Parameters</span>
            </button>
        </div>
    </div>

    <!-- Parameter Tabs / Section Form -->
    <form id="parameters-form" onsubmit="window.saveAllParameters(event)" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Card 1: BNM Cooling-off & Safety Parameters -->
            <x-ui.card
                title="1. BNM Cooling-Off & Safety Parameters"
                subtitle="Regulatory cooling periods to mitigate account takeovers and unauthorized limit spikes"
            >
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                            Cooling-off Period Duration (Hours)
                        </label>
                        <p class="text-[11px] text-slate-400 mb-2">Mandatory cooldown before newly bound devices or limit upgrades take effect.</p>
                        <div class="relative">
                            <input
                                type="number"
                                name="parameters[cooling_off_period_hours]"
                                value="{{ $parameters['cooling_off'][0]->param_value ?? 12 }}"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-xs font-mono font-bold text-slate-900 dark:text-slate-100 focus:outline-rose-500"
                                required
                                min="1"
                                max="72"
                            />
                            <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">Hours</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                            High-Value Hold Threshold (MYR)
                        </label>
                        <p class="text-[11px] text-slate-400 mb-2">Transfers to first-time payees exceeding this amount trigger a 12h hold.</p>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">RM</span>
                            <input
                                type="number"
                                step="0.01"
                                name="parameters[cooling_off_threshold_amount]"
                                value="{{ $parameters['cooling_off'][1]->param_value ?? '1000.00' }}"
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-xs font-mono font-bold text-slate-900 dark:text-slate-100 focus:outline-rose-500"
                                required
                            />
                        </div>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700 flex items-center justify-between">
                        <div class="pr-4">
                            <span class="text-xs font-bold text-slate-900 dark:text-slate-100 block">Enforce Mobile Secure Enclave Biometrics</span>
                            <span class="text-[11px] text-slate-400 block">Strictly require hardware biometric sign-off for amounts &ge; RM 500.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                name="parameters[enforce_biometric_step_up]"
                                value="1"
                                {{ ($parameters['cooling_off'][2]->param_value ?? '1') == '1' ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-600"></div>
                        </label>
                    </div>
                </div>
            </x-ui.card>

            <!-- Card 2: Payment Rail Circuit Breakers -->
            <x-ui.card
                title="2. Payment Rail Circuit Breakers"
                subtitle="Instant kill switch toggles for national clearing networks"
            >
                <div class="space-y-4">
                    <!-- DuitNow Rail -->
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700 flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="zap" class="w-4 h-4 text-emerald-500"></i>
                                <span class="text-xs font-bold text-slate-900 dark:text-slate-100">PayNet DuitNow Instant Rail</span>
                            </div>
                            <span class="text-[11px] text-slate-400 block mt-0.5">ISO 20022 interbank immediate payments network</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                name="parameters[duitnow_rail_active]"
                                value="1"
                                {{ ($parameters['payment_rails'][0]->param_value ?? '1') == '1' ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                        </label>
                    </div>

                    <!-- DuitNow QR Rail -->
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700 flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="qr-code" class="w-4 h-4 text-purple-500"></i>
                                <span class="text-xs font-bold text-slate-900 dark:text-slate-100">DuitNow QR Interoperable Rail</span>
                            </div>
                            <span class="text-[11px] text-slate-400 block mt-0.5">Merchant &amp; Peer QR transaction rails</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                name="parameters[duitnow_qr_rail_active]"
                                value="1"
                                {{ ($parameters['payment_rails'][1]->param_value ?? '1') == '1' ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <!-- JomPAY Rail -->
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700 flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="receipt" class="w-4 h-4 text-amber-500"></i>
                                <span class="text-xs font-bold text-slate-900 dark:text-slate-100">JomPAY Settlement Gateway</span>
                            </div>
                            <span class="text-[11px] text-slate-400 block mt-0.5">National bill payment gateway settlements</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                name="parameters[jompay_rail_active]"
                                value="1"
                                {{ ($parameters['payment_rails'][2]->param_value ?? '1') == '1' ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-600"></div>
                        </label>
                    </div>
                </div>
            </x-ui.card>

            <!-- Card 3: Global System Limits -->
            <x-ui.card
                title="3. Global Daily Limit Caps"
                subtitle="System-wide ceilings preventing catastrophic drain on individual retail accounts"
            >
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                            Universal Maximum Daily Transfer Ceiling (MYR)
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">RM</span>
                            <input
                                type="number"
                                step="100.00"
                                name="parameters[max_system_transfer_limit]"
                                value="{{ $parameters['limit_caps'][0]->param_value ?? '50000.00' }}"
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-xs font-mono font-bold text-slate-900 dark:text-slate-100 focus:outline-rose-500"
                                required
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                            DuitNow QR Single Transaction Cap (MYR)
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">RM</span>
                            <input
                                type="number"
                                step="50.00"
                                name="parameters[max_qr_single_transaction_limit]"
                                value="{{ $parameters['limit_caps'][1]->param_value ?? '3000.00' }}"
                                class="w-full pl-10 pr-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-xs font-mono font-bold text-slate-900 dark:text-slate-100 focus:outline-rose-500"
                                required
                            />
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <!-- Card 4: Platform Maintenance Mode & Announcement -->
            <x-ui.card
                title="4. Maintenance & Customer Announcement Broadcast"
                subtitle="Publish real-time announcements or trigger scheduled maintenance banners"
            >
                <div class="space-y-4">
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-900 dark:text-slate-100 block">Retail Platform Maintenance Mode</span>
                            <span class="text-[11px] text-slate-400 block">Enables advisory banner across customer dashboard</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                name="parameters[maintenance_mode_active]"
                                value="1"
                                {{ ($parameters['maintenance'][0]->param_value ?? '0') == '1' ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-600"></div>
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                            Broadcast Announcement Message
                        </label>
                        <textarea
                            name="parameters[maintenance_banner_message]"
                            rows="3"
                            class="w-full p-3 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 focus:outline-rose-500 font-sans"
                        >{{ $parameters['maintenance'][1]->param_value ?? 'Scheduled System Optimization: All services operational. 24/7 fraud hotline 997 is standby.' }}</textarea>
                    </div>
                </div>
            </x-ui.card>

        </div>
    </form>

    <!-- Card 5: JomPAY Biller Directory Management Table -->
    <div class="mt-8 space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-base font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                    <i data-lucide="receipt" class="w-4 h-4 text-amber-500"></i>
                    Registered JomPAY Biller Directory
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Manage approved billers, categories and active validation rules.</p>
            </div>
            <button
                type="button"
                onclick="window.openAddBillerModal()"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-900 dark:bg-slate-800 hover:bg-slate-800 text-white text-xs font-bold transition-all cursor-pointer border border-slate-800 dark:border-slate-700 shadow-2xs"
            >
                <i data-lucide="plus-circle" class="w-3.5 h-3.5 text-amber-400"></i>
                <span>Register New Biller</span>
            </button>
        </div>

        <div class="rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase font-semibold text-[11px] border-b border-slate-200/80 dark:border-slate-800">
                        <tr>
                            <th class="px-4 py-3">Biller Code</th>
                            <th class="px-4 py-3">Biller Name</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Ref-1 Format</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @foreach($billers as $biller)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="px-4 py-3 font-mono font-bold text-amber-600 dark:text-amber-400 text-xs">
                                    {{ $biller->biller_code }}
                                </td>
                                <td class="px-4 py-3 font-bold text-slate-900 dark:text-slate-100">
                                    {{ $biller->biller_name }}
                                </td>
                                <td class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400">
                                    {{ $biller->category }}
                                </td>
                                <td class="px-4 py-3 text-xs font-mono">
                                    {{ $biller->ref_1_label }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $biller->is_active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $biller->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        {{ $biller->is_active ? 'Active' : 'Disabled' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button
                                        type="button"
                                        onclick="window.toggleBillerState({{ $biller->id }})"
                                        class="px-2.5 py-1 text-[11px] font-semibold rounded-lg border {{ $biller->is_active ? 'border-rose-200 text-rose-600 hover:bg-rose-50 dark:border-rose-900/60 dark:text-rose-400' : 'border-emerald-200 text-emerald-600 hover:bg-emerald-50 dark:border-emerald-900/60 dark:text-emerald-400' }} cursor-pointer transition-colors"
                                    >
                                        {{ $biller->is_active ? 'Disable' : 'Enable' }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal: Register New JomPAY Biller -->
    <div id="add-biller-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl max-w-md w-full p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                        <i data-lucide="receipt" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Register JomPAY Biller</h3>
                        <p class="text-[11px] text-slate-400">PayNet National Bill Clearing Directory</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeAddBillerModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form id="add-biller-form" onsubmit="window.submitAddBiller(event)" class="space-y-3.5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Biller Code</label>
                    <input type="text" id="biller-code-input" required placeholder="e.g. 5454" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-mono font-bold focus:outline-rose-500">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Biller Organization Name</label>
                    <input type="text" id="biller-name-input" required placeholder="e.g. Indah Water Konsortium" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-rose-500">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Category</label>
                    <select id="biller-cat-input" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-rose-500">
                        <option value="Utilities">Utilities</option>
                        <option value="Telecommunications">Telecommunications</option>
                        <option value="Assessment & Municipal">Assessment &amp; Municipal</option>
                        <option value="Education">Education</option>
                        <option value="Insurance & Takaful">Insurance &amp; Takaful</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Ref-1 Field Label</label>
                    <input type="text" id="biller-ref1-input" required placeholder="e.g. Account Number / Customer ID" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-medium focus:outline-rose-500">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="window.closeAddBillerModal()" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" id="save-biller-btn" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold cursor-pointer">
                        Register Biller
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script handlers -->
    <script>
    (function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

        window.submitParameterForm = function() {
            document.getElementById('parameters-form').dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
        };

        window.saveAllParameters = function(e) {
            e.preventDefault();
            const form = document.getElementById('parameters-form');
            const formData = new FormData(form);

            // Handle unchecked checkboxes
            ['parameters[enforce_biometric_step_up]', 'parameters[duitnow_rail_active]', 'parameters[duitnow_qr_rail_active]', 'parameters[jompay_rail_active]', 'parameters[maintenance_mode_active]'].forEach(name => {
                if (!form.elements[name].checked) {
                    formData.set(name, '0');
                }
            });

            fetch('{{ route('admin.parameters.update') }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message || 'System parameters updated.');
                window.location.reload();
            })
            .catch(err => {
                console.error(err);
                alert('Encountered an error saving parameters.');
            });
        };

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
