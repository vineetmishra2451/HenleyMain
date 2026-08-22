@props([
    'eyebrow' => null,
    'title' => '',
    'description' => null,
    'align' => 'center', // center | left | right
    'level' => 2, // 1 | 2 | 3
])

@php
$alignClasses = match ($align) {
    'left' => 'text-left items-start',
    'right' => 'text-right items-end',
    default => 'text-center items-center mx-auto',
};

$titleSizeClasses = match ((int) $level) {
    1 => 'text-display-1-mobile sm:text-display-1',
    3 => 'text-display-3',
    default => 'text-display-2-mobile sm:text-display-2',
};

$headingTag = 'h'.$level;
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col max-w-3xl mb-12 sm:mb-16 {$alignClasses}"]) }}>
    @if ($eyebrow)
        <x-eyebrow class="mb-3">
            {{ $eyebrow }}
        </x-eyebrow>
    @endif

    <{{ $headingTag }} class="font-serif font-normal text-primary tracking-tight {{ $titleSizeClasses }}">
        {{ $title ?? $slot }}
    </{{ $headingTag }}>

    @if ($description)
        <p class="mt-4 text-body-lead text-secondary max-w-2xl font-light leading-relaxed">
            {{ $description }}
        </p>
    @endif
</div>
