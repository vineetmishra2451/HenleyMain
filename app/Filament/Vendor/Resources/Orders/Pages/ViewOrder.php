<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Orders\Pages;

use App\Enums\ShipmentStatus;
use App\Filament\Vendor\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipment;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected static ?string $title = 'Order Allocation & Fulfillment Details';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updateFulfillment')
                ->label('Update Fulfillment Status')
                ->icon('heroicon-o-truck')
                ->color('primary')
                ->form([
                    Select::make('item_id')
                        ->label('Select Line Item')
                        ->options(function () {
                            $vendorId = Auth::user()?->vendor_id;
                            /** @var Order $order */
                            $order = $this->getRecord();

                            return $order->items()
                                ->where('vendor_id', $vendorId)
                                ->get()
                                ->mapWithKeys(fn (OrderItem $item) => [
                                    $item->id => "{$item->product_name} ({$item->sku}) — Qty {$item->quantity} [" . ucfirst($item->fulfillment_status ?? 'pending') . ']',
                                ])
                                ->prepend('All Cellar Items in Order', 'all');
                        })
                        ->default('all')
                        ->required(),
                    Select::make('fulfillment_status')
                        ->label('New Fulfillment Status')
                        ->options([
                            'processing' => 'Processing (Batch Packed & Sealed)',
                            'shipped' => 'Shipped / Dispatched (With Courier)',
                            'delivered' => 'Delivered to Collector',
                            'cancelled' => 'Cancelled / Out of Stock',
                        ])
                        ->required(),
                    TextInput::make('courier_name')
                        ->label('Courier Partner')
                        ->placeholder('e.g. Blue Dart Apex, Delhivery Express')
                        ->default('Blue Dart Apex'),
                    TextInput::make('tracking_number')
                        ->label('Tracking / AWB Number')
                        ->placeholder('e.g. BD-892147104')
                        ->default(fn () => 'HNL-' . strtoupper(Str::random(9))),
                ])
                ->action(function (array $data): void {
                    $vendorId = Auth::user()?->vendor_id;
                    /** @var Order $order */
                    $order = $this->getRecord();

                    $status = $data['fulfillment_status'];
                    $itemsQuery = $order->items()->where('vendor_id', $vendorId);

                    if ($data['item_id'] !== 'all') {
                        $itemsQuery->where('id', $data['item_id']);
                    }

                    $itemsQuery->update(['fulfillment_status' => $status]);

                    // Map fulfillment status to ShipmentStatus
                    $shipmentStatus = match ($status) {
                        'shipped' => ShipmentStatus::IN_TRANSIT,
                        'delivered' => ShipmentStatus::DELIVERED,
                        'processing' => ShipmentStatus::LABEL_CREATED,
                        default => ShipmentStatus::PENDING,
                    };

                    // Record or update Shipment
                    Shipment::updateOrCreate(
                        [
                            'order_id' => $order->id,
                            'vendor_id' => $vendorId,
                        ],
                        [
                            'shipment_number' => 'SHP-' . strtoupper(Str::random(8)),
                            'courier_name' => $data['courier_name'] ?? 'Blue Dart Apex',
                            'tracking_number' => $data['tracking_number'] ?? 'AWB-' . rand(1000000, 9999999),
                            'status' => $shipmentStatus,
                            'shipped_at' => in_array($status, ['shipped', 'delivered']) ? now() : null,
                            'delivered_at' => $status === 'delivered' ? now() : null,
                        ]
                    );

                    Notification::make()
                        ->title('Fulfillment Updated')
                        ->body("Line item status updated to '{$status}'.")
                        ->success()
                        ->send();

                    $this->refreshFormData(['status', 'estate_items']);
                }),
        ];
    }
}
