<footer class="bg-surface-raised border-t border-hairline pt-16 pb-12 text-primary" role="contentinfo">
    <div class="max-w-content mx-auto px-5 sm:px-8 lg:px-12 space-y-16">
        <!-- Top Section: Brand Manifesto & Newsletter Chamber -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 space-y-4">
                <?php if (isset($component)) { $__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.brand.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('brand.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b)): ?>
<?php $attributes = $__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b; ?>
<?php unset($__attributesOriginal01ddce07fdfaa1771f1dfaf8e4a4294b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b)): ?>
<?php $component = $__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b; ?>
<?php unset($__componentOriginal01ddce07fdfaa1771f1dfaf8e4a4294b); ?>
<?php endif; ?>
                <p class="font-serif text-2xl text-primary font-normal leading-snug">
                    Fifteen unhurried minutes stolen from the frantic churn of the world.
                </p>
                <p class="text-body text-secondary max-w-md">
                    Direct-to-consumer single-estate teas, restorative botanicals, and handpicked whole spices preserved in bone porcelain cloches.
                </p>
            </div>

            <div class="lg:col-span-7 bg-surface-card/60 p-6 sm:p-8 rounded-2xl border border-hairline space-y-4">
                <div class="space-y-1">
                    <?php if (isset($component)) { $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.eyebrow','data' => ['variant' => 'gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eyebrow'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold']); ?>The Inner Circle <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $attributes = $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $component = $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
                    <h3 class="font-serif text-xl text-primary font-normal">Receive First Access to Rare Micro-Lots</h3>
                </div>
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

        <!-- 1px Antique Gold Foil Rule -->
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

        <!-- Middle Section: Navigation Columns -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
            <!-- Column 1: Shop Collections -->
            <div class="space-y-4">
                <h4 class="font-sans text-xs uppercase tracking-[0.18em] font-semibold text-primary">
                    Shop Terroir
                </h4>
                <ul class="space-y-2.5 text-caption text-secondary">
                    <li><a href="/collections/single-origin-reserve" class="hover:text-accent transition-colors">First Flush Darjeeling</a></li>
                    <li><a href="/collections/single-origin-reserve" class="hover:text-accent transition-colors">Imperial Silver Needle</a></li>
                    <li><a href="/collections/herbal-botanicals" class="hover:text-accent transition-colors">Nilgiri Herbal Tisanes</a></li>
                    <li><a href="/collections/single-origin-reserve" class="hover:text-accent transition-colors">Malabar Green Cardamom</a></li>
                    <li><a href="/collections/single-origin-reserve" class="hover:text-accent transition-colors">Wild Kashmiri Saffron</a></li>
                    <li><a href="/collections/curated-gift-sets" class="hover:text-accent transition-colors">Curated Gift Cloches</a></li>
                </ul>
            </div>

            <!-- Column 2: House & Terroir -->
            <div class="space-y-4">
                <h4 class="font-sans text-xs uppercase tracking-[0.18em] font-semibold text-primary">
                    The House
                </h4>
                <ul class="space-y-2.5 text-caption text-secondary">
                    <li><a href="/pages/the-cloche-ritual" class="hover:text-accent transition-colors">The Cloche Ritual</a></li>
                    <li><a href="/pages/the-cloche-ritual" class="hover:text-accent transition-colors">Partner Estates</a></li>
                    <li><a href="/pages/the-cloche-ritual" class="hover:text-accent transition-colors">Biodynamic Standards</a></li>
                    <li><a href="/journal" class="hover:text-accent transition-colors">The Journal</a></li>
                    <li><a href="/pages/the-cloche-ritual" class="hover:text-accent transition-colors">Sustainability Commitments</a></li>
                </ul>
            </div>

            <!-- Column 3: Concierge & Support -->
            <div class="space-y-4">
                <h4 class="font-sans text-xs uppercase tracking-[0.18em] font-semibold text-primary">
                    Concierge
                </h4>
                <ul class="space-y-2.5 text-caption text-secondary">
                    <li><a href="/pages/shipping-returns" class="hover:text-accent transition-colors">Air Express Delivery</a></li>
                    <li><a href="/pages/shipping-returns" class="hover:text-accent transition-colors">Shipping & Returns</a></li>
                    <li><a href="/pages/faqs" class="hover:text-accent transition-colors">Steeping & Water Guide</a></li>
                    <li><a href="/pages/faqs" class="hover:text-accent transition-colors">Apothecary Care & FAQs</a></li>
                    <li><a href="mailto:concierge@henleytea.com" class="hover:text-accent transition-colors">Contact Concierge</a></li>
                </ul>
            </div>

            <!-- Column 4: Portals -->
            <div class="space-y-4">
                <h4 class="font-sans text-xs uppercase tracking-[0.18em] font-semibold text-primary">
                    Portals
                </h4>
                <ul class="space-y-2.5 text-caption text-secondary">
                    <li><a href="/login" class="hover:text-accent transition-colors">Collector Login</a></li>
                    <li><a href="/vendor" class="hover:text-accent transition-colors">Estate & Vendor Portal</a></li>
                    <li><a href="/admin" class="hover:text-accent transition-colors">Business Management</a></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->environment(['local', 'staging', 'testing'])): ?>
                        <li><a href="/design" class="hover:text-gold text-accent font-medium transition-colors">Design System (/design)</a></li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <!-- Column 5: Single-Origin Quality Seal -->
            <div class="col-span-2 md:col-span-4 lg:col-span-1 space-y-3">
                <div class="p-4 rounded-xl border border-hairline bg-surface-card text-center space-y-2">
                    <?php if (isset($component)) { $__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.shield-check','data' => ['class' => 'w-6 h-6 text-gold mx-auto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.shield-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 text-gold mx-auto']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2)): ?>
<?php $attributes = $__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2; ?>
<?php unset($__attributesOriginal4bd4abcc0b6a5d303dd619fff16100e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2)): ?>
<?php $component = $__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2; ?>
<?php unset($__componentOriginal4bd4abcc0b6a5d303dd619fff16100e2); ?>
<?php endif; ?>
                    <span class="font-sans text-xs uppercase tracking-wider font-semibold text-primary block">
                        Direct Sourcing Seal
                    </span>
                    <p class="text-[11px] text-secondary leading-snug">
                        Every cloche is serial-numbered and sealed at estate origin in India.
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom Bar: Payments & Copyright -->
        <div class="pt-8 border-t border-hairline flex flex-col md:flex-row items-center justify-between gap-6 text-xs text-secondary">
            <div class="flex flex-wrap items-center gap-4 text-caption">
                <span>© <?php echo e(date('Y')); ?> Henley Botanicals Private Limited. All rights reserved.</span>
                <span class="text-hairline" aria-hidden="true">•</span>
                <a href="/pages/privacy-policy" class="hover:text-accent transition-colors">Privacy Policy</a>
                <span class="text-hairline" aria-hidden="true">•</span>
                <a href="/pages/terms-of-service" class="hover:text-accent transition-colors">Terms of Ritual</a>
                <span class="text-hairline" aria-hidden="true">•</span>
                <span>GSTIN Registered (100% Traceable)</span>
            </div>

            <!-- Payment Badges (Clean text badges representing supported gateways) -->
            <div class="flex items-center gap-2 select-none" aria-label="Accepted Payment Methods">
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-[10px] font-bold text-primary tracking-wider uppercase">UPI</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-[10px] font-bold text-primary tracking-wider uppercase">RuPay</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-[10px] font-bold text-primary tracking-wider uppercase">Visa</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-[10px] font-bold text-primary tracking-wider uppercase">Mastercard</span>
                <span class="px-2.5 py-1 rounded bg-surface-card border border-hairline text-[10px] font-bold text-primary tracking-wider uppercase">Amex</span>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /var/www/html/resources/views/components/storefront/footer.blade.php ENDPATH**/ ?>