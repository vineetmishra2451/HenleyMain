<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'single', // single | multiple
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
    'type' => 'single', // single | multiple
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="{
        type: '<?php echo e($type); ?>',
        activeItems: [],
        toggle(id) {
            if (this.type === 'single') {
                this.activeItems = this.activeItems.includes(id) ? [] : [id];
            } else {
                if (this.activeItems.includes(id)) {
                    this.activeItems = this.activeItems.filter(i => i !== id);
                } else {
                    this.activeItems.push(id);
                }
            }
        },
        isOpen(id) {
            return this.activeItems.includes(id);
        }
    }"
    <?php echo e($attributes->merge(['class' => 'w-full divide-y divide-hairline border-y border-hairline'])); ?>

>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /var/www/html/resources/views/components/accordion.blade.php ENDPATH**/ ?>