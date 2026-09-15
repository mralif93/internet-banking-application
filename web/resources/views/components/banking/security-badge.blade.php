@props([
    'type' => 'cooling_off', // 'cooling_off', 'device_binding', 'kill_switch'
    'remaining' => '11h 42m',
    'deviceName' => "iPhone 15 Pro (Ahmad's Phone)",
    'active' => true,
])

@if ($type === 'cooling_off')
    <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800/80 text-amber-800 dark:text-amber-300 text-xs">
        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping shrink-0"></span>
        <div class="truncate">
            <span class="font-semibold">Security Cooling-Off:</span>
            <span class="font-mono ml-1">{{ $remaining }} remaining</span>
        </div>
    </div>
@elseif ($type === 'device_binding')
    <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800/80 text-emerald-800 dark:text-emerald-300 text-xs">
        <svg class="w-3.5 h-3.5 shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
        </svg>
        <span class="font-medium truncate">Hardware Bound: {{ $deviceName }}</span>
    </div>
@elseif ($type === 'kill_switch')
    <button
        type="button"
        onclick="if(confirm('EMERGENCY KILL SWITCH: Are you sure you want to instantly freeze all online transactions and revoke digital access?')) { alert('Emergency freeze triggered. Your accounts are now secured.'); }"
        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/60 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-800/80 text-rose-700 dark:text-rose-300 text-xs font-semibold transition-colors shadow-xs active:scale-95"
    >
        <span class="w-2 h-2 rounded-full bg-rose-600 animate-pulse"></span>
        <span>Emergency Kill Switch</span>
    </button>
@endif
