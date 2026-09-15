@props([
    'variant' => 'info', // info, warning, danger, success
    'title' => null,
    'dismissible' => false,
])

@php
$variantStyles = [
    'info' => [
        'container' => 'bg-sky-500/10 dark:bg-sky-500/15 border-sky-500/25 text-sky-950 dark:text-sky-200',
        'icon' => 'info',
        'iconColor' => 'text-sky-600 dark:text-sky-400',
    ],
    'warning' => [
        'container' => 'bg-amber-500/10 dark:bg-amber-500/15 border-amber-500/25 text-amber-950 dark:text-amber-200',
        'icon' => 'alert-triangle',
        'iconColor' => 'text-amber-600 dark:text-amber-400',
    ],
    'danger' => [
        'container' => 'bg-rose-500/10 dark:bg-rose-500/15 border-rose-500/25 text-rose-950 dark:text-rose-200',
        'icon' => 'alert-octagon',
        'iconColor' => 'text-rose-600 dark:text-rose-400',
    ],
    'success' => [
        'container' => 'bg-emerald-500/10 dark:bg-emerald-500/15 border-emerald-500/25 text-emerald-950 dark:text-emerald-200',
        'icon' => 'check-circle',
        'iconColor' => 'text-emerald-600 dark:text-emerald-400',
    ],
][$variant] ?? [
    'container' => 'bg-slate-500/10 dark:bg-slate-500/15 border-slate-500/20 text-slate-900 dark:text-slate-200',
    'icon' => 'info',
    'iconColor' => 'text-slate-500',
];
@endphp

<div
    {{ $attributes->merge(['class' => 'rounded-2xl p-4 border flex items-start gap-3.5 text-xs sm:text-sm transition-all duration-200 animate__animated animate__fadeIn shadow-2xs ' . $variantStyles['container']]) }}
    role="alert"
>
    <div class="shrink-0 w-8 h-8 rounded-xl bg-white/60 dark:bg-slate-900/60 flex items-center justify-center shadow-2xs {{ $variantStyles['iconColor'] }}">
        <i data-lucide="{{ $variantStyles['icon'] }}" class="w-4 h-4"></i>
    </div>

    <div class="flex-1 min-w-0">
        @if ($title)
            <h4 class="font-bold text-xs sm:text-sm mb-0.5 tracking-tight">
                {{ $title }}
            </h4>
        @endif
        <div class="text-[11px] sm:text-xs leading-relaxed opacity-90">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button
            type="button"
            class="shrink-0 w-7 h-7 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 flex items-center justify-center opacity-70 hover:opacity-100 transition-all cursor-pointer"
            onclick="this.closest('[role=\'alert\']').remove()"
            aria-label="Dismiss alert"
        >
            <i data-lucide="x" class="w-3.5 h-3.5"></i>
        </button>
    @endif
</div>
