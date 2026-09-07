<footer class="bg-sand border-t border-border select-none">
    <div class="henley-container py-16 lg:py-20">

        <!-- ── Newsletter Block ───────────────────────────────── -->
        <div class="max-w-xl mx-auto text-center mb-16 lg:mb-20">
            <p class="text-eyebrow text-gold mb-3">Join the Henley Collector Circle</p>
            <h2 class="font-serif text-2xl lg:text-3xl text-charcoal mb-3">
                Stay in the Know
            </h2>
            <p class="text-sm text-charcoal/60 mb-6">
                Be the first to hear about new single-estate harvests, seasonal blends, and exclusive allocations. Pure leaf. Pure intent.
            </p>

            <livewire:storefront.newsletter-signup />
        </div>

        <!-- ── Link Columns ─────────────────────────────────── -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 pb-12 border-b border-border/60">
            <!-- Col 1: Collections -->
            <div>
                <h3 class="text-eyebrow text-charcoal mb-4">Collections</h3>
                <ul class="space-y-2.5">
                    <li>
                        <a href="/shop" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Explore the Reserve (22)
                        </a>
                    </li>
                    <li>
                        <a href="/collections?cat=tea" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Tea (2)
                        </a>
                    </li>
                    <li>
                        <a href="/collections?cat=herbs-spices" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Herbs & Spices (12)
                        </a>
                    </li>
                    <li>
                        <a href="/collections?cat=flours-grains" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Flours & Grains (4)
                        </a>
                    </li>
                    <li>
                        <a href="/collections?cat=cooking-essentials" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Cooking Essentials (3)
                        </a>
                    </li>
                    <li>
                        <a href="/collections?cat=cocoa" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Cocoa (1)
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 2: Company -->
            <div>
                <h3 class="text-eyebrow text-charcoal mb-4">Company</h3>
                <ul class="space-y-2.5">
                    <li>
                        <a href="/story" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            About & Our Story
                        </a>
                    </li>
                    <li>
                        <a href="/journal" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            The Botanical Journal
                        </a>
                    </li>
                    <li>
                        <a href="/contact" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Contact Concierge
                        </a>
                    </li>
                    <li>
                        <a href="/vendor/login" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Grower & Vendor Portal
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Support -->
            <div>
                <h3 class="text-eyebrow text-charcoal mb-4">Support</h3>
                <ul class="space-y-2.5">
                    <li>
                        <a href="/pages/faq" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            FAQ & Guidance
                        </a>
                    </li>
                    <li>
                        <a href="/pages/shipping-policy" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Shipping & Delivery
                        </a>
                    </li>
                    <li>
                        <a href="/orders" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Track Your Order
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Legal -->
            <div>
                <h3 class="text-eyebrow text-charcoal mb-4">Legal</h3>
                <ul class="space-y-2.5">
                    <li>
                        <a href="/pages/privacy-policy" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="/pages/terms-of-service" class="text-sm font-sans text-charcoal/60 hover:text-maroon transition-colors">
                            Terms of Service
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ── Bottom Row ───────────────────────────────────── -->
        <div class="pt-8 flex flex-col lg:flex-row items-center justify-between gap-6">
            <!-- Social icons -->
            <div class="flex items-center gap-4">
                @foreach (['Instagram' => 'I', 'Facebook' => 'F', 'Pinterest' => 'P', 'Twitter' => 'X'] as $platform => $initial)
                    <a
                        href="#"
                        class="w-9 h-9 rounded-full bg-ivory border border-border flex items-center justify-center text-charcoal/50 hover:text-maroon hover:border-maroon/30 transition-colors"
                        aria-label="{{ $platform }}"
                    >
                        <span class="text-xs font-sans font-semibold">
                            {{ $initial }}
                        </span>
                    </a>
                @endforeach
            </div>

            <!-- Payment icons -->
            <div class="flex flex-wrap items-center gap-2">
                @foreach (['UPI', 'Visa', 'MC', 'Amex', 'PayPal', 'Apple'] as $payment)
                    <div class="h-7 px-2.5 bg-ivory border border-border rounded-xs flex items-center justify-center">
                        <span class="text-[10px] font-sans font-medium text-charcoal/40 tracking-wide uppercase">
                            {{ $payment }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Copyright & Centered Logo -->
            <div class="flex items-center gap-3">
                <img
                    src="/brand/logo.png"
                    alt="HENLEY"
                    class="h-5 w-auto object-contain opacity-40 grayscale"
                >
                <p class="text-xs text-charcoal/50">
                    © {{ date('Y') }} Henley Herb & Spice. All rights reserved.
                </p>
            </div>
        </div>

    </div>
</footer>
