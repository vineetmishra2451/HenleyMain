<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\RefundStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Refund>
 */
class RefundFactory extends Factory
{
    protected $model = Refund::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_id' => Payment::factory(),
            'refund_number' => 'RFD-'.fake()->unique()->numberBetween(1000, 9999),
            'gateway_refund_id' => 'rfd_'.fake()->regexify('[A-Za-z0-9]{14}'),
            'amount' => 1200.00,
            'reason' => 'Customer requested cancellation prior to dispatch.',
            'status' => RefundStatus::PROCESSED,
            'processed_at' => now(),
        ];
    }
}
