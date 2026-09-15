@props([
    'accountType' => 'Savings Account-i',
    'accountNumber' => '1640 1234 5678',
    'balance' => 'RM 24,850.50',
    'currency' => 'MYR',
    'isPrimary' => true,
    'holderName' => 'AHMAD DANIEL BIN ALIF',
    'variant' => 'emerald', // emerald, dark
])

@php
$uniqueCardId = 'acc-card-' . md5($accountNumber);
$bgTheme = $variant === 'dark' 
    ? 'bg-slate-900 text-white border-slate-800' 
    : 'bg-gradient-to-br from-emerald-700 to-teal-900 text-white border-emerald-600/30';
@endphp

<div class="relative rounded-2xl p-5 sm:p-6 {{ $bgTheme }} border shadow-md flex flex-col justify-between min-h-[190px] overflow-hidden transition-all duration-200 hover:shadow-lg">
    <!-- Subtle Ambient Accent -->
    <div class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-white/5 blur-xl pointer-events-none"></div>

    <!-- Header: Chip + DuitNow Badge -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <!-- Sleek Minimal Chip -->
            <div class="w-8 h-6 rounded-md bg-amber-400/90 border border-amber-300/60 flex items-center justify-center shadow-xs">
                <div class="w-4 h-3 border border-amber-700/30 rounded-xs"></div>
            </div>
            <i data-lucide="wifi" class="w-4 h-4 text-white/70 rotate-90"></i>
        </div>

        <div class="flex items-center gap-1.5">
            @if ($isPrimary)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-white/20 text-white backdrop-blur-xs">
                    Primary
                </span>
            @endif
            <span class="text-[11px] font-semibold text-white/80">
                DuitNow
            </span>
        </div>
    </div>

    <!-- Balance Section -->
    <div class="my-3">
        <div class="flex items-center justify-between">
            <p class="text-[11px] text-white/70 font-medium">
                {{ $accountType }}
            </p>
            <p class="text-xs font-mono text-white/80">
                {{ $accountNumber }}
            </p>
        </div>

        <div class="mt-2 flex items-center gap-2.5">
            <span class="text-2xl sm:text-3xl font-extrabold tracking-tight" id="{{ $uniqueCardId }}-val">
                {{ $balance }}
            </span>
            <button
                type="button"
                onclick="
                    const val = document.getElementById('{{ $uniqueCardId }}-val');
                    if (val.innerText.includes('•')) {
                        val.innerText = '{{ $balance }}';
                    } else {
                        val.innerText = 'RM ••••••••';
                    }
                "
                class="p-1 rounded-md bg-white/10 hover:bg-white/20 text-white/80 hover:text-white transition-colors cursor-pointer"
                title="Toggle balance visibility"
            >
                <i data-lucide="eye" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>

    <!-- Bottom Actions -->
    <div class="flex items-center justify-between pt-2.5 border-t border-white/15 gap-2">
        <span class="text-[11px] text-white/80 font-medium truncate uppercase tracking-wider">
            {{ $holderName }}
        </span>

        <div class="flex items-center gap-1.5 shrink-0">
            <button
                type="button"
                onclick="window.openModal('quick-transfer-modal')"
                class="px-2.5 py-1 rounded-lg bg-white/20 hover:bg-white/30 text-white font-semibold text-xs transition-colors cursor-pointer"
            >
                Transfer
            </button>
            <button
                type="button"
                onclick="window.showAppAlert ? window.showAppAlert({ title: 'DuitNow QR Ready', subtitle: '{{ $accountType }}', message: 'Instant DuitNow QR inbound payment rail is active and ready to receive funds into this account.', type: 'success' }) : alert('DuitNow QR Code: Ready to receive instant payment into {{ $accountType }}.')"
                class="px-2 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs transition-colors cursor-pointer"
                title="Show QR"
            >
                <i data-lucide="qr-code" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>
</div>
