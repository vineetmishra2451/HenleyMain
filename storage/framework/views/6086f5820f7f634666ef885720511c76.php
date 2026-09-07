<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'payload' => [],
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
    'payload' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$eyebrow = $payload['eyebrow'] ?? 'OUR PROMISE';
$title = $payload['title'] ?? 'Why Henley?';
$description = $payload['description'] ?? 'We go beyond the ordinary to bring you teas that are pure, mindful, and exceptional in every way.';
$taglinePrimary = $payload['tagline_primary'] ?? 'PURE LEAF. PURE INTENT.';
$taglineSecondary = $payload['tagline_secondary'] ?? 'Diet the Health of Life';
$imageUrl = $payload['image_url'] ?? '/images/brand/why_henley.png';
$imageAlt = $payload['image_alt'] ?? 'Henley single-estate porcelain cloche canister with botanical leaves and spices';

$pillars = $payload['pillars'] ?? [
    [
        'icon' => 'leaf',
        'title' => 'Organic Leaves',
        'description' => 'Handpicked tea leaves grown in organic gardens, nurturing nature and your well-being.',
    ],
    [
        'icon' => 'cycle',
        'title' => 'Small Batch Processing',
        'description' => 'Carefully crafted in small batches to preserve the natural flavor and goodness.',
    ],
    [
        'icon' => 'flask',
        'title' => 'No Artificial Additives',
        'description' => 'No artificial flavors, colors, or preservatives. Just pure leaves, nothing more.',
    ],
    [
        'icon' => 'sparkles',
        'title' => 'Rich in Antioxidants',
        'description' => 'Naturally rich in antioxidants that help you stay refreshed, revitalized, and balanced.',
    ],
];
?>

<section class="w-full bg-[#F7F4EE] py-20 sm:py-28 border-y border-[#E8E1D5]">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-14 sm:space-y-18">
        
        <!-- Top Split Grid: Brand Narrative & Cloche Visual -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            
            <!-- Left Column: Copy & Ethos -->
            <div class="lg:col-span-7 space-y-6 sm:space-y-7">
                <!-- Eyebrow with Botanical Leaf and Separator Line -->
                <div class="flex items-center gap-3">
                    <span class="font-sans text-xs uppercase tracking-[0.24em] font-semibold text-[#B28746]">
                        <?php echo e($eyebrow); ?>

                    </span>
                    <span class="w-10 h-px bg-[#B28746]/50 inline-block"></span>
                    <?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => 'w-4 h-4 text-[#B28746]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 text-[#B28746]']); ?>
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
                </div>

                <!-- Main Display Heading -->
                <h2 class="font-serif text-4xl sm:text-5xl lg:text-[3.75rem] font-normal text-[#2A1418] tracking-tight leading-[1.10]">
                    <?php echo e($title); ?>

                </h2>

                <!-- Subheading Description -->
                <p class="text-base sm:text-lg text-[#61544B] leading-relaxed max-w-xl font-sans font-normal">
                    <?php echo e($description); ?>

                </p>

                <!-- Brand Sub-bullets & Mottos -->
                <div class="pt-2 flex flex-wrap items-center gap-3 text-xs sm:text-sm">
                    <span class="inline-flex items-center gap-1.5 text-xs uppercase tracking-[0.20em] font-semibold text-[#B28746]">
                        <?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => 'w-3.5 h-3.5 text-[#B28746]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5 text-[#B28746]']); ?>
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
                        <?php echo e($taglinePrimary); ?>

                    </span>
                    <span class="text-[#8C7E74]">•</span>
                    <span class="font-serif italic text-[#61544B] text-sm sm:text-base">
                        <?php echo e($taglineSecondary); ?>

                    </span>
                </div>
            </div>

            <!-- Right Column: Framed Editorial Artwork -->
            <div class="lg:col-span-5 flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[360px] sm:max-w-[400px]">
                    <div class="relative overflow-hidden rounded-3xl bg-[#ECE7DC] shadow-[0_20px_48px_-16px_rgba(42,20,24,0.16)] border border-[#E0D7C7] transition-all duration-500 hover:scale-[1.01] hover:shadow-[0_24px_54px_-16px_rgba(42,20,24,0.22)]">
                        <img
                            src="<?php echo e($imageUrl); ?>"
                            alt="<?php echo e($imageAlt); ?>"
                            loading="lazy"
                            width="700"
                            height="630"
                            class="w-full h-auto object-cover block"
                        />
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom 4 Pillar Cards Grid (2x2 on Mobile, 4x1 on Desktop) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 pt-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pillars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $icon = $pillar['icon'] ?? 'leaf';
                    $pTitle = $pillar['title'] ?? '';
                    $pDesc = $pillar['description'] ?? '';
                ?>
                <div class="group relative bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-7 lg:p-8 border border-[#E8E1D5] shadow-[0_4px_24px_-4px_rgba(42,20,24,0.04)] hover:shadow-[0_14px_36px_-6px_rgba(42,20,24,0.10)] hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center justify-between min-h-[220px] sm:min-h-[270px]">
                    
                    <!-- Circular Icon Badge -->
                    <div class="w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-[#F4F0E6] border border-[#E5DEC6]/80 flex items-center justify-center mb-3 sm:mb-5 text-[#5C2225] group-hover:bg-[#FAECEB] group-hover:border-[#5C2225]/25 transition-colors duration-300">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon === 'leaf'): ?>
                            <?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => 'w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]']); ?>
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
                        <?php elseif($icon === 'cycle' || $icon === 'refresh' || $icon === 'small_batch'): ?>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                <path d="M3 3v5h5"/>
                                <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
                                <path d="M16 16h5v5"/>
                            </svg>
                        <?php elseif($icon === 'flask' || $icon === 'beaker' || $icon === 'no_additives'): ?>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 2v6.292a1 1 0 0 1-.2.6l-5.6 7.466A2 2 0 0 0 5.8 19.5h12.4a2 2 0 0 0 1.6-3.142l-5.6-7.466a1 1 0 0 1-.2-.6V2"/>
                                <path d="M8.5 2h7"/>
                                <path d="M7 14h10"/>
                            </svg>
                        <?php elseif($icon === 'sparkles' || $icon === 'antioxidant'): ?>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8L12 2z"/>
                                <path d="M19 4v4m2-2h-4"/>
                            </svg>
                        <?php else: ?>
                            <?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => 'w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 sm:w-6 sm:h-6 text-[#5C2225]']); ?>
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
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Card Body Content -->
                    <div class="space-y-1.5 sm:space-y-3 flex-1 flex flex-col justify-center">
                        <h3 class="font-serif text-base sm:text-xl lg:text-2xl font-normal text-[#2A1418] tracking-tight leading-snug">
                            <?php echo e($pTitle); ?>

                        </h3>
                        <p class="text-xs sm:text-sm text-[#61544B] leading-relaxed font-sans font-normal line-clamp-3 sm:line-clamp-none">
                            <?php echo e($pDesc); ?>

                        </p>
                    </div>

                    <!-- Subtle Centered Botanical Leaf Accent -->
                    <div class="pt-3 sm:pt-6 mt-auto">
                        <?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => 'w-3.5 h-3.5 text-[#B28746]/40 group-hover:text-[#B28746] transition-colors duration-300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5 text-[#B28746]/40 group-hover:text-[#B28746] transition-colors duration-300']); ?>
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
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/why-henley.blade.php ENDPATH**/ ?>