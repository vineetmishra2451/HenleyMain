<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RefundStatus;
use App\Support\Money;
use Database\Factories\RefundFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property int $order_id
 * @property string $refund_number
 * @property float $amount
 * @property RefundStatus $status
 */
class Refund extends Model
{
    /** @use HasFactory<RefundFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'order_id',
        'payment_id',
        'refund_number',
        'gateway_refund_id',
        'amount',
        'reason',
        'status',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => RefundStatus::class,
            'amount' => 'decimal:2',
            'processed_at' => 'datetime',
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
     * @return BelongsTo<Payment, $this>
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function getAmountMoney(): Money
    {
        return Money::fromDecimal($this->amount);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['refund_number', 'amount', 'status', 'reason'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
