<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Widgets;

use App\Models\Inventory;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class VendorInventoryAlertsWidget extends BaseWidget
{
    protected static ?string $heading = 'Inventory Alerts';

    protected static ?int $sort = 5;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Scoped automatically by VendorScope to only this vendor's products & variants
                Inventory::query()
                    ->with(['variant.product'])
                    ->whereColumn('quantity_on_hand', '<=', 'low_stock_threshold')
                    ->orderBy('quantity_on_hand', 'asc')
            )
            ->heading('Inventory Alerts')
            ->description('Low-stock and depleted products requiring estate allocation or cellar replenishment.')
            ->columns([
                TextColumn::make('variant.product.name')
                    ->label('Product')
                    ->weight('medium')
                    ->description(fn (Inventory $record): string => $record->variant?->sku ?? 'Standard SKU')
                    ->wrap(),

                TextColumn::make('variant.option_label')
                    ->label('Variant / Weight')
                    ->badge()
                    ->color('gray')
                    ->default('Standard Tin (100g)'),

                TextColumn::make('quantity_on_hand')
                    ->label('Current Reserve')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 2 => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (int $state): string => match (true) {
                        $state === 0 => 'Out of Stock (0)',
                        default => "{$state} units remaining",
                    }),

                TextColumn::make('low_stock_threshold')
                    ->label('Alert Threshold')
                    ->formatStateUsing(fn (int $state): string => "{$state} units")
                    ->alignEnd(),
            ])
            ->actions([
                Action::make('view')
                    ->label('View Reserve')
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->url(url('/inventory')),
            ])
            ->paginated(false);
    }
}
