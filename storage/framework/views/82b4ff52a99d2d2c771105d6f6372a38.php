<footer class="w-full bg-surface-raised border-t border-hairline pt-16 pb-12 text-primary select-none">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-16">

        <!-- 1. Top Dispatch / Newsletter Band (with Gold Rule & Diamond Ornament) -->
        <div class="space-y-8">
            <?php if (isset($component)) { $__componentOriginal73a6b0261bc3d280b80775663eef6108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73a6b0261bc3d280b80775663eef6108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.divider','data' => ['variant' => 'gold','ornament' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('divider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold','ornament' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73a6b0261bc3d280b80775663eef6108)): ?>
<?php $attributes = $__attributesOriginal73a6b0261bc3d280b80775663eef6108; ?>
<?php unset($__attributesOriginal73a6b0261bc3d280b80775663eef6108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73a6b0261bc3d280b80775663eef6108)): ?>
<?php $component = $__componentOriginal73a6b0261bc3d280b80775663eef6108; ?>
<?php unset($__componentOriginal73a6b0261bc3d280b80775663eef6108); ?>
<?php endif; ?>

            <div class="max-w-2xl mx-auto text-center space-y-3">
                <?php if (isset($component)) { $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.eyebrow','data' => ['variant' => 'gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eyebrow'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold']); ?>
                    Private Allocation Dispatch
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
                <h3 class="font-serif text-display-2 font-normal text-primary tracking-tight">
                    Join the Henley Collector Circle
                </h3>
                <p class="text-body text-secondary leading-relaxed max-w-lg mx-auto">
                    Receive first notification when limited single-estate spring flushes and wild saffron reserves are bottled.
                </p>

                <!-- Livewire Newsletter Signup Component -->
                <div class="pt-3">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('storefront.newsletter-signup', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-223626384-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>

            <?php if (isset($component)) { $__componentOriginal73a6b0261bc3d280b80775663eef6108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73a6b0261bc3d280b80775663eef6108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.divider','data' => ['variant' => 'hairline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('divider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'hairline']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73a6b0261bc3d280b80775663eef6108)): ?>
<?php $attributes = $__attributesOriginal73a6b0261bc3d280b80775663eef6108; ?>
<?php unset($__attributesOriginal73a6b0261bc3d280b80775663eef6108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73a6b0261bc3d280b80775663eef6108)): ?>
<?php $component = $__componentOriginal73a6b0261bc3d280b80775663eef6108; ?>
<?php unset($__componentOriginal73a6b0261bc3d280b80775663eef6108); ?>
<?php endif; ?>
        </div>

        <!-- 2. Main Navigation Columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">

            <!-- Column 1: Brand Statement (2 cols on large screen) -->
            <div class="lg:col-span-2 space-y-4">
                <a href="/" class="inline-block">
                    <span class="font-serif text-3xl tracking-[0.22em] font-normal text-primary">
                        HENLEY
                    </span>
                </a>
                <p class="text-body text-secondary max-w-sm leading-relaxed">
                    Pure leaf. Pure intent. Henley approaches single-origin tea, botanicals, and spices with the restraint, precision, and quiet luxury of a fine fragrance house.
                </p>
                <div class="pt-2 text-caption text-secondary space-y-1">
                    <p>Concierge: <a href="mailto:concierge@henleytea.com" class="text-primary hover:text-accent underline decoration-hairline">concierge@henleytea.com</a></p>
                    <p>Estate Office: Kurseong Division, Darjeeling, WB 734203</p>
                </div>
            </div>

            <!-- Column 2: Shop -->
            <div class="space-y-3">
                <h4 class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary">
                    The Cellar
                </h4>
                <ul class="space-y-2.5 text-ui text-secondary">
                    <li><a href="/collections/single-origin-reserve" class="hover:text-accent transition-colors">First Flush Darjeeling</a></li>
                    <li><a href="/collections/imperial-white-tea" class="hover:text-accent transition-colors">Silver Needle White</a></li>
                    <li><a href="/collections/herbal-botanicals" class="hover:text-accent transition-colors">Nilgiri Herbal Elixirs</a></li>
                    <li><a href="/collections/kashmiri-saffron" class="hover:text-accent transition-colors">Wild Kashmiri Saffron</a></li>
                    <li><a href="/collections/curated-gift-sets" class="hover:text-accent transition-colors">Porcelain Gift Cloches</a></li>
                </ul>
            </div>

            <!-- Column 3: Company -->
            <div class="space-y-3">
                <h4 class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary">
                    Philosophy
                </h4>
                <ul class="space-y-2.5 text-ui text-secondary">
                    <li><a href="/about" class="hover:text-accent transition-colors">Our Story & Heritage</a></li>
                    <li><a href="/pages/estates-and-terroir" class="hover:text-accent transition-colors">Estates & Terroir</a></li>
                    <li><a href="/pages/the-cloche-ritual" class="hover:text-accent transition-colors">The Cloche Ritual</a></li>
                    <li><a href="/journal" class="hover:text-accent transition-colors">The Botanical Journal</a></li>
                    <li><a href="/vendor/login" class="hover:text-accent transition-colors">Estate & Grower Portal</a></li>
                </ul>
            </div>

            <!-- Column 4: Support & Concierge -->
            <div class="space-y-3">
                <h4 class="font-sans text-xs uppercase tracking-[0.16em] font-semibold text-primary">
                    Concierge
                </h4>
                <ul class="space-y-2.5 text-ui text-secondary">
                    <li><a href="/pages/faq" class="hover:text-accent transition-colors">Steeping & Care FAQ</a></li>
                    <li><a href="/pages/shipping-policy" class="hover:text-accent transition-colors">Express Shipping Policy</a></li>
                    <li><a href="/pages/returns-exchanges" class="hover:text-accent transition-colors">Returns & Guarantee</a></li>
                    <li><a href="/pages/contact" class="hover:text-accent transition-colors">Concierge Desk</a></li>
                    <li><a href="/pages/authenticity" class="hover:text-accent transition-colors">Certificate of Origin</a></li>
                </ul>
            </div>
        </div>

        <!-- 3. Bottom Bar: Payment Marks, Socials & Legal -->
        <div class="pt-8 border-t border-hairline flex flex-col md:flex-row items-center justify-between gap-6 text-caption text-secondary">
            <!-- Copyright -->
            <div>
                <p>© <?php echo e(date('Y')); ?> Henley Botanical Ltd. All rights reserved.</p>
            </div>

            <!-- Payment Badges (Clean Vector Typography Marks) -->
            <div class="flex items-center gap-3 text-[10px] tracking-wider uppercase font-semibold text-muted">
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-primary">UPI</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-primary">Visa</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-primary">Mastercard</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-primary">RuPay</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-primary">NetBanking</span>
            </div>

            <!-- Legal Policy Links -->
            <div class="flex items-center gap-4 text-xs">
                <a href="/pages/privacy-policy" class="hover:text-accent transition-colors">Privacy</a>
                <span>•</span>
                <a href="/pages/terms-of-service" class="hover:text-accent transition-colors">Terms</a>
                <span>•</span>
                <a href="/pages/shipping-policy" class="hover:text-accent transition-colors">Shipping</a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /var/www/html/resources/views/components/storefront/footer.blade.php ENDPATH**/ ?>