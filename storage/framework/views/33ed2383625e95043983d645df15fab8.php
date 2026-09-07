<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class']));

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

foreach (array_filter((['class']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => $class]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($class)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f)): ?>
<?php $attributes = $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f; ?>
<?php unset($__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f)): ?>
<?php $component = $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f; ?>
<?php unset($__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f); ?>
<?php endif; ?><?php /**PATH /var/www/html/storage/framework/views/2f96dfc09bfb0e62345ad3e69fb34f00.blade.php ENDPATH**/ ?>