<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\AddressType;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'recipient_name' => fake()->name(),
            'phone' => fake()->numerify('+91##########'),
            'line_1' => fake()->buildingNumber().', '.fake()->streetName(),
            'line_2' => 'Apothecary Suite '.fake()->numberBetween(1, 20),
            'landmark' => 'Opposite Botanical Conservatory',
            'city' => fake()->randomElement(['Mumbai', 'Bengaluru', 'New Delhi', 'Kolkata', 'Chennai', 'Pune']),
            'state' => fake()->randomElement(['Maharashtra', 'Karnataka', 'Delhi', 'West Bengal', 'Tamil Nadu']),
            'pincode' => (string) fake()->numberBetween(110001, 700100),
            'country' => 'IN',
            'type' => AddressType::HOME,
            'is_default_shipping' => true,
            'is_default_billing' => true,
            'latitude' => 19.0760000,
            'longitude' => 72.8777000,
        ];
    }
}
