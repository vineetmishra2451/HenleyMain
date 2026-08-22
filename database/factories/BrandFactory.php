<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        $name = 'Henley Private Reserve';

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1, 999),
            'logo_path' => 'brand/logo.png',
            'description' => 'Single-estate loose leaf teas, rare Himalayan botanicals, and high-altitude spices.',
            'website_url' => 'https://henleytea.com',
            'is_featured' => true,
            'seo_title' => 'Henley — The Art of Pure Leaf Tea',
            'seo_description' => 'Luxury direct-to-consumer tea, botanical infusions, and single-origin whole spices.',
        ];
    }
}
