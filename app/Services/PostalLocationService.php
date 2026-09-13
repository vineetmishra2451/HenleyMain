<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Carbon\Carbon;

class PostalLocationService
{
    /**
     * Known PIN code prefixes mapped to primary city, state, and tier.
     *
     * @var array<string, array{city: string, state: string, zone: string, days: int, express: bool, cod: bool}>
     */
    protected static array $knownPrefixes = [
        '400' => ['city' => 'Mumbai', 'state' => 'Maharashtra', 'zone' => 'metro', 'days' => 1, 'express' => true, 'cod' => true],
        '401' => ['city' => 'Thane', 'state' => 'Maharashtra', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '411' => ['city' => 'Pune', 'state' => 'Maharashtra', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '110' => ['city' => 'New Delhi', 'state' => 'Delhi', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '122' => ['city' => 'Gurugram', 'state' => 'Haryana', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '201' => ['city' => 'Noida', 'state' => 'Uttar Pradesh', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '560' => ['city' => 'Bengaluru', 'state' => 'Karnataka', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '500' => ['city' => 'Hyderabad', 'state' => 'Telangana', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '600' => ['city' => 'Chennai', 'state' => 'Tamil Nadu', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '700' => ['city' => 'Kolkata', 'state' => 'West Bengal', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '380' => ['city' => 'Ahmedabad', 'state' => 'Gujarat', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '160' => ['city' => 'Chandigarh', 'state' => 'Punjab', 'zone' => 'metro', 'days' => 2, 'express' => true, 'cod' => true],
        '302' => ['city' => 'Jaipur', 'state' => 'Rajasthan', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
        '734' => ['city' => 'Siliguri / Darjeeling', 'state' => 'West Bengal', 'zone' => 'tier2', 'days' => 2, 'express' => true, 'cod' => true],
        '682' => ['city' => 'Kochi', 'state' => 'Kerala', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
        '685' => ['city' => 'Munnar', 'state' => 'Kerala', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
        '641' => ['city' => 'Coimbatore', 'state' => 'Tamil Nadu', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
        '643' => ['city' => 'Nilgiri / Ooty', 'state' => 'Tamil Nadu', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
        '226' => ['city' => 'Lucknow', 'state' => 'Uttar Pradesh', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
        '452' => ['city' => 'Indore', 'state' => 'Madhya Pradesh', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
        '395' => ['city' => 'Surat', 'state' => 'Gujarat', 'zone' => 'tier2', 'days' => 3, 'express' => false, 'cod' => true],
    ];

    /**
     * Check service availability for a given 6-digit Indian PIN code.
     *
     * @return array{
     *     serviceable: bool,
     *     pincode: string,
     *     city: string|null,
     *     state: string|null,
     *     zone: string,
     *     delivery_estimate: string,
     *     estimated_days: int,
     *     express_available: bool,
     *     cod_available: bool,
     *     message: string
     * }
     */
    public function checkPincode(string $pincode): array
    {
        $cleanPin = trim($pincode);

        // Validate 6 digit format
        if (! preg_match('/^[1-9][0-9]{5}$/', $cleanPin)) {
            return [
                'serviceable' => false,
                'pincode' => $cleanPin,
                'city' => null,
                'state' => null,
                'zone' => 'invalid',
                'delivery_estimate' => '',
                'estimated_days' => 0,
                'express_available' => false,
                'cod_available' => false,
                'message' => 'Please enter a valid 6-digit Indian postal PIN code.',
            ];
        }

        // Check Admin Non-Serviceable Blocklist
        $blockedList = $this->getBlockedPincodes();
        if (in_array($cleanPin, $blockedList, true)) {
            return [
                'serviceable' => false,
                'pincode' => $cleanPin,
                'city' => null,
                'state' => null,
                'zone' => 'blocked',
                'delivery_estimate' => '',
                'estimated_days' => 0,
                'express_available' => false,
                'cod_available' => false,
                'message' => "Courier delivery is currently unavailable to postal sector {$cleanPin}. Please contact our concierge for dedicated freight.",
            ];
        }

        // Resolve Region & Speed
        $prefix3 = substr($cleanPin, 0, 3);
        $known = static::$knownPrefixes[$prefix3] ?? null;

        if ($known !== null) {
            $city = $known['city'];
            $state = $known['state'];
            $zone = $known['zone'];
            $days = $known['days'];
            $express = $known['express'];
            $cod = $known['cod'];
        } else {
            // General pan-India fallback for valid pins
            $firstDigit = (int) substr($cleanPin, 0, 1);
            $stateMap = [
                1 => 'Delhi, Haryana, Punjab & HP',
                2 => 'Uttar Pradesh & Uttarakhand',
                3 => 'Rajasthan & Gujarat',
                4 => 'Maharashtra & Goa',
                5 => 'Andhra Pradesh, Telangana & Karnataka',
                6 => 'Tamil Nadu & Kerala',
                7 => 'West Bengal, Odisha & North East',
                8 => 'Bihar & Jharkhand',
                9 => 'Armed Forces (APO/FPO)',
            ];

            $city = 'Regional Hub';
            $state = $stateMap[$firstDigit] ?? 'India';
            $zone = 'standard';
            $days = 4;
            $express = false;
            $cod = true;
        }

        $estDate = Carbon::now()->addWeekdays($days);
        $deliveryEstimate = $estDate->format('l, M j');

        return [
            'serviceable' => true,
            'pincode' => $cleanPin,
            'city' => $city,
            'state' => $state,
            'zone' => $zone,
            'delivery_estimate' => "Estimated delivery by {$deliveryEstimate}",
            'estimated_days' => $days,
            'express_available' => $express,
            'cod_available' => $cod,
            'message' => "Service confirmed for {$city}, {$state} ({$cleanPin}).",
        ];
    }

    /**
     * Retrieve the list of non-serviceable PIN codes configured in Admin settings.
     *
     * @return list<string>
     */
    public function getBlockedPincodes(): array
    {
        $raw = Setting::get('blocked_pincodes', '');
        if (empty($raw)) {
            return [];
        }

        // Split by commas, newlines, and whitespace
        $parts = preg_split('/[\r\n,]+/', (string) $raw) ?: [];
        $pins = [];

        foreach ($parts as $part) {
            $trimmed = trim($part);
            if (! empty($trimmed)) {
                $pins[] = $trimmed;
            }
        }

        return $pins;
    }
}
