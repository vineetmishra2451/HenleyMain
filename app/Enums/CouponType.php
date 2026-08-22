<?php

declare(strict_types=1);

namespace App\Enums;

enum CouponType: string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
    case FREE_SHIPPING = 'free_shipping';

    public function label(): string
    {
        return match ($this) {
            self::FIXED => 'Fixed Amount (₹)',
            self::PERCENTAGE => 'Percentage Discount (%)',
            self::FREE_SHIPPING => 'Free Shipping',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::FIXED => 'success',
            self::PERCENTAGE => 'primary',
            self::FREE_SHIPPING => 'warning',
        };
    }
}
