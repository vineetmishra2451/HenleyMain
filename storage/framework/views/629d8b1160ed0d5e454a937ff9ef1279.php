<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'id' => null,
    'label' => null,
    'hint' => null,
    'error' => null,
    'checked' => false,
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
    'id' => null,
    'label' => null,
    'hint' => null,
    'error' => null,
    'checked' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$checkboxId = $id ?? ($name ? $name : 'checkbox_'.\Illuminate\Support\Str::random(8));
$hasError = !empty($error);
?>

<div class="space-y-1">
    <label for="<?php echo e($checkboxId); ?>" class="flex items-start gap-3 cursor-pointer group select-none">
        <input
            type="checkbox"
            name="<?php echo e($name); ?>"
            id="<?php echo e($checkboxId); ?>"
            <?php if($checked): ?> checked <?php endif; ?>
            <?php echo e($attributes->merge([
                'class' => 'mt-0.5 h-4 w-4 rounded border-hairline bg-surface-card text-accent focus:ring-accent focus:ring-offset-0 transition duration-250 ease-henley cursor-pointer ' .
                ($hasError ? 'border-saffron' : 'group-hover:border-accent')
            ])); ?>

        >

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label || $slot->isNotEmpty()): ?>
            <div class="text-ui text-primary leading-tight">
                <?php echo e($label ?? $slot); ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hint): ?>
                    <p class="text-caption text-secondary mt-0.5 font-normal"><?php echo e($hint); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </label>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasError): ?>
        <p role="alert" class="text-caption text-saffron font-medium ml-7">
            <?php echo e($error); ?>

        </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/form/checkbox.blade.php ENDPATH**/ ?>