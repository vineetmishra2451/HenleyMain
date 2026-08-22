@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Spring 2026 First Flush Release';
$headline = $payload['headline'] ?? 'Pure leaf. Pure intent.';
$subhead = $payload['subhead'] ?? 'Rare single-estate botanicals and high-grown spices preserved in bone-white porcelain cloche jars.';
$primaryCta = $payload['primary_cta'] ?? ['label' => 'Explore the Reserve', 'url' => '/collections/single-origin-reserve'];
$secondaryCta = $payload['secondary_cta'] ?? ['label' => 'The Cloche Ritual', 'url' => '/pages/the-cloche-ritual'];
$image = $payload['image'] ?? '/images/brand/homepage.jpeg';
@endphp

<section class="relative w-full bg-canvas overflow-hidden pt-8 pb-16 sm:py-20 lg:py-24">
    <x-container>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left: Hero Editorial Statement -->
            <div class="lg:col-span-7 space-y-8 text-left">
                <div class="space-y-4">
                    <x-eyebrow variant="accent" class="text-xs">
                        {{ $eyebrow }}
                    </x-eyebrow>

                    <h1 class="font-serif text-display-hero-mobile sm:text-display-hero text-primary font-normal leading-[1.05] tracking-tight">
                        {{ $headline }}
                    </h1>

                    <p class="text-body-lead text-secondary max-w-xl font-light leading-relaxed">
                        {{ $subhead }}
                    </p>
                </div>

                <!-- CTAs -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <x-link-button :href="$primaryCta['url'] ?? '/shop'" variant="primary" size="lg" trailing-arrow>
                        {{ $primaryCta['label'] ?? 'Explore the Reserve' }}
                    </x-link-button>

                    @if (! empty($secondaryCta['label']))
                        <x-link-button :href="$secondaryCta['url'] ?? '/pages/the-cloche-ritual'" variant="secondary" size="lg">
                            {{ $secondaryCta['label'] }}
                        </x-link-button>
                    @endif
                </div>

                <!-- Trust Proof Strip (Under Hero) -->
                <div class="pt-8 border-t border-hairline/80 flex flex-wrap items-center gap-6 sm:gap-8">
                    <div class="flex items-center gap-2">
                        <x-commerce.rating :rating="5.0" :show-count="false" size="md" />
                        <span class="text-caption font-semibold text-primary">5.0 / 5.0</span>
                    </div>

                    <div class="h-4 w-px bg-hairline hidden sm:block" aria-hidden="true"></div>

                    <div class="flex items-center gap-2 text-caption text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-sage" aria-hidden="true"></span>
                        <span>1,800m Altitude Terroir</span>
                    </div>

                    <div class="h-4 w-px bg-hairline hidden sm:block" aria-hidden="true"></div>

                    <div class="flex items-center gap-2 text-caption text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold" aria-hidden="true"></span>
                        <span>Nitrogen Hermetic Seal</span>
                    </div>
                </div>
            </div>

            <!-- Right: Hero Full-Bleed Cloche Visual (AVIF/WebP srcset with explicit dimensions for Zero CLS) -->
            <div class="lg:col-span-5 relative">
                <div class="relative w-full aspect-square sm:aspect-[4/5] rounded-2xl overflow-hidden bg-surface-raised border border-hairline shadow-subtle group">
                    <picture>
                        <source srcset="/images/brand/homepage.jpeg" type="image/jpeg">
                        <img
                            src="{{ $image }}"
                            alt="Henley Bone-White Cloche Cylinder with Arched Apothecary Window"
                            width="960"
                            height="1200"
                            fetchpriority="high"
                            loading="eager"
                            class="h-full w-full object-cover object-center transition-transform duration-700 ease-henley group-hover:scale-105"
                        >
                    </picture>

                    <!-- Delicate Antique Gold Badge Foil Ring -->
                    <div class="absolute bottom-6 right-6 p-3 rounded-full bg-surface-card/90 backdrop-blur-sm border border-gold/40 shadow-sm flex items-center gap-2">
                        <x-icons.sparkles class="w-4 h-4 text-gold" />
                        <span class="font-sans text-[10px] uppercase tracking-widest font-semibold text-gold-text">
                            First Flush 2026
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</section>
