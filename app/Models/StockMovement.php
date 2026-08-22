<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StockMovementReason;
use Database\Factories\StockMovementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Append-Only Stock Movements Ledger.
 *
 * @property int $id
 * @property int $product_variant_id
 * @property StockMovementReason $reason
 * @property int $quantity_delta
 * @property int $balance_after
 */
class StockMovement extends Model
{
    /** @use HasFactory<StockMovementFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_variant_id',
        'reason',
        'quantity_delta',
        'balance_after',
        'actor_id',
        'reference_type',
        'reference_id',
        'notes',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'reason' => StockMovementReason::class,
            'quantity_delta' => 'integer',
            'balance_after' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<ProductVariant, $this>
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
