<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Inventories\Pages;

use App\Enums\StockMovementReason;
use App\Filament\Admin\Resources\Inventories\InventoryResource;
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

    protected static ?string $title = 'Inventory Management';

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Stock')
                ->badge(Inventory::count()),
            'low_stock' => Tab::make('Low Stock')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRaw('(quantity_on_hand - quantity_reserved) <= low_stock_threshold AND (quantity_on_hand - quantity_reserved) > 0'))
                ->badge(Inventory::whereRaw('(quantity_on_hand - quantity_reserved) <= low_stock_threshold AND (quantity_on_hand - quantity_reserved) > 0')->count())
                ->badgeColor('warning'),
            'out_of_stock' => Tab::make('Out of Stock')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRaw('(quantity_on_hand - quantity_reserved) <= 0'))
                ->badge(Inventory::whereRaw('(quantity_on_hand - quantity_reserved) <= 0')->count())
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
                        ->options(fn () => Inventory::with('variant.product')->get()->mapWithKeys(fn (Inventory $i) => [
                            $i->id => ($i->variant?->product?->name ?? 'Unknown') . ' (' . ($i->variant?->sku ?? 'No SKU') . ') — ' . $i->quantity_on_hand . ' on hand',
                        ]))
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
                        ->placeholder('Reason for inventory discrepancy or supplier replenishment PO'),
                ])
                ->action(function (array $data): void {
                    /** @var Inventory $inventory */
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
                        ->title('Stock Adjustment Complete')
                        ->body("Inventory balance updated to {$newOnHand} units.")
                        ->success()
                        ->send();
                }),

            Action::make('viewHistory')
                ->label('Inventory History')
                ->icon('heroicon-o-clock')
                ->color('gray')
                ->url(fn (): string => InventoryResource::getUrl('history')),
        ];
    }
}
