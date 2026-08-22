<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('henley.brand.name')); ?> — <?php echo e(config('henley.brand.tagline')); ?></title>

    <!-- Google Fonts Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="h-full bg-canvas text-content-primary font-sans antialiased flex flex-col items-center justify-center p-6 select-none">
    <div class="max-w-md w-full text-center space-y-8 bg-surface-raised/80 backdrop-blur border border-border-neutral rounded-xl p-10 shadow-subtle">
        
        <!-- Henley Canonical Vector Wordmark -->
        <div class="flex flex-col items-center justify-center space-y-3">
            <h1 class="text-3xl font-bold tracking-[0.25em] text-content-primary font-sans">
                HENLEY
            </h1>
            <p class="text-xs font-semibold tracking-[0.22em] text-gold uppercase">
                <?php echo e(config('henley.brand.tagline')); ?>

            </p>
        </div>

        <!-- Hairline Divider with Gold Accent -->
        <div class="flex items-center justify-center gap-3">
            <div class="h-px bg-border-neutral flex-1"></div>
            <span class="text-gold text-xs">⌀</span>
            <div class="h-px bg-border-neutral flex-1"></div>
        </div>

        <!-- Editorial Placeholder Message -->
        <div class="space-y-3">
            <h2 class="text-2xl font-serif text-content-primary font-normal">
                Fifteen quiet minutes for the senses.
            </h2>
            <p class="text-sm text-content-secondary leading-relaxed">
                Direct-to-consumer tea, single-origin botanicals, and handpicked whole spices. Architecture & visual foundation active.
            </p>
        </div>

        <!-- Panel Links -->
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3 text-xs font-medium">
            <a href="<?php echo e(url('/admin')); ?>" class="w-full sm:w-auto px-5 py-2.5 rounded-full bg-oxblood text-content-inverse hover:bg-oxblood-hover transition-all duration-200">
                Business Management &rarr;
            </a>
            <a href="<?php echo e(url('/vendor')); ?>" class="w-full sm:w-auto px-5 py-2.5 rounded-full border border-border-neutral bg-surface-card text-content-primary hover:border-content-primary transition-all duration-200">
                Vendor Portal &rarr;
            </a>
        </div>
    </div>
</body>
</html>
<?php /**PATH /app/resources/views/storefront/placeholder.blade.php ENDPATH**/ ?>