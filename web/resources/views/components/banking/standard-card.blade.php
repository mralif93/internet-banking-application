@props([
    'title' => 'Savings Account-i',
    'subtitle' => '1640 1234 5678',
    'badge' => 'DuitNow Active',
    'isPrimary' => false,
    'balanceLabel' => 'Available Balance',
    'balance' => 'RM 24,850.50',
    'holder' => 'AHMAD DANIEL BIN ALIF',
    'subValue' => null, // e.g. tenure, rate, limit
    'progress' => null, // 0 to 100 for repayment or credit
    'progressLabel' => null,
    'theme' => 'emerald', // emerald, dark, indigo, sky, amber
    'showActions' => true,
    'primaryActionText' => 'Transfer',
    'primaryActionClick' => "window.openModal('quick-transfer-modal')",
    'secondaryActionIcon' => 'qr-code',
    'secondaryActionClick' => "alert('Action clicked')",
    'chipIcon' => 'emv', // emv, icon, home, car, coins, line-chart, pie-chart
    'customIcon' => null,
    'maskable' => true,
])

@php
$themeStyles = match($theme) {
    'dark' => [
        'card' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 border-slate-700 text-white shadow-slate-950/40',
        'badge' => 'bg-white/10 text-slate-200 border-white/10',
        'btn' => 'bg-white/20 hover:bg-white/30 text-white',
        'subtext' => 'text-slate-400',
        'accent' => 'text-indigo-400',
        'glow' => 'bg-indigo-500/10'
    ],
    'indigo' => [
        'card' => 'bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 border-indigo-500/30 text-white shadow-indigo-950/30',
        'badge' => 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30',
        'btn' => 'bg-indigo-500/30 hover:bg-indigo-500/40 text-white',
        'subtext' => 'text-indigo-300/80',
        'accent' => 'text-indigo-300',
        'glow' => 'bg-indigo-500/20'
    ],
    'sky' => [
        'card' => 'bg-gradient-to-br from-sky-900 via-slate-900 to-blue-950 border-sky-600/30 text-white shadow-sky-950/30',
        'badge' => 'bg-sky-500/20 text-sky-300 border-sky-500/30',
        'btn' => 'bg-white/20 hover:bg-white/30 text-white',
        'subtext' => 'text-sky-300/80',
        'accent' => 'text-sky-400',
        'glow' => 'bg-sky-500/15'
    ],
    'amber' => [
        'card' => 'bg-gradient-to-br from-amber-950 via-slate-900 to-neutral-950 border-amber-500/30 text-white shadow-amber-950/30',
        'badge' => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
        'btn' => 'bg-amber-500/30 hover:bg-amber-500/40 text-white',
        'subtext' => 'text-amber-300/80',
        'accent' => 'text-amber-400',
        'glow' => 'bg-amber-500/15'
    ],
    default => [ // emerald
        'card' => 'bg-gradient-to-br from-emerald-800 via-emerald-900 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
        'badge' => 'bg-white/20 text-white border-white/10',
        'btn' => 'bg-white/20 hover:bg-white/30 text-white',
        'subtext' => 'text-emerald-200/80',
        'accent' => 'text-emerald-300',
        'glow' => 'bg-emerald-500/10'
    ],
};
@endphp

<div {{ $attributes->merge(['class' => "relative rounded-2xl p-4 sm:p-5 md:p-6 border shadow-xl overflow-hidden flex flex-col justify-between min-h-[205px] sm:min-h-[220px] select-none transition-all duration-300 {$themeStyles['card']}"]) }}>
    <!-- Ambient Glow Pattern -->
    <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full {{ $themeStyles['glow'] }} blur-2xl pointer-events-none"></div>

    <!-- 1. Top Bar: Chip / Icon + Badge Status -->
    <div class="flex items-center justify-between gap-2 z-10">
        <div class="flex items-center gap-2 shrink-0">
            @if ($chipIcon === 'emv')
                <div class="w-8 h-6 rounded-md bg-amber-400/90 border border-amber-300/60 flex items-center justify-center shadow-xs">
                    <div class="w-4 h-3 border border-amber-700/30 rounded-xs"></div>
                </div>
                <i data-lucide="wifi" class="w-4 h-4 text-white/70 rotate-90"></i>
            @elseif ($customIcon)
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white">
                    <i data-lucide="{{ $customIcon }}" class="w-4 h-4"></i>
                </div>
            @else
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-1.5 flex-wrap justify-end">
            @if ($isPrimary)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-white/20 text-white backdrop-blur-xs whitespace-nowrap">
                    Primary
                </span>
            @endif
            @if ($badge)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold border backdrop-blur-xs whitespace-nowrap {{ $themeStyles['badge'] }}">
                    {{ $badge }}
                </span>
            @endif
        </div>
    </div>

    <!-- 2. Middle Body: Title, Identifier & Balance -->
    <div class="my-2 sm:my-2.5 z-10">
        <div class="flex flex-wrap items-center justify-between gap-1 text-xs {{ $themeStyles['subtext'] }}">
            <span class="font-medium tracking-wide">{{ $title }}</span>
            <span class="font-mono tracking-wider">{{ $subtitle }}</span>
        </div>

        <div class="mt-1 flex items-baseline gap-2 flex-wrap">
            <span class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight text-white card-balance-text break-all" data-real="{{ $balance }}">
                {{ $balance }}
            </span>
            @if ($maskable)
                <button
                    type="button"
                    onclick="event.stopPropagation(); window.toggleBalanceText(this);"
                    class="p-1 rounded-md bg-white/10 hover:bg-white/20 text-white/80 hover:text-white transition-colors cursor-pointer self-center"
                    title="Toggle balance visibility"
                >
                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                </button>
            @endif
        </div>

        @if ($subValue)
            <p class="text-[10px] sm:text-[11px] mt-1 {{ $themeStyles['subtext'] }}">{!! $subValue !!}</p>
        @endif

        @if ($progress !== null)
            <div class="mt-2 space-y-1">
                <div class="flex justify-between text-[10px] {{ $themeStyles['subtext'] }}">
                    <span>{{ $progressLabel }}</span>
                    <span class="font-bold text-white">{{ $progress }}%</span>
                </div>
                <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-white h-full rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                </div>
            </div>
        @endif
    </div>

    <!-- 3. Bottom Bar: Holder / Details + Quick Direct Actions -->
    <div class="pt-2.5 border-t border-white/15 flex flex-col xs:flex-row xs:items-center justify-between gap-2 z-10">
        <div class="min-w-0 pr-1">
            <span class="text-[9px] uppercase tracking-wider text-white/60 block font-medium">Account Holder</span>
            <span class="text-xs sm:text-[13px] text-white font-semibold tracking-wide uppercase block">
                {{ $holder }}
            </span>
        </div>

        @if ($showActions)
            <div class="flex items-center gap-1.5 shrink-0 self-end xs:self-center" onclick="event.stopPropagation();">
                @if ($primaryActionText)
                    <button
                        type="button"
                        onclick="{!! $primaryActionClick !!}"
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors cursor-pointer active:scale-95 shadow-xs {{ $themeStyles['btn'] }}"
                    >
                        {{ $primaryActionText }}
                    </button>
                @endif
                @if ($secondaryActionIcon)
                    <button
                        type="button"
                        onclick="{!! $secondaryActionClick !!}"
                        class="p-1.5 px-2.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs transition-colors cursor-pointer active:scale-95 shadow-xs"
                        title="Quick Action"
                    >
                        <i data-lucide="{{ $secondaryActionIcon }}" class="w-3.5 h-3.5"></i>
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
