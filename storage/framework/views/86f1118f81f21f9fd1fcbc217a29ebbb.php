<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'accent', // accent (oxblood) | gold | secondary | muted
    'tag' => 'span',
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
    'variant' => 'accent', // accent (oxblood) | gold | secondary | muted
    'tag' => 'span',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$colorClasses = match ($variant) {
    'gold' => 'text-gold',
    'secondary' => 'text-secondary',
    'muted' => 'text-muted',
    default => 'text-accent',
};
?>

<<?php echo e($tag); ?> <?php echo e($attributes->merge(['class' => "inline-block font-sans text-eyebrow uppercase font-semibold tracking-[0.18em] select-none {$colorClasses}"])); ?>>
    <?php echo e($slot); ?>

</<?php echo e($tag); ?>>
<?php /**PATH /var/www/html/resources/views/components/eyebrow.blade.php ENDPATH**/ ?>