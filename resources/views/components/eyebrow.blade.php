@props([
    'variant' => 'accent', // accent (oxblood) | gold | secondary | muted
    'tag' => 'span',
])

@php
$colorClasses = match ($variant) {
    'gold' => 'text-gold',
    'secondary' => 'text-secondary',
    'muted' => 'text-muted',
    default => 'text-accent',
};
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "inline-block font-sans text-eyebrow uppercase font-semibold tracking-[0.18em] select-none {$colorClasses}"]) }}>
    {{ $slot }}
</{{ $tag }}>
