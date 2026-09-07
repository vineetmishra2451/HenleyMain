<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Orders;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Filament\Vendor\Resources\Orders\Pages\ListOrders;
use App\Filament\Vendor\Resources\Orders\Pages\ViewOrder;
use App\Models\Order;
use App\Models\OrderItem;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $slug = 'orders';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $modelLabel = 'Order Allocation';

    protected static ?string $pluralModelLabel = 'Order Allocations';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Summary')
                    ->schema([
                        Grid::make(5)
                            ->schema([
                                TextEntry::make('order_number')
                                    ->label('Order Number')
                                    ->weight('bold'),
                                TextEntry::make('placed_at')
                                    ->label('Placed At')
                                    ->dateTime('M d, Y H:i'),
                                TextEntry::make('status')
                                    ->label('Order Status')
                                    ->badge()
                                    ->color(fn (OrderStatus|string $state): string => $state instanceof OrderStatus ? $state->color() : (OrderStatus::tryFrom((string)$state)?->color() ?? 'gray'))
                                    ->formatStateUsing(fn (OrderStatus|string $state): string => $state instanceof OrderStatus ? $state->label() : (OrderStatus::tryFrom((string)$state)?->label() ?? (string)$state)),
                                TextEntry::make('payment_status')
                                    ->label('Payment Status')
                                    ->badge()
                                    ->color(fn (PaymentStatus|string $state): string => $state instanceof PaymentStatus ? $state->color() : (PaymentStatus::tryFrom((string)$state)?->color() ?? 'gray'))
                                    ->formatStateUsing(fn (PaymentStatus|string $state): string => $state instanceof PaymentStatus ? $state->label() : (PaymentStatus::tryFrom((string)$state)?->label() ?? (string)$state)),
                                TextEntry::make('estate_subtotal')
                                    ->label('Your Cellar Allocation')
                                    ->state(function (Order $record): float {
                                        $vendorId = Auth::user()?->vendor_id;
                                        return (float) $record->items->where('vendor_id', $vendorId)->sum('line_total');
                                    })
                                    ->money('INR')
                                    ->weight('bold')
                                    ->color('success'),
                            ]),
                    ]),

                Section::make('Collector & Delivery Destination')
                    ->description('Customer delivery details required for batch packaging and courier dispatch.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('customer_name')
                                    ->label('Recipient Collector')
                                    ->state(fn (Order $record): string => $record->customer_snapshot['name'] ?? 'Private Collector')
                                    ->weight('medium'),
                                TextEntry::make('customer_phone')
                                    ->label('Delivery Phone')
                                    ->state(fn (Order $record): string => $record->customer_snapshot['phone'] ?? '+91 98765 43210'),
                                TextEntry::make('shipping_destination')
                                    ->label('Terroir Destination')
                                    ->state(function (Order $record): string {
                                        $addr = $record->shipping_address ?? [];
                                        return implode(', ', array_filter([
                                            $addr['address_line_1'] ?? $addr['line1'] ?? null,
                                            $addr['city'] ?? null,
                                            $addr['state'] ?? null,
                                            $addr['postal_code'] ?? null,
                                            $addr['country'] ?? 'India',
                                        ])) ?: 'Standard Dispatch Address';
                                    }),
                            ]),
                    ]),

                Section::make('Payment Information (Fulfillment Summary)')
                    ->description('Settlement status for fulfillment verification. Sensitive gateway signatures and customer tokens are restricted.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('payment_status_summary')
                                    ->label('Payment Confirmation')
                                    ->state(fn (Order $record): string => $record->payment_status instanceof PaymentStatus ? $record->payment_status->label() : strtoupper((string)$record->payment_status))
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('currency')
                                    ->label('Currency')
                                    ->default('INR (₹)'),
                                TextEntry::make('settlement_status')
                                    ->label('Disbursement Allocation')
                                    ->default('Eligible for Next Bi-weekly Settlement Cycle')
                                    ->badge()
                                    ->color('gray'),
                            ]),
                    ]),

                Section::make('Estate Allocated Line Items')
                    ->description('Items allocated exclusively from your estate harvest cellar. Other partner items in multi-vendor orders are strictly hidden.')
                    ->schema([
                        RepeatableEntry::make('estate_items')
                            ->hiddenLabel()
                            ->state(function (Order $record) {
                                $vendorId = Auth::user()?->vendor_id;
                                return $record->items()->where('vendor_id', $vendorId)->get();
                            })
                            ->schema([
                                Grid::make(7)
                                    ->schema([
                                        TextEntry::make('product_name')
                                            ->label('Product')
                                            ->weight('medium')
                                            ->columnSpan(2),
                                        TextEntry::make('variant_label')
                                            ->label('Harvest Selection')
                                            ->placeholder('Standard Tin'),
                                        TextEntry::make('sku')
                                            ->label('SKU')
                                            ->badge()
                                            ->color('gray'),
                                        TextEntry::make('unit_price')
                                            ->label('Unit Price')
                                            ->money('INR'),
                                        TextEntry::make('quantity')
                                            ->label('Qty')
                                            ->badge()
                                            ->color('primary'),
                                        TextEntry::make('fulfillment_status')
                                            ->label('Fulfillment Status')
                                            ->badge()
                                            ->formatStateUsing(fn (?string $state): string => ucfirst($state ?? 'pending'))
                                            ->color(fn (?string $state): string => match ($state) {
                                                'delivered' => 'success',
                                                'shipped' => 'primary',
                                                'processing' => 'warning',
                                                'cancelled' => 'danger',
                                                default => 'gray',
                                            }),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),
                TextColumn::make('placed_at')
                    ->label('Placed Date')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('customer_snapshot.name')
                    ->label('Collector')
                    ->default(fn (Order $record): string => $record->customer_snapshot['name'] ?? 'Private Collector')
                    ->searchable(),
                TextColumn::make('estate_items_count')
                    ->label('Estate Items')
                    ->state(function (Order $record): int {
                        $vendorId = Auth::user()?->vendor_id;
                        return $record->items->where('vendor_id', $vendorId)->count();
                    })
                    ->badge()
                    ->color('gray'),
                TextColumn::make('estate_subtotal')
                    ->label('Estate Subtotal')
                    ->state(function (Order $record): float {
                        $vendorId = Auth::user()?->vendor_id;
                        return (float) $record->items->where('vendor_id', $vendorId)->sum('line_total');
                    })
                    ->money('INR')
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof PaymentStatus ? $state->label() : (PaymentStatus::tryFrom((string)$state)?->label() ?? (string)$state))
                    ->color(fn ($state): string => $state instanceof PaymentStatus ? $state->color() : (PaymentStatus::tryFrom((string)$state)?->color() ?? 'gray')),
                TextColumn::make('status')
                    ->label('Order Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof OrderStatus ? $state->label() : (OrderStatus::tryFrom((string)$state)?->label() ?? (string)$state))
                    ->color(fn ($state): string => $state instanceof OrderStatus ? $state->color() : (OrderStatus::tryFrom((string)$state)?->color() ?? 'gray')),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'view' => ViewOrder::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $vendorId = Auth::user()?->vendor_id;

        return parent::getEloquentQuery()
            ->when($vendorId, fn (Builder $q) => $q->whereHas('items', fn (Builder $iq) => $iq->where('vendor_id', $vendorId)))
            ->with(['items']);
    }
}
