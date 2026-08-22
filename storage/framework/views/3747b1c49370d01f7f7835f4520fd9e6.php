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
$eyebrow = $payload['eyebrow'] ?? 'Spring 2026 First Flush Release';
$headline = $payload['headline'] ?? 'Pure leaf. Pure intent. Fifteen quiet minutes for the senses.';
$subhead = $payload['subhead'] ?? 'Rare single-estate orthodox teas and whole spices hand-harvested at 1,800 metres and sealed in UV-blocking porcelain cloche jars.';
$primaryCta = $payload['primary_cta'] ?? ['label' => 'Explore the Reserve', 'url' => '/collections'];
$secondaryCta = $payload['secondary_cta'] ?? ['label' => 'The Cloche Ritual', 'url' => '/about'];
$proofPoints = $payload['proof_points'] ?? ['1,850m Single Estate', 'First Flush 2026', '100% Biodynamic'];
$rating = (float) ($payload['rating'] ?? 5.0);
$ratingCount = (int) ($payload['rating_count'] ?? 148);
$imageUrl = $payload['image_url'] ?? '/images/brand/homepage.jpeg';
$imageAlt = $payload['image_alt'] ?? 'Henley bone-white porcelain cloche jar revealing golden saffron and whole leaf tea';
?>

<section class="relative w-full overflow-hidden bg-canvas pt-8 pb-16 sm:pt-12 sm:pb-24 border-b border-hairline">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <!-- Left Column: Editorial Statement (7 cols) -->
            <div class="lg:col-span-7 space-y-6 sm:space-y-8">
                <!-- Eyebrow Tag -->
                <div>
                    <?php if (isset($component)) { $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.eyebrow','data' => ['variant' => 'gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eyebrow'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold']); ?>
                        <?php echo e($eyebrow); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $attributes = $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $component = $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
                </div>

                <!-- 2-Line Desktop Serif Headline with balanced line wrapping -->
                <h1 class="font-serif text-display-1-mobile sm:text-display-hero font-normal text-primary tracking-tight leading-[1.08]">
                    <?php echo e($headline); ?>

                </h1>

                <!-- Subtitle / Positioning Narrative -->
                <p class="text-body-lead text-secondary max-w-xl font-light leading-relaxed">
                    <?php echo e($subhead); ?>

                </p>

                <!-- Action CTA Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => ''.e($primaryCta['url']).'','variant' => 'primary','size' => 'lg','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e($primaryCta['url']).'','variant' => 'primary','size' => 'lg','trailing-arrow' => true]); ?>
                        <?php echo e($primaryCta['label']); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $attributes = $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $component = $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($secondaryCta['label'])): ?>
                        <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => ''.e($secondaryCta['url']).'','variant' => 'secondary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e($secondaryCta['url']).'','variant' => 'secondary','size' => 'lg']); ?>
                            <?php echo e($secondaryCta['label']); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $attributes = $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $component = $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Trust Line: 5-Star Rating & 3 Proof Points -->
                <div class="pt-6 border-t border-hairline/80 flex flex-wrap items-center gap-y-3 gap-x-6 text-caption text-secondary">
                    <div class="flex items-center gap-2">
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

                    <div class="flex items-center gap-3 text-xs uppercase tracking-wider font-medium text-primary">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $proofPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-1 h-1 rounded-full bg-gold" aria-hidden="true"></span>
                                <?php echo e($proof); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Hero Visual Cloche (5 cols) with LQIP blur-up and explicit dimensions -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Subtle Arch Frame Motif -->
                    <?php if (isset($component)) { $__componentOriginal74ac9fc1c8789f9091a50631f948f4db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.arch-frame','data' => ['variant' => 'gold-rim','aspect' => 'aspect-[4/5]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('arch-frame'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold-rim','aspect' => 'aspect-[4/5]']); ?>
                        <img
                            src="<?php echo e($imageUrl); ?>"
                            alt="<?php echo e($imageAlt); ?>"
                            width="800"
                            height="1000"
                            fetchpriority="high"
                            loading="eager"
                            class="h-full w-full object-cover object-center transition-transform duration-700 hover:scale-105"
                        >
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

                    <!-- Floating Quality Proof Seal Badge -->
                    <div class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-6 p-4 rounded-2xl bg-surface-card border border-hairline shadow-card-hover flex items-center gap-3 select-none">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gold-surface border border-gold/30 text-gold-text">
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
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest font-bold text-gold-text block">Hermetic Cloche</span>
                            <span class="text-caption text-primary font-serif font-medium">Volatile Terpenes Sealed</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/hero.blade.php ENDPATH**/ ?>