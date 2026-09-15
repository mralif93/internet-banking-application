@props([
    'title',
    'category' => 'Transfer',
    'type' => 'duitnow', // 'duitnow', 'fpx', 'jompay', 'qr', 'card'
    'amount', // e.g. -150.00 or +1200.00
    'isCredit' => false,
    'date',
    'status' => 'completed', // completed, pending, failed, cooling_off
    'reference' => null,
])

@php
$typeBadge = match($type) {
    'duitnow' => ['label' => 'DuitNow', 'color' => 'bg-pink-50 text-pink-700 dark:bg-pink-950/60 dark:text-pink-300 border-pink-200/60 dark:border-pink-900/50'],
    'jompay' => ['label' => 'JomPAY', 'color' => 'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200/60 dark:border-amber-900/50'],
    'fpx' => ['label' => 'FPX', 'color' => 'bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300 border-blue-200/60 dark:border-blue-900/50'],
    'qr' => ['label' => 'DuitNow QR', 'color' => 'bg-purple-50 text-purple-700 dark:bg-purple-950/60 dark:text-purple-300 border-purple-200/60 dark:border-purple-900/50'],
    default => ['label' => 'Direct Debit', 'color' => 'bg-slate-50 text-slate-700 dark:bg-slate-800 dark:text-slate-300 border-slate-200/60 dark:border-slate-700/50'],
};

$amountColor = $isCredit
    ? 'text-emerald-600 dark:text-emerald-400 font-extrabold'
    : 'text-slate-900 dark:text-slate-100 font-bold';

$detailUrl = route('customer.transactions.detail', ['ref' => $reference ?? 'RPP-20260909-082104']);
@endphp

<a
    href="{{ $detailUrl }}"
    onclick="if (window.showTransactionReceipt) { event.preventDefault(); window.showTransactionReceipt({
        id: '{{ $reference ?? '' }}',
        title: '{{ addslashes($title) }}',
        category: '{{ addslashes($category) }}',
        type: '{{ $type }}',
        amount: '{{ $amount }}',
        isCredit: {{ $isCredit ? 'true' : 'false' }},
        date: '{{ addslashes($date) }}',
        status: '{{ $status }}',
        detailUrl: '{{ $detailUrl }}'
    }); }"
    {{ $attributes->merge(['class' => 'transaction-row group flex items-center justify-between p-3.5 sm:p-4 rounded-xl hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-all cursor-pointer block', 'data-type' => $type, 'data-credit' => $isCredit ? '1' : '0']) }}
>
    <!-- Left: Icon & Info -->
    <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 pr-2 sm:pr-3">
        <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 transition-transform group-hover:scale-105 shadow-2xs {{ $isCredit ? 'bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-slate-100/90 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/70 dark:border-slate-700/60' }}">
            @if ($isCredit)
                <!-- Down-left incoming arrow -->
                <i data-lucide="arrow-down-left" class="w-4 h-4 sm:w-5 sm:h-5 stroke-[2.5]"></i>
            @else
                <!-- Up-right outgoing arrow -->
                <i data-lucide="arrow-up-right" class="w-4 h-4 sm:w-5 sm:h-5 stroke-[2.5]"></i>
            @endif
        </div>

        <div class="min-w-0">
            <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
                <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-slate-100 truncate max-w-[150px] xs:max-w-[200px] sm:max-w-none group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                    {{ $title }}
                </p>
                <span class="text-[8px] sm:text-[9px] font-extrabold px-1.5 py-0.5 rounded-md border shrink-0 {{ $typeBadge['color'] }}">
                    {{ $typeBadge['label'] }}
                </span>
            </div>
            <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 mt-0.5 sm:mt-1">
                <span class="truncate">{{ $date }}</span>
                @if ($reference)
                    <span class="text-slate-300 dark:text-slate-700 hidden xs:inline">•</span>
                    <span class="hidden xs:inline font-mono text-[9px] sm:text-[10px] text-slate-400 truncate">{{ $reference }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Right: Amount & Status -->
    <div class="text-right shrink-0">
        <p class="text-xs sm:text-sm {{ $amountColor }} tracking-tight">
            {{ $isCredit ? '+' : '-' }}RM {{ number_format(abs((float)$amount), 2) }}
        </p>

        <div class="mt-1 flex justify-end">
            @if ($status === 'cooling_off')
                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/60 border border-amber-300/60 dark:border-amber-900/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    Cooling Off (12h)
                </span>
            @elseif ($status === 'pending')
                <span class="text-[10px] px-1.5 py-0.5 rounded font-semibold text-sky-700 dark:text-sky-300 bg-sky-50 dark:bg-sky-950/50">Pending</span>
            @elseif ($status === 'failed')
                <span class="text-[10px] px-1.5 py-0.5 rounded font-semibold text-rose-700 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/50">Failed</span>
            @else
                <span class="inline-flex items-center gap-1 text-[10px] font-medium text-slate-400 dark:text-slate-500">
                    <i data-lucide="check" class="w-3 h-3 text-emerald-500 stroke-[3]"></i>
                    Success
                </span>
            @endif
        </div>
    </div>
</a>
