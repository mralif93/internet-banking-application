@props([
    'label' => null,
    'labelRight' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => '',
    'helper' => null,
    'error' => null,
    'prefix' => null,
    'suffix' => null,
    'required' => false,
    'disabled' => false,
    'borderless' => false,
    'shadow' => null,
    'size' => 'md', // 'sm', 'md', 'lg'
])

@php
$id = $id ?? ($name ?? 'input-' . md5(uniqid(rand(), true)));

$sizeClasses = match($size) {
    'sm' => 'py-1.5 text-xs sm:text-sm rounded-lg',
    'lg' => 'py-3.5 text-base sm:text-lg rounded-2xl',
    default => 'py-2.5 text-sm sm:text-base rounded-xl',
};

$prefixPadding = match($size) {
    'sm' => ($prefix ? 'pl-9 ' : 'pl-3 ') . ($suffix ? 'pr-9 ' : 'pr-3 '),
    'lg' => ($prefix ? 'pl-12 ' : 'pl-4 ') . ($suffix ? 'pr-12 ' : 'pr-4 '),
    default => ($prefix ? 'pl-11 ' : 'pl-3.5 ') . ($suffix ? 'pr-11 ' : 'pr-3.5 '),
};

$prefixIconPos = match($size) {
    'sm' => 'pl-2.5',
    'lg' => 'pl-4',
    default => 'pl-3.5',
};

$suffixIconPos = match($size) {
    'sm' => 'pr-2.5',
    'lg' => 'pr-4',
    default => 'pr-3.5',
};

if ($borderless) {
    $borderClasses = $error
        ? 'border-2 border-rose-500 focus:ring-4 focus:ring-rose-500/20 text-rose-900 dark:text-rose-200'
        : 'border-0 ring-0 focus:ring-2 focus:ring-emerald-500/30 focus:shadow-emerald-500/10';
} else {
    $borderClasses = $error
        ? 'border border-rose-500 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/20 text-rose-900 dark:text-rose-200'
        : 'border border-slate-300 dark:border-slate-700 hover:border-slate-400 dark:hover:border-slate-600 focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-4 focus:ring-emerald-500/15';
}

$shadowClass = $shadow ?? ($borderless ? 'shadow-md shadow-slate-200/80 dark:shadow-slate-950/70' : 'shadow-xs');
@endphp

<div class="w-full">
    @if ($label || $labelRight)
        <div class="flex items-center justify-between mb-1.5">
            @if ($label)
                <label for="{{ $id }}" class="block {{ $size === 'sm' ? 'text-xs' : ($size === 'lg' ? 'text-sm sm:text-base' : 'text-xs sm:text-sm') }} font-medium text-slate-700 dark:text-slate-300">
                    {{ $label }}
                    @if ($required)
                        <span class="text-rose-500 font-semibold">*</span>
                    @endif
                </label>
            @endif

            @if ($labelRight)
                <div>
                    {!! $labelRight !!}
                </div>
            @endif
        </div>
    @endif


    <div class="relative {{ $size === 'sm' ? 'rounded-lg' : ($size === 'lg' ? 'rounded-2xl' : 'rounded-xl') }} {{ $shadowClass }}">
        @if ($prefix || isset($prefixSlot))
            <div class="absolute inset-y-0 left-0 {{ $prefixIconPos }} flex items-center pointer-events-none text-slate-500 dark:text-slate-400 text-sm font-medium">
                {!! $prefixSlot ?? $prefix !!}
            </div>
        @endif

        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => "block w-full bg-white dark:bg-slate-900/90 text-slate-900 dark:text-slate-100 transition-colors duration-150 " . 
                    $sizeClasses . " " . 
                    $prefixPadding . " " . 
                    $borderClasses . 
                    " focus:outline-none focus:ring-3 disabled:bg-slate-100 dark:disabled:bg-slate-800 disabled:cursor-not-allowed placeholder:text-slate-400 dark:placeholder:text-slate-500"
            ]) }}
        />

        @if ($suffix || isset($suffixSlot))
            <div class="absolute inset-y-0 right-0 {{ $suffixIconPos }} flex items-center text-slate-500 dark:text-slate-400 text-sm">
                {!! $suffixSlot ?? $suffix !!}
            </div>
        @endif
    </div>

    @if ($error)
        <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400 flex items-center gap-1 font-medium">
            <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span>{{ $error }}</span>
        </p>
    @elseif ($helper)
        <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">
            {{ $helper }}
        </p>
    @endif
</div>
