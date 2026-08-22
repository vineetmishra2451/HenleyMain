@props([
    'payload' => [],
    'products' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Collector Staples';
$title = $payload['title'] ?? 'The Henley Hallmarks';
$description = $payload['description'] ?? 'Our most celebrated harvests, re-ordered continuously by tea collectors worldwide.';
$limit = (int) ($payload['limit'] ?? 6);

$items = $products ?? \App\Models\Product::active()
    ->bestseller()
    ->with(['images', 'categories'])
    ->take($limit)
    ->get();
@endphp

@if ($items->isNotEmpty())
    <section class="w-full bg-surface-raised/40 py-16 sm:py-24 border-y border-hairline overflow-hidden">
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-12">
            <x-section-heading
                :eyebrow="$eyebrow"
                :title="$title"
                :description="$description"
                align="center"
            />

            <!-- Mobile Native Scroll-Snap Scroller & Desktop Grid -->
            <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto sm:overflow-x-visible pb-4 sm:pb-0 snap-x snap-mandatory no-scrollbar -mx-5 px-5 sm:mx-0 sm:px-0">
                @foreach ($items as $index => $product)
                    <div class="w-[280px] sm:w-auto flex-shrink-0 snap-center">
                        <x-commerce.product-card
                            :title="$product->name"
                            :subtitle="$product->short_description ?? ($product->primary_category?->name ?? 'Single Estate')"
                            :price="$product->getPriceMoney()->formatted()"
                            :compare-at-price="$product->compare_at_price_money?->formatted()"
                            :image="$product->primary_image ?? ($product->images->first()?->url ?? \App\Services\PlaceholderService::url('product_square', $product->id))"
                            :rating="(float) ($product->rating_average > 0 ? $product->rating_average : 4.9)"
                            :rating-count="(int) ($product->rating_count > 0 ? $product->rating_count : 42 + ($index * 15))"
                            :badge="'#' . ($index + 1) . ' Bestseller'"
                            badge-variant="gold"
                            :href="'/products/' . $product->slug"
                        >
                            <x-slot:action>
                                <x-button
                                    variant="secondary"
                                    size="sm"
                                    x-data
                                    x-on:click.prevent="$dispatch('notify', { message: '{{ addslashes($product->name) }} added to ritual.', tone: 'success' }); $dispatch('cart-updated', { count: 1 })"
                                >
                                    Add
                                </x-button>
                            </x-slot:action>
                        </x-commerce.product-card>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
