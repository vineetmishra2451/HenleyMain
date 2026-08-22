<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary', // primary | secondary | ghost | destructive
    'size' => 'md', // sm | md | lg
    'href' => '#',
    'trailingArrow' => false,
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
    'variant' => 'primary', // primary | secondary | ghost | destructive
    'size' => 'md', // sm | md | lg
    'href' => '#',
    'trailingArrow' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$baseClasses = 'inline-flex items-center justify-center font-sans font-medium uppercase tracking-[0.16em] rounded-full transition-all duration-250 ease-henley focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent group select-none no-underline';

$sizeClasses = match ($size) {
    'sm' => 'text-[11px] px-4 py-2 gap-1.5',
    'md' => 'text-[13px] px-6 py-3 gap-2',
    'lg' => 'text-[14px] px-8 py-4 gap-2.5',
    default => 'text-[13px] px-6 py-3 gap-2',
};

$variantClasses = match ($variant) {
    'primary' => 'bg-accent text-inverse hover:bg-accent-hover active:bg-accent-deep shadow-none',
    'secondary' => 'bg-transparent text-primary border border-hairline hover:border-accent hover:text-accent active:bg-surface-raised',
    'ghost' => 'bg-transparent text-secondary hover:text-accent hover:bg-surface-raised active:bg-hairline/40',
    'destructive' => 'bg-error text-inverse hover:opacity-90 active:opacity-100',
    default => 'bg-accent text-inverse hover:bg-accent-hover active:bg-accent-deep',
};

$classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
?>

<a
    href="<?php echo e($href); ?>"
    <?php echo e($attributes->merge(['class' => $classes])); ?>

>
    <?php echo e($slot); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trailingArrow): ?>
        <span class="inline-block transition-transform duration-250 ease-henley group-hover:translate-x-1" aria-hidden="true">→</span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</a>
<?php /**PATH /var/www/html/resources/views/components/link-button.blade.php ENDPATH**/ ?>