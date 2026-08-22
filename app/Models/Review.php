<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ReviewStatus;
use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $rating
 * @property string $title
 * @property string $body
 * @property ReviewStatus $status
 * @property bool $is_verified_purchase
 */
class Review extends Model
{
    /** @use HasFactory<ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'customer_id',
        'customer_name',
        'rating',
        'title',
        'body',
        'is_verified_purchase',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_verified_purchase' => 'boolean',
            'status' => ReviewStatus::class,
            'published_at' => 'datetime',
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
     * Automatically update product rating stats on review save/delete.
     */
    protected static function booted(): void
    {
        static::saved(function (self $review): void {
            $product = $review->product;
            if ($product) {
                $avg = (float) $product->reviews()->where('status', ReviewStatus::APPROVED)->avg('rating');
                $count = (int) $product->reviews()->where('status', ReviewStatus::APPROVED)->count();
                $product->updateQuietly([
                    'rating_average' => round($avg, 2),
                    'rating_count' => $count,
                ]);
            }
        });
    }

    /**
     * @param  Builder<Review>  $query
     */
    public function scopeApproved(Builder $query): void
    {
        $query->where('status', ReviewStatus::APPROVED);
    }
}
