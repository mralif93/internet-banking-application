@props([
    'id' => 'modal-' . md5(uniqid(rand(), true)),
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'iconColor' => 'emerald', // emerald, blue, purple, amber, rose, slate
    'size' => 'md', // sm, md, lg, xl
    'centered' => true,
])

@php
$sizeClasses = [
    'sm' => 'sm:max-w-md',
    'md' => 'sm:max-w-lg',
    'lg' => 'sm:max-w-2xl',
    'xl' => 'sm:max-w-4xl',
][$size] ?? 'sm:max-w-lg';

$iconPalettes = [
    'emerald' => 'bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20',
    'blue' => 'bg-blue-500/10 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 border border-blue-500/20',
    'purple' => 'bg-purple-500/10 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 border border-purple-500/20',
    'amber' => 'bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/20',
    'rose' => 'bg-rose-500/10 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 border border-rose-500/20',
    'slate' => 'bg-slate-500/10 dark:bg-slate-500/20 text-slate-600 dark:text-slate-400 border border-slate-500/20',
][$iconColor] ?? 'bg-emerald-500/10 text-emerald-600';
@endphp

<div
    id="{{ $id }}"
    class="fixed inset-0 z-50 overflow-y-auto hidden"
    aria-labelledby="{{ $id }}-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Deep Glassmorphism Backdrop with smooth fade -->
    <div
        class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-all duration-300"
        onclick="window.closeModal('{{ $id }}')"
    ></div>

    <div class="flex min-h-full items-end justify-center p-0 text-center sm:items-center sm:p-4 sm:pb-8">
        <!-- Modern Floating Card: Bottom Sheet on Mobile, Floating Glass Modal on Desktop -->
        <div class="modal-bottom-sheet relative w-full transform overflow-hidden rounded-t-[2.25rem] sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl text-left shadow-2xl shadow-slate-950/40 {{ $sizeClasses }} border border-slate-200/80 dark:border-slate-800/90 animate__animated transition-all duration-300">
            
            <!-- Mobile Pull-down Indicator Bar -->
            <div class="sm:hidden w-12 h-1.5 bg-slate-300 dark:bg-slate-700 rounded-full mx-auto mt-3.5 mb-1 cursor-pointer" onclick="window.closeModal('{{ $id }}')"></div>

            @if ($title)
                <div class="flex items-center justify-between px-5 pt-4 pb-4 sm:px-6 sm:pt-5 border-b border-slate-100/80 dark:border-slate-800/80">
                    <div class="flex items-center gap-3 min-w-0 pr-2">
                        @if ($icon)
                            <div class="w-10 h-10 rounded-2xl {{ $iconPalettes }} flex items-center justify-center shrink-0 shadow-xs">
                                <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-slate-50 tracking-tight truncate" id="{{ $id }}-title">
                                {{ $title }}
                            </h3>
                            @if ($subtitle)
                                <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium truncate mt-0.5">{{ $subtitle }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Clean Circular Close Button -->
                    <button
                        type="button"
                        class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 flex items-center justify-center transition-all cursor-pointer shrink-0 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        onclick="window.closeModal('{{ $id }}')"
                        aria-label="Close dialog"
                    >
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            <div class="px-5 py-4 sm:px-6 sm:py-5 max-h-[75vh] sm:max-h-[80vh] overflow-y-auto overscroll-contain">
                {{ $slot }}
            </div>

            @if (isset($footer))
                <div class="bg-slate-50/80 dark:bg-slate-800/40 backdrop-blur-xs px-5 py-3.5 sm:px-6 sm:py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-2.5 sm:gap-3 border-t border-slate-100/80 dark:border-slate-800/80">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
