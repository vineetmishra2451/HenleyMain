<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public int $cartCount = 0;

    public bool $isTransparentHero = false;

    #[On('cart-updated')]
    public function updateCartCount(int $count): void
    {
        $this->cartCount = $count;
    }

    public function mount(bool $transparentHero = false): void
    {
        $this->isTransparentHero = $transparentHero;

        // Fetch session cart count if available
        $this->cartCount = (int) session('cart_count', 0);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $announcementEnabled = (bool) Setting::get('announcement.banner_enabled', true);
        $announcementText = (string) Setting::get('announcement.banner_text', 'Complimentary shipping on orders over ₹1,999');
        $announcementLink = (string) Setting::get('announcement.banner_link', '/shop');

        $leftNavLinks = [
            ['label' => 'SHOP', 'url' => '/shop', 'active' => false],
            ['label' => 'COLLECTIONS', 'url' => '/collections', 'active' => true],
            ['label' => 'TEA', 'url' => '/collections?cat=tea', 'active' => false],
            ['label' => 'HERBS & SPICES', 'url' => '/collections?cat=herbs-spices', 'active' => false],
        ];

        $rightNavLinks = [
            ['label' => 'GRAINS', 'url' => '/collections?cat=flours-grains', 'active' => false],
            ['label' => 'ESSENTIALS', 'url' => '/collections?cat=cooking-essentials', 'active' => false],
            ['label' => 'COCOA', 'url' => '/collections?cat=cocoa', 'active' => false],
            ['label' => 'STORY', 'url' => '/story', 'active' => false],
        ];

        $allNavLinks = array_merge($leftNavLinks, $rightNavLinks);

        /** @var Collection<int, Category> $megaCollections */
        $megaCollections = Cache::tags(['categories'])->remember('storefront_mega_collections', 3600, function (): Collection {
            return Category::where('is_featured', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->withCount('products')
                ->take(5)
                ->get();
        });

        /** @var Collection<int, Category> $menuCategories */
        $menuCategories = Cache::tags(['categories', 'products'])->remember('storefront_menu_categories_with_products', 3600, function (): Collection {
            return Category::where('is_featured', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->withCount('products')
                ->with(['products' => function ($q): void {
                    $q->withoutGlobalScopes()
                        ->published()
                        ->with('primaryImage')
                        ->orderByDesc('is_bestseller')
                        ->orderByDesc('is_featured')
                        ->take(3);
                }])
                ->get();
        });

        /** @var Collection<int, Product> $topMenuProducts */
        $topMenuProducts = Cache::tags(['products'])->remember('storefront_top_menu_products', 3600, function (): Collection {
            return Product::withoutGlobalScopes()
                ->published()
                ->where(function ($q): void {
                    $q->where('is_bestseller', true)->orWhere('is_featured', true);
                })
                ->with(['primaryImage', 'categories'])
                ->take(4)
                ->get();
        });

        return view('livewire.storefront.header', [
            'announcementEnabled' => $announcementEnabled,
            'announcementText' => $announcementText,
            'announcementLink' => $announcementLink,
            'leftNavLinks' => $leftNavLinks,
            'rightNavLinks' => $rightNavLinks,
            'allNavLinks' => $allNavLinks,
            'megaCollections' => $megaCollections,
            'menuCategories' => $menuCategories,
            'topMenuProducts' => $topMenuProducts,
        ]);
    }
}
