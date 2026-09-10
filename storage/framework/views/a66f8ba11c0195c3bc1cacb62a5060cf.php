<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => 'quantity',
    'value' => 1,
    'min' => 1,
    'max' => 99,
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
    'name' => 'quantity',
    'value' => 1,
    'min' => 1,
    'max' => 99,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="{ count: <?php echo e((int) $value); ?>, min: <?php echo e((int) $min); ?>, max: <?php echo e((int) $max); ?> }"
    class="inline-flex items-center rounded-full border border-hairline bg-surface-card p-1 shadow-none"
>
    <button
        type="button"
        x-on:click="if (count > min) count--"
        :disabled="count <= min"
        aria-label="Decrease quantity"
        class="flex h-8 w-8 items-center justify-center rounded-full text-secondary hover:text-accent hover:bg-surface-raised disabled:opacity-30 disabled:cursor-not-allowed transition duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
    >
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
        </svg>
    </button>

    <input
        type="number"
        name="<?php echo e($name); ?>"
        x-model="count"
        min="<?php echo e($min); ?>"
        max="<?php echo e($max); ?>"
        readonly
        aria-label="Quantity"
        class="w-10 bg-transparent text-center font-sans text-ui font-semibold text-primary focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
        <?php echo e($attributes); ?>

    >

    <button
        type="button"
        x-on:click="if (count < max) count++"
        :disabled="count >= max"
        aria-label="Increase quantity"
        class="flex h-8 w-8 items-center justify-center rounded-full text-secondary hover:text-accent hover:bg-surface-raised disabled:opacity-30 disabled:cursor-not-allowed transition duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
    >
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
    </button>
</div>
<?php /**PATH /var/www/html/resources/views/components/form/quantity-stepper.blade.php ENDPATH**/ ?>