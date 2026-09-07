<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\VendorStatus;
use App\Models\Scopes\VendorScope;
use Database\Factories\VendorFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property string $business_name
 * @property string $slug
 * @property VendorStatus $status
 * @property float $commission_rate
 */
#[ScopedBy([VendorScope::class])]
class Vendor extends Model
{
    /** @use HasFactory<VendorFactory> */
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'business_name',
        'legal_name',
        'slug',
        'gstin',
        'email',
        'phone',
        'address',
        'commission_rate',
        'status',
        'approved_at',
        'bank_details',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => VendorStatus::class,
            'commission_rate' => 'decimal:2',
            'approved_at' => 'datetime',
            'address' => 'array',
            'bank_details' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Users associated with this Vendor organisation.
     *
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Products supplied by this Vendor.
     *
     * @return HasMany<Product, $this>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Order items assigned to this Vendor.
     *
     * @return HasMany<OrderItem, $this>
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Orders containing products supplied by this Vendor.
     *
     * @return BelongsToMany<Order, $this>
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items', 'vendor_id', 'order_id')->distinct();
    }

    /**
     * Shipments dispatched by this Vendor.
     *
     * @return HasMany<Shipment, $this>
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['business_name', 'status', 'commission_rate', 'gstin', 'email'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
