@props([
    'action' => '',
    'method' => 'GET',
    'search' => '',
    'searchPlaceholder' => 'Search records...',
    'searchName' => 'search',
    'resetUrl' => '',
    'activeFiltersCount' => 0,
    'totalResults' => null,
    'totalLabel' => 'records',
    'submitLabel' => 'Apply Filter',
    'focusRing' => 'rose', // 'rose', 'emerald', 'amber', 'slate'
    'compact' => false,
])

@php
$ringColors = match($focusRing) {
    'emerald' => 'focus:outline-emerald-500 focus:border-emerald-500',
    'amber' => 'focus:outline-amber-500 focus:border-amber-500',
    'slate' => 'focus:outline-slate-500 focus:border-slate-500',
    default => 'focus:outline-rose-500 focus:border-rose-500',
};

$btnColors = match($focusRing) {
    'emerald' => 'bg-emerald-600 hover:bg-emerald-500 text-white shadow-emerald-600/20',
    'amber' => 'bg-amber-600 hover:bg-amber-500 text-white shadow-amber-600/20',
    default => 'bg-slate-900 dark:bg-slate-800 hover:bg-slate-800 dark:hover:bg-slate-700 text-white shadow-slate-900/20',
};

// Check if any filters are active (either passed count or non-empty search)
$hasActiveFilters = $activeFiltersCount > 0 || !empty($search);
@endphp

<div {{ $attributes->merge(['class' => 'p-3.5 sm:p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs transition-colors']) }}>
    <form method="{{ strtoupper($method) === 'POST' ? 'POST' : 'GET' }}" action="{{ $action }}" class="space-y-3">
        @if(strtoupper($method) === 'POST')
            @csrf
        @endif

        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
            <!-- Search Input & Custom Filter Controls -->
            <div class="flex-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 flex-wrap">
                <!-- Search Input Field -->
                <div class="relative flex-1 min-w-[220px]">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    <input
                        type="text"
                        name="{{ $searchName }}"
                        value="{{ $search }}"
                        placeholder="{{ $searchPlaceholder }}"
                        class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/70 dark:bg-slate-800/60 text-slate-900 dark:text-slate-100 placeholder-slate-400 transition-colors {{ $ringColors }}"
                    />
                </div>

                <!-- Custom Select / Filter Elements Slot -->
                @if(isset($filters))
                    {{ $filters }}
                @endif
            </div>

            <!-- Action Buttons & Badges -->
            <div class="flex items-center gap-2 shrink-0 justify-end">
                @if(isset($extraActions))
                    {{ $extraActions }}
                @endif

                <button
                    type="submit"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer shadow-2xs {{ $btnColors }}"
                >
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                    <span>{{ $submitLabel }}</span>
                </button>

                @if($hasActiveFilters && !empty($resetUrl))
                    <a
                        href="{{ $resetUrl }}"
                        class="inline-flex items-center gap-1 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                        title="Reset all filters"
                    >
                        <i data-lucide="rotate-ccw" class="w-3 h-3 text-slate-400"></i>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Optional Bottom Bar: Result Counter or Active Filter Badges -->
        @if(!is_null($totalResults) || isset($footer))
            <div class="pt-2.5 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400">
                @if(!is_null($totalResults))
                    <div class="flex items-center gap-2">
                        <span>Showing</span>
                        <span class="font-mono font-bold text-slate-900 dark:text-slate-100">{{ $totalResults }}</span>
                        <span>{{ $totalLabel }}</span>
                        @if($hasActiveFilters)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border border-rose-200/60 dark:border-rose-900/60 font-semibold text-[10px]">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                Filtered
                            </span>
                        @endif
                    </div>
                @else
                    <div></div>
                @endif

                @if(isset($footer))
                    <div>
                        {{ $footer }}
                    </div>
                @endif
            </div>
        @endif
    </form>
</div>
