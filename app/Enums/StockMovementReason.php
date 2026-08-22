<?php

declare(strict_types=1);

namespace App\Enums;

enum StockMovementReason: string
{
    case INITIAL_STOCK = 'initial_stock';
    case ORDER_PLACED = 'order_placed';
    case ORDER_CANCELLED = 'order_cancelled';
    case RESTOCK = 'restock';
    case MANUAL_ADJUSTMENT = 'manual_adjustment';
    case DAMAGED = 'damaged';
    case RETURN_RESTOCK = 'return_restock';

    public function label(): string
    {
        return match ($this) {
            self::INITIAL_STOCK => 'Initial Harvest Inward',
            self::ORDER_PLACED => 'Order Allocation',
            self::ORDER_CANCELLED => 'Order Cancellation Return',
            self::RESTOCK => 'Estate Restock',
            self::MANUAL_ADJUSTMENT => 'Manual Inventory Adjustment',
            self::DAMAGED => 'Damaged / Expired Leaf',
            self::RETURN_RESTOCK => 'Customer Return Restock',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::INITIAL_STOCK => 'info',
            self::ORDER_PLACED => 'danger',
            self::ORDER_CANCELLED => 'success',
            self::RESTOCK => 'success',
            self::MANUAL_ADJUSTMENT => 'warning',
            self::DAMAGED => 'danger',
            self::RETURN_RESTOCK => 'info',
        };
    }
}
