<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Inventories;

use App\Enums\StockMovementReason;
use App\Filament\Admin\Resources\Inventories\Pages\InventoryHistory;
use App\Filament\Admin\Resources\Inventories\Pages\ListInventories;
use App\Models\Inventory;
use App\Models\StockMovement;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static string|UnitEnum|null $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $navigationLabel = 'Inventory';

    protected static ?string $modelLabel = 'Inventory';

    protected static ?string $pluralModelLabel = 'Inventory';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('variant.product.name')
                    ->label('Product / Variant')
                    ->description(fn (Inventory $record): string => ($record->variant?->sku ?? 'No SKU') . ($record->variant?->option_label ? ' • ' . $record->variant->option_label : ''))
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                TextColumn::make('variant.sku')
                    ->label('SKU')
                    ->searchable()
                    ->copyable()
                    ->color('gray'),
                TextColumn::make('quantity_on_hand')
                    ->label('Current Stock')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),
                TextColumn::make('quantity_reserved')
                    ->label('Reserved')
                    ->numeric()
                    ->sortable()
                    ->color('gray'),
                TextColumn::make('available_stock')
                    ->label('Available')
                    ->state(fn (Inventory $record): int => $record->availableQuantity())
                    ->numeric()
                    ->sortable(query: fn (Builder $query, string $direction) => $query->orderByRaw('(quantity_on_hand - quantity_reserved) ' . $direction))
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),
                TextColumn::make('low_stock_threshold')
                    ->label('Reorder Threshold')
                    ->numeric()
                    ->description(fn (Inventory $record): string => $record->isOutOfStock() ? 'Depleted' : ($record->isLowStock() ? 'Low Stock' : 'Healthy'))
                    ->sortable(),
                TextColumn::make('warehouse_location')
                    ->label('Warehouse')
                    ->default('Main Warehouse')
                    ->placeholder('Main Warehouse')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('adjustStock')
                    ->label('Adjust Stock')
                    ->icon('heroicon-o-arrows-up-down')
                    ->color('warning')
                    ->form([
                        TextInput::make('current_quantity')
                            ->label('Current On Hand')
                            ->disabled()
                            ->default(fn (Inventory $record): int => $record->quantity_on_hand),
                        TextInput::make('quantity_delta')
                            ->label('Quantity Delta (+/-)')
                            ->helperText('Enter a positive number to add stock (e.g. 25), or negative to deduct (e.g. -5).')
                            ->numeric()
                            ->required(),
                        Select::make('reason')
                            ->label('Adjustment Reason')
                            ->options(collect(StockMovementReason::cases())->mapWithKeys(fn ($r) => [$r->value => $r->label()]))
                            ->default(StockMovementReason::MANUAL_ADJUSTMENT->value)
                            ->required(),
                        Textarea::make('notes')
                            ->label('Audit Notes')
                            ->placeholder('e.g. Physical inventory reconciliation, damaged batch write-off'),
                    ])
                    ->action(function (Inventory $record, array $data): void {
                        $delta = (int) $data['quantity_delta'];
                        $newOnHand = max(0, $record->quantity_on_hand + $delta);

                        $record->update([
                            'quantity_on_hand' => $newOnHand,
                        ]);

                        StockMovement::create([
                            'product_variant_id' => $record->product_variant_id,
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInventories::route('/'),
            'history' => InventoryHistory::route('/history'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['variant.product']);
    }
}
