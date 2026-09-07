<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Vendors\RelationManagers;

use App\Filament\Admin\Resources\Vendors\Widgets\VendorSalesPerformanceWidget;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VendorPerformanceRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $title = 'Vendor Performance';

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Livewire::make(VendorSalesPerformanceWidget::class, ['record' => $this->getOwnerRecord()])
                    ->key('vendor-sales-performance-' . $this->getOwnerRecord()->getKey()),
                EmbeddedTable::make(),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema;
    }

    public function table(Table $table): Table
    {
        $vendorId = $this->getOwnerRecord()->getKey();

        return $table
            ->recordTitleAttribute('name')
            ->heading('Product Fulfillment Velocity')
            ->description('Top revenue contributors and fulfillment volume for this partner estate.')
            ->columns([
                TextColumn::make('name')
                    ->label('Product')
                    ->weight('medium')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('base_price')
                    ->label('Unit Price')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('units_sold')
                    ->label('Units Fulfilled')
                    ->state(fn (Product $record): int => (int) OrderItem::where('vendor_id', $vendorId)->where('product_id', $record->id)->sum('quantity'))
                    ->badge()
                    ->color('gray')
                    ->alignEnd(),
                TextColumn::make('gross_revenue')
                    ->label('Gross Revenue')
                    ->state(fn (Product $record): string => '₹' . number_format((float) OrderItem::where('vendor_id', $vendorId)->where('product_id', $record->id)->sum('line_total'), 2))
                    ->weight('bold')
                    ->color('success')
                    ->alignEnd(),
            ])
            ->paginated([5, 10, 25]);
    }
}
