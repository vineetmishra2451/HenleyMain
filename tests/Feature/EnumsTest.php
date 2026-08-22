<?php

declare(strict_types=1);

use App\Enums\CouponType;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\ProductStatus;
use App\Enums\StockMovementReason;
use App\Enums\UserRole;

test('all enums provide valid string values, labels, and filament badge colors', function () {
    // OrderStatus
    foreach (OrderStatus::cases() as $case) {
        expect($case->value)->toBeString()
            ->and($case->label())->not->toBeEmpty()
            ->and($case->color())->not->toBeEmpty();
    }

    // PaymentStatus
    foreach (PaymentStatus::cases() as $case) {
        expect($case->value)->toBeString()
            ->and($case->label())->not->toBeEmpty()
            ->and($case->color())->not->toBeEmpty();
    }

    // ProductStatus
    foreach (ProductStatus::cases() as $case) {
        expect($case->value)->toBeString()
            ->and($case->label())->not->toBeEmpty()
            ->and($case->color())->not->toBeEmpty();
    }

    // StockMovementReason
    foreach (StockMovementReason::cases() as $case) {
        expect($case->value)->toBeString()
            ->and($case->label())->not->toBeEmpty()
            ->and($case->color())->not->toBeEmpty();
    }

    // UserRole
    foreach (UserRole::cases() as $case) {
        expect($case->value)->toBeString()
            ->and($case->label())->not->toBeEmpty()
            ->and($case->color())->not->toBeEmpty();
    }

    // CouponType
    foreach (CouponType::cases() as $case) {
        expect($case->value)->toBeString()
            ->and($case->label())->not->toBeEmpty()
            ->and($case->color())->not->toBeEmpty();
    }
});
