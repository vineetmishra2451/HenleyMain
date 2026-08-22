<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'image' => null,
    'transparentHero' => false,
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
    'description' => null,
    'canonical' => null,
    'image' => null,
    'transparentHero' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$metaTitle = $title ? "{$title} — Henley" : "Henley — Pure leaf. Pure intent. Single-Origin Botanicals";
$metaDescription = $description ?? "Rare single-estate Himalayan teas, biodynamic botanicals, and handpicked spices preserved in bone-white porcelain cloche jars.";
$metaCanonical = $canonical ?? url()->current();
$metaImage = $image ?? asset('images/brand/homepage.jpeg');

$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => url('/') . '/#organization',
            'name' => 'Henley',
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/brand/logo.png'),
            ],
            'sameAs' => [
                'https://instagram.com/henleybotanicals',
                'https://twitter.com/henleytea',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+91-800-436539',
                'contactType' => 'customer concierge',
                'areaServed' => 'IN',
                'availableLanguage' => 'en',
            ],
        ],
        [
            '@type' => 'WebSite',
            '@id' => url('/') . '/#website',
            'url' => url('/'),
            'name' => 'Henley Botanical Reserve',
            'publisher' => [
                '@id' => url('/') . '/#organization',
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => url('/collections') . '?q={search_term_string}',
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

    <!-- SEO Meta Tags -->
    <title><?php echo e($metaTitle); ?></title>
    <meta name="description" content="<?php echo e($metaDescription); ?>">
    <link rel="canonical" href="<?php echo e($metaCanonical); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e($metaCanonical); ?>">
    <meta property="og:title" content="<?php echo e($metaTitle); ?>">
    <meta property="og:description" content="<?php echo e($metaDescription); ?>">
    <meta property="og:image" content="<?php echo e($metaImage); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($metaTitle); ?>">
    <meta name="twitter:description" content="<?php echo e($metaDescription); ?>">
    <meta name="twitter:image" content="<?php echo e($metaImage); ?>">

    <!-- Self-hosted font preloads for zero Cumulative Layout Shift (CLS) -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    <?php echo json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

    </script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="min-h-full bg-canvas text-primary font-sans antialiased selection:bg-accent selection:text-inverse flex flex-col justify-between">
    <!-- Livewire SPA Loading Bar Indicator -->
    <div wire:loading.class="w-full opacity-100" class="fixed top-0 left-0 h-0.5 bg-accent z-[9999] transition-all duration-300 w-0 opacity-0 pointer-events-none"></div>

    <!-- Global Toast Notifications Listener -->
    <div
        x-data="{
            toasts: [],
            add(e) {
                let id = Date.now();
                this.toasts.push({ id: id, message: e.detail.message || e.detail[0]?.message, tone: e.detail.tone || 'success' });
                setTimeout(() => this.toasts = this.toasts.filter(t => t.id !== id), 4000);
            }
        }"
        x-on:notify.window="add($event)"
        class="fixed bottom-6 right-6 z-50 space-y-2 pointer-events-none"
    >
        <template x-for="t in toasts" :key="t.id">
            <div class="pointer-events-auto flex items-center gap-3 rounded-full border border-hairline bg-surface-card px-5 py-3 shadow-card-hover animate-fadeIn">
                <span x-show="t.tone === 'success'" class="flex h-5 w-5 items-center justify-center rounded-full bg-sage-surface text-sage-text">✓</span>
                <span x-show="t.tone === 'error'" class="flex h-5 w-5 items-center justify-center rounded-full bg-error-surface text-error">✕</span>
                <span class="font-sans text-ui font-medium text-primary" x-text="t.message"></span>
            </div>
        </template>
    </div>

    <!-- Storefront Header -->
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('storefront.header', ['transparentHero' => $transparentHero]);

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

    <!-- Main Content Slot -->
    <main class="flex-1 w-full">
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

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/components/layouts/storefront.blade.php ENDPATH**/ ?>