<?php if (isset($component)) { $__componentOriginal51ea8e071ed038a4c6542abfe5470d94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal51ea8e071ed038a4c6542abfe5470d94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.storefront','data' => ['transparentHeader' => true,'announcementText' => $announcement_text ?? null,'announcementLink' => $announcement_link ?? null,'navItems' => $nav_items ?? [],'featuredCollections' => $featured_collections ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.storefront'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['transparent-header' => true,'announcement-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($announcement_text ?? null),'announcement-link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($announcement_link ?? null),'nav-items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($nav_items ?? []),'featured-collections' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featured_collections ?? [])]); ?>
    <!-- Dynamic Homepage Sections Loop -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($section->type):
            case ('hero'): ?>
            <?php case ('hero_banner'): ?>
                <?php if (isset($component)) { $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => ['payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $attributes = $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $component = $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('trust_strip'): ?>
            <?php case ('pillars'): ?>
                <?php if (isset($component)) { $__componentOriginalc5c3c174a76003497448693c422aa7bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc5c3c174a76003497448693c422aa7bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.trust-strip','data' => ['payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.trust-strip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc5c3c174a76003497448693c422aa7bc)): ?>
<?php $attributes = $__attributesOriginalc5c3c174a76003497448693c422aa7bc; ?>
<?php unset($__attributesOriginalc5c3c174a76003497448693c422aa7bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc5c3c174a76003497448693c422aa7bc)): ?>
<?php $component = $__componentOriginalc5c3c174a76003497448693c422aa7bc; ?>
<?php unset($__componentOriginalc5c3c174a76003497448693c422aa7bc); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('featured_collections'): ?>
                <?php if (isset($component)) { $__componentOriginal77ae6750ef5d938e8ede24abf7794a75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77ae6750ef5d938e8ede24abf7794a75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.featured-collections','data' => ['collections' => $featured_collections ?? [],'payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.featured-collections'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['collections' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featured_collections ?? []),'payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal77ae6750ef5d938e8ede24abf7794a75)): ?>
<?php $attributes = $__attributesOriginal77ae6750ef5d938e8ede24abf7794a75; ?>
<?php unset($__attributesOriginal77ae6750ef5d938e8ede24abf7794a75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal77ae6750ef5d938e8ede24abf7794a75)): ?>
<?php $component = $__componentOriginal77ae6750ef5d938e8ede24abf7794a75; ?>
<?php unset($__componentOriginal77ae6750ef5d938e8ede24abf7794a75); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('featured_products'): ?>
                <?php if (isset($component)) { $__componentOriginal9b5a7e6bc2f06e527789106c34dbd703 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.featured-products','data' => ['products' => $featured_products ?? [],'payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.featured-products'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featured_products ?? []),'payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703)): ?>
<?php $attributes = $__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703; ?>
<?php unset($__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b5a7e6bc2f06e527789106c34dbd703)): ?>
<?php $component = $__componentOriginal9b5a7e6bc2f06e527789106c34dbd703; ?>
<?php unset($__componentOriginal9b5a7e6bc2f06e527789106c34dbd703); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('best_sellers'): ?>
                <?php if (isset($component)) { $__componentOriginal2ca56326f38927c4d7736156d21db566 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ca56326f38927c4d7736156d21db566 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.best-sellers','data' => ['products' => $bestsellers ?? [],'payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.best-sellers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bestsellers ?? []),'payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ca56326f38927c4d7736156d21db566)): ?>
<?php $attributes = $__attributesOriginal2ca56326f38927c4d7736156d21db566; ?>
<?php unset($__attributesOriginal2ca56326f38927c4d7736156d21db566); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ca56326f38927c4d7736156d21db566)): ?>
<?php $component = $__componentOriginal2ca56326f38927c4d7736156d21db566; ?>
<?php unset($__componentOriginal2ca56326f38927c4d7736156d21db566); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('story_band'): ?>
                <?php if (isset($component)) { $__componentOriginala4bb4403407a4938260ddf626076bd6f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala4bb4403407a4938260ddf626076bd6f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.story-band','data' => ['payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.story-band'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala4bb4403407a4938260ddf626076bd6f)): ?>
<?php $attributes = $__attributesOriginala4bb4403407a4938260ddf626076bd6f; ?>
<?php unset($__attributesOriginala4bb4403407a4938260ddf626076bd6f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala4bb4403407a4938260ddf626076bd6f)): ?>
<?php $component = $__componentOriginala4bb4403407a4938260ddf626076bd6f; ?>
<?php unset($__componentOriginala4bb4403407a4938260ddf626076bd6f); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('offers'): ?>
                <?php if (isset($component)) { $__componentOriginald8f16a931b782c227359f4f7f0aa5d65 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8f16a931b782c227359f4f7f0aa5d65 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.offers','data' => ['coupons' => $coupons ?? [],'payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.offers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['coupons' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($coupons ?? []),'payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8f16a931b782c227359f4f7f0aa5d65)): ?>
<?php $attributes = $__attributesOriginald8f16a931b782c227359f4f7f0aa5d65; ?>
<?php unset($__attributesOriginald8f16a931b782c227359f4f7f0aa5d65); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8f16a931b782c227359f4f7f0aa5d65)): ?>
<?php $component = $__componentOriginald8f16a931b782c227359f4f7f0aa5d65; ?>
<?php unset($__componentOriginald8f16a931b782c227359f4f7f0aa5d65); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('journal_preview'): ?>
                <?php if (isset($component)) { $__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.journal-preview','data' => ['posts' => $journal_posts ?? [],'payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.journal-preview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['posts' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($journal_posts ?? []),'payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58)): ?>
<?php $attributes = $__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58; ?>
<?php unset($__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58)): ?>
<?php $component = $__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58; ?>
<?php unset($__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58); ?>
<?php endif; ?>
                <?php break; ?>

            <?php case ('instagram_mosaic'): ?>
                <?php if (isset($component)) { $__componentOriginal3daa4febaeae25c3703dede01c9c8c02 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3daa4febaeae25c3703dede01c9c8c02 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.instagram-mosaic','data' => ['payload' => $section->payload ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.instagram-mosaic'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section->payload ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3daa4febaeae25c3703dede01c9c8c02)): ?>
<?php $attributes = $__attributesOriginal3daa4febaeae25c3703dede01c9c8c02; ?>
<?php unset($__attributesOriginal3daa4febaeae25c3703dede01c9c8c02); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3daa4febaeae25c3703dede01c9c8c02)): ?>
<?php $component = $__componentOriginal3daa4febaeae25c3703dede01c9c8c02; ?>
<?php unset($__componentOriginal3daa4febaeae25c3703dede01c9c8c02); ?>
<?php endif; ?>
                <?php break; ?>
        <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sections->isEmpty()): ?>
        <!-- Graceful fallback if zero sections exist in DB -->
        <?php if (isset($component)) { $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $attributes = $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $component = $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalc5c3c174a76003497448693c422aa7bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc5c3c174a76003497448693c422aa7bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.trust-strip','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.trust-strip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc5c3c174a76003497448693c422aa7bc)): ?>
<?php $attributes = $__attributesOriginalc5c3c174a76003497448693c422aa7bc; ?>
<?php unset($__attributesOriginalc5c3c174a76003497448693c422aa7bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc5c3c174a76003497448693c422aa7bc)): ?>
<?php $component = $__componentOriginalc5c3c174a76003497448693c422aa7bc; ?>
<?php unset($__componentOriginalc5c3c174a76003497448693c422aa7bc); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal77ae6750ef5d938e8ede24abf7794a75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77ae6750ef5d938e8ede24abf7794a75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.featured-collections','data' => ['collections' => $featured_collections ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.featured-collections'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['collections' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featured_collections ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal77ae6750ef5d938e8ede24abf7794a75)): ?>
<?php $attributes = $__attributesOriginal77ae6750ef5d938e8ede24abf7794a75; ?>
<?php unset($__attributesOriginal77ae6750ef5d938e8ede24abf7794a75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal77ae6750ef5d938e8ede24abf7794a75)): ?>
<?php $component = $__componentOriginal77ae6750ef5d938e8ede24abf7794a75; ?>
<?php unset($__componentOriginal77ae6750ef5d938e8ede24abf7794a75); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal9b5a7e6bc2f06e527789106c34dbd703 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.featured-products','data' => ['products' => $featured_products ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.featured-products'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featured_products ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703)): ?>
<?php $attributes = $__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703; ?>
<?php unset($__attributesOriginal9b5a7e6bc2f06e527789106c34dbd703); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b5a7e6bc2f06e527789106c34dbd703)): ?>
<?php $component = $__componentOriginal9b5a7e6bc2f06e527789106c34dbd703; ?>
<?php unset($__componentOriginal9b5a7e6bc2f06e527789106c34dbd703); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal2ca56326f38927c4d7736156d21db566 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ca56326f38927c4d7736156d21db566 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.best-sellers','data' => ['products' => $bestsellers ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.best-sellers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bestsellers ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ca56326f38927c4d7736156d21db566)): ?>
<?php $attributes = $__attributesOriginal2ca56326f38927c4d7736156d21db566; ?>
<?php unset($__attributesOriginal2ca56326f38927c4d7736156d21db566); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ca56326f38927c4d7736156d21db566)): ?>
<?php $component = $__componentOriginal2ca56326f38927c4d7736156d21db566; ?>
<?php unset($__componentOriginal2ca56326f38927c4d7736156d21db566); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginala4bb4403407a4938260ddf626076bd6f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala4bb4403407a4938260ddf626076bd6f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.story-band','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.story-band'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala4bb4403407a4938260ddf626076bd6f)): ?>
<?php $attributes = $__attributesOriginala4bb4403407a4938260ddf626076bd6f; ?>
<?php unset($__attributesOriginala4bb4403407a4938260ddf626076bd6f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala4bb4403407a4938260ddf626076bd6f)): ?>
<?php $component = $__componentOriginala4bb4403407a4938260ddf626076bd6f; ?>
<?php unset($__componentOriginala4bb4403407a4938260ddf626076bd6f); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginald8f16a931b782c227359f4f7f0aa5d65 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8f16a931b782c227359f4f7f0aa5d65 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.offers','data' => ['coupons' => $coupons ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.offers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['coupons' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($coupons ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8f16a931b782c227359f4f7f0aa5d65)): ?>
<?php $attributes = $__attributesOriginald8f16a931b782c227359f4f7f0aa5d65; ?>
<?php unset($__attributesOriginald8f16a931b782c227359f4f7f0aa5d65); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8f16a931b782c227359f4f7f0aa5d65)): ?>
<?php $component = $__componentOriginald8f16a931b782c227359f4f7f0aa5d65; ?>
<?php unset($__componentOriginald8f16a931b782c227359f4f7f0aa5d65); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.journal-preview','data' => ['posts' => $journal_posts ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.journal-preview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['posts' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($journal_posts ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58)): ?>
<?php $attributes = $__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58; ?>
<?php unset($__attributesOriginal9fd7f1c2de9515d8e3c02109d763fc58); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58)): ?>
<?php $component = $__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58; ?>
<?php unset($__componentOriginal9fd7f1c2de9515d8e3c02109d763fc58); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal3daa4febaeae25c3703dede01c9c8c02 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3daa4febaeae25c3703dede01c9c8c02 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.instagram-mosaic','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.instagram-mosaic'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3daa4febaeae25c3703dede01c9c8c02)): ?>
<?php $attributes = $__attributesOriginal3daa4febaeae25c3703dede01c9c8c02; ?>
<?php unset($__attributesOriginal3daa4febaeae25c3703dede01c9c8c02); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3daa4febaeae25c3703dede01c9c8c02)): ?>
<?php $component = $__componentOriginal3daa4febaeae25c3703dede01c9c8c02; ?>
<?php unset($__componentOriginal3daa4febaeae25c3703dede01c9c8c02); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal51ea8e071ed038a4c6542abfe5470d94)): ?>
<?php $attributes = $__attributesOriginal51ea8e071ed038a4c6542abfe5470d94; ?>
<?php unset($__attributesOriginal51ea8e071ed038a4c6542abfe5470d94); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal51ea8e071ed038a4c6542abfe5470d94)): ?>
<?php $component = $__componentOriginal51ea8e071ed038a4c6542abfe5470d94; ?>
<?php unset($__componentOriginal51ea8e071ed038a4c6542abfe5470d94); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/storefront/home.blade.php ENDPATH**/ ?>