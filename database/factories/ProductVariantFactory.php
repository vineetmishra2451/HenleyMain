<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'sku' => 'HNL-'.fake()->unique()->regexify('[A-Z]{3}-[0-9]{4}'),
            'option_label' => fake()->randomElement(['100g Signature Porcelain Jar', '250g Botanical Refill Pouch', '50g Tasting Cloche Tin']),
            'price' => 1200.00,
            'compare_at_price' => null,
            'weight_grams' => 100,
            'barcode' => fake()->ean13(),
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
