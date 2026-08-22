@props([
    'variant' => 'text', // text | card | circle | rect
    'width' => 'w-full',
    'height' => 'h-4',
])

@php
$variantClasses = match ($variant) {
    'circle' => 'rounded-full h-12 w-12',
    'card' => 'rounded-xl h-72 w-full',
    'rect' => "rounded-lg {$width} {$height}",
    default => "rounded-md {$width} {$height}",
};
@endphp

<div
    aria-hidden="true"
    {{ $attributes->merge(['class' => "animate-pulse bg-surface-raised border border-hairline/40 {$variantClasses}"]) }}
></div>
