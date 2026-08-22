<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_number' => 'PAY-'.fake()->unique()->numberBetween(100000, 999999),
            'gateway' => 'razorpay',
            'gateway_order_id' => 'order_'.fake()->regexify('[A-Za-z0-9]{14}'),
            'gateway_payment_id' => 'pay_'.fake()->regexify('[A-Za-z0-9]{14}'),
            'gateway_signature' => fake()->sha256(),
            'amount' => 1260.00,
            'currency' => 'INR',
            'status' => PaymentStatus::PAID,
            'payment_method' => 'upi',
            'payload' => ['bank' => 'HDFC', 'vpa' => 'collector@okaxis'],
            'captured_at' => now(),
        ];
    }
}
