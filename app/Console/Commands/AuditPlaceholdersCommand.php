<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Banner;
use App\Models\Category;
use App\Models\HomepageSection;
use App\Models\JournalPost;
use App\Models\Product;
use App\Services\PlaceholderService;
use Illuminate\Console\Command;

class AuditPlaceholdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'henley:audit-placeholders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Audit all media assets across models to report active placeholder usage';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Scanning Henley catalogue and content entities for active placeholders...');
        $this->newLine();

        $audit = [];
        $totalPlaceholders = 0;
        $totalRealAssets = 0;

        // 1. Products
        $products = Product::with('images')->get();
        $prodPlaceholders = 0;
        $prodReal = 0;
        foreach ($products as $p) {
            $firstImage = $p->images->first();
            $img = $p->primary_image ?? ($firstImage ? $firstImage->url : null);
            if (PlaceholderService::isPlaceholder($img)) {
                $prodPlaceholders++;
            } else {
                $prodReal++;
            }
        }
        $audit[] = ['Products (Catalogue)', $products->count(), $prodReal, $prodPlaceholders, $prodPlaceholders > 0 ? 'Placeholders Active' : 'All Assets Final'];
        $totalPlaceholders += $prodPlaceholders;
        $totalRealAssets += $prodReal;

        // 2. Categories & Collections
        $categories = Category::all();
        $catPlaceholders = 0;
        $catReal = 0;
        foreach ($categories as $c) {
            if (PlaceholderService::isPlaceholder($c->image_path)) {
                $catPlaceholders++;
            } else {
                $catReal++;
            }
        }
        $audit[] = ['Categories & Collections', $categories->count(), $catReal, $catPlaceholders, $catPlaceholders > 0 ? 'Placeholders Active' : 'All Assets Final'];
        $totalPlaceholders += $catPlaceholders;
        $totalRealAssets += $catReal;

        // 3. Journal Posts
        $posts = JournalPost::all();
        $postPlaceholders = 0;
        $postReal = 0;
        foreach ($posts as $jp) {
            if (PlaceholderService::isPlaceholder($jp->cover_image)) {
                $postPlaceholders++;
            } else {
                $postReal++;
            }
        }
        $audit[] = ['Journal Posts (Editorial)', $posts->count(), $postReal, $postPlaceholders, $postPlaceholders > 0 ? 'Placeholders Active' : 'All Assets Final'];
        $totalPlaceholders += $postPlaceholders;
        $totalRealAssets += $postReal;

        // 4. Banners
        $banners = Banner::all();
        $bannerPlaceholders = 0;
        $bannerReal = 0;
        foreach ($banners as $b) {
            if (PlaceholderService::isPlaceholder($b->image_url)) {
                $bannerPlaceholders++;
            } else {
                $bannerReal++;
            }
        }
        $audit[] = ['Banners & Promos', $banners->count(), $bannerReal, $bannerPlaceholders, $bannerPlaceholders > 0 ? 'Placeholders Active' : 'All Assets Final'];
        $totalPlaceholders += $bannerPlaceholders;
        $totalRealAssets += $bannerReal;

        // 5. Homepage Sections
        $sections = HomepageSection::all();
        $secPlaceholders = 0;
        $secReal = 0;
        foreach ($sections as $s) {
            $payload = is_array($s->payload) ? $s->payload : [];
            $img = $payload['image_url'] ?? ($payload['hero_image'] ?? ($payload['image'] ?? null));
            if ($img) {
                if (PlaceholderService::isPlaceholder($img)) {
                    $secPlaceholders++;
                } else {
                    $secReal++;
                }
            }
        }
        $audit[] = ['Homepage Dynamic Sections', $sections->count(), $secReal, $secPlaceholders, $secPlaceholders > 0 ? 'Placeholders Active' : 'All Assets Final'];
        $totalPlaceholders += $secPlaceholders;
        $totalRealAssets += $secReal;

        $this->table(
            ['Surface / Model', 'Total Records', 'Real Assets', 'Placeholders', 'Launch Readiness'],
            $audit
        );

        $this->newLine();
        $this->info("Audit Summary: {$totalRealAssets} genuine assets in use, {$totalPlaceholders} local placeholders active.");

        if ($totalPlaceholders > 0) {
            $this->warn('Notice: Local placeholders are active. All placeholders must be replaced with final photography before Phase 18 Production Launch.');
        } else {
            $this->info('✓ 100% Launch Ready: Zero placeholder assets detected across all models.');
        }

        return self::SUCCESS;
    }
}
