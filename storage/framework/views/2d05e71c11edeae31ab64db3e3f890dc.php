<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'navItems' => [],
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
    'navItems' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$items = !empty($navItems) ? $navItems : [
    ['label' => 'Shop All', 'url' => '/shop'],
    [
        'label' => 'Collections',
        'url' => '/collections',
        'children' => [
            ['label' => 'Single-Estate Black Teas', 'url' => '/collections/single-origin-reserve'],
            ['label' => 'Rare White & Green Teas', 'url' => '/collections/single-origin-reserve'],
            ['label' => 'Restorative Botanicals', 'url' => '/collections/herbal-botanicals'],
            ['label' => 'Wild Whole Spices', 'url' => '/collections/single-origin-reserve'],
        ]
    ],
    ['label' => 'Herbal & Spices', 'url' => '/collections/herbal-botanicals'],
    ['label' => 'Curated Gifts', 'url' => '/collections/curated-gift-sets'],
    ['label' => 'Our Story & Terroir', 'url' => '/pages/the-cloche-ritual'],
    ['label' => 'The Journal', 'url' => '/journal'],
];
?>

<?php if (isset($component)) { $__componentOriginale67024a204ba6be83f3556a31cc49b4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67024a204ba6be83f3556a31cc49b4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.drawer','data' => ['name' => 'mobile-nav','side' => 'left','title' => 'HENLEY','maxWidth' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('drawer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mobile-nav','side' => 'left','title' => 'HENLEY','max-width' => 'sm']); ?>
    <div class="flex flex-col h-full justify-between space-y-8">
        <!-- Search Trigger in Mobile Drawer -->
        <div>
            <button
                type="button"
                x-on:click="$dispatch('close-drawer', 'mobile-nav'); $dispatch('open-search')"
                class="w-full flex items-center justify-between p-3 rounded-full border border-hairline bg-surface-raised text-secondary text-caption hover:border-accent transition"
            >
                <span class="inline-flex items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $attributes = $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $component = $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
                    <span>Search harvest or origin...</span>
                </span>
                <span class="text-[10px] uppercase font-mono tracking-widest text-muted">Cmd+K</span>
            </button>
        </div>

        <!-- Navigation Links Accordion -->
        <nav class="space-y-4" aria-label="Mobile Navigation">
            <?php if (isset($component)) { $__componentOriginalf37c7fa867bbb37ca7b59380c8fa1d1e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf37c7fa867bbb37ca7b59380c8fa1d1e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.accordion','data' => ['type' => 'single']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('accordion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'single']); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($item['children'])): ?>
                        <?php if (isset($component)) { $__componentOriginaldfa6063183d585340d4025fcf91b1b48 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfa6063183d585340d4025fcf91b1b48 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.accordion-item','data' => ['title' => $item['label']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('accordion-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['label'])]); ?>
                            <ul class="space-y-2.5 pl-2 pt-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a
                                            href="<?php echo e($child['url']); ?>"
                                            class="block text-body text-secondary hover:text-accent transition-colors"
                                        >
                                            <?php echo e($child['label']); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldfa6063183d585340d4025fcf91b1b48)): ?>
<?php $attributes = $__attributesOriginaldfa6063183d585340d4025fcf91b1b48; ?>
<?php unset($__attributesOriginaldfa6063183d585340d4025fcf91b1b48); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldfa6063183d585340d4025fcf91b1b48)): ?>
<?php $component = $__componentOriginaldfa6063183d585340d4025fcf91b1b48; ?>
<?php unset($__componentOriginaldfa6063183d585340d4025fcf91b1b48); ?>
<?php endif; ?>
                    <?php else: ?>
                        <div class="py-3 border-b border-hairline/60">
                            <a
                                href="<?php echo e($item['url']); ?>"
                                class="font-serif text-display-3 font-normal text-primary hover:text-accent transition-colors block"
                            >
                                <?php echo e($item['label']); ?>

                            </a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf37c7fa867bbb37ca7b59380c8fa1d1e)): ?>
<?php $attributes = $__attributesOriginalf37c7fa867bbb37ca7b59380c8fa1d1e; ?>
<?php unset($__attributesOriginalf37c7fa867bbb37ca7b59380c8fa1d1e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf37c7fa867bbb37ca7b59380c8fa1d1e)): ?>
<?php $component = $__componentOriginalf37c7fa867bbb37ca7b59380c8fa1d1e; ?>
<?php unset($__componentOriginalf37c7fa867bbb37ca7b59380c8fa1d1e); ?>
<?php endif; ?>
        </nav>

        <!-- Mobile Drawer Concierge & Footer Info -->
        <div class="space-y-4 pt-6 border-t border-hairline text-caption text-secondary">
            <div class="space-y-1">
                <span class="text-[10px] uppercase tracking-[0.18em] font-semibold text-primary block">Henley Concierge</span>
                <p>concierge@henleytea.com</p>
                <p>+91 800 HENLEY (436539)</p>
            </div>

            <div class="flex items-center justify-between pt-2">
                <span>Currency: <strong class="text-primary">INR (₹)</strong></span>
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'sage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'sage']); ?>Direct Sourced <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67024a204ba6be83f3556a31cc49b4d)): ?>
<?php $attributes = $__attributesOriginale67024a204ba6be83f3556a31cc49b4d; ?>
<?php unset($__attributesOriginale67024a204ba6be83f3556a31cc49b4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67024a204ba6be83f3556a31cc49b4d)): ?>
<?php $component = $__componentOriginale67024a204ba6be83f3556a31cc49b4d; ?>
<?php unset($__componentOriginale67024a204ba6be83f3556a31cc49b4d); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/storefront/mobile-nav.blade.php ENDPATH**/ ?>