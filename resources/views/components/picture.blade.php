@props([
    'src' => '',
    'alt' => '',
    'width' => 800,
    'height' => 800,
    'eager' => false,
    'sizes' => '(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw',
    'aspect' => 'aspect-square',
])

@php
$loading = $eager ? 'eager' : 'lazy';
$fetchPriority = $eager ? 'high' : 'auto';

// Strip extension for webp/avif srcset fallbacks if available
$basePath = preg_replace('/\.(jpe?g|png|webp|avif)$/i', '', $src);
$ext = pathinfo($src, PATHINFO_EXTENSION);
@endphp

<div {{ $attributes->merge(['class' => "relative overflow-hidden bg-surface-raised {$aspect}"]) }}>
    <picture>
        @if ($basePath && $ext)
            <source srcset="{{ $basePath }}.avif" type="image/avif" sizes="{{ $sizes }}">
            <source srcset="{{ $basePath }}.webp" type="image/webp" sizes="{{ $sizes }}">
        @endif

        <img
            src="{{ $src }}"
            alt="{{ $alt }}"
            width="{{ $width }}"
            height="{{ $height }}"
            loading="{{ $loading }}"
            fetchpriority="{{ $fetchPriority }}"
            class="h-full w-full object-cover object-center"
        >
    </picture>
</div>
