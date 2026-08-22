<x-layouts.storefront
    :transparent-header="true"
    :announcement-text="$announcement_text ?? null"
    :announcement-link="$announcement_link ?? null"
    :nav-items="$nav_items ?? []"
    :featured-collections="$featured_collections ?? []"
>
    <!-- Dynamic Homepage Sections Loop -->
    @foreach ($sections as $section)
        @switch($section->type)
            @case('hero')
            @case('hero_banner')
                <x-sections.hero :payload="$section->payload ?? []" />
                @break

            @case('trust_strip')
            @case('pillars')
                <x-sections.trust-strip :payload="$section->payload ?? []" />
                @break

            @case('featured_collections')
                <x-sections.featured-collections
                    :collections="$featured_collections ?? []"
                    :payload="$section->payload ?? []"
                />
                @break

            @case('featured_products')
                <x-sections.featured-products
                    :products="$featured_products ?? []"
                    :payload="$section->payload ?? []"
                />
                @break

            @case('best_sellers')
                <x-sections.best-sellers
                    :products="$bestsellers ?? []"
                    :payload="$section->payload ?? []"
                />
                @break

            @case('story_band')
                <x-sections.story-band :payload="$section->payload ?? []" />
                @break

            @case('offers')
                <x-sections.offers
                    :coupons="$coupons ?? []"
                    :payload="$section->payload ?? []"
                />
                @break

            @case('journal_preview')
                <x-sections.journal-preview
                    :posts="$journal_posts ?? []"
                    :payload="$section->payload ?? []"
                />
                @break

            @case('instagram_mosaic')
                <x-sections.instagram-mosaic :payload="$section->payload ?? []" />
                @break
        @endswitch
    @endforeach

    @if ($sections->isEmpty())
        <!-- Graceful fallback if zero sections exist in DB -->
        <x-sections.hero />
        <x-sections.trust-strip />
        <x-sections.featured-collections :collections="$featured_collections ?? []" />
        <x-sections.featured-products :products="$featured_products ?? []" />
        <x-sections.best-sellers :products="$bestsellers ?? []" />
        <x-sections.story-band />
        <x-sections.offers :coupons="$coupons ?? []" />
        <x-sections.journal-preview :posts="$journal_posts ?? []" />
        <x-sections.instagram-mosaic />
    @endif
</x-layouts.storefront>
