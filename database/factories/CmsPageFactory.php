<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CmsPage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CmsPage>
 */
class CmsPageFactory extends Factory
{
    protected $model = CmsPage::class;

    public function definition(): array
    {
        $title = fake()->unique()->randomElement([
            'The Art of the Cloche Ritual',
            'Biodynamic Himalayan Estates',
            'Ethical Harvest & Direct Sourcing',
            'Care, Storage & Infusion Chemistry',
            'Terms of Service & Private Reserve Access',
        ]);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => 'At Henley, tea is treated with the reverent precision of haute parfumerie. We work exclusively with high-altitude bio-gardens.',
            'is_published' => true,
            'published_at' => now()->subMonths(2),
            'seo_title' => "{$title} — Henley",
            'seo_description' => 'Learn about our philosophy of pure single-origin leaves and apothecary craftsmanship.',
        ];
    }
}
