<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ReviewStatus;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $titles = [
            'Exceptional aroma, unlike anything from commercial blenders.',
            'The cloche jar is a piece of art on my counter.',
            'Subtle floral notes and absolutely zero bitterness even after 5 minutes.',
            'My nightly ritual for the past month. Truly restorative.',
            'Remarkable clarity and golden liquor.',
            'A fragrance experience as much as a tea tasting.',
        ];

        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'customer_id' => Customer::factory(),
            'customer_name' => fake()->name(),
            'rating' => fake()->randomElement([4, 5, 5, 5, 5]),
            'title' => fake()->randomElement($titles),
            'body' => 'The leaves expand completely into whole intact flushes. The aroma fills the entire room within seconds of pouring 85°C water. Uncompromising luxury.',
            'is_verified_purchase' => true,
            'status' => ReviewStatus::APPROVED,
            'published_at' => now()->subDays(fake()->numberBetween(1, 30)),
        ];
    }
}
