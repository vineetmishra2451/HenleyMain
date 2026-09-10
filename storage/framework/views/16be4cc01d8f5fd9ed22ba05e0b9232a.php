<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-canvas scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'Henley Design System & Living Component Gallery'); ?></title>

    <!-- Self-hosted font preloading for above-the-fold render -->
    <link rel="preload" href="/fonts/cormorant-garamond-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/plus-jakarta-sans-400-normal.woff2" as="font" type="font/woff2" crossorigin>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="min-h-full bg-canvas text-primary antialiased selection:bg-accent selection:text-inverse">
    <!-- Livewire SPA Loading Bar Indicator -->
    <div wire:loading.class="w-full opacity-100" class="fixed top-0 left-0 h-0.5 bg-accent z-[9999] transition-all duration-300 w-0 opacity-0 pointer-events-none"></div>

    <?php echo e($slot); ?>


    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/components/layouts/design.blade.php ENDPATH**/ ?>