@props([
    'id' => 'transaction-receipt-modal',
    'referenceNumber' => 'PAYNET-' . rand(10000000, 99999999),
    'amount' => '150.00',
    'recipientName' => 'SITI NURHALIZA BINTI TARUDIN',
    'recipientBank' => 'Maybank Berhad (514012345678)',
    'paymentType' => 'DuitNow Transfer',
    'date' => date('d M Y, h:i A'),
    'fee' => '0.00',
])

<x-ui.modal :id="$id" title="Transaction Receipt" size="md">
    <div class="space-y-6">
        <!-- Status icon & amount -->
        <div class="text-center pb-4 border-b border-dashed border-slate-200 dark:border-slate-800">
            <div class="mx-auto w-14 h-14 rounded-full bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-3 ring-8 ring-emerald-50 dark:ring-emerald-900/30">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                Successful Payment
            </p>
            <h3 class="text-3xl font-bold text-slate-900 dark:text-slate-100 mt-1">
                RM {{ number_format((float)$amount, 2) }}
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                {{ $date }}
            </p>
        </div>

        <!-- Receipt Metadata Table -->
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-4 space-y-3 text-xs sm:text-sm">
            <div class="flex justify-between items-center text-slate-500 dark:text-slate-400">
                <span>Reference No.</span>
                <span class="font-mono font-medium text-slate-900 dark:text-slate-100">{{ $referenceNumber }}</span>
            </div>
            <div class="flex justify-between items-center text-slate-500 dark:text-slate-400">
                <span>Payment Method</span>
                <span class="font-medium text-slate-900 dark:text-slate-100">{{ $paymentType }}</span>
            </div>
            <div class="flex justify-between items-start text-slate-500 dark:text-slate-400">
                <span>Recipient</span>
                <div class="text-right">
                    <p class="font-medium text-slate-900 dark:text-slate-100">{{ $recipientName }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $recipientBank }}</p>
                </div>
            </div>
            <div class="flex justify-between items-center text-slate-500 dark:text-slate-400">
                <span>Service Charge</span>
                <span class="font-medium text-slate-900 dark:text-slate-100">RM {{ $fee }} (Waived)</span>
            </div>
        </div>

        <!-- PayNet / Regulatory disclaimer -->
        <div class="text-[11px] text-slate-400 dark:text-slate-500 text-center leading-relaxed">
            This electronic receipt is computer generated and certified under Interbank GIRO & DuitNow PayNet clearing rules.
        </div>
    </div>

    <x-slot:footer>
        <x-ui.button variant="secondary" size="sm" onclick="window.closeModal('{{ $id }}')">
            Close
        </x-ui.button>
        <x-ui.button variant="primary" size="sm" onclick="window.print()">
            Print / Save PDF
        </x-ui.button>
    </x-slot:footer>
</x-ui.modal>
