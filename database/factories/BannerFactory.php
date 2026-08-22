<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Banner>
 */
class BannerFactory extends Factory
{
    protected $model = Banner::class;

    public function definition(): array
    {
        return [
            'title' => 'Complimentary Handcrafted Tasting Spoon with Reserve Orders',
            'placement' => 'storefront_hero',
            'image_url' => 'brand/packagingrender.png',
            'link_url' => '/collections/curated-gift-sets',
            'starts_at' => now()->subWeek(),
            'expires_at' => now()->addMonths(2),
            'is_active' => true,
            'sort_order' => 0,
        ];
    }
}
