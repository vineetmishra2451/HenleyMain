<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\OtpCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OtpCode>
 */
class OtpCodeFactory extends Factory
{
    protected $model = OtpCode::class;

    public function definition(): array
    {
        return [
            'identifier' => fake()->safeEmail(),
            'code' => (string) fake()->numberBetween(100000, 999999),
            'type' => 'login',
            'expires_at' => now()->addMinutes(10),
            'verified_at' => null,
            'attempts' => 0,
        ];
    }
}
