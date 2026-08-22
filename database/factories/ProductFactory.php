<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProductStatus;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $teaTitles = [
            'Himalayan Silver Needle White Tea',
            'First Flush Darjeeling Castleton Estate',
            'Restorative Lavender & Chamomile Dream',
            'Morning Clarity Lemongrass Green Tea',
            'Imperial Assam Golden Tips Loose Leaf',
            'Midnight Ashwagandha & Valerian Infusion',
            'Royal Kashmiri Saffron Kehwa Blend',
            'Tellicherry Reserve Whole Black Peppercorns',
            'High-Curcumin Alleppey Turmeric Infusion',
            'Pure Nilgiri Frost Tea Reserve',
            'Sacred Holy Basil & Cardamom Tisane',
            'Vintage Pu-erh Fermented Tea Cake',
        ];

        $name = fake()->unique()->randomElement($teaTitles);
        $basePrice = fake()->randomElement([450.00, 750.00, 1200.00, 1850.00, 2400.00, 3800.00]);

        return [
            'vendor_id' => Vendor::factory(),
            'brand_id' => Brand::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'short_description' => 'Single-estate whole leaves and high-altitude wild botanicals sealed in our signature bone-white apothecary jar.',
            'description' => "Harvested at dawn across misty Himalayan slopes, this rare flush balances floral top notes with a lingering, velvet sweetness.\n\nHand-plucked and carefully shade-dried to preserve delicate active botanical polyphenols.",
            'ingredients' => 'Camellia sinensis (First Flush, Casteton Estate), Wild Himalayan Chamomile blossoms, Kashmiri Organic Lavender buds.',
            'brewing_guide' => "Water Temperature: 85°C (185°F)\nQuantity: 2.5g (1 cloche scoop) per 200ml\nSteep Duration: 3 minutes\nInfusions: Up to 3 re-steepings",
            'status' => ProductStatus::PUBLISHED,
            'is_featured' => fake()->boolean(40),
            'is_bestseller' => fake()->boolean(30),
            'base_price' => $basePrice,
            'compare_at_price' => fake()->boolean(30) ? $basePrice * 1.25 : null,
            'tax_rate_percent' => 5.00,
            'weight_grams' => 100,
            'dimensions' => ['length_cm' => 8, 'width_cm' => 8, 'height_cm' => 16],
            'rating_average' => fake()->randomFloat(2, 4.6, 5.0),
            'rating_count' => fake()->numberBetween(8, 45),
            'published_at' => now()->subDays(fake()->numberBetween(5, 60)),
            'seo_title' => "{$name} — Henley Luxury Tea",
            'seo_description' => "Shop our signature {$name}. Single-estate loose leaf, direct from organic certified biodynamic gardens.",
            'metadata' => [
                'origin' => 'Darjeeling, West Bengal',
                'altitude_meters' => 1800,
                'harvest_season' => 'Spring 2026',
            ],
        ];
    }
}
