@props([
    'collections' => [],
    'payload' => [],
])

@php
$title = $payload['title'] ?? 'Curated Collections';
$eyebrow = $payload['eyebrow'] ?? 'The Scent of Terroir';
$description = $payload['description'] ?? 'Single-origin flushes, rare restorative tisanes, and sun-dried wild botanicals categorized by harvest altitude and flavor signature.';
@endphp

<section class="w-full bg-surface-raised py-20 sm:py-24 border-y border-hairline">
    <x-container>
        <x-section-heading
            :eyebrow="$eyebrow"
            :title="$title"
            :description="$description"
            align="center"
        />

        @if (! empty($collections) && count($collections) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($collections as $index => $col)
                    <x-commerce.collection-card
                        :title="$col->name"
                        :subtitle="($col->products_count ?? $col->products()->count()).' Pure Botanicals'"
                        :description="$col->description ?? 'Single-garden orthodox leaves picked across Himalayan slopes.'"
                        :image="($index === 0 ? '/images/brand/product.jpeg' : ($index === 1 ? '/images/brand/collectionpage.jpeg' : '/images/brand/productpage.jpeg'))"
                        :href="'/collections/'.($col->slug ?? 'single-origin-reserve')"
                        :arch-motif="$index === 0"
                    />
                @endforeach
            </div>
        @else
            <!-- Graceful Empty State -->
            <x-empty-state
                title="Curations currently resting"
                description="Our seasonal collections are undergoing estate replenishment."
                icon="package"
            />
        @endif
    </x-container>
</section>
