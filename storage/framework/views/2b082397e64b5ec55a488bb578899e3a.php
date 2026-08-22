<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
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
$items = $payload['items'] ?? [
    ['icon' => 'leaf', 'label' => 'Single-Estate Origin', 'caption' => 'Traceable directly to prime mountain slopes'],
    ['icon' => 'package', 'label' => 'Apothecary Sealed', 'caption' => 'Flushed with nitrogen in porcelain tins'],
    ['icon' => 'truck', 'label' => 'Complimentary Delivery', 'caption' => 'Express air courier on orders over ₹1,500'],
    ['icon' => 'shield-check', 'label' => '100% Biodynamic Purity', 'caption' => 'Zero synthetic pesticides or artificial aromas'],
];
?>

<section class="w-full bg-canvas py-4">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12">
        <?php if (isset($component)) { $__componentOriginalc8fe47964b6860ca74311e76ddf4ded8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.trust-badge-strip','data' => ['items' => $items,'class' => 'my-6 shadow-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.trust-badge-strip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($items),'class' => 'my-6 shadow-none']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8)): ?>
<?php $attributes = $__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8; ?>
<?php unset($__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8fe47964b6860ca74311e76ddf4ded8)): ?>
<?php $component = $__componentOriginalc8fe47964b6860ca74311e76ddf4ded8; ?>
<?php unset($__componentOriginalc8fe47964b6860ca74311e76ddf4ded8); ?>
<?php endif; ?>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/trust-strip.blade.php ENDPATH**/ ?>