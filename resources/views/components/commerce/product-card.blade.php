@props([
    'title' => 'First Flush Darjeeling 2026',
    'subtitle' => null,
    'category' => null,
    'price' => 1450,
    'compareAtPrice' => null,
    'image' => null,
    'imageAlt' => null,
    'rating' => 5.0,
    'ratingCount' => 24,
    'badge' => null,
    'badgeVariant' => 'gold',
    'imageAspect' => 'aspect-square sm:aspect-[4/5]',
    'href' => '#',
])

@php
$formattedPrice = is_numeric($price) ? '₹' . number_format((float)$price) : (str_starts_with((string)$price, '₹') ? $price : '₹' . $price);
$formattedCompare = null;
if ($compareAtPrice) {
    $formattedCompare = is_numeric($compareAtPrice) ? '₹' . number_format((float)$compareAtPrice) : (str_starts_with((string)$compareAtPrice, '₹') ? $compareAtPrice : '₹' . $compareAtPrice);
}

$fullStars = min(5, max(0, (int) floor((float) $rating)));
$hasHalf = ((float) $rating - $fullStars) >= 0.5;
$emptyStars = 5 - $fullStars - ($hasHalf ? 1 : 0);
@endphp

<article {{ $attributes->merge(['class' => 'group bg-white rounded-lg sm:rounded-xl border border-border/70 overflow-hidden shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between']) }}>
    <!-- Product Image Container -->
    <a href="{{ $href }}" class="block relative overflow-hidden bg-sand/30 {{ $imageAspect }}">
        @if ($image)
            <img
                src="{{ $image }}"
                alt="{{ $imageAlt ?? $title }}"
                loading="lazy"
                class="h-full w-full object-cover object-center transition-transform duration-500 ease-out group-hover:scale-105"
            >
        @else
            <div class="flex h-full w-full items-center justify-center bg-sand/30 text-charcoal/30">
                <x-icons.package class="h-12 w-12 stroke-[1.2]" />
            </div>
        @endif

        @if ($badge)
            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 scale-90 sm:scale-100 origin-top-left">
                <x-badge :variant="$badgeVariant">
                    {{ $badge }}
                </x-badge>
            </div>
        @endif

        <div class="absolute inset-0 bg-charcoal/5 transition-opacity duration-300 pointer-events-none opacity-0 group-hover:opacity-100"></div>
    </a>

    <!-- Card Body -->
    <div class="p-2.5 sm:p-4 lg:p-5 space-y-2 sm:space-y-3 flex-1 flex flex-col justify-between text-left">
        <div class="space-y-1 sm:space-y-1.5">
            <!-- Star Rating -->
            <div class="flex items-center gap-1 scale-90 sm:scale-100 origin-left">
                <div class="flex items-center gap-0.5 text-gold" role="img" aria-label="{{ $rating }} out of 5 stars">
                    @for ($i = 0; $i < $fullStars; $i++)
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                    @endfor
                    @if ($hasHalf)
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" class="opacity-80">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                    @endif
                    @for ($i = 0; $i < $emptyStars; $i++)
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" class="text-charcoal/20">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                    @endfor
                </div>
                @if ($ratingCount)
                    <span class="text-xs text-charcoal/60 font-sans ml-1">
                        ({{ $ratingCount }} {{ $ratingCount === 1 ? 'Review' : 'Reviews' }})
                    </span>
                @endif
            </div>

            <!-- Category kicker -->
            @if ($category)
                <p class="text-eyebrow text-gold !text-[9px] sm:!text-[10px] tracking-wider uppercase font-medium line-clamp-1">
                    {{ $category }}
                </p>
            @endif

            <!-- Product name -->
            <a href="{{ $href }}" class="block group-hover:text-maroon transition-colors">
                <h3 class="font-serif text-sm sm:text-base lg:text-lg text-charcoal leading-snug line-clamp-1">
                    {{ $title }}
                </h3>
            </a>

            <!-- Subtitle -->
            @if ($subtitle)
                <p class="text-[11px] sm:text-xs text-charcoal/55 line-clamp-1 leading-relaxed hidden sm:block">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <!-- Price & Action Buttons -->
        <div class="space-y-2 sm:space-y-3 pt-1.5 sm:pt-2 border-t border-border/50">
            <div class="flex items-baseline justify-between">
                <div class="inline-flex items-baseline gap-2">
                    <span class="font-serif font-normal tabular-nums text-base sm:text-lg {{ $formattedCompare ? 'text-terracotta' : 'text-charcoal' }}">
                        {{ $formattedPrice }}
                    </span>
                    @if ($formattedCompare)
                        <span class="font-serif font-normal tabular-nums line-through text-charcoal/40 text-xs sm:text-sm">
                            {{ $formattedCompare }}
                        </span>
                    @endif
                </div>
                @if ($formattedCompare)
                    <span class="text-[9px] sm:text-[10px] font-sans font-semibold uppercase text-terracotta bg-terracotta/10 px-1 py-0.5 rounded">
                        Offer
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 sm:gap-2 pt-0.5">
                <a href="{{ $href }}" class="w-full">
                    <span class="w-full inline-flex items-center justify-center rounded-md font-sans text-charcoal bg-transparent border border-border hover:bg-sand/40 hover:border-charcoal/40 transition-colors cursor-pointer !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center">
                        View
                    </span>
                </a>

                @if (isset($action))
                    <div class="w-full">
                        {{ $action }}
                    </div>
                @else
                    <a href="{{ $href }}" class="w-full">
                        <span class="w-full inline-flex items-center justify-center rounded-md font-sans text-ivory bg-maroon hover:bg-maroon-dark transition-colors cursor-pointer shadow-subtle !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center">
                            + Bag
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</article>
