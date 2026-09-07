<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'value' => '',
    'id' => null,
    'title' => '',
    'subtitle' => null,
    'price' => null,
    'checked' => false,
    'badge' => null,
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
    'name' => '',
    'value' => '',
    'id' => null,
    'title' => '',
    'subtitle' => null,
    'price' => null,
    'checked' => false,
    'badge' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$radioId = $id ?? ($name.'_'.\Illuminate\Support\Str::slug((string) $value));
?>

<label for="<?php echo e($radioId); ?>" class="relative flex items-center justify-between p-4 rounded-lg border border-hairline bg-surface-card hover:border-muted hover:bg-surface-raised/40 transition-all duration-250 ease-henley cursor-pointer select-none group has-[:checked]:border-accent has-[:checked]:bg-surface-raised has-[:checked]:ring-1 has-[:checked]:ring-accent">
    <div class="flex items-center gap-3.5">
        <input
            type="radio"
            name="<?php echo e($name); ?>"
            value="<?php echo e($value); ?>"
            id="<?php echo e($radioId); ?>"
            <?php if($checked): ?> checked <?php endif; ?>
            <?php echo e($attributes->merge(['class' => 'h-4 w-4 border-hairline text-accent focus:ring-accent focus:ring-offset-0 cursor-pointer'])); ?>

        >

        <div>
            <div class="flex items-center gap-2">
                <span class="text-ui font-medium text-primary"><?php echo e($title); ?></span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($badge): ?>
                    <span class="px-2 py-0.5 text-[10px] uppercase tracking-wider font-bold rounded-full bg-gold-surface text-gold-text">
                        <?php echo e($badge); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subtitle): ?>
                <p class="text-caption text-secondary mt-0.5"><?php echo e($subtitle); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($price): ?>
        <div class="font-serif text-lg font-medium text-primary tracking-tight">
            <?php echo e($price); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</label>
<?php /**PATH /var/www/html/resources/views/components/form/radio-card.blade.php ENDPATH**/ ?>