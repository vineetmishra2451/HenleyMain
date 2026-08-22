@props([
    'price' => 0, // float, int paise, or formatted string
    'compareAtPrice' => null,
    'minPrice' => null,
    'maxPrice' => null,
    'size' => 'card', // card (20px) | hero (32px) | sm (16px)
    'currency' => '₹',
])

@php
$sizeClasses = match ($size) {
    'hero' => 'text-price-hero',
    'sm' => 'text-body font-medium',
    default => 'text-price-card',
};

// Format function if given number
$format = function ($val) use ($currency) {
    if (is_string($val) && (str_contains($val, '₹') || str_contains($val, 'Rs'))) {
        return $val;
    }
    $num = (float) $val;
    return $currency.number_format($num, 2);
};
@endphp

<div {{ $attributes->merge(['class' => "inline-flex items-baseline gap-2 font-serif text-primary tracking-tight select-none {$sizeClasses}"]) }}>
    @if ($minPrice !== null && $maxPrice !== null && $minPrice < $maxPrice)
        <span>{{ $format($minPrice) }} – {{ $format($maxPrice) }}</span>
    @else
        <span>{{ $format($price) }}</span>

        @if ($compareAtPrice && (float) $compareAtPrice > (float) $price)
            <span class="font-sans text-sm font-normal text-muted line-through">
                {{ $format($compareAtPrice) }}
            </span>
        @endif
    @endif
</div>
