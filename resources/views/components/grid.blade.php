@props([
    'cols' => 3, // 1 | 2 | 3 | 4 | 5 | 6
    'gap' => 'default', // default | compact | wide
])

@php
$colClasses = match ((int) $cols) {
    1 => 'grid-cols-1',
    2 => 'grid-cols-1 sm:grid-cols-2',
    4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
    5 => 'grid-cols-2 sm:grid-cols-3 lg:grid-cols-5',
    6 => 'grid-cols-2 sm:grid-cols-3 lg:grid-cols-6',
    default => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
};

$gapClasses = match ($gap) {
    'compact' => 'gap-4 sm:gap-6',
    'wide' => 'gap-8 sm:gap-12',
    default => 'gap-6 sm:gap-8',
};
@endphp

<div {{ $attributes->merge(['class' => "grid {$colClasses} {$gapClasses}"]) }}>
    {{ $slot }}
</div>
