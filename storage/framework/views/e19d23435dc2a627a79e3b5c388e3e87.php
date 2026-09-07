<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'ghost', // ghost | secondary | primary
    'size' => 'md', // sm | md | lg
    'label' => 'Action',
    'type' => 'button',
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
    'variant' => 'ghost', // ghost | secondary | primary
    'size' => 'md', // sm | md | lg
    'label' => 'Action',
    'type' => 'button',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$baseClasses = 'inline-flex items-center justify-center rounded-full transition-all duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer select-none';

$sizeClasses = match ($size) {
    'sm' => 'w-8 h-8 p-1.5',
    'md' => 'w-10 h-10 p-2.5',
    'lg' => 'w-12 h-12 p-3.5',
    default => 'w-10 h-10 p-2.5',
};

$variantClasses = match ($variant) {
    'primary' => 'bg-accent text-inverse hover:bg-accent-hover active:bg-accent-deep',
    'secondary' => 'bg-transparent text-primary border border-hairline hover:border-accent hover:text-accent active:bg-surface-raised',
    'ghost' => 'bg-transparent text-secondary hover:text-accent hover:bg-surface-raised active:bg-hairline/40',
    default => 'bg-transparent text-secondary hover:text-accent hover:bg-surface-raised',
};

$classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
?>

<button
    type="<?php echo e($type); ?>"
    aria-label="<?php echo e($label); ?>"
    <?php echo e($attributes->merge(['class' => $classes])); ?>

>
    <?php echo e($slot); ?>

</button>
<?php /**PATH /var/www/html/resources/views/components/icon-button.blade.php ENDPATH**/ ?>