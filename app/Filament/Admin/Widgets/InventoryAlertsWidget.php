<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use App\Models\Inventory;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class InventoryAlertsWidget extends BaseWidget
{
    protected static ?string $heading = 'Inventory Alerts';

    protected static ?int $sort = 4;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inventory::query()
                    ->with(['variant.product'])
                    ->whereColumn('quantity_on_hand', '<=', 'low_stock_threshold')
                    ->orderBy('quantity_on_hand', 'asc')
            )
            ->heading('Inventory Alerts')
            ->description('Low-stock and depleted products requiring warehouse restock.')
            ->columns([
                TextColumn::make('variant.product.name')
                    ->label('Product')
                    ->weight('medium')
                    ->description(fn (Inventory $record): string => $record->variant?->option_label ?? 'Standard')
                    ->wrap(),
                TextColumn::make('quantity_on_hand')
                    ->label('Current Stock')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 2 => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (int $state): string => match (true) {
                        $state === 0 => 'Out of Stock (0)',
                        default => "{$state} units",
                    }),
                TextColumn::make('low_stock_threshold')
                    ->label('Threshold')
                    ->formatStateUsing(fn (int $state): string => "{$state} units")
                    ->alignEnd(),
            ])
            ->actions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->url(fn (Inventory $record): string => url('/products/' . ($record->variant?->product?->id ?? ''))),
            ])
            ->paginated(false);
    }
}
