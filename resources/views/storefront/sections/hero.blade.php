@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Spring 2026 First Flush Release';
$headline = $payload['headline'] ?? 'Pure leaf. Pure intent. Fifteen quiet minutes for the senses.';
$subhead = $payload['subhead'] ?? 'Rare single-estate orthodox teas and whole spices hand-harvested at 1,800 metres and sealed in UV-blocking porcelain cloche jars.';
$primaryCta = $payload['primary_cta'] ?? ['label' => 'Explore the Reserve', 'url' => '/collections'];
$secondaryCta = $payload['secondary_cta'] ?? ['label' => 'The Cloche Ritual', 'url' => '/about'];
$proofPoints = $payload['proof_points'] ?? ['1,850m Single Estate', 'First Flush 2026', '100% Biodynamic'];
$rating = (float) ($payload['rating'] ?? 5.0);
$ratingCount = (int) ($payload['rating_count'] ?? 148);
$imageUrl = $payload['image_url'] ?? '/images/brand/homepage.jpeg';
$imageAlt = $payload['image_alt'] ?? 'Henley bone-white porcelain cloche jar revealing golden saffron and whole leaf tea';
@endphp

<section class="relative w-full overflow-hidden bg-canvas pt-8 pb-16 sm:pt-12 sm:pb-24 border-b border-hairline">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <!-- Left Column: Editorial Statement (7 cols) -->
            <div class="lg:col-span-7 space-y-6 sm:space-y-8">
                <!-- Eyebrow Tag -->
                <div>
                    <x-eyebrow variant="gold">
                        {{ $eyebrow }}
                    </x-eyebrow>
                </div>

                <!-- 2-Line Desktop Serif Headline with balanced line wrapping -->
                <h1 class="font-serif text-display-1-mobile sm:text-display-hero font-normal text-primary tracking-tight leading-[1.08]">
                    {{ $headline }}
                </h1>

                <!-- Subtitle / Positioning Narrative -->
                <p class="text-body-lead text-secondary max-w-xl font-light leading-relaxed">
                    {{ $subhead }}
                </p>

                <!-- Action CTA Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <x-link-button
                        href="{{ $primaryCta['url'] }}"
                        variant="primary"
                        size="lg"
                        trailing-arrow
                    >
                        {{ $primaryCta['label'] }}
                    </x-link-button>

                    @if (! empty($secondaryCta['label']))
                        <x-link-button
                            href="{{ $secondaryCta['url'] }}"
                            variant="secondary"
                            size="lg"
                        >
                            {{ $secondaryCta['label'] }}
                        </x-link-button>
                    @endif
                </div>

                <!-- Trust Line: 5-Star Rating & 3 Proof Points -->
                <div class="pt-6 border-t border-hairline/80 flex flex-wrap items-center gap-y-3 gap-x-6 text-caption text-secondary">
                    <div class="flex items-center gap-2">
                        <x-commerce.rating :rating="$rating" :count="$ratingCount" />
                    </div>

                    <div class="flex items-center gap-3 text-xs uppercase tracking-wider font-medium text-primary">
                        @foreach ($proofPoints as $proof)
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-1 h-1 rounded-full bg-gold" aria-hidden="true"></span>
                                {{ $proof }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Hero Visual Cloche (5 cols) with LQIP blur-up and explicit dimensions -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Subtle Arch Frame Motif -->
                    <x-arch-frame variant="gold-rim" aspect="aspect-[4/5]">
                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $imageAlt }}"
                            width="800"
                            height="1000"
                            fetchpriority="high"
                            loading="eager"
                            class="h-full w-full object-cover object-center transition-transform duration-700 hover:scale-105"
                        >
                    </x-arch-frame>

                    <!-- Floating Quality Proof Seal Badge -->
                    <div class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-6 p-4 rounded-2xl bg-surface-card border border-hairline shadow-card-hover flex items-center gap-3 select-none">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gold-surface border border-gold/30 text-gold-text">
                            <x-icons.shield-check class="w-5 h-5" />
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest font-bold text-gold-text block">Hermetic Cloche</span>
                            <span class="text-caption text-primary font-serif font-medium">Volatile Terpenes Sealed</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
