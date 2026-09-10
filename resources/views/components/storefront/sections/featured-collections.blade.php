@props([
    'payload' => [],
    'collections' => null,
    'totalCount' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Explore Our Range';
$title = $payload['title'] ?? 'Curated Collections';
$description = $payload['description'] ?? 'Discover our meticulously crafted blends, single-origin spices, and stoneground flours.';
$limit = (int) ($payload['limit'] ?? 8);

$items = $collections ?? \App\Models\Category::where('is_featured', true)->withCount('products')->orderBy('sort_order')->take($limit)->get();
@endphp

@if ($items->isNotEmpty())
    <section id="curated-collections" class="py-8 sm:py-12 lg:py-24 overflow-hidden bg-ivory scroll-mt-16">
        <div class="henley-container">
            <!-- Section heading + navigation controls -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 lg:mb-12 gap-4">
                <div>
                    <p class="text-eyebrow text-gold mb-2">{{ $eyebrow }}</p>
                    <h2 class="font-serif text-2xl lg:text-3xl text-charcoal">
                        {{ $title }}
                    </h2>
                    <p class="text-xs sm:text-sm text-charcoal/60 mt-1 max-w-md">
                        {{ $description }}
                    </p>
                </div>

                <!-- Scroll Navigation Arrows -->
                <div class="flex items-center gap-3 self-end sm:self-auto">
                    <span class="text-[11px] font-sans text-charcoal/40 hidden sm:inline">
                        Scroll to explore
                    </span>
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            onclick="document.getElementById('collections-scroll-container')?.scrollBy({ left: -280, behavior: 'smooth' })"
                            class="w-8 h-8 rounded-full border border-border bg-white text-charcoal/60 hover:text-maroon hover:border-maroon flex items-center justify-center transition-colors shadow-xs cursor-pointer"
                            aria-label="Scroll collections left"
                        >
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            onclick="document.getElementById('collections-scroll-container')?.scrollBy({ left: 280, behavior: 'smooth' })"
                            class="w-8 h-8 rounded-full border border-border bg-white text-charcoal/60 hover:text-maroon hover:border-maroon flex items-center justify-center transition-colors shadow-xs cursor-pointer"
                            aria-label="Scroll collections right"
                        >
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Horizontally scrollable Category cards -->
            <div
                id="collections-scroll-container"
                class="flex overflow-x-auto gap-4 sm:gap-5 lg:gap-6 pb-4 pt-1 snap-x snap-mandatory scroll-smooth px-4 -mx-4 sm:px-0 sm:mx-0 scrollbar-none"
            >
                @foreach ($items as $cat)
                    @php
                        $badge = match ($cat->slug) {
                            'tea' => 'Signature',
                            'herbs-spices' => 'Organic',
                            'cocoa' => 'Reserve',
                            default => null,
                        };
                        $catImage = $cat->image_path ?: 'pimages/cardamom.jpg';
                        if (!str_starts_with($catImage, '/') && !str_starts_with($catImage, 'http')) {
                            $catImage = '/' . $catImage;
                        }
                    @endphp
                    <a
                        href="/collections?cat={{ $cat->slug }}"
                        class="flex-shrink-0 w-[240px] sm:w-[270px] lg:w-[280px] xl:w-[calc(20%-19.2px)] snap-start group relative bg-white rounded-xl border border-border/70 overflow-hidden shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between"
                    >
                        <!-- Image -->
                        <div class="relative aspect-[4/5] bg-sand/30 overflow-hidden">
                            <img
                                src="{{ $catImage }}"
                                alt="{{ $cat->name }}"
                                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                                loading="lazy"
                            />
                            @if ($badge)
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-sans font-semibold uppercase tracking-wider bg-gold text-white shadow-xs">
                                        {{ $badge }}
                                    </span>
                                </div>
                            @endif
                            <!-- Hover overlay -->
                            <div class="absolute inset-0 bg-charcoal/0 group-hover:bg-charcoal/10 transition-colors duration-300"></div>
                        </div>

                        <!-- Card body -->
                        <div class="p-4 lg:p-5 text-center flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif text-lg text-charcoal mb-1">{{ $cat->name }}</h3>
                                <p class="text-xs text-charcoal/50 mb-3">{{ $cat->products_count ?? 0 }} Products</p>
                            </div>
                            <span class="text-xs font-sans font-medium text-maroon group-hover:underline">
                                View Collection →
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Mobile Swipe Hint -->
            <p class="text-center text-[11px] font-sans text-charcoal/40 pt-2 sm:hidden flex items-center justify-center gap-1.5">
                <span>←</span>
                <span>Swipe to explore collections</span>
                <span>→</span>
            </p>
        </div>
    </section>
@endif

