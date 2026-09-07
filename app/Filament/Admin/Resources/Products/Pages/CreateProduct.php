<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products\Pages;

use App\Enums\StockMovementReason;
use App\Filament\Admin\Resources\Products\ProductResource;
use App\Models\Product;
use App\Models\StockMovement;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        /** @var Product $product */
        $product = $this->record;
        $initialStock = (int) ($this->data['inventory_quantity'] ?? 0);

        // Ensure default variant exists
        $variant = $product->variants()->firstOrCreate(
            ['sku' => strtoupper($product->slug . '-STD')],
            [
                'option_label' => 'Standard',
                'price' => $product->base_price,
                'compare_at_price' => $product->compare_at_price,
                'weight_grams' => $product->weight_grams ?? 250,
                'is_active' => true,
            ]
        );

        $inventory = $variant->inventory()->firstOrCreate(
            ['product_variant_id' => $variant->id],
            [
                'quantity_on_hand' => $initialStock,
                'quantity_reserved' => 0,
                'low_stock_threshold' => 10,
                'warehouse_location' => 'Main Warehouse',
            ]
        );

        if ($initialStock > 0) {
            StockMovement::create([
                'product_variant_id' => $variant->id,
                'reason' => StockMovementReason::INITIAL_STOCK,
                'quantity_delta' => $initialStock,
                'balance_after' => $initialStock,
                'actor_id' => auth()->id(),
                'notes' => 'Initial stock registered on product creation',
                'created_at' => now(),
            ]);
        }
    }
}
