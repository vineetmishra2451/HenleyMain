@props([
    'size' => 'default', // default (1280px) | wide (1440px) | narrow (960px) | prose (65ch)
])

@php
$sizeClasses = match ($size) {
    'wide' => 'max-w-[1440px]',
    'narrow' => 'max-w-4xl',
    'prose' => 'max-w-prose',
    default => 'max-w-content',
};
@endphp

<div {{ $attributes->merge(['class' => "mx-auto w-full px-5 sm:px-8 lg:px-12 {$sizeClasses}"]) }}>
    {{ $slot }}
</div>
