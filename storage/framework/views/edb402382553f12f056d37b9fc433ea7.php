<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'hint' => null,
    'error' => null,
    'required' => false,
    'placeholder' => null,
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
    'type' => 'text',
    'hint' => null,
    'error' => null,
    'required' => false,
    'placeholder' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$inputId = $id ?? ($name ? $name : 'input_'.\Illuminate\Support\Str::random(8));
$hasError = !empty($error);
?>

<div class="space-y-1.5">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label): ?>
        <label for="<?php echo e($inputId); ?>" class="block text-xs font-semibold uppercase tracking-[0.14em] text-primary">
            <?php echo e($label); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($required): ?>
                <span class="text-accent ml-0.5" aria-hidden="true">*</span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </label>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="relative">
        <input
            type="<?php echo e($type); ?>"
            name="<?php echo e($name); ?>"
            id="<?php echo e($inputId); ?>"
            placeholder="<?php echo e($placeholder); ?>"
            <?php if($required): ?> required aria-required="true" <?php endif; ?>
            <?php if($hasError): ?>
                aria-invalid="true"
                aria-describedby="<?php echo e($inputId); ?>-error"
            <?php elseif($hint): ?>
                aria-describedby="<?php echo e($inputId); ?>-hint"
            <?php endif; ?>
            <?php echo e($attributes->merge([
                'class' => 'block w-full rounded-md border bg-surface-card px-4 py-2.5 text-ui text-primary shadow-none placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition-colors duration-250 ease-henley ' .
                ($hasError ? 'border-saffron ring-1 ring-saffron bg-saffron-surface/20' : 'border-hairline hover:border-muted')
            ])); ?>

        >
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hint && ! $hasError): ?>
        <p id="<?php echo e($inputId); ?>-hint" class="text-caption text-secondary">
            <?php echo e($hint); ?>

        </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasError): ?>
        <p id="<?php echo e($inputId); ?>-error" role="alert" class="text-caption text-saffron font-medium">
            <?php echo e($error); ?>

        </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/form/input.blade.php ENDPATH**/ ?>