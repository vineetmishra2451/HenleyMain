@props([
    'tinted' => false, // false = canvas base (#FBF9F6) | true = surface-raised (#F5F3EF) | dark = surface-dark
    'padding' => 'default', // default | compact | expansive | none
    'id' => null,
])

@php
$bgClass = match ($tinted) {
    true, 'raised' => 'bg-surface-raised',
    'dark' => 'bg-surface-dark text-inverse',
    default => 'bg-canvas text-primary',
};

$paddingClass = match ($padding) {
    'compact' => 'py-10 sm:py-14',
    'expansive' => 'py-20 sm:py-32',
    'none' => 'py-0',
    default => 'py-16 sm:py-24',
};
@endphp

<section
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => "relative w-full {$bgClass} {$paddingClass}"]) }}
>
    {{ $slot }}
</section>
