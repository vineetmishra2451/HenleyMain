<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'First Flush Darjeeling 2026',
    'subtitle' => null,
    'category' => null,
    'price' => 1450,
    'compareAtPrice' => null,
    'image' => null,
    'imageAlt' => null,
    'rating' => 5.0,
    'ratingCount' => 24,
    'badge' => null,
    'badgeVariant' => 'gold',
    'imageAspect' => 'aspect-square sm:aspect-[4/5]',
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
    'subtitle' => null,
    'category' => null,
    'price' => 1450,
    'compareAtPrice' => null,
    'image' => null,
    'imageAlt' => null,
    'rating' => 5.0,
    'ratingCount' => 24,
    'badge' => null,
    'badgeVariant' => 'gold',
    'imageAspect' => 'aspect-square sm:aspect-[4/5]',
    'href' => '#',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$formattedPrice = is_numeric($price) ? '₹' . number_format((float)$price) : (str_starts_with((string)$price, '₹') ? $price : '₹' . $price);
$formattedCompare = null;
if ($compareAtPrice) {
    $formattedCompare = is_numeric($compareAtPrice) ? '₹' . number_format((float)$compareAtPrice) : (str_starts_with((string)$compareAtPrice, '₹') ? $compareAtPrice : '₹' . $compareAtPrice);
}

$fullStars = min(5, max(0, (int) floor((float) $rating)));
$hasHalf = ((float) $rating - $fullStars) >= 0.5;
$emptyStars = 5 - $fullStars - ($hasHalf ? 1 : 0);
?>

<article <?php echo e($attributes->merge(['class' => 'group bg-white rounded-lg sm:rounded-xl border border-border/70 overflow-hidden shadow-subtle hover:shadow-card transition-all duration-300 flex flex-col justify-between'])); ?>>
    <!-- Product Image Container -->
    <a href="<?php echo e($href); ?>" class="block relative overflow-hidden bg-sand/30 <?php echo e($imageAspect); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image): ?>
            <img
                src="<?php echo e($image); ?>"
                alt="<?php echo e($imageAlt ?? $title); ?>"
                loading="lazy"
                class="h-full w-full object-cover object-center transition-transform duration-500 ease-out group-hover:scale-105"
            >
        <?php else: ?>
            <div class="flex h-full w-full items-center justify-center bg-sand/30 text-charcoal/30">
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
            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 scale-90 sm:scale-100 origin-top-left">
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

        <div class="absolute inset-0 bg-charcoal/5 transition-opacity duration-300 pointer-events-none opacity-0 group-hover:opacity-100"></div>
    </a>

    <!-- Card Body -->
    <div class="p-2.5 sm:p-4 lg:p-5 space-y-2 sm:space-y-3 flex-1 flex flex-col justify-between text-left">
        <div class="space-y-1 sm:space-y-1.5">
            <!-- Star Rating -->
            <div class="flex items-center gap-1 scale-90 sm:scale-100 origin-left">
                <div class="flex items-center gap-0.5 text-gold" role="img" aria-label="<?php echo e($rating); ?> out of 5 stars">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < $fullStars; $i++): ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasHalf): ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" class="opacity-80">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < $emptyStars; $i++): ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" class="text-charcoal/20">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                        </svg>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ratingCount): ?>
                    <span class="text-xs text-charcoal/60 font-sans ml-1">
                        (<?php echo e($ratingCount); ?> <?php echo e($ratingCount === 1 ? 'Review' : 'Reviews'); ?>)
                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Category kicker -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category): ?>
                <p class="text-eyebrow text-gold !text-[9px] sm:!text-[10px] tracking-wider uppercase font-medium line-clamp-1">
                    <?php echo e($category); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Product name -->
            <a href="<?php echo e($href); ?>" class="block group-hover:text-maroon transition-colors">
                <h3 class="font-serif text-sm sm:text-base lg:text-lg text-charcoal leading-snug line-clamp-1">
                    <?php echo e($title); ?>

                </h3>
            </a>

            <!-- Subtitle -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subtitle): ?>
                <p class="text-[11px] sm:text-xs text-charcoal/55 line-clamp-1 leading-relaxed hidden sm:block">
                    <?php echo e($subtitle); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Price & Action Buttons -->
        <div class="space-y-2 sm:space-y-3 pt-1.5 sm:pt-2 border-t border-border/50">
            <div class="flex items-baseline justify-between">
                <div class="inline-flex items-baseline gap-2">
                    <span class="font-serif font-normal tabular-nums text-base sm:text-lg <?php echo e($formattedCompare ? 'text-terracotta' : 'text-charcoal'); ?>">
                        <?php echo e($formattedPrice); ?>

                    </span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formattedCompare): ?>
                        <span class="font-serif font-normal tabular-nums line-through text-charcoal/40 text-xs sm:text-sm">
                            <?php echo e($formattedCompare); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formattedCompare): ?>
                    <span class="text-[9px] sm:text-[10px] font-sans font-semibold uppercase text-terracotta bg-terracotta/10 px-1 py-0.5 rounded">
                        Offer
                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 sm:gap-2 pt-0.5">
                <a href="<?php echo e($href); ?>" class="w-full">
                    <span class="w-full inline-flex items-center justify-center rounded-md font-sans text-charcoal bg-transparent border border-border hover:bg-sand/40 hover:border-charcoal/40 transition-colors cursor-pointer !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center">
                        View
                    </span>
                </a>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($action)): ?>
                    <div class="w-full">
                        <?php echo e($action); ?>

                    </div>
                <?php else: ?>
                    <a href="<?php echo e($href); ?>" class="w-full">
                        <span class="w-full inline-flex items-center justify-center rounded-md font-sans text-ivory bg-maroon hover:bg-maroon-dark transition-colors cursor-pointer shadow-subtle !text-[10px] sm:!text-[11px] !py-1.5 sm:!py-2 !px-1 font-medium tracking-normal text-center">
                            + Bag
                        </span>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</article>
<?php /**PATH /var/www/html/resources/views/components/commerce/product-card.blade.php ENDPATH**/ ?>