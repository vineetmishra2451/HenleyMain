<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\HomepageSection;
use App\Models\JournalPost;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class HomePage extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        /** @var Collection<int, HomepageSection> $sections */
        $sections = Cache::tags(['homepage'])->remember('storefront_homepage_sections', 3600, function (): Collection {
            return HomepageSection::active()->get();
        });

        /** @var Collection<int, Category> $featuredCollections */
        $featuredCollections = Cache::tags(['categories'])->remember('homepage_featured_collections', 3600, function (): Collection {
            return Category::where('is_featured', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->withCount('products')
                ->with('parent')
                ->take(4)
                ->get();
        });

        /** @var int $totalCategoriesCount */
        $totalCategoriesCount = Cache::tags(['categories'])->remember('homepage_categories_count', 3600, function (): int {
            return Category::count();
        });

        /** @var Collection<int, Product> $featuredProducts */
        $featuredProducts = Cache::tags(['products', 'homepage'])->remember('homepage_featured_products', 3600, function (): Collection {
            return Product::active()
                ->featured()
                ->with(['images', 'categories'])
                ->take(4)
                ->get();
        });

        /** @var Collection<int, Product> $bestsellers */
        $bestsellers = Cache::tags(['products', 'homepage'])->remember('homepage_bestsellers', 3600, function (): Collection {
            return Product::active()
                ->bestseller()
                ->with(['images', 'categories'])
                ->take(6)
                ->get();
        });

        /** @var Collection<int, JournalPost> $recentPosts */
        $recentPosts = Cache::tags(['articles', 'homepage'])->remember('homepage_recent_posts', 3600, function (): Collection {
            return JournalPost::where('is_published', true)
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        /** @var Coupon|null $activeCoupon */
        $activeCoupon = Cache::tags(['promotions', 'homepage'])->remember('homepage_active_coupon', 3600, function (): ?Coupon {
            return Coupon::active()->first();
        });

        return view('livewire.storefront.home-page', [
            'sections' => $sections,
            'featuredCollections' => $featuredCollections,
            'totalCategoriesCount' => $totalCategoriesCount,
            'featuredProducts' => $featuredProducts,
            'bestsellers' => $bestsellers,
            'recentPosts' => $recentPosts,
            'activeCoupon' => $activeCoupon,
        ])->layout('components.layouts.storefront', [
            'title' => 'Pure leaf. Pure intent.',
            'transparentHero' => true,
        ]);
    }
}
