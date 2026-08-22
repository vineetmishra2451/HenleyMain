@props([
    'title' => 'First Flush Darjeeling 2026',
    'subtitle' => 'Single Estate • Castleton Lot 04',
    'price' => 1450,
    'compareAtPrice' => null,
    'image' => null,
    'imageAlt' => null,
    'rating' => 5.0,
    'ratingCount' => 24,
    'badge' => null,
    'badgeVariant' => 'gold',
    'href' => '#',
])

<article {{ $attributes->merge(['class' => 'group relative flex flex-col rounded-xl border border-hairline bg-surface-raised/40 p-4 transition-all duration-350 ease-henley hover:border-muted hover:bg-surface-raised hover:shadow-hover']) }}>
    <!-- Product Image Container with gentle 1.03x scale -->
    <a href="{{ $href }}" class="relative block aspect-square w-full overflow-hidden rounded-lg bg-surface-raised">
        @if ($image)
            <img
                src="{{ $image }}"
                alt="{{ $imageAlt ?? $title }}"
                loading="lazy"
                class="h-full w-full object-cover object-center transition-transform duration-500 ease-henley group-hover:scale-[1.03]"
            >
        @else
            <div class="flex h-full w-full items-center justify-center bg-surface-raised text-muted">
                <x-icons.package class="h-12 w-12 stroke-[1.2]" />
            </div>
        @endif

        @if ($badge)
            <div class="absolute top-3 left-3">
                <x-badge :variant="$badgeVariant">
                    {{ $badge }}
                </x-badge>
            </div>
        @endif
    </a>

    <!-- Card Content -->
    <div class="mt-4 flex flex-1 flex-col justify-between space-y-3">
        <div class="space-y-1.5">
            @if ($rating)
                <div class="flex items-center justify-between">
                    <x-commerce.rating :rating="$rating" :count="$ratingCount" />
                </div>
            @endif

            <h3 class="font-serif text-display-3 font-normal text-primary group-hover:text-accent transition-colors duration-250">
                <a href="{{ $href }}" class="focus:outline-none">
                    {{ $title }}
                </a>
            </h3>

            @if ($subtitle)
                <p class="font-sans text-caption text-secondary">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <div class="pt-2 flex items-center justify-between border-t border-hairline/60">
            <x-commerce.price :price="$price" :compare-at-price="$compareAtPrice" size="card" />

            @if (isset($action))
                <div>
                    {{ $action }}
                </div>
            @else
                <a
                    href="{{ $href }}"
                    aria-label="View {{ $title }}"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-hairline text-secondary hover:border-accent hover:text-accent hover:bg-surface-raised transition duration-250"
                >
                    <x-icons.arrow-right class="w-3.5 h-3.5" />
                </a>
            @endif
        </div>
    </div>
</article>
