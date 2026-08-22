@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? 'The Philosophy of Terroir';
$title = $payload['title'] ?? 'The Architecture of Purity';
$image = $payload['image'] ?? '/images/brand/productpage.jpeg';
@endphp

<section class="w-full bg-canvas py-20 sm:py-32 overflow-hidden">
    <x-container>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left: Editorial Story Visual with Arched Frame -->
            <div class="lg:col-span-5 relative">
                <div class="relative w-full aspect-[4/5] rounded-arch overflow-hidden bg-surface-raised border border-hairline shadow-subtle group">
                    <img
                        src="{{ $image }}"
                        alt="Henley Single-Estate Orthodox Leaf Processing"
                        loading="lazy"
                        class="h-full w-full object-cover object-center transition-transform duration-700 ease-henley group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <!-- Right: Editorial Narrative -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <x-eyebrow variant="accent">
                    {{ $eyebrow }}
                </x-eyebrow>

                <h2 class="font-serif text-display-2-mobile sm:text-display-2 text-primary font-normal leading-tight">
                    {{ $title }}
                </h2>

                <div class="space-y-4 text-body text-secondary leading-relaxed font-light">
                    <p>
                        Henley approaches tea the way a fine fragrance house approaches scent. We reject industrial blending, synthetic flavorings, and dusty warehouse storage.
                    </p>
                    <p>
                        Every harvest is hand-picked during peak diurnal shifts on exclusive micro-lots at altitudes between 1,200m and 2,200m. Preserved immediately in UV-shielded bone porcelain cloche jars, the volatile monoterpenes and floral muscatel esters remain pristine until unboxed in your sanctuary.
                    </p>
                </div>

                <div class="pt-4 flex items-center gap-6">
                    <x-link-button href="/pages/the-cloche-ritual" variant="primary" size="md" trailing-arrow>
                        Discover the Cloche Ritual
                    </x-link-button>

                    <a href="/journal" class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-secondary hover:text-accent transition-colors">
                        Read Journal ↗
                    </a>
                </div>
            </div>
        </div>
    </x-container>
</section>
