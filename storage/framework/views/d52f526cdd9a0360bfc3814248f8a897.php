<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => 'modal',
    'title' => null,
    'maxWidth' => 'md', // sm | md | lg | xl
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
    'name' => 'modal',
    'title' => null,
    'maxWidth' => 'md', // sm | md | lg | xl
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$maxWidthClasses = match ($maxWidth) {
    'sm' => 'sm:max-w-sm',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-2xl',
    default => 'sm:max-w-md',
};
?>

<div
    x-data="{
        open: false,
        lastFocused: null,
        toggle() {
            if (this.open) {
                this.close();
            } else {
                this.lastFocused = document.activeElement;
                this.open = true;
                $nextTick(() => {
                    let focusable = $el.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex=\'-1\'])');
                    if (focusable) focusable.focus();
                });
            }
        },
        close() {
            this.open = false;
            if (this.lastFocused) {
                this.lastFocused.focus();
            }
        }
    }"
    x-on:open-modal.window="if ($event.detail === '<?php echo e($name); ?>') toggle()"
    x-on:close-modal.window="if ($event.detail === '<?php echo e($name); ?>') close()"
    x-on:keydown.escape.window="if (open) close()"
    class="relative z-50"
    role="dialog"
    aria-modal="true"
    <?php if($title): ?> aria-labelledby="<?php echo e($name); ?>-title" <?php endif; ?>
    style="display: none;"
    x-show="open"
>
    <!-- Backdrop with soft paper blur -->
    <div
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-primary/40 backdrop-blur-sm transition-opacity"
        x-on:click="close()"
        aria-hidden="true"
    ></div>

    <!-- Dialog container -->
    <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 lg:p-8 flex items-center justify-center">
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full <?php echo e($maxWidthClasses); ?> rounded-2xl bg-surface-card p-6 sm:p-8 border border-hairline shadow-2xl transition-all"
        >
            <!-- Close Button -->
            <button
                type="button"
                x-on:click="close()"
                aria-label="Close dialog"
                class="absolute top-4 right-4 p-2 text-secondary hover:text-primary rounded-full hover:bg-surface-raised transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
            >
                <?php if (isset($component)) { $__componentOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6464b9a54d2bedc8c500f17bdd4af0b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.close','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title): ?>
                <h3 id="<?php echo e($name); ?>-title" class="font-serif text-display-3 font-normal text-primary mb-4 pr-8">
                    <?php echo e($title); ?>

                </h3>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="text-body text-primary">
                <?php echo e($slot); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/modal.blade.php ENDPATH**/ ?>