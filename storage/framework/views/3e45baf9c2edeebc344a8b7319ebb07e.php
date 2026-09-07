<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => 'search',
    'id' => null,
    'placeholder' => 'Search by harvest, single origin, or aromatic notes...',
    'value' => '',
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
    'name' => 'search',
    'id' => null,
    'placeholder' => 'Search by harvest, single origin, or aromatic notes...',
    'value' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$inputId = $id ?? ($name ? $name : 'search_'.\Illuminate\Support\Str::random(8));
?>

<div x-data="{ query: '<?php echo e(addslashes((string) $value)); ?>' }" class="relative w-full">
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-secondary" aria-hidden="true">
        <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $attributes = $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $component = $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
    </div>

    <input
        type="search"
        name="<?php echo e($name); ?>"
        id="<?php echo e($inputId); ?>"
        x-model="query"
        placeholder="<?php echo e($placeholder); ?>"
        aria-label="<?php echo e($placeholder); ?>"
        <?php echo e($attributes->merge([
            'class' => 'block w-full rounded-full border border-hairline bg-surface-card pl-11 pr-10 py-3 text-ui text-primary placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition-colors duration-250 ease-henley'
        ])); ?>

    >

    <button
        type="button"
        x-show="query.length > 0"
        x-on:click="query = ''; $el.previousElementSibling.focus()"
        class="absolute inset-y-0 right-0 flex items-center pr-4 text-muted hover:text-primary transition-colors"
        aria-label="Clear search query"
        style="display: none;"
    >
        <?php if (isset($component)) { $__componentOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.close','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6464b9a54d2bedc8c500f17bdd4af0b)): ?>
<?php $attributes = $__attributesOriginalf6464b9a54d2bedc8c500f17bdd4af0b; ?>
<?php unset($__attributesOriginalf6464b9a54d2bedc8c500f17bdd4af0b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6464b9a54d2bedc8c500f17bdd4af0b)): ?>
<?php $component = $__componentOriginalf6464b9a54d2bedc8c500f17bdd4af0b; ?>
<?php unset($__componentOriginalf6464b9a54d2bedc8c500f17bdd4af0b); ?>
<?php endif; ?>
    </button>
</div>
<?php /**PATH /var/www/html/resources/views/components/form/search-input.blade.php ENDPATH**/ ?>