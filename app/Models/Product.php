<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductStatus;
use App\Models\Scopes\VendorScope;
use App\Support\Money;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property ProductStatus $status
 * @property float $base_price
 * @property float|null $compare_at_price
 * @property float $rating_average
 * @property int $rating_count
 * @property bool $is_featured
 * @property bool $is_bestseller
 * @property int|null $vendor_id
 */
#[ScopedBy([VendorScope::class])]
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'brand_id',
        'name',
        'slug',
        'short_description',
        'description',
        'ingredients',
        'brewing_guide',
        'status',
        'is_featured',
        'is_bestseller',
        'base_price',
        'compare_at_price',
        'tax_rate_percent',
        'weight_grams',
        'dimensions',
        'rating_average',
        'rating_count',
        'published_at',
        'seo_title',
        'seo_description',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProductStatus::class,
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'base_price' => 'decimal:2',
            'compare_at_price' => 'decimal:2',
            'tax_rate_percent' => 'decimal:2',
            'rating_average' => 'decimal:2',
            'rating_count' => 'integer',
            'published_at' => 'datetime',
            'dimensions' => 'array',
            'metadata' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::saved(function (): void {
            \Illuminate\Support\Facades\Cache::tags(['products', 'homepage'])->flush();
        });

        static::deleted(function (): void {
            \Illuminate\Support\Facades\Cache::tags(['products', 'homepage'])->flush();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsTo<Vendor, $this>
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * @return BelongsTo<Brand, $this>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany<Category, $this>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    /**
     * @return HasMany<ProductVariant, $this>
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->orderBy('sort_order');
    }

    /**
     * @return HasMany<ProductAttribute, $this>
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class)->orderBy('sort_order');
    }

    /**
     * @return HasMany<ProductImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * @return HasOne<ProductImage, $this>
     */
    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    /**
     * @return BelongsToMany<TaxonomyTerm, $this>
     */
    public function taxonomyTerms(): BelongsToMany
    {
        return $this->belongsToMany(TaxonomyTerm::class, 'product_taxonomy_term')->withTimestamps();
    }

    /**
     * @return HasMany<Review, $this>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return HasMany<OrderItem, $this>
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get first assigned category as primary category.
     */
    public function getPrimaryCategoryAttribute(): ?Category
    {
        return $this->categories->first();
    }

    /**
     * Primary image URL accessor.
     */
    public function getPrimaryImageAttribute(): ?string
    {
        if ($this->relationLoaded('primaryImage') && $this->getRelation('primaryImage')) {
            return $this->getRelation('primaryImage')?->url;
        }

        if ($this->relationLoaded('images')) {
            return $this->images->first()?->url;
        }

        return $this->primaryImage()->first()?->url ?? $this->images()->first()?->url;
    }

    /**
     * Formatted Money value object for base price.
     */
    public function getPriceMoney(): Money
    {
        return Money::fromDecimal($this->base_price);
    }

    /**
     * Price accessor returning Money object.
     */
    public function getPriceAttribute(): Money
    {
        return $this->getPriceMoney();
    }

    /**
     * Compare at price Money accessor.
     */
    public function getCompareAtPriceMoneyAttribute(): ?Money
    {
        return $this->compare_at_price !== null ? Money::fromDecimal($this->compare_at_price) : null;
    }

    // -------------------------------------------------------------------------
    // Query Scopes
    // -------------------------------------------------------------------------

    /**
     * Scope for published storefront products.
     *
     * @param  Builder<Product>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', ProductStatus::PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope for active products (alias of published).
     *
     * @param  Builder<Product>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $this->scopePublished($query);
    }

    /**
     * Scope for featured items.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    /**
     * Scope for bestseller items.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeBestseller(Builder $query): void
    {
        $query->where('is_bestseller', true);
    }

    /**
     * Scope for in-stock products with active variant inventory.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeInStock(Builder $query): void
    {
        $query->whereHas('variants.inventory', function (Builder $invQuery): void {
            $invQuery->whereRaw('(quantity_on_hand - quantity_reserved) > 0');
        });
    }

    /**
     * Scope explicitly for a given vendor.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeForVendor(Builder $query, int $vendorId): void
    {
        $query->where('vendor_id', $vendorId);
    }

    /**
     * High performance PostgreSQL Full-Text Search via tsvector and websearch_to_tsquery.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeSearch(Builder $query, string $term): void
    {
        $cleaned = trim($term);
        if ($cleaned === '') {
            return;
        }

        if (DB::getDriverName() === 'pgsql') {
            $query->whereRaw("search_vector @@ websearch_to_tsquery('english', ?)", [$cleaned])
                ->orderByRaw("ts_rank(search_vector, websearch_to_tsquery('english', ?)) DESC", [$cleaned]);
        } else {
            $query->where(function (Builder $q) use ($cleaned): void {
                $q->where('name', 'like', "%{$cleaned}%")
                    ->orWhere('short_description', 'like', "%{$cleaned}%")
                    ->orWhere('description', 'like', "%{$cleaned}%")
                    ->orWhere('ingredients', 'like', "%{$cleaned}%");
            });
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'status', 'base_price', 'is_featured', 'is_bestseller'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
