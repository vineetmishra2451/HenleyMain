<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'size' => 'default', // default (1280px) | wide (1440px) | narrow (960px) | prose (65ch)
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
    'size' => 'default', // default (1280px) | wide (1440px) | narrow (960px) | prose (65ch)
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$sizeClasses = match ($size) {
    'wide' => 'max-w-[1440px]',
    'narrow' => 'max-w-4xl',
    'prose' => 'max-w-prose',
    default => 'max-w-content',
};
?>

<div <?php echo e($attributes->merge(['class' => "mx-auto w-full px-5 sm:px-8 lg:px-12 {$sizeClasses}"])); ?>>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /var/www/html/resources/views/components/container.blade.php ENDPATH**/ ?>