@props([
    'transparentOverHero' => false,
    'announcementText' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'announcementLink' => '/collections/single-origin-reserve',
    'navItems' => [],
    'featuredCollections' => [],
    'cartCount' => 0,
])

@php
$defaultNav = [
    ['label' => 'Shop', 'url' => '/shop', 'mega' => false],
    ['label' => 'Collections', 'url' => '/collections', 'mega' => true],
    ['label' => 'Herbal & Spices', 'url' => '/collections/herbal-botanicals', 'mega' => false],
    ['label' => 'Gifts', 'url' => '/collections/curated-gift-sets', 'mega' => false],
    ['label' => 'Our Story', 'url' => '/pages/the-cloche-ritual', 'mega' => false],
    ['label' => 'Journal', 'url' => '/journal', 'mega' => false],
];

$items = !empty($navItems) ? $navItems : $defaultNav;
@endphp

<div
    x-data="{
        scrolled: false,
        megaOpen: false,
        cartCount: {{ (int) $cartCount }},
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 30;
            }, { passive: true });
        }
    }"
    x-on:cart-updated.window="cartCount = $event.detail.count"
    class="sticky top-0 z-40 w-full transition-all duration-300 ease-henley"
>
    <!-- Announcement Bar -->
    @if ($announcementText)
        <x-storefront.announcement-bar :text="$announcementText" :link="$announcementLink" />
    @endif

    <!-- Main Navigation Bar -->
    <header
        :class="{
            'bg-canvas/95 backdrop-blur-md border-b border-hairline shadow-subtle py-3.5': scrolled || !{{ $transparentOverHero ? 'true' : 'false' }},
            'bg-canvas/40 backdrop-blur-sm border-b border-hairline/40 py-5': !scrolled && {{ $transparentOverHero ? 'true' : 'false' }}
        }"
        class="w-full transition-all duration-300 ease-henley"
    >
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 flex items-center justify-between">
            <!-- Left: Mobile Menu Button (Mobile) & Brand Desktop Wordmark -->
            <div class="flex items-center gap-4">
                <button
                    type="button"
                    x-on:click="$dispatch('open-drawer', 'mobile-nav')"
                    aria-label="Open navigation menu"
                    class="lg:hidden p-2 text-primary hover:text-accent rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                >
                    <x-icons.menu class="w-5 h-5" />
                </button>

                <a href="/" class="focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent rounded-sm">
                    <x-brand.logo />
                </a>
            </div>

            <!-- Center: Primary Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center space-x-8" aria-label="Primary Navigation">
                @foreach ($items as $item)
                    @if (! empty($item['mega']))
                        <div
                            class="relative"
                            x-on:mouseenter="megaOpen = true"
                            x-on:mouseleave="megaOpen = false"
                        >
                            <button
                                type="button"
                                x-on:click="megaOpen = !megaOpen"
                                :class="{ 'text-accent border-accent': megaOpen }"
                                class="font-sans text-xs uppercase tracking-[0.16em] font-medium text-primary hover:text-accent py-2 transition-colors duration-250 inline-flex items-center gap-1.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent cursor-pointer"
                                :aria-expanded="megaOpen"
                            >
                                <span>{{ $item['label'] }}</span>
                                <x-icons.chevron-down class="w-3.5 h-3.5 transition-transform duration-200" ::class="{ 'rotate-180 text-accent': megaOpen }" />
                            </button>
                        </div>
                    @else
                        <a
                            href="{{ $item['url'] }}"
                            class="font-sans text-xs uppercase tracking-[0.16em] font-medium text-primary hover:text-accent py-2 transition-colors duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Right: Action Cluster (Search, Account, Cart) -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Search Button (Opens Live Search Overlay) -->
                <button
                    type="button"
                    x-on:click="$dispatch('open-search')"
                    aria-label="Search catalogue"
                    class="p-2 text-primary hover:text-accent rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                >
                    <x-icons.search class="w-4 h-4 sm:w-5 sm:h-5" />
                </button>

                <!-- Account / Sanctum Link -->
                <a
                    href="{{ auth()->check() ? (auth()->user()->hasRole('super_admin|admin') ? url('/admin') : url('/account')) : route('login') }}"
                    aria-label="{{ auth()->check() ? 'My Account' : 'Sign in' }}"
                    class="p-2 text-primary hover:text-accent rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                >
                    <x-icons.user class="w-4 h-4 sm:w-5 sm:h-5" />
                </a>

                <!-- Cart Button (Opens Cart Drawer or links to cart) -->
                <a
                    href="{{ url('/cart') }}"
                    x-on:click.prevent="$dispatch('open-drawer', 'cart-drawer')"
                    aria-label="View ritual basket"
                    class="relative p-2 text-primary hover:text-accent rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent group cursor-pointer"
                >
                    <x-icons.bag class="w-4 h-4 sm:w-5 sm:h-5" />
                    <span
                        x-show="cartCount > 0"
                        x-text="cartCount"
                        class="absolute -top-0.5 -right-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-accent text-[9px] font-bold text-inverse tracking-tight"
                        style="display: none;"
                    ></span>
                </a>
            </div>
        </div>

        <!-- Collections Mega Menu Dropdown -->
        <x-storefront.mega-menu :collections="$featuredCollections" />
    </header>

    <!-- Mobile Slide-Over Navigation Drawer -->
    <x-storefront.mobile-nav :nav-items="$items" />
</div>
