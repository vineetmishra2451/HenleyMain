<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\VendorStatus;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Vendor>
 */
class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    public function definition(): array
    {
        $name = fake()->company().' Tea & Botanical Estate';

        return [
            'business_name' => $name,
            'legal_name' => $name.' Private Limited',
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(100, 999),
            'gstin' => fake()->numerify('19#####%%%%#Z#'),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->numerify('+91##########'),
            'address' => [
                'line_1' => fake()->streetAddress(),
                'city' => fake()->city(),
                'state' => 'West Bengal',
                'pincode' => '734001',
                'country' => 'IN',
            ],
            'commission_rate' => 15.00,
            'status' => VendorStatus::APPROVED,
            'approved_at' => now(),
            'bank_details' => [
                'bank_name' => 'HDFC Bank',
                'account_number' => fake()->numerify('50100#########'),
                'ifsc_code' => 'HDFC0001234',
                'account_holder_name' => $name,
            ],
            'notes' => 'Certified organic estate partner specializing in biodynamic cultivation.',
        ];
    }
}
