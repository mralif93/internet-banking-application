@props([
    'title',
    'value',
    'trend' => null, // e.g. '+12.5%' or '-3.2%'
    'trendType' => 'up', // 'up', 'down', 'neutral'
    'subtitle' => null,
    'icon' => null,
])

@php
$trendColor = match($trendType) {
    'up' => 'text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50',
    'down' => 'text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50',
    default => 'text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-800',
};
@endphp

<div {{ $attributes->merge(['class' => 'p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm relative overflow-hidden transition-all duration-200 hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700']) }}>
    <div class="flex items-center justify-between gap-2">
        <span class="text-xs sm:text-sm font-medium text-slate-500 dark:text-slate-400 truncate">
            {{ $title }}
        </span>
        @if ($icon)
            <div class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 shrink-0">
                {!! $icon !!}
            </div>
        @endif
    </div>

    <div class="mt-3 flex items-baseline justify-between flex-wrap gap-2">
        <h4 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
            {{ $value }}
        </h4>

        @if ($trend)
            <span class="inline-flex items-center gap-1 text-xs font-semibold px-2 py-0.5 rounded-md {{ $trendColor }}">
                @if ($trendType === 'up')
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                @elseif ($trendType === 'down')
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
                    </svg>
                @endif
                {{ $trend }}
            </span>
        @endif
    </div>

    @if ($subtitle)
        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
            {{ $subtitle }}
        </p>
    @endif
</div>
