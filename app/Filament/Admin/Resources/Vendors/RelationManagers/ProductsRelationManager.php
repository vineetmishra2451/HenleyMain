<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Vendors\RelationManagers;

use App\Enums\ProductStatus;
use App\Filament\Admin\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $title = 'Vendor Products';

    public function form(Schema $schema): Schema
    {
        return ProductResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('primaryImage.file_path')
                    ->label('Thumbnail')
                    ->square()
                    ->defaultImageUrl(fn () => 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"><rect width="40" height="40" fill="%23f3ece4"/><text x="50%" y="54%" font-family="serif" font-size="9" fill="%234B1421" dominant-baseline="middle" text-anchor="middle">Henley</text></svg>'),
                TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(fn (Product $record): string => $record->categories->pluck('name')->join(', ')),
                TextColumn::make('base_price')
                    ->label('Base Price')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('total_stock')
                    ->label('Total Stock')
                    ->state(fn (Product $record): int => (int) $record->variants->sum(fn ($v) => $v->inventory?->quantity_on_hand ?? 0))
                    ->badge()
                    ->color(fn (int $state): string => $state > 10 ? 'success' : ($state > 0 ? 'warning' : 'danger')),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (ProductStatus $state): string => match ($state) {
                        ProductStatus::PUBLISHED => 'Active',
                        ProductStatus::DRAFT => 'Draft',
                        ProductStatus::ARCHIVED => 'Archived',
                    })
                    ->color(fn (ProductStatus $state): string => match ($state) {
                        ProductStatus::PUBLISHED => 'success',
                        ProductStatus::DRAFT => 'gray',
                        ProductStatus::ARCHIVED => 'danger',
                    }),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('New Product')
                    ->url(fn (): string => ProductResource::getUrl('create')),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Edit in Catalog')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Product $record): string => ProductResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
