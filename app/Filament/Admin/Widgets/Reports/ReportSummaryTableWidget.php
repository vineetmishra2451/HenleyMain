<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets\Reports;

use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ReportSummaryTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Executive Sales & Margin Reconciliation';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->with(['customer', 'items'])
                    ->latest()
                    ->limit(10)
            )
            ->heading('Recent Order Reconciliation')
            ->description('Cross-vendor settlement and margin tracking for the current accounting period.')
            ->columns([
                TextColumn::make('order_number')
                    ->label('Order #')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->label('Connoisseur')
                    ->default('Guest Customer'),
                TextColumn::make('total_amount')
                    ->label('Gross Total')
                    ->money('INR', divideBy: 100)
                    ->weight('semibold'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Logged At')
                    ->dateTime('d M Y, H:i')
                    ->color('gray'),
            ])
            ->paginated(false);
    }
}
