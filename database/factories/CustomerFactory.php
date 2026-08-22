<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date_of_birth' => fake()->date('Y-m-d', '-20 years'),
            'gender' => fake()->randomElement(['female', 'male', 'non_binary']),
            'avatar_url' => null,
            'preferences' => [
                'favorite_category' => 'Herbal Infusions',
                'caffeine_preference' => 'Low / Caffeine Free',
                'brewing_vessel' => 'Ceramic Teapot',
            ],
            'notes' => 'Member of the Seasonal First-Flush Tasting Club.',
        ];
    }
}
