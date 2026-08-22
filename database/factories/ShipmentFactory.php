<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ShipmentStatus;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'vendor_id' => Vendor::factory(),
            'shipment_number' => 'SHP-'.fake()->unique()->numberBetween(1000, 9999),
            'courier_name' => 'BlueDart Express',
            'tracking_number' => fake()->numerify('BLUEDART##########'),
            'tracking_url' => 'https://bluedart.com/track?no='.fake()->numerify('##########'),
            'status' => ShipmentStatus::IN_TRANSIT,
            'shipped_at' => now()->subDay(),
            'delivered_at' => null,
        ];
    }
}
