<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\StockMovementReason;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockMovement>
 */
class StockMovementFactory extends Factory
{
    protected $model = StockMovement::class;

    public function definition(): array
    {
        return [
            'product_variant_id' => ProductVariant::factory(),
            'reason' => StockMovementReason::INITIAL_STOCK,
            'quantity_delta' => 50,
            'balance_after' => 50,
            'actor_id' => User::factory(),
            'reference_type' => 'InitialBatch',
            'reference_id' => 'BATCH-2026-001',
            'notes' => 'Seasonal harvest intake verified by master tea taster.',
            'created_at' => now(),
        ];
    }
}
