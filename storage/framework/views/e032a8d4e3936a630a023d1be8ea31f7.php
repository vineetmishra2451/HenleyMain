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
$eyebrow = $payload['eyebrow'] ?? 'Our Promise';
$title = $payload['title'] ?? "From Leaf to Cup,\nWith Intention.";
$imageUrl = $payload['image_url'] ?? '/pimages/2.jpg';
$imageAlt = $payload['image_alt'] ?? 'Henley — Our Process';
$ctaLabel = $payload['cta_label'] ?? 'Learn More';
$ctaUrl = $payload['cta_url'] ?? '/story';
?>

<section class="py-16 lg:py-24 bg-sand/30">
    <div class="henley-container">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
            <!-- ArchFrame image -->
            <div class="flex-1 flex justify-center">
                <div class="w-full max-w-[280px] sm:max-w-[320px]">
                    <?php if (isset($component)) { $__componentOriginal74ac9fc1c8789f9091a50631f948f4db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.arch-frame','data' => ['variant' => 'tall','class' => 'shadow-card']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('arch-frame'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'tall','class' => 'shadow-card']); ?>
                        <img
                            src="<?php echo e($imageUrl); ?>"
                            alt="<?php echo e($imageAlt); ?>"
                            loading="lazy"
                            class="w-full h-full object-cover object-center transition-transform duration-700 hover:scale-105"
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
            </div>

            <!-- Copy -->
            <div class="flex-1 max-w-lg text-center lg:text-left">
                <p class="text-eyebrow text-gold mb-3"><?php echo e($eyebrow); ?></p>
                <h2 class="font-serif text-2xl lg:text-3xl text-charcoal leading-snug mb-4">
                    <?php echo nl2br(e($title)); ?>

                </h2>
                <p class="text-charcoal/60 text-base leading-relaxed mb-3">
                    At Henley, we believe in purity, transparency, and gifting wellness through nature&apos;s finest. Every blend is hand-selected from organic farms, slow-dried to preserve essential oils, and packed in small batches to ensure peak freshness.
                </p>
                <p class="text-charcoal/60 text-base leading-relaxed mb-8">
                    Our apothecary-inspired tins are designed to be beautiful enough to keep and refill — because sustainability should never sacrifice style.
                </p>
                <a
                    href="<?php echo e($ctaUrl); ?>"
                    class="inline-flex items-center gap-2 text-sm font-sans font-medium text-maroon hover:text-maroon-dark transition-colors group"
                >
                    <span><?php echo e($ctaLabel); ?></span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/story-band.blade.php ENDPATH**/ ?>