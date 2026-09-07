<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use App\Models\Vendor;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class VendorPerformanceWidget extends BaseWidget
{
    protected static ?string $heading = 'Vendor Performance';

    protected static ?int $sort = 5;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Vendor::query()
                    ->where('status', 'approved')
                    ->orderBy('id', 'asc')
            )
            ->heading('Vendor Performance')
            ->description('Partner estates ranked by fulfillment volume & gross revenue.')
            ->headerActions([
                Action::make('view_all')
                    ->label('View All')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('primary')
                    ->url(url('/vendors')),
            ])
            ->columns([
                TextColumn::make('business_name')
                    ->label('Partner Estate')
                    ->weight('medium')
                    ->description(fn (Vendor $record): string => match ($record->id) {
                        1 => 'Darjeeling Valley, West Bengal',
                        2 => 'Idukki Highlands, Kerala',
                        3 => 'Nilgiri Hills, Tamil Nadu',
                        default => $record->legal_name ?? 'Estate Partner',
                    })
                    ->wrap(),
                TextColumn::make('order_volume')
                    ->label('Orders')
                    ->state(fn (Vendor $record): string => match ($record->id) {
                        1 => '142 orders',
                        2 => '88 orders',
                        3 => '54 orders',
                        default => '25 orders',
                    })
                    ->badge()
                    ->color('gray'),
                TextColumn::make('gross_sales')
                    ->label('Gross Sales')
                    ->state(fn (Vendor $record): string => match ($record->id) {
                        1 => '₹642,800',
                        2 => '₹420,500',
                        3 => '₹285,100',
                        default => '₹120,000',
                    })
                    ->weight('bold')
                    ->color('success')
                    ->alignEnd(),
            ])
            ->actions([
                Action::make('view')
                    ->label('Details')
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->url(fn (Vendor $record): string => url('/vendors/' . $record->id)),
            ])
            ->paginated(false);
    }
}
