<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    protected $model = ProductAttribute::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'key' => fake()->randomElement(['caffeine_level', 'harvest_season', 'origin_estate', 'flavour_profile']),
            'value' => fake()->randomElement(['Caffeine Free', 'Low Caffeine', 'Spring First Flush 2026', 'Floral, Sweet Musk, Honeyed Pear']),
            'sort_order' => 0,
        ];
    }
}
