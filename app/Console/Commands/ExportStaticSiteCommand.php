<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\PlaceholderService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExportStaticSiteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'henley:export-static';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export static HTML showcase and assets to dist/ for Netlify deployment';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generating static export for Netlify deployment in dist/...');

        $distPath = base_path('dist');

        // 1. Clean and prepare dist directory
        if (File::exists($distPath)) {
            File::deleteDirectory($distPath);
        }
        File::makeDirectory($distPath, 0755, true);

        // 2. Ensure placeholders are generated
        PlaceholderService::generateAllFiles();

        // 3. Copy public assets (fonts, images, placeholders, build bundle, favicon)
        $this->info('Copying public assets to dist/...');

        $publicDirs = ['build', 'fonts', 'images', 'placeholders'];
        foreach ($publicDirs as $dir) {
            $src = public_path($dir);
            $dest = "{$distPath}/{$dir}";
            if (File::exists($src)) {
                File::copyDirectory($src, $dest);
            }
        }

        if (File::exists(public_path('favicon.ico'))) {
            File::copy(public_path('favicon.ico'), "{$distPath}/favicon.ico");
        }

        if (File::exists(base_path('style-tile.html'))) {
            File::copy(base_path('style-tile.html'), "{$distPath}/style-tile.html");
        }

        // 4. Render HTML Pages via Laravel Kernel
        $this->info('Rendering storefront pages to static HTML...');

        /** @var Kernel $kernel */
        $kernel = app()->make(Kernel::class);

        $routesToExport = [
            '/' => 'index.html',
            '/design' => 'design/index.html',
        ];

        foreach ($routesToExport as $uri => $outputRelativePath) {
            $request = Request::create($uri, 'GET');
            $response = $kernel->handle($request);

            if ($response->getStatusCode() === 200) {
                $html = (string) $response->getContent();

                // Clean up any development-only scripts/vite tags for standalone static deployment
                $outputPath = "{$distPath}/{$outputRelativePath}";
                File::ensureDirectoryExists(dirname($outputPath));
                File::put($outputPath, $html);

                $this->info("✓ Rendered {$uri} -> dist/{$outputRelativePath}");
            } else {
                $this->error("✕ Failed to render {$uri} (Status code: {$response->getStatusCode()})");
            }
        }

        // 5. Generate Netlify _redirects and _headers
        File::put("{$distPath}/_redirects", <<<'REDIRECTS'
/design /design/index.html 200
/style-tile /style-tile.html 200
/* /index.html 200
REDIRECTS);

        File::put("{$distPath}/_headers", <<<'HEADERS'
/*
  X-Frame-Options: SAMEORIGIN
  X-Content-Type-Options: nosniff
  Referrer-Policy: strict-origin-when-cross-origin

/fonts/*
  Cache-Control: public, max-age=31536000, immutable

/images/*
  Cache-Control: public, max-age=604800

/build/*
  Cache-Control: public, max-age=31536000, immutable
HEADERS);

        $this->newLine();
        $this->info('✓ Static export complete in dist/! Ready for Netlify deployment.');
        $this->info('Deploy using: netlify deploy --prod --dir=dist');

        return self::SUCCESS;
    }
}
