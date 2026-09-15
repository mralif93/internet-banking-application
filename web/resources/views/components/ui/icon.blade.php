@props([
    'name', // Lucide icon name, e.g. 'shield-check', 'arrow-right', 'lock', 'user'
    'class' => 'w-5 h-5',
    'size' => null, // optional numeric size in px e.g. 20
    'strokeWidth' => '2',
])

<i
    data-lucide="{{ $name }}"
    {{ $attributes->merge([
        'class' => $class,
        'data-lucide-size' => $size,
        'data-lucide-stroke-width' => $strokeWidth,
    ]) }}
></i>
