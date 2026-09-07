<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Inventories\Pages;

use App\Enums\StockMovementReason;
use App\Filament\Vendor\Resources\Inventories\InventoryResource;
use App\Models\StockMovement;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class InventoryHistory extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = InventoryResource::class;

    protected string $view = 'filament.admin.pages.inventory-history';

    protected static ?string $title = 'Cellar Audit & Stock History';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('backToOverview')
                ->label('Back to Stock Overview')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(fn (): string => InventoryResource::getUrl('index')),
        ];
    }

    public function table(Table $table): Table
    {
        $vendorId = Auth::user()?->vendor_id;

        return $table
            ->query(
                StockMovement::query()
                    ->when($vendorId, fn (Builder $q) => $q->whereHas('variant.product', fn (Builder $pq) => $pq->where('vendor_id', $vendorId)))
                    ->with(['variant.product', 'actor'])
                    ->latest('created_at')
            )
            ->columns([
                TextColumn::make('variant.product.name')
                    ->label('Product / Vintage')
                    ->description(fn (StockMovement $record): string => ($record->variant?->sku ?? 'No SKU') . ($record->variant?->option_label ? ' • ' . $record->variant->option_label : ''))
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                TextColumn::make('quantity_delta')
                    ->label('Change')
                    ->formatStateUsing(fn (int $state): string => ($state > 0 ? '+' : '') . $state)
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'success' : ($state < 0 ? 'danger' : 'gray'))
                    ->sortable(),
                TextColumn::make('balance_after')
                    ->label('Balance After')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reason')
                    ->label('Reason')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof StockMovementReason ? $state->label() : (StockMovementReason::tryFrom((string)$state)?->label() ?? (string)$state))
                    ->color(fn ($state): string => $state instanceof StockMovementReason ? $state->color() : (StockMovementReason::tryFrom((string)$state)?->color() ?? 'gray')),
                TextColumn::make('actor.name')
                    ->label('Adjusted By')
                    ->placeholder('Cellar Automation')
                    ->icon('heroicon-o-user'),
                TextColumn::make('notes')
                    ->label('Audit Notes')
                    ->limit(50)
                    ->placeholder('—'),
                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->dateTime('M j, Y, g:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
