<div
    x-data="{
        announcementVisible: true,
        mobileMenuOpen: false,
        cartDrawerOpen: false,
        scrolled: false,
        activeCategorySlug: null,
    }"
    @open-cart-drawer.window="cartDrawerOpen = true"
    @close-cart-drawer.window="cartDrawerOpen = false"
    x-init="
        scrolled = window.pageYOffset > 20;
        window.addEventListener('scroll', () => {
            scrolled = window.pageYOffset > 20;
        });
    "
    class="sticky top-0 z-50 w-full"
>
    <!-- ── Announcement Bar ──────────────────────────────── -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($announcementEnabled): ?>
        <div
            x-show="announcementVisible"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 max-h-12"
            x-transition:leave-end="opacity-0 max-h-0"
            class="relative bg-maroon text-center py-2.5 px-12"
        >
            <p class="text-gold text-xs font-sans font-medium tracking-[0.08em]">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($announcementLink): ?>
                    <a href="<?php echo e($announcementLink); ?>" class="hover:underline transition-all">
                        <?php echo e($announcementText); ?>

                    </a>
                <?php else: ?>
                    <?php echo e($announcementText); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leftNavLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a
                            href="<?php echo e($link['url']); ?>"
                            class="px-2 xl:px-3 py-2 text-[11px] xl:text-xs font-sans font-medium tracking-[0.08em] uppercase transition-colors whitespace-nowrap <?php echo e(request()->is(trim($link['url'], '/')) || ($link['url'] === '/collections' && request()->is('collections*')) ? 'text-maroon border-b-2 border-maroon' : 'text-charcoal hover:text-maroon'); ?>"
                        >
                            <?php echo e($link['label']); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $rightNavLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a
                            href="<?php echo e($link['url']); ?>"
                            class="px-2 xl:px-3 py-2 text-[11px] xl:text-xs font-sans font-medium tracking-[0.08em] uppercase text-charcoal hover:text-maroon transition-colors whitespace-nowrap <?php echo e(request()->is(trim($link['url'], '/')) ? 'text-maroon border-b-2 border-maroon' : ''); ?>"
                        >
                            <?php echo e($link['label']); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
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
                <?php else: ?>
                    <a
                        href="<?php echo e(route('login')); ?>"
                        class="p-2 text-charcoal hover:text-maroon transition-colors rounded-full"
                        aria-label="Sign in"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Cart Button with live counter -->
                <button
                    type="button"
                    x-data
                    x-on:click="$dispatch('open-cart-drawer')"
                    class="relative p-2 text-charcoal hover:text-maroon transition-colors cursor-pointer rounded-full"
                    aria-label="Open cart (<?php echo e($cartCount); ?> items)"
                >
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 01-8 0" />
                    </svg>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartCount > 0): ?>
                        <span
                            class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-maroon text-ivory text-[10px] font-sans font-semibold flex items-center justify-center animate-scaleIn"
                        >
                            <?php echo e($cartCount > 9 ? '9+' : $cartCount); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </button>
            </div>
        </div>
    </nav>

    <!-- ── Mobile Menu Slide-in Drawer (Interactive & Detailed) ── -->
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
            class="fixed inset-0 bg-charcoal/50 backdrop-blur-xs"
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
            class="relative w-[88vw] max-w-sm sm:max-w-md bg-ivory h-full shadow-2xl flex flex-col justify-between overflow-y-auto"
        >
            <div>
                <!-- Drawer Header -->
                <div class="flex items-center justify-between p-5 border-b border-border bg-sand/20">
                    <a href="/" x-on:click="mobileMenuOpen = false" class="flex items-center">
                        <img src="/images/brand/logo.png" alt="Henley" class="w-28 h-auto" />
                    </a>
                    <button
                        type="button"
                        x-on:click="mobileMenuOpen = false"
                        class="p-2 -mr-1 text-charcoal/60 hover:text-charcoal transition-colors cursor-pointer rounded-full"
                        aria-label="Close menu"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Quick Search Bar Trigger -->
                <div class="px-5 pt-3 pb-2">
                    <button
                        type="button"
                        x-on:click="mobileMenuOpen = false; $dispatch('open-search')"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-full bg-sand/60 border border-border/80 text-charcoal/60 text-xs font-sans hover:border-maroon hover:text-charcoal transition-colors cursor-pointer text-left"
                    >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-charcoal/50 flex-shrink-0">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <span class="truncate">Search rare teas, single-origin spices...</span>
                    </button>
                </div>

                <!-- ── Sub-Sections: Curated Collections & Products ── -->
                <div class="px-5 py-3">
                    <div class="flex items-center justify-between mb-2.5">
                        <p class="text-[10px] font-sans font-semibold uppercase tracking-[0.14em] text-charcoal/50">
                            Curated Collections
                        </p>
                        <a
                            href="/collections"
                            x-on:click="mobileMenuOpen = false"
                            class="text-[10px] font-sans font-semibold uppercase tracking-wider text-maroon hover:underline"
                        >
                            View All →
                        </a>
                    </div>

                    <div class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $menuCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $catImg = $cat->image_path ?: '/pimages/cardamom.jpg';
                                if (!str_starts_with($catImg, '/') && !str_starts_with($catImg, 'http')) {
                                    $catImg = '/' . $catImg;
                                }
                            ?>
                            <div class="border border-border/70 rounded-xl overflow-hidden bg-white/70 transition-all duration-200" :class="{ 'border-maroon/40 bg-white shadow-xs': activeCategorySlug === '<?php echo e($cat->slug); ?>' }">
                                <!-- Category Accordion Toggle -->
                                <button
                                    type="button"
                                    x-on:click="activeCategorySlug = activeCategorySlug === '<?php echo e($cat->slug); ?>' ? null : '<?php echo e($cat->slug); ?>'"
                                    class="w-full flex items-center justify-between p-2.5 text-left cursor-pointer hover:bg-sand/30 transition-colors"
                                >
                                    <div class="flex items-center gap-3 min-w-0">
                                        <img
                                            src="<?php echo e($catImg); ?>"
                                            alt="<?php echo e($cat->name); ?>"
                                            class="w-10 h-10 rounded-lg object-cover border border-border/50 flex-shrink-0"
                                            loading="lazy"
                                        />
                                        <div class="truncate">
                                            <span class="block text-xs font-serif font-semibold text-charcoal tracking-wide truncate">
                                                <?php echo e($cat->name); ?>

                                            </span>
                                            <span class="block text-[10px] font-sans text-charcoal/50">
                                                <?php echo e($cat->products_count); ?> <?php echo e(Str::plural('Harvest', $cat->products_count)); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-charcoal/50 pl-2">
                                        <svg
                                            width="15"
                                            height="15"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="transition-transform duration-200"
                                            :class="{ 'rotate-180 text-maroon': activeCategorySlug === '<?php echo e($cat->slug); ?>' }"
                                        >
                                            <path d="M6 9l6 6 6-6" />
                                        </svg>
                                    </div>
                                </button>

                                <!-- Nested Sub-Section: Top Products in this Category -->
                                <div
                                    x-show="activeCategorySlug === '<?php echo e($cat->slug); ?>'"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="px-2.5 pb-2.5 pt-1 border-t border-border/40 bg-sand/20 space-y-1.5"
                                    style="display: none;"
                                >
                                    <div class="grid grid-cols-1 gap-1.5 pt-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cat->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catProd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                $pImg = $catProd->primary_image ?: '/pimages/tea.jpg';
                                            ?>
                                            <a
                                                href="/collections?cat=<?php echo e($cat->slug); ?>"
                                                x-on:click="mobileMenuOpen = false"
                                                class="flex items-center justify-between p-2 rounded-lg bg-white border border-border/40 hover:border-maroon/40 transition-colors group"
                                            >
                                                <div class="flex items-center gap-2.5 min-w-0">
                                                    <img
                                                        src="<?php echo e($pImg); ?>"
                                                        alt="<?php echo e($catProd->name); ?>"
                                                        class="w-9 h-9 rounded-md object-cover border border-border/40 flex-shrink-0"
                                                        loading="lazy"
                                                    />
                                                    <div class="truncate">
                                                        <span class="block text-[11px] font-sans font-medium text-charcoal group-hover:text-maroon truncate">
                                                            <?php echo e($catProd->name); ?>

                                                        </span>
                                                        <span class="block text-[10px] font-sans text-charcoal/50">
                                                            ₹<?php echo e(number_format((float)$catProd->base_price)); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <span class="text-[10px] font-sans text-maroon font-medium flex-shrink-0 pl-2">
                                                    View →
                                                </span>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <p class="text-[10px] font-sans text-charcoal/40 italic py-1 px-1">Fresh reserve arriving soon.</p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <a
                                        href="/collections?cat=<?php echo e($cat->slug); ?>"
                                        x-on:click="mobileMenuOpen = false"
                                        class="block text-center py-1.5 text-[11px] font-sans font-semibold text-maroon hover:underline tracking-wider uppercase"
                                    >
                                        Explore All <?php echo e($cat->name); ?> (<?php echo e($cat->products_count); ?>) →
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- ── Curator's Top Reserves Showcase with Images ── -->
                <div class="px-5 py-4 border-t border-border/60 bg-sand/25">
                    <div class="flex items-center justify-between mb-2.5">
                        <div>
                            <p class="text-[10px] font-sans font-semibold uppercase tracking-[0.14em] text-gold">
                                Single-Estate Picks
                            </p>
                            <h4 class="font-serif text-sm font-medium text-charcoal">
                                Curator's Top Reserves
                            </h4>
                        </div>
                        <span class="text-[10px] font-sans text-charcoal/40">Swipe →</span>
                    </div>

                    <!-- Horizontal Scrollable Top Products with Images -->
                    <div class="flex gap-2.5 overflow-x-auto pb-2 scrollbar-none snap-x snap-mandatory">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $topMenuProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topProd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $topImg = $topProd->primary_image ?: '/pimages/tea.jpg';
                                $topCat = $topProd->categories->first();
                                $topSlug = $topCat ? $topCat->slug : 'tea';
                            ?>
                            <a
                                href="/collections?cat=<?php echo e($topSlug); ?>"
                                x-on:click="mobileMenuOpen = false"
                                class="flex-shrink-0 w-36 bg-white rounded-xl border border-border/70 p-2 shadow-2xs hover:shadow-xs transition-shadow snap-start flex flex-col justify-between"
                            >
                                <div class="relative aspect-square rounded-lg overflow-hidden bg-sand/40 mb-2">
                                    <img
                                        src="<?php echo e($topImg); ?>"
                                        alt="<?php echo e($topProd->name); ?>"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    />
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($topProd->is_bestseller): ?>
                                        <span class="absolute top-1 left-1 px-1.5 py-0.5 rounded-full text-[8px] font-sans font-semibold uppercase tracking-wider bg-maroon text-ivory">
                                            Bestseller
                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-[9px] font-sans text-charcoal/50 uppercase tracking-wider truncate">
                                        <?php echo e($topCat?->name ?? 'Single Estate'); ?>

                                    </p>
                                    <h5 class="text-xs font-serif font-semibold text-charcoal truncate mt-0.5">
                                        <?php echo e($topProd->name); ?>

                                    </h5>
                                    <div class="flex items-center justify-between mt-1.5">
                                        <span class="text-[11px] font-sans font-semibold text-maroon">
                                            ₹<?php echo e(number_format((float)$topProd->base_price)); ?>

                                        </span>
                                        <span class="text-[10px] text-gold font-sans">
                                            ★ 5.0
                                        </span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- ── House of Henley Sub-Section ── -->
                <div class="px-5 py-4 border-t border-border/60 space-y-2">
                    <p class="text-[10px] font-sans font-semibold uppercase tracking-[0.14em] text-charcoal/50">
                        The House of Henley
                    </p>
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <a
                            href="/story"
                            x-on:click="mobileMenuOpen = false"
                            class="flex items-center gap-2 p-2 rounded-lg bg-white border border-border/50 text-xs font-sans text-charcoal hover:border-maroon hover:text-maroon transition-colors"
                        >
                            <span class="text-sm">🏔️</span>
                            <span class="font-medium text-[11px]">Terroir Story</span>
                        </a>
                        <a
                            href="/journal"
                            x-on:click="mobileMenuOpen = false"
                            class="flex items-center gap-2 p-2 rounded-lg bg-white border border-border/50 text-xs font-sans text-charcoal hover:border-maroon hover:text-maroon transition-colors"
                        >
                            <span class="text-sm">📖</span>
                            <span class="font-medium text-[11px]">Journal</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Drawer Footer -->
            <div class="p-5 border-t border-border bg-sand/40 space-y-3">
                <div class="flex items-center justify-between text-[11px] font-sans">
                    <span class="text-charcoal/60">Concierge Desk:</span>
                    <a href="tel:+91800436539" class="font-medium text-maroon hover:underline">
                        +91 800 436 539
                    </a>
                </div>
                <p class="text-[10px] font-sans text-charcoal/50 text-center">
                    Complimentary shipping on orders above ₹1,999
                </p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center justify-between pt-2 border-t border-border/50">
                        <a href="/account" class="text-xs font-sans font-semibold uppercase tracking-wider text-maroon">
                            My Account →
                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-xs font-sans text-charcoal/60 hover:text-error cursor-pointer">
                                Sign Out
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <a
                        href="<?php echo e(route('login')); ?>"
                        class="block w-full py-2.5 text-center text-xs font-sans font-semibold uppercase tracking-wider bg-maroon text-ivory rounded-lg hover:bg-maroon/90 transition-colors shadow-xs"
                    >
                        Sign In / Create Account
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ── Mobile Bottom Navigation Bar ───────────────────── -->
    <aside
        class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-ivory/95 backdrop-blur-md border-t border-border/80 shadow-[0_-4px_20px_rgba(34,26,23,0.06)] pb-[max(0.35rem,env(safe-area-inset-bottom))]"
        aria-label="Mobile bottom navigation"
    >
        <div class="grid grid-cols-4 items-center justify-items-center h-14 px-2">
            <!-- 1. Home -->
            <?php
                $isHomeActive = request()->is('/');
            ?>
            <a
                href="/"
                class="flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative <?php echo e($isHomeActive ? 'text-maroon' : 'text-charcoal/60 hover:text-maroon'); ?>"
                aria-label="Home"
            >
                <div class="relative flex items-center justify-center">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="<?php echo e($isHomeActive ? '2.2' : '1.8'); ?>" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </div>
                <span class="text-[10px] font-sans <?php echo e($isHomeActive ? 'font-semibold' : 'font-normal'); ?> tracking-wide mt-0.5">
                    Home
                </span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isHomeActive): ?>
                    <span class="absolute bottom-1 w-1 h-1 rounded-full bg-gold"></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>

            <!-- 2. Collection -->
            <?php
                $isCollectionsActive = request()->is('collections*') || request()->is('shop*');
            ?>
            <a
                href="/collections"
                class="flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative <?php echo e($isCollectionsActive ? 'text-maroon' : 'text-charcoal/60 hover:text-maroon'); ?>"
                aria-label="Collection"
            >
                <div class="relative flex items-center justify-center">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="<?php echo e($isCollectionsActive ? '2.2' : '1.8'); ?>" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="1.5" />
                        <rect x="14" y="3" width="7" height="7" rx="1.5" />
                        <rect x="14" y="14" width="7" height="7" rx="1.5" />
                        <rect x="3" y="14" width="7" height="7" rx="1.5" />
                    </svg>
                </div>
                <span class="text-[10px] font-sans <?php echo e($isCollectionsActive ? 'font-semibold' : 'font-normal'); ?> tracking-wide mt-0.5">
                    Collection
                </span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCollectionsActive): ?>
                    <span class="absolute bottom-1 w-1 h-1 rounded-full bg-gold"></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>

            <!-- 3. Cart -->
            <button
                type="button"
                x-on:click="$dispatch('open-cart-drawer')"
                class="flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative text-charcoal/60 hover:text-maroon cursor-pointer"
                aria-label="Cart (<?php echo e($cartCount); ?> items)"
            >
                <div class="relative flex items-center justify-center">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 01-8 0" />
                    </svg>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartCount > 0): ?>
                        <span class="absolute -top-1 -right-2 min-w-[15px] h-[15px] px-0.5 rounded-full bg-maroon text-ivory text-[9px] font-sans font-bold flex items-center justify-center leading-none">
                            <?php echo e($cartCount > 9 ? '9+' : $cartCount); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <span class="text-[10px] font-sans font-normal tracking-wide mt-0.5">
                    Cart
                </span>
            </button>

            <!-- 4. Account -->
            <?php
                $isAccountActive = request()->is('account*') || request()->is('login*') || request()->is('register*');
                $accountUrl = auth()->check() ? '/account' : route('login');
            ?>
            <a
                href="<?php echo e($accountUrl); ?>"
                class="flex flex-col items-center justify-center w-full h-full text-center transition-colors group relative <?php echo e($isAccountActive ? 'text-maroon' : 'text-charcoal/60 hover:text-maroon'); ?>"
                aria-label="Account"
            >
                <div class="relative flex items-center justify-center">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="<?php echo e($isAccountActive ? '2.2' : '1.8'); ?>" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </div>
                <span class="text-[10px] font-sans <?php echo e($isAccountActive ? 'font-semibold' : 'font-normal'); ?> tracking-wide mt-0.5">
                    Account
                </span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAccountActive): ?>
                    <span class="absolute bottom-1 w-1 h-1 rounded-full bg-gold"></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>
        </div>
    </aside>

    <!-- ── Slide-Out Cart Drawer ─────────────────────────── -->
    <div
        x-show="cartDrawerOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-hidden"
        style="display: none;"
    >
        <!-- Backdrop -->
        <div
            class="fixed inset-0 bg-charcoal/50 backdrop-blur-xs transition-opacity"
            x-on:click="cartDrawerOpen = false"
        ></div>

        <!-- Drawer Panel -->
        <div
            x-show="cartDrawerOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 max-w-full flex pl-10"
        >
            <div class="w-screen max-w-md bg-ivory shadow-2xl flex flex-col justify-between">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-border bg-sand/20">
                    <div>
                        <h2 class="font-serif text-xl text-charcoal">Your Ritual</h2>
                        <p class="text-[11px] font-sans text-charcoal/50">
                            <?php echo e($cartCount); ?> <?php echo e(Str::plural('botanical', $cartCount)); ?> selected
                        </p>
                    </div>
                    <button
                        type="button"
                        x-on:click="cartDrawerOpen = false"
                        class="p-2 -mr-1 text-charcoal/60 hover:text-charcoal transition-colors cursor-pointer rounded-full"
                        aria-label="Close cart"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Shipping Progress -->
                <div class="px-6 py-3 bg-sand/40 border-b border-border/60">
                    <p class="text-xs font-sans text-charcoal/70 text-center">
                        Complimentary Himalayan shipping on orders over <span class="font-semibold text-maroon">₹1,999</span>
                    </p>
                </div>

                <!-- Body -->
                <div class="flex-1 overflow-y-auto px-6 py-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartCount === 0): ?>
                        <div class="h-full flex flex-col items-center justify-center text-center py-12">
                            <div class="w-16 h-16 rounded-full bg-sand/60 border border-border flex items-center justify-center text-maroon mb-4">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                                    <line x1="3" y1="6" x2="21" y2="6" />
                                    <path d="M16 10a4 4 0 01-8 0" />
                                </svg>
                            </div>
                            <h3 class="font-serif text-xl text-charcoal mb-2">Your Bag is Empty</h3>
                            <p class="text-xs text-charcoal/60 max-w-xs mb-6">
                                Explore our collection of rare Himalayan teas, biodynamic spices, and stoneground flours.
                            </p>
                            <a
                                href="/collections"
                                x-on:click="cartDrawerOpen = false"
                                class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-maroon text-ivory text-xs font-sans font-semibold uppercase tracking-wider hover:bg-maroon/90 transition-all shadow-xs"
                            >
                                Discover Collections →
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <p class="text-xs text-charcoal/60">Your cart items are saved.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Footer -->
                <div class="p-6 border-t border-border bg-white/60 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="font-sans text-charcoal/70">Subtotal</span>
                        <span class="font-serif font-semibold text-charcoal">₹<?php echo e($cartCount > 0 ? '1,299' : '0'); ?></span>
                    </div>
                    <a
                        href="/collections"
                        x-on:click="cartDrawerOpen = false"
                        class="block w-full py-3 text-center text-xs font-sans font-semibold uppercase tracking-wider bg-maroon text-ivory rounded-lg hover:bg-maroon/90 transition-colors shadow-xs"
                    >
                        <?php echo e($cartCount > 0 ? 'Proceed to Checkout' : 'Start Shopping'); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Search Overlay Component Instance -->
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('storefront.search-overlay', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-697493440-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/storefront/header.blade.php ENDPATH**/ ?>