@props([
    'payload' => [],
    'products' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Most Loved';
$title = $payload['title'] ?? 'Best Sellers';
$limit = (int) ($payload['limit'] ?? 4);

$items = $products ?? \App\Models\Product::active()
    ->bestseller()
    ->with(['images', 'categories'])
    ->take($limit)
    ->get();
@endphp

@if ($items->isNotEmpty())
    <section class="py-16 lg:py-24">
        <div class="henley-container">
            <!-- Section heading -->
            <div class="flex items-end justify-between mb-10 lg:mb-14">
                <div>
                    <p class="text-eyebrow text-gold mb-2">{{ $eyebrow }}</p>
                    <h2 class="font-serif text-2xl lg:text-3xl text-charcoal">
                        {{ $title }}
                    </h2>
                </div>
                <a href="/shop?sort=bestselling" class="hidden lg:inline-flex items-center gap-1 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
                    View All →
                </a>
            </div>

            <!-- Product grid: 2 per row on mobile, 4 per row on desktop -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
                @foreach ($items as $index => $product)
                    <x-commerce.product-card
                        :title="$product->name"
                        :subtitle="$product->short_description ?? ($product->primary_category?->name ?? 'Single Estate')"
                        :category="$product->primary_category?->name ?? ($product->categories->first()?->name ?? 'Specialty')"
                        :price="$product->getPriceMoney()->formatted()"
                        :compare-at-price="$product->compare_at_price_money?->formatted()"
                        :image="$product->primary_image ?? ($product->images->first()?->url ?? '/pimages/saffron.jpg')"
                        :rating="(float) ($product->rating_average > 0 ? $product->rating_average : 5.0)"
                        :rating-count="(int) ($product->rating_count > 0 ? $product->rating_count : 142 + ($index * 30))"
                        badge="bestseller"
                        badge-variant="gold"
                        :href="'/product/' . $product->slug"
                        image-aspect="aspect-square"
                    >
                        <x-slot:action>
                            <button
                                type="button"
                                x-data
                                x-on:click.prevent="$dispatch('notify', { message: '{{ addslashes($product->name) }} added to bag.', tone: 'success' }); $dispatch('cart-updated', { count: 1 })"
                                class="w-full inline-flex items-center justify-center rounded-md font-sans text-ivory bg-maroon hover:bg-maroon-dark transition-colors cursor-pointer shadow-subtle !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center"
                            >
                                + Bag
                            </button>
                        </x-slot:action>
                    </x-commerce.product-card>
                @endforeach
            </div>

            <!-- Mobile "View All" link -->
            <div class="lg:hidden text-center mt-8">
                <a href="/shop?sort=bestselling" class="text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
                    View All Best Sellers →
                </a>
            </div>
        </div>
    </section>
@endif
