<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\HomepageSectionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string $type
 * @property int $sort_order
 * @property bool $is_active
 * @property array<string, mixed> $payload
 */
class HomepageSection extends Model
{
    /** @use HasFactory<HomepageSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'type',
        'sort_order',
        'is_active',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'payload' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::saved(function (): void {
            \Illuminate\Support\Facades\Cache::tags(['homepage'])->flush();
        });

        static::deleted(function (): void {
            \Illuminate\Support\Facades\Cache::tags(['homepage'])->flush();
        });
    }

    /**
     * @param  Builder<HomepageSection>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true)->orderBy('sort_order');
    }
}
