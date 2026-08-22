<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CouponType;
use Database\Factories\CouponFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $code
 * @property CouponType $type
 * @property float $value
 * @property float|null $min_order_amount
 * @property float|null $max_discount_amount
 * @property int|null $usage_limit_total
 * @property int|null $usage_limit_per_customer
 * @property int $total_uses
 * @property bool $is_active
 */
class Coupon extends Model
{
    /** @use HasFactory<CouponFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit_total',
        'usage_limit_per_customer',
        'total_uses',
        'applicability_scope',
        'scope_ids',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'type' => CouponType::class,
            'value' => 'decimal:2',
            'min_order_amount' => 'decimal:2',
            'max_discount_amount' => 'decimal:2',
            'usage_limit_total' => 'integer',
            'usage_limit_per_customer' => 'integer',
            'total_uses' => 'integer',
            'is_active' => 'boolean',
            'scope_ids' => 'array',
            'starts_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<CouponRedemption, $this>
     */
    public function redemptions(): HasMany
    {
        return $this->hasMany(CouponRedemption::class);
    }

    public function isValidForOrder(float $subtotal, ?int $userId = null): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->starts_at && now()->lt($this->starts_at)) {
            return false;
        }

        if ($this->expires_at && now()->gt($this->expires_at)) {
            return false;
        }

        if ($this->usage_limit_total !== null && $this->total_uses >= $this->usage_limit_total) {
            return false;
        }

        if ($this->min_order_amount !== null && $subtotal < $this->min_order_amount) {
            return false;
        }

        if ($userId && $this->usage_limit_per_customer !== null) {
            $userRedemptions = $this->redemptions()->where('user_id', $userId)->count();
            if ($userRedemptions >= $this->usage_limit_per_customer) {
                return false;
            }
        }

        return true;
    }

    /**
     * Calculate discount given a subtotal.
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === CouponType::PERCENTAGE) {
            $discount = ($subtotal * $this->value) / 100.0;
            if ($this->max_discount_amount !== null) {
                $discount = min($discount, (float) $this->max_discount_amount);
            }

            return round($discount, 2);
        }

        return min($subtotal, (float) $this->value);
    }

    /**
     * @param  Builder<Coupon>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true)
            ->where(fn (Builder $q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn (Builder $q) => $q->whereNull('expires_at')->orWhere('expires_at', '>=', now()));
    }
}
