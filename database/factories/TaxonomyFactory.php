<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Taxonomy>
 */
class TaxonomyFactory extends Factory
{
    protected $model = Taxonomy::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Benefit', 'Tea Type', 'Caffeine Level', 'Origin Region']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'sort_order' => 0,
            'is_filterable' => true,
        ];
    }
}
