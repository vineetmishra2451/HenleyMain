<div class="w-full bg-ivory min-h-screen py-8 lg:py-12">
    <div class="henley-container">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-sans text-charcoal/50 mb-6" aria-label="Breadcrumb">
            <a href="/" class="hover:text-maroon transition-colors">Home</a>
            <span>/</span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeCategory): ?>
                <a href="/collections" class="hover:text-maroon transition-colors">Collections</a>
                <span>/</span>
                <span class="text-charcoal font-medium"><?php echo e($activeCategory->name); ?></span>
            <?php else: ?>
                <span class="text-charcoal font-medium">Collections</span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </nav>

        <!-- Page Header -->
        <div class="mb-8 lg:mb-10 text-left">
            <p class="text-eyebrow text-gold mb-2">Botanical Reserve</p>
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal tracking-tight font-normal">
                <?php echo e($activeCategory ? $activeCategory->name : 'Curated Collections'); ?>

            </h1>
            <p class="text-xs sm:text-sm text-charcoal/60 mt-2 max-w-2xl leading-relaxed">
                <?php echo e($activeCategory ? ($activeCategory->description ?: 'Discover our single-origin reserve, harvested at peak vitality from prime mountain slopes.') : 'Discover our meticulously crafted botanical collections: rare Himalayan single-estate teas, wild-foraged spices, stoneground flours, and pure cocoa.'); ?>

            </p>
        </div>

        <!-- Collection Category Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 scrollbar-none border-b border-border/70">
            <a
                href="/collections"
                class="flex-shrink-0 px-4 py-2 rounded-full text-xs font-sans font-medium transition-all <?php echo e(is_null($activeCategory) ? 'bg-maroon text-ivory shadow-xs font-semibold' : 'bg-sand/60 text-charcoal/80 hover:bg-sand hover:text-charcoal border border-border/60'); ?>"
            >
                All Collections (<?php echo e($products->total()); ?>)
            </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isSelected = $activeCategory && $activeCategory->id === $c->id;
                ?>
                <a
                    href="/collections?cat=<?php echo e($c->slug); ?>"
                    class="flex-shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-sans font-medium transition-all <?php echo e($isSelected ? 'bg-maroon text-ivory shadow-xs font-semibold' : 'bg-sand/60 text-charcoal/80 hover:bg-sand hover:text-charcoal border border-border/60'); ?>"
                >
                    <span><?php echo e($c->name); ?></span>
                    <span class="text-[10px] <?php echo e($isSelected ? 'text-ivory/80' : 'text-charcoal/40'); ?>">
                        (<?php echo e($c->products_count); ?>)
                    </span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Products Grid -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->isNotEmpty()): ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $pImg = $product->primary_image ?: ($product->images->first()?->url ?: '/pimages/tea.jpg');
                        $badge = $product->is_bestseller ? 'bestseller' : ($product->is_featured ? 'organic' : null);
                        $categoryName = $product->primary_category?->name ?? ($product->categories->first()?->name ?? 'Botanical Reserve');
                    ?>
                    <?php if (isset($component)) { $__componentOriginal97cd36444825b8000ec8a09fb9ff392f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.product-card','data' => ['title' => $product->name,'subtitle' => $product->short_description ?? $categoryName,'category' => $categoryName,'price' => $product->getPriceMoney()->formatted(),'compareAtPrice' => $product->compare_at_price_money?->formatted(),'image' => $pImg,'rating' => (float) ($product->rating_average > 0 ? $product->rating_average : 5.0),'ratingCount' => (int) ($product->rating_count > 0 ? $product->rating_count : 164),'badge' => $badge,'href' => '/product/' . $product->slug,'imageAspect' => 'aspect-square']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->name),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->short_description ?? $categoryName),'category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categoryName),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->getPriceMoney()->formatted()),'compare-at-price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->compare_at_price_money?->formatted()),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pImg),'rating' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((float) ($product->rating_average > 0 ? $product->rating_average : 5.0)),'rating-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((int) ($product->rating_count > 0 ? $product->rating_count : 164)),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badge),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('/product/' . $product->slug),'image-aspect' => 'aspect-square']); ?>
                         <?php $__env->slot('action', null, []); ?> 
                            <button
                                type="button"
                                x-data
                                x-on:click.prevent="$dispatch('notify', { message: '<?php echo e(addslashes($product->name)); ?> added to bag.', tone: 'success' }); $dispatch('cart-updated', { count: 1 })"
                                class="w-full inline-flex items-center justify-center rounded-md font-sans text-ivory bg-maroon hover:bg-maroon/90 transition-colors cursor-pointer shadow-subtle text-xs py-2 px-2 font-medium"
                            >
                                + Bag
                            </button>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $attributes = $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $component = $__componentOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <?php echo e($products->links()); ?>

            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="py-20 text-center max-w-md mx-auto">
                <div class="w-16 h-16 rounded-full bg-sand/60 border border-border flex items-center justify-center text-maroon mx-auto mb-4">
                    <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'w-8 h-8 stroke-[1.2]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-8 h-8 stroke-[1.2]']); ?>
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
                <h3 class="font-serif text-xl text-charcoal mb-2">Harvest in Preparation</h3>
                <p class="text-xs text-charcoal/60 mb-6">
                    Our curators are freshly packing this seasonal allocation. Explore our other single-estate reserves.
                </p>
                <a
                    href="/collections"
                    class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-maroon text-ivory text-xs font-sans font-semibold uppercase tracking-wider hover:bg-maroon/90 transition-colors"
                >
                    View All Collections →
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/storefront/collections-page.blade.php ENDPATH**/ ?>