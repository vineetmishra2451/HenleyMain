<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Orders;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Filament\Admin\Resources\Orders\Pages\ListOrders;
use App\Filament\Admin\Resources\Orders\Pages\ViewOrder;
use App\Models\Order;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use UnitEnum;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|UnitEnum|null $navigationGroup = 'Commerce';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $recordTitleAttribute = 'order_number';

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
                                    ->color(fn (OrderStatus $state): string => $state->color())
                                    ->formatStateUsing(fn (OrderStatus $state): string => $state->label()),
                                TextEntry::make('payment_status')
                                    ->label('Payment Status')
                                    ->badge()
                                    ->color(fn (PaymentStatus $state): string => $state->color())
                                    ->formatStateUsing(fn (PaymentStatus $state): string => $state->label()),
                                TextEntry::make('grand_total')
                                    ->label('Total (₹)')
                                    ->money('INR')
                                    ->weight('bold')
                                    ->color('success'),
                            ]),
                    ]),

                Section::make('Purchased Items')
                    ->description('Full botanical portfolio and packaging configurations.')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->hiddenLabel()
                            ->schema([
                                Grid::make(7)
                                    ->schema([
                                        TextEntry::make('product_name')
                                            ->label('Product')
                                            ->weight('medium')
                                            ->columnSpan(2),
                                        TextEntry::make('variant_label')
                                            ->label('Selection / Weight')
                                            ->placeholder('Standard'),
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
                                        TextEntry::make('line_total')
                                            ->label('Line Total')
                                            ->money('INR')
                                            ->weight('bold'),
                                    ]),
                            ]),
                    ]),

                Grid::make(2)
                    ->schema([
                        Section::make('Delivery Destination')
                            ->schema([
                                TextEntry::make('shipping_address.recipient_name')
                                    ->label('Recipient')
                                    ->weight('semibold')
                                    ->default(fn (Order $record): string => $record->shipping_address['recipient_name'] ?? $record->customer_snapshot['name'] ?? 'Recipient'),
                                TextEntry::make('shipping_address.phone')
                                    ->label('Phone Number')
                                    ->default(fn (Order $record): string => $record->shipping_address['phone'] ?? $record->customer_snapshot['phone'] ?? '—'),
                                TextEntry::make('shipping_address.line_1')
                                    ->label('Street Address')
                                    ->default(fn (Order $record): string => $record->shipping_address['line_1'] ?? '—'),
                                TextEntry::make('shipping_destination_location')
                                    ->label('City / State / Postal Code')
                                    ->state(fn (Order $record): string => ($record->shipping_address['city'] ?? '') . ', ' . ($record->shipping_address['state'] ?? '') . ' ' . ($record->shipping_address['pincode'] ?? '') . ' (' . ($record->shipping_address['country'] ?? 'IN') . ')'),
                            ]),

                        Section::make('Billing & Financial Snapshot')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('subtotal')
                                            ->label('Subtotal')
                                            ->money('INR'),
                                        TextEntry::make('discount_amount')
                                            ->label('Discount')
                                            ->money('INR'),
                                        TextEntry::make('tax_amount')
                                            ->label('Estimated GST Tax')
                                            ->money('INR'),
                                        TextEntry::make('shipping_amount')
                                            ->label('Shipping & Handling')
                                            ->money('INR'),
                                    ]),
                                TextEntry::make('grand_total')
                                    ->label('Final Grand Total')
                                    ->money('INR')
                                    ->weight('bold')
                                    ->color('success'),
                                TextEntry::make('payment_info')
                                    ->label('Payment Provider')
                                    ->state(fn (Order $record): string => ($record->payments->first()?->gateway ? ucfirst($record->payments->first()->gateway) : 'Prepaid Gateway') . ' (' . ($record->payments->first()?->payment_number ?? 'Auto-Captured') . ')'),
                            ]),
                    ]),

                Section::make('Client & Sommelier Notes')
                    ->schema([
                        TextEntry::make('customer_notes')
                            ->label('Customer Instructions')
                            ->placeholder('No specific brewing or delivery notes.'),
                        TextEntry::make('admin_notes')
                            ->label('Internal Dispatch & Quality Notes')
                            ->placeholder('No dispatch notes entered.'),
                    ])->columns(2),
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
                    ->weight('bold'),
                TextColumn::make('customer')
                    ->label('Customer')
                    ->state(fn (Order $record): string => $record->customer_snapshot['name'] ?? $record->user?->name ?? 'Guest Client')
                    ->searchable()
                    ->sortable(query: fn (Builder $query, string $direction): Builder => $query->orderBy('user_id', $direction)),
                TextColumn::make('placed_at')
                    ->label('Date')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Items')
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->alignEnd(),
                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('INR')
                    ->sortable()
                    ->weight('bold')
                    ->alignEnd(),
                TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->color(fn (PaymentStatus $state): string => $state->color())
                    ->formatStateUsing(fn (PaymentStatus $state): string => $state->label()),
                TextColumn::make('status')
                    ->label('Order Status')
                    ->badge()
                    ->color(fn (OrderStatus $state): string => $state->color())
                    ->formatStateUsing(fn (OrderStatus $state): string => $state->label()),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Fulfillment Status')
                    ->options(collect(OrderStatus::cases())->mapWithKeys(fn ($s) => [$s->value => $s->label()])),
                SelectFilter::make('payment_status')
                    ->label('Payment Status')
                    ->options(collect(PaymentStatus::cases())->mapWithKeys(fn ($p) => [$p->value => $p->label()])),
                Filter::make('placed_at')
                    ->form([
                        DatePicker::make('placed_from')->label('Placed From'),
                        DatePicker::make('placed_until')->label('Placed Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['placed_from'], fn (Builder $q, $date) => $q->whereDate('placed_at', '>=', $date))
                            ->when($data['placed_until'], fn (Builder $q, $date) => $q->whereDate('placed_at', '<=', $date));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('updateStatus')
                    ->label('Update Status')
                    ->icon('heroicon-m-arrow-path')
                    ->color('gray')
                    ->modalHeading('Update Order Fulfillment Status')
                    ->modalWidth('lg')
                    ->form([
                        Select::make('status')
                            ->label('New Order Status')
                            ->options([
                                OrderStatus::PENDING->value => 'Pending Payment',
                                OrderStatus::PROCESSING->value => 'In Blending & Packing (Processing)',
                                OrderStatus::SHIPPED->value => 'Dispatched (Shipped)',
                                OrderStatus::DELIVERED->value => 'Delivered',
                                OrderStatus::CANCELLED->value => 'Cancelled',
                            ])
                            ->default(fn (Order $record): string => $record->status->value)
                            ->required()
                            ->live(),
                        Textarea::make('cancellation_reason')
                            ->label('Reason for Cancellation')
                            ->placeholder('Specify customer request, batch shortage, or refund notes...')
                            ->required(fn (Get $get): bool => $get('status') === OrderStatus::CANCELLED->value)
                            ->visible(fn (Get $get): bool => $get('status') === OrderStatus::CANCELLED->value)
                            ->columnSpanFull(),
                        Placeholder::make('cancellation_warning')
                            ->hiddenLabel()
                            ->content(new HtmlString('<div class="p-3 bg-red-50 text-red-800 dark:bg-red-950/60 dark:text-red-200 border border-red-300 dark:border-red-900 rounded-lg text-sm font-medium">⚠️ <strong>Caution:</strong> Cancelling this order is an irreversible action that stamps cancellation times and audits.</div>'))
                            ->visible(fn (Get $get): bool => $get('status') === OrderStatus::CANCELLED->value),
                    ])
                    ->action(function (Order $record, array $data): void {
                        $newStatus = OrderStatus::from($data['status']);
                        $record->status = $newStatus;

                        if ($newStatus === OrderStatus::CANCELLED) {
                            $record->cancelled_at = now();
                            if (! empty($data['cancellation_reason'])) {
                                $record->admin_notes = trim(($record->admin_notes ?? '') . "\n[Cancellation] " . $data['cancellation_reason']);
                            }
                        } elseif ($newStatus === OrderStatus::DELIVERED) {
                            $record->fulfilled_at = now();
                        }

                        $record->save();

                        Notification::make()
                            ->title('Order Status Updated')
                            ->body("Order #{$record->order_number} is now {$newStatus->label()}.")
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
        return parent::getEloquentQuery()
            ->with(['user', 'items', 'payments']);
    }
}
