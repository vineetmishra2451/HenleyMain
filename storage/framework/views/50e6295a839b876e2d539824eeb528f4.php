<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'First Flush Darjeeling 2026',
    'subtitle' => 'Single Estate • Castleton Lot 04',
    'price' => 1450,
    'compareAtPrice' => null,
    'image' => null,
    'imageAlt' => null,
    'rating' => 5.0,
    'ratingCount' => 24,
    'badge' => null,
    'badgeVariant' => 'gold',
    'href' => '#',
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
    'title' => 'First Flush Darjeeling 2026',
    'subtitle' => 'Single Estate • Castleton Lot 04',
    'price' => 1450,
    'compareAtPrice' => null,
    'image' => null,
    'imageAlt' => null,
    'rating' => 5.0,
    'ratingCount' => 24,
    'badge' => null,
    'badgeVariant' => 'gold',
    'href' => '#',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<article <?php echo e($attributes->merge(['class' => 'group relative flex flex-col rounded-xl border border-hairline bg-surface-raised/40 p-4 transition-all duration-350 ease-henley hover:border-muted hover:bg-surface-raised hover:shadow-hover'])); ?>>
    <!-- Product Image Container with gentle 1.03x scale -->
    <a href="<?php echo e($href); ?>" class="relative block aspect-square w-full overflow-hidden rounded-lg bg-surface-raised">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image): ?>
            <img
                src="<?php echo e($image); ?>"
                alt="<?php echo e($imageAlt ?? $title); ?>"
                loading="lazy"
                class="h-full w-full object-cover object-center transition-transform duration-500 ease-henley group-hover:scale-[1.03]"
            >
        <?php else: ?>
            <div class="flex h-full w-full items-center justify-center bg-surface-raised text-muted">
                <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'h-12 w-12 stroke-[1.2]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-12 w-12 stroke-[1.2]']); ?>
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
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($badge): ?>
            <div class="absolute top-3 left-3">
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => $badgeVariant]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeVariant)]); ?>
                    <?php echo e($badge); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </a>

    <!-- Card Content -->
    <div class="mt-4 flex flex-1 flex-col justify-between space-y-3">
        <div class="space-y-1.5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rating): ?>
                <div class="flex items-center justify-between">
                    <?php if (isset($component)) { $__componentOriginaldb675a6dde00eb87d0b1b6dc03730208 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb675a6dde00eb87d0b1b6dc03730208 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.rating','data' => ['rating' => $rating,'count' => $ratingCount]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.rating'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rating' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rating),'count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ratingCount)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb675a6dde00eb87d0b1b6dc03730208)): ?>
<?php $attributes = $__attributesOriginaldb675a6dde00eb87d0b1b6dc03730208; ?>
<?php unset($__attributesOriginaldb675a6dde00eb87d0b1b6dc03730208); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb675a6dde00eb87d0b1b6dc03730208)): ?>
<?php $component = $__componentOriginaldb675a6dde00eb87d0b1b6dc03730208; ?>
<?php unset($__componentOriginaldb675a6dde00eb87d0b1b6dc03730208); ?>
<?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <h3 class="font-serif text-display-3 font-normal text-primary group-hover:text-accent transition-colors duration-250">
                <a href="<?php echo e($href); ?>" class="focus:outline-none">
                    <?php echo e($title); ?>

                </a>
            </h3>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subtitle): ?>
                <p class="font-sans text-caption text-secondary">
                    <?php echo e($subtitle); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="pt-2 flex items-center justify-between border-t border-hairline/60">
            <?php if (isset($component)) { $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.price','data' => ['price' => $price,'compareAtPrice' => $compareAtPrice,'size' => 'card']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($price),'compare-at-price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($compareAtPrice),'size' => 'card']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329)): ?>
<?php $attributes = $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329; ?>
<?php unset($__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329)): ?>
<?php $component = $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329; ?>
<?php unset($__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329); ?>
<?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($action)): ?>
                <div>
                    <?php echo e($action); ?>

                </div>
            <?php else: ?>
                <a
                    href="<?php echo e($href); ?>"
                    aria-label="View <?php echo e($title); ?>"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-hairline text-secondary hover:border-accent hover:text-accent hover:bg-surface-raised transition duration-250"
                >
                    <?php if (isset($component)) { $__componentOriginal37a3f047daccd28b87517bd215a12923 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal37a3f047daccd28b87517bd215a12923 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.arrow-right','data' => ['class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.arrow-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal37a3f047daccd28b87517bd215a12923)): ?>
<?php $attributes = $__attributesOriginal37a3f047daccd28b87517bd215a12923; ?>
<?php unset($__attributesOriginal37a3f047daccd28b87517bd215a12923); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal37a3f047daccd28b87517bd215a12923)): ?>
<?php $component = $__componentOriginal37a3f047daccd28b87517bd215a12923; ?>
<?php unset($__componentOriginal37a3f047daccd28b87517bd215a12923); ?>
<?php endif; ?>
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</article>
<?php /**PATH /var/www/html/resources/views/components/commerce/product-card.blade.php ENDPATH**/ ?>