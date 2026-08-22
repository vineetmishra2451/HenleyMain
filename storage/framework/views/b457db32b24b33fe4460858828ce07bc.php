<div
    x-data="{
        init() {
            this.$watch('$wire.isOpen', value => {
                if (value) {
                    this.$nextTick(() => this.$refs.searchInput?.focus());
                }
            });
        }
    }"
    x-on:keydown.escape.window="$wire.closeSearch()"
    x-show="$wire.isOpen"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto bg-primary/60 backdrop-blur-md p-4 sm:p-6 lg:p-8"
    role="dialog"
    aria-modal="true"
    aria-label="Catalogue Live Search"
    style="display: none;"
>
    <div class="mx-auto max-w-3xl pt-8 sm:pt-16">
        <div
            x-show="$wire.isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="overflow-hidden rounded-2xl border border-hairline bg-surface-card shadow-2xl"
        >
            <!-- Search Header Bar -->
            <div class="relative flex items-center border-b border-hairline px-6 py-4">
                <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'h-5 w-5 text-secondary mr-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-5 w-5 text-secondary mr-3']); ?>
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

                <input
                    x-ref="searchInput"
                    type="search"
                    wire:model.live.debounce.250ms="query"
                    placeholder="Search by harvest, single-estate origin, or botanical profile..."
                    aria-label="Search catalogue"
                    class="w-full bg-transparent text-lg font-sans text-primary placeholder:text-muted focus:outline-none"
                >

                <div wire:loading wire:target="query" class="mr-3">
                    <?php if (isset($component)) { $__componentOriginalf26909af655deaf31c8e20175813a5a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf26909af655deaf31c8e20175813a5a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.spinner','data' => ['size' => 'sm','color' => 'accent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','color' => 'accent']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf26909af655deaf31c8e20175813a5a0)): ?>
<?php $attributes = $__attributesOriginalf26909af655deaf31c8e20175813a5a0; ?>
<?php unset($__attributesOriginalf26909af655deaf31c8e20175813a5a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf26909af655deaf31c8e20175813a5a0)): ?>
<?php $component = $__componentOriginalf26909af655deaf31c8e20175813a5a0; ?>
<?php unset($__componentOriginalf26909af655deaf31c8e20175813a5a0); ?>
<?php endif; ?>
                </div>

                <button
                    type="button"
                    wire:click="closeSearch"
                    aria-label="Close search overlay"
                    class="rounded-full p-2 text-secondary hover:bg-surface-raised hover:text-primary transition"
                >
                    <?php if (isset($component)) { $__componentOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.close','data' => ['class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-4 w-4']); ?>
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

            <!-- Search Body Content -->
            <div class="max-h-[65vh] overflow-y-auto p-6 space-y-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(strlen(trim($query)) >= 2): ?>
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-hairline mb-4">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold">
                                Search Results (<?php echo e($results->count()); ?>)
                            </span>
                            <span class="text-[11px] text-muted">Showing instant matches</span>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($results->isNotEmpty()): ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a
                                        href="/products/<?php echo e($product->slug); ?>"
                                        wire:click="closeSearch"
                                        class="flex items-center gap-3.5 p-3 rounded-xl border border-hairline bg-surface-raised/40 hover:border-accent hover:bg-surface-raised transition duration-200 group"
                                    >
                                        <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-lg bg-surface-raised border border-hairline/60">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->primary_image): ?>
                                                <img src="<?php echo e($product->primary_image); ?>" alt="<?php echo e($product->name); ?>" class="h-full w-full object-cover">
                                            <?php else: ?>
                                                <div class="flex h-full w-full items-center justify-center text-muted">
                                                    <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'h-6 w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-6 w-6']); ?>
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
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-serif text-sm font-medium text-primary group-hover:text-accent truncate transition-colors">
                                                <?php echo e($product->name); ?>

                                            </h4>
                                            <p class="text-caption text-secondary truncate">
                                                <?php echo e($product->subtitle ?? $product->primary_category?->name); ?>

                                            </p>
                                            <div class="mt-1">
                                                <?php if (isset($component)) { $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.price','data' => ['price' => $product->getPriceMoney()->formatted(),'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->getPriceMoney()->formatted()),'size' => 'sm']); ?>
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
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-10 space-y-2">
                                <p class="font-serif text-lg text-primary">No botanical lots match “<?php echo e($query); ?>”</p>
                                <p class="text-caption text-secondary">Try searching for “Darjeeling”, “Saffron”, or “White Tea”.</p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php else: ?>
                    <!-- Popular Search Suggestions & Categories -->
                    <div class="space-y-6">
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-3">
                                Popular Curations
                            </span>
                            <div class="flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $popularSearches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button
                                        type="button"
                                        wire:click="selectPopular('<?php echo e($term); ?>')"
                                        class="px-3.5 py-1.5 rounded-full border border-hairline bg-surface-raised text-ui text-secondary hover:border-accent hover:text-accent hover:bg-surface-card transition duration-200"
                                    >
                                        <?php echo e($term); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredCategories->isNotEmpty()): ?>
                            <div class="pt-4 border-t border-hairline">
                                <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-3">
                                    Explore by Terroir
                                </span>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featuredCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a
                                            href="/collections/<?php echo e($cat->slug); ?>"
                                            wire:click="closeSearch"
                                            class="p-3 rounded-lg border border-hairline bg-surface-raised/40 text-center hover:border-accent hover:bg-surface-card transition group"
                                        >
                                            <span class="font-serif text-sm text-primary group-hover:text-accent block truncate">
                                                <?php echo e($cat->name); ?>

                                            </span>
                                            <span class="text-[10px] uppercase tracking-wider text-muted block mt-0.5">
                                                Explore Collection →
                                            </span>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Footer Shortcut Help -->
            <div class="border-t border-hairline bg-surface-raised/40 px-6 py-3 flex items-center justify-between text-[11px] text-muted">
                <span>Press <kbd class="px-1.5 py-0.5 rounded bg-surface-card border border-hairline font-mono text-[10px]">ESC</kbd> to close</span>
                <span>Direct-to-estate verified catalogue</span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/storefront/search-overlay.blade.php ENDPATH**/ ?>