<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\CouponType;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Coupon>
 */
class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'code' => 'RITUAL'.fake()->unique()->numberBetween(10, 99),
            'type' => CouponType::PERCENTAGE,
            'value' => 15.00,
            'min_order_amount' => 1000.00,
            'max_discount_amount' => 500.00,
            'usage_limit_total' => 500,
            'usage_limit_per_customer' => 1,
            'total_uses' => 12,
            'applicability_scope' => 'all',
            'scope_ids' => null,
            'starts_at' => now()->subMonth(),
            'expires_at' => now()->addMonths(3),
            'is_active' => true,
        ];
    }
}
