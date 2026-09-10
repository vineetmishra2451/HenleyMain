<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'tabs' => [], // Array of ['id' => 'notes', 'label' => 'Tasting Notes']
    'default' => null,
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
    'tabs' => [], // Array of ['id' => 'notes', 'label' => 'Tasting Notes']
    'default' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$defaultTab = $default ?? ($tabs[0]['id'] ?? '');
?>

<div
    x-data="{ activeTab: '<?php echo e($defaultTab); ?>' }"
    <?php echo e($attributes->merge(['class' => 'w-full space-y-8'])); ?>

>
    <!-- Tab Bar with active Oxblood bottom border -->
    <div class="border-b border-hairline flex items-center gap-8 overflow-x-auto no-scrollbar">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button
                type="button"
                x-on:click="activeTab = '<?php echo e($tab['id']); ?>'"
                :class="activeTab === '<?php echo e($tab['id']); ?>' ? 'border-accent text-accent font-semibold' : 'border-transparent text-secondary hover:text-primary hover:border-hairline font-normal'"
                class="pb-4 border-b-2 font-sans text-xs uppercase tracking-[0.16em] transition-all duration-250 ease-henley whitespace-nowrap cursor-pointer focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
            >
                <?php echo e($tab['label']); ?>

            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Tab Panels Container -->
    <div>
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/tabs.blade.php ENDPATH**/ ?>