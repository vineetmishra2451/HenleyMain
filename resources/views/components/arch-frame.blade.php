@props([
    'variant' => 'default', // default | gold-rim | subtle
    'aspect' => 'aspect-[3/4]',
])

@php
$borderClasses = match ($variant) {
    'gold-rim' => 'border border-gold shadow-subtle',
    'subtle' => 'border border-hairline/60',
    default => 'border border-hairline shadow-subtle',
};
@endphp

<div {{ $attributes->merge(['class' => "relative overflow-hidden rounded-t-[9999px] rounded-b-none bg-surface-raised {$aspect} {$borderClasses} transition-all duration-350 ease-henley"]) }}>
    {{ $slot }}
</div>
