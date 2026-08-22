<?php

declare(strict_types=1);

namespace App\Enums;

enum CouponType: string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';

    public function label(): string
    {
        return match ($this) {
            self::FIXED => 'Fixed Amount (₹)',
            self::PERCENTAGE => 'Percentage Discount (%)',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::FIXED => 'success',
            self::PERCENTAGE => 'primary',
        };
    }
}
