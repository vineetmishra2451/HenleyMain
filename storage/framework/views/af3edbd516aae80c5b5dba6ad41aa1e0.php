<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'text' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'link' => '/collections/single-origin-reserve',
    'dismissible' => true,
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
    'text' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'link' => '/collections/single-origin-reserve',
    'dismissible' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="{
        dismissed: localStorage.getItem('henley_announcement_dismissed') === 'true',
        dismiss() {
            this.dismissed = true;
            localStorage.setItem('henley_announcement_dismissed', 'true');
        }
    }"
    x-show="!dismissed"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 max-h-12"
    x-transition:leave-end="opacity-0 max-h-0"
    class="relative bg-surface-dark text-inverse text-xs tracking-wider py-2.5 px-4 overflow-hidden z-40 border-b border-hairline/20"
>
    <div class="max-w-content mx-auto flex items-center justify-between">
        <div class="flex-1 text-center font-sans font-light text-[11px] sm:text-xs tracking-[0.08em]">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($link): ?>
                <a href="<?php echo e($link); ?>" class="hover:text-gold transition-colors inline-flex items-center gap-1.5 group">
                    <span><?php echo e($text); ?></span>
                    <span class="inline-block transition-transform duration-200 group-hover:translate-x-0.5 text-gold">→</span>
                </a>
            <?php else: ?>
                <span><?php echo e($text); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dismissible): ?>
            <button
                type="button"
                x-on:click="dismiss()"
                aria-label="Dismiss announcement"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-muted hover:text-inverse p-1 rounded transition"
            >
                <?php if (isset($component)) { $__componentOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.close','data' => ['class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5']); ?>
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
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/storefront/announcement-bar.blade.php ENDPATH**/ ?>