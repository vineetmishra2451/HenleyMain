@props([
    'payload' => [],
])

@php
$items = $payload['items'] ?? [
    ['icon' => 'leaf', 'label' => 'Single-Estate Origin', 'caption' => 'Traceable directly to prime mountain slopes'],
    ['icon' => 'package', 'label' => 'Apothecary Sealed', 'caption' => 'Flushed with nitrogen in porcelain tins'],
    ['icon' => 'truck', 'label' => 'Complimentary Delivery', 'caption' => 'Express air courier on orders over ₹1,500'],
    ['icon' => 'shield-check', 'label' => '100% Biodynamic Purity', 'caption' => 'Zero synthetic pesticides or artificial aromas'],
];
@endphp

<section class="w-full bg-canvas py-4">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12">
        <x-commerce.trust-badge-strip :items="$items" class="my-6 shadow-none" />
    </div>
</section>
