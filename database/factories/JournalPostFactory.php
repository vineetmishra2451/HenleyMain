<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\JournalPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<JournalPost>
 */
class JournalPostFactory extends Factory
{
    protected $model = JournalPost::class;

    public function definition(): array
    {
        $title = fake()->unique()->randomElement([
            'The Chemistry of Spring First Flush: Why Altitude Changes Everything',
            'Saffron Grading in the Pampore Highlands: From Stigma to Cloche',
            'The Architecture of the Apothecary Cloche: Preserving Delicate Terpenes',
            'Water Temperature and Mineralization: The Forgotten Halves of Tea Extraction',
            'Wild Chamomile and Nightshade Botanicals: An Herbalist’s Field Notes',
            'Single-Estate vs Commercial Blends: Traceability Across 1,800 Metres',
        ]);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => 'An exploration into the botanical science, terroir, and sensory craft behind our seasonal infusions.',
            'body' => "High above the clouds in the Eastern Himalayas, microclimatic shifts between day and night force the tea bush to synthesize high concentrations of aromatic linalool.\n\nWhen harvested at first light, before the mountain mist evaporates, the leaves capture an ephemeral floral brightness that cannot be manufactured.",
            'cover_image' => 'brand/productpage.jpeg',
            'author_name' => 'Dr. Alistair Henley, Master Botanist',
            'reading_time_minutes' => fake()->numberBetween(3, 7),
            'is_published' => true,
            'published_at' => now()->subDays(fake()->numberBetween(2, 50)),
            'seo_title' => "{$title} — The Henley Journal",
            'seo_description' => 'Read our latest botanical essay on single-estate cultivation, terroir, and the science of pure infusion.',
        ];
    }
}
