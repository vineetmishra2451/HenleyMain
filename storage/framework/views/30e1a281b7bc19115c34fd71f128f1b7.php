<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'items' => [
        [
            'icon' => 'leaf',
            'label' => 'Single-Estate Origin',
            'caption' => 'Traceable directly to prime mountain slopes',
        ],
        [
            'icon' => 'package',
            'label' => 'Apothecary Sealed',
            'caption' => 'Flushed with nitrogen in bone porcelain tins',
        ],
        [
            'icon' => 'truck',
            'label' => 'Complimentary Delivery',
            'caption' => 'Express air courier on orders over ₹1,500',
        ],
        [
            'icon' => 'shield-check',
            'label' => '100% Biodynamic Purity',
            'caption' => 'Zero synthetic pesticides or artificial aromas',
        ],
    ],
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
    'items' => [
        [
            'icon' => 'leaf',
            'label' => 'Single-Estate Origin',
            'caption' => 'Traceable directly to prime mountain slopes',
        ],
        [
            'icon' => 'package',
            'label' => 'Apothecary Sealed',
            'caption' => 'Flushed with nitrogen in bone porcelain tins',
        ],
        [
            'icon' => 'truck',
            'label' => 'Complimentary Delivery',
            'caption' => 'Express air courier on orders over ₹1,500',
        ],
        [
            'icon' => 'shield-check',
            'label' => '100% Biodynamic Purity',
            'caption' => 'Zero synthetic pesticides or artificial aromas',
        ],
    ],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 py-10 px-6 sm:px-10 rounded-2xl bg-surface-raised border border-hairline my-12'])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-gold-surface border border-gold/30 text-gold-text">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($item['icon'] ?? '') === 'leaf'): ?>
                    <?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f)): ?>
<?php $attributes = $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f; ?>
<?php unset($__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f)): ?>
<?php $component = $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f; ?>
<?php unset($__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f); ?>
<?php endif; ?>
                <?php elseif(($item['icon'] ?? '') === 'package'): ?>
                    <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
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
                <?php elseif(($item['icon'] ?? '') === 'truck'): ?>
                    <?php if (isset($component)) { $__componentOriginalc07be98fa98af484c792921bc6f4e819 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc07be98fa98af484c792921bc6f4e819 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.truck','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.truck'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc07be98fa98af484c792921bc6f4e819)): ?>
<?php $attributes = $__attributesOriginalc07be98fa98af484c792921bc6f4e819; ?>
<?php unset($__attributesOriginalc07be98fa98af484c792921bc6f4e819); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc07be98fa98af484c792921bc6f4e819)): ?>
<?php $component = $__componentOriginalc07be98fa98af484c792921bc6f4e819; ?>
<?php unset($__componentOriginalc07be98fa98af484c792921bc6f4e819); ?>
<?php endif; ?>
                <?php elseif(($item['icon'] ?? '') === 'shield-check'): ?>
                    <?php if (isset($component)) { $__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.shield-check','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.shield-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2)): ?>
<?php $attributes = $__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2; ?>
<?php unset($__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2)): ?>
<?php $component = $__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2; ?>
<?php unset($__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2); ?>
<?php endif; ?>
                <?php elseif(($item['icon'] ?? '') === 'clock'): ?>
                    <?php if (isset($component)) { $__componentOriginal0656bd305abc6f376ceab88970af3514 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0656bd305abc6f376ceab88970af3514 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.clock','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.clock'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0656bd305abc6f376ceab88970af3514)): ?>
<?php $attributes = $__attributesOriginal0656bd305abc6f376ceab88970af3514; ?>
<?php unset($__attributesOriginal0656bd305abc6f376ceab88970af3514); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0656bd305abc6f376ceab88970af3514)): ?>
<?php $component = $__componentOriginal0656bd305abc6f376ceab88970af3514; ?>
<?php unset($__componentOriginal0656bd305abc6f376ceab88970af3514); ?>
<?php endif; ?>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal4c316f3544fd858e5c71b5ef1159c026 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c316f3544fd858e5c71b5ef1159c026 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.sparkles','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.sparkles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4c316f3544fd858e5c71b5ef1159c026)): ?>
<?php $attributes = $__attributesOriginal4c316f3544fd858e5c71b5ef1159c026; ?>
<?php unset($__attributesOriginal4c316f3544fd858e5c71b5ef1159c026); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4c316f3544fd858e5c71b5ef1159c026)): ?>
<?php $component = $__componentOriginal4c316f3544fd858e5c71b5ef1159c026; ?>
<?php unset($__componentOriginal4c316f3544fd858e5c71b5ef1159c026); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="space-y-0.5">
                <h4 class="font-sans text-xs uppercase tracking-[0.14em] font-semibold text-primary">
                    <?php echo e($item['label']); ?>

                </h4>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($item['caption'])): ?>
                    <p class="font-sans text-caption text-secondary leading-snug">
                        <?php echo e($item['caption']); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/commerce/trust-badge-strip.blade.php ENDPATH**/ ?>