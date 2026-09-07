<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string $placement
 * @property string|null $headline
 * @property string|null $body
 * @property string|null $coupon_code
 * @property string|null $button_label
 * @property string|null $button_url
 * @property bool $is_active
 */
class PromotionalContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'placement',
        'headline',
        'body',
        'coupon_code',
        'button_label',
        'button_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
