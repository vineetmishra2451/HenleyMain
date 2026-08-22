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
$eyebrow = $payload['eyebrow'] ?? 'The Henley Philosophy';
$title = $payload['title'] ?? 'Handpicked, small batch, organically extracted.';
$body = $payload['body'] ?? "We believe tea should be approached the way a master perfumer approaches scent. We partner exclusively with high-altitude growers who reject industrial homogenization. Every leaf is plucked at dawn before mountain dew evaporates, preserving delicate volatile aromatic compounds that mass-market processing burns away.";
$author = $payload['author'] ?? 'Dr. Alistair Henley';
$authorTitle = $payload['author_title'] ?? 'Master Botanical Curator';
$ctaLabel = $payload['cta_label'] ?? 'Read Our Full Story';
$ctaUrl = $payload['cta_url'] ?? '/about';
$imageUrl = $payload['image_url'] ?? '/images/brand/product.jpeg';
$imageAlt = $payload['image_alt'] ?? 'Henley porcelain cloche packaging and botanical ritual';
?>

<section class="w-full bg-canvas py-16 sm:py-28 overflow-hidden">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <!-- Left: Large Lifestyle Image in Arched Apothecary Mask Frame -->
            <div class="lg:col-span-5 relative order-2 lg:order-1">
                <?php if (isset($component)) { $__componentOriginal74ac9fc1c8789f9091a50631f948f4db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.arch-frame','data' => ['variant' => 'default','aspect' => 'aspect-[4/5]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('arch-frame'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'default','aspect' => 'aspect-[4/5]']); ?>
                    <img
                        src="<?php echo e($imageUrl); ?>"
                        alt="<?php echo e($imageAlt); ?>"
                        loading="lazy"
                        width="800"
                        height="1000"
                        class="h-full w-full object-cover transition-transform duration-700 hover:scale-105"
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
            </div>

            <!-- Right: Brand Narrative & Proof -->
            <div class="lg:col-span-7 space-y-6 sm:space-y-8 order-1 lg:order-2">
                <div>
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
                </div>

                <h2 class="font-serif text-display-2 font-normal text-primary tracking-tight leading-tight">
                    <?php echo e($title); ?>

                </h2>

                <div class="space-y-4 text-body text-secondary leading-relaxed">
                    <p><?php echo e($body); ?></p>
                </div>

                <div class="pt-4 border-t border-hairline flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary block">
                            <?php echo e($author); ?>

                        </span>
                        <span class="text-caption text-secondary">
                            <?php echo e($authorTitle); ?>

                        </span>
                    </div>

                    <div>
                        <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => ''.e($ctaUrl).'','variant' => 'secondary','size' => 'md','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e($ctaUrl).'','variant' => 'secondary','size' => 'md','trailing-arrow' => true]); ?>
                            <?php echo e($ctaLabel); ?>

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
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/story-band.blade.php ENDPATH**/ ?>