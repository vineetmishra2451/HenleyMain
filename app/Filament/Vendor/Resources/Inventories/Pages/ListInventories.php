<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Inventories\Pages;

use App\Enums\StockMovementReason;
use App\Filament\Vendor\Resources\Inventories\InventoryResource;
use App\Models\Inventory;
use App\Models\StockMovement;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListInventories extends ListRecords
{
    protected static string $resource = InventoryResource::class;

    protected static ?string $title = 'Cellar Inventory & Stocks';

    public function getTabs(): array
    {
        $vendorId = Auth::user()?->vendor_id;

        $baseQuery = fn () => Inventory::query()
            ->when($vendorId, fn (Builder $q) => $q->whereHas('variant.product', fn (Builder $pq) => $pq->where('vendor_id', $vendorId)));

        $allCount = $baseQuery()->count();
        $lowStockCount = $baseQuery()
            ->whereRaw('(quantity_on_hand - quantity_reserved) <= low_stock_threshold AND (quantity_on_hand - quantity_reserved) > 0')
            ->count();
        $outOfStockCount = $baseQuery()
            ->whereRaw('(quantity_on_hand - quantity_reserved) <= 0')
            ->count();

        return [
            'all' => Tab::make('All Stock')
                ->badge($allCount),
            'low_stock' => Tab::make('Low Stock')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRaw('(quantity_on_hand - quantity_reserved) <= low_stock_threshold AND (quantity_on_hand - quantity_reserved) > 0'))
                ->badge($lowStockCount)
                ->badgeColor('warning'),
            'out_of_stock' => Tab::make('Out of Stock')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRaw('(quantity_on_hand - quantity_reserved) <= 0'))
                ->badge($outOfStockCount)
                ->badgeColor('danger'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('quickAdjust')
                ->label('Stock Adjustment')
                ->icon('heroicon-o-plus-circle')
                ->color('primary')
                ->form([
                    Select::make('inventory_id')
                        ->label('Product Variant')
                        ->options(function () {
                            $vendorId = Auth::user()?->vendor_id;

                            return Inventory::with('variant.product')
                                ->when($vendorId, fn (Builder $q) => $q->whereHas('variant.product', fn (Builder $pq) => $pq->where('vendor_id', $vendorId)))
                                ->get()
                                ->mapWithKeys(fn (Inventory $i) => [
                                    $i->id => ($i->variant?->product?->name ?? 'Unknown') . ' (' . ($i->variant?->sku ?? 'No SKU') . ') — ' . $i->quantity_on_hand . ' on hand',
                                ]);
                        })
                        ->searchable()
                        ->required(),
                    TextInput::make('quantity_delta')
                        ->label('Quantity Delta (+/-)')
                        ->helperText('Positive number to add, negative number to deduct.')
                        ->numeric()
                        ->required(),
                    Select::make('reason')
                        ->label('Adjustment Reason')
                        ->options(collect(StockMovementReason::cases())->mapWithKeys(fn ($r) => [$r->value => $r->label()]))
                        ->default(StockMovementReason::MANUAL_ADJUSTMENT->value)
                        ->required(),
                    Textarea::make('notes')
                        ->label('Audit Notes')
                        ->placeholder('Reason for inventory update'),
                ])
                ->action(function (array $data): void {
                    $inventory = Inventory::findOrFail($data['inventory_id']);
                    $delta = (int) $data['quantity_delta'];
                    $newOnHand = max(0, $inventory->quantity_on_hand + $delta);

                    $inventory->update([
                        'quantity_on_hand' => $newOnHand,
                    ]);

                    StockMovement::create([
                        'product_variant_id' => $inventory->product_variant_id,
                        'reason' => StockMovementReason::from($data['reason']),
                        'quantity_delta' => $delta,
                        'balance_after' => $newOnHand,
                        'actor_id' => Auth::id(),
                        'notes' => $data['notes'] ?? null,
                        'created_at' => now(),
                    ]);

                    Notification::make()
                        ->title('Stock Adjusted')
                        ->body("Inventory updated to {$newOnHand} units.")
                        ->success()
                        ->send();
                }),

            Action::make('viewHistory')
                ->label('Audit History')
                ->icon('heroicon-o-clock')
                ->color('gray')
                ->url(fn (): string => InventoryResource::getUrl('history')),
        ];
    }
}
