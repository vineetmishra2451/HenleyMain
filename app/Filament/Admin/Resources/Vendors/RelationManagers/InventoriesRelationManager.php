<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Vendors\RelationManagers;

use App\Enums\StockMovementReason;
use App\Models\Inventory;
use App\Models\StockMovement;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;

class InventoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $title = 'Vendor Inventory';

    public function getRelationship(): Relation | Builder
    {
        return Inventory::query()
            ->with(['variant.product'])
            ->whereHas('variant.product', fn (Builder $q) => $q->where('vendor_id', $this->getOwnerRecord()->getKey()));
    }

    public function form(Schema $schema): Schema
    {
        return $schema;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('variant.product.name')
            ->columns([
                TextColumn::make('variant.product.name')
                    ->label('Product / Variant')
                    ->description(fn (Inventory $record): string => ($record->variant?->sku ?? 'No SKU') . ($record->variant?->option_label ? ' • ' . $record->variant->option_label : ''))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('quantity_on_hand')
                    ->label('On Hand')
                    ->numeric()
                    ->sortable()
                    ->alignEnd(),
                TextColumn::make('quantity_reserved')
                    ->label('Reserved')
                    ->numeric()
                    ->sortable()
                    ->alignEnd(),
                TextColumn::make('available')
                    ->label('Available')
                    ->state(fn (Inventory $record): int => $record->availableQuantity())
                    ->badge()
                    ->color(fn (int $state, Inventory $record): string => $state <= 0 ? 'danger' : ($state <= $record->low_stock_threshold ? 'warning' : 'success'))
                    ->alignEnd(),
                TextColumn::make('low_stock_threshold')
                    ->label('Alert Threshold')
                    ->numeric()
                    ->alignEnd(),
                TextColumn::make('warehouse_location')
                    ->label('Location')
                    ->badge()
                    ->color('gray'),
            ])
            ->recordActions([
                Action::make('adjust')
                    ->label('Adjust')
                    ->icon('heroicon-m-arrows-up-down')
                    ->color('primary')
                    ->form([
                        TextInput::make('delta')
                            ->label('Stock Delta (+/-)')
                            ->numeric()
                            ->required()
                            ->helperText('Positive to add received inventory, negative to write off damaged stock.'),
                        Select::make('reason')
                            ->label('Reason')
                            ->options(collect(StockMovementReason::cases())->mapWithKeys(fn ($r) => [$r->value => $r->label()]))
                            ->default(StockMovementReason::MANUAL_ADJUSTMENT->value)
                            ->required(),
                        Textarea::make('notes')
                            ->label('Audit Note'),
                    ])
                    ->action(function (Inventory $record, array $data): void {
                        $delta = (int) $data['delta'];
                        $newStock = max(0, $record->quantity_on_hand + $delta);
                        $record->update(['quantity_on_hand' => $newStock]);

                        StockMovement::create([
                            'product_variant_id' => $record->product_variant_id,
                            'actor_id' => Auth::id(),
                            'quantity_delta' => $delta,
                            'balance_after' => $newStock,
                            'reason' => StockMovementReason::from($data['reason']),
                            'notes' => $data['notes'] ?? null,
                        ]);

                        Notification::make()
                            ->title('Vendor Stock Adjusted')
                            ->body("New balance is {$newStock} units.")
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
