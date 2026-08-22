@props([
    'variant' => 'primary', // primary | secondary | ghost | destructive
    'size' => 'md', // sm | md | lg
    'href' => '#',
    'trailingArrow' => false,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-sans font-medium uppercase tracking-[0.16em] rounded-full transition-all duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent group select-none no-underline';

$sizeClasses = match ($size) {
    'sm' => 'text-[11px] px-4 py-2 gap-1.5',
    'md' => 'text-[13px] px-6 py-3 gap-2',
    'lg' => 'text-[14px] px-8 py-4 gap-2.5',
    default => 'text-[13px] px-6 py-3 gap-2',
};

$variantClasses = match ($variant) {
    'primary' => 'bg-accent text-inverse hover:bg-accent-hover active:bg-accent-deep shadow-none',
    'secondary' => 'bg-transparent text-primary border border-hairline hover:border-accent hover:text-accent active:bg-surface-raised',
    'ghost' => 'bg-transparent text-secondary hover:text-accent hover:bg-surface-raised active:bg-hairline/40',
    'destructive' => 'bg-error text-inverse hover:opacity-90 active:opacity-100',
    default => 'bg-accent text-inverse hover:bg-accent-hover active:bg-accent-deep',
};

$classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}

    @if ($trailingArrow)
        <span class="inline-block transition-transform duration-250 ease-henley group-hover:translate-x-1" aria-hidden="true">→</span>
    @endif
</a>
