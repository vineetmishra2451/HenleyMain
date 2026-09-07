<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Your ritual basket is empty',
    'description' => 'Discover premier single-origin flushes and botanical elixirs to begin your ritual.',
    'icon' => 'bag',
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
    'title' => 'Your ritual basket is empty',
    'description' => 'Discover premier single-origin flushes and botanical elixirs to begin your ritual.',
    'icon' => 'bag',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'flex flex-col items-center justify-center text-center p-12 sm:p-16 rounded-2xl border border-dashed border-hairline bg-surface-raised/40 max-w-lg mx-auto my-8'])); ?>>
    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-surface-raised border border-hairline text-secondary mb-5">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon === 'bag'): ?>
            <?php if (isset($component)) { $__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.bag','data' => ['class' => 'h-7 w-7 stroke-[1.2]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.bag'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-7 w-7 stroke-[1.2]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1)): ?>
<?php $attributes = $__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1; ?>
<?php unset($__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1)): ?>
<?php $component = $__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1; ?>
<?php unset($__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1); ?>
<?php endif; ?>
        <?php elseif($icon === 'heart'): ?>
            <?php if (isset($component)) { $__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.heart','data' => ['class' => 'h-7 w-7 stroke-[1.2]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.heart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-7 w-7 stroke-[1.2]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2)): ?>
<?php $attributes = $__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2; ?>
<?php unset($__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2)): ?>
<?php $component = $__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2; ?>
<?php unset($__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2); ?>
<?php endif; ?>
        <?php elseif($icon === 'search'): ?>
            <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'h-7 w-7 stroke-[1.2]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-7 w-7 stroke-[1.2]']); ?>
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
        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'h-7 w-7 stroke-[1.2]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-7 w-7 stroke-[1.2]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8)): ?>
<?php $attributes = $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8; ?>
<?php unset($__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8)): ?>
<?php $component = $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8; ?>
<?php unset($__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <h4 class="font-serif text-display-3 font-normal text-primary tracking-tight">
        <?php echo e($title); ?>

    </h4>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($description): ?>
        <p class="mt-2 text-body text-secondary max-w-sm">
            <?php echo e($description); ?>

        </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slot->isNotEmpty()): ?>
        <div class="mt-6">
            <?php echo e($slot); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/empty-state.blade.php ENDPATH**/ ?>