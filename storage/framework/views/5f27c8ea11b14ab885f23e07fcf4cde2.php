<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'payload' => [],
    'posts' => null,
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
    'posts' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$eyebrow = $payload['eyebrow'] ?? 'The Botanical Journal';
$title = $payload['title'] ?? 'Field Notes & Brewing Alchemy';
$description = $payload['description'] ?? 'Essays on high-altitude terroir, aromatic chemistry, and the unhurried ritual of tea extraction.';
$limit = (int) ($payload['limit'] ?? 3);

$items = $posts ?? \App\Models\JournalPost::where('is_published', true)
    ->latest('published_at')
    ->take($limit)
    ->get();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($items->isNotEmpty()): ?>
    <section class="w-full bg-canvas py-16 sm:py-24 overflow-hidden">
        <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-12">
            <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => $eyebrow,'title' => $title,'description' => $description,'align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($eyebrow),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($description),'align' => 'center']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $attributes = $__attributesOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__attributesOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal755230460fd16c04121658d92fbf99f7)): ?>
<?php $component = $__componentOriginal755230460fd16c04121658d92fbf99f7; ?>
<?php unset($__componentOriginal755230460fd16c04121658d92fbf99f7); ?>
<?php endif; ?>

            <div class="flex items-center justify-between md:hidden -mt-6 mb-1">
                <span class="text-caption text-secondary/70">Swipe field notes →</span>
            </div>

            <!-- Mobile Horizontal Swipe Scroller & Desktop Grid -->
            <div class="flex overflow-x-auto no-scrollbar snap-x snap-mandatory gap-5 pb-4 -mx-5 px-5 sm:mx-0 sm:px-0 md:grid md:grid-cols-3 md:gap-8 md:overflow-visible md:pb-0">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="group flex flex-col justify-between rounded-2xl border border-hairline bg-surface-raised/40 overflow-hidden hover:border-muted hover:shadow-hover transition-all duration-350 w-[285px] sm:w-[320px] md:w-auto flex-shrink-0 snap-start">
                        <div>
                            <!-- Cover Image -->
                            <div class="aspect-[16/10] w-full overflow-hidden bg-surface-raised">
                                <img
                                    src="<?php echo e($post->cover_image ? '/' . ltrim($post->cover_image, '/') : \App\Services\PlaceholderService::url('journal_cover', $post->id)); ?>"
                                    alt="<?php echo e($post->title); ?>"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                >
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center justify-between text-caption text-secondary">
                                    <span><?php echo e($post->published_at ? $post->published_at->format('M d, Y') : 'Recent Dispatch'); ?></span>
                                    <span><?php echo e($post->reading_time_minutes); ?> min read</span>
                                </div>

                                <h3 class="font-serif text-xl font-normal text-primary group-hover:text-accent transition-colors leading-snug">
                                    <a href="/journal/<?php echo e($post->slug); ?>">
                                        <?php echo e($post->title); ?>

                                    </a>
                                </h3>

                                <p class="text-body text-secondary line-clamp-2 leading-relaxed">
                                    <?php echo e($post->excerpt); ?>

                                </p>
                            </div>
                        </div>

                        <div class="px-6 pb-6 pt-2">
                            <a href="/journal/<?php echo e($post->slug); ?>" class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-accent group-hover:text-accent-hover inline-flex items-center gap-1.5">
                                <span>Read Essay</span>
                                <span class="inline-block transition-transform duration-250 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="text-center pt-4">
                <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => '/journal','variant' => 'secondary','size' => 'md','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '/journal','variant' => 'secondary','size' => 'md','trailing-arrow' => true]); ?>
                    Read The Complete Botanical Journal
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
    </section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/journal-preview.blade.php ENDPATH**/ ?>