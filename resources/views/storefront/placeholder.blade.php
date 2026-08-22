<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-canvas">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('henley.brand.name') }} — {{ config('henley.brand.tagline') }}</title>

    <!-- Self-hosted font preloads -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-canvas text-primary font-sans antialiased flex flex-col items-center justify-center p-6 select-none">
    <div class="max-w-md w-full text-center space-y-8 bg-surface-raised/80 backdrop-blur border border-hairline rounded-2xl p-10 shadow-subtle">

        <!-- Henley Brand Mark -->
        <div class="flex flex-col items-center justify-center space-y-2">
            <h1 class="text-3xl font-bold tracking-[0.25em] text-primary font-sans">
                HENLEY
            </h1>
            <x-eyebrow variant="gold">
                {{ config('henley.brand.tagline') }}
            </x-eyebrow>
        </div>

        <!-- Hairline Divider with Gold Ornament -->
        <x-divider variant="gold" ornament />

        <!-- Editorial Placeholder Message -->
        <div class="space-y-3">
            <h2 class="text-2xl font-serif text-primary font-normal">
                Fifteen quiet minutes for the senses.
            </h2>
            <p class="text-body text-secondary leading-relaxed">
                Direct-to-consumer tea, single-origin botanicals, and handpicked whole spices. Phase 04 Design System and Component Library active.
            </p>
        </div>

        <!-- Panel & Design Links -->
        <div class="pt-4 flex flex-col gap-3">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <x-link-button href="{{ url('/admin') }}" variant="primary" size="sm" trailing-arrow class="w-full sm:w-auto">
                    Management
                </x-link-button>
                <x-link-button href="{{ url('/vendor') }}" variant="secondary" size="sm" class="w-full sm:w-auto">
                    Vendor Portal
                </x-link-button>
            </div>

            @if (app()->environment(['local', 'staging', 'testing']))
                <div class="pt-2 border-t border-hairline/60">
                    <x-link-button href="{{ route('design.gallery') }}" variant="ghost" size="sm" trailing-arrow>
                        Living Component Gallery (/design)
                    </x-link-button>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
