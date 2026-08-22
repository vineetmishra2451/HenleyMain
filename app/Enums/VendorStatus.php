<?php

declare(strict_types=1);

namespace App\Enums;

enum VendorStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case SUSPENDED = 'suspended';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending Review',
            self::APPROVED => 'Active Partner',
            self::SUSPENDED => 'Suspended',
            self::REJECTED => 'Application Rejected',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success',
            self::SUSPENDED => 'danger',
            self::REJECTED => 'gray',
        };
    }
}
