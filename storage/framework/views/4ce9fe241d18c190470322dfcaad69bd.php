<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'rating' => 5.0, // float e.g. 4.8
    'count' => null,  // int e.g. 128
    'showCount' => true,
    'size' => 'sm', // sm | md
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
    'rating' => 5.0, // float e.g. 4.8
    'count' => null,  // int e.g. 128
    'showCount' => true,
    'size' => 'sm', // sm | md
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$r = (float) $rating;
$iconSize = $size === 'md' ? 'w-4 h-4' : 'w-3.5 h-3.5';
?>

<div <?php echo e($attributes->merge(['class' => 'inline-flex items-center gap-1.5 select-none'])); ?> aria-label="Rated <?php echo e(number_format($r, 1)); ?> out of 5 stars">
    <div class="flex items-center gap-0.5" aria-hidden="true">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r >= $i): ?>
                <?php if (isset($component)) { $__componentOriginal6ada0f56496d3e0b2070a29d544db584 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6ada0f56496d3e0b2070a29d544db584 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.star-filled','data' => ['class' => ''.e($iconSize).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.star-filled'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e($iconSize).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6ada0f56496d3e0b2070a29d544db584)): ?>
<?php $attributes = $__attributesOriginal6ada0f56496d3e0b2070a29d544db584; ?>
<?php unset($__attributesOriginal6ada0f56496d3e0b2070a29d544db584); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6ada0f56496d3e0b2070a29d544db584)): ?>
<?php $component = $__componentOriginal6ada0f56496d3e0b2070a29d544db584; ?>
<?php unset($__componentOriginal6ada0f56496d3e0b2070a29d544db584); ?>
<?php endif; ?>
            <?php elseif($r >= $i - 0.5): ?>
                <?php if (isset($component)) { $__componentOriginal9a08ee65de0bb99ead9f64583b5ca028 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a08ee65de0bb99ead9f64583b5ca028 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.star-half','data' => ['class' => ''.e($iconSize).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.star-half'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e($iconSize).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a08ee65de0bb99ead9f64583b5ca028)): ?>
<?php $attributes = $__attributesOriginal9a08ee65de0bb99ead9f64583b5ca028; ?>
<?php unset($__attributesOriginal9a08ee65de0bb99ead9f64583b5ca028); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a08ee65de0bb99ead9f64583b5ca028)): ?>
<?php $component = $__componentOriginal9a08ee65de0bb99ead9f64583b5ca028; ?>
<?php unset($__componentOriginal9a08ee65de0bb99ead9f64583b5ca028); ?>
<?php endif; ?>
            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal574ac9a013fab1da94dcdc7357e0d3a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal574ac9a013fab1da94dcdc7357e0d3a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.star-empty','data' => ['class' => ''.e($iconSize).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.star-empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e($iconSize).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal574ac9a013fab1da94dcdc7357e0d3a1)): ?>
<?php $attributes = $__attributesOriginal574ac9a013fab1da94dcdc7357e0d3a1; ?>
<?php unset($__attributesOriginal574ac9a013fab1da94dcdc7357e0d3a1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal574ac9a013fab1da94dcdc7357e0d3a1)): ?>
<?php $component = $__componentOriginal574ac9a013fab1da94dcdc7357e0d3a1; ?>
<?php unset($__componentOriginal574ac9a013fab1da94dcdc7357e0d3a1); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showCount && $count !== null): ?>
        <span class="font-sans text-caption text-secondary">
            (<?php echo e($count); ?>)
        </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/commerce/rating.blade.php ENDPATH**/ ?>