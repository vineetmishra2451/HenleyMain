@props([
    'collections' => [],
])

@php
$defaultCollections = [
    [
        'name' => 'Single-Estate Black Teas',
        'slug' => 'single-estate-black-teas',
        'subtitle' => 'Elevation 1,800m',
        'desc' => 'First Flush Darjeeling & orthodox Himalayan lots.',
        'image' => '/images/brand/product.jpeg',
        'url' => '/collections/single-origin-reserve',
    ],
    [
        'name' => 'Rare White & Green Teas',
        'slug' => 'white-green-teas',
        'subtitle' => 'Spring Budburst',
        'desc' => 'Imperial Silver Needle and hand-rolled emerald leaves.',
        'image' => '/images/brand/productpage.jpeg',
        'url' => '/collections/single-origin-reserve',
    ],
    [
        'name' => 'Restorative Botanicals',
        'slug' => 'restorative-botanicals',
        'subtitle' => 'High-Grown Herbal',
        'desc' => 'Nilgiri lavender, wild chamomile & restorative tisanes.',
        'image' => '/images/brand/collectionpage.jpeg',
        'url' => '/collections/herbal-botanicals',
    ],
    [
        'name' => 'Wild Whole Spices',
        'slug' => 'wild-whole-spices',
        'subtitle' => 'Malabar Terroir',
        'desc' => 'Grade A1 Mogra saffron and 8mm Wayanad cardamom.',
        'image' => '/images/brand/homepage.jpeg',
        'url' => '/collections/single-origin-reserve',
    ],
];

$items = (! empty($collections) && count($collections) > 0) ? $collections : $defaultCollections;
@endphp

<div
    x-show="megaOpen"
    x-transition:enter="transition ease-henley duration-250 transform"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150 transform"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    x-on:keydown.escape.window="megaOpen = false"
    x-on:click.outside="megaOpen = false"
    class="absolute top-full left-0 w-full bg-surface-card border-b border-hairline shadow-2xl z-50 overflow-hidden"
    style="display: none;"
    role="region"
    aria-label="Collections Mega Menu"
>
    <div class="max-w-content mx-auto px-6 sm:px-12 py-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach ($items as $col)
                @php
                    $isArr = is_array($col);
                    $name = $isArr ? ($col['name'] ?? '') : ($col->name ?? '');
                    $slug = $isArr ? ($col['slug'] ?? 'single-origin-reserve') : ($col->slug ?? 'single-origin-reserve');
                    $subtitle = $isArr ? ($col['subtitle'] ?? 'Terroir Reserve') : 'Single-Origin Reserve';
                    $desc = $isArr ? ($col['desc'] ?? '') : ($col->description ? \Illuminate\Support\Str::limit($col->description, 60) : 'Single-estate orthodox harvest.');
                    $image = $isArr ? ($col['image'] ?? '/images/brand/product.jpeg') : ($col->image_path ?? '/images/brand/product.jpeg');
                    $url = $isArr ? ($col['url'] ?? "/collections/{$slug}") : "/collections/{$slug}";
                @endphp

                <a
                    href="{{ $url }}"
                    class="group flex flex-col space-y-3 p-4 rounded-xl hover:bg-surface-raised transition-all duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                >
                    <!-- Arched Thumbnail Motif -->
                    <div class="aspect-[4/3] w-full overflow-hidden rounded-arch border border-hairline bg-surface-raised relative">
                        <img
                            src="{{ $image }}"
                            alt="{{ $name }}"
                            class="h-full w-full object-cover object-center transition-transform duration-500 ease-henley group-hover:scale-105"
                        >
                    </div>

                    <div class="space-y-1">
                        <span class="text-[10px] uppercase tracking-[0.18em] font-semibold text-accent block">
                            {{ $subtitle }}
                        </span>
                        <h4 class="font-serif text-lg font-normal text-primary group-hover:text-accent transition-colors">
                            {{ $name }}
                        </h4>
                        <p class="text-caption text-secondary line-clamp-2">
                            {{ $desc }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Mega Menu Footer Bar -->
        <div class="mt-8 pt-6 border-t border-hairline flex items-center justify-between">
            <div class="flex items-center gap-6 text-caption text-secondary">
                <span class="inline-flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-sage" aria-hidden="true"></span>
                    100% Single-Garden Origin
                </span>
                <span class="inline-flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-gold" aria-hidden="true"></span>
                    Nitrogen-Flushed Cloche Jars
                </span>
                <span class="inline-flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent" aria-hidden="true"></span>
                    Zero Synthetic Aromas
                </span>
            </div>

            <a
                href="/collections"
                class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-accent hover:text-accent-hover inline-flex items-center gap-1.5 group"
            >
                <span>View All Collections Index</span>
                <span class="inline-block transition-transform duration-250 ease-henley group-hover:translate-x-1">→</span>
            </a>
        </div>
    </div>
</div>
