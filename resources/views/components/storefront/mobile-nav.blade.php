@props([
    'navItems' => [],
])

@php
$items = !empty($navItems) ? $navItems : [
    ['label' => 'Shop All', 'url' => '/shop'],
    [
        'label' => 'Collections',
        'url' => '/collections',
        'children' => [
            ['label' => 'Single-Estate Black Teas', 'url' => '/collections/single-origin-reserve'],
            ['label' => 'Rare White & Green Teas', 'url' => '/collections/single-origin-reserve'],
            ['label' => 'Restorative Botanicals', 'url' => '/collections/herbal-botanicals'],
            ['label' => 'Wild Whole Spices', 'url' => '/collections/single-origin-reserve'],
        ]
    ],
    ['label' => 'Herbal & Spices', 'url' => '/collections/herbal-botanicals'],
    ['label' => 'Curated Gifts', 'url' => '/collections/curated-gift-sets'],
    ['label' => 'Our Story & Terroir', 'url' => '/pages/the-cloche-ritual'],
    ['label' => 'The Journal', 'url' => '/journal'],
];
@endphp

<x-drawer name="mobile-nav" side="left" title="HENLEY" max-width="sm">
    <div class="flex flex-col h-full justify-between space-y-8">
        <!-- Search Trigger in Mobile Drawer -->
        <div>
            <button
                type="button"
                x-on:click="$dispatch('close-drawer', 'mobile-nav'); $dispatch('open-search')"
                class="w-full flex items-center justify-between p-3 rounded-full border border-hairline bg-surface-raised text-secondary text-caption hover:border-accent transition"
            >
                <span class="inline-flex items-center gap-2">
                    <x-icons.search class="w-4 h-4" />
                    <span>Search harvest or origin...</span>
                </span>
                <span class="text-[10px] uppercase font-mono tracking-widest text-muted">Cmd+K</span>
            </button>
        </div>

        <!-- Navigation Links Accordion -->
        <nav class="space-y-4" aria-label="Mobile Navigation">
            <x-accordion type="single">
                @foreach ($items as $item)
                    @if (isset($item['children']))
                        <x-accordion-item :title="$item['label']">
                            <ul class="space-y-2.5 pl-2 pt-2">
                                @foreach ($item['children'] as $child)
                                    <li>
                                        <a
                                            href="{{ $child['url'] }}"
                                            class="block text-body text-secondary hover:text-accent transition-colors"
                                        >
                                            {{ $child['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </x-accordion-item>
                    @else
                        <div class="py-3 border-b border-hairline/60">
                            <a
                                href="{{ $item['url'] }}"
                                class="font-serif text-display-3 font-normal text-primary hover:text-accent transition-colors block"
                            >
                                {{ $item['label'] }}
                            </a>
                        </div>
                    @endif
                @endforeach
            </x-accordion>
        </nav>

        <!-- Mobile Drawer Concierge & Footer Info -->
        <div class="space-y-4 pt-6 border-t border-hairline text-caption text-secondary">
            <div class="space-y-1">
                <span class="text-[10px] uppercase tracking-[0.18em] font-semibold text-primary block">Henley Concierge</span>
                <p>concierge@henleytea.com</p>
                <p>+91 800 HENLEY (436539)</p>
            </div>

            <div class="flex items-center justify-between pt-2">
                <span>Currency: <strong class="text-primary">INR (₹)</strong></span>
                <x-badge variant="sage">Direct Sourced</x-badge>
            </div>
        </div>
    </div>
</x-drawer>
