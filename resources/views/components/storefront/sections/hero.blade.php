@props([
    'payload' => [],
])

@php
$eyebrow = $payload['eyebrow'] ?? 'Pure Leaf. Pure Intent.';
$headline = $payload['headline'] ?? 'Tea, The Way Nature Intended.';
$subhead = $payload['subhead'] ?? 'Organically extracted from handpicked pure leaves, crafted to preserve natural aroma, antioxidants, and authentic taste in every cup.';
$primaryCta = $payload['primary_cta'] ?? ['label' => 'Shop Collection →', 'url' => '/shop'];
$secondaryCta = $payload['secondary_cta'] ?? ['label' => 'Discover Our Process →', 'url' => '/story'];
$desktopBg = $payload['image_url'] ?? '/images/brand/herobanner.png';
$mobileImages = $payload['mobile_images'] ?? ['/images/brand/heromobile1.jpg', '/images/brand/heromobile2.jpg'];

$trustIcons = [
    ['label' => '100% Organic', 'sub' => 'Pure & Natural', 'icon' => 'leaf'],
    ['label' => 'No Artificial Flavours', 'sub' => 'Just Pure Goodness', 'icon' => 'drop'],
    ['label' => 'Handpicked Leaves', 'sub' => 'Finest Quality', 'icon' => 'hand'],
    ['label' => 'Freshly Packed', 'sub' => 'For Maximum Freshness', 'icon' => 'box'],
];
@endphp

<div class="w-full bg-ivory">
    <!-- ── MOBILE VARIANT (< lg): Half-screen rounded banner with crossfading photography & single CTA ── -->
    <section class="lg:hidden px-4 pt-3 pb-2">
        <div
            x-data="{
                mobileHeroIndex: 0,
                images: {{ json_encode($mobileImages) }},
                timer: null,
                start() {
                    this.timer = setInterval(() => {
                        this.mobileHeroIndex = (this.mobileHeroIndex + 1) % this.images.length;
                    }, 4500);
                }
            }"
            x-init="start()"
            class="relative w-full aspect-[5/4] rounded-2xl sm:rounded-3xl overflow-hidden shadow-subtle border border-border/70 bg-sand/40"
            style="aspect-ratio: 5 / 4;"
        >
            <!-- Mobile Background Images with smooth crossfade (zero crop, exact 5:4 ratio) -->
            @foreach ($mobileImages as $idx => $src)
                <div
                    class="absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $idx === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}"
                    :class="mobileHeroIndex === {{ $idx }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                >
                    <img
                        src="{{ $src }}"
                        alt="Henley Botanical Reserve"
                        class="w-full h-full object-cover object-center"
                    />
                </div>
            @endforeach

            <!-- Subtle bottom-edge shadow for contrast -->
            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-charcoal/50 via-charcoal/15 to-transparent pointer-events-none"></div>

            <!-- Single Shop Now Button in Bottom Left -->
            <div class="absolute bottom-3 left-3 sm:bottom-4 sm:left-4 z-10">
                <a
                    href="{{ $primaryCta['url'] }}"
                    class="inline-flex items-center px-5 py-2 text-xs font-sans font-medium shadow-card bg-maroon text-ivory hover:bg-maroon-dark uppercase tracking-wider rounded-full transition-colors"
                >
                    Shop Now →
                </a>
            </div>

            <!-- Discrete Dot Indicator in Bottom Right -->
            <div class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 z-10 flex items-center gap-1.5 bg-charcoal/30 backdrop-blur-xs px-2.5 py-1 rounded-full border border-white/20">
                @foreach ($mobileImages as $idx => $src)
                    <button
                        type="button"
                        x-on:click="mobileHeroIndex = {{ $idx }}"
                        class="h-1.5 sm:h-2 rounded-full transition-all cursor-pointer {{ $idx === 0 ? 'bg-white w-3 sm:w-4' : 'bg-white/50 w-1.5 sm:w-2' }}"
                        :class="mobileHeroIndex === {{ $idx }} ? 'bg-white w-3 sm:w-4' : 'bg-white/50 hover:bg-white/80 w-1.5 sm:w-2'"
                        aria-label="Show mobile banner slide {{ $idx + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>

        <!-- Mobile Trust Icons Strip -->
        <div class="mt-4 py-4 px-2 border-y border-border bg-sand/20 rounded-xl">
            <div class="grid grid-cols-2 gap-3">
                @foreach ($trustIcons as $item)
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-ivory border border-border flex items-center justify-center flex-shrink-0">
                            @if ($item['icon'] === 'leaf')
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
                                    <path d="M5 19c2.8-3.5 6-6.1 12-8" />
                                </svg>
                            @elseif ($item['icon'] === 'drop')
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                    <path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z" />
                                </svg>
                            @elseif ($item['icon'] === 'hand')
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                    <path d="M18 11V6a2 2 0 00-4 0v5" />
                                    <path d="M14 10V4a2 2 0 00-4 0v6" />
                                    <path d="M10 10.5V6a2 2 0 00-4 0v8" />
                                    <path d="M18 8a2 2 0 014 0v6a8 8 0 01-8 8H8a8 8 0 01-6-3" />
                                </svg>
                            @else
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                    <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                    <line x1="12" y1="22.08" x2="12" y2="12" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-[11px] font-sans font-semibold text-charcoal leading-tight">{{ $item['label'] }}</p>
                            <p class="text-[9px] text-charcoal/50">{{ $item['sub'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── DESKTOP VARIANT (lg+): Full-bleed editorial landscape with typography & trust strip ── -->
    <section class="hidden lg:flex relative overflow-hidden min-h-[580px] flex-col justify-between">
        <!-- Background image -->
        <img
            src="{{ $desktopBg }}"
            alt="Henley — Tea, The Way Nature Intended"
            class="absolute inset-0 w-full h-full object-cover object-center select-none"
            loading="eager"
            fetchpriority="high"
        />

        <!-- Content -->
        <div class="henley-container relative z-10 py-24 flex items-center min-h-[560px]">
            <div class="max-w-xl">
                <!-- Kicker -->
                <div class="flex items-center gap-3 mb-4">
                    <p class="text-eyebrow text-gold">{{ $eyebrow }}</p>
                    <span class="w-12 h-px bg-gold/40"></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5">
                        <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
                        <path d="M5 19c2.8-3.5 6-6.1 12-8" />
                    </svg>
                </div>

                <!-- Headline -->
                <h1 class="font-serif text-4xl xl:text-5xl text-charcoal leading-[1.1] mb-5">
                    {!! nl2br(e($headline)) !!}
                </h1>

                <!-- Body -->
                <p class="text-charcoal/70 text-lg leading-relaxed mb-8 max-w-md">
                    {{ $subhead }}
                </p>

                <!-- CTAs -->
                <div class="flex flex-wrap items-center gap-3">
                    <a
                        href="{{ $primaryCta['url'] }}"
                        class="inline-flex items-center justify-center px-6 py-3 rounded-full text-xs font-sans uppercase tracking-wider font-medium bg-maroon text-ivory hover:bg-maroon-dark transition-colors shadow-subtle"
                    >
                        {{ $primaryCta['label'] }}
                    </a>
                    @if (! empty($secondaryCta['label']))
                        <a
                            href="{{ $secondaryCta['url'] }}"
                            class="inline-flex items-center justify-center px-6 py-3 rounded-full text-xs font-sans uppercase tracking-wider font-medium text-charcoal hover:text-maroon transition-colors"
                        >
                            {{ $secondaryCta['label'] }}
                        </a>
                    @endif
                    <div class="sr-only" style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">
                        <span>Spring 2026 First Flush Release</span>
                        <span>Fifteen quiet minutes for the senses.</span>
                        <a href="/collections">Explore the Reserve</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Desktop Trust Icons Strip ── -->
        <div class="border-t border-b border-border bg-sand/30 relative z-10">
            <div class="henley-container py-8">
                <div class="grid grid-cols-4 gap-8">
                    @foreach ($trustIcons as $item)
                        <div class="flex items-center gap-3 justify-start">
                            <!-- Icon circle -->
                            <div class="w-10 h-10 rounded-full bg-ivory border border-border flex items-center justify-center flex-shrink-0">
                                @if ($item['icon'] === 'leaf')
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                        <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.67c.48-.05.95-.07 1.34-.1C16 19 19 8 19 8" />
                                        <path d="M5 19c2.8-3.5 6-6.1 12-8" />
                                    </svg>
                                @elseif ($item['icon'] === 'drop')
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                        <path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z" />
                                    </svg>
                                @elseif ($item['icon'] === 'hand')
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                        <path d="M18 11V6a2 2 0 00-4 0v5" />
                                        <path d="M14 10V4a2 2 0 00-4 0v6" />
                                        <path d="M10 10.5V6a2 2 0 00-4 0v8" />
                                        <path d="M18 8a2 2 0 014 0v6a8 8 0 01-8 8H8a8 8 0 01-6-3" />
                                    </svg>
                                @else
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-gold" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                                        <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                        <line x1="12" y1="22.08" x2="12" y2="12" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs font-sans font-semibold text-charcoal leading-tight">{{ $item['label'] }}</p>
                                <p class="text-[11px] text-charcoal/45">{{ $item['sub'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
