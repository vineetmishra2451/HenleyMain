<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AddressType;
use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $customer_id
 * @property string $recipient_name
 * @property string $line_1
 * @property string $city
 * @property string $state
 * @property string $pincode
 * @property AddressType $type
 * @property bool $is_default_shipping
 * @property bool $is_default_billing
 */
class Address extends Model
{
    /** @use HasFactory<AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'recipient_name',
        'phone',
        'line_1',
        'line_2',
        'landmark',
        'city',
        'state',
        'pincode',
        'country',
        'type',
        'is_default_shipping',
        'is_default_billing',
        'latitude',
        'longitude',
    ];

    protected function casts(): array
    {
        return [
            'type' => AddressType::class,
            'is_default_shipping' => 'boolean',
            'is_default_billing' => 'boolean',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
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
     * Formatted multi-line address string.
     */
    public function toFormattedString(): string
    {
        $parts = array_filter([
            $this->recipient_name,
            $this->line_1,
            $this->line_2,
            $this->landmark ? "Near {$this->landmark}" : null,
            "{$this->city}, {$this->state} - {$this->pincode}",
            $this->country === 'IN' ? 'India' : $this->country,
            "Phone: {$this->phone}",
        ]);

        return implode("\n", $parts);
    }
}
