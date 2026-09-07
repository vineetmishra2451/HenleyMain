@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Our Promise';
$title = $payload['title'] ?? "From Leaf to Cup,\nWith Intention.";
$imageUrl = $payload['image_url'] ?? '/pimages/2.jpg';
$imageAlt = $payload['image_alt'] ?? 'Henley — Our Process';
$ctaLabel = $payload['cta_label'] ?? 'Learn More';
$ctaUrl = $payload['cta_url'] ?? '/story';
@endphp

<section class="py-16 lg:py-24 bg-sand/30">
    <div class="henley-container">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
            <!-- ArchFrame image -->
            <div class="flex-1 flex justify-center">
                <div class="w-full max-w-[280px] sm:max-w-[320px]">
                    <x-arch-frame variant="tall" class="shadow-card">
                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $imageAlt }}"
                            loading="lazy"
                            class="w-full h-full object-cover object-center transition-transform duration-700 hover:scale-105"
                        >
                    </x-arch-frame>
                </div>
            </div>

            <!-- Copy -->
            <div class="flex-1 max-w-lg text-center lg:text-left">
                <p class="text-eyebrow text-gold mb-3">{{ $eyebrow }}</p>
                <h2 class="font-serif text-2xl lg:text-3xl text-charcoal leading-snug mb-4">
                    {!! nl2br(e($title)) !!}
                </h2>
                <p class="text-charcoal/60 text-base leading-relaxed mb-3">
                    At Henley, we believe in purity, transparency, and gifting wellness through nature&apos;s finest. Every blend is hand-selected from organic farms, slow-dried to preserve essential oils, and packed in small batches to ensure peak freshness.
                </p>
                <p class="text-charcoal/60 text-base leading-relaxed mb-8">
                    Our apothecary-inspired tins are designed to be beautiful enough to keep and refill — because sustainability should never sacrifice style.
                </p>
                <a
                    href="{{ $ctaUrl }}"
                    class="inline-flex items-center gap-2 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors group"
                >
                    <span>{{ $ctaLabel }}</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>
    </div>
</section>
