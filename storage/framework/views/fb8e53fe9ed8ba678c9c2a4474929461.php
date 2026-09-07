<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'status' => 'in_stock', // in_stock | low_stock | out_of_stock
    'quantity' => null,
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
    'status' => 'in_stock', // in_stock | low_stock | out_of_stock
    'quantity' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$dotClasses = match ($status) {
    'low_stock', 'low-stock' => 'bg-saffron ring-4 ring-saffron-surface',
    'out_of_stock', 'out-of-stock' => 'bg-muted ring-4 ring-hairline',
    default => 'bg-sage ring-4 ring-sage-surface',
};

$label = match ($status) {
    'low_stock', 'low-stock' => ($quantity ? "Only {$quantity} remaining" : 'Low stock'),
    'out_of_stock', 'out-of-stock' => 'Harvest currently resting (Sold out)',
    default => 'In stock — Harvested & sealed at origin',
};
?>

<div <?php echo e($attributes->merge(['class' => 'inline-flex items-center gap-2.5 font-sans text-caption text-secondary'])); ?>>
    <span class="inline-block h-2 w-2 rounded-full <?php echo e($dotClasses); ?>" aria-hidden="true"></span>
    <span><?php echo e($label); ?></span>
</div>
<?php /**PATH /var/www/html/resources/views/components/commerce/stock-indicator.blade.php ENDPATH**/ ?>