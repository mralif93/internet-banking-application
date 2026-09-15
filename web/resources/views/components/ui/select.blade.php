@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'helper' => null,
    'error' => null,
    'prefix' => null,
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Select an option',
    'options' => [], // ['val' => 'Label'] or simple array
    'selected' => null,
    'size' => 'md', // 'sm', 'md', 'lg'
    'borderless' => false,
    'shadow' => null,
    'focusRing' => 'emerald', // 'emerald', 'indigo', 'pink'
])

@php
$id = $id ?? ($name ?? 'select-' . md5(uniqid(rand(), true)));

$sizeClasses = match($size) {
    'sm' => 'py-2 ' . ($prefix ? 'pl-9 ' : 'pl-3.5 ') . 'pr-9 text-xs rounded-xl font-medium',
    'lg' => 'py-3.5 ' . ($prefix ? 'pl-12 ' : 'pl-4 ') . 'pr-12 text-sm sm:text-base rounded-2xl font-medium',
    default => 'py-2.5 sm:py-3 ' . ($prefix ? 'pl-11 ' : 'pl-4 ') . 'pr-10 text-xs sm:text-sm rounded-2xl font-medium',
};

$prefixIconPos = match($size) {
    'sm' => 'left-3',
    'lg' => 'left-4',
    default => 'left-3.5',
};

$ringColorClass = match($focusRing) {
    'pink' => 'focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20',
    'indigo' => 'focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20',
    default => 'focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20',
};

if ($borderless) {
    $borderClasses = $error
        ? 'border-2 border-rose-500 focus:ring-2 focus:ring-rose-500/20 text-rose-900 dark:text-rose-200'
        : 'border-0 ring-0 ' . $ringColorClass;
} else {
    $borderClasses = $error
        ? 'border border-rose-500 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 text-rose-900 dark:text-rose-200'
        : 'border border-slate-300/90 dark:border-slate-700/90 hover:border-slate-400 dark:hover:border-slate-600 ' . $ringColorClass;
}

$shadowClass = $shadow ?? ($borderless ? 'shadow-xs' : 'shadow-2xs');
@endphp

<div class="w-full">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">
            {{ $label }}
            @if ($required)
                <span class="text-rose-500 font-bold">*</span>
            @endif
        </label>
    @endif

    <div class="relative group {{ $shadowClass }}">
        @if ($prefix || isset($prefixSlot))
            <div class="absolute inset-y-0 {{ $prefixIconPos }} flex items-center pointer-events-none text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300 text-sm font-medium z-10 transition-colors">
                {!! $prefixSlot ?? $prefix !!}
            </div>
        @endif

        <select
            id="{{ $id }}"
            name="{{ $name }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => "appearance-none block w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 font-sans transition-all duration-150 cursor-pointer " . 
                    $sizeClasses . " " . 
                    $borderClasses . 
                    " focus:outline-none disabled:bg-slate-100 dark:disabled:bg-slate-800 disabled:cursor-not-allowed"
            ]) }}
        >
            @if ($placeholder)
                <option value="" disabled {{ $selected === null ? 'selected' : '' }}>{{ $placeholder }}</option>
            @endif

            @if (count($options) > 0)
                @foreach ($options as $val => $text)
                    <option value="{{ $val }}" {{ (string)$selected === (string)$val ? 'selected' : '' }}>
                        {{ $text }}
                    </option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300 transition-colors">
            <svg class="w-4 h-4 transition-transform duration-200 group-focus-within:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </div>
    </div>

    @if ($error)
        <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400 flex items-center gap-1 font-semibold">
            <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span>{{ $error }}</span>
        </p>
    @elseif ($helper)
        <p class="mt-1.5 text-[11px] text-slate-500 dark:text-slate-400">
            {{ $helper }}
        </p>
    @endif
</div>
