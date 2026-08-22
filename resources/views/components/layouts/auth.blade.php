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
<body class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans text-primary antialiased bg-canvas selection:bg-accent selection:text-inverse">

    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="/" class="inline-flex flex-col items-center group transition-transform duration-300 hover:scale-105">
            <span class="font-serif text-4xl tracking-[0.25em] font-semibold text-accent uppercase">HENLEY</span>
            <span class="text-[10px] uppercase tracking-[0.35em] text-gold mt-1 font-medium">Single-Origin Reserve</span>
        </a>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <div class="bg-surface-raised border border-hairline py-10 px-6 sm:px-10 rounded-2xl shadow-subtle relative overflow-hidden">
            <!-- Subtle apothecary top arch ornament -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-40 h-24 bg-hairline/30 rounded-b-full pointer-events-none"></div>

            {{ $slot }}
        </div>

        <div class="mt-6 text-center text-xs tracking-wider text-secondary">
            <p>{{ config('henley.brand.tagline', 'Pure leaf. Pure intent.') }}</p>
        </div>
    </div>

    @livewireScripts
</body>
</html>
