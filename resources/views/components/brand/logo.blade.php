@props([
    'variant' => 'default', // default (primary #231C18) | accent (oxblood #5C2225) | inverse (white/canvas)
    'showTagline' => false,
])

@php
$textClass = match ($variant) {
    'accent' => 'text-accent',
    'inverse' => 'text-inverse',
    default => 'text-primary',
};
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex flex-col items-center justify-center select-none group']) }}>
    <!-- Henley Wordmark -->
    <span class="font-sans text-2xl sm:text-3xl font-bold tracking-[0.28em] uppercase {{ $textClass }} leading-none transition-colors duration-250">
        HENLEY
    </span>

    @if ($showTagline)
        <span class="font-sans text-[9px] uppercase tracking-[0.32em] text-gold font-medium mt-1">
            Single-Origin Reserve
        </span>
    @endif
</div>
