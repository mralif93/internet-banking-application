@props([
    'id' => 'accounts',
    'title' => 'Accounts & Balances',
    'total' => 'RM 87,270.50',
    'accounts' => [
        [
            'id' => 'savings',
            'name' => 'Savings Account-i',
            'number' => '1640 1234 5678',
            'balance' => 'RM 24,850.50',
            'holder' => 'AHMAD DANIEL BIN ALIF',
            'badge' => 'DuitNow Active',
            'isPrimary' => true,
            'theme' => 'emerald',
            'bgClass' => 'bg-gradient-to-br from-emerald-700 via-emerald-800 to-teal-950 border-emerald-500/40 text-white shadow-emerald-950/30',
            'chipIcon' => 'emv',
            'customIcon' => null,
            'subValue' => null,
            'progress' => null,
            'progressLabel' => null,
            'primaryActionText' => 'Transfer',
            'primaryActionClick' => "window.openModal('quick-transfer-modal')",
            'secondaryActionIcon' => 'qr-code',
            'secondaryActionClick' => "alert('DuitNow QR Code')"
        ],
        [
            'id' => 'termdeposit',
            'name' => 'Term Deposit-i (3.85% p.a.)',
            'number' => '1640 8899 4432',
            'balance' => 'RM 50,000.00',
            'holder' => 'AHMAD DANIEL BIN ALIF',
            'badge' => 'Term Deposit',
            'isPrimary' => false,
            'theme' => 'dark',
            'bgClass' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 border-slate-700 text-white shadow-slate-950/40',
            'chipIcon' => 'emv',
            'customIcon' => null,
            'subValue' => null,
            'progress' => null,
            'progressLabel' => null,
            'primaryActionText' => 'Transfer',
            'primaryActionClick' => "window.openModal('quick-transfer-modal')",
            'secondaryActionIcon' => 'qr-code',
            'secondaryActionClick' => "alert('DuitNow QR Code')"
        ],
        [
            'id' => 'multiplier',
            'name' => 'Cash Multiplier Account',
            'number' => '1640 5522 9901',
            'balance' => 'RM 12,420.00',
            'holder' => 'AHMAD DANIEL BIN ALIF',
            'badge' => 'High Yield 4.1%',
            'isPrimary' => false,
            'theme' => 'blue',
            'bgClass' => 'bg-gradient-to-br from-sky-800 via-blue-900 to-slate-950 border-sky-600/40 text-white shadow-sky-950/30',
            'chipIcon' => 'emv',
            'customIcon' => null,
            'subValue' => null,
            'progress' => null,
            'progressLabel' => null,
            'primaryActionText' => 'Transfer',
            'primaryActionClick' => "window.openModal('quick-transfer-modal')",
            'secondaryActionIcon' => 'qr-code',
            'secondaryActionClick' => "alert('DuitNow QR Code')"
        ],
    ]
])

<div id="stacked-deck-container-{{ $id }}" class="w-full">
    <!-- Header Controls: Compact Card Counter & Indicators -->
    <div class="flex items-center justify-between mb-2.5 px-1">
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                Active Card
            </span>
            <span id="deck-counter-badge-{{ $id }}" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20 shadow-2xs">
                1 of {{ count($accounts) }}
            </span>
        </div>

        <span class="text-[11px] text-slate-400 font-medium">
            Swipe or tap arrows
        </span>
    </div>

    <!-- HORIZONTAL SIDE-BY-SIDE STACK VIEW (Primary Format) -->
    <div id="deck-stack-wrapper-{{ $id }}" class="relative pb-2 pt-0.5 select-none transition-all">
        <!-- Interactive Horizontal Side-by-Side Container -->
        <div class="relative w-full py-2 px-0">
            <!-- Card Stage (Touch Swipe & Tap Peeking Card Enabled) -->
            <div id="deck-card-stage-{{ $id }}" class="relative h-[225px] xs:h-[235px] sm:h-[240px] w-full max-w-sm sm:max-w-md mx-auto touch-pan-y cursor-pointer">
                @foreach ($accounts as $index => $acc)
                    @php
                        $chip = $acc['chipIcon'] ?? 'emv';
                        $customIcon = $acc['customIcon'] ?? null;
                        $theme = $acc['theme'] ?? 'emerald';
                        $subVal = $acc['subValue'] ?? null;
                        $prog = $acc['progress'] ?? null;
                        $progLabel = $acc['progressLabel'] ?? null;
                        $actPrimaryText = $acc['primaryActionText'] ?? 'Transfer';
                        $actPrimaryClick = $acc['primaryActionClick'] ?? "window.openModal('quick-transfer-modal')";
                        $actSecIcon = $acc['secondaryActionIcon'] ?? 'qr-code';
                        $actSecClick = $acc['secondaryActionClick'] ?? "alert('Action clicked')";
                    @endphp

                    <div
                        id="deck-card-{{ $id }}-{{ $index }}"
                        onclick="window.deckControllers['{{ $id }}']?.handleCardClick({{ $index }})"
                        class="deck-card absolute inset-x-0 top-0 h-full rounded-2xl p-3.5 sm:p-5 md:p-6 border shadow-xl cursor-pointer transition-all duration-300 ease-out overflow-hidden flex flex-col justify-between active:scale-[0.99] {{ $acc['bgClass'] }}"
                        data-index="{{ $index }}"
                    >
                        <!-- Background Ambient Glow -->
                        <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-white/5 blur-xl pointer-events-none"></div>

                        <!-- Top: Chip, Contactless, Badge -->
                        <div class="flex items-center justify-between gap-2 z-10">
                            <div class="flex items-center gap-2 shrink-0">
                                @if ($chip === 'emv')
                                    <div class="w-7 h-5 sm:w-8 sm:h-6 rounded-md bg-amber-400/90 border border-amber-300/60 flex items-center justify-center shadow-xs">
                                        <div class="w-3.5 h-2.5 sm:w-4 sm:h-3 border border-amber-700/30 rounded-xs"></div>
                                    </div>
                                    <i data-lucide="wifi" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white/70 rotate-90"></i>
                                @elseif ($customIcon)
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-white/10 flex items-center justify-center text-white">
                                        <i data-lucide="{{ $customIcon }}" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                    </div>
                                @else
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-white/10 flex items-center justify-center text-white">
                                        <i data-lucide="layers" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-1 sm:gap-1.5 flex-wrap justify-end">
                                @if (!empty($acc['isPrimary']))
                                    <span class="px-1.5 sm:px-2 py-0.5 rounded-full text-[9px] sm:text-[10px] font-bold bg-white/20 text-white backdrop-blur-xs whitespace-nowrap">
                                        Primary
                                    </span>
                                @endif
                                @if (!empty($acc['badge']))
                                    <span class="px-1.5 sm:px-2 py-0.5 rounded-full text-[9px] sm:text-[10px] font-semibold border border-white/20 bg-white/10 text-white backdrop-blur-xs whitespace-nowrap">
                                        {{ $acc['badge'] }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Middle: Title, Identifier & Balance -->
                        <div class="my-1 sm:my-2 z-10">
                            <div class="flex flex-wrap items-center justify-between gap-1 text-white/80 text-[11px] sm:text-xs">
                                <span class="font-medium tracking-wide truncate max-w-[180px]">{{ $acc['name'] }}</span>
                                <span class="font-mono tracking-wider text-[10px] sm:text-xs">{{ $acc['number'] }}</span>
                            </div>

                            <div class="mt-1 flex items-baseline gap-2 flex-wrap">
                                <span class="text-lg sm:text-2xl lg:text-3xl font-extrabold tracking-tight text-white card-balance-text break-all" data-real="{{ $acc['balance'] }}">
                                    {{ $acc['balance'] }}
                                </span>
                                <button
                                    type="button"
                                    onclick="event.stopPropagation(); window.toggleBalanceText(this);"
                                    class="p-1 rounded-md bg-white/10 hover:bg-white/20 text-white/80 hover:text-white transition-colors cursor-pointer self-center"
                                    title="Toggle balance visibility"
                                >
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>

                            @if ($subVal)
                                <p class="text-[9px] sm:text-[11px] mt-0.5 sm:mt-1 text-white/80 line-clamp-1">{!! $subVal !!}</p>
                            @endif

                            @if ($prog !== null)
                                <div class="mt-1.5 sm:mt-2 space-y-1">
                                    <div class="flex justify-between text-[9px] sm:text-[10px] text-white/80">
                                        <span>{{ $progLabel }}</span>
                                        <span class="font-bold text-white">{{ $prog }}%</span>
                                    </div>
                                    <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-white h-full rounded-full transition-all duration-500" style="width: {{ $prog }}%"></div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Bottom: Account Holder & Action Buttons -->
                        <div class="pt-2 border-t border-white/15 flex items-center justify-between gap-2 z-10">
                            <div class="min-w-0 pr-1">
                                <span class="text-[9px] sm:text-[10px] uppercase tracking-wider text-white/70 block font-medium leading-tight">Holder</span>
                                <span class="text-xs sm:text-sm text-white font-semibold tracking-wide uppercase block truncate max-w-[140px] sm:max-w-[200px]">
                                    {{ $acc['holder'] }}
                                </span>
                            </div>

                            <div class="flex items-center gap-1 sm:gap-1.5 shrink-0" onclick="event.stopPropagation();">
                                @if ($actPrimaryText)
                                    <button
                                        type="button"
                                        onclick="{!! $actPrimaryClick !!}"
                                        class="px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-lg bg-white/20 hover:bg-white/30 text-white font-semibold text-xs sm:text-xs transition-colors cursor-pointer active:scale-95 shadow-xs"
                                    >
                                        {{ $actPrimaryText }}
                                    </button>
                                @endif
                                @if ($actSecIcon)
                                    <button
                                        type="button"
                                        onclick="{!! $actSecClick !!}"
                                        class="p-1 sm:p-1.5 px-2 sm:px-2.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-[11px] sm:text-xs transition-colors cursor-pointer active:scale-95 shadow-xs"
                                        title="Quick Action"
                                    >
                                        <i data-lucide="{{ $actSecIcon }}" class="w-3.5 h-3.5"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Stack Navigation Footer & Indicators -->
        <div class="flex items-center justify-between gap-2 mt-2 px-2 max-w-md mx-auto">
            <!-- Prev Button -->
            <button
                type="button"
                onclick="window.deckControllers['{{ $id }}']?.prev()"
                class="inline-flex items-center gap-1 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 active:scale-95 text-xs font-semibold shadow-xs cursor-pointer transition-all"
            >
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                <span class="hidden xs:inline">Prev</span>
            </button>

            <!-- Dots Indicator with comfortable touch target -->
            <div id="deck-dots-container-{{ $id }}" class="flex items-center gap-1 py-1">
                @foreach ($accounts as $index => $acc)
                    <button
                        type="button"
                        onclick="window.deckControllers['{{ $id }}']?.select({{ $index }})"
                        id="deck-dot-{{ $id }}-{{ $index }}"
                        class="p-2 cursor-pointer flex items-center justify-center"
                        title="View {{ $acc['name'] }}"
                    >
                        <span class="deck-dot-pill block h-2 rounded-full transition-all duration-200 {{ $index === 0 ? 'w-6 bg-emerald-600 dark:bg-emerald-400' : 'w-2 bg-slate-300 dark:bg-slate-700' }}"></span>
                    </button>
                @endforeach
            </div>

            <!-- Next Button -->
            <button
                type="button"
                onclick="window.deckControllers['{{ $id }}']?.next()"
                class="inline-flex items-center gap-1 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 active:scale-95 text-xs font-semibold shadow-xs cursor-pointer transition-all"
            >
                <span class="hidden xs:inline">Next</span>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>
        </div>

        <p class="text-center text-[11px] text-slate-400 font-medium mt-1">
            <span class="hidden sm:inline">Tap arrows, dots, or peeking cards to switch</span>
            <span class="sm:hidden">Swipe left/right or tap arrows to switch cards</span>
        </p>
    </div>
</div>

<script>
    (function() {
        window.deckControllers = window.deckControllers || {};
        const deckId = '{{ $id }}';
        const totalCards = {{ count($accounts) }};
        let activeIndex = 0;

        function renderDeck() {
            const isMobile = window.innerWidth < 640;
            // Adaptive offset: smaller on mobile so peeking cards are visible on narrow screens without overflow
            const offsetDist = isMobile ? 12 : 46;

            for (let i = 0; i < totalCards; i++) {
                const card = document.getElementById('deck-card-' + deckId + '-' + i);
                const dot = document.getElementById('deck-dot-' + deckId + '-' + i);
                if (!card) continue;

                const diff = (i - activeIndex + totalCards) % totalCards;

                if (diff === 0) {
                    card.style.transform = 'translateX(0px) scale(1)';
                    card.style.zIndex = '20';
                    card.style.opacity = '1';
                    card.style.filter = 'brightness(1)';
                    card.style.pointerEvents = 'auto';
                } else if (diff === 1) {
                    card.style.transform = `translateX(${offsetDist}px) scale(0.95)`;
                    card.style.zIndex = '15';
                    card.style.opacity = '0.85';
                    card.style.filter = 'brightness(0.92)';
                    card.style.pointerEvents = 'auto';
                } else if (diff === totalCards - 1 || (totalCards > 2 && diff === 2)) {
                    card.style.transform = `translateX(-${offsetDist}px) scale(0.95)`;
                    card.style.zIndex = '10';
                    card.style.opacity = '0.85';
                    card.style.filter = 'brightness(0.88)';
                    card.style.pointerEvents = 'auto';
                } else {
                    card.style.transform = 'translateX(0px) scale(0.9)';
                    card.style.zIndex = '5';
                    card.style.opacity = '0';
                    card.style.pointerEvents = 'none';
                }

                if (dot) {
                    const pill = dot.querySelector('.deck-dot-pill');
                    if (pill) {
                        if (i === activeIndex) {
                            pill.className = 'deck-dot-pill block h-2 rounded-full transition-all duration-200 w-6 bg-emerald-600 dark:bg-emerald-400';
                        } else {
                            pill.className = 'deck-dot-pill block h-2 rounded-full transition-all duration-200 w-2 bg-slate-300 dark:bg-slate-700';
                        }
                    }
                }
            }

            const counter = document.getElementById('deck-counter-badge-' + deckId);
            if (counter) {
                counter.innerText = (activeIndex + 1) + ' of ' + totalCards;
            }

            if (window.refreshLucideIcons) {
                window.refreshLucideIcons();
            }
        }

        window.deckControllers[deckId] = {
            render: renderDeck,
            select: function(idx) {
                activeIndex = idx;
                renderDeck();
            },
            next: function() {
                activeIndex = (activeIndex + 1) % totalCards;
                renderDeck();
            },
            prev: function() {
                activeIndex = (activeIndex - 1 + totalCards) % totalCards;
                renderDeck();
            },
            handleCardClick: function(idx) {
                // If user clicks a peeking background card, bring it to front
                if (idx !== activeIndex) {
                    activeIndex = idx;
                    renderDeck();
                }
            }
        };

        // Touch swipe gestures with higher reliability
        function setupTouch() {
            const stage = document.getElementById('deck-card-stage-' + deckId);
            if (!stage) return;

            let touchStartX = 0;
            let touchStartY = 0;
            let touchStartTime = 0;

            stage.addEventListener('touchstart', function(e) {
                if (e.touches && e.touches.length > 0) {
                    touchStartX = e.touches[0].clientX;
                    touchStartY = e.touches[0].clientY;
                    touchStartTime = Date.now();
                }
            }, { passive: true });

            stage.addEventListener('touchend', function(e) {
                if (!touchStartX) return;
                const touchEndX = e.changedTouches[0].clientX;
                const touchEndY = e.changedTouches[0].clientY;
                const diffX = touchEndX - touchStartX;
                const diffY = touchEndY - touchStartY;
                const elapsed = Date.now() - touchStartTime;

                // Detect horizontal swipe if delta X > delta Y and distance > 25px
                if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 25 && elapsed < 800) {
                    if (diffX < 0) {
                        window.deckControllers[deckId]?.next();
                    } else {
                        window.deckControllers[deckId]?.prev();
                    }
                }
                touchStartX = 0;
                touchStartY = 0;
            }, { passive: true });
        }

        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(renderDeck, 100);
        });

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                renderDeck();
                setupTouch();
            });
        } else {
            renderDeck();
            setupTouch();
        }
    })();
</script>
