<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $referrer_id
 * @property int|null $referee_id
 * @property string $referral_code
 * @property int|null $order_id
 * @property float $cart_total
 * @property float $discount_given
 * @property float $store_credit_awarded
 * @property string $status
 */
class CustomerReferral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referee_id',
        'referral_code',
        'order_id',
        'cart_total',
        'discount_given',
        'store_credit_awarded',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'cart_total' => 'decimal:2',
            'discount_given' => 'decimal:2',
            'store_credit_awarded' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function referee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    /**
     * @return BelongsTo<Order, $this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
