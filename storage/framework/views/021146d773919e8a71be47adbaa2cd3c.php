<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'default', // default (primary #231C18) | accent (oxblood #5C2225) | inverse (white/canvas)
    'showTagline' => false,
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
    'variant' => 'default', // default (primary #231C18) | accent (oxblood #5C2225) | inverse (white/canvas)
    'showTagline' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$textClass = match ($variant) {
    'accent' => 'text-accent',
    'inverse' => 'text-inverse',
    default => 'text-primary',
};
?>

<div <?php echo e($attributes->merge(['class' => 'inline-flex flex-col items-center justify-center select-none group'])); ?>>
    <!-- Henley Wordmark -->
    <span class="font-sans text-2xl sm:text-3xl font-bold tracking-[0.28em] uppercase <?php echo e($textClass); ?> leading-none transition-colors duration-250">
        HENLEY
    </span>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showTagline): ?>
        <span class="font-sans text-[9px] uppercase tracking-[0.32em] text-gold font-medium mt-1">
            Single-Origin Reserve
        </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/brand/logo.blade.php ENDPATH**/ ?>