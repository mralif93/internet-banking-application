@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'fullWidth' => false,
    'disabled' => false,
    'icon' => null,
    'iconRight' => null,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none rounded-xl active:scale-[0.97] select-none cursor-pointer';

$sizeClasses = [
    'xs' => 'px-3 py-1.5 text-xs gap-1.5 font-medium',
    'sm' => 'px-3.5 py-2 text-xs sm:text-sm gap-2 font-medium',
    'md' => 'px-4 py-2.5 text-sm gap-2 font-semibold',
    'lg' => 'px-5 py-3 text-sm sm:text-base gap-2.5 font-semibold',
][$size] ?? 'px-4 py-2.5 text-sm gap-2 font-semibold';

$variantClasses = [
    'primary' => 'bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white shadow-md shadow-emerald-600/20 hover:shadow-lg hover:shadow-emerald-600/30 focus:ring-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400 dark:active:bg-emerald-600 dark:text-slate-950 focus:ring-offset-white dark:focus:ring-offset-slate-900',
    'secondary' => 'bg-slate-100 hover:bg-slate-200/90 active:bg-slate-200 text-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700/90 dark:active:bg-slate-700 dark:text-slate-100 focus:ring-slate-400 dark:focus:ring-offset-slate-900 border border-slate-200/60 dark:border-slate-700/60',
    'outline' => 'border border-slate-300 dark:border-slate-700 bg-transparent hover:bg-slate-100/80 dark:hover:bg-slate-800/80 text-slate-700 dark:text-slate-200 focus:ring-slate-400 dark:focus:ring-offset-slate-900',
    'danger' => 'bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white shadow-md shadow-rose-600/20 hover:shadow-lg hover:shadow-rose-600/30 focus:ring-rose-500 dark:bg-rose-600 dark:hover:bg-rose-500 dark:text-white focus:ring-offset-white dark:focus:ring-offset-slate-900',
    'warning' => 'bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-white shadow-md shadow-amber-500/20 hover:shadow-lg hover:shadow-amber-500/30 focus:ring-amber-500 focus:ring-offset-white dark:focus:ring-offset-slate-900',
    'ghost' => 'bg-transparent hover:bg-slate-100 dark:hover:bg-slate-800/80 text-slate-600 dark:text-slate-300 focus:ring-slate-400 dark:focus:ring-offset-slate-900',
    'link' => 'bg-transparent text-emerald-600 dark:text-emerald-400 hover:underline p-0 focus:ring-0 focus:ring-offset-0',
][$variant] ?? 'bg-emerald-600 hover:bg-emerald-500 text-white';

$widthClass = $fullWidth ? 'w-full' : '';
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "$baseClasses $sizeClasses $variantClasses $widthClass"]) }}
    {{ $disabled ? 'disabled' : '' }}
>
    @if ($icon)
        <span class="shrink-0 flex items-center justify-center">{!! $icon !!}</span>
    @endif

    <span>{{ $slot }}</span>

    @if ($iconRight)
        <span class="shrink-0 flex items-center justify-center">{!! $iconRight !!}</span>
    @endif
</button>
