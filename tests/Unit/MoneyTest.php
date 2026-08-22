<?php

declare(strict_types=1);

use App\Support\Money;

test('it creates money from integer paise', function () {
    $money = Money::fromPaise(480000); // ₹4,800.00
    expect($money->getPaise())->toBe(480000)
        ->and($money->getRupees())->toBe(4800.0)
        ->and($money->toDecimal())->toBe('4800.00')
        ->and($money->getCurrency())->toBe('INR');
});

test('it creates money from decimal string, float and integer', function () {
    $fromStr = Money::fromDecimal('1234.56');
    expect($fromStr->getPaise())->toBe(123456)
        ->and($fromStr->toDecimal())->toBe('1234.56');

    $fromFloat = Money::fromDecimal(48.50);
    expect($fromFloat->getPaise())->toBe(4850);

    $fromInt = Money::fromDecimal(100);
    expect($fromInt->getPaise())->toBe(10000);

    $fromRupees = Money::fromRupees('3400.00');
    expect($fromRupees->getPaise())->toBe(340000);
});

test('it formats money using Indian digit grouping', function () {
    // 100 paise = ₹1.00
    expect(Money::fromPaise(100)->formatted())->toBe('₹1.00');

    // ₹1,234.50
    expect(Money::fromPaise(123450)->formatted())->toBe('₹1,234.50');

    // ₹1,23,456.78
    expect(Money::fromPaise(12345678)->formatted())->toBe('₹1,23,456.78');

    // ₹10,00,000.00 (10 Lakhs)
    expect(Money::fromPaise(100000000)->formatted())->toBe('₹10,00,000.00');

    // Without symbol
    expect(Money::fromPaise(123450)->formatted(withSymbol: false))->toBe('1,234.50');

    // Negative amount
    expect(Money::fromPaise(-123450)->formatted())->toBe('-₹1,234.50');
});

test('it performs exact arithmetic without floating point errors', function () {
    $a = Money::fromPaise(15000); // ₹150.00
    $b = Money::fromPaise(25000); // ₹250.00

    $sum = $a->add($b);
    expect($sum->getPaise())->toBe(40000)
        ->and($sum->toDecimal())->toBe('400.00');

    $diff = $b->subtract($a);
    expect($diff->getPaise())->toBe(10000);

    $multiplied = $a->multiply(1.05); // 5% tax
    expect($multiplied->getPaise())->toBe(15750);

    $divided = $b->divide(2);
    expect($divided->getPaise())->toBe(12500);
});

test('it allocates money across ratios without penny loss', function () {
    // ₹100 split 1:1:1 -> 33.34, 33.33, 33.33
    $total = Money::fromPaise(10000);
    $splits = $total->allocate([1, 1, 1]);

    expect($splits)->toHaveCount(3)
        ->and($splits[0]->getPaise())->toBe(3334)
        ->and($splits[1]->getPaise())->toBe(3333)
        ->and($splits[2]->getPaise())->toBe(3333);

    $sumAllocated = $splits[0]->add($splits[1])->add($splits[2]);
    expect($sumAllocated->getPaise())->toBe(10000);
});

test('it performs comparisons correctly', function () {
    $m100 = Money::fromPaise(10000);
    $m200 = Money::fromPaise(20000);
    $m100b = Money::fromPaise(10000);

    expect($m100->equals($m100b))->toBeTrue()
        ->and($m100->equals($m200))->toBeFalse()
        ->and($m200->greaterThan($m100))->toBeTrue()
        ->and($m100->lessThan($m200))->toBeTrue()
        ->and($m100->isPositive())->toBeTrue()
        ->and(Money::zero()->isZero())->toBeTrue()
        ->and(Money::fromPaise(-500)->isNegative())->toBeTrue();
});
