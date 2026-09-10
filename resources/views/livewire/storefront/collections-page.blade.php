<div class="w-full bg-ivory min-h-screen py-8 lg:py-12">
    <div class="henley-container">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-sans text-charcoal/50 mb-6" aria-label="Breadcrumb">
            <a href="/" class="hover:text-maroon transition-colors">Home</a>
            <span>/</span>
            @if ($activeCategory)
                <a href="/collections" class="hover:text-maroon transition-colors">Collections</a>
                <span>/</span>
                <span class="text-charcoal font-medium">{{ $activeCategory->name }}</span>
            @else
                <span class="text-charcoal font-medium">Collections</span>
            @endif
        </nav>

        <!-- Page Header -->
        <div class="mb-8 lg:mb-10 text-left">
            <p class="text-eyebrow text-gold mb-2">Botanical Reserve</p>
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal tracking-tight font-normal">
                {{ $activeCategory ? $activeCategory->name : 'Curated Collections' }}
            </h1>
            <p class="text-xs sm:text-sm text-charcoal/60 mt-2 max-w-2xl leading-relaxed">
                {{ $activeCategory ? ($activeCategory->description ?: 'Discover our single-origin reserve, harvested at peak vitality from prime mountain slopes.') : 'Discover our meticulously crafted botanical collections: rare Himalayan single-estate teas, wild-foraged spices, stoneground flours, and pure cocoa.' }}
            </p>
        </div>

        <!-- Collection Category Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 scrollbar-none border-b border-border/70">
            <a
                href="/collections"
                class="flex-shrink-0 px-4 py-2 rounded-full text-xs font-sans font-medium transition-all {{ is_null($activeCategory) ? 'bg-maroon text-ivory shadow-xs font-semibold' : 'bg-sand/60 text-charcoal/80 hover:bg-sand hover:text-charcoal border border-border/60' }}"
            >
                All Collections ({{ $products->total() }})
            </a>
            @foreach ($allCategories as $c)
                @php
                    $isSelected = $activeCategory && $activeCategory->id === $c->id;
                @endphp
                <a
                    href="/collections?cat={{ $c->slug }}"
                    class="flex-shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-sans font-medium transition-all {{ $isSelected ? 'bg-maroon text-ivory shadow-xs font-semibold' : 'bg-sand/60 text-charcoal/80 hover:bg-sand hover:text-charcoal border border-border/60' }}"
                >
                    <span>{{ $c->name }}</span>
                    <span class="text-[10px] {{ $isSelected ? 'text-ivory/80' : 'text-charcoal/40' }}">
                        ({{ $c->products_count }})
                    </span>
                </a>
            @endforeach
        </div>

        <!-- Products Grid -->
        @if ($products->isNotEmpty())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
                @foreach ($products as $product)
                    @php
                        $pImg = $product->primary_image ?: ($product->images->first()?->url ?: '/pimages/tea.jpg');
                        $badge = $product->is_bestseller ? 'bestseller' : ($product->is_featured ? 'organic' : null);
                        $categoryName = $product->primary_category?->name ?? ($product->categories->first()?->name ?? 'Botanical Reserve');
                    @endphp
                    <x-commerce.product-card
                        :title="$product->name"
                        :subtitle="$product->short_description ?? $categoryName"
                        :category="$categoryName"
                        :price="$product->getPriceMoney()->formatted()"
                        :compare-at-price="$product->compare_at_price_money?->formatted()"
                        :image="$pImg"
                        :rating="(float) ($product->rating_average > 0 ? $product->rating_average : 5.0)"
                        :rating-count="(int) ($product->rating_count > 0 ? $product->rating_count : 164)"
                        :badge="$badge"
                        :href="'/product/' . $product->slug"
                        image-aspect="aspect-square"
                    >
                        <x-slot:action>
                            <button
                                type="button"
                                x-data
                                x-on:click.prevent="$dispatch('notify', { message: '{{ addslashes($product->name) }} added to bag.', tone: 'success' }); $dispatch('cart-updated', { count: 1 })"
                                class="w-full inline-flex items-center justify-center rounded-md font-sans text-ivory bg-maroon hover:bg-maroon/90 transition-colors cursor-pointer shadow-subtle text-xs py-2 px-2 font-medium"
                            >
                                + Bag
                            </button>
                        </x-slot:action>
                    </x-commerce.product-card>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="py-20 text-center max-w-md mx-auto">
                <div class="w-16 h-16 rounded-full bg-sand/60 border border-border flex items-center justify-center text-maroon mx-auto mb-4">
                    <x-icons.package class="w-8 h-8 stroke-[1.2]" />
                </div>
                <h3 class="font-serif text-xl text-charcoal mb-2">Harvest in Preparation</h3>
                <p class="text-xs text-charcoal/60 mb-6">
                    Our curators are freshly packing this seasonal allocation. Explore our other single-estate reserves.
                </p>
                <a
                    href="/collections"
                    class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-maroon text-ivory text-xs font-sans font-semibold uppercase tracking-wider hover:bg-maroon/90 transition-colors"
                >
                    View All Collections →
                </a>
            </div>
        @endif

    </div>
</div>
