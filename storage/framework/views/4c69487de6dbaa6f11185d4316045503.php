<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'text', // text | card | circle | rect
    'width' => 'w-full',
    'height' => 'h-4',
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
    'variant' => 'text', // text | card | circle | rect
    'width' => 'w-full',
    'height' => 'h-4',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$variantClasses = match ($variant) {
    'circle' => 'rounded-full h-12 w-12',
    'card' => 'rounded-xl h-72 w-full',
    'rect' => "rounded-lg {$width} {$height}",
    default => "rounded-md {$width} {$height}",
};
?>

<div
    aria-hidden="true"
    <?php echo e($attributes->merge(['class' => "animate-pulse bg-surface-raised border border-hairline/40 {$variantClasses}"])); ?>

></div>
<?php /**PATH /var/www/html/resources/views/components/skeleton.blade.php ENDPATH**/ ?>