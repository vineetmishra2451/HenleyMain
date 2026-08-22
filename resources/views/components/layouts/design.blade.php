<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-canvas scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Henley Design System & Living Component Gallery' }}</title>

    <!-- Self-hosted font preloading for above-the-fold render -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full bg-canvas text-primary antialiased selection:bg-accent selection:text-inverse">
    <!-- Livewire SPA Loading Bar Indicator -->
    <div wire:loading.class="w-full opacity-100" class="fixed top-0 left-0 h-0.5 bg-accent z-[9999] transition-all duration-300 w-0 opacity-0 pointer-events-none"></div>

    {{ $slot }}

    @livewireScripts
</body>
</html>
