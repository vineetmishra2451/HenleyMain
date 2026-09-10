@props([
    'payload' => [],
    'products' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Handpicked for You';
$title = $payload['title'] ?? 'Featured Products';
$limit = (int) ($payload['limit'] ?? 6);

$items = $products ?? \App\Models\Product::active()
    ->featured()
    ->with(['images', 'categories'])
    ->take($limit)
    ->get();
@endphp

@if ($items->isNotEmpty())
    <section class="bg-sand/30 py-16 lg:py-24 overflow-hidden">
        <div class="henley-container">
            <!-- Section heading -->
            <div class="flex items-end justify-between mb-10 lg:mb-14">
                <div>
                    <p class="text-eyebrow text-gold mb-2">{{ $eyebrow }}</p>
                    <h2 class="font-serif text-2xl lg:text-3xl text-charcoal">
                        {{ $title }}
                    </h2>
                </div>
                <a href="/shop" class="hidden lg:inline-flex items-center gap-1 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
                    View All →
                </a>
            </div>

            <!-- Horizontal scrollable on mobile, grid on desktop -->
            <div
                class="
                    flex lg:grid lg:grid-cols-3 xl:grid-cols-4 gap-5
                    overflow-x-auto snap-x snap-mandatory
                    pb-4 -mb-4
                    scrollbar-none
                    lg:overflow-visible lg:pb-0 lg:mb-0
                "
            >
                @foreach ($items as $product)
                    <div class="snap-start flex-shrink-0 w-[72vw] sm:w-[45vw] lg:w-auto">
                        <x-commerce.product-card
                            :title="$product->name"
                            :subtitle="$product->short_description ?? ($product->primary_category?->name ?? 'Single Estate')"
                            :category="$product->primary_category?->name ?? ($product->categories->first()?->name ?? 'Specialty')"
                            :price="$product->getPriceMoney()->formatted()"
                            :compare-at-price="$product->compare_at_price_money?->formatted()"
                            :image="$product->primary_image ?? ($product->images->first()?->url ?? '/pimages/saffron.jpg')"
                            :rating="(float) ($product->rating_average > 0 ? $product->rating_average : 5.0)"
                            :rating-count="(int) ($product->rating_count > 0 ? $product->rating_count : 164)"
                            :badge="$product->is_bestseller ? 'bestseller' : ($product->is_featured ? 'organic' : null)"
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
                    </div>
                @endforeach
            </div>

            <!-- Mobile "View All" link -->
            <div class="lg:hidden text-center mt-8">
                <a href="/shop" class="text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
                    View All Products →
                </a>
            </div>
        </div>
    </section>
@endif
