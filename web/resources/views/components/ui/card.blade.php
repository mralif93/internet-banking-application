@props([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'footer' => null,
    'padding' => 'default', // 'none', 'sm', 'default', 'lg'
    'hoverable' => false,
    'glass' => false,
])

@php
$paddingClasses = [
    'none' => '',
    'sm' => 'p-3 sm:p-4',
    'default' => 'p-4 sm:p-6',
    'lg' => 'p-6 sm:p-8',
][$padding] ?? 'p-4 sm:p-6';

$glassClasses = $glass 
    ? 'backdrop-blur-md bg-white/80 dark:bg-slate-900/80 border border-white/20 dark:border-slate-800 shadow-xl' 
    : 'bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/90 shadow-sm dark:shadow-slate-950/60';

$hoverClasses = $hoverable 
    ? 'transition-all duration-200 hover:shadow-lg hover:border-slate-300 dark:hover:border-slate-700 hover:-translate-y-0.5 cursor-pointer' 
    : '';
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl overflow-hidden $glassClasses $hoverClasses"]) }}>
    @if ($title || $subtitle || $action)
        <div class="px-4 py-4 sm:px-6 sm:py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between flex-wrap gap-2">
            <div>
                @if ($title)
                    <h3 class="text-base sm:text-lg font-semibold text-slate-900 dark:text-slate-100 tracking-tight">
                        {{ $title }}
                    </h3>
                @endif
                @if ($subtitle)
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>
            @if ($action)
                <div class="flex items-center gap-2">
                    {{ $action }}
                </div>
            @endif
        </div>
    @endif

    <div class="{{ $paddingClasses }}">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-4 py-3 sm:px-6 sm:py-4 bg-slate-50/60 dark:bg-slate-800/40 border-t border-slate-100 dark:border-slate-800/80">
            {{ $footer }}
        </div>
    @endif
</div>
