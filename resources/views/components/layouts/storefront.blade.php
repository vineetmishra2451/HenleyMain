@props([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'image' => null,
    'transparentHero' => false,
])

@php
$metaTitle = $title ? "{$title} — Henley" : "Henley — Pure leaf. Pure intent. Single-Origin Botanicals";
$metaDescription = $description ?? "Rare single-estate Himalayan teas, biodynamic botanicals, and handpicked spices preserved in bone-white porcelain cloche jars.";
$metaCanonical = $canonical ?? url()->current();
$metaImage = $image ?? asset('images/brand/homepage.jpeg');

$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => url('/') . '/#organization',
            'name' => 'Henley',
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/brand/logo.png'),
            ],
            'sameAs' => [
                'https://instagram.com/henleybotanicals',
                'https://twitter.com/henleytea',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+91-800-436539',
                'contactType' => 'customer concierge',
                'areaServed' => 'IN',
                'availableLanguage' => 'en',
            ],
        ],
        [
            '@type' => 'WebSite',
            '@id' => url('/') . '/#website',
            'url' => url('/'),
            'name' => 'Henley Botanical Reserve',
            'publisher' => [
                '@id' => url('/') . '/#organization',
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => url('/collections') . '?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ],
    ],
];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-canvas scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ $metaCanonical }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $metaCanonical }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ $metaImage }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">

    <!-- Self-hosted font preloads for zero Cumulative Layout Shift (CLS) -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    {!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full bg-canvas text-primary font-sans antialiased selection:bg-accent selection:text-inverse flex flex-col justify-between">
    <!-- Livewire SPA Loading Bar Indicator -->
    <div wire:loading.class="w-full opacity-100" class="fixed top-0 left-0 h-0.5 bg-accent z-[9999] transition-all duration-300 w-0 opacity-0 pointer-events-none"></div>

    <!-- Global Toast Notifications Listener -->
    <div
        x-data="{
            toasts: [],
            add(e) {
                let id = Date.now();
                this.toasts.push({ id: id, message: e.detail.message || e.detail[0]?.message, tone: e.detail.tone || 'success' });
                setTimeout(() => this.toasts = this.toasts.filter(t => t.id !== id), 4000);
            }
        }"
        x-on:notify.window="add($event)"
        class="fixed bottom-6 right-6 z-50 space-y-2 pointer-events-none"
    >
        <template x-for="t in toasts" :key="t.id">
            <div class="pointer-events-auto flex items-center gap-3 rounded-full border border-hairline bg-surface-card px-5 py-3 shadow-card-hover animate-fadeIn">
                <span x-show="t.tone === 'success'" class="flex h-5 w-5 items-center justify-center rounded-full bg-sage-surface text-sage-text">✓</span>
                <span x-show="t.tone === 'error'" class="flex h-5 w-5 items-center justify-center rounded-full bg-error-surface text-error">✕</span>
                <span class="font-sans text-ui font-medium text-primary" x-text="t.message"></span>
            </div>
        </template>
    </div>

    <!-- Storefront Header -->
    <livewire:storefront.header :transparent-hero="$transparentHero" />

    <!-- Main Content Slot -->
    <main class="flex-1 w-full">
        {{ $slot }}
    </main>

    <!-- Storefront Footer -->
    <x-storefront.footer />

    @livewireScripts
</body>
</html>
