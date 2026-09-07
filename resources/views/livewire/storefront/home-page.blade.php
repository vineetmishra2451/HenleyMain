<div class="w-full">
    @forelse ($sections as $section)
        @php
            $payload = is_array($section->payload) ? $section->payload : [];
            $type = $section->type;
        @endphp

        @if ($type === 'hero' || $type === 'hero_banner')
            <x-storefront.sections.hero :payload="$payload" />
        @elseif ($type === 'why_henley' || $type === 'why_us' || $type === 'our_promise')
            <x-storefront.sections.why-henley :payload="$payload" />
        @elseif ($type === 'trust_strip' || $type === 'pillars')
            <x-storefront.sections.trust-strip :payload="$payload" />
        @elseif ($type === 'featured_collections')
            <x-storefront.sections.featured-collections :payload="$payload" :collections="$featuredCollections" :total-count="$totalCategoriesCount" />
        @elseif ($type === 'featured_products')
            <x-storefront.sections.featured-products :payload="$payload" :products="$featuredProducts" />
        @elseif ($type === 'bestsellers')
            <x-storefront.sections.bestsellers :payload="$payload" :products="$bestsellers" />
        @elseif ($type === 'story_band')
            <x-storefront.sections.story-band :payload="$payload" />
        @elseif ($type === 'offers' || $type === 'banner')
            <x-storefront.sections.offers :payload="$payload" :active-coupon="$activeCoupon" />
        @elseif ($type === 'journal_preview')
            <x-storefront.sections.journal-preview :payload="$payload" :posts="$recentPosts" />
        @elseif ($type === 'brewing_ritual' || $type === 'ritual' || $type === 'brewing_experience')
            <x-storefront.sections.brewing-ritual :payload="$payload" />
        @elseif ($type === 'reviews' || $type === 'customer_reviews' || $type === 'testimonials')
            <x-storefront.sections.reviews :payload="$payload" :reviews="$reviews" />
        @elseif ($type === 'newsletter_band')
            <x-storefront.sections.newsletter-band :payload="$payload" />
        @endif
    @empty
        <!-- Fallback Graceful Empty State if Homepage Sections are Unpopulated -->
        <div class="py-24 max-w-content mx-auto px-6 text-center">
            <x-empty-state
                title="The Sanctuary is Being Prepared"
                description="Our master curators are cataloguing the seasonal spring harvest allocations."
            >
                <x-link-button href="/collections" variant="primary" trailing-arrow>
                    Explore The Cellar
                </x-link-button>
            </x-empty-state>
        </div>
    @endforelse
</div>
