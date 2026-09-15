@props([
    'id' => 'alert-dialog-' . md5(uniqid(rand(), true)),
    'title' => 'Notice',
    'subtitle' => null,
    'type' => 'info', // 'info', 'success', 'warning', 'danger', 'security'
    'confirm' => false, // false = simple alert/popup (1 button), true = confirmation modal (Cancel + Confirm)
    'confirmText' => 'Confirm',
    'confirmVariant' => null, // defaults based on type
    'cancelText' => 'Cancel',
    'onConfirm' => null, // JS expression or function to execute on confirm
    'onCancel' => null,
    'size' => 'sm', // 'sm', 'md'
])

@php
$sizeClasses = match($size) {
    'md' => 'sm:max-w-lg',
    default => 'sm:max-w-md',
};

$iconConfig = match($type) {
    'success' => [
        'bg' => 'bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30 ring-8 ring-emerald-500/5',
        'defaultButton' => 'primary',
        'icon' => 'check-circle-2',
    ],
    'warning' => [
        'bg' => 'bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/30 ring-8 ring-amber-500/5',
        'defaultButton' => 'warning',
        'icon' => 'alert-triangle',
    ],
    'danger' => [
        'bg' => 'bg-rose-500/10 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 border border-rose-500/30 ring-8 ring-rose-500/5',
        'defaultButton' => 'danger',
        'icon' => 'shield-alert',
    ],
    'security' => [
        'bg' => 'bg-purple-500/10 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 border border-purple-500/30 ring-8 ring-purple-500/5',
        'defaultButton' => 'primary',
        'icon' => 'fingerprint',
    ],
    default => [
        'bg' => 'bg-blue-500/10 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 border border-blue-500/30 ring-8 ring-blue-500/5',
        'defaultButton' => 'primary',
        'icon' => 'info',
    ],
};

$btnVariant = $confirmVariant ?? $iconConfig['defaultButton'];
$cancelAction = $onCancel ? "$onCancel; window.closeModal('$id')" : "window.closeModal('$id')";
$confirmAction = $onConfirm ? "$onConfirm; window.closeModal('$id')" : "window.closeModal('$id')";
@endphp

<div
    id="{{ $id }}"
    class="fixed inset-0 z-50 overflow-y-auto hidden"
    aria-labelledby="{{ $id }}-title"
    role="alertdialog"
    aria-modal="true"
>
    <!-- Deep Glassmorphic Backdrop -->
    <div
        class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-all duration-300"
        onclick="{{ $cancelAction }}"
    ></div>

    <div class="flex min-h-full items-end justify-center p-0 text-center sm:items-center sm:p-4 sm:pb-8">
        <!-- Modern Floating Card: Mobile bottom sheet with drag indicator, centered card on desktop with Animate.css -->
        <div class="modal-bottom-sheet relative w-full transform overflow-hidden rounded-t-[2.25rem] sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl text-left shadow-2xl shadow-slate-950/40 {{ $sizeClasses }} border border-slate-200/80 dark:border-slate-800 animate__animated transition-all duration-300">
            
            <!-- Mobile pull-down indicator bar -->
            <div class="sm:hidden w-12 h-1.5 bg-slate-300 dark:bg-slate-700 rounded-full mx-auto mt-3.5 mb-1 cursor-pointer" onclick="{{ $cancelAction }}"></div>

            <div class="p-6 sm:p-7 text-center">
                <!-- Glowing Floating Icon Badge -->
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl {{ $iconConfig['bg'] }} mb-4 transition-all duration-300 hover:scale-105 shadow-sm">
                    <i data-lucide="{{ $iconConfig['icon'] }}" class="w-8 h-8"></i>
                </div>

                <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-slate-50 tracking-tight" id="{{ $id }}-title">
                    {{ $title }}
                </h3>

                @if ($subtitle)
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-medium mt-1">
                        {{ $subtitle }}
                    </p>
                @endif

                <div class="mt-3 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed max-w-sm mx-auto">
                    {{ $slot }}
                </div>

                <!-- Action Footer -->
                <div class="mt-6 flex {{ $confirm ? 'flex-col-reverse sm:flex-row sm:justify-center' : 'flex-col sm:flex-row sm:justify-center' }} gap-2.5 sm:gap-3">
                    @if ($confirm)
                        <button
                            type="button"
                            class="w-full sm:w-1/2 py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 font-bold text-xs transition-all active:scale-[0.98] cursor-pointer"
                            onclick="{{ $cancelAction }}"
                        >
                            {{ $cancelText }}
                        </button>

                        <button
                            type="button"
                            class="w-full sm:w-1/2 py-2.5 px-4 rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer flex items-center justify-center gap-2 {{ $type === 'danger' ? 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-600/20' : ($type === 'warning' ? 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/20' : 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20') }}"
                            onclick="{{ $confirmAction }}"
                        >
                            <span>{{ $confirmText }}</span>
                        </button>
                    @else
                        <button
                            type="button"
                            class="w-full sm:w-auto sm:min-w-[140px] py-2.5 px-5 rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer {{ $type === 'danger' ? 'bg-rose-600 hover:bg-rose-700 text-white' : ($type === 'warning' ? 'bg-amber-600 hover:bg-amber-700 text-white' : 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20') }}"
                            onclick="{{ $confirmAction }}"
                        >
                            {{ $confirmText }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
