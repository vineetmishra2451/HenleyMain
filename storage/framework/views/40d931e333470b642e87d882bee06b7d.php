<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'author' => null,
    'title' => null,
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
    'author' => null,
    'title' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<figure <?php echo e($attributes->merge(['class' => 'my-12 relative max-w-3xl mx-auto text-center px-6 py-10 bg-surface-raised/40 rounded-2xl border border-hairline'])); ?>>
    <!-- Delicate gold quotation glyph -->
    <div class="font-serif text-5xl text-gold/60 leading-none select-none mb-3" aria-hidden="true">“</div>

    <blockquote class="font-serif text-display-3 text-primary italic font-normal leading-snug">
        <?php echo e($slot); ?>

    </blockquote>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($author): ?>
        <figcaption class="mt-6 flex flex-col items-center">
            <cite class="not-italic font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary">
                <?php echo e($author); ?>

            </cite>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title): ?>
                <span class="font-sans text-caption text-secondary mt-0.5">
                    <?php echo e($title); ?>

                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </figcaption>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</figure>
<?php /**PATH /var/www/html/resources/views/components/blockquote.blade.php ENDPATH**/ ?>