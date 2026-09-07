<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'currentPage' => 1,
    'totalPages' => 1,
    'baseUrl' => '?page=',
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
    'currentPage' => 1,
    'totalPages' => 1,
    'baseUrl' => '?page=',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$prevUrl = $currentPage > 1 ? $baseUrl.($currentPage - 1) : null;
$nextUrl = $currentPage < $totalPages ? $baseUrl.($currentPage + 1) : null;
?>

<nav aria-label="Pagination" <?php echo e($attributes->merge(['class' => 'flex items-center justify-between border-t border-hairline pt-6 px-4'])); ?>>
    <div class="flex flex-1 justify-between sm:hidden">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prevUrl): ?>
            <a href="<?php echo e($prevUrl); ?>" class="px-4 py-2 border border-hairline rounded-full text-caption uppercase tracking-wider font-medium text-primary hover:border-accent hover:text-accent">
                Previous
            </a>
        <?php else: ?>
            <span class="px-4 py-2 border border-hairline/40 rounded-full text-caption uppercase tracking-wider font-medium text-muted cursor-not-allowed">
                Previous
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($nextUrl): ?>
            <a href="<?php echo e($nextUrl); ?>" class="px-4 py-2 border border-hairline rounded-full text-caption uppercase tracking-wider font-medium text-primary hover:border-accent hover:text-accent">
                Next
            </a>
        <?php else: ?>
            <span class="px-4 py-2 border border-hairline/40 rounded-full text-caption uppercase tracking-wider font-medium text-muted cursor-not-allowed">
                Next
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <p class="text-caption text-secondary">
            Showing Page <span class="font-medium text-primary"><?php echo e($currentPage); ?></span> of <span class="font-medium text-primary"><?php echo e($totalPages); ?></span>
        </p>

        <div class="flex items-center space-x-1.5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prevUrl): ?>
                <a href="<?php echo e($prevUrl); ?>" aria-label="Previous page" class="p-2 rounded-full border border-hairline text-secondary hover:border-accent hover:text-accent hover:bg-surface-raised transition">
                    <?php if (isset($component)) { $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-right','data' => ['class' => 'w-4 h-4 rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 rotate-180']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $attributes = $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $component = $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
                </a>
            <?php else: ?>
                <span class="p-2 rounded-full border border-hairline/40 text-muted cursor-not-allowed">
                    <?php if (isset($component)) { $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-right','data' => ['class' => 'w-4 h-4 rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 rotate-180']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $attributes = $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $component = $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($p = 1; $p <= $totalPages; $p++): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($p == $currentPage): ?>
                    <span aria-current="page" class="w-9 h-9 flex items-center justify-center rounded-full bg-accent text-inverse font-sans text-xs font-semibold select-none">
                        <?php echo e($p); ?>

                    </span>
                <?php else: ?>
                    <a href="<?php echo e($baseUrl.$p); ?>" class="w-9 h-9 flex items-center justify-center rounded-full border border-hairline text-primary hover:border-accent hover:text-accent hover:bg-surface-raised transition font-sans text-xs font-medium">
                        <?php echo e($p); ?>

                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($nextUrl): ?>
                <a href="<?php echo e($nextUrl); ?>" aria-label="Next page" class="p-2 rounded-full border border-hairline text-secondary hover:border-accent hover:text-accent hover:bg-surface-raised transition">
                    <?php if (isset($component)) { $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-right','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $attributes = $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $component = $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
                </a>
            <?php else: ?>
                <span class="p-2 rounded-full border border-hairline/40 text-muted cursor-not-allowed">
                    <?php if (isset($component)) { $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-right','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $attributes = $__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__attributesOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01)): ?>
<?php $component = $__componentOriginal1b695c529ad5a6b01ccc95952ff01e01; ?>
<?php unset($__componentOriginal1b695c529ad5a6b01ccc95952ff01e01); ?>
<?php endif; ?>
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH /var/www/html/resources/views/components/pagination.blade.php ENDPATH**/ ?>