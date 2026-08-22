@props([
    'variant' => 'ghost', // ghost | secondary | primary
    'size' => 'md', // sm | md | lg
    'label' => 'Action',
    'type' => 'button',
])

@php
$baseClasses = 'inline-flex items-center justify-center rounded-full transition-all duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer select-none';

$sizeClasses = match ($size) {
    'sm' => 'w-8 h-8 p-1.5',
    'md' => 'w-10 h-10 p-2.5',
    'lg' => 'w-12 h-12 p-3.5',
    default => 'w-10 h-10 p-2.5',
};

$variantClasses = match ($variant) {
    'primary' => 'bg-accent text-inverse hover:bg-accent-hover active:bg-accent-deep',
    'secondary' => 'bg-transparent text-primary border border-hairline hover:border-accent hover:text-accent active:bg-surface-raised',
    'ghost' => 'bg-transparent text-secondary hover:text-accent hover:bg-surface-raised active:bg-hairline/40',
    default => 'bg-transparent text-secondary hover:text-accent hover:bg-surface-raised',
};

$classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

<button
    type="{{ $type }}"
    aria-label="{{ $label }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>
