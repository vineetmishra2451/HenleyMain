@props([
    'products' => [],
    'payload' => [],
])

@php
$title = $payload['title'] ?? 'The Bestsellers';
$eyebrow = $payload['eyebrow'] ?? 'Most Coveted Rituals';
$description = $payload['description'] ?? 'Our definitive single-estate lots and aromatic staples celebrated by tea masters and collectors.';
@endphp

<section class="w-full bg-surface-raised py-20 sm:py-24 border-y border-hairline">
    <x-container>
        <x-section-heading
            :eyebrow="$eyebrow"
            :title="$title"
            :description="$description"
            align="center"
        />

        @if (! empty($products) && count($products) > 0)
            <!-- Mobile Horizontal Snap-Scroller & Desktop Grid (Zero Carousel Dependency) -->
            <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-6 overflow-x-auto sm:overflow-visible pb-4 sm:pb-0 snap-x snap-mandatory -mx-5 px-5 sm:mx-0 sm:px-0">
                @foreach ($products as $index => $product)
                    <div class="min-w-[280px] sm:min-w-0 snap-center flex-shrink-0 sm:flex-shrink">
                        <x-commerce.product-card
                            :title="$product->name"
                            :subtitle="$product->subtitle ?? ($product->vendor->business_name ?? 'Castleton Estate')"
                            :price="$product->base_price"
                            :compare-at-price="$product->compare_at_price"
                            :rating="5.0"
                            :rating-count="rand(28, 96)"
                            :badge="'No. ' . ($index + 1) . ' Bestseller'"
                            badge-variant="gold"
                            :href="'/shop'"
                        >
                            <x-slot:action>
                                <button
                                    type="button"
                                    x-data
                                    x-on:click="$dispatch('cart-updated', { count: 1 }); $dispatch('open-drawer', 'cart-drawer')"
                                    aria-label="Add {{ $product->name }} to ritual basket"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-accent text-inverse hover:bg-accent-hover transition duration-200"
                                >
                                    <x-icons.plus class="w-3.5 h-3.5" />
                                </button>
                            </x-slot:action>
                        </x-commerce.product-card>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Graceful Empty State -->
            <x-empty-state
                title="Bestseller archive refreshing"
                description="Our seasonal curation will be updated after the current harvest cycle."
                icon="package"
            />
        @endif
    </x-container>
</section>
