<?php

declare(strict_types=1);

namespace App\Enums;

enum RefundStatus: string
{
    case PENDING = 'pending';
    case PROCESSED = 'processed';
    case FAILED = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Refund Requested',
            self::PROCESSED => 'Refund Settled',
            self::FAILED => 'Refund Failed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PROCESSED => 'success',
            self::FAILED => 'danger',
        };
    }
}
