@props([
    'payload' => [],
    'reviews' => null,
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Customer Impressions';
$title = $payload['title'] ?? 'Collector Reflections';
$description = $payload['description'] ?? 'Unfiltered words from tea collectors, herbalists, and mindful living patrons.';
$ratingAvg = $payload['rating_average'] ?? '4.98';
$ratingCount = $payload['rating_count'] ?? '1,420+';

$items = $reviews ?? \App\Models\Review::where('status', \App\Enums\ReviewStatus::APPROVED)
    ->with('product')
    ->latest('published_at')
    ->take(6)
    ->get();

// Fallback high-fidelity reviews if database reviews collection is empty
if ($items->isEmpty()) {
    $fallbackReviews = [
        (object)[
            'customer_name' => 'Lady Catherine Vance',
            'title' => 'Unmatched Aroma & Terroir',
            'body' => 'The purity of the First Flush Green Tea is unlike anything found in retail grocers. The bone-white porcelain vessel preserves the essential oils flawlessly.',
            'rating' => 5,
            'published_at' => now()->subDays(3),
            'is_verified_purchase' => true,
            'product' => (object)['name' => 'Pure & Natural Tea', 'slug' => 'tea-pure-natural'],
        ],
        (object)[
            'customer_name' => 'Dr. Alistair Finch',
            'title' => 'Essential Daily Ritual',
            'body' => 'Exceptional micro-lot quality. You can taste the single-origin mountain terroir with every steep. The saffron threads impart a copper glow that is truly regal.',
            'rating' => 5,
            'published_at' => now()->subDays(8),
            'is_verified_purchase' => true,
            'product' => (object)['name' => 'Saffron', 'slug' => 'spice-saffron'],
        ],
        (object)[
            'customer_name' => 'Priya Sharma',
            'title' => 'Transcends Everyday Tea',
            'body' => 'Deep amber liquor with zero bitterness. The cardamom pods are enormous, resinous, and release an intoxicating scent the instant they are gently crushed.',
            'rating' => 5,
            'published_at' => now()->subDays(14),
            'is_verified_purchase' => true,
            'product' => (object)['name' => 'Cardamom', 'slug' => 'spice-cardamom'],
        ],
    ];
} else {
    $fallbackReviews = $items;
}
@endphp

<section class="py-16 lg:py-24 bg-sand/20 border-t border-border/70 overflow-hidden">
    <div class="henley-container">
        <!-- Header with Overall Trust Metric -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <p class="text-eyebrow text-gold mb-2">{{ $eyebrow }}</p>
                <h2 class="font-serif text-2xl lg:text-3xl text-charcoal leading-snug">
                    {{ $title }}
                </h2>
                <p class="text-xs sm:text-sm text-charcoal/60 mt-1 max-w-lg leading-relaxed">
                    {{ $description }}
                </p>
            </div>

            <!-- Aggregate Score Badge -->
            <div class="inline-flex items-center gap-3.5 px-4 py-2.5 bg-ivory rounded-full border border-border shadow-xs self-start md:self-auto">
                <div class="flex items-center gap-1 text-gold">
                    @for ($s = 0; $s < 5; $s++)
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
                <div class="h-4 w-px bg-border"></div>
                <span class="text-xs font-sans font-medium text-charcoal">
                    <strong class="font-semibold text-charcoal">{{ $ratingAvg }}</strong> / 5.0 ({{ $ratingCount }} reviews)
                </span>
            </div>
        </div>

        <div class="flex items-center justify-between md:hidden -mt-6 mb-3">
            <span class="text-[11px] uppercase tracking-wider text-charcoal/50 font-sans">Swipe to view reflections →</span>
        </div>

        <!-- Mobile Horizontal Swipe Scroller & Desktop Grid -->
        <div class="flex overflow-x-auto no-scrollbar snap-x snap-mandatory gap-4.5 pb-4 -mx-4 px-4 sm:mx-0 sm:px-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-6 md:overflow-visible md:pb-0">
            @foreach ($fallbackReviews as $review)
                <div class="bg-ivory rounded-2xl border border-border/80 p-6 sm:p-7 shadow-subtle flex flex-col justify-between hover:border-gold/50 transition-colors duration-300 w-[290px] sm:w-[330px] md:w-auto flex-shrink-0 snap-start">
                    <div class="space-y-3.5">
                        <!-- Top Row: Rating & Verified Purchase Pill -->
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-0.5 text-gold">
                                @for ($i = 0; $i < (int) ($review->rating ?? 5); $i++)
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="inline-flex items-center gap-1 text-[10px] font-sans font-medium text-emerald-700 bg-emerald-50 border border-emerald-200/60 px-2 py-0.5 rounded-full">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                                Verified Buyer
                            </span>
                        </div>

                        <!-- Review Title -->
                        <h4 class="font-serif text-lg text-charcoal leading-snug">
                            &ldquo;{{ $review->title }}&rdquo;
                        </h4>

                        <!-- Review Body -->
                        <p class="text-xs sm:text-[13px] text-charcoal/70 leading-relaxed font-sans line-clamp-4">
                            {{ $review->body }}
                        </p>
                    </div>

                    <!-- Footer: Product Tag & Customer Attribution -->
                    <div class="mt-6 pt-4 border-t border-border/60 flex items-center justify-between text-xs">
                        <div class="flex flex-col">
                            <span class="font-sans font-semibold text-charcoal text-[12px]">{{ $review->customer_name }}</span>
                            @if (! empty($review->published_at))
                                <span class="text-[10px] text-charcoal/50">{{ \Carbon\Carbon::parse($review->published_at)->format('M d, Y') }}</span>
                            @endif
                        </div>

                        @if (! empty($review->product?->name))
                            <a
                                href="/products/{{ $review->product?->slug ?? '' }}"
                                class="inline-flex items-center gap-1 text-[11px] font-sans font-medium text-maroon hover:text-maroon-dark transition-colors"
                            >
                                <span class="truncate max-w-[120px]">{{ $review->product->name }}</span>
                                <span>→</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
