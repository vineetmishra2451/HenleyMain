<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Products\Pages;

use App\Filament\Vendor\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $title = 'Add Product to Cellar';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['vendor_id'] = Auth::user()?->vendor_id;

        return $data;
    }

    protected function afterCreate(): void
    {
        /** @var \App\Models\Product $record */
        $record = $this->getRecord();
        $stock = (int) ($this->data['inventory_quantity'] ?? 50);

        // Create standard variant and inventory
        $variant = $record->variants()->create([
            'option_label' => 'Standard Edition',
            'sku' => 'HNL-' . strtoupper(Str::random(6)),
            'price' => $record->base_price,
            'weight_grams' => $record->weight_grams ?? 100,
            'is_active' => true,
        ]);

        $variant->inventory()->create([
            'quantity_on_hand' => $stock,
            'quantity_reserved' => 0,
            'low_stock_threshold' => 5,
            'warehouse_location' => 'Estate Cellar Reserve',
        ]);
    }
}
