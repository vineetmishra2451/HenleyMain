<div
    x-data="{
        scrolled: false,
        mobileOpen: false,
        megaOpen: false,
        megaTimeout: null,
        bannerDismissed: false,
        isTransparentHero: {{ $isTransparentHero ? 'true' : 'false' }},
        openMega() {
            clearTimeout(this.megaTimeout);
            this.megaOpen = true;
        },
        closeMegaWithDelay() {
            this.megaTimeout = setTimeout(() => {
                this.megaOpen = false;
            }, 200);
        }
    }"
    x-init="
        scrolled = window.pageYOffset > 30;
        window.addEventListener('scroll', () => {
            scrolled = window.pageYOffset > 30;
        });
    "
    class="relative z-40 w-full"
>
    <!-- 1. Top Announcement Bar (Dismissible, Setting-Driven) -->
    @if ($announcementEnabled)
        <div
            x-show="!bannerDismissed"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-12"
            x-transition:leave-end="opacity-0 max-h-0"
            class="bg-surface-raised border-b border-hairline py-2 px-4 text-center text-caption text-secondary relative transition-all duration-200"
        >
            <div class="max-w-content mx-auto flex items-center justify-center gap-2 pr-6">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-gold" aria-hidden="true"></span>
                @if ($announcementLink)
                    <a href="{{ $announcementLink }}" class="hover:text-accent font-medium transition-colors">
                        {{ $announcementText }}
                        <span class="ml-1 inline-block" aria-hidden="true">→</span>
                    </a>
                @else
                    <span>{{ $announcementText }}</span>
                @endif
            </div>

            <button
                type="button"
                x-on:click="bannerDismissed = true"
                aria-label="Dismiss announcement banner"
                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-muted hover:text-primary transition-colors"
            >
                <x-icons.close class="w-3.5 h-3.5" />
            </button>
        </div>
    @endif

    <!-- 2. Sticky Main Header Bar -->
    <header
        :class="{
            'bg-canvas/95 backdrop-blur-md border-b border-hairline shadow-subtle': scrolled || !isTransparentHero,
            'bg-transparent border-b border-transparent': !scrolled && isTransparentHero
        }"
        class="sticky top-0 w-full transition-all duration-300 ease-henley"
    >
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 flex items-center justify-between h-20">

            <!-- Mobile Hamburger Trigger (Left) -->
            <div class="flex items-center lg:hidden">
                <button
                    type="button"
                    x-on:click="mobileOpen = true"
                    aria-label="Open mobile navigation menu"
                    class="p-2 -ml-2 text-primary hover:text-accent transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent rounded-lg"
                >
                    <x-icons.menu class="w-6 h-6 stroke-[1.5]" />
                </button>
            </div>

            <!-- Brand Logo (Canonical Henley Vector Mark) -->
            <div class="flex items-center">
                <a href="/" class="flex flex-col items-center group select-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent rounded">
                    <span class="font-serif text-2xl sm:text-3xl tracking-[0.22em] font-normal text-primary group-hover:text-accent transition-colors duration-250">
                        HENLEY
                    </span>
                    <span class="text-[9px] uppercase tracking-[0.32em] text-gold font-medium -mt-1 hidden sm:block">
                        Botanical Reserve
                    </span>
                </a>
            </div>

            <!-- Desktop Primary Navigation -->
            <nav class="hidden lg:flex items-center space-x-8" aria-label="Primary navigation">
                @foreach ($menuItems as $item)
                    @if (! empty($item['has_mega']))
                        <div
                            class="relative"
                            x-on:mouseenter="openMega()"
                            x-on:mouseleave="closeMegaWithDelay()"
                        >
                            <a
                                href="{{ $item['url'] }}"
                                x-on:click.prevent="megaOpen = !megaOpen"
                                x-on:keydown.escape="megaOpen = false"
                                :aria-expanded="megaOpen"
                                class="inline-flex items-center gap-1 font-sans text-xs uppercase tracking-[0.16em] font-medium text-primary hover:text-accent py-2 transition-colors duration-250 cursor-pointer focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent rounded"
                            >
                                <span>{{ $item['label'] }}</span>
                                <x-icons.chevron-down class="w-3.5 h-3.5 text-secondary transition-transform duration-250" x-bind:class="{ 'rotate-180 text-accent': megaOpen }" />
                            </a>
                        </div>
                    @else
                        <a
                            href="{{ $item['url'] }}"
                            class="font-sans text-xs uppercase tracking-[0.16em] font-medium text-primary hover:text-accent py-2 transition-colors duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent rounded"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Right Utilities Cluster (Search, Account, Cart) -->
            <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Search Button Overlay Trigger -->
                <button
                    type="button"
                    x-data
                    x-on:click="$dispatch('open-search')"
                    aria-label="Search botanical catalogue"
                    class="p-2 text-primary hover:text-accent hover:bg-surface-raised rounded-full transition duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                >
                    <x-icons.search class="w-5 h-5 stroke-[1.5]" />
                </button>

                <!-- Account Icon -->
                @auth
                    <a
                        href="/account"
                        aria-label="Collector account"
                        class="p-2 text-primary hover:text-accent hover:bg-surface-raised rounded-full transition duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                    >
                        <x-icons.user class="w-5 h-5 stroke-[1.5]" />
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        aria-label="Sign in to collector account"
                        class="p-2 text-primary hover:text-accent hover:bg-surface-raised rounded-full transition duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                    >
                        <x-icons.user class="w-5 h-5 stroke-[1.5]" />
                    </a>
                @endauth

                <!-- Cart Button with Live Badge -->
                <a
                    href="/cart"
                    aria-label="View shopping bag"
                    class="relative p-2 text-primary hover:text-accent hover:bg-surface-raised rounded-full transition duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                >
                    <x-icons.bag class="w-5 h-5 stroke-[1.5]" />
                    @if ($cartCount > 0)
                        <span class="absolute top-0 right-0 flex h-4 w-4 items-center justify-center rounded-full bg-accent text-[9px] font-bold text-inverse font-sans select-none">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>
        </div>

        <!-- 3. Desktop Collections Mega Panel (Accessible, Keyboard-traversable) -->
        <div
            x-show="megaOpen"
            x-on:mouseenter="openMega()"
            x-on:mouseleave="closeMegaWithDelay()"
            x-on:keydown.escape.window="megaOpen = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="hidden lg:block absolute left-0 top-full w-full bg-surface-card border-b border-hairline shadow-2xl z-30"
            style="display: none;"
        >
            <div class="max-w-content mx-auto px-12 py-10">
                <div class="grid grid-cols-4 gap-8">
                    <!-- Collection Tiles -->
                    <div class="col-span-3 grid grid-cols-3 gap-6">
                        @foreach ($megaCollections as $category)
                            <a
                                href="/collections/{{ $category->slug }}"
                                class="group flex flex-col p-4 rounded-xl border border-hairline bg-surface-raised/40 hover:border-accent hover:bg-surface-raised transition duration-250"
                            >
                                <div class="aspect-[4/3] w-full rounded-lg overflow-hidden bg-surface-raised mb-3 border border-hairline/60">
                                    @if ($category->image_path)
                                        <img
                                            src="{{ $category->image_path }}"
                                            alt="{{ $category->name }}"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        >
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-muted">
                                            <x-icons.package class="h-8 w-8" />
                                        </div>
                                    @endif
                                </div>

                                <div class="space-y-1">
                                    <h4 class="font-serif text-lg font-normal text-primary group-hover:text-accent transition-colors">
                                        {{ $category->name }}
                                    </h4>
                                    <p class="text-caption text-secondary line-clamp-1">
                                        {{ $category->description ?? 'Single-origin estate terroir.' }}
                                    </p>
                                    <span class="text-[11px] font-sans font-semibold text-accent block pt-1">
                                        {{ $category->products_count }} Rare Lots →
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Mega Menu Sidebar Benefits & Complete Index Link -->
                    <div class="border-l border-hairline pl-8 space-y-6 flex flex-col justify-between">
                        <div class="space-y-4">
                            <x-eyebrow variant="gold">
                                The Henley Cellar
                            </x-eyebrow>
                            <h4 class="font-serif text-xl font-normal text-primary leading-tight">
                                High-Elevation Botanical Harvests
                            </h4>
                            <ul class="space-y-2.5 text-caption text-secondary">
                                <li class="flex items-center gap-2">
                                    <x-icons.leaf class="w-4 h-4 text-sage flex-shrink-0" />
                                    <span>100% Single-Estate Traceability</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <x-icons.package class="w-4 h-4 text-gold flex-shrink-0" />
                                    <span>Sealed in UV-Proof Porcelain Cloches</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <x-icons.shield-check class="w-4 h-4 text-gold flex-shrink-0" />
                                    <span>Flushed with Nitrogen at Origin</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-hairline">
                            <x-link-button href="/collections" variant="primary" size="sm" trailing-arrow class="w-full">
                                Browse All Collections
                            </x-link-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 4. Mobile Navigation Slide-Over Drawer -->
    <div
        x-show="mobileOpen"
        x-on:keydown.escape.window="mobileOpen = false"
        class="lg:hidden relative z-50"
        role="dialog"
        aria-modal="true"
        style="display: none;"
    >
        <!-- Backdrop -->
        <div
            x-show="mobileOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-on:click="mobileOpen = false"
            class="fixed inset-0 bg-primary/50 backdrop-blur-sm"
        ></div>

        <!-- Drawer Content from Left -->
        <div class="fixed inset-y-0 left-0 max-w-xs w-full bg-surface-card shadow-2xl border-r border-hairline flex flex-col justify-between p-6">
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex items-center justify-between pb-6 border-b border-hairline">
                    <span class="font-serif text-2xl font-normal text-primary tracking-widest">HENLEY</span>
                    <button
                        type="button"
                        x-on:click="mobileOpen = false"
                        aria-label="Close mobile navigation"
                        class="p-2 text-secondary hover:text-primary rounded-full hover:bg-surface-raised"
                    >
                        <x-icons.close class="w-5 h-5" />
                    </button>
                </div>

                <!-- Navigation List -->
                <nav class="space-y-2" aria-label="Mobile navigation">
                    @foreach ($menuItems as $item)
                        @if (! empty($item['has_mega']))
                            <div x-data="{ openSub: false }" class="py-1">
                                <button
                                    type="button"
                                    x-on:click="openSub = !openSub"
                                    class="w-full flex items-center justify-between py-2.5 font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary"
                                >
                                    <span>{{ $item['label'] }}</span>
                                    <x-icons.chevron-down class="w-4 h-4 text-secondary transition-transform duration-200" x-bind:class="{ 'rotate-180 text-accent': openSub }" />
                                </button>
                                <div x-show="openSub" class="pl-4 pt-2 space-y-2 border-l border-hairline ml-2">
                                    @foreach ($megaCollections as $category)
                                        <a href="/collections/{{ $category->slug }}" class="block text-ui text-secondary hover:text-accent py-1">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                    <a href="/collections" class="block text-caption font-semibold text-accent pt-1">
                                        All Collections →
                                    </a>
                                </div>
                            </div>
                        @else
                            <a href="{{ $item['url'] }}" class="block py-2.5 font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary hover:text-accent transition-colors">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>

            <!-- Footer Utilities -->
            <div class="pt-6 border-t border-hairline space-y-3">
                @auth
                    <a href="/account" class="flex items-center gap-2 text-ui text-primary hover:text-accent py-2 font-medium">
                        <x-icons.user class="w-4 h-4" />
                        <span>My Collector Profile</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 text-ui text-primary hover:text-accent py-2 font-medium">
                        <x-icons.user class="w-4 h-4" />
                        <span>Collector Sign In</span>
                    </a>
                @endauth

                <div class="text-caption text-secondary pt-2">
                    <p>{{ config('henley.brand.tagline') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Search Overlay Component Instance -->
    <livewire:storefront.search-overlay />
</div>
