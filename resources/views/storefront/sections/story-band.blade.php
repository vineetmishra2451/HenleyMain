@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? 'The Henley Philosophy';
$title = $payload['title'] ?? 'Handpicked, small batch, organically extracted.';
$body = $payload['body'] ?? "We believe tea should be approached the way a master perfumer approaches scent. We partner exclusively with high-altitude growers who reject industrial homogenization. Every leaf is plucked at dawn before mountain dew evaporates, preserving delicate volatile aromatic compounds that mass-market processing burns away.";
$author = $payload['author'] ?? 'Dr. Alistair Henley';
$authorTitle = $payload['author_title'] ?? 'Master Botanical Curator';
$ctaLabel = $payload['cta_label'] ?? 'Read Our Full Story';
$ctaUrl = $payload['cta_url'] ?? '/about';
$imageUrl = $payload['image_url'] ?? '/images/brand/product.jpeg';
$imageAlt = $payload['image_alt'] ?? 'Henley porcelain cloche packaging and botanical ritual';
@endphp

<section class="w-full bg-canvas py-16 sm:py-28 overflow-hidden">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <!-- Left: Large Lifestyle Image in Arched Apothecary Mask Frame -->
            <div class="lg:col-span-5 relative order-2 lg:order-1">
                <x-arch-frame variant="default" aspect="aspect-[4/5]">
                    <img
                        src="{{ $imageUrl }}"
                        alt="{{ $imageAlt }}"
                        loading="lazy"
                        width="800"
                        height="1000"
                        class="h-full w-full object-cover transition-transform duration-700 hover:scale-105"
                    >
                </x-arch-frame>
            </div>

            <!-- Right: Brand Narrative & Proof -->
            <div class="lg:col-span-7 space-y-6 sm:space-y-8 order-1 lg:order-2">
                <div>
                    <x-eyebrow variant="accent">
                        {{ $eyebrow }}
                    </x-eyebrow>
                </div>

                <h2 class="font-serif text-display-2 font-normal text-primary tracking-tight leading-tight">
                    {{ $title }}
                </h2>

                <div class="space-y-4 text-body text-secondary leading-relaxed">
                    <p>{{ $body }}</p>
                </div>

                <div class="pt-4 border-t border-hairline flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary block">
                            {{ $author }}
                        </span>
                        <span class="text-caption text-secondary">
                            {{ $authorTitle }}
                        </span>
                    </div>

                    <div>
                        <x-link-button href="{{ $ctaUrl }}" variant="secondary" size="md" trailing-arrow>
                            {{ $ctaLabel }}
                        </x-link-button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
