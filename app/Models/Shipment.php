<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ShipmentStatus;
use App\Models\Scopes\VendorScope;
use Database\Factories\ShipmentFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property int $order_id
 * @property int|null $vendor_id
 * @property string $shipment_number
 * @property string $courier_name
 * @property string $tracking_number
 * @property ShipmentStatus $status
 */
#[ScopedBy([VendorScope::class])]
class Shipment extends Model
{
    /** @use HasFactory<ShipmentFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'order_id',
        'vendor_id',
        'shipment_number',
        'courier_name',
        'tracking_number',
        'tracking_url',
        'status',
        'shipped_at',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => ShipmentStatus::class,
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Order, $this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo<Vendor, $this>
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['shipment_number', 'courier_name', 'tracking_number', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
