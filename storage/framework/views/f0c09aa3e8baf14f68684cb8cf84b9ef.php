<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'default', // tall | wide | default | gold-rim | subtle
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
    'variant' => 'default', // tall | wide | default | gold-rim | subtle
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
$clipId = 'arch-clip-' . $variant . '-' . \Illuminate\Support\Str::random(6);

$isSvgArch = in_array($variant, ['tall', 'wide'], true);
$archPath = match ($variant) {
    'tall' => 'M 0,1 L 0,0.42 C 0,0.22 0.12,0.06 0.5,0 C 0.88,0.06 1,0.22 1,0.42 L 1,1 Z',
    'wide' => 'M 0,1 L 0,0.48 C 0,0.12 0.12,0 0.5,0 C 0.88,0 1,0.12 1,0.48 L 1,1 Z',
    default => null,
};

$variantAspect = match ($variant) {
    'tall' => 'aspect-[3/5]',
    'wide' => 'aspect-[4/3]',
    default => $aspect,
};

$borderClasses = match ($variant) {
    'gold-rim' => 'border border-gold shadow-subtle',
    'subtle' => 'border border-hairline/60',
    'tall', 'wide' => '',
    default => 'border border-hairline shadow-subtle',
};
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSvgArch): ?>
    <div <?php echo e($attributes->merge(['class' => "relative {$variantAspect} w-full"])); ?>>
        <svg width="0" height="0" class="absolute" aria-hidden="true">
            <defs>
                <clipPath id="<?php echo e($clipId); ?>" clipPathUnits="objectBoundingBox">
                    <path d="<?php echo e($archPath); ?>" />
                </clipPath>
            </defs>
        </svg>
        <div class="w-full h-full overflow-hidden" style="clip-path: url(#<?php echo e($clipId); ?>);">
            <?php echo e($slot); ?>

        </div>
    </div>
<?php else: ?>
    <div <?php echo e($attributes->merge(['class' => "relative overflow-hidden rounded-t-[9999px] rounded-b-none bg-surface-raised {$aspect} {$borderClasses} transition-all duration-350 ease-henley"])); ?>>
        <?php echo e($slot); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php /**PATH /var/www/html/resources/views/components/arch-frame.blade.php ENDPATH**/ ?>