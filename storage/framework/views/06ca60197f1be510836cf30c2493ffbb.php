<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'neutral', // neutral | sage (organic) | saffron (sale) | gold (bestseller) | accent (oxblood)
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
    'variant' => 'neutral', // neutral | sage (organic) | saffron (sale) | gold (bestseller) | accent (oxblood)
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
    'sage' => 'bg-sage-surface text-sage-text border border-sage/20',
    'saffron' => 'bg-saffron-surface text-saffron-text border border-saffron/20',
    'gold' => 'bg-gold-surface text-gold-text border border-gold/30',
    'accent' => 'bg-accent text-inverse',
    default => 'bg-surface-raised text-secondary border border-hairline',
};
?>

<span <?php echo e($attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full font-sans text-badge uppercase font-bold tracking-[0.12em] select-none {$variantClasses}"])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH /var/www/html/resources/views/components/badge.blade.php ENDPATH**/ ?>