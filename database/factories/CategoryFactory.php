<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Restorative Sleep',
            'Morning Clarity',
            'Heritage Black',
            'Luxury Wellness Infusions',
            'Artisanal Whole Spices',
            'Single-Origin Reserve',
            'Curated Gift Sets',
        ]);

        return [
            'parent_id' => null,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => 'Meticulously sourced botanicals and pure whole leaves curated for personal daily rituals.',
            'sort_order' => fake()->numberBetween(0, 10),
            'is_featured' => true,
            'image_path' => 'brand/collectionpage.jpeg',
            'seo_title' => "{$name} — Henley Luxury Tea & Botanicals",
            'seo_description' => "Discover our {$name} collection. Organically harvested, single-origin leaves and whole spices.",
        ];
    }
}
