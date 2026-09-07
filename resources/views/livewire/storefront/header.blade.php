<div
    x-data="{
        announcementVisible: true,
        mobileMenuOpen: false,
        scrolled: false,
    }"
    x-init="
        scrolled = window.pageYOffset > 20;
        window.addEventListener('scroll', () => {
            scrolled = window.pageYOffset > 20;
        });
    "
    class="sticky top-0 z-50 w-full"
>
    <!-- ── Announcement Bar ──────────────────────────────── -->
    @if ($announcementEnabled)
        <div
            x-show="announcementVisible"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-12"
            x-transition:leave-end="opacity-0 max-h-0"
            class="relative bg-maroon text-center py-2.5 px-12"
        >
            <p class="text-gold text-xs font-sans font-medium tracking-[0.08em]">
                @if ($announcementLink)
                    <a href="{{ $announcementLink }}" class="hover:underline transition-all">
                        {{ $announcementText }}
                    </a>
                @else
                    {{ $announcementText }}
                @endif
            </p>
            <button
                type="button"
                x-on:click="announcementVisible = false"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-ivory/60 hover:text-ivory transition-colors cursor-pointer"
                aria-label="Dismiss announcement"
            >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- ── Symmetrical Split Nav Row ──────────────────────── -->
    <nav class="border-b border-border bg-ivory transition-shadow duration-300" :class="{ 'shadow-subtle': scrolled }" aria-label="Main navigation">
        <div class="henley-container relative flex items-center justify-between h-16 lg:h-[72px]">

            <!-- Left Nav (Desktop) / Hamburger (Mobile) -->
            <div class="flex items-center gap-1 lg:flex-1">
                <!-- Hamburger — mobile only -->
                <button
                    type="button"
                    class="lg:hidden p-2 -ml-2 text-charcoal hover:text-maroon transition-colors cursor-pointer"
                    x-on:click="mobileMenuOpen = true"
                    aria-label="Open menu"
                >
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round">
                        <path d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </button>

                <!-- Desktop Left Nav Links -->
                <div class="hidden lg:flex items-center gap-1 xl:gap-2">
                    @foreach ($leftNavLinks as $link)
                        <a
                            href="{{ $link['url'] }}"
                            class="px-2 xl:px-3 py-2 text-[11px] xl:text-xs font-sans font-medium tracking-[0.08em] uppercase transition-colors whitespace-nowrap {{ request()->is(trim($link['url'], '/')) || ($link['url'] === '/collections' && request()->is('collections*')) ? 'text-maroon border-b-2 border-maroon' : 'text-charcoal hover:text-maroon' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Center: Henley Logo - strictly centered on mobile and symmetrical on desktop -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 lg:static lg:left-auto lg:top-auto lg:translate-x-0 lg:translate-y-0 flex items-center justify-center px-2 flex-shrink-0 z-10 pointer-events-auto">
                <a href="/" aria-label="Henley Home" class="flex items-center justify-center">
                    <img
                        src="/images/brand/logo.png"
                        alt="Henley"
                        width="144"
                        height="36"
                        class="w-28 sm:w-36 h-auto object-contain select-none transition-opacity hover:opacity-90"
                    />
                </a>
            </div>

            <!-- Right Nav Links + Action Icons -->
            <div class="flex items-center justify-end gap-1 xl:gap-2 lg:flex-1">
                <!-- Desktop Right Nav Links -->
                <div class="hidden lg:flex items-center gap-1 xl:gap-2 mr-2">
                    @foreach ($rightNavLinks as $link)
                        <a
                            href="{{ $link['url'] }}"
                            class="px-2 xl:px-3 py-2 text-[11px] xl:text-xs font-sans font-medium tracking-[0.08em] uppercase text-charcoal hover:text-maroon transition-colors whitespace-nowrap {{ request()->is(trim($link['url'], '/')) ? 'text-maroon border-b-2 border-maroon' : '' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Search Button -->
                <button
                    type="button"
                    x-data
                    x-on:click="$dispatch('open-search')"
                    class="p-2 text-charcoal hover:text-maroon transition-colors cursor-pointer rounded-full"
                    aria-label="Search catalog"
                >
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </button>

                <!-- Account Icon -->
                @auth
                    <a
                        href="/account"
                        class="p-2 text-charcoal hover:text-maroon transition-colors rounded-full"
                        aria-label="Your account"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="p-2 text-charcoal hover:text-maroon transition-colors rounded-full"
                        aria-label="Sign in"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </a>
                @endauth

                <!-- Cart Button with live counter -->
                <button
                    type="button"
                    x-data
                    x-on:click="$dispatch('open-cart-drawer')"
                    class="relative p-2 text-charcoal hover:text-maroon transition-colors cursor-pointer rounded-full"
                    aria-label="Open cart ({{ $cartCount }} items)"
                >
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 01-8 0" />
                    </svg>
                    @if ($cartCount > 0)
                        <span
                            class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-maroon text-ivory text-[10px] font-sans font-semibold flex items-center justify-center animate-scaleIn"
                        >
                            {{ $cartCount > 9 ? '9+' : $cartCount }}
                        </span>
                    @endif
                </button>
            </div>
        </div>
    </nav>

    <!-- ── Mobile Menu Slide-in Drawer ───────────────────── -->
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 lg:hidden"
        style="display: none;"
    >
        <!-- Backdrop -->
        <div
            class="fixed inset-0 bg-charcoal/40 backdrop-blur-xs"
            x-on:click="mobileMenuOpen = false"
        ></div>

        <!-- Drawer Panel -->
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="relative w-full max-w-xs bg-ivory h-full shadow-2xl flex flex-col justify-between overflow-y-auto"
        >
            <div>
                <!-- Drawer Header -->
                <div class="flex items-center justify-between p-5 border-b border-border">
                    <a href="/" x-on:click="mobileMenuOpen = false">
                        <img src="/images/brand/logo.png" alt="Henley" class="w-28 h-auto" />
                    </a>
                    <button
                        type="button"
                        x-on:click="mobileMenuOpen = false"
                        class="p-2 text-charcoal/60 hover:text-charcoal transition-colors cursor-pointer"
                        aria-label="Close menu"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Drawer Links -->
                <div class="py-4 px-5 space-y-1">
                    @foreach ($allNavLinks as $link)
                        <a
                            href="{{ $link['url'] }}"
                            x-on:click="mobileMenuOpen = false"
                            class="block py-2.5 text-xs font-sans font-medium uppercase tracking-[0.12em] text-charcoal hover:text-maroon transition-colors border-b border-border/40"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Drawer Footer -->
            <div class="p-5 border-t border-border bg-sand/30 space-y-3">
                <p class="text-[11px] font-sans text-charcoal/60">Concierge: +91 800 436 539</p>
                @auth
                    <a href="/account" class="block text-xs font-sans font-medium uppercase tracking-wider text-maroon">
                        Your Account →
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block text-xs font-sans font-medium uppercase tracking-wider text-maroon">
                        Sign In / Register →
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Live Search Overlay Component Instance -->
    <livewire:storefront.search-overlay />
</div>
