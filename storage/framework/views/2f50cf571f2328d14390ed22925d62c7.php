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
$eyebrow = $payload['eyebrow'] ?? 'The Philosophy of Terroir';
$title = $payload['title'] ?? 'The Architecture of Purity';
$image = $payload['image'] ?? '/images/brand/productpage.jpeg';
?>

<section class="w-full bg-canvas py-20 sm:py-32 overflow-hidden">
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
            <!-- Left: Editorial Story Visual with Arched Frame -->
            <div class="lg:col-span-5 relative">
                <div class="relative w-full aspect-[4/5] rounded-arch overflow-hidden bg-surface-raised border border-hairline shadow-subtle group">
                    <img
                        src="<?php echo e($image); ?>"
                        alt="Henley Single-Estate Orthodox Leaf Processing"
                        loading="lazy"
                        class="h-full w-full object-cover object-center transition-transform duration-700 ease-henley group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <!-- Right: Editorial Narrative -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <?php if (isset($component)) { $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.eyebrow','data' => ['variant' => 'accent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eyebrow'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'accent']); ?>
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

                <h2 class="font-serif text-display-2-mobile sm:text-display-2 text-primary font-normal leading-tight">
                    <?php echo e($title); ?>

                </h2>

                <div class="space-y-4 text-body text-secondary leading-relaxed font-light">
                    <p>
                        Henley approaches tea the way a fine fragrance house approaches scent. We reject industrial blending, synthetic flavorings, and dusty warehouse storage.
                    </p>
                    <p>
                        Every harvest is hand-picked during peak diurnal shifts on exclusive micro-lots at altitudes between 1,200m and 2,200m. Preserved immediately in UV-shielded bone porcelain cloche jars, the volatile monoterpenes and floral muscatel esters remain pristine until unboxed in your sanctuary.
                    </p>
                </div>

                <div class="pt-4 flex items-center gap-6">
                    <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => '/pages/the-cloche-ritual','variant' => 'primary','size' => 'md','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '/pages/the-cloche-ritual','variant' => 'primary','size' => 'md','trailing-arrow' => true]); ?>
                        Discover the Cloche Ritual
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

                    <a href="/journal" class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-secondary hover:text-accent transition-colors">
                        Read Journal ↗
                    </a>
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
<?php /**PATH /var/www/html/resources/views/components/sections/story-band.blade.php ENDPATH**/ ?>