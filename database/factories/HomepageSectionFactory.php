<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\HomepageSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HomepageSection>
 */
class HomepageSectionFactory extends Factory
{
    protected $model = HomepageSection::class;

    public function definition(): array
    {
        return [
            'key' => 'hero_section_'.fake()->unique()->numberBetween(1, 999),
            'title' => 'The Cloche Ritual',
            'type' => 'hero_banner',
            'sort_order' => 1,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Rare First Flush 2026',
                'headline' => 'Pure leaf. Pure intent.',
                'subhead' => 'Hand-plucked biodynamic harvests preserved in porcelain cloche jars.',
                'cta_label' => 'Explore the Reserve',
                'cta_link' => '/collections/single-origin-reserve',
            ],
        ];
    }
}
