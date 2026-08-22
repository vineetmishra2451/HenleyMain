<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'transparentOverHero' => false,
    'announcementText' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'announcementLink' => '/collections/single-origin-reserve',
    'navItems' => [],
    'featuredCollections' => [],
    'cartCount' => 0,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'transparentOverHero' => false,
    'announcementText' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'announcementLink' => '/collections/single-origin-reserve',
    'navItems' => [],
    'featuredCollections' => [],
    'cartCount' => 0,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$defaultNav = [
    ['label' => 'Shop', 'url' => '/shop', 'mega' => false],
    ['label' => 'Collections', 'url' => '/collections', 'mega' => true],
    ['label' => 'Herbal & Spices', 'url' => '/collections/herbal-botanicals', 'mega' => false],
    ['label' => 'Gifts', 'url' => '/collections/curated-gift-sets', 'mega' => false],
    ['label' => 'Our Story', 'url' => '/pages/the-cloche-ritual', 'mega' => false],
    ['label' => 'Journal', 'url' => '/journal', 'mega' => false],
];

$items = !empty($navItems) ? $navItems : $defaultNav;
?>

<div
    x-data="{
        scrolled: false,
        megaOpen: false,
        cartCount: <?php echo e((int) $cartCount); ?>,
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
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($announcementText): ?>
        <?php if (isset($component)) { $__componentOriginal12e6dfc5ff3af4426af0f77dc4eda8d4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12e6dfc5ff3af4426af0f77dc4eda8d4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.announcement-bar','data' => ['text' => $announcementText,'link' => $announcementLink]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.announcement-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($announcementText),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($announcementLink)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12e6dfc5ff3af4426af0f77dc4eda8d4)): ?>
<?php $attributes = $__attributesOriginal12e6dfc5ff3af4426af0f77dc4eda8d4; ?>
<?php unset($__attributesOriginal12e6dfc5ff3af4426af0f77dc4eda8d4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12e6dfc5ff3af4426af0f77dc4eda8d4)): ?>
<?php $component = $__componentOriginal12e6dfc5ff3af4426af0f77dc4eda8d4; ?>
<?php unset($__componentOriginal12e6dfc5ff3af4426af0f77dc4eda8d4); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Main Navigation Bar -->
    <header
        :class="{
            'bg-canvas/95 backdrop-blur-md border-b border-hairline shadow-subtle py-3.5': scrolled || !<?php echo e($transparentOverHero ? 'true' : 'false'); ?>,
            'bg-canvas/40 backdrop-blur-sm border-b border-hairline/40 py-5': !scrolled && <?php echo e($transparentOverHero ? 'true' : 'false'); ?>

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
                    <?php if (isset($component)) { $__componentOriginal0f76eee19490ce4ef90a90abe538c05c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f76eee19490ce4ef90a90abe538c05c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.menu','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f76eee19490ce4ef90a90abe538c05c)): ?>
<?php $attributes = $__attributesOriginal0f76eee19490ce4ef90a90abe538c05c; ?>
<?php unset($__attributesOriginal0f76eee19490ce4ef90a90abe538c05c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f76eee19490ce4ef90a90abe538c05c)): ?>
<?php $component = $__componentOriginal0f76eee19490ce4ef90a90abe538c05c; ?>
<?php unset($__componentOriginal0f76eee19490ce4ef90a90abe538c05c); ?>
<?php endif; ?>
                </button>

                <a href="/" class="focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent rounded-sm">
                    <?php if (isset($component)) { $__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.brand.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('brand.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b)): ?>
<?php $attributes = $__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b; ?>
<?php unset($__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b)): ?>
<?php $component = $__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b; ?>
<?php unset($__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b); ?>
<?php endif; ?>
                </a>
            </div>

            <!-- Center: Primary Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center space-x-8" aria-label="Primary Navigation">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($item['mega'])): ?>
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
                                <span><?php echo e($item['label']); ?></span>
                                <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => ['class' => 'w-3.5 h-3.5 transition-transform duration-200',':class' => '{ \'rotate-180 text-accent\': megaOpen }']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5 transition-transform duration-200',':class' => '{ \'rotate-180 text-accent\': megaOpen }']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $attributes = $__attributesOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $component = $__componentOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__componentOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
                            </button>
                        </div>
                    <?php else: ?>
                        <a
                            href="<?php echo e($item['url']); ?>"
                            class="font-sans text-xs uppercase tracking-[0.16em] font-medium text-primary hover:text-accent py-2 transition-colors duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                        >
                            <?php echo e($item['label']); ?>

                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                    <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'w-4 h-4 sm:w-5 sm:h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 sm:w-5 sm:h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $attributes = $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $component = $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
                </button>

                <!-- Account / Sanctum Link -->
                <a
                    href="<?php echo e(auth()->check() ? (auth()->user()->hasRole('super_admin|admin') ? url('/admin') : url('/account')) : route('login')); ?>"
                    aria-label="<?php echo e(auth()->check() ? 'My Account' : 'Sign in'); ?>"
                    class="p-2 text-primary hover:text-accent rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                >
                    <?php if (isset($component)) { $__componentOriginalb8c2af2c7c4a456e77f6ae42c74e5e35 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8c2af2c7c4a456e77f6ae42c74e5e35 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.user','data' => ['class' => 'w-4 h-4 sm:w-5 sm:h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 sm:w-5 sm:h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb8c2af2c7c4a456e77f6ae42c74e5e35)): ?>
<?php $attributes = $__attributesOriginalb8c2af2c7c4a456e77f6ae42c74e5e35; ?>
<?php unset($__attributesOriginalb8c2af2c7c4a456e77f6ae42c74e5e35); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb8c2af2c7c4a456e77f6ae42c74e5e35)): ?>
<?php $component = $__componentOriginalb8c2af2c7c4a456e77f6ae42c74e5e35; ?>
<?php unset($__componentOriginalb8c2af2c7c4a456e77f6ae42c74e5e35); ?>
<?php endif; ?>
                </a>

                <!-- Cart Button (Opens Cart Drawer or links to cart) -->
                <a
                    href="<?php echo e(url('/cart')); ?>"
                    x-on:click.prevent="$dispatch('open-drawer', 'cart-drawer')"
                    aria-label="View ritual basket"
                    class="relative p-2 text-primary hover:text-accent rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent group cursor-pointer"
                >
                    <?php if (isset($component)) { $__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.bag','data' => ['class' => 'w-4 h-4 sm:w-5 sm:h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.bag'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 sm:w-5 sm:h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1)): ?>
<?php $attributes = $__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1; ?>
<?php unset($__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1)): ?>
<?php $component = $__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1; ?>
<?php unset($__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1); ?>
<?php endif; ?>
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
        <?php if (isset($component)) { $__componentOriginal7b1849113c6b26b8fd795ca39308d4f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7b1849113c6b26b8fd795ca39308d4f3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.mega-menu','data' => ['collections' => $featuredCollections]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.mega-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['collections' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredCollections)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7b1849113c6b26b8fd795ca39308d4f3)): ?>
<?php $attributes = $__attributesOriginal7b1849113c6b26b8fd795ca39308d4f3; ?>
<?php unset($__attributesOriginal7b1849113c6b26b8fd795ca39308d4f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7b1849113c6b26b8fd795ca39308d4f3)): ?>
<?php $component = $__componentOriginal7b1849113c6b26b8fd795ca39308d4f3; ?>
<?php unset($__componentOriginal7b1849113c6b26b8fd795ca39308d4f3); ?>
<?php endif; ?>
    </header>

    <!-- Mobile Slide-Over Navigation Drawer -->
    <?php if (isset($component)) { $__componentOriginal22b75b1e549fc61d36e981a77c741296 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22b75b1e549fc61d36e981a77c741296 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.mobile-nav','data' => ['navItems' => $items]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.mobile-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nav-items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($items)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22b75b1e549fc61d36e981a77c741296)): ?>
<?php $attributes = $__attributesOriginal22b75b1e549fc61d36e981a77c741296; ?>
<?php unset($__attributesOriginal22b75b1e549fc61d36e981a77c741296); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22b75b1e549fc61d36e981a77c741296)): ?>
<?php $component = $__componentOriginal22b75b1e549fc61d36e981a77c741296; ?>
<?php unset($__componentOriginal22b75b1e549fc61d36e981a77c741296); ?>
<?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/storefront/header.blade.php ENDPATH**/ ?>