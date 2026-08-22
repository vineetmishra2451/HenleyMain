<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Taxonomy;
use App\Models\TaxonomyTerm;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TaxonomyTerm>
 */
class TaxonomyTermFactory extends Factory
{
    protected $model = TaxonomyTerm::class;

    public function definition(): array
    {
        $name = fake()->word();

        return [
            'taxonomy_id' => Taxonomy::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => 'Targeted botanical benefit and profile.',
            'sort_order' => 0,
        ];
    }
}
