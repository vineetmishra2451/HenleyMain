@props([
    'payload' => [],
    'products' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Current Season Micro-Lots';
$title = $payload['title'] ?? 'Featured Seasonal Allocations';
$description = $payload['description'] ?? 'Direct from the morning plucking of premier estates, each lot sealed at source in numbered cloche jars.';
$limit = (int) ($payload['limit'] ?? 4);

$items = $products ?? \App\Models\Product::active()
    ->featured()
    ->with(['images', 'categories'])
    ->take($limit)
    ->get();
@endphp

@if ($items->isNotEmpty())
    <section class="w-full bg-canvas py-16 sm:py-24">
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-12">
            <x-section-heading
                :eyebrow="$eyebrow"
                :title="$title"
                :description="$description"
                align="center"
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($items as $product)
                    <x-commerce.product-card
                        :title="$product->name"
                        :subtitle="$product->short_description ?? ($product->primary_category?->name ?? 'Single Estate')"
                        :price="$product->getPriceMoney()->formatted()"
                        :compare-at-price="$product->compare_at_price_money?->formatted()"
                        :image="$product->primary_image ?? ($product->images->first()?->url ?? \App\Services\PlaceholderService::url('product_square', $product->id))"
                        :rating="(float) ($product->rating_average > 0 ? $product->rating_average : 5.0)"
                        :rating-count="(int) ($product->rating_count > 0 ? $product->rating_count : 28)"
                        :badge="$product->metadata['harvest'] ?? 'Spring 2026'"
                        badge-variant="gold"
                        :href="'/products/' . $product->slug"
                    >
                        <x-slot:action>
                            <x-button
                                variant="primary"
                                size="sm"
                                trailing-arrow
                                x-data
                                x-on:click.prevent="$dispatch('notify', { message: '{{ addslashes($product->name) }} added to ritual basket.', tone: 'success' }); $dispatch('cart-updated', { count: 1 })"
                            >
                                Quick Add
                            </x-button>
                        </x-slot:action>
                    </x-commerce.product-card>
                @endforeach
            </div>

            <div class="text-center pt-4">
                <x-link-button href="/collections" variant="secondary" size="md" trailing-arrow>
                    Explore Complete Spring Catalogue
                </x-link-button>
            </div>
        </div>
    </section>
@endif
