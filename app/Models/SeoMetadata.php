<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $route_name
 * @property string $path
 * @property string $meta_title
 * @property string|null $meta_description
 * @property string|null $og_image_url
 * @property bool $is_indexable
 */
class SeoMetadata extends Model
{
    use HasFactory;

    protected $table = 'seo_metadatas';

    protected $fillable = [
        'route_name',
        'path',
        'meta_title',
        'meta_description',
        'og_image_url',
        'is_indexable',
    ];

    protected function casts(): array
    {
        return [
            'is_indexable' => 'boolean',
        ];
    }

    public function scopeIndexable(Builder $query): void
    {
        $query->where('is_indexable', true);
    }
}
