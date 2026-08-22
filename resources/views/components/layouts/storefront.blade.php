@props([
    'title' => null,
    'description' => 'Pure leaf. Pure intent. Henley approaches single-estate tea, rare botanicals, and whole spices with the precision and quiet luxury of a fine fragrance house.',
    'image' => '/images/brand/homepage.jpeg',
    'transparentHeader' => false,
    'announcementText' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'announcementLink' => '/collections/single-origin-reserve',
    'navItems' => [],
    'featuredCollections' => [],
])

@php
$pageTitle = $title ? "{$title} — Henley" : "Henley — Pure Leaf. Pure Intent. Single-Origin Botanicals";
$canonicalUrl = url()->current();
$appUrl = config('app.url', 'https://henleytea.com');

$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => "{$appUrl}/#organization",
            'name' => 'Henley Botanicals Private Limited',
            'url' => $appUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('/images/brand/logo.png'),
                'caption' => 'Henley',
            ],
            'sameAs' => [
                'https://instagram.com/henleybotanicals',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+91-800-436539',
                'contactType' => 'Customer Concierge',
                'areaServed' => 'IN',
                'availableLanguage' => 'en',
            ],
        ],
        [
            '@type' => 'WebSite',
            '@id' => "{$appUrl}/#website",
            'url' => $appUrl,
            'name' => 'Henley',
            'description' => $description,
            'publisher' => [
                '@id' => "{$appUrl}/#organization",
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => "{$appUrl}/shop?q={search_term_string}",
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

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset($image) }}">
    <meta property="og:site_name" content="Henley">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $canonicalUrl }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ asset($image) }}">

    <!-- Self-Hosted Font Preload Hints (Zero Layout Shift) -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Preload Hero Image on Homepage -->
    @if ($transparentHeader)
        <link rel="preload" href="/images/brand/homepage.jpeg" as="image">
    @endif

    <!-- JSON-LD Structured Data: Organization & WebSite with SearchAction -->
    <script type="application/ld+json">
    {!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full bg-canvas text-primary font-sans antialiased flex flex-col justify-between selection:bg-accent selection:text-inverse">
    <!-- Livewire SPA Loading Bar Indicator -->
    <div wire:loading.class="w-full opacity-100" class="fixed top-0 left-0 h-0.5 bg-accent z-[9999] transition-all duration-300 w-0 opacity-0 pointer-events-none"></div>

    <!-- Storefront Header -->
    <x-storefront.header
        :transparent-over-hero="$transparentHeader"
        :announcement-text="$announcementText"
        :announcement-link="$announcementLink"
        :nav-items="$navItems"
        :featured-collections="$featuredCollections"
    />

    <!-- Main Page Content -->
    <main id="main-content" class="flex-1 w-full">
        {{ $slot }}
    </main>

    <!-- Storefront Footer -->
    <x-storefront.footer />

    <!-- Live Search Overlay Component -->
    <livewire:storefront.search-overlay />

    <!-- Cart Slide-Over Drawer Placeholder -->
    <x-drawer name="cart-drawer" title="Your Ritual Basket" max-width="md">
        <div class="space-y-6">
            <x-empty-state
                title="Your basket is empty"
                description="Explore our single-origin flushes and rare botanicals to start your ritual."
                icon="bag"
            >
                <x-link-button href="/shop" variant="primary" size="md" trailing-arrow x-on:click="$dispatch('close-drawer', 'cart-drawer')">
                    Explore the Catalog
                </x-link-button>
            </x-empty-state>
        </div>
    </x-drawer>

    @livewireScripts
</body>
</html>
