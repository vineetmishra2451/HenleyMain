<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'default', // default | gold-rim | subtle
    'aspect' => 'aspect-[3/4]',
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
    'variant' => 'default', // default | gold-rim | subtle
    'aspect' => 'aspect-[3/4]',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$borderClasses = match ($variant) {
    'gold-rim' => 'border border-gold shadow-subtle',
    'subtle' => 'border border-hairline/60',
    default => 'border border-hairline shadow-subtle',
};
?>

<div <?php echo e($attributes->merge(['class' => "relative overflow-hidden rounded-t-[9999px] rounded-b-none bg-surface-raised {$aspect} {$borderClasses} transition-all duration-350 ease-henley"])); ?>>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /var/www/html/resources/views/components/arch-frame.blade.php ENDPATH**/ ?>