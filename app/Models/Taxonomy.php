<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TaxonomyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $is_filterable
 */
class Taxonomy extends Model
{
    /** @use HasFactory<TaxonomyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'is_filterable',
    ];

    protected function casts(): array
    {
        return [
            'is_filterable' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return HasMany<TaxonomyTerm, $this>
     */
    public function terms(): HasMany
    {
        return $this->hasMany(TaxonomyTerm::class)->orderBy('sort_order');
    }
}
