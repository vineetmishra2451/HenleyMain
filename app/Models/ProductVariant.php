<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\Money;
use Database\Factories\ProductVariantFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $product_id
 * @property string $sku
 * @property string $option_label
 * @property float $price
 * @property float|null $compare_at_price
 * @property int $weight_grams
 * @property bool $is_active
 */
class ProductVariant extends Model
{
    /** @use HasFactory<ProductVariantFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'option_label',
        'price',
        'compare_at_price',
        'weight_grams',
        'barcode',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'compare_at_price' => 'decimal:2',
            'weight_grams' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return HasOne<Inventory, $this>
     */
    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }

    /**
     * @return HasMany<StockMovement, $this>
     */
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * @return HasMany<ProductImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Formatted price as Money object.
     */
    public function getPriceMoney(): Money
    {
        return Money::fromDecimal($this->price);
    }

    /**
     * Available quantity taking reserved orders into account.
     */
    public function getAvailableStock(): int
    {
        if (! $this->inventory) {
            return 0;
        }

        return max(0, $this->inventory->quantity_on_hand - $this->inventory->quantity_reserved);
    }

    /**
     * @param  Builder<ProductVariant>  $query
     */
    public function scopeInStock(Builder $query): void
    {
        $query->whereHas('inventory', function (Builder $invQuery): void {
            $invQuery->whereRaw('(quantity_on_hand - quantity_reserved) > 0');
        });
    }
}
