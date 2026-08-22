@props([
    'title' => 'Your ritual basket is empty',
    'description' => 'Discover premier single-origin flushes and botanical elixirs to begin your ritual.',
    'icon' => 'bag',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center text-center p-12 sm:p-16 rounded-2xl border border-dashed border-hairline bg-surface-raised/40 max-w-lg mx-auto my-8']) }}>
    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-surface-raised border border-hairline text-secondary mb-5">
        @if ($icon === 'bag')
            <x-icons.bag class="h-7 w-7 stroke-[1.2]" />
        @elseif ($icon === 'heart')
            <x-icons.heart class="h-7 w-7 stroke-[1.2]" />
        @elseif ($icon === 'search')
            <x-icons.search class="h-7 w-7 stroke-[1.2]" />
        @else
            <x-icons.package class="h-7 w-7 stroke-[1.2]" />
        @endif
    </div>

    <h4 class="font-serif text-display-3 font-normal text-primary tracking-tight">
        {{ $title }}
    </h4>

    @if ($description)
        <p class="mt-2 text-body text-secondary max-w-sm">
            {{ $description }}
        </p>
    @endif

    @if ($slot->isNotEmpty())
        <div class="mt-6">
            {{ $slot }}
        </div>
    @endif
</div>
