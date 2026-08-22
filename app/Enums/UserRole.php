<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case VENDOR = 'vendor';
    case CUSTOMER = 'customer';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Administrator',
            self::ADMIN => 'Administrator',
            self::VENDOR => 'Estate / Vendor Partner',
            self::CUSTOMER => 'Storefront Customer',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'danger',
            self::ADMIN => 'primary',
            self::VENDOR => 'warning',
            self::CUSTOMER => 'info',
        };
    }
}
