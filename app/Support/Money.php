<?php

declare(strict_types=1);

namespace App\Support;

use InvalidArgumentException;
use JsonSerializable;
use Stringable;

/**
 * Immutable Money Value Object.
 *
 * Stored internally as integer paise (100 paise = 1 Rupee).
 * Formats values according to the Indian numbering system (e.g. ₹1,23,456.78).
 * Bridges database decimal(12,2) with integer arithmetic to eliminate floating-point errors.
 */
final readonly class Money implements JsonSerializable, Stringable
{
    private const string DEFAULT_CURRENCY = 'INR';

    public function __construct(
        private int $paise,
        private string $currency = self::DEFAULT_CURRENCY
    ) {}

    /**
     * Create Money from integer paise.
     */
    public static function fromPaise(int $paise, string $currency = self::DEFAULT_CURRENCY): self
    {
        return new self($paise, $currency);
    }

    /**
     * Create Money from decimal representation (e.g. "1234.50" or 1234.5).
     */
    public static function fromDecimal(string|float|int $decimal, string $currency = self::DEFAULT_CURRENCY): self
    {
        if (is_string($decimal)) {
            $cleaned = trim($decimal);
            if (! is_numeric($cleaned)) {
                throw new InvalidArgumentException("Invalid decimal money string: {$decimal}");
            }
            $paise = (int) round(((float) $cleaned) * 100);
        } elseif (is_int($decimal)) {
            $paise = $decimal * 100;
        } else {
            $paise = (int) round($decimal * 100);
        }

        return new self($paise, $currency);
    }

    /**
     * Create Money from whole Rupee amounts.
     */
    public static function fromRupees(string|float|int $rupees, string $currency = self::DEFAULT_CURRENCY): self
    {
        return self::fromDecimal($rupees, $currency);
    }

    /**
     * Create zero money instance.
     */
    public static function zero(string $currency = self::DEFAULT_CURRENCY): self
    {
        return new self(0, $currency);
    }

    /**
     * Get internal value in integer paise.
     */
    public function getPaise(): int
    {
        return $this->paise;
    }

    /**
     * Get currency code.
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Get float value in Rupees.
     */
    public function getRupees(): float
    {
        return $this->paise / 100.0;
    }

    /**
     * Format as exact decimal string for database storage: decimal(12,2).
     */
    public function toDecimal(): string
    {
        return sprintf('%.2f', $this->paise / 100.0);
    }

    /**
     * Add another Money instance.
     */
    public function add(self $other): self
    {
        $this->ensureSameCurrency($other);

        return new self($this->paise + $other->paise, $this->currency);
    }

    /**
     * Subtract another Money instance.
     */
    public function subtract(self $other): self
    {
        $this->ensureSameCurrency($other);

        return new self($this->paise - $other->paise, $this->currency);
    }

    /**
     * Multiply by scalar factor.
     */
    public function multiply(float|int $factor): self
    {
        return new self((int) round($this->paise * $factor), $this->currency);
    }

    /**
     * Divide by scalar divisor.
     */
    public function divide(float|int $divisor): self
    {
        if ($divisor == 0) {
            throw new InvalidArgumentException('Division by zero in Money calculation.');
        }

        return new self((int) round($this->paise / $divisor), $this->currency);
    }

    /**
     * Allocate money across ratios without losing remainder paise (Foote's algorithm).
     *
     * @param  array<int|float>  $ratios
     * @return array<self>
     */
    public function allocate(array $ratios): array
    {
        $totalRatio = array_sum($ratios);
        if ($totalRatio <= 0) {
            throw new InvalidArgumentException('Total ratio must be greater than zero.');
        }

        $remainder = $this->paise;
        $results = [];

        foreach ($ratios as $ratio) {
            $share = (int) floor(($this->paise * $ratio) / $totalRatio);
            $results[] = $share;
            $remainder -= $share;
        }

        // Distribute remaining paise one by one to earliest non-zero buckets
        $index = 0;
        while ($remainder > 0) {
            $results[$index % count($results)]++;
            $remainder--;
            $index++;
        }

        return array_map(fn (int $p): self => new self($p, $this->currency), $results);
    }

    /**
     * Check if money value is zero.
     */
    public function isZero(): bool
    {
        return $this->paise === 0;
    }

    /**
     * Check if money value is strictly positive (> 0).
     */
    public function isPositive(): bool
    {
        return $this->paise > 0;
    }

    /**
     * Check if money value is negative (< 0).
     */
    public function isNegative(): bool
    {
        return $this->paise < 0;
    }

    /**
     * Check equality with another Money instance.
     */
    public function equals(self $other): bool
    {
        return $this->currency === $other->currency && $this->paise === $other->paise;
    }

    /**
     * Check if greater than another Money instance.
     */
    public function greaterThan(self $other): bool
    {
        $this->ensureSameCurrency($other);

        return $this->paise > $other->paise;
    }

    /**
     * Check if greater than or equal to another Money instance.
     */
    public function greaterThanOrEqual(self $other): bool
    {
        $this->ensureSameCurrency($other);

        return $this->paise >= $other->paise;
    }

    /**
     * Check if less than another Money instance.
     */
    public function lessThan(self $other): bool
    {
        $this->ensureSameCurrency($other);

        return $this->paise < $other->paise;
    }

    /**
     * Check if less than or equal to another Money instance.
     */
    public function lessThanOrEqual(self $other): bool
    {
        $this->ensureSameCurrency($other);

        return $this->paise <= $other->paise;
    }

    /**
     * Format with Rupee symbol and Indian digit grouping (e.g. ₹1,23,456.78 or ₹1,234).
     */
    public function formatted(bool $withSymbol = true, bool $includeDecimals = true): string
    {
        $symbol = $withSymbol ? '₹' : '';
        $isNegative = $this->paise < 0;
        $absPaise = abs($this->paise);

        $rupees = intdiv($absPaise, 100);
        $fraction = $absPaise % 100;

        $rupeesFormatted = $this->formatIndianGrouping($rupees);

        $result = $rupeesFormatted;
        if ($includeDecimals || $fraction > 0) {
            $result .= sprintf('.%02d', $fraction);
        }

        $formatted = $symbol.$result;

        return $isNegative ? '-'.$formatted : $formatted;
    }

    /**
     * Indian numbering system comma grouping algorithm:
     * - Last 3 digits grouped together
     * - All preceding digits grouped in sets of 2
     */
    private function formatIndianGrouping(int $number): string
    {
        $str = (string) $number;
        $len = strlen($str);

        if ($len <= 3) {
            return $str;
        }

        $lastThree = substr($str, -3);
        $remaining = substr($str, 0, -3);

        $groups = [];
        while (strlen($remaining) > 2) {
            $groups[] = substr($remaining, -2);
            $remaining = substr($remaining, 0, -2);
        }

        if (strlen($remaining) > 0) {
            $groups[] = $remaining;
        }

        $groups = array_reverse($groups);

        return implode(',', $groups).','.$lastThree;
    }

    private function ensureSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException(
                "Currency mismatch: cannot operate on {$this->currency} and {$other->currency}."
            );
        }
    }

    /**
     * @return array{paise: int, decimal: string, formatted: string, currency: string}
     */
    public function jsonSerialize(): array
    {
        return [
            'paise' => $this->paise,
            'decimal' => $this->toDecimal(),
            'formatted' => $this->formatted(),
            'currency' => $this->currency,
        ];
    }

    public function __toString(): string
    {
        return $this->formatted();
    }
}
