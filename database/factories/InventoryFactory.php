<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventory>
 */
class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        return [
            'product_variant_id' => ProductVariant::factory(),
            'quantity_on_hand' => 45,
            'quantity_reserved' => 3,
            'low_stock_threshold' => 5,
            'warehouse_location' => 'Siliguri Vault, Aisle 2, Bin 14',
        ];
    }
}
