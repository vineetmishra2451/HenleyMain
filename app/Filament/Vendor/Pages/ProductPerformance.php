<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Pages;

use App\Models\Product;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class ProductPerformance extends Page implements HasTable
{
    use InteractsWithTable;

    protected static \UnitEnum|string|null $navigationGroup = 'Sales';

    protected static ?string $navigationLabel = 'Product Performance';

    protected static ?string $slug = 'sales/product-performance';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected string $view = 'filament.vendor.pages.product-performance';

    public function getTitle(): string | Htmlable
    {
        return 'Harvest Product Performance & Velocity';
    }

    public function getSubheading(): string | Htmlable | null
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $estate = $user?->vendor?->business_name ?? 'your estate';

        return "Sales rankings, customer demand volume, and cellar turnover velocity for {$estate}.";
    }

    public function table(Table $table): Table
    {
        $vendorId = Auth::user()?->vendor_id;

        return $table
            ->query(
                Product::query()
                    ->when($vendorId, fn (Builder $q) => $q->where('vendor_id', $vendorId))
                    ->with(['categories', 'brand', 'variants.inventory', 'orderItems'])
            )
            ->columns([
                TextColumn::make('rank')
                    ->label('# Rank')
                    ->rowIndex()
                    ->badge()
                    ->color(fn (string $state): string => match ((int) $state) {
                        1 => 'warning',
                        2 => 'gray',
                        3 => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('name')
                    ->label('Product / Vintage')
                    ->description(fn (Product $record): string => $record->slug)
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                TextColumn::make('categories.name')
                    ->label('Category')
                    ->badge()
                    ->color('gray')
                    ->separator(', '),
                TextColumn::make('units_sold')
                    ->label('Units Sold')
                    ->state(fn (Product $record): int => (int) $record->orderItems->sum('quantity'))
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                TextColumn::make('total_revenue')
                    ->label('Gross Revenue')
                    ->state(fn (Product $record): float => (float) $record->orderItems->sum('line_total'))
                    ->money('INR')
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('stock_on_hand')
                    ->label('Current Stock')
                    ->state(fn (Product $record): int => (int) $record->variants->sum(fn ($v) => $v->inventory?->quantity_on_hand ?? 0))
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),
                TextColumn::make('performance_tier')
                    ->label('Velocity Tier')
                    ->state(function (Product $record): string {
                        $units = (int) $record->orderItems->sum('quantity');
                        return match (true) {
                            $units >= 10 => 'Top Reserve',
                            $units >= 4 => 'High Velocity',
                            default => 'Steady Reserve',
                        };
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Top Reserve' => 'success',
                        'High Velocity' => 'primary',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('name', 'asc');
    }
}
