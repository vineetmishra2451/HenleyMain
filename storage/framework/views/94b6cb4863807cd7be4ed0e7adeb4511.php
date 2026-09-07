<?php if (isset($component)) { $__componentOriginal44d534d96db5531bb2e6f0c033e2d36e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44d534d96db5531bb2e6f0c033e2d36e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.design','data' => ['title' => 'Henley — Living Component Gallery & Design System']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.design'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Henley — Living Component Gallery & Design System']); ?>
    <div class="min-h-screen bg-canvas text-primary flex">
        <!-- Sticky Left Sidebar Index (Desktop) -->
        <aside class="hidden lg:block w-72 h-screen sticky top-0 overflow-y-auto border-r border-hairline bg-surface-raised/60 p-6 z-30">
            <div class="space-y-6">
                <!-- Brand Masthead -->
                <div class="pb-6 border-b border-hairline">
                    <span class="font-serif text-2xl font-normal tracking-tight text-primary">HENLEY</span>
                    <div class="mt-1">
                        <?php if (isset($component)) { $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.eyebrow','data' => ['variant' => 'accent','class' => 'text-[10px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eyebrow'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'accent','class' => 'text-[10px]']); ?>Living Design System <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $attributes = $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $component = $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
                    </div>
                </div>

                <!-- Navigation Index -->
                <nav class="space-y-1 text-xs uppercase tracking-[0.14em] font-medium" aria-label="Component sections">
                    <a href="#foundations" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">01. Foundations</a>
                    <a href="#typography" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">02. Typography</a>
                    <a href="#actions" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">03. Actions & Buttons</a>
                    <a href="#forms" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">04. Form Controls</a>
                    <a href="#layout" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">05. Layout & Dividers</a>
                    <a href="#content" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">06. Editorial Content</a>
                    <a href="#commerce" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">07. Commerce Elements</a>
                    <a href="#feedback" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">08. Overlays & Feedback</a>
                    <a href="#navigation" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">09. Navigation & Disclosure</a>
                    <a href="#media" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">10. Media & Apothecary Arch</a>
                    <a href="#icons" class="block px-3 py-2 rounded-lg text-secondary hover:text-accent hover:bg-surface-raised transition">11. Line Iconography</a>
                </nav>

                <!-- Environment & Accessibility Badges -->
                <div class="pt-6 border-t border-hairline space-y-2">
                    <div class="flex items-center justify-between text-caption text-secondary">
                        <span>Environment</span>
                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'sage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'sage']); ?><?php echo e(app()->environment()); ?> <?php echo $__env->renderComponent(); ?>
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
                    <div class="flex items-center justify-between text-caption text-secondary">
                        <span>WCAG 2.1</span>
                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold']); ?>Level AA / AAA <?php echo $__env->renderComponent(); ?>
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
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 w-full overflow-x-hidden">
            <!-- Header Bar -->
            <header class="border-b border-hairline bg-surface-raised/40 px-6 sm:px-12 py-6 sticky top-0 z-20 backdrop-blur-md flex items-center justify-between">
                <div>
                    <h1 class="font-serif text-display-3 font-normal text-primary">Henley Design System</h1>
                    <p class="font-sans text-caption text-secondary mt-0.5">Semantic tokens, atomic components, and living visual standards</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/" class="text-xs uppercase tracking-widest font-semibold text-secondary hover:text-accent transition">
                        Storefront ↗
                    </a>
                </div>
            </header>

            <div class="px-6 sm:px-12 lg:px-16 py-12 max-w-7xl mx-auto space-y-24">

                <!-- ------------------------------------------------------------------- -->
                <!-- 01. FOUNDATIONS                                                     -->
                <!-- ------------------------------------------------------------------- -->
                <section id="foundations" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '01. Brand Foundations','title' => 'Semantic Color Roles & Surface Hierarchy','description' => 'Henley rejects stark cold grays and synthetic shadows. Depth is created via warm paper transitions and calibrated contrast ratios.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '01. Brand Foundations','title' => 'Semantic Color Roles & Surface Hierarchy','description' => 'Henley rejects stark cold grays and synthetic shadows. Depth is created via warm paper transitions and calibrated contrast ratios.','align' => 'left']); ?>
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

                    <!-- Color Swatches Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Canvas Base -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3 shadow-none">
                            <div class="h-16 w-full rounded-lg bg-canvas border border-hairline"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Canvas Base</span>
                                <span class="text-caption text-secondary">bg-canvas • #FBF9F6</span>
                                <span class="text-[11px] text-accent block mt-1">15.98:1 AAA vs Primary</span>
                            </div>
                        </div>

                        <!-- Raised Surface -->
                        <div class="p-4 rounded-xl border border-hairline bg-surface-raised space-y-3">
                            <div class="h-16 w-full rounded-lg bg-surface-raised border border-hairline"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Surface Raised</span>
                                <span class="text-caption text-secondary">bg-surface-raised • #F5F3EF</span>
                                <span class="text-[11px] text-accent block mt-1">15.15:1 AAA vs Primary</span>
                            </div>
                        </div>

                        <!-- Accent Oxblood -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-accent"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Oxblood (Primary Action)</span>
                                <span class="text-caption text-secondary">bg-accent • #5C2225</span>
                                <span class="text-[11px] text-accent block mt-1">12.28:1 AAA vs White</span>
                            </div>
                        </div>

                        <!-- Saffron -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-saffron"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Saffron (Product Star)</span>
                                <span class="text-caption text-secondary">bg-saffron • #A6332F</span>
                                <span class="text-[11px] text-accent block mt-1">6.37:1 AA vs Canvas</span>
                            </div>
                        </div>

                        <!-- Antique Gold -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-gold"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Antique Gold (Foil Only)</span>
                                <span class="text-caption text-secondary">border-gold • #B08B4F</span>
                                <span class="text-[11px] text-accent block mt-1">3.00:1 UI AA Non-Text</span>
                            </div>
                        </div>

                        <!-- Sage -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-sage"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Sage (Botanical & Stock)</span>
                                <span class="text-caption text-secondary">bg-sage • #7F8A6E</span>
                                <span class="text-[11px] text-accent block mt-1">8.12:1 AAA (text over pill)</span>
                            </div>
                        </div>

                        <!-- Hairline Neutral -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-hairline"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Hairline Neutral</span>
                                <span class="text-caption text-secondary">border-hairline • #E5DFD6</span>
                                <span class="text-[11px] text-secondary block mt-1">Structural 1px separator</span>
                            </div>
                        </div>

                        <!-- Surface Dark -->
                        <div class="p-4 rounded-xl border border-hairline bg-canvas space-y-3">
                            <div class="h-16 w-full rounded-lg bg-surface-dark"></div>
                            <div>
                                <span class="font-sans text-xs uppercase tracking-wider font-semibold block text-primary">Surface Dark</span>
                                <span class="text-caption text-secondary">bg-surface-dark • #1D1714</span>
                                <span class="text-[11px] text-accent block mt-1">High contrast sections</span>
                            </div>
                        </div>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 02. TYPOGRAPHY                                                      -->
                <!-- ------------------------------------------------------------------- -->
                <section id="typography" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '02. Typographic Scale','title' => 'Display Serif & Grotesque Pairing','description' => 'Self-hosted Cormorant Garamond provides fragrance-house editorial refinement, balanced by Plus Jakarta Sans for precision UI controls.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '02. Typographic Scale','title' => 'Display Serif & Grotesque Pairing','description' => 'Self-hosted Cormorant Garamond provides fragrance-house editorial refinement, balanced by Plus Jakarta Sans for precision UI controls.','align' => 'left']); ?>
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

                    <div class="space-y-6 rounded-2xl border border-hairline bg-surface-raised p-6 sm:p-10 divide-y divide-hairline">
                        <div class="pb-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display Hero (56px / 3.5rem)</span>
                            <div class="font-serif text-display-hero text-primary leading-tight">
                                Pure leaf. Pure intent.
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display 1 (42px / 2.625rem)</span>
                            <div class="font-serif text-display-1 text-primary leading-tight">
                                First Flush Darjeeling — Castleton Lot 04
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display 2 (32px / 2.0rem)</span>
                            <div class="font-serif text-display-2 text-primary">
                                The Unhurried Ritual of Single-Estate Botanicals
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Display 3 (24px / 1.5rem)</span>
                            <div class="font-serif text-display-3 text-primary">
                                Imperial Silver Needle White Tea
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Price Hero & Price Card</span>
                            <div class="flex items-center gap-8">
                                <div>
                                    <span class="text-[11px] text-secondary block">Hero Price:</span>
                                    <?php if (isset($component)) { $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.price','data' => ['price' => '3800','compareAtPrice' => '4200','size' => 'hero']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['price' => '3800','compare-at-price' => '4200','size' => 'hero']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329)): ?>
<?php $attributes = $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329; ?>
<?php unset($__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329)): ?>
<?php $component = $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329; ?>
<?php unset($__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329); ?>
<?php endif; ?>
                                </div>
                                <div>
                                    <span class="text-[11px] text-secondary block">Card Price:</span>
                                    <?php if (isset($component)) { $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.price','data' => ['price' => '1450','size' => 'card']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['price' => '1450','size' => 'card']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329)): ?>
<?php $attributes = $__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329; ?>
<?php unset($__attributesOriginal64a0a8f7c4f2ef02c9529c4eed890329); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329)): ?>
<?php $component = $__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329; ?>
<?php unset($__componentOriginal64a0a8f7c4f2ef02c9529c4eed890329); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="py-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Body Lead & Standard Body (18px & 16px)</span>
                            <p class="text-body-lead text-secondary mb-2">
                                Hand-harvested during the first seventy-two hours of Himalayan spring thaw at an elevation of 1,800 meters.
                            </p>
                            <p class="text-body text-primary">
                                Every batch is packed within 24 hours of firing into porcelain cloche jars, protecting volatile monoterpenes and floral muscatel esters.
                            </p>
                        </div>

                        <div class="pt-6">
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Eyebrow & Badge</span>
                            <div class="flex items-center gap-4">
                                <?php if (isset($component)) { $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.eyebrow','data' => ['variant' => 'accent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eyebrow'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'accent']); ?>Single Estate • Spring 2026 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $attributes = $__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__attributesOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff)): ?>
<?php $component = $__componentOriginal2fd4850bfa2168af367e79900fb8c8ff; ?>
<?php unset($__componentOriginal2fd4850bfa2168af367e79900fb8c8ff); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'sage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'sage']); ?>100% Biodynamic <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold']); ?>Bestseller <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'saffron']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'saffron']); ?>Limited Harvest <?php echo $__env->renderComponent(); ?>
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
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 03. ACTIONS & BUTTONS                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="actions" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '03. Interactive Controls','title' => 'Actions, Buttons & Tactile States','description' => 'Buttons use oxblood fills, hairline outlines, and responsive hover transitions with a signature 3px trailing arrow motion.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '03. Interactive Controls','title' => 'Actions, Buttons & Tactile States','description' => 'Buttons use oxblood fills, hairline outlines, and responsive hover transitions with a signature 3px trailing arrow motion.','align' => 'left']); ?>
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

                    <!-- Variants & Sizes Grid -->
                    <div class="p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised space-y-8">
                        <!-- Primary Buttons with Trailing Arrow -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Primary Variant (Oxblood Fill)</span>
                            <div class="flex flex-wrap items-center gap-4">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','trailing-arrow' => true]); ?>Add to Ritual <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','trailing-arrow' => true]); ?>Explore Harvest <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'sm','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'sm','trailing-arrow' => true]); ?>Quick Add <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','loading' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','loading' => true]); ?>Processing <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'md','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md','disabled' => true]); ?>Sold Out <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                            </div>
                        </div>

                        <!-- Secondary Buttons -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Secondary Variant (Hairline Outline)</span>
                            <div class="flex flex-wrap items-center gap-4">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'lg']); ?>View Tasting Notes <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md']); ?>Filter Catalog <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'sm']); ?>Select Size <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'md','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'md','disabled' => true]); ?>Unavailable <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                            </div>
                        </div>

                        <!-- Ghost & Destructive -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Ghost & Destructive</span>
                            <div class="flex flex-wrap items-center gap-4">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'ghost','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'md']); ?>Clear All Filters <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'destructive','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'destructive','size' => 'md']); ?>Remove Item <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => '#foundations','variant' => 'secondary','size' => 'sm','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#foundations','variant' => 'secondary','size' => 'sm','trailing-arrow' => true]); ?>Back to Top <?php echo $__env->renderComponent(); ?>
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

                        <!-- Icon Buttons -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-4">Icon Buttons</span>
                            <div class="flex items-center gap-4">
                                <?php if (isset($component)) { $__componentOriginal658398a0e73a18931bb7def04d911f42 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal658398a0e73a18931bb7def04d911f42 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon-button','data' => ['label' => 'Add to Wishlist','variant' => 'secondary','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Add to Wishlist','variant' => 'secondary','size' => 'md']); ?>
                                    <?php if (isset($component)) { $__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.heart','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.heart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2)): ?>
<?php $attributes = $__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2; ?>
<?php unset($__attributesOriginala8a696c0067ca4fbabcc40e90c22e3a2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2)): ?>
<?php $component = $__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2; ?>
<?php unset($__componentOriginala8a696c0067ca4fbabcc40e90c22e3a2); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $attributes = $__attributesOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__attributesOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $component = $__componentOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__componentOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal658398a0e73a18931bb7def04d911f42 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal658398a0e73a18931bb7def04d911f42 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon-button','data' => ['label' => 'Shopping Bag','variant' => 'primary','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Shopping Bag','variant' => 'primary','size' => 'md']); ?>
                                    <?php if (isset($component)) { $__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.bag','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.bag'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1)): ?>
<?php $attributes = $__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1; ?>
<?php unset($__attributesOriginale1c1330eb97ebb7060a80b1e4dec53b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1)): ?>
<?php $component = $__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1; ?>
<?php unset($__componentOriginale1c1330eb97ebb7060a80b1e4dec53b1); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $attributes = $__attributesOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__attributesOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $component = $__componentOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__componentOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal658398a0e73a18931bb7def04d911f42 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal658398a0e73a18931bb7def04d911f42 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon-button','data' => ['label' => 'Search','variant' => 'ghost','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Search','variant' => 'ghost','size' => 'md']); ?>
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
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $attributes = $__attributesOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__attributesOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $component = $__componentOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__componentOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal658398a0e73a18931bb7def04d911f42 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal658398a0e73a18931bb7def04d911f42 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon-button','data' => ['label' => 'Filter','variant' => 'secondary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Filter','variant' => 'secondary','size' => 'sm']); ?>
                                    <?php if (isset($component)) { $__componentOriginalfa68024704d8dee6dbc8b7204baf31f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.filter','data' => ['class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8)): ?>
<?php $attributes = $__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8; ?>
<?php unset($__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa68024704d8dee6dbc8b7204baf31f8)): ?>
<?php $component = $__componentOriginalfa68024704d8dee6dbc8b7204baf31f8; ?>
<?php unset($__componentOriginalfa68024704d8dee6dbc8b7204baf31f8); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $attributes = $__attributesOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__attributesOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal658398a0e73a18931bb7def04d911f42)): ?>
<?php $component = $__componentOriginal658398a0e73a18931bb7def04d911f42; ?>
<?php unset($__componentOriginal658398a0e73a18931bb7def04d911f42); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 04. FORM CONTROLS                                                   -->
                <!-- ------------------------------------------------------------------- -->
                <section id="forms" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '04. Forms & Input Wells','title' => 'Calibrated Form Architecture','description' => 'Form inputs utilize high-contrast pure white wells against the warm paper canvas, with saffron error announcements.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '04. Forms & Input Wells','title' => 'Calibrated Form Architecture','description' => 'Form inputs utilize high-contrast pure white wells against the warm paper canvas, with saffron error announcements.','align' => 'left']); ?>
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

                    <div class="p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'full_name','label' => 'Full Name','placeholder' => 'Lady Margaret Henley','hint' => 'As you would like it inscribed on certificate','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'full_name','label' => 'Full Name','placeholder' => 'Lady Margaret Henley','hint' => 'As you would like it inscribed on certificate','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'email_error','label' => 'Email Address','value' => 'invalid-email-format','error' => 'Please enter a valid email address.','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'email_error','label' => 'Email Address','value' => 'invalid-email-format','error' => 'Please enter a valid email address.','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['name' => 'flush_season','label' => 'Harvest Season','options' => [
                                    'first_flush' => 'First Flush (Early Spring)',
                                    'second_flush' => 'Second Flush (Muscatel Summer)',
                                    'autumnal' => 'Autumnal Harvest (Rich & Roasted)'
                                ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'flush_season','label' => 'Harvest Season','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                    'first_flush' => 'First Flush (Early Spring)',
                                    'second_flush' => 'Second Flush (Muscatel Summer)',
                                    'autumnal' => 'Autumnal Harvest (Rich & Roasted)'
                                ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>

                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-[0.14em] text-primary mb-1.5">Search Catalogue</label>
                                <?php if (isset($component)) { $__componentOriginal894294112bf23c4166443c90d4833959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal894294112bf23c4166443c90d4833959 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.search-input','data' => ['value' => 'Darjeeling Spring']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 'Darjeeling Spring']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal894294112bf23c4166443c90d4833959)): ?>
<?php $attributes = $__attributesOriginal894294112bf23c4166443c90d4833959; ?>
<?php unset($__attributesOriginal894294112bf23c4166443c90d4833959); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal894294112bf23c4166443c90d4833959)): ?>
<?php $component = $__componentOriginal894294112bf23c4166443c90d4833959; ?>
<?php unset($__componentOriginal894294112bf23c4166443c90d4833959); ?>
<?php endif; ?>
                            </div>
                        </div>

                        <?php if (isset($component)) { $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.textarea','data' => ['name' => 'gift_note','label' => 'Apothecary Gift Inscription','placeholder' => 'Add a personalized calligraphy message to accompany your gift cloche...','rows' => '3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'gift_note','label' => 'Apothecary Gift Inscription','placeholder' => 'Add a personalized calligraphy message to accompany your gift cloche...','rows' => '3']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $attributes = $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $component = $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>

                        <!-- Variant Radio Cards -->
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-3">Variant Selector (Radio Cards)</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <?php if (isset($component)) { $__componentOriginalc119ab304b0acc50df538c1be3ba2e0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.radio-card','data' => ['name' => 'packaging_variant','value' => 'jar_100g','title' => '100g Porcelain Cloche Jar','subtitle' => 'Hermetically sealed with nitrogen cloche','price' => '₹1,850','badge' => 'Signature','checked' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.radio-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'packaging_variant','value' => 'jar_100g','title' => '100g Porcelain Cloche Jar','subtitle' => 'Hermetically sealed with nitrogen cloche','price' => '₹1,850','badge' => 'Signature','checked' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a)): ?>
<?php $attributes = $__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a; ?>
<?php unset($__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc119ab304b0acc50df538c1be3ba2e0a)): ?>
<?php $component = $__componentOriginalc119ab304b0acc50df538c1be3ba2e0a; ?>
<?php unset($__componentOriginalc119ab304b0acc50df538c1be3ba2e0a); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginalc119ab304b0acc50df538c1be3ba2e0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.radio-card','data' => ['name' => 'packaging_variant','value' => 'pouch_250g','title' => '250g Biodegradable Refill Pouch','subtitle' => 'Eco-friendly UV-shielded botanical pouch','price' => '₹3,200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.radio-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'packaging_variant','value' => 'pouch_250g','title' => '250g Biodegradable Refill Pouch','subtitle' => 'Eco-friendly UV-shielded botanical pouch','price' => '₹3,200']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a)): ?>
<?php $attributes = $__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a; ?>
<?php unset($__attributesOriginalc119ab304b0acc50df538c1be3ba2e0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc119ab304b0acc50df538c1be3ba2e0a)): ?>
<?php $component = $__componentOriginalc119ab304b0acc50df538c1be3ba2e0a; ?>
<?php unset($__componentOriginalc119ab304b0acc50df538c1be3ba2e0a); ?>
<?php endif; ?>
                            </div>
                        </div>

                        <!-- Checkbox & Quantity Stepper -->
                        <div class="flex flex-wrap items-center justify-between gap-6 pt-4 border-t border-hairline">
                            <div class="space-y-3">
                                <?php if (isset($component)) { $__componentOriginal43da204543437953b216481011f1ac88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43da204543437953b216481011f1ac88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.checkbox','data' => ['name' => 'gift_wrap','label' => 'Include handmade Japanese mulberry gift wrap (+₹250)','hint' => 'Wrapped by hand with antique gold sealing wax','checked' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'gift_wrap','label' => 'Include handmade Japanese mulberry gift wrap (+₹250)','hint' => 'Wrapped by hand with antique gold sealing wax','checked' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43da204543437953b216481011f1ac88)): ?>
<?php $attributes = $__attributesOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__attributesOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43da204543437953b216481011f1ac88)): ?>
<?php $component = $__componentOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__componentOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal43da204543437953b216481011f1ac88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43da204543437953b216481011f1ac88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.checkbox','data' => ['name' => 'newsletter','label' => 'Notify me when limited seasonal harvests drop']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'newsletter','label' => 'Notify me when limited seasonal harvests drop']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43da204543437953b216481011f1ac88)): ?>
<?php $attributes = $__attributesOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__attributesOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43da204543437953b216481011f1ac88)): ?>
<?php $component = $__componentOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__componentOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
                            </div>

                            <div>
                                <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-2">Quantity Stepper</span>
                                <?php if (isset($component)) { $__componentOriginal9a971dc2d067331b1e89353fddedf395 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a971dc2d067331b1e89353fddedf395 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.quantity-stepper','data' => ['name' => 'qty','value' => '2','min' => '1','max' => '10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.quantity-stepper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'qty','value' => '2','min' => '1','max' => '10']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a971dc2d067331b1e89353fddedf395)): ?>
<?php $attributes = $__attributesOriginal9a971dc2d067331b1e89353fddedf395; ?>
<?php unset($__attributesOriginal9a971dc2d067331b1e89353fddedf395); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a971dc2d067331b1e89353fddedf395)): ?>
<?php $component = $__componentOriginal9a971dc2d067331b1e89353fddedf395; ?>
<?php unset($__componentOriginal9a971dc2d067331b1e89353fddedf395); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 05. LAYOUT & DIVIDERS                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="layout" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '05. Structural Layout','title' => 'Dividers & Section Wrappers','description' => '1px structural hairlines and gold foil rules with central diamond accents create ceremonial pacing between content chapters.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '05. Structural Layout','title' => 'Dividers & Section Wrappers','description' => '1px structural hairlines and gold foil rules with central diamond accents create ceremonial pacing between content chapters.','align' => 'left']); ?>
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

                    <div class="space-y-6">
                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-2">Standard Hairline Divider</span>
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

                        <div>
                            <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-2">Antique Gold Foil Rule (with Center Diamond)</span>
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
                        </div>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 06. EDITORIAL CONTENT                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="content" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '06. Editorial Voice','title' => 'Prose, Blockquotes & Fact Strips','description' => 'Designed for long-form origin essays, botanical monographs, and master grower quotes.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '06. Editorial Voice','title' => 'Prose, Blockquotes & Fact Strips','description' => 'Designed for long-form origin essays, botanical monographs, and master grower quotes.','align' => 'left']); ?>
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

                    <div class="space-y-8">
                        <?php if (isset($component)) { $__componentOriginalab1f97c19e1a741ad2a2945bf8559e16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab1f97c19e1a741ad2a2945bf8559e16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.blockquote','data' => ['author' => 'Dr. Arthur Henley','title' => 'Botanical Founder, 1892']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('blockquote'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['author' => 'Dr. Arthur Henley','title' => 'Botanical Founder, 1892']); ?>
                            Tea is not merely a beverage; it is fifteen unhurried minutes stolen from the frantic churn of the world.
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab1f97c19e1a741ad2a2945bf8559e16)): ?>
<?php $attributes = $__attributesOriginalab1f97c19e1a741ad2a2945bf8559e16; ?>
<?php unset($__attributesOriginalab1f97c19e1a741ad2a2945bf8559e16); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab1f97c19e1a741ad2a2945bf8559e16)): ?>
<?php $component = $__componentOriginalab1f97c19e1a741ad2a2945bf8559e16; ?>
<?php unset($__componentOriginalab1f97c19e1a741ad2a2945bf8559e16); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal41909cf8b4cfae432b5b859f57821bde = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41909cf8b4cfae432b5b859f57821bde = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-strip','data' => ['stats' => [
                            ['value' => '1,850m', 'label' => 'Elevation', 'caption' => 'Misty Himalayan slopes'],
                            ['value' => '72 hrs', 'label' => 'Flush Window', 'caption' => 'First spring budburst'],
                            ['value' => '100%', 'label' => 'Single Estate', 'caption' => 'Zero blended filler leaves'],
                            ['value' => '0%', 'label' => 'Additives', 'caption' => 'Pure unadulterated terroir'],
                        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-strip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['stats' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                            ['value' => '1,850m', 'label' => 'Elevation', 'caption' => 'Misty Himalayan slopes'],
                            ['value' => '72 hrs', 'label' => 'Flush Window', 'caption' => 'First spring budburst'],
                            ['value' => '100%', 'label' => 'Single Estate', 'caption' => 'Zero blended filler leaves'],
                            ['value' => '0%', 'label' => 'Additives', 'caption' => 'Pure unadulterated terroir'],
                        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41909cf8b4cfae432b5b859f57821bde)): ?>
<?php $attributes = $__attributesOriginal41909cf8b4cfae432b5b859f57821bde; ?>
<?php unset($__attributesOriginal41909cf8b4cfae432b5b859f57821bde); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41909cf8b4cfae432b5b859f57821bde)): ?>
<?php $component = $__componentOriginal41909cf8b4cfae432b5b859f57821bde; ?>
<?php unset($__componentOriginal41909cf8b4cfae432b5b859f57821bde); ?>
<?php endif; ?>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 07. COMMERCE ELEMENTS                                               -->
                <!-- ------------------------------------------------------------------- -->
                <section id="commerce" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '07. Commerce Components','title' => 'Product Cards, Ratings & Trust Badges','description' => 'Atomic building blocks for catalogue grids, collection showcases, and product detail displays.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '07. Commerce Components','title' => 'Product Cards, Ratings & Trust Badges','description' => 'Atomic building blocks for catalogue grids, collection showcases, and product detail displays.','align' => 'left']); ?>
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

                    <!-- Product Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php if (isset($component)) { $__componentOriginal97cd36444825b8000ec8a09fb9ff392f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.product-card','data' => ['title' => 'Castleton First Flush Darjeeling','subtitle' => 'Lot 04 • Single Estate Orthodox','price' => '1850','compareAtPrice' => '2100','rating' => '5.0','ratingCount' => '38','badge' => 'Spring 2026','badgeVariant' => 'gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Castleton First Flush Darjeeling','subtitle' => 'Lot 04 • Single Estate Orthodox','price' => '1850','compare-at-price' => '2100','rating' => '5.0','rating-count' => '38','badge' => 'Spring 2026','badge-variant' => 'gold']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $attributes = $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $component = $__componentOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal97cd36444825b8000ec8a09fb9ff392f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.product-card','data' => ['title' => 'Malabar Forest Cardamom Pods','subtitle' => 'Extra Bold 8mm • Wayanad Terroir','price' => '950','rating' => '4.8','ratingCount' => '19','badge' => '100% Organic','badgeVariant' => 'sage']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Malabar Forest Cardamom Pods','subtitle' => 'Extra Bold 8mm • Wayanad Terroir','price' => '950','rating' => '4.8','rating-count' => '19','badge' => '100% Organic','badge-variant' => 'sage']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $attributes = $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $component = $__componentOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal97cd36444825b8000ec8a09fb9ff392f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.product-card','data' => ['title' => 'Wild Saffron Threads (Kashmir)','subtitle' => 'Grade A1 Mogra • Pampore Valley','price' => '3400','compareAtPrice' => '3800','rating' => '4.9','ratingCount' => '42','badge' => 'Limited Reserve','badgeVariant' => 'saffron']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Wild Saffron Threads (Kashmir)','subtitle' => 'Grade A1 Mogra • Pampore Valley','price' => '3400','compare-at-price' => '3800','rating' => '4.9','rating-count' => '42','badge' => 'Limited Reserve','badge-variant' => 'saffron']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $attributes = $__attributesOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__attributesOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f)): ?>
<?php $component = $__componentOriginal97cd36444825b8000ec8a09fb9ff392f; ?>
<?php unset($__componentOriginal97cd36444825b8000ec8a09fb9ff392f); ?>
<?php endif; ?>
                    </div>

                    <!-- Stock Indicators -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-3">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block mb-1">Live Stock States</span>
                        <div class="flex flex-wrap items-center gap-8">
                            <?php if (isset($component)) { $__componentOriginald3f429358e665acac9d95b3b7207f63a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald3f429358e665acac9d95b3b7207f63a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.stock-indicator','data' => ['status' => 'in_stock']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.stock-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => 'in_stock']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald3f429358e665acac9d95b3b7207f63a)): ?>
<?php $attributes = $__attributesOriginald3f429358e665acac9d95b3b7207f63a; ?>
<?php unset($__attributesOriginald3f429358e665acac9d95b3b7207f63a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3f429358e665acac9d95b3b7207f63a)): ?>
<?php $component = $__componentOriginald3f429358e665acac9d95b3b7207f63a; ?>
<?php unset($__componentOriginald3f429358e665acac9d95b3b7207f63a); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginald3f429358e665acac9d95b3b7207f63a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald3f429358e665acac9d95b3b7207f63a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.stock-indicator','data' => ['status' => 'low_stock','quantity' => '4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.stock-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => 'low_stock','quantity' => '4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald3f429358e665acac9d95b3b7207f63a)): ?>
<?php $attributes = $__attributesOriginald3f429358e665acac9d95b3b7207f63a; ?>
<?php unset($__attributesOriginald3f429358e665acac9d95b3b7207f63a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3f429358e665acac9d95b3b7207f63a)): ?>
<?php $component = $__componentOriginald3f429358e665acac9d95b3b7207f63a; ?>
<?php unset($__componentOriginald3f429358e665acac9d95b3b7207f63a); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginald3f429358e665acac9d95b3b7207f63a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald3f429358e665acac9d95b3b7207f63a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.stock-indicator','data' => ['status' => 'out_of_stock']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.stock-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => 'out_of_stock']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald3f429358e665acac9d95b3b7207f63a)): ?>
<?php $attributes = $__attributesOriginald3f429358e665acac9d95b3b7207f63a; ?>
<?php unset($__attributesOriginald3f429358e665acac9d95b3b7207f63a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald3f429358e665acac9d95b3b7207f63a)): ?>
<?php $component = $__componentOriginald3f429358e665acac9d95b3b7207f63a; ?>
<?php unset($__componentOriginald3f429358e665acac9d95b3b7207f63a); ?>
<?php endif; ?>
                        </div>
                    </div>

                    <!-- Trust Badge Strip -->
                    <?php if (isset($component)) { $__componentOriginalc8fe47964b6860ca74311e76ddf4ded8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.commerce.trust-badge-strip','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('commerce.trust-badge-strip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8)): ?>
<?php $attributes = $__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8; ?>
<?php unset($__attributesOriginalc8fe47964b6860ca74311e76ddf4ded8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8fe47964b6860ca74311e76ddf4ded8)): ?>
<?php $component = $__componentOriginalc8fe47964b6860ca74311e76ddf4ded8; ?>
<?php unset($__componentOriginalc8fe47964b6860ca74311e76ddf4ded8); ?>
<?php endif; ?>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 08. OVERLAYS & FEEDBACK                                             -->
                <!-- ------------------------------------------------------------------- -->
                <section id="feedback" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '08. Feedback & Overlays','title' => 'Alerts, Skeletons, Modals & Slide-over Drawers','description' => 'Accessible dialogs, slide-over carts, and feedback banners tuned to brand colors.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '08. Feedback & Overlays','title' => 'Alerts, Skeletons, Modals & Slide-over Drawers','description' => 'Accessible dialogs, slide-over carts, and feedback banners tuned to brand colors.','align' => 'left']); ?>
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

                    <!-- Alerts Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['tone' => 'success','title' => 'Harvest Verified']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tone' => 'success','title' => 'Harvest Verified']); ?>
                            Castleton Estate Lot 04 certified 100% biodynamic by the Himalayan Tea Board.
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['tone' => 'warning','title' => 'Seasonal Allocation']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tone' => 'warning','title' => 'Seasonal Allocation']); ?>
                            Only 14 units remaining of this spring harvest allocation.
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['tone' => 'error','title' => 'Payment Verification Error']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tone' => 'error','title' => 'Payment Verification Error']); ?>
                            Your card issuer requested additional 3D-Secure verification.
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['tone' => 'info','title' => 'Complimentary Shipping']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tone' => 'info','title' => 'Complimentary Shipping']); ?>
                            Add ₹250 more to unlock complimentary express air courier.
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
                    </div>

                    <!-- Interactive Modals & Drawers Trigger Buttons -->
                    <div class="p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Interactive Overlays Demo</span>
                        <div class="flex flex-wrap items-center gap-4">
                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','xData' => true,'xOn:click' => '$dispatch(\'open-modal\', \'tasting-notes-modal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','x-data' => true,'x-on:click' => '$dispatch(\'open-modal\', \'tasting-notes-modal\')']); ?>
                                Open Tasting Notes Modal
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','xData' => true,'xOn:click' => '$dispatch(\'open-drawer\', \'cart-drawer-demo\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','x-data' => true,'x-on:click' => '$dispatch(\'open-drawer\', \'cart-drawer-demo\')']); ?>
                                Open Cart Slide-Over Drawer
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                        </div>
                    </div>

                    <!-- Skeleton Loaders -->
                    <div class="p-6 rounded-2xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Skeleton Loading States</span>
                        <div class="space-y-3 max-w-md">
                            <?php if (isset($component)) { $__componentOriginal31de594fa8b31c89482b92f93a0b9eeb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton','data' => ['width' => 'w-3/4','height' => 'h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['width' => 'w-3/4','height' => 'h-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb)): ?>
<?php $attributes = $__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb; ?>
<?php unset($__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31de594fa8b31c89482b92f93a0b9eeb)): ?>
<?php $component = $__componentOriginal31de594fa8b31c89482b92f93a0b9eeb; ?>
<?php unset($__componentOriginal31de594fa8b31c89482b92f93a0b9eeb); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal31de594fa8b31c89482b92f93a0b9eeb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton','data' => ['width' => 'w-full','height' => 'h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['width' => 'w-full','height' => 'h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb)): ?>
<?php $attributes = $__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb; ?>
<?php unset($__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31de594fa8b31c89482b92f93a0b9eeb)): ?>
<?php $component = $__componentOriginal31de594fa8b31c89482b92f93a0b9eeb; ?>
<?php unset($__componentOriginal31de594fa8b31c89482b92f93a0b9eeb); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal31de594fa8b31c89482b92f93a0b9eeb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton','data' => ['width' => 'w-5/6','height' => 'h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['width' => 'w-5/6','height' => 'h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb)): ?>
<?php $attributes = $__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb; ?>
<?php unset($__attributesOriginal31de594fa8b31c89482b92f93a0b9eeb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31de594fa8b31c89482b92f93a0b9eeb)): ?>
<?php $component = $__componentOriginal31de594fa8b31c89482b92f93a0b9eeb; ?>
<?php unset($__componentOriginal31de594fa8b31c89482b92f93a0b9eeb); ?>
<?php endif; ?>
                        </div>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 09. NAVIGATION & DISCLOSURE                                         -->
                <!-- ------------------------------------------------------------------- -->
                <section id="navigation" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '09. Navigation & Disclosure','title' => 'Breadcrumbs, Pagination, Tabs & Accordions','description' => 'Smooth accordions and tab bars with keyboard accessibility.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '09. Navigation & Disclosure','title' => 'Breadcrumbs, Pagination, Tabs & Accordions','description' => 'Smooth accordions and tab bars with keyboard accessibility.','align' => 'left']); ?>
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

                    <!-- Breadcrumbs -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-2">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Breadcrumbs</span>
                        <?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [
                            ['label' => 'Single-Estate Teas', 'href' => '#'],
                            ['label' => 'Himalayan Harvests', 'href' => '#'],
                            ['label' => 'Castleton First Flush Darjeeling 2026']
                        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                            ['label' => 'Single-Estate Teas', 'href' => '#'],
                            ['label' => 'Himalayan Harvests', 'href' => '#'],
                            ['label' => 'Castleton First Flush Darjeeling 2026']
                        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $attributes = $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $component = $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>
                    </div>

                    <!-- Tabs Component -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Tabbed Content</span>
                        <?php if (isset($component)) { $__componentOriginalb5964ceaff5596b67291a601bad6f23f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5964ceaff5596b67291a601bad6f23f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tabs','data' => ['tabs' => [
                            ['id' => 'notes', 'label' => 'Tasting Notes'],
                            ['id' => 'terroir', 'label' => 'Estate & Terroir'],
                            ['id' => 'brewing', 'label' => 'Steeping Ritual'],
                        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tabs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                            ['id' => 'notes', 'label' => 'Tasting Notes'],
                            ['id' => 'terroir', 'label' => 'Estate & Terroir'],
                            ['id' => 'brewing', 'label' => 'Steeping Ritual'],
                        ])]); ?>
                            <div x-show="activeTab === 'notes'" class="text-body text-secondary space-y-2">
                                <p>Delicate notes of Muscatel grape, white peach blossom, and freshly cut Himalayan pine. Pale amber liquor with an effervescent floral finish.</p>
                            </div>
                            <div x-show="activeTab === 'terroir'" class="text-body text-secondary space-y-2" style="display: none;">
                                <p>Plucked at Castleton Estate, Kurseong South, at an elevation of 1,800m. Sandy loam soil enriched with oak leaf compost.</p>
                            </div>
                            <div x-show="activeTab === 'brewing'" class="text-body text-secondary space-y-2" style="display: none;">
                                <p>Infuse 2.5g in 200ml of mineral spring water at 85°C for exactly 3 minutes. Strain through porcelain filter.</p>
                            </div>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5964ceaff5596b67291a601bad6f23f)): ?>
<?php $attributes = $__attributesOriginalb5964ceaff5596b67291a601bad6f23f; ?>
<?php unset($__attributesOriginalb5964ceaff5596b67291a601bad6f23f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5964ceaff5596b67291a601bad6f23f)): ?>
<?php $component = $__componentOriginalb5964ceaff5596b67291a601bad6f23f; ?>
<?php unset($__componentOriginalb5964ceaff5596b67291a601bad6f23f); ?>
<?php endif; ?>
                    </div>

                    <!-- Accordion Component -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised space-y-4">
                        <span class="text-caption text-secondary uppercase tracking-widest font-semibold block">Accordion (Single or Multiple Open)</span>
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
                            <?php if (isset($component)) { $__componentOriginaldfa6063183d585340d4025fcf91b1b48 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfa6063183d585340d4025fcf91b1b48 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.accordion-item','data' => ['title' => 'How should I store my loose-leaf tea?']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('accordion-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'How should I store my loose-leaf tea?']); ?>
                                Keep the porcelain cloche jar sealed tightly in a cool, dry pantry away from direct sunlight and pungent spices.
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

                            <?php if (isset($component)) { $__componentOriginaldfa6063183d585340d4025fcf91b1b48 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfa6063183d585340d4025fcf91b1b48 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.accordion-item','data' => ['title' => 'What is the difference between First Flush and Second Flush?']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('accordion-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'What is the difference between First Flush and Second Flush?']); ?>
                                First flush is harvested during early spring, resulting in light, brisk, floral liquors. Second flush leaves are harvested in summer and yield rich, amber cups with deep muscatel character.
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

                            <?php if (isset($component)) { $__componentOriginaldfa6063183d585340d4025fcf91b1b48 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfa6063183d585340d4025fcf91b1b48 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.accordion-item','data' => ['title' => 'Are your teas certified organic?']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('accordion-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Are your teas certified organic?']); ?>
                                All our grower estates operate strictly under biodynamic standards with zero synthetic pesticides or artificial aroma sprays.
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
                    </div>

                    <!-- Pagination -->
                    <div class="p-6 rounded-xl border border-hairline bg-surface-raised">
                        <?php if (isset($component)) { $__componentOriginal41032d87daf360242eb88dbda6c75ed1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41032d87daf360242eb88dbda6c75ed1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination','data' => ['currentPage' => '2','totalPages' => '5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['current-page' => '2','total-pages' => '5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41032d87daf360242eb88dbda6c75ed1)): ?>
<?php $attributes = $__attributesOriginal41032d87daf360242eb88dbda6c75ed1; ?>
<?php unset($__attributesOriginal41032d87daf360242eb88dbda6c75ed1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41032d87daf360242eb88dbda6c75ed1)): ?>
<?php $component = $__componentOriginal41032d87daf360242eb88dbda6c75ed1; ?>
<?php unset($__componentOriginal41032d87daf360242eb88dbda6c75ed1); ?>
<?php endif; ?>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 10. MEDIA & APOTHECARY ARCH                                         -->
                <!-- ------------------------------------------------------------------- -->
                <section id="media" class="scroll-mt-24 space-y-8">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '10. Signature Geometry','title' => 'The Signature Apothecary Arch Frame','description' => 'Derived directly from the arched window of the bone-white cloche cylinder packaging. Used with restraint on hero portals.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '10. Signature Geometry','title' => 'The Signature Apothecary Arch Frame','description' => 'Derived directly from the arched window of the bone-white cloche cylinder packaging. Used with restraint on hero portals.','align' => 'left']); ?>
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

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                        <div class="space-y-3 text-center">
                            <?php if (isset($component)) { $__componentOriginal74ac9fc1c8789f9091a50631f948f4db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.arch-frame','data' => ['variant' => 'default','aspect' => 'aspect-[3/4]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('arch-frame'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'default','aspect' => 'aspect-[3/4]']); ?>
                                <div class="h-full w-full flex flex-col items-center justify-center p-6 bg-surface-raised/80 text-center space-y-2">
                                    <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'w-12 h-12 text-gold stroke-[1]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12 text-gold stroke-[1]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8)): ?>
<?php $attributes = $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8; ?>
<?php unset($__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8)): ?>
<?php $component = $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8; ?>
<?php unset($__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8); ?>
<?php endif; ?>
                                    <span class="font-serif text-lg text-primary">Standard Arch</span>
                                    <span class="text-caption text-secondary">Apothecary Portal</span>
                                </div>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $attributes = $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $component = $__componentOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>
                            <span class="text-caption text-secondary font-medium">Standard Arch Window</span>
                        </div>

                        <div class="space-y-3 text-center">
                            <?php if (isset($component)) { $__componentOriginal74ac9fc1c8789f9091a50631f948f4db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.arch-frame','data' => ['variant' => 'gold-rim','aspect' => 'aspect-[3/4]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('arch-frame'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'gold-rim','aspect' => 'aspect-[3/4]']); ?>
                                <div class="h-full w-full flex flex-col items-center justify-center p-6 bg-surface-raised/80 text-center space-y-2">
                                    <?php if (isset($component)) { $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.leaf','data' => ['class' => 'w-12 h-12 text-gold stroke-[1]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.leaf'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12 text-gold stroke-[1]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f)): ?>
<?php $attributes = $__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f; ?>
<?php unset($__attributesOriginalac0eb3f27c62ac4ed2515780eb1ae82f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f)): ?>
<?php $component = $__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f; ?>
<?php unset($__componentOriginalac0eb3f27c62ac4ed2515780eb1ae82f); ?>
<?php endif; ?>
                                    <span class="font-serif text-lg text-primary">Gold Rimmed</span>
                                    <span class="text-caption text-secondary">Foil Accent Border</span>
                                </div>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $attributes = $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $component = $__componentOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>
                            <span class="text-caption text-secondary font-medium">Gold Foil Rim Arch</span>
                        </div>

                        <div class="space-y-3 text-center">
                            <?php if (isset($component)) { $__componentOriginal74ac9fc1c8789f9091a50631f948f4db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.arch-frame','data' => ['variant' => 'subtle','aspect' => 'aspect-[3/4]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('arch-frame'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'subtle','aspect' => 'aspect-[3/4]']); ?>
                                <div class="h-full w-full flex flex-col items-center justify-center p-6 bg-surface-raised/40 text-center space-y-2">
                                    <?php if (isset($component)) { $__componentOriginal4c316f3544fd858e5c71b5ef1159c026 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c316f3544fd858e5c71b5ef1159c026 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.sparkles','data' => ['class' => 'w-12 h-12 text-gold stroke-[1]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.sparkles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12 text-gold stroke-[1]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4c316f3544fd858e5c71b5ef1159c026)): ?>
<?php $attributes = $__attributesOriginal4c316f3544fd858e5c71b5ef1159c026; ?>
<?php unset($__attributesOriginal4c316f3544fd858e5c71b5ef1159c026); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4c316f3544fd858e5c71b5ef1159c026)): ?>
<?php $component = $__componentOriginal4c316f3544fd858e5c71b5ef1159c026; ?>
<?php unset($__componentOriginal4c316f3544fd858e5c71b5ef1159c026); ?>
<?php endif; ?>
                                    <span class="font-serif text-lg text-primary">Subtle Tint</span>
                                    <span class="text-caption text-secondary">Architectural Niche</span>
                                </div>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $attributes = $__attributesOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__attributesOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db)): ?>
<?php $component = $__componentOriginal74ac9fc1c8789f9091a50631f948f4db; ?>
<?php unset($__componentOriginal74ac9fc1c8789f9091a50631f948f4db); ?>
<?php endif; ?>
                            <span class="text-caption text-secondary font-medium">Subtle Editorial Niche</span>
                        </div>
                    </div>
                </section>

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

                <!-- ------------------------------------------------------------------- -->
                <!-- 11. LINE ICONOGRAPHY                                                -->
                <!-- ------------------------------------------------------------------- -->
                <section id="icons" class="scroll-mt-24 space-y-8 pb-20">
                    <?php if (isset($component)) { $__componentOriginal755230460fd16c04121658d92fbf99f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal755230460fd16c04121658d92fbf99f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-heading','data' => ['eyebrow' => '11. Line Iconography','title' => 'Bespoke Vector Line Icons','description' => 'Single stroke-width vector line icons matching the delicate fragrance-house aesthetic.','align' => 'left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => '11. Line Iconography','title' => 'Bespoke Vector Line Icons','description' => 'Single stroke-width vector line icons matching the delicate fragrance-house aesthetic.','align' => 'left']); ?>
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

                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4 p-6 sm:p-10 rounded-2xl border border-hairline bg-surface-raised">
                        <?php
                        $iconList = [
                            ['name' => 'arrow-right', 'comp' => 'icons.arrow-right'],
                            ['name' => 'arrow-left', 'comp' => 'icons.arrow-left'],
                            ['name' => 'chevron-down', 'comp' => 'icons.chevron-down'],
                            ['name' => 'chevron-right', 'comp' => 'icons.chevron-right'],
                            ['name' => 'chevron-up', 'comp' => 'icons.chevron-up'],
                            ['name' => 'check', 'comp' => 'icons.check'],
                            ['name' => 'close', 'comp' => 'icons.close'],
                            ['name' => 'search', 'comp' => 'icons.search'],
                            ['name' => 'bag', 'comp' => 'icons.bag'],
                            ['name' => 'heart', 'comp' => 'icons.heart'],
                            ['name' => 'user', 'comp' => 'icons.user'],
                            ['name' => 'leaf', 'comp' => 'icons.leaf'],
                            ['name' => 'filter', 'comp' => 'icons.filter'],
                            ['name' => 'plus', 'comp' => 'icons.plus'],
                            ['name' => 'minus', 'comp' => 'icons.minus'],
                            ['name' => 'shield-check', 'comp' => 'icons.shield-check'],
                            ['name' => 'truck', 'comp' => 'icons.truck'],
                            ['name' => 'sparkles', 'comp' => 'icons.sparkles'],
                            ['name' => 'menu', 'comp' => 'icons.menu'],
                            ['name' => 'package', 'comp' => 'icons.package'],
                            ['name' => 'clock', 'comp' => 'icons.clock'],
                            ['name' => 'info', 'comp' => 'icons.info'],
                            ['name' => 'alert-circle', 'comp' => 'icons.alert-circle'],
                            ['name' => 'check-circle', 'comp' => 'icons.check-circle'],
                        ];
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $iconList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex flex-col items-center justify-center p-3 rounded-lg border border-hairline bg-surface-card hover:border-accent transition group">
                                <div class="text-secondary group-hover:text-accent transition">
                                    <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $icon['comp']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
                                </div>
                                <span class="text-[10px] text-muted font-sans mt-2 text-center truncate w-full">
                                    <?php echo e($icon['name']); ?>

                                </span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <!-- Interactive Modal Instance for Demo -->
    <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'tasting-notes-modal','title' => 'Castleton First Flush — Terroir Profile','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tasting-notes-modal','title' => 'Castleton First Flush — Terroir Profile','max-width' => 'md']); ?>
        <div class="space-y-4 text-body text-secondary">
            <p>Harvested exclusively from the highest south-facing slopes of Kurseong Valley at 1,850m elevation during the 2026 spring budburst.</p>
            <div class="p-4 rounded-xl bg-surface-raised border border-hairline space-y-1">
                <span class="text-xs uppercase tracking-widest font-semibold text-primary block">Aroma Compounds:</span>
                <p class="text-caption text-secondary">Linalool, geraniol, and methyl salicylate yielding crisp peach floral bouquet.</p>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-hairline">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'secondary','size' => 'sm','xOn:click' => '$dispatch(\'close-modal\', \'tasting-notes-modal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','size' => 'sm','x-on:click' => '$dispatch(\'close-modal\', \'tasting-notes-modal\')']); ?>Close <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'sm','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'sm','trailing-arrow' => true]); ?>Add to Basket <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

    <!-- Interactive Drawer Instance for Demo -->
    <?php if (isset($component)) { $__componentOriginale67024a204ba6be83f3556a31cc49b4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67024a204ba6be83f3556a31cc49b4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.drawer','data' => ['name' => 'cart-drawer-demo','title' => 'Your Ritual Basket (1)','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('drawer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'cart-drawer-demo','title' => 'Your Ritual Basket (1)','max-width' => 'md']); ?>
        <div class="space-y-6">
            <!-- Basket Item -->
            <div class="flex items-start gap-4 pb-6 border-b border-hairline">
                <div class="w-16 h-16 rounded-lg bg-surface-raised flex items-center justify-center text-muted">
                    <?php if (isset($component)) { $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.package','data' => ['class' => 'w-8 h-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.package'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-8 h-8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8)): ?>
<?php $attributes = $__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8; ?>
<?php unset($__attributesOriginalb90ef4b4c5059d0c6376a35a031a7fe8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8)): ?>
<?php $component = $__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8; ?>
<?php unset($__componentOriginalb90ef4b4c5059d0c6376a35a031a7fe8); ?>
<?php endif; ?>
                </div>
                <div class="flex-1 space-y-1">
                    <h4 class="font-serif text-lg text-primary">Castleton First Flush 2026</h4>
                    <p class="text-caption text-secondary">100g Porcelain Cloche Jar</p>
                    <div class="flex items-center justify-between pt-2">
                        <?php if (isset($component)) { $__componentOriginal9a971dc2d067331b1e89353fddedf395 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a971dc2d067331b1e89353fddedf395 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.quantity-stepper','data' => ['name' => 'drawer_qty','value' => '1','min' => '1','max' => '5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.quantity-stepper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'drawer_qty','value' => '1','min' => '1','max' => '5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a971dc2d067331b1e89353fddedf395)): ?>
<?php $attributes = $__attributesOriginal9a971dc2d067331b1e89353fddedf395; ?>
<?php unset($__attributesOriginal9a971dc2d067331b1e89353fddedf395); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a971dc2d067331b1e89353fddedf395)): ?>
<?php $component = $__componentOriginal9a971dc2d067331b1e89353fddedf395; ?>
<?php unset($__componentOriginal9a971dc2d067331b1e89353fddedf395); ?>
<?php endif; ?>
                        <span class="font-serif text-lg text-primary">₹1,850</span>
                    </div>
                </div>
            </div>

            <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['tone' => 'info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tone' => 'info']); ?>
                You are ₹150 away from complimentary express courier delivery.
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
        </div>

         <?php $__env->slot('footer', null, []); ?> 
            <div class="space-y-4">
                <div class="flex items-center justify-between text-ui text-primary font-medium">
                    <span>Estimated Subtotal</span>
                    <span class="font-serif text-xl">₹1,850</span>
                </div>
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','size' => 'lg','class' => 'w-full','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg','class' => 'w-full','trailing-arrow' => true]); ?>
                    Proceed to Checkout
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44d534d96db5531bb2e6f0c033e2d36e)): ?>
<?php $attributes = $__attributesOriginal44d534d96db5531bb2e6f0c033e2d36e; ?>
<?php unset($__attributesOriginal44d534d96db5531bb2e6f0c033e2d36e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44d534d96db5531bb2e6f0c033e2d36e)): ?>
<?php $component = $__componentOriginal44d534d96db5531bb2e6f0c033e2d36e; ?>
<?php unset($__componentOriginal44d534d96db5531bb2e6f0c033e2d36e); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/pages/design-gallery.blade.php ENDPATH**/ ?>