<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products\Pages;

use App\Enums\StockMovementReason;
use App\Filament\Admin\Resources\Products\ProductResource;
use App\Models\Product;
use App\Models\StockMovement;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var Product $product */
        $product = $this->record;
        $data['inventory_quantity'] = (int) $product->variants->sum(fn ($v) => $v->inventory?->quantity_on_hand ?? 0);

        return $data;
    }

    protected function afterSave(): void
    {
        /** @var Product $product */
        $product = $this->record;

        if (isset($this->data['inventory_quantity'])) {
            $newQty = (int) $this->data['inventory_quantity'];
            $variant = $product->variants()->first();

            if (! $variant) {
                $variant = $product->variants()->create([
                    'sku' => strtoupper($product->slug . '-STD'),
                    'option_label' => 'Standard',
                    'price' => $product->base_price,
                    'compare_at_price' => $product->compare_at_price,
                    'weight_grams' => $product->weight_grams ?? 250,
                    'is_active' => true,
                ]);
            }

            $inventory = $variant->inventory;
            if (! $inventory) {
                $inventory = $variant->inventory()->create([
                    'quantity_on_hand' => $newQty,
                    'quantity_reserved' => 0,
                    'low_stock_threshold' => 10,
                    'warehouse_location' => 'Main Warehouse',
                ]);

                if ($newQty > 0) {
                    StockMovement::create([
                        'product_variant_id' => $variant->id,
                        'reason' => StockMovementReason::INITIAL_STOCK,
                        'quantity_delta' => $newQty,
                        'balance_after' => $newQty,
                        'actor_id' => auth()->id(),
                        'notes' => 'Inventory initialized via product edit form',
                        'created_at' => now(),
                    ]);
                }
            } elseif ($inventory->quantity_on_hand !== $newQty) {
                $delta = $newQty - $inventory->quantity_on_hand;
                $inventory->update(['quantity_on_hand' => $newQty]);

                StockMovement::create([
                    'product_variant_id' => $variant->id,
                    'reason' => StockMovementReason::MANUAL_ADJUSTMENT,
                    'quantity_delta' => $delta,
                    'balance_after' => $newQty,
                    'actor_id' => auth()->id(),
                    'notes' => 'Stock quantity updated via product edit form',
                    'created_at' => now(),
                ]);
            }
        }
    }
}
