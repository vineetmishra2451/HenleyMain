<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'description' => 'Pure leaf. Pure intent. Henley approaches single-estate tea, rare botanicals, and whole spices with the precision and quiet luxury of a fine fragrance house.',
    'image' => '/images/brand/homepage.jpeg',
    'transparentHeader' => false,
    'announcementText' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'announcementLink' => '/collections/single-origin-reserve',
    'navItems' => [],
    'featuredCollections' => [],
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
    'title' => null,
    'description' => 'Pure leaf. Pure intent. Henley approaches single-estate tea, rare botanicals, and whole spices with the precision and quiet luxury of a fine fragrance house.',
    'image' => '/images/brand/homepage.jpeg',
    'transparentHeader' => false,
    'announcementText' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'announcementLink' => '/collections/single-origin-reserve',
    'navItems' => [],
    'featuredCollections' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$pageTitle = $title ? "{$title} — Henley" : "Henley — Pure Leaf. Pure Intent. Single-Origin Botanicals";
$canonicalUrl = url()->current();
$appUrl = config('app.url', 'https://henleytea.com');

$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => "{$appUrl}/#organization",
            'name' => 'Henley Botanicals Private Limited',
            'url' => $appUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('/images/brand/logo.png'),
                'caption' => 'Henley',
            ],
            'sameAs' => [
                'https://instagram.com/henleybotanicals',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+91-800-436539',
                'contactType' => 'Customer Concierge',
                'areaServed' => 'IN',
                'availableLanguage' => 'en',
            ],
        ],
        [
            '@type' => 'WebSite',
            '@id' => "{$appUrl}/#website",
            'url' => $appUrl,
            'name' => 'Henley',
            'description' => $description,
            'publisher' => [
                '@id' => "{$appUrl}/#organization",
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => "{$appUrl}/shop?q={search_term_string}",
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ],
    ],
];
?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-canvas scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($pageTitle); ?></title>
    <meta name="description" content="<?php echo e($description); ?>">
    <link rel="canonical" href="<?php echo e($canonicalUrl); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e($canonicalUrl); ?>">
    <meta property="og:title" content="<?php echo e($pageTitle); ?>">
    <meta property="og:description" content="<?php echo e($description); ?>">
    <meta property="og:image" content="<?php echo e(asset($image)); ?>">
    <meta property="og:site_name" content="Henley">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo e($canonicalUrl); ?>">
    <meta name="twitter:title" content="<?php echo e($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo e($description); ?>">
    <meta name="twitter:image" content="<?php echo e(asset($image)); ?>">

    <!-- Self-Hosted Font Preload Hints (Zero Layout Shift) -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Preload Hero Image on Homepage -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transparentHeader): ?>
        <link rel="preload" href="/images/brand/homepage.jpeg" as="image">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- JSON-LD Structured Data: Organization & WebSite with SearchAction -->
    <script type="application/ld+json">
    <?php echo json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

    </script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="min-h-full bg-canvas text-primary font-sans antialiased flex flex-col justify-between selection:bg-accent selection:text-inverse">
    <!-- Livewire SPA Loading Bar Indicator -->
    <div wire:loading.class="w-full opacity-100" class="fixed top-0 left-0 h-0.5 bg-accent z-[9999] transition-all duration-300 w-0 opacity-0 pointer-events-none"></div>

    <!-- Storefront Header -->
    <?php if (isset($component)) { $__componentOriginalb15549b9e3e907d829cb3c6b71121852 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb15549b9e3e907d829cb3c6b71121852 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.header','data' => ['transparentOverHero' => $transparentHeader,'announcementText' => $announcementText,'announcementLink' => $announcementLink,'navItems' => $navItems,'featuredCollections' => $featuredCollections]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['transparent-over-hero' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($transparentHeader),'announcement-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($announcementText),'announcement-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($announcementLink),'nav-items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navItems),'featured-collections' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredCollections)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb15549b9e3e907d829cb3c6b71121852)): ?>
<?php $attributes = $__attributesOriginalb15549b9e3e907d829cb3c6b71121852; ?>
<?php unset($__attributesOriginalb15549b9e3e907d829cb3c6b71121852); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb15549b9e3e907d829cb3c6b71121852)): ?>
<?php $component = $__componentOriginalb15549b9e3e907d829cb3c6b71121852; ?>
<?php unset($__componentOriginalb15549b9e3e907d829cb3c6b71121852); ?>
<?php endif; ?>

    <!-- Main Page Content -->
    <main id="main-content" class="flex-1 w-full">
        <?php echo e($slot); ?>

    </main>

    <!-- Storefront Footer -->
    <?php if (isset($component)) { $__componentOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab)): ?>
<?php $attributes = $__attributesOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab; ?>
<?php unset($__attributesOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab)): ?>
<?php $component = $__componentOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab; ?>
<?php unset($__componentOriginal57bf4c7ea88c5e87d82fdfc5d85bdcab); ?>
<?php endif; ?>

    <!-- Live Search Overlay Component -->
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('storefront.search-overlay', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2135149476-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

    <!-- Cart Slide-Over Drawer Placeholder -->
    <?php if (isset($component)) { $__componentOriginale67024a204ba6be83f3556a31cc49b4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67024a204ba6be83f3556a31cc49b4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.drawer','data' => ['name' => 'cart-drawer','title' => 'Your Ritual Basket','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('drawer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'cart-drawer','title' => 'Your Ritual Basket','max-width' => 'md']); ?>
        <div class="space-y-6">
            <?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'Your basket is empty','description' => 'Explore our single-origin flushes and rare botanicals to start your ritual.','icon' => 'bag']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Your basket is empty','description' => 'Explore our single-origin flushes and rare botanicals to start your ritual.','icon' => 'bag']); ?>
                <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => '/shop','variant' => 'primary','size' => 'md','trailingArrow' => true,'xOn:click' => '$dispatch(\'close-drawer\', \'cart-drawer\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '/shop','variant' => 'primary','size' => 'md','trailing-arrow' => true,'x-on:click' => '$dispatch(\'close-drawer\', \'cart-drawer\')']); ?>
                    Explore the Catalog
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $attributes = $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $component = $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67024a204ba6be83f3556a31cc49b4d)): ?>
<?php $attributes = $__attributesOriginale67024a204ba6be83f3556a31cc49b4d; ?>
<?php unset($__attributesOriginale67024a204ba6be83f3556a31cc49b4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67024a204ba6be83f3556a31cc49b4d)): ?>
<?php $component = $__componentOriginale67024a204ba6be83f3556a31cc49b4d; ?>
<?php unset($__componentOriginale67024a204ba6be83f3556a31cc49b4d); ?>
<?php endif; ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/components/layouts/storefront.blade.php ENDPATH**/ ?>