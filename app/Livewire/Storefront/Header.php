<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use App\Models\Category;
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
        $announcementText = (string) Setting::get('announcement.banner_text', 'Complimentary Express Air Delivery on all Himalayan reserve orders over ₹1,500');
        $announcementLink = (string) Setting::get('announcement.banner_link', '/collections');

        /** @var array<array{label: string, url: string, has_mega?: bool}> $menuItems */
        $menuItems = Cache::tags(['navigation'])->remember('storefront_main_menu', 3600, function (): array {
            $raw = Setting::get('navigation.main_menu');
            if ($raw) {
                $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
                if (is_array($decoded)) {
                    return $decoded;
                }
            }

            return [
                ['label' => 'Shop', 'url' => '/collections', 'has_mega' => false],
                ['label' => 'Collections', 'url' => '/collections', 'has_mega' => true],
                ['label' => 'Herbal', 'url' => '/collections', 'has_mega' => false],
                ['label' => 'Gifts', 'url' => '/collections', 'has_mega' => false],
                ['label' => 'Our Story', 'url' => '/about', 'has_mega' => false],
                ['label' => 'Journal', 'url' => '/journal', 'has_mega' => false],
            ];
        });

        /** @var Collection<int, Category> $megaCollections */
        $megaCollections = Cache::tags(['categories'])->remember('storefront_mega_collections', 3600, function (): Collection {
            return Category::where('is_featured', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->withCount('products')
                ->take(4)
                ->get();
        });

        return view('livewire.storefront.header', [
            'announcementEnabled' => $announcementEnabled,
            'announcementText' => $announcementText,
            'announcementLink' => $announcementLink,
            'menuItems' => $menuItems,
            'megaCollections' => $megaCollections,
        ]);
    }
}
