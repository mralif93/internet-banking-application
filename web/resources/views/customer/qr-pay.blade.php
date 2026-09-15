@php
$customer = Auth::guard('customer')->user() ?? (object)[
    'name' => 'Ahmad Daniel Bin Alif',
    'username' => 'daniel_alif',
    'account_number' => '1640 1234 5678',
    'account_balance' => 24850.50,
    'account_type' => 'Savings Account-i',
    'bound_device_name' => 'iPhone 16 Pro',
    'phone_number' => '+60 12-345 6789',
];
@endphp

<x-layout.customer title="DuitNow QR Pay & Receive — BankFlow MY" activeNav="qr-pay">
    <div class="space-y-6 sm:space-y-8">

        <!-- STANDARD PAGE HEADER (Matching Dashboard Style) -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 border border-slate-200/80 dark:border-slate-800 shadow-xs animate__animated animate__fadeInDown animate__faster">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 sm:gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            DuitNow QR
                        </span>
                        <span class="text-[11px] sm:text-xs font-mono text-slate-500 dark:text-slate-400">
                            Malaysia Standard QR (EMVCo)
                        </span>
                    </div>

                    <h1 class="text-base sm:text-xl lg:text-2xl font-black text-slate-900 dark:text-slate-100 tracking-tight mt-1 truncate">
                        DuitNow QR Pay &amp; Receive
                    </h1>

                    <div class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 sm:mt-1 flex-wrap">
                        <span class="font-medium text-slate-600 dark:text-slate-300">Instant Merchant &amp; P2P Settlement</span>
                        <span class="text-slate-300 dark:text-slate-700">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                            PayNet Certified
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0 border-t border-slate-100 dark:border-slate-800/80 sm:border-0">
                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl border border-slate-200/90 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all active:scale-[0.98] shadow-2xs group"
                    >
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform text-slate-500"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mode Switcher: Scan vs My QR Receive -->
        <div class="grid grid-cols-2 p-1.5 bg-slate-100 dark:bg-slate-800/80 rounded-2xl animate__animated animate__fadeInUp animate__faster">
            <button
                type="button"
                id="btn-tab-scan"
                onclick="window.switchQrMode('scan')"
                class="py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer flex items-center justify-center gap-2 bg-white dark:bg-slate-900 text-emerald-600 dark:text-emerald-400 shadow-xs"
            >
                <i data-lucide="scan-line" class="w-4 h-4"></i>
                <span>Scan to Pay</span>
            </button>
            <button
                type="button"
                id="btn-tab-receive"
                onclick="window.switchQrMode('receive')"
                class="py-3 px-4 rounded-xl text-xs sm:text-sm font-semibold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-all cursor-pointer flex items-center justify-center gap-2"
            >
                <i data-lucide="qr-code" class="w-4 h-4"></i>
                <span>My Receive QR</span>
            </button>
        </div>

        <!-- =====================================================================
             MODE 1: SCAN TO PAY VIEW
             ===================================================================== -->
        <div id="qr-scan-view" class="space-y-6 animate__animated animate__fadeInUp animate__faster">
            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-6 sm:p-8 shadow-xl shadow-slate-950/5 space-y-6">

                <!-- Scanner Viewfinder Simulator -->
                <div class="relative w-full aspect-square max-w-[320px] mx-auto rounded-3xl overflow-hidden bg-slate-950 border-2 border-dashed border-emerald-500/50 flex flex-col items-center justify-center shadow-2xl shadow-emerald-950/20 group">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/80"></div>
                    <!-- Animated Laser Scan Line -->
                    <div class="absolute inset-x-4 top-1/2 -translate-y-1/2 h-0.5 bg-gradient-to-r from-transparent via-emerald-400 to-transparent animate-pulse"></div>

                    <!-- Target Viewfinder Corners -->
                    <div class="absolute top-4 left-4 w-8 h-8 border-t-2 border-l-2 border-emerald-400 rounded-tl-xl"></div>
                    <div class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2 border-emerald-400 rounded-tr-xl"></div>
                    <div class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2 border-emerald-400 rounded-bl-xl"></div>
                    <div class="absolute bottom-4 right-4 w-8 h-8 border-b-2 border-r-2 border-emerald-400 rounded-br-xl"></div>

                    <div class="relative z-10 text-center px-4">
                        <i data-lucide="camera" class="w-10 h-10 text-emerald-400/80 mx-auto mb-2.5 animate-bounce"></i>
                        <p class="text-xs sm:text-sm font-bold text-white/95">Align QR code inside frame</p>
                        <p class="text-[11px] text-white/60 mt-1">Accepts DuitNow, Touch 'n Go, GrabPay &amp; Boost QR</p>
                    </div>

                    <!-- Torch / Flashlight Simulator Toggle -->
                    <button
                        type="button"
                        onclick="this.classList.toggle('text-yellow-400')"
                        class="absolute bottom-4 right-4 p-2.5 rounded-full bg-slate-900/80 border border-slate-700 text-white/80 hover:text-yellow-400 transition-colors z-20 cursor-pointer"
                        title="Toggle Torch"
                    >
                        <i data-lucide="flashlight" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Simulation Quick Presets for Demo / Testing -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">Simulate Scanning Malaysian Merchant</label>
                    <div class="grid grid-cols-3 gap-2.5">
                        <button
                            type="button"
                            onclick="window.simulateScan('FamilyMart Subang SS15', '14.50', 'FM-MY-882194', 'Oden & Coffee')"
                            class="p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 hover:border-emerald-500 hover:bg-emerald-50/30 dark:hover:bg-emerald-950/30 text-left transition-all group cursor-pointer active:scale-95"
                        >
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate">FamilyMart</p>
                            <p class="text-[11px] font-extrabold text-emerald-600 dark:text-emerald-400 mt-0.5">RM 14.50</p>
                        </button>

                        <button
                            type="button"
                            onclick="window.simulateScan('Tealive Pavilion Bukit Jalil', '12.80', 'TL-MY-30192', 'Brown Sugar Boba')"
                            class="p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 hover:border-emerald-500 hover:bg-emerald-50/30 dark:hover:bg-emerald-950/30 text-left transition-all group cursor-pointer active:scale-95"
                        >
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate">Tealive</p>
                            <p class="text-[11px] font-extrabold text-emerald-600 dark:text-emerald-400 mt-0.5">RM 12.80</p>
                        </button>

                        <button
                            type="button"
                            onclick="window.simulateScan('Uncle Lim Kopitiam Bangsar', '8.00', 'KOP-20188', 'Kaya Toast & Kopi')"
                            class="p-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 hover:border-emerald-500 hover:bg-emerald-50/30 dark:hover:bg-emerald-950/30 text-left transition-all group cursor-pointer active:scale-95"
                        >
                            <p class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate">Kopitiam</p>
                            <p class="text-[11px] font-extrabold text-emerald-600 dark:text-emerald-400 mt-0.5">RM 8.00</p>
                        </button>
                    </div>
                </div>

                <!-- Scanned Merchant Confirmation Card -->
                <div id="scanned-merchant-box" class="p-4 rounded-2xl bg-emerald-50/60 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900/50 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Merchant Invoice Found</span>
                            <h4 id="scanned-merchant-title" class="text-sm font-black text-slate-900 dark:text-slate-100">FamilyMart Subang SS15</h4>
                            <p id="scanned-merchant-note" class="text-[11px] text-slate-500 dark:text-slate-400">Oden & Coffee • Ref: FM-MY-882194</p>
                        </div>
                        <span id="scanned-merchant-price" class="text-xl font-black text-emerald-600 dark:text-emerald-400">RM 14.50</span>
                    </div>

                    <div class="flex items-center justify-between text-xs pt-2 border-t border-emerald-100 dark:border-emerald-900/40">
                        <span class="text-slate-500">Deducting from:</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200">{{ $customer->account_type }} (•••• 5678)</span>
                    </div>

                    <button
                        type="button"
                        id="confirm-qr-pay-btn"
                        onclick="window.executeQrPayment()"
                        class="w-full py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 active:scale-98 text-white font-bold text-xs sm:text-sm shadow-lg shadow-emerald-600/25 transition-all flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <i data-lucide="fingerprint" class="w-4 h-4"></i>
                        <span>Pay with Biometric Face ID</span>
                    </button>
                </div>

            </div>
        </div>

        <!-- =====================================================================
             MODE 2: MY RECEIVE QR VIEW
             ===================================================================== -->
        <div id="qr-receive-view" class="space-y-6 hidden">
            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-6 sm:p-8 shadow-xl shadow-slate-950/5 space-y-6 text-center">

                <!-- National DuitNow QR Card Mockup -->
                <div class="p-6 bg-slate-950 rounded-3xl border border-slate-800 shadow-2xl inline-block mx-auto max-w-[280px] w-full text-white">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800 text-[11px] font-black tracking-widest text-emerald-400">
                        <span>DUITNOW</span>
                        <span>QR</span>
                    </div>

                    <div class="my-6 flex justify-center">
                        <div class="p-3 bg-white rounded-2xl shadow-inner">
                            <i data-lucide="qr-code" class="w-36 h-36 text-slate-950 stroke-[1.5]"></i>
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-white truncate">{{ $customer->name }}</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">BankFlow Malaysia &bull; {{ $customer->phone_number }}</p>

                    <div id="receive-amount-tag" class="mt-3 py-1.5 px-3 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 font-bold text-xs hidden">
                        Fixed Amount: RM 0.00
                    </div>
                </div>

                <!-- Custom Amount Setter -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 text-left">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Set Custom Amount to Receive (Optional)</label>
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">RM</span>
                            <input
                                type="number"
                                id="custom-qr-amount-input"
                                placeholder="0.00"
                                step="0.50"
                                class="w-full pl-11 pr-3 py-2.5 text-xs sm:text-sm font-bold rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                            />
                        </div>
                        <button
                            type="button"
                            onclick="window.updateReceiveQrAmount()"
                            class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-all cursor-pointer"
                        >
                            Update QR
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <button
                        type="button"
                        onclick="window.showAppAlert({ title: 'Saved to Gallery', subtitle: 'PayNet DuitNow QR', message: 'DuitNow National QR code image has been saved to your Photos gallery.', type: 'success' });"
                        class="p-3.5 rounded-2xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-95"
                    >
                        <i data-lucide="download" class="w-4 h-4 text-slate-400"></i>
                        <span>Save to Gallery</span>
                    </button>

                    <button
                        type="button"
                        onclick="window.showAppAlert({ title: 'QR Link Copied', subtitle: 'PayNet DuitNow', message: 'Your personalized DuitNow payment link has been copied to your clipboard.', type: 'success' });"
                        class="p-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-lg shadow-emerald-600/25 transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-95"
                    >
                        <i data-lucide="share-2" class="w-4 h-4"></i>
                        <span>Share My QR</span>
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- QR Page Controller Script -->
    <script>
    (function() {
        let currentMerchant = {
            name: 'FamilyMart Subang SS15',
            price: '14.50',
            ref: 'FM-MY-882194',
            note: 'Oden & Coffee',
        };

        window.switchQrMode = function(mode) {
            const btnScan = document.getElementById('btn-tab-scan');
            const btnReceive = document.getElementById('btn-tab-receive');
            const scanView = document.getElementById('qr-scan-view');
            const receiveView = document.getElementById('qr-receive-view');

            if (mode === 'scan') {
                btnScan.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer flex items-center justify-center gap-2 bg-white dark:bg-slate-900 text-emerald-600 dark:text-emerald-400 shadow-xs";
                btnReceive.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-semibold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-all cursor-pointer flex items-center justify-center gap-2";
                scanView.classList.remove('hidden');
                receiveView.classList.add('hidden');
            } else {
                btnReceive.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer flex items-center justify-center gap-2 bg-white dark:bg-slate-900 text-emerald-600 dark:text-emerald-400 shadow-xs";
                btnScan.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-semibold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition-all cursor-pointer flex items-center justify-center gap-2";
                receiveView.classList.remove('hidden');
                scanView.classList.add('hidden');
            }
        };

        window.simulateScan = function(name, price, ref, note) {
            currentMerchant = { name, price, ref, note };
            document.getElementById('scanned-merchant-title').textContent = name;
            document.getElementById('scanned-merchant-price').textContent = 'RM ' + price;
            document.getElementById('scanned-merchant-note').textContent = `${note} • Ref: ${ref}`;
        };

        window.executeQrPayment = function() {
            const btn = document.getElementById('confirm-qr-pay-btn');
            btn.innerHTML = `<span class="animate-spin mr-2">◌</span> Scanning Face ID & Signing with Secure Enclave...`;
            btn.disabled = true;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch('{{ route("customer.qr-pay.submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    merchant_name: currentMerchant.name,
                    amount: parseFloat(currentMerchant.price),
                    merchant_ref: currentMerchant.ref,
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(`DuitNow QR Payment of RM ${parseFloat(data.amount).toFixed(2)} to ${data.merchant_name} successful! (Ref: ${data.reference})`);
                    window.location.href = "{{ route('customer.history') }}";
                } else {
                    alert(data.message || 'QR Payment failed.');
                    btn.innerHTML = `<span>Authorize Payment (RM ${currentMerchant.price})</span>`;
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('QR Payment failed due to a network error.');
                btn.innerHTML = `<span>Authorize Payment (RM ${currentMerchant.price})</span>`;
                btn.disabled = false;
            });
        };

        window.updateReceiveQrAmount = function() {
            const amt = parseFloat(document.getElementById('custom-qr-amount-input').value);
            const tag = document.getElementById('receive-amount-tag');
            if (!isNaN(amt) && amt > 0) {
                tag.textContent = `Fixed Amount: RM ${amt.toFixed(2)}`;
                tag.classList.remove('hidden');
            } else {
                tag.classList.add('hidden');
            }
        };
    })();
    </script>

</x-layout.customer>
