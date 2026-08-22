@props([
    'variant' => 'primary', // primary | secondary | ghost | destructive
    'size' => 'md', // sm | md | lg
    'type' => 'button',
    'trailingArrow' => false,
    'loading' => false,
    'disabled' => false,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-sans font-medium uppercase tracking-[0.16em] rounded-full transition-all duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer group select-none';

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

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
    @if ($disabled) disabled @endif
>
    @if ($loading)
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif

    {{ $slot }}

    @if ($trailingArrow)
        <span class="inline-block transition-transform duration-250 ease-henley group-hover:translate-x-1" aria-hidden="true">→</span>
    @endif
</button>
