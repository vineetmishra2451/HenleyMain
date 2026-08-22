<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\JournalPostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property bool $is_published
 */
class JournalPost extends Model
{
    /** @use HasFactory<JournalPostFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'cover_image',
        'author_name',
        'reading_time_minutes',
        'is_published',
        'published_at',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'reading_time_minutes' => 'integer',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @param  Builder<JournalPost>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    protected static function booted(): void
    {
        static::saved(function (): void {
            \App\Services\HomepageService::clearCache();
        });

        static::deleted(function (): void {
            \App\Services\HomepageService::clearCache();
        });
    }
}
