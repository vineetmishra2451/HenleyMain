<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\AddressType;
use App\Enums\CouponType;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\ProductStatus;
use App\Enums\RefundStatus;
use App\Enums\ReviewStatus;
use App\Enums\ShipmentStatus;
use App\Enums\StockMovementReason;
use App\Enums\UserRole;
use App\Enums\VendorStatus;

test('all enums provide valid string values, labels, and filament badge colors', function (): void {
    $enumClasses = [
        OrderStatus::class,
        PaymentStatus::class,
        ProductStatus::class,
        StockMovementReason::class,
        UserRole::class,
        CouponType::class,
        VendorStatus::class,
        AddressType::class,
        ShipmentStatus::class,
        RefundStatus::class,
        ReviewStatus::class,
    ];

    foreach ($enumClasses as $enumClass) {
        foreach ($enumClass::cases() as $case) {
            expect($case->value)->toBeString()
                ->and($case->label())->not->toBeEmpty()
                ->and($case->color())->not->toBeEmpty();
        }
    }
});
