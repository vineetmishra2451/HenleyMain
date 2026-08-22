@props([
    'products' => [],
    'payload' => [],
])

@php
$title = $payload['title'] ?? 'The Seasonal Reserve';
$eyebrow = $payload['eyebrow'] ?? 'Spring 2026 Micro-Lots';
$description = $payload['description'] ?? 'Small-batch flushes harvested at the height of aromatic expression, sealed at garden origin.';
@endphp

<section class="w-full bg-canvas py-20 sm:py-24">
    <x-container>
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 sm:mb-16 gap-6">
            <x-section-heading
                :eyebrow="$eyebrow"
                :title="$title"
                :description="$description"
                align="left"
                class="mb-0"
            />

            <x-link-button href="/shop" variant="secondary" size="md" trailing-arrow class="self-start md:self-end flex-shrink-0">
                View Full Catalog
            </x-link-button>
        </div>

        @if (! empty($products) && count($products) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <x-commerce.product-card
                        :title="$product->name"
                        :subtitle="$product->subtitle ?? ($product->vendor->business_name ?? 'Single Estate')"
                        :price="$product->base_price"
                        :compare-at-price="$product->compare_at_price"
                        :rating="5.0"
                        :rating-count="rand(12, 48)"
                        :badge="$product->is_featured ? 'Reserve' : null"
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
                @endforeach
            </div>
        @else
            <!-- Graceful Empty State -->
            <x-empty-state
                title="No featured harvests available"
                description="New single-origin allocations are currently being fired and graded."
                icon="package"
            />
        @endif
    </x-container>
</section>
