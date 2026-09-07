<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'payload' => [],
    'activeCoupon' => null,
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
    'activeCoupon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$active = $activeCoupon ?? \App\Models\Coupon::active()->first();
$code = $payload['code'] ?? ($active?->code ?? 'WELCOME10');
$title = $payload['title'] ?? ($active?->description ?? '10% Off Your First Order');
$eyebrow = $payload['eyebrow'] ?? 'Welcome Offer';
$description = $payload['description'] ?? 'Use code WELCOME10 at checkout. Handcrafted teas & fresh-ground spices delivered to your door.';
$ctaLabel = $payload['cta_label'] ?? 'Shop Now →';
$ctaUrl = $payload['cta_url'] ?? '/shop';
?>

<section class="bg-maroon text-ivory">
    <div class="henley-container py-12 lg:py-16">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8 text-center lg:text-left">
            <!-- Copy -->
            <div class="max-w-lg">
                <p class="text-eyebrow text-gold mb-2"><?php echo e($eyebrow); ?></p>
                <h2 class="font-serif text-2xl lg:text-3xl text-ivory leading-snug mb-2">
                    <?php echo e($title); ?>

                </h2>
                <p class="text-ivory/60 text-sm">
                    <?php echo e($description); ?>

                </p>
            </div>

            <!-- Code chip + CTA -->
            <div
                x-data="{
                    copied: false,
                    copyCode() {
                        if (navigator && navigator.clipboard) {
                            navigator.clipboard.writeText('<?php echo e($code); ?>');
                        }
                        this.copied = true;
                        setTimeout(() => { this.copied = false }, 2000);
                    }
                }"
                class="flex flex-col sm:flex-row items-center gap-4"
            >
                <!-- Clipboard code chip -->
                <button
                    type="button"
                    x-on:click="copyCode()"
                    class="group flex items-center gap-2.5 px-5 py-3 bg-ivory/10 border border-ivory/20 rounded-full hover:bg-ivory/15 transition-colors cursor-pointer"
                >
                    <span class="font-mono text-sm font-semibold text-gold tracking-widest">
                        <?php echo e($code); ?>

                    </span>
                    <span class="w-px h-4 bg-ivory/20"></span>
                    <template x-if="copied">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-emerald-400" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5" />
                        </svg>
                    </template>
                    <template x-if="!copied">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-ivory/50 group-hover:text-ivory transition-colors" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" />
                            <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" />
                        </svg>
                    </template>
                </button>

                <a
                    href="<?php echo e($ctaUrl); ?>"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-full text-xs font-sans font-medium uppercase tracking-wider bg-ivory text-maroon hover:bg-sand transition-colors cursor-pointer shadow-subtle"
                >
                    <?php echo e($ctaLabel); ?>

                </a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/storefront/sections/offers.blade.php ENDPATH**/ ?>