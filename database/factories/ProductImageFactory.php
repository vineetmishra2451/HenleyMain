<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductImage>
 */
class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'product_variant_id' => null,
            'url' => fake()->randomElement([
                'brand/packagingrender.png',
                'brand/homepage.jpeg',
                'brand/collectionpage.jpeg',
                'brand/productpage.jpeg',
            ]),
            'alt_text' => 'Henley bone-white porcelain cloche jar with saffron tea leaves',
            'sort_order' => 0,
            'is_primary' => false,
        ];
    }
}
