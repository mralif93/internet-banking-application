@props([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
])

@php
$baseClasses = 'inline-flex items-center font-medium rounded-full transition-colors duration-150';

$sizeClasses = [
    'xs' => 'text-[10px] px-2 py-0.5 gap-1',
    'sm' => 'text-xs px-2.5 py-0.5 gap-1.5',
    'md' => 'text-xs sm:text-sm px-3 py-1 gap-1.5',
    'lg' => 'text-sm px-3.5 py-1.5 gap-2',
][$size] ?? 'text-xs px-2.5 py-0.5 gap-1.5';

$variantClasses = [
    'success' => 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20 dark:bg-emerald-950/50 dark:text-emerald-300 dark:ring-emerald-500/30',
    'warning' => 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20 dark:bg-amber-950/50 dark:text-amber-300 dark:ring-amber-500/30',
    'danger' => 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20 dark:bg-rose-950/50 dark:text-rose-300 dark:ring-rose-500/30',
    'info' => 'bg-sky-50 text-sky-700 ring-1 ring-inset ring-sky-600/20 dark:bg-sky-950/50 dark:text-sky-300 dark:ring-sky-500/30',
    'neutral' => 'bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-600/10 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700',
    'purple' => 'bg-purple-50 text-purple-700 ring-1 ring-inset ring-purple-600/20 dark:bg-purple-950/50 dark:text-purple-300 dark:ring-purple-500/30',
][$variant] ?? 'bg-slate-100 text-slate-700 ring-1 ring-inset ring-slate-600/10 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700';

$dotColor = [
    'success' => 'bg-emerald-500 dark:bg-emerald-400',
    'warning' => 'bg-amber-500 dark:bg-amber-400',
    'danger' => 'bg-rose-500 dark:bg-rose-400',
    'info' => 'bg-sky-500 dark:bg-sky-400',
    'neutral' => 'bg-slate-400 dark:bg-slate-500',
    'purple' => 'bg-purple-500 dark:bg-purple-400',
][$variant] ?? 'bg-slate-400';
@endphp

<span {{ $attributes->merge(['class' => "$baseClasses $sizeClasses $variantClasses"]) }}>
    @if ($dot)
        <span class="h-1.5 w-1.5 rounded-full shrink-0 {{ $dotColor }}"></span>
    @endif
    <span>{{ $slot }}</span>
</span>
