@props([
    'ratio' => '1:1', // 1:1 | 2:1 | 1:2 | 3:2 | 2:3
    'align' => 'center', // center | start | end
    'reverseOnMobile' => false,
    'gap' => 'default', // default | compact | wide
])

@php
$gridClasses = match ($ratio) {
    '2:1' => 'lg:grid-cols-[2fr_1fr]',
    '1:2' => 'lg:grid-cols-[1fr_2fr]',
    '3:2' => 'lg:grid-cols-[3fr_2fr]',
    '2:3' => 'lg:grid-cols-[2fr_3fr]',
    default => 'lg:grid-cols-2',
};

$alignClasses = match ($align) {
    'start' => 'items-start',
    'end' => 'items-end',
    default => 'items-center',
};

$gapClasses = match ($gap) {
    'compact' => 'gap-6 lg:gap-8',
    'wide' => 'gap-12 lg:gap-20',
    default => 'gap-8 lg:gap-14',
};
@endphp

<div {{ $attributes->merge(['class' => "grid grid-cols-1 {$gridClasses} {$alignClasses} {$gapClasses}"]) }}>
    {{ $slot }}
</div>
