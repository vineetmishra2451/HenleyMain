@props([
    'variant' => 'default', // tall | wide | default | gold-rim | subtle
    'aspect' => 'aspect-[3/4]',
])

@php
$clipId = 'arch-clip-' . $variant . '-' . \Illuminate\Support\Str::random(6);

$isSvgArch = in_array($variant, ['tall', 'wide'], true);
$archPath = match ($variant) {
    'tall' => 'M 0,1 L 0,0.42 C 0,0.22 0.12,0.06 0.5,0 C 0.88,0.06 1,0.22 1,0.42 L 1,1 Z',
    'wide' => 'M 0,1 L 0,0.48 C 0,0.12 0.12,0 0.5,0 C 0.88,0 1,0.12 1,0.48 L 1,1 Z',
    default => null,
};

$variantAspect = match ($variant) {
    'tall' => 'aspect-[3/5]',
    'wide' => 'aspect-[4/3]',
    default => $aspect,
};

$borderClasses = match ($variant) {
    'gold-rim' => 'border border-gold shadow-subtle',
    'subtle' => 'border border-hairline/60',
    'tall', 'wide' => '',
    default => 'border border-hairline shadow-subtle',
};
@endphp

@if ($isSvgArch)
    <div {{ $attributes->merge(['class' => "relative {$variantAspect} w-full"]) }}>
        <svg width="0" height="0" class="absolute" aria-hidden="true">
            <defs>
                <clipPath id="{{ $clipId }}" clipPathUnits="objectBoundingBox">
                    <path d="{{ $archPath }}" />
                </clipPath>
            </defs>
        </svg>
        <div class="w-full h-full overflow-hidden" style="clip-path: url(#{{ $clipId }});">
            {{ $slot }}
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => "relative overflow-hidden rounded-t-[9999px] rounded-b-none bg-surface-raised {$aspect} {$borderClasses} transition-all duration-350 ease-henley"]) }}>
        {{ $slot }}
    </div>
@endif

