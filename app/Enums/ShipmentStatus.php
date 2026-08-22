<?php

declare(strict_types=1);

namespace App\Enums;

enum ShipmentStatus: string
{
    case PENDING = 'pending';
    case LABEL_CREATED = 'label_created';
    case PICKED_UP = 'picked_up';
    case IN_TRANSIT = 'in_transit';
    case OUT_FOR_DELIVERY = 'out_for_delivery';
    case DELIVERED = 'delivered';
    case FAILED = 'failed';
    case RETURNED = 'returned';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending Dispatch',
            self::LABEL_CREATED => 'Shipping Label Generated',
            self::PICKED_UP => 'Handed to Courier',
            self::IN_TRANSIT => 'In Transit',
            self::OUT_FOR_DELIVERY => 'Out for Delivery',
            self::DELIVERED => 'Delivered to Customer',
            self::FAILED => 'Delivery Attempt Failed',
            self::RETURNED => 'Returned to Origin',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::LABEL_CREATED => 'info',
            self::PICKED_UP => 'warning',
            self::IN_TRANSIT => 'primary',
            self::OUT_FOR_DELIVERY => 'warning',
            self::DELIVERED => 'success',
            self::FAILED => 'danger',
            self::RETURNED => 'danger',
        };
    }
}
