@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? '@HenleyBotanicals';
$title = $payload['title'] ?? 'Rituals from the Field';
$description = $payload['description'] ?? 'Glimpses of dawn harvests, high-mountain mist, and orthodox hand-rolling from our partner gardens.';

$frames = [
    ['caption' => 'First light mist over Castleton South slopes (1,850m)', 'image' => '/images/brand/homepage.jpeg'],
    ['caption' => 'Hermetic cloche porcelain seal testing at origin', 'image' => '/images/brand/product.jpeg'],
    ['caption' => 'Sorting Grade A1 Mongra saffron threads in Pampore', 'image' => '/images/brand/collectionpage.jpeg'],
    ['caption' => 'Wayanad green cardamom pods drying under indirect shade', 'image' => '/images/brand/productpage.jpeg'],
    ['caption' => 'Orthodox leaf rolling on bespoke wooden tables', 'image' => '/images/brand/product.jpeg'],
    ['caption' => 'The fifteen unhurried minutes ritual in bone porcelain', 'image' => '/images/brand/homepage.jpeg'],
];
@endphp

<section class="w-full bg-canvas py-20 sm:py-24">
    <x-container>
        <x-section-heading
            :eyebrow="$eyebrow"
            :title="$title"
            :description="$description"
            align="center"
        />

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($frames as $frame)
                <div class="group relative aspect-square rounded-xl overflow-hidden bg-surface-raised border border-hairline shadow-sm">
                    <img
                        src="{{ $frame['image'] }}"
                        alt="{{ $frame['caption'] }}"
                        loading="lazy"
                        class="h-full w-full object-cover object-center transition-transform duration-700 ease-henley group-hover:scale-110"
                    >
                    <div class="absolute inset-0 bg-primary/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-3 text-center">
                        <p class="font-sans text-[11px] text-inverse leading-snug">
                            {{ $frame['caption'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-container>
</section>
