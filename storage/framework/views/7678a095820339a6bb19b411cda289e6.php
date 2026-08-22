<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'products' => [],
    'payload' => [],
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
    'products' => [],
    'payload' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$title = $payload['title'] ?? 'The Bestsellers';
$eyebrow = $payload['eyebrow'] ?? 'Most Coveted Rituals';
$description = $payload['description'] ?? 'Our definitive single-estate lots and aromatic staples celebrated by tea masters and collectors.';
?>

<section class="w-full bg-surface-raised py-20 sm:py-24 border-y border-hairline">
    <?php if (isset($component)) { $__componentOriginala766c2d312d6f7864fe218e2500d2bba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala766c2d312d6f7864fe218e2500d2bba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.container','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('container'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => $eyebrow,'title' => $title,'description' => $description,'align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($eyebrow),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($description),'align' => 'center']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($products) && count($products) > 0): ?>
            <!-- Mobile Horizontal Snap-Scroller & Desktop Grid (Zero Carousel Dependency) -->
            <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-6 overflow-x-auto sm:overflow-visible pb-4 sm:pb-0 snap-x snap-mandatory -mx-5 px-5 sm:mx-0 sm:px-0">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="min-w-[280px] sm:min-w-0 snap-center flex-shrink-0 sm:flex-shrink">
                        <?php if (isset($component)) { $__componentOriginal97cd36444825b8000ec8a09fb9ff392f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.product-card','data' => ['title' => $product->name,'subtitle' => $product->subtitle ?? ($product->vendor->business_name ?? 'Castleton Estate'),'price' => $product->base_price,'compareAtPrice' => $product->compare_at_price,'rating' => 5.0,'ratingCount' => rand(28, 96),'badge' => 'No. ' . ($index + 1) . ' Bestseller','badgeVariant' => 'gold','href' => '/shop']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->name),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->subtitle ?? ($product->vendor->business_name ?? 'Castleton Estate')),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->base_price),'compare-at-price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->compare_at_price),'rating' => 5.0,'rating-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(rand(28, 96)),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('No. ' . ($index + 1) . ' Bestseller'),'badge-variant' => 'gold','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('/shop')]); ?>
                             <?php $__env->slot('action', null, []); ?> 
                                <button
                                    type="button"
                                    x-data
                                    x-on:click="$dispatch('cart-updated', { count: 1 }); $dispatch('open-drawer', 'cart-drawer')"
                                    aria-label="Add <?php echo e($product->name); ?> to ritual basket"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-accent text-inverse hover:bg-accent-hover transition duration-200"
                                >
                                    <?php if (isset($component)) { $__componentOriginal52632fe7b137108a4c1d9fb6383ade19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal52632fe7b137108a4c1d9fb6383ade19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.plus','data' => ['class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal52632fe7b137108a4c1d9fb6383ade19)): ?>
<?php $attributes = $__attributesOriginal52632fe7b137108a4c1d9fb6383ade19; ?>
<?php unset($__attributesOriginal52632fe7b137108a4c1d9fb6383ade19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal52632fe7b137108a4c1d9fb6383ade19)): ?>
<?php $component = $__componentOriginal52632fe7b137108a4c1d9fb6383ade19; ?>
<?php unset($__componentOriginal52632fe7b137108a4c1d9fb6383ade19); ?>
<?php endif; ?>
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
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Graceful Empty State -->
            <?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'Bestseller archive refreshing','description' => 'Our seasonal curation will be updated after the current harvest cycle.','icon' => 'package']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Bestseller archive refreshing','description' => 'Our seasonal curation will be updated after the current harvest cycle.','icon' => 'package']); ?>
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
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala766c2d312d6f7864fe218e2500d2bba)): ?>
<?php $attributes = $__attributesOriginala766c2d312d6f7864fe218e2500d2bba; ?>
<?php unset($__attributesOriginala766c2d312d6f7864fe218e2500d2bba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala766c2d312d6f7864fe218e2500d2bba)): ?>
<?php $component = $__componentOriginala766c2d312d6f7864fe218e2500d2bba; ?>
<?php unset($__componentOriginala766c2d312d6f7864fe218e2500d2bba); ?>
<?php endif; ?>
</section>
<?php /**PATH /var/www/html/resources/views/components/sections/best-sellers.blade.php ENDPATH**/ ?>