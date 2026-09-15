@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'helper' => null,
    'error' => null,
    'required' => false,
    'placeholder' => 'Select an option',
    'searchPlaceholder' => 'Search bank or institution...',
    'options' => [], // array of ['value' => '...', 'label' => '...', 'sub' => '...', 'icon' => '...'] or key => value
    'selected' => null,
    'focusRing' => 'emerald', // 'emerald', 'indigo'
])

@php
$id = $id ?? ($name ?? 'searchable-select-' . md5(uniqid(rand(), true)));

$normalizedOptions = [];
foreach ($options as $key => $item) {
    if (is_array($item)) {
        $normalizedOptions[] = [
            'value' => (string)($item['value'] ?? $key),
            'label' => (string)($item['label'] ?? $item['value'] ?? $key),
            'sub'   => $item['sub'] ?? null,
            'icon'  => $item['icon'] ?? null,
        ];
    } else {
        $normalizedOptions[] = [
            'value' => (string)$key,
            'label' => (string)$item,
            'sub'   => null,
            'icon'  => null,
        ];
    }
}

$initialSelectedOption = null;
if ($selected !== null) {
    foreach ($normalizedOptions as $opt) {
        if ($opt['value'] === (string)$selected) {
            $initialSelectedOption = $opt;
            break;
        }
    }
}
if (!$initialSelectedOption && count($normalizedOptions) > 0) {
    $initialSelectedOption = $normalizedOptions[0];
}

$ringClasses = match($focusRing) {
    'indigo' => 'focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 border-indigo-500',
    default => 'focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 border-emerald-500',
};

$activeItemBg = match($focusRing) {
    'indigo' => 'bg-indigo-50/70 dark:bg-indigo-950/40 border border-indigo-200/80 dark:border-indigo-800/60 shadow-2xs',
    default => 'bg-gradient-to-br from-emerald-50/90 via-emerald-50/40 to-white dark:from-emerald-950/40 dark:via-slate-900 dark:to-slate-900 border-2 border-emerald-500 shadow-sm shadow-emerald-500/5',
};

$activeIconBg = match($focusRing) {
    'indigo' => 'bg-gradient-to-tr from-indigo-600 to-blue-500 text-white shadow-md shadow-indigo-600/25',
    default => 'bg-gradient-to-tr from-emerald-600 to-teal-500 text-white shadow-md shadow-emerald-600/25',
};

$activeCheckBg = match($focusRing) {
    'indigo' => 'bg-indigo-600',
    default => 'bg-emerald-600',
};

$activeTextColor = match($focusRing) {
    'indigo' => 'text-indigo-700 dark:text-indigo-300',
    default => 'text-emerald-700 dark:text-emerald-300',
};
@endphp

<div class="w-full relative select-none" id="{{ $id }}-container">
    @if ($label)
        <label for="{{ $id }}-trigger" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 font-sans tracking-tight">
            {{ $label }}
            @if ($required)
                <span class="text-rose-500 font-bold">*</span>
            @endif
        </label>
    @endif

    <!-- Hidden Native Input for standard form submits and JS queries -->
    <input
        type="hidden"
        id="{{ $id }}"
        name="{{ $name ?? $id }}"
        value="{{ $initialSelectedOption ? $initialSelectedOption['value'] : '' }}"
        {{ $attributes }}
    />

    <!-- Dropdown Trigger Button -->
    <button
        type="button"
        id="{{ $id }}-trigger"
        onclick="window['{{ $id }}_toggle']()"
        class="w-full py-2.5 sm:py-3 pl-3.5 sm:pl-4 pr-10 text-left bg-white dark:bg-slate-900 border border-slate-300/90 dark:border-slate-700/90 hover:border-slate-400 dark:hover:border-slate-600 rounded-2xl shadow-2xs transition-all cursor-pointer flex items-center justify-between group focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
    >
        <div class="flex items-center gap-2.5 min-w-0 pr-2">
            <div id="{{ $id }}-selected-icon" class="w-7 h-7 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center shrink-0 text-xs font-black">
                <i data-lucide="landmark" class="w-4 h-4 text-slate-500"></i>
            </div>
            <div class="min-w-0">
                <p id="{{ $id }}-selected-label" class="text-xs sm:text-sm font-semibold text-slate-900 dark:text-slate-100 truncate tracking-tight">
                    {{ $initialSelectedOption ? $initialSelectedOption['label'] : $placeholder }}
                </p>
                <p id="{{ $id }}-selected-sub" class="text-[10px] text-slate-400 truncate {{ empty($initialSelectedOption['sub']) ? 'hidden' : '' }}">
                    {{ $initialSelectedOption['sub'] ?? '' }}
                </p>
            </div>
        </div>

        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200 transition-colors pointer-events-none">
            <svg id="{{ $id }}-chevron" class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </div>
    </button>

    <!-- Searchable Menu Panel -->
    <div
        id="{{ $id }}-panel"
        class="hidden absolute z-50 left-0 right-0 mt-2 p-2 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-xl shadow-slate-950/10 backdrop-blur-xl transition-all duration-150 origin-top"
    >
        <!-- Search Input Box -->
        <div class="relative mb-2">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
            </div>
            <input
                type="text"
                id="{{ $id }}-search"
                placeholder="{{ $searchPlaceholder }}"
                oninput="window['{{ $id }}_filter'](this.value)"
                class="w-full py-2 pl-9 pr-8 text-xs font-medium rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/60 focus:bg-white dark:focus:bg-slate-900 {{ $focusRing === 'indigo' ? 'focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20' : 'focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20' }} focus:outline-none text-slate-900 dark:text-slate-100 placeholder:text-slate-400 transition-all font-sans"
            />
            <button
                type="button"
                id="{{ $id }}-search-clear"
                onclick="window['{{ $id }}_clearSearch']()"
                class="hidden absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-0.5 cursor-pointer"
            >
                <i data-lucide="x" class="w-3 h-3"></i>
            </button>
        </div>

        <!-- Options List -->
        <div
            id="{{ $id }}-list"
            class="max-h-56 overflow-y-auto space-y-1 pr-1 scrollbar-thin scrollbar-thumb-slate-200 dark:scrollbar-thumb-slate-800"
        >
            @foreach ($normalizedOptions as $opt)
                @php
                    $isSelected = $initialSelectedOption && $initialSelectedOption['value'] === $opt['value'];
                @endphp
                <button
                    type="button"
                    data-value="{{ $opt['value'] }}"
                    data-label="{{ $opt['label'] }}"
                    data-sub="{{ $opt['sub'] ?? '' }}"
                    onclick="window['{{ $id }}_select']('{{ addslashes($opt['value']) }}', '{{ addslashes($opt['label']) }}', '{{ addslashes($opt['sub'] ?? '') }}')"
                    class="{{ $id }}-item w-full p-2.5 pr-8 rounded-xl text-left transition-colors flex items-center gap-2.5 cursor-pointer group relative hover:bg-slate-50 dark:hover:bg-slate-800/80 {{ $isSelected ? $activeItemBg : 'text-slate-800 dark:text-slate-200' }}"
                >
                    <div class="flex items-center gap-2.5 min-w-0 flex-1">
                        <div class="{{ $id }}-icon w-8 h-8 rounded-xl {{ $isSelected ? $activeIconBg : ($focusRing === 'indigo' ? 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 group-hover:bg-indigo-50 dark:group-hover:bg-indigo-950/40' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 group-hover:bg-emerald-50 dark:group-hover:bg-emerald-950/40') }} flex items-center justify-center shrink-0 text-xs font-bold transition-colors">
                            <i data-lucide="landmark" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold leading-snug truncate text-inherit {{ $isSelected ? $activeTextColor : '' }}">{{ $opt['label'] }}</p>
                            @if (!empty($opt['sub']))
                                <p class="text-[10px] text-slate-400 dark:text-slate-500 truncate mt-0.5">{{ $opt['sub'] }}</p>
                            @endif
                        </div>
                    </div>
                    <span class="{{ $id }}-check {{ $isSelected ? '' : 'hidden' }} absolute top-2.5 right-2.5 w-4.5 h-4.5 rounded-full {{ $activeCheckBg }} text-white flex items-center justify-center shadow-xs ring-2 ring-white dark:ring-slate-900">
                        <svg class="w-2.5 h-2.5 stroke-[3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </span>
                </button>
            @endforeach
        </div>

        <!-- Empty State -->
        <div id="{{ $id }}-empty" class="hidden py-6 text-center text-xs text-slate-400">
            <i data-lucide="search-x" class="w-5 h-5 mx-auto mb-1 text-slate-300 dark:text-slate-600"></i>
            <span>No matching institutions found</span>
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

<script>
(function() {
    const id = "{{ $id }}";
    const panel = document.getElementById(`${id}-panel`);
    const chevron = document.getElementById(`${id}-chevron`);
    const searchInput = document.getElementById(`${id}-search`);
    const searchClear = document.getElementById(`${id}-search-clear`);
    const emptyState = document.getElementById(`${id}-empty`);
    const hiddenInput = document.getElementById(id);
    const labelElem = document.getElementById(`${id}-selected-label`);
    const subElem = document.getElementById(`${id}-selected-sub`);

    window[`${id}_toggle`] = function() {
        const isHidden = panel.classList.contains('hidden');
        if (isHidden) {
            panel.classList.remove('hidden');
            chevron.classList.add('rotate-180');
            setTimeout(() => searchInput.focus(), 50);
            if (window.refreshLucideIcons) window.refreshLucideIcons();
        } else {
            panel.classList.add('hidden');
            chevron.classList.remove('rotate-180');
        }
    };

    window[`${id}_close`] = function() {
        panel.classList.add('hidden');
        chevron.classList.remove('rotate-180');
    };

    window[`${id}_filter`] = function(query) {
        query = query.toLowerCase().trim();
        if (query.length > 0) {
            searchClear.classList.remove('hidden');
        } else {
            searchClear.classList.add('hidden');
        }

        const items = document.querySelectorAll(`.${id}-item`);
        let visibleCount = 0;

        items.forEach(item => {
            const label = (item.getAttribute('data-label') || '').toLowerCase();
            const sub = (item.getAttribute('data-sub') || '').toLowerCase();
            const val = (item.getAttribute('data-value') || '').toLowerCase();

            if (label.includes(query) || sub.includes(query) || val.includes(query)) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });

        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
            if (window.refreshLucideIcons) window.refreshLucideIcons();
        } else {
            emptyState.classList.add('hidden');
        }
    };

    window[`${id}_clearSearch`] = function() {
        searchInput.value = '';
        window[`${id}_filter`]('');
        searchInput.focus();
    };

    window[`${id}_select`] = function(value, label, sub) {
        hiddenInput.value = value;
        labelElem.textContent = label;
        if (sub) {
            subElem.textContent = sub;
            subElem.classList.remove('hidden');
        } else {
            subElem.classList.add('hidden');
        }

        // Update active classes
        document.querySelectorAll(`.${id}-item`).forEach(item => {
            const itemVal = item.getAttribute('data-value');
            const check = item.querySelector(`.${id}-check`);
            const title = item.querySelector('p:first-child');
            const icon = item.querySelector(`.${id}-icon`);
            if (itemVal === value) {
                item.className = `{{ $id }}-item w-full p-2.5 pr-8 rounded-xl text-left transition-colors flex items-center gap-2.5 cursor-pointer group relative {{ $activeItemBg }}`;
                if (title) title.className = "text-xs font-bold leading-snug truncate {{ $activeTextColor }}";
                if (icon) icon.className = "{{ $id }}-icon w-8 h-8 rounded-xl {{ $activeIconBg }} flex items-center justify-center shrink-0 text-xs font-bold transition-colors";
                if (check) check.classList.remove('hidden');
            } else {
                item.className = `{{ $id }}-item w-full p-2.5 pr-8 rounded-xl text-left transition-colors flex items-center gap-2.5 cursor-pointer group relative hover:bg-slate-50 dark:hover:bg-slate-800/80 text-slate-800 dark:text-slate-200`;
                if (title) title.className = "text-xs font-semibold leading-snug truncate text-slate-900 dark:text-slate-100";
                if (icon) icon.className = "{{ $id }}-icon w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 {{ $focusRing === 'indigo' ? 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400 group-hover:bg-indigo-50 dark:group-hover:bg-indigo-950/40' : 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400 group-hover:bg-emerald-50 dark:group-hover:bg-emerald-950/40' }} flex items-center justify-center shrink-0 text-xs font-bold transition-colors";
                if (check) check.classList.add('hidden');
            }
        });

        // Trigger change event on native hidden input
        hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));

        window[`${id}_close`]();
    };

    // Close when clicking outside
    document.addEventListener('click', function(e) {
        const container = document.getElementById(`${id}-container`);
        if (container && !container.contains(e.target)) {
            window[`${id}_close`]();
        }
    });
})();
</script>
