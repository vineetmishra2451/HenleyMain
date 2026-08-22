<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Support\Money;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property string $order_number
 * @property OrderStatus $status
 * @property PaymentStatus $payment_status
 * @property float $subtotal
 * @property float $discount_amount
 * @property float $tax_amount
 * @property float $shipping_amount
 * @property float $grand_total
 * @property array $customer_snapshot
 * @property array $shipping_address
 * @property array $billing_address
 */
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_id',
        'customer_snapshot',
        'shipping_address',
        'billing_address',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'shipping_amount',
        'grand_total',
        'coupon_id',
        'status',
        'payment_status',
        'currency',
        'placed_at',
        'fulfilled_at',
        'cancelled_at',
        'customer_notes',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'payment_status' => PaymentStatus::class,
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'shipping_amount' => 'decimal:2',
            'grand_total' => 'decimal:2',
            'customer_snapshot' => 'array',
            'shipping_address' => 'array',
            'billing_address' => 'array',
            'placed_at' => 'datetime',
            'fulfilled_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'order_number';
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo<Coupon, $this>
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * @return HasMany<OrderItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return HasMany<Payment, $this>
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * @return HasMany<Refund, $this>
     */
    public function refunds(): HasMany
    {
        return $this->hasMany(Refund::class);
    }

    /**
     * @return HasMany<Shipment, $this>
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    public function getGrandTotalMoney(): Money
    {
        return Money::fromDecimal($this->grand_total);
    }

    /**
     * Scope for filtering orders containing items from a specific vendor.
     *
     * @param  Builder<Order>  $query
     */
    public function scopeForVendor(Builder $query, int $vendorId): void
    {
        $query->whereHas('items', function (Builder $itemQuery) use ($vendorId): void {
            $itemQuery->where('vendor_id', $vendorId);
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['order_number', 'status', 'payment_status', 'grand_total'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
