<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Filament\Admin\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\HtmlString;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updateStatus')
                ->label('Update Status')
                ->icon('heroicon-m-arrow-path')
                ->color('primary')
                ->modalHeading('Update Order Fulfillment Status')
                ->modalWidth('lg')
                ->form([
                    Select::make('status')
                        ->label('Fulfillment Status')
                        ->options([
                            OrderStatus::PENDING->value => 'Pending Payment',
                            OrderStatus::PROCESSING->value => 'In Blending & Packing (Processing)',
                            OrderStatus::SHIPPED->value => 'Dispatched (Shipped)',
                            OrderStatus::DELIVERED->value => 'Delivered to Customer',
                            OrderStatus::CANCELLED->value => 'Cancelled',
                        ])
                        ->default(fn (Order $record): string => $record->status->value)
                        ->required()
                        ->live(),
                    Textarea::make('cancellation_reason')
                        ->label('Reason for Cancellation')
                        ->placeholder('Specify customer request, botanical batch shortage, or address discrepancy...')
                        ->required(fn (Get $get): bool => $get('status') === OrderStatus::CANCELLED->value)
                        ->visible(fn (Get $get): bool => $get('status') === OrderStatus::CANCELLED->value)
                        ->columnSpanFull(),
                    Placeholder::make('cancellation_warning')
                        ->hiddenLabel()
                        ->content(new HtmlString('<div class="p-3 bg-red-50 text-red-800 dark:bg-red-950/60 dark:text-red-200 border border-red-300 dark:border-red-900 rounded-lg text-sm font-medium">⚠️ <strong>Critical Action:</strong> Selecting Cancelled will flag this order as terminated, stamp the cancellation date, and log an audit trail.</div>'))
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
        ];
    }
}
