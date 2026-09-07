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
$eyebrow = $payload['eyebrow'] ?? 'The Art of Infusion';
$title = $payload['title'] ?? 'The Henley Ritual';
$description = $payload['description'] ?? 'Four mindful movements to awaken delicate floral bouquets, essential terpenes, and the authentic single-estate character of your harvest.';
$tagline = $payload['tagline'] ?? 'Where mountain spring meets virgin leaf.';
$imageUrl = $payload['image_url'] ?? '/pimages/tea.jpg';
$imageAlt = $payload['image_alt'] ?? 'Henley whole orthodox tea leaves infusing in clear mountain spring water';
$ctaLabel = $payload['cta_label'] ?? 'Explore Loose-Leaf Harvests';
$ctaUrl = $payload['cta_url'] ?? '/collections';
$guideLabel = $payload['guide_label'] ?? 'Discover Apothecary Teaware';
$guideUrl = $payload['guide_url'] ?? '/collections/accessories';

$parameters = $payload['parameters'] ?? [
    [
        'label' => 'Pure Spring Water',
        'value' => '200 ml',
        'note' => 'Sub-boiling mineral water',
    ],
    [
        'label' => 'Thermal Precision',
        'value' => '85°C / 185°F',
        'note' => 'Protects delicate oils',
    ],
    [
        'label' => 'The Cloche Measure',
        'value' => '2.5g Scoop',
        'note' => 'Unbroken whole leaf',
    ],
    [
        'label' => 'Infusion Duration',
        'value' => '3 Minutes',
        'note' => 'Up to 3 re-steepings',
    ],
];

$steps = $payload['steps'] ?? [
    [
        'step' => '01',
        'name' => 'The Cloche Dose',
        'parameter' => '2.5g · Whole Orthodox Leaf',
        'icon' => 'scale',
        'description' => 'Measure unbroken orthodox leaves into pre-warmed porcelain or glass teaware. Inhale the dry bouquet — capturing notes of wild spring blossoms, dried apricot, and high-altitude mountain pine.',
    ],
    [
        'step' => '02',
        'name' => 'Thermal Precision',
        'parameter' => '85°C (185°F) · Spring Water',
        'icon' => 'temperature',
        'description' => 'Bring soft mountain spring water to a gentle simmer and rest for sixty seconds. Sub-boiling warmth coaxes out ethereal floral terpenes and vitamins without scorching or extracting bitter tannins.',
    ],
    [
        'step' => '03',
        'name' => 'The Unhurried Steep',
        'parameter' => '3 Minutes · Quietude',
        'icon' => 'clock',
        'description' => 'Pour in slow concentric circles over the leaves. Cover and rest for three quiet minutes as the curled needles gently unfurl, releasing a radiant, crystal-clear golden amber liquor.',
    ],
    [
        'step' => '04',
        'name' => 'The Evolving Infusions',
        'parameter' => 'Up to 3 Sequential Steeps',
        'icon' => 'sparkles',
        'description' => 'Never discard pristine orthodox leaves after a single cup. Second and third steepings unlock deeper tertiary notes — roasted chestnut, wild honey, and lingering mineral sweetness.',
    ],
];
?>

<section class="w-full bg-[#FAF8F5] py-20 sm:py-28 border-t border-[#E8E1D5] overflow-hidden" id="henley-ritual">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-14 sm:space-y-18">
        
        <!-- Section Header with Botanical Emblem -->
        <div class="text-center max-w-2xl mx-auto space-y-4">
            <div class="inline-flex items-center justify-center gap-3">
                <span class="w-8 h-px bg-[#B28746]/50 inline-block"></span>
                <span class="font-sans text-xs uppercase tracking-[0.24em] font-semibold text-[#B28746]">
                    <?php echo e($eyebrow); ?>

                </span>
                <span class="w-8 h-px bg-[#B28746]/50 inline-block"></span>
            </div>

            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-normal text-[#2A1418] tracking-tight leading-[1.12]">
                <?php echo e($title); ?>

            </h2>

            <p class="font-sans text-base sm:text-lg text-[#61544B] leading-relaxed font-normal">
                <?php echo e($description); ?>

            </p>
        </div>

        <!-- Metric Parameters Quick Band -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white/85 backdrop-blur-xs rounded-2xl p-5 border border-[#E8E1D5] shadow-[0_4px_20px_-8px_rgba(42,20,24,0.06)] hover:border-[#B28746]/50 transition-all duration-300">
                    <p class="text-[11px] uppercase tracking-[0.16em] font-medium text-[#8C7E74] mb-1">
                        <?php echo e($param['label']); ?>

                    </p>
                    <p class="font-serif text-2xl sm:text-3xl text-[#2A1418] font-normal tracking-tight">
                        <?php echo e($param['value']); ?>

                    </p>
                    <p class="text-xs text-[#B28746] font-sans mt-1">
                        <?php echo e($param['note']); ?>

                    </p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Main Split: Arch Visual on Left & 4 Ritual Movements on Right -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center pb-6">
            
            <!-- Left Column: Visual Steeping Canvas in Arch Frame -->
            <div class="lg:col-span-5 flex flex-col items-center">
                <div class="relative w-full max-w-[340px] sm:max-w-[390px] mb-12 sm:mb-14 lg:mb-0">
                    
                    <!-- Decorative Background Halo Glow -->
                    <div class="absolute -inset-4 bg-gradient-to-tr from-[#B28746]/15 via-transparent to-[#2A1418]/5 rounded-[40px] blur-xl opacity-70"></div>

                    <!-- Arch-framed Visual -->
                    <div class="relative">
                        <?php if (isset($component)) { $__componentOriginal74ac9fc1c8789f9091a50631f948f4db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.arch-frame','data' => ['variant' => 'tall','class' => 'shadow-[0_24px_50px_-16px_rgba(42,20,24,0.22)] border border-[#E0D7C7]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('arch-frame'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'tall','class' => 'shadow-[0_24px_50px_-16px_rgba(42,20,24,0.22)] border border-[#E0D7C7]']); ?>
                            <img
                                src="<?php echo e($imageUrl); ?>"
                                alt="<?php echo e($imageAlt); ?>"
                                loading="lazy"
                                width="600"
                                height="800"
                                class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                            />
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $attributes = $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $component = $__componentOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>

                        <!-- Floating Sensory Badge -->
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-[90%] bg-white/95 backdrop-blur-md rounded-xl p-3.5 border border-[#E8E1D5] shadow-lg text-center">
                            <p class="text-xs uppercase tracking-[0.18em] font-semibold text-[#B28746] flex items-center justify-center gap-1.5">
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
                                Single-Origin Terroir
                            </p>
                            <p class="font-serif text-sm italic text-[#2A1418] mt-0.5">
                                &ldquo;<?php echo e($tagline); ?>&rdquo;
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: 4 Ritual Movements -->
            <div class="lg:col-span-7 space-y-5 sm:space-y-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group bg-white/90 rounded-2xl p-6 sm:p-7 border border-[#E8E1D5] shadow-[0_6px_24px_-10px_rgba(42,20,24,0.06)] hover:shadow-[0_12px_32px_-12px_rgba(42,20,24,0.12)] hover:border-[#B28746]/60 transition-all duration-300">
                        <div class="flex items-start gap-4 sm:gap-5">
                            
                            <!-- Gold Numbered Badge -->
                            <div class="shrink-0 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-[#FAF4EB] border border-[#B28746]/40 flex items-center justify-center text-[#B28746] font-serif text-lg font-semibold shadow-xs group-hover:bg-[#B28746] group-hover:text-white transition-colors duration-300">
                                <?php echo e($step['step']); ?>

                            </div>

                            <!-- Content Details -->
                            <div class="flex-1 space-y-1.5">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <h3 class="font-serif text-xl sm:text-2xl text-[#2A1418] font-normal">
                                        <?php echo e($step['name']); ?>

                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#F5EFE4] text-[#8A6329] border border-[#E5DAC6]">
                                        <?php echo e($step['parameter']); ?>

                                    </span>
                                </div>
                                <p class="text-sm sm:text-base text-[#61544B] leading-relaxed font-sans">
                                    <?php echo e($step['description']); ?>

                                </p>
                            </div>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

        </div>

        <!-- Bottom Action CTA Band -->
        <div class="pt-6 border-t border-[#E8E1D5] flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <div class="space-y-1">
                <p class="font-serif text-xl text-[#2A1418]">
                    Begin your mindful steeping practice.
                </p>
                <p class="text-sm text-[#61544B]">
                    Each Henley selection includes estate provenance notes and custom steeping guides.
                </p>
            </div>

            <div class="flex flex-wrap items-center justify-center sm:justify-end gap-4">
                <a
                    href="<?php echo e($ctaUrl); ?>"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-full text-sm font-medium tracking-wide bg-[#2A1418] text-[#F7F4EE] hover:bg-[#3D1C24] transition-colors duration-200 shadow-sm gap-2 group"
                >
                    <span><?php echo e($ctaLabel); ?></span>
                    <?php if (isset($component)) { $__componentOriginal37a3f047daccd28b87517bd215a12923 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal37a3f047daccd28b87517bd215a12923 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.arrow-right','data' => ['class' => 'w-4 h-4 text-[#B28746] group-hover:translate-x-0.5 transition-transform']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.arrow-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 text-[#B28746] group-hover:translate-x-0.5 transition-transform']); ?>
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

                <a
                    href="<?php echo e($guideUrl); ?>"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-full text-sm font-medium tracking-wide text-[#2A1418] border border-[#2A1418]/20 hover:border-[#2A1418] hover:bg-white/80 transition-all duration-200"
                >
                    <?php echo e($guideLabel); ?>

                </a>
            </div>
        </div>

    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/brewing-ritual.blade.php ENDPATH**/ ?>