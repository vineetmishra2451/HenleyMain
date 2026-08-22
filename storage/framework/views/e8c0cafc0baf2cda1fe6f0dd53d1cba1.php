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
$headline = $payload['headline'] ?? 'Pure leaf. Pure intent.';
$subhead = $payload['subhead'] ?? 'Rare single-estate botanicals and high-grown spices preserved in bone-white porcelain cloche jars.';
$primaryCta = $payload['primary_cta'] ?? ['label' => 'Explore the Reserve', 'url' => '/collections/single-origin-reserve'];
$secondaryCta = $payload['secondary_cta'] ?? ['label' => 'The Cloche Ritual', 'url' => '/pages/the-cloche-ritual'];
$image = $payload['image'] ?? '/images/brand/homepage.jpeg';
?>

<section class="relative w-full bg-canvas overflow-hidden pt-8 pb-16 sm:py-20 lg:py-24">
    <?php if (isset($component)) { $__componentOriginala766c2d312d6f7864fe218e2500d2bba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala766c2d312d6f7864fe218e2500d2bba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.container','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('container'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left: Hero Editorial Statement -->
            <div class="lg:col-span-7 space-y-8 text-left">
                <div class="space-y-4">
                    <?php if (isset($component)) { $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.eyebrow','data' => ['variant' => 'accent','class' => 'text-xs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eyebrow'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'accent','class' => 'text-xs']); ?>
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

                    <h1 class="font-serif text-display-hero-mobile sm:text-display-hero text-primary font-normal leading-[1.05] tracking-tight">
                        <?php echo e($headline); ?>

                    </h1>

                    <p class="text-body-lead text-secondary max-w-xl font-light leading-relaxed">
                        <?php echo e($subhead); ?>

                    </p>
                </div>

                <!-- CTAs -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => $primaryCta['url'] ?? '/shop','variant' => 'primary','size' => 'lg','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($primaryCta['url'] ?? '/shop'),'variant' => 'primary','size' => 'lg','trailing-arrow' => true]); ?>
                        <?php echo e($primaryCta['label'] ?? 'Explore the Reserve'); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => $secondaryCta['url'] ?? '/pages/the-cloche-ritual','variant' => 'secondary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($secondaryCta['url'] ?? '/pages/the-cloche-ritual'),'variant' => 'secondary','size' => 'lg']); ?>
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

                <!-- Trust Proof Strip (Under Hero) -->
                <div class="pt-8 border-t border-hairline/80 flex flex-wrap items-center gap-6 sm:gap-8">
                    <div class="flex items-center gap-2">
                        <?php if (isset($component)) { $__componentOriginaldb675a6dde00eb87d0b1b6dc03730208 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb675a6dde00eb87d0b1b6dc03730208 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.rating','data' => ['rating' => 5.0,'showCount' => false,'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.rating'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rating' => 5.0,'show-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'size' => 'md']); ?>
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
                        <span class="text-caption font-semibold text-primary">5.0 / 5.0</span>
                    </div>

                    <div class="h-4 w-px bg-hairline hidden sm:block" aria-hidden="true"></div>

                    <div class="flex items-center gap-2 text-caption text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-sage" aria-hidden="true"></span>
                        <span>1,800m Altitude Terroir</span>
                    </div>

                    <div class="h-4 w-px bg-hairline hidden sm:block" aria-hidden="true"></div>

                    <div class="flex items-center gap-2 text-caption text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold" aria-hidden="true"></span>
                        <span>Nitrogen Hermetic Seal</span>
                    </div>
                </div>
            </div>

            <!-- Right: Hero Full-Bleed Cloche Visual (AVIF/WebP srcset with explicit dimensions for Zero CLS) -->
            <div class="lg:col-span-5 relative">
                <div class="relative w-full aspect-square sm:aspect-[4/5] rounded-2xl overflow-hidden bg-surface-raised border border-hairline shadow-subtle group">
                    <picture>
                        <source srcset="/images/brand/homepage.jpeg" type="image/jpeg">
                        <img
                            src="<?php echo e($image); ?>"
                            alt="Henley Bone-White Cloche Cylinder with Arched Apothecary Window"
                            width="960"
                            height="1200"
                            fetchpriority="high"
                            loading="eager"
                            class="h-full w-full object-cover object-center transition-transform duration-700 ease-henley group-hover:scale-105"
                        >
                    </picture>

                    <!-- Delicate Antique Gold Badge Foil Ring -->
                    <div class="absolute bottom-6 right-6 p-3 rounded-full bg-surface-card/90 backdrop-blur-sm border border-gold/40 shadow-sm flex items-center gap-2">
                        <?php if (isset($component)) { $__componentOriginal4c316f3544fd858e5c71b5ef1159c026 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c316f3544fd858e5c71b5ef1159c026 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.sparkles','data' => ['class' => 'w-4 h-4 text-gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.sparkles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 text-gold']); ?>
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
                        <span class="font-sans text-[10px] uppercase tracking-widest font-semibold text-gold-text">
                            First Flush 2026
                        </span>
                    </div>
                </div>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala766c2d312d6f7864fe218e2500d2bba)): ?>
<?php $attributes = $__attributesOriginala766c2d312d6f7864fe218e2500d2bba; ?>
<?php unset($__attributesOriginala766c2d312d6f7864fe218e2500d2bba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala766c2d312d6f7864fe218e2500d2bba)): ?>
<?php $component = $__componentOriginala766c2d312d6f7864fe218e2500d2bba; ?>
<?php unset($__componentOriginala766c2d312d6f7864fe218e2500d2bba); ?>
<?php endif; ?>
</section>
<?php /**PATH /var/www/html/resources/views/components/sections/hero.blade.php ENDPATH**/ ?>