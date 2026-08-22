<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case AUTHORIZED = 'authorized';
    case CAPTURED = 'captured';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::AUTHORIZED => 'Authorized',
            self::CAPTURED => 'Paid (Captured)',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::AUTHORIZED => 'info',
            self::CAPTURED => 'success',
            self::FAILED => 'danger',
            self::REFUNDED => 'gray',
        };
    }
}
