<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'price' => 0, // float, int paise, or formatted string
    'compareAtPrice' => null,
    'minPrice' => null,
    'maxPrice' => null,
    'size' => 'card', // card (20px) | hero (32px) | sm (16px)
    'currency' => '₹',
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
    'price' => 0, // float, int paise, or formatted string
    'compareAtPrice' => null,
    'minPrice' => null,
    'maxPrice' => null,
    'size' => 'card', // card (20px) | hero (32px) | sm (16px)
    'currency' => '₹',
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
    'hero' => 'text-price-hero',
    'sm' => 'text-body font-medium',
    default => 'text-price-card',
};

// Format function if given number
$format = function ($val) use ($currency) {
    if (is_string($val) && (str_contains($val, '₹') || str_contains($val, 'Rs'))) {
        return $val;
    }
    $num = (float) $val;
    return $currency.number_format($num, 2);
};
?>

<div <?php echo e($attributes->merge(['class' => "inline-flex items-baseline gap-2 font-serif text-primary tracking-tight select-none {$sizeClasses}"])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($minPrice !== null && $maxPrice !== null && $minPrice < $maxPrice): ?>
        <span><?php echo e($format($minPrice)); ?> – <?php echo e($format($maxPrice)); ?></span>
    <?php else: ?>
        <span><?php echo e($format($price)); ?></span>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($compareAtPrice && (float) $compareAtPrice > (float) $price): ?>
            <span class="font-sans text-sm font-normal text-muted line-through">
                <?php echo e($format($compareAtPrice)); ?>

            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/commerce/price.blade.php ENDPATH**/ ?>