<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 850, 4500);
        $tax = round($subtotal * 0.05, 2);
        $shipping = $subtotal >= 1000 ? 0.00 : 90.00;
        $discount = 0.00;
        $grandTotal = $subtotal - $discount + $tax + $shipping;

        $name = fake()->name();
        $email = fake()->safeEmail();
        $phone = fake()->numerify('+91##########');

        return [
            'order_number' => 'HNL-'.now()->format('Y').'-'.fake()->unique()->numberBetween(1001, 9999),
            'user_id' => User::factory(),
            'customer_id' => Customer::factory(),
            'customer_snapshot' => [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
            ],
            'shipping_address' => [
                'recipient_name' => $name,
                'phone' => $phone,
                'line_1' => fake()->streetAddress(),
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'pincode' => '400050',
                'country' => 'IN',
            ],
            'billing_address' => [
                'recipient_name' => $name,
                'phone' => $phone,
                'line_1' => fake()->streetAddress(),
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'pincode' => '400050',
                'country' => 'IN',
            ],
            'subtotal' => $subtotal,
            'discount_amount' => $discount,
            'tax_amount' => $tax,
            'shipping_amount' => $shipping,
            'grand_total' => $grandTotal,
            'coupon_id' => null,
            'status' => OrderStatus::PROCESSING,
            'payment_status' => PaymentStatus::PAID,
            'currency' => 'INR',
            'placed_at' => now()->subDays(fake()->numberBetween(1, 45)),
            'fulfilled_at' => null,
            'cancelled_at' => null,
            'customer_notes' => 'Please package carefully with gift card ribbon.',
            'admin_notes' => 'Dispatched via premium express logistics.',
        ];
    }
}
