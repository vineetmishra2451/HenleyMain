<div
    x-data="{
        isOpen: <?php if ((object) ('isOpen') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('isOpen'->value()); ?>')<?php echo e('isOpen'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('isOpen'); ?>')<?php endif; ?>,
        init() {
            window.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    this.isOpen = true;
                    $nextTick(() => $refs.searchInput.focus());
                }
                if (e.key === 'Escape' && this.isOpen) {
                    this.isOpen = false;
                    $wire.close();
                }
            });
        }
    }"
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 lg:p-20"
    role="dialog"
    aria-modal="true"
    aria-label="Catalogue Search"
    style="display: none;"
>
    <!-- Darkened Paper Backdrop -->
    <div
        class="fixed inset-0 bg-primary/50 backdrop-blur-md transition-opacity"
        x-on:click="isOpen = false; $wire.close()"
        aria-hidden="true"
    ></div>

    <!-- Search Modal Container -->
    <div class="relative mx-auto max-w-2xl rounded-2xl bg-surface-card border border-hairline shadow-2xl overflow-hidden transition-all">
        <!-- Search Input Bar -->
        <div class="relative flex items-center border-b border-hairline px-6 py-4">
            <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'w-5 h-5 text-secondary mr-3 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-secondary mr-3 flex-shrink-0']); ?>
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
                wire:model.live.debounce.300ms="query"
                type="search"
                placeholder="Search single origin, harvest year, or aromatic notes..."
                class="w-full bg-transparent text-primary placeholder:text-muted text-base focus:outline-none border-none ring-0 focus:ring-0"
            >

            <button
                type="button"
                x-on:click="isOpen = false; $wire.close()"
                aria-label="Close search overlay"
                class="text-muted hover:text-primary p-1.5 rounded-full hover:bg-surface-raised transition ml-2"
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

        <!-- Search Body -->
        <div class="p-6 max-h-[60vh] overflow-y-auto">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(strlen(trim($query)) < 2): ?>
                <!-- Empty State: Popular & Recent Searches -->
                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] uppercase tracking-[0.18em] font-semibold text-secondary block mb-3">
                            Popular Ritual Inquiries
                        </span>
                        <div class="flex flex-wrap gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $popularSearches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button
                                    type="button"
                                    wire:click="selectPopular('<?php echo e($term); ?>')"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-surface-raised border border-hairline text-caption text-primary hover:border-accent hover:text-accent transition duration-200 select-none cursor-pointer"
                                >
                                    <?php if (isset($component)) { $__componentOriginal4c316f3544fd858e5c71b5ef1159c026 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c316f3544fd858e5c71b5ef1159c026 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.sparkles','data' => ['class' => 'w-3 h-3 text-gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.sparkles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3 h-3 text-gold']); ?>
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
                                    <span><?php echo e($term); ?></span>
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-hairline/60 flex items-center justify-between text-caption text-secondary">
                        <span>Press <kbd class="px-2 py-0.5 rounded bg-surface-raised border border-hairline text-[10px] font-mono text-primary">ESC</kbd> to exit</span>
                        <span>Full catalog search active</span>
                    </div>
                </div>
            <?php else: ?>
                <!-- Results State -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-caption text-secondary pb-2 border-b border-hairline/60">
                        <span>Showing matches for "<strong class="text-primary"><?php echo e($query); ?></strong>"</span>
                        <span><?php echo e(count($results)); ?> results</span>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($results->isNotEmpty()): ?>
                        <div class="divide-y divide-hairline">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a
                                    href="/shop"
                                    class="flex items-center gap-4 py-3 group hover:bg-surface-raised/60 -mx-2 px-2 rounded-lg transition"
                                >
                                    <!-- Thumbnail -->
                                    <div class="w-12 h-12 rounded-md bg-surface-raised border border-hairline overflow-hidden flex-shrink-0 flex items-center justify-center">
                                        <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'w-6 h-6 text-muted']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 text-muted']); ?>
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

                                    <!-- Product Info -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-serif text-base text-primary group-hover:text-accent truncate transition-colors">
                                            <?php echo e($product->name); ?>

                                        </h4>
                                        <p class="text-caption text-secondary truncate">
                                            <?php echo e($product->subtitle ?? ($product->vendor->business_name ?? 'Henley Single-Origin')); ?>

                                        </p>
                                    </div>

                                    <!-- Price -->
                                    <div class="text-right flex-shrink-0">
                                        <?php if (isset($component)) { $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.price','data' => ['price' => $product->base_price,'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->base_price),'size' => 'sm']); ?>
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
                                        <span class="block text-[10px] text-sage font-medium">In Stock</span>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <!-- Zero Results -->
                        <div class="text-center py-8 space-y-2">
                            <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'w-8 h-8 text-muted mx-auto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-8 h-8 text-muted mx-auto']); ?>
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
                            <p class="text-body text-primary font-serif">No harvests found matching "<?php echo e($query); ?>"</p>
                            <p class="text-caption text-secondary">Try searching for Darjeeling, Saffron, Cardamom, or Silver Needle.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/storefront/search-overlay.blade.php ENDPATH**/ ?>