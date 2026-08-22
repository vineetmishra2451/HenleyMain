@props([
    'rating' => 5.0, // float e.g. 4.8
    'count' => null,  // int e.g. 128
    'showCount' => true,
    'size' => 'sm', // sm | md
])

@php
$r = (float) $rating;
$iconSize = $size === 'md' ? 'w-4 h-4' : 'w-3.5 h-3.5';
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 select-none']) }} aria-label="Rated {{ number_format($r, 1) }} out of 5 stars">
    <div class="flex items-center gap-0.5" aria-hidden="true">
        @for ($i = 1; $i <= 5; $i++)
            @if ($r >= $i)
                <x-icons.star-filled class="{{ $iconSize }}" />
            @elseif ($r >= $i - 0.5)
                <x-icons.star-half class="{{ $iconSize }}" />
            @else
                <x-icons.star-empty class="{{ $iconSize }}" />
            @endif
        @endfor
    </div>

    @if ($showCount && $count !== null)
        <span class="font-sans text-caption text-secondary">
            ({{ $count }})
        </span>
    @endif
</div>
