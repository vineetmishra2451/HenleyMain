<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'payload' => [],
    'products' => null,
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
    'payload' => [],
    'products' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$eyebrow = $payload['eyebrow'] ?? 'Most Loved';
$title = $payload['title'] ?? 'Best Sellers';
$limit = (int) ($payload['limit'] ?? 4);

$items = $products ?? \App\Models\Product::active()
    ->bestseller()
    ->with(['images', 'categories'])
    ->take($limit)
    ->get();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($items->isNotEmpty()): ?>
    <section class="py-16 lg:py-24">
        <div class="henley-container">
            <!-- Section heading -->
            <div class="flex items-end justify-between mb-10 lg:mb-14">
                <div>
                    <p class="text-eyebrow text-gold mb-2"><?php echo e($eyebrow); ?></p>
                    <h2 class="font-serif text-2xl lg:text-3xl text-charcoal">
                        <?php echo e($title); ?>

                    </h2>
                </div>
                <a href="/shop?sort=bestselling" class="hidden lg:inline-flex items-center gap-1 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
                    View All →
                </a>
            </div>

            <!-- Product grid: 2 per row on mobile, 4 per row on desktop -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal97cd36444825b8000ec8a09fb9ff392f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.product-card','data' => ['title' => $product->name,'subtitle' => $product->short_description ?? ($product->primary_category?->name ?? 'Single Estate'),'category' => $product->primary_category?->name ?? ($product->categories->first()?->name ?? 'Specialty'),'price' => $product->getPriceMoney()->formatted(),'compareAtPrice' => $product->compare_at_price_money?->formatted(),'image' => $product->primary_image ?? ($product->images->first()?->url ?? '/pimages/saffron.jpg'),'rating' => (float) ($product->rating_average > 0 ? $product->rating_average : 5.0),'ratingCount' => (int) ($product->rating_count > 0 ? $product->rating_count : 142 + ($index * 30)),'badge' => 'bestseller','badgeVariant' => 'gold','href' => '/product/' . $product->slug,'imageAspect' => 'aspect-square']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->name),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->short_description ?? ($product->primary_category?->name ?? 'Single Estate')),'category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->primary_category?->name ?? ($product->categories->first()?->name ?? 'Specialty')),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->getPriceMoney()->formatted()),'compare-at-price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->compare_at_price_money?->formatted()),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->primary_image ?? ($product->images->first()?->url ?? '/pimages/saffron.jpg')),'rating' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((float) ($product->rating_average > 0 ? $product->rating_average : 5.0)),'rating-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((int) ($product->rating_count > 0 ? $product->rating_count : 142 + ($index * 30))),'badge' => 'bestseller','badge-variant' => 'gold','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('/product/' . $product->slug),'image-aspect' => 'aspect-square']); ?>
                         <?php $__env->slot('action', null, []); ?> 
                            <button
                                type="button"
                                x-data
                                x-on:click.prevent="$dispatch('notify', { message: '<?php echo e(addslashes($product->name)); ?> added to bag.', tone: 'success' }); $dispatch('cart-updated', { count: 1 })"
                                class="w-full inline-flex items-center justify-center rounded-md font-sans text-ivory bg-maroon hover:bg-maroon-dark transition-colors cursor-pointer shadow-subtle !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center"
                            >
                                + Bag
                            </button>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $attributes = $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $component = $__componentOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Mobile "View All" link -->
            <div class="lg:hidden text-center mt-8">
                <a href="/shop?sort=bestselling" class="text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors">
                    View All Best Sellers →
                </a>
            </div>
        </div>
    </section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/bestsellers.blade.php ENDPATH**/ ?>