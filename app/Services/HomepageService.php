<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\HomepageSection;
use App\Models\JournalPost;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class HomepageService
{
    public const CACHE_KEY = 'storefront:homepage:payload';

    /**
     * @return array<string, mixed>
     */
    public function getHomepageData(): array
    {
        return Cache::remember(self::CACHE_KEY, 3600, function (): array {
            // 1. Fetch active sections in sort order
            $sections = HomepageSection::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            // 2. Fetch featured collections (top-level or featured categories)
            $featuredCollections = Category::query()
                ->featured()
                ->withCount('products')
                ->orderBy('sort_order')
                ->take(4)
                ->get();

            // 3. Fetch featured products with vendor and media
            $featuredProducts = Product::query()
                ->active()
                ->where('is_featured', true)
                ->with(['vendor', 'categories', 'primaryImage'])
                ->latest('id')
                ->take(4)
                ->get();

            // 4. Fetch bestsellers
            $bestsellers = Product::query()
                ->active()
                ->where('is_bestseller', true)
                ->with(['vendor', 'categories', 'primaryImage'])
                ->latest('id')
                ->take(4)
                ->get();

            // 5. Fetch active coupons / offers
            $coupons = Coupon::query()
                ->active()
                ->latest('id')
                ->take(2)
                ->get();

            // 6. Fetch recent journal articles
            $journalPosts = JournalPost::query()
                ->where('is_published', true)
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->take(3)
                ->get();

            // 7. Navigation items and announcement settings
            $announcementText = Setting::get('announcement_text', 'Complimentary express air courier on single-estate orders over ₹1,500');
            $announcementLink = Setting::get('announcement_link', '/collections/single-origin-reserve');
            $navItems = Setting::get('nav_main_items', []);

            return [
                'sections' => $sections,
                'featured_collections' => $featuredCollections,
                'featured_products' => $featuredProducts,
                'bestsellers' => $bestsellers,
                'coupons' => $coupons,
                'journal_posts' => $journalPosts,
                'announcement_text' => $announcementText,
                'announcement_link' => $announcementLink,
                'nav_items' => $navItems,
            ];
        });
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
