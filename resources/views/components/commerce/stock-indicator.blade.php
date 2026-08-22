@props([
    'status' => 'in_stock', // in_stock | low_stock | out_of_stock
    'quantity' => null,
])

@php
$dotClasses = match ($status) {
    'low_stock', 'low-stock' => 'bg-saffron ring-4 ring-saffron-surface',
    'out_of_stock', 'out-of-stock' => 'bg-muted ring-4 ring-hairline',
    default => 'bg-sage ring-4 ring-sage-surface',
};

$label = match ($status) {
    'low_stock', 'low-stock' => ($quantity ? "Only {$quantity} remaining" : 'Low stock'),
    'out_of_stock', 'out-of-stock' => 'Harvest currently resting (Sold out)',
    default => 'In stock — Harvested & sealed at origin',
};
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 font-sans text-caption text-secondary']) }}>
    <span class="inline-block h-2 w-2 rounded-full {{ $dotClasses }}" aria-hidden="true"></span>
    <span>{{ $label }}</span>
</div>
