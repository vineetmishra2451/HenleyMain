<!DOCTYPE html>
<html lang="en" class="h-full bg-canvas">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Authentication' }} — {{ config('henley.brand.name', 'Henley') }}</title>

    <!-- Self-hosted font preloads -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full flex flex-col justify-between py-6 sm:py-12 sm:px-6 lg:px-8 font-sans text-primary antialiased bg-canvas selection:bg-accent selection:text-inverse">

    <!-- Top Navigation Bar with Prominent Back to Store Option -->
    <div class="w-full max-w-md mx-auto px-4 mb-4 flex items-center justify-between">
        <a
            href="/"
            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-hairline bg-surface-card text-xs font-sans font-medium text-primary hover:text-accent hover:border-accent transition-colors shadow-2xs group cursor-pointer"
            aria-label="Back to Store"
        >
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-0.5 transition-transform">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Back to Store</span>
        </a>

        <a href="/" class="text-xs font-sans text-secondary hover:text-accent transition-colors">
            Home ✕
        </a>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="/" class="inline-flex flex-col items-center group transition-transform duration-300 hover:scale-105">
            <span class="font-serif text-4xl tracking-[0.25em] font-semibold text-accent uppercase">HENLEY</span>
            <span class="text-[10px] uppercase tracking-[0.35em] text-gold mt-1 font-medium">Single-Origin Reserve</span>
        </a>
    </div>

    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <div class="bg-surface-raised border border-hairline py-8 sm:py-10 px-6 sm:px-10 rounded-2xl shadow-subtle relative overflow-hidden">
            <!-- Subtle apothecary top arch ornament -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-40 h-24 bg-hairline/30 rounded-b-full pointer-events-none"></div>

            {{ $slot }}
        </div>

        <div class="mt-6 text-center space-y-2">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs font-sans font-medium text-accent hover:underline">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Return to Henley Storefront</span>
            </a>
            <p class="text-[11px] text-secondary tracking-wider">{{ config('henley.brand.tagline', 'Pure leaf. Pure intent.') }}</p>
        </div>
    </div>

    @livewireScripts
</body>
</html>
