<div class="w-full">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $payload = is_array($section->payload) ? $section->payload : [];
            $type = $section->type;
        ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type === 'hero' || $type === 'hero_banner'): ?>
            <?php if (isset($component)) { $__componentOriginala4c856ce3e5ab381889060ee8ccbf19f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala4c856ce3e5ab381889060ee8ccbf19f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.hero','data' => ['payload' => $payload]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala4c856ce3e5ab381889060ee8ccbf19f)): ?>
<?php $attributes = $__attributesOriginala4c856ce3e5ab381889060ee8ccbf19f; ?>
<?php unset($__attributesOriginala4c856ce3e5ab381889060ee8ccbf19f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala4c856ce3e5ab381889060ee8ccbf19f)): ?>
<?php $component = $__componentOriginala4c856ce3e5ab381889060ee8ccbf19f; ?>
<?php unset($__componentOriginala4c856ce3e5ab381889060ee8ccbf19f); ?>
<?php endif; ?>
        <?php elseif($type === 'why_henley' || $type === 'why_us' || $type === 'our_promise'): ?>
            <?php if (isset($component)) { $__componentOriginal3403dd21e96fd2fc699d2b336b2165ca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3403dd21e96fd2fc699d2b336b2165ca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.why-henley','data' => ['payload' => $payload]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.why-henley'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3403dd21e96fd2fc699d2b336b2165ca)): ?>
<?php $attributes = $__attributesOriginal3403dd21e96fd2fc699d2b336b2165ca; ?>
<?php unset($__attributesOriginal3403dd21e96fd2fc699d2b336b2165ca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3403dd21e96fd2fc699d2b336b2165ca)): ?>
<?php $component = $__componentOriginal3403dd21e96fd2fc699d2b336b2165ca; ?>
<?php unset($__componentOriginal3403dd21e96fd2fc699d2b336b2165ca); ?>
<?php endif; ?>
        <?php elseif($type === 'trust_strip' || $type === 'pillars'): ?>
            <?php if (isset($component)) { $__componentOriginal6526faa22541223df006a51b3fd04e56 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6526faa22541223df006a51b3fd04e56 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.trust-strip','data' => ['payload' => $payload]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.trust-strip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6526faa22541223df006a51b3fd04e56)): ?>
<?php $attributes = $__attributesOriginal6526faa22541223df006a51b3fd04e56; ?>
<?php unset($__attributesOriginal6526faa22541223df006a51b3fd04e56); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6526faa22541223df006a51b3fd04e56)): ?>
<?php $component = $__componentOriginal6526faa22541223df006a51b3fd04e56; ?>
<?php unset($__componentOriginal6526faa22541223df006a51b3fd04e56); ?>
<?php endif; ?>
        <?php elseif($type === 'featured_collections'): ?>
            <?php if (isset($component)) { $__componentOriginal5ec0c8d882bdef6e5dee83b8b88f6b03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5ec0c8d882bdef6e5dee83b8b88f6b03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.featured-collections','data' => ['payload' => $payload,'collections' => $featuredCollections,'totalCount' => $totalCategoriesCount]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.featured-collections'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload),'collections' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredCollections),'total-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalCategoriesCount)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5ec0c8d882bdef6e5dee83b8b88f6b03)): ?>
<?php $attributes = $__attributesOriginal5ec0c8d882bdef6e5dee83b8b88f6b03; ?>
<?php unset($__attributesOriginal5ec0c8d882bdef6e5dee83b8b88f6b03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5ec0c8d882bdef6e5dee83b8b88f6b03)): ?>
<?php $component = $__componentOriginal5ec0c8d882bdef6e5dee83b8b88f6b03; ?>
<?php unset($__componentOriginal5ec0c8d882bdef6e5dee83b8b88f6b03); ?>
<?php endif; ?>
        <?php elseif($type === 'featured_products'): ?>
            <?php if (isset($component)) { $__componentOriginal76c1eca61a1c567024d754d3bcb1acaf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal76c1eca61a1c567024d754d3bcb1acaf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.featured-products','data' => ['payload' => $payload,'products' => $featuredProducts]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.featured-products'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload),'products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredProducts)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal76c1eca61a1c567024d754d3bcb1acaf)): ?>
<?php $attributes = $__attributesOriginal76c1eca61a1c567024d754d3bcb1acaf; ?>
<?php unset($__attributesOriginal76c1eca61a1c567024d754d3bcb1acaf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c1eca61a1c567024d754d3bcb1acaf)): ?>
<?php $component = $__componentOriginal76c1eca61a1c567024d754d3bcb1acaf; ?>
<?php unset($__componentOriginal76c1eca61a1c567024d754d3bcb1acaf); ?>
<?php endif; ?>
        <?php elseif($type === 'bestsellers'): ?>
            <?php if (isset($component)) { $__componentOriginal73c63cc291309492f6664abb25435e56 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73c63cc291309492f6664abb25435e56 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.bestsellers','data' => ['payload' => $payload,'products' => $bestsellers]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.bestsellers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload),'products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bestsellers)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73c63cc291309492f6664abb25435e56)): ?>
<?php $attributes = $__attributesOriginal73c63cc291309492f6664abb25435e56; ?>
<?php unset($__attributesOriginal73c63cc291309492f6664abb25435e56); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73c63cc291309492f6664abb25435e56)): ?>
<?php $component = $__componentOriginal73c63cc291309492f6664abb25435e56; ?>
<?php unset($__componentOriginal73c63cc291309492f6664abb25435e56); ?>
<?php endif; ?>
        <?php elseif($type === 'story_band'): ?>
            <?php if (isset($component)) { $__componentOriginal9b899beebfb9924c3a6794c9732605d3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b899beebfb9924c3a6794c9732605d3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.story-band','data' => ['payload' => $payload]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.story-band'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b899beebfb9924c3a6794c9732605d3)): ?>
<?php $attributes = $__attributesOriginal9b899beebfb9924c3a6794c9732605d3; ?>
<?php unset($__attributesOriginal9b899beebfb9924c3a6794c9732605d3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b899beebfb9924c3a6794c9732605d3)): ?>
<?php $component = $__componentOriginal9b899beebfb9924c3a6794c9732605d3; ?>
<?php unset($__componentOriginal9b899beebfb9924c3a6794c9732605d3); ?>
<?php endif; ?>
        <?php elseif($type === 'offers' || $type === 'banner'): ?>
            <?php if (isset($component)) { $__componentOriginal97cce52bd929a97cc6436dff9f8a1241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97cce52bd929a97cc6436dff9f8a1241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.offers','data' => ['payload' => $payload,'activeCoupon' => $activeCoupon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.offers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload),'active-coupon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeCoupon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97cce52bd929a97cc6436dff9f8a1241)): ?>
<?php $attributes = $__attributesOriginal97cce52bd929a97cc6436dff9f8a1241; ?>
<?php unset($__attributesOriginal97cce52bd929a97cc6436dff9f8a1241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97cce52bd929a97cc6436dff9f8a1241)): ?>
<?php $component = $__componentOriginal97cce52bd929a97cc6436dff9f8a1241; ?>
<?php unset($__componentOriginal97cce52bd929a97cc6436dff9f8a1241); ?>
<?php endif; ?>
        <?php elseif($type === 'journal_preview'): ?>
            <?php if (isset($component)) { $__componentOriginal87a1e69e47e36cbd23c5d85423d339e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal87a1e69e47e36cbd23c5d85423d339e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.journal-preview','data' => ['payload' => $payload,'posts' => $recentPosts]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.journal-preview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload),'posts' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recentPosts)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal87a1e69e47e36cbd23c5d85423d339e7)): ?>
<?php $attributes = $__attributesOriginal87a1e69e47e36cbd23c5d85423d339e7; ?>
<?php unset($__attributesOriginal87a1e69e47e36cbd23c5d85423d339e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal87a1e69e47e36cbd23c5d85423d339e7)): ?>
<?php $component = $__componentOriginal87a1e69e47e36cbd23c5d85423d339e7; ?>
<?php unset($__componentOriginal87a1e69e47e36cbd23c5d85423d339e7); ?>
<?php endif; ?>
        <?php elseif($type === 'brewing_ritual' || $type === 'ritual' || $type === 'brewing_experience'): ?>
            <?php if (isset($component)) { $__componentOriginalc40c95d44d20dcb03460ef7a3a64a2f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc40c95d44d20dcb03460ef7a3a64a2f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.brewing-ritual','data' => ['payload' => $payload]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.brewing-ritual'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc40c95d44d20dcb03460ef7a3a64a2f8)): ?>
<?php $attributes = $__attributesOriginalc40c95d44d20dcb03460ef7a3a64a2f8; ?>
<?php unset($__attributesOriginalc40c95d44d20dcb03460ef7a3a64a2f8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc40c95d44d20dcb03460ef7a3a64a2f8)): ?>
<?php $component = $__componentOriginalc40c95d44d20dcb03460ef7a3a64a2f8; ?>
<?php unset($__componentOriginalc40c95d44d20dcb03460ef7a3a64a2f8); ?>
<?php endif; ?>
        <?php elseif($type === 'reviews' || $type === 'customer_reviews' || $type === 'testimonials'): ?>
            <?php if (isset($component)) { $__componentOriginal2ba35339868a4244137fef4f93dcf2fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ba35339868a4244137fef4f93dcf2fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.reviews','data' => ['payload' => $payload,'reviews' => $reviews]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.reviews'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload),'reviews' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($reviews)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ba35339868a4244137fef4f93dcf2fe)): ?>
<?php $attributes = $__attributesOriginal2ba35339868a4244137fef4f93dcf2fe; ?>
<?php unset($__attributesOriginal2ba35339868a4244137fef4f93dcf2fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ba35339868a4244137fef4f93dcf2fe)): ?>
<?php $component = $__componentOriginal2ba35339868a4244137fef4f93dcf2fe; ?>
<?php unset($__componentOriginal2ba35339868a4244137fef4f93dcf2fe); ?>
<?php endif; ?>
        <?php elseif($type === 'newsletter_band'): ?>
            <?php if (isset($component)) { $__componentOriginaldb6056b4ab3b6e77a46ac253eb8471af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb6056b4ab3b6e77a46ac253eb8471af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.storefront.sections.newsletter-band','data' => ['payload' => $payload]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('storefront.sections.newsletter-band'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payload)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb6056b4ab3b6e77a46ac253eb8471af)): ?>
<?php $attributes = $__attributesOriginaldb6056b4ab3b6e77a46ac253eb8471af; ?>
<?php unset($__attributesOriginaldb6056b4ab3b6e77a46ac253eb8471af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb6056b4ab3b6e77a46ac253eb8471af)): ?>
<?php $component = $__componentOriginaldb6056b4ab3b6e77a46ac253eb8471af; ?>
<?php unset($__componentOriginaldb6056b4ab3b6e77a46ac253eb8471af); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <!-- Fallback Graceful Empty State if Homepage Sections are Unpopulated -->
        <div class="py-24 max-w-content mx-auto px-6 text-center">
            <?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'The Sanctuary is Being Prepared','description' => 'Our master curators are cataloguing the seasonal spring harvest allocations.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'The Sanctuary is Being Prepared','description' => 'Our master curators are cataloguing the seasonal spring harvest allocations.']); ?>
                <?php if (isset($component)) { $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => '/collections','variant' => 'primary','trailingArrow' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '/collections','variant' => 'primary','trailing-arrow' => true]); ?>
                    Explore The Cellar
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $attributes = $__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__attributesOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379)): ?>
<?php $component = $__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379; ?>
<?php unset($__componentOriginalfb5b48b69fbd6989c24c2377cf6cf379); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/storefront/home-page.blade.php ENDPATH**/ ?>