@props([
    'variant' => 'neutral', // neutral | sage (organic) | saffron (sale) | gold (bestseller) | accent (oxblood)
])

@php
$variantClasses = match ($variant) {
    'sage' => 'bg-sage-surface text-sage-text border border-sage/20',
    'saffron' => 'bg-saffron-surface text-saffron-text border border-saffron/20',
    'gold' => 'bg-gold-surface text-gold-text border border-gold/30',
    'accent' => 'bg-accent text-inverse',
    default => 'bg-surface-raised text-secondary border border-hairline',
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full font-sans text-badge uppercase font-bold tracking-[0.12em] select-none {$variantClasses}"]) }}>
    {{ $slot }}
</span>
