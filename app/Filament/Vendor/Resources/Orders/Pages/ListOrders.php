<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Filament\Vendor\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected static ?string $title = 'Orders & Dispatch Allocations';

    public function getTabs(): array
    {
        $vendorId = Auth::user()?->vendor_id;

        $baseQuery = fn () => Order::query()
            ->when($vendorId, fn (Builder $q) => $q->whereHas('items', fn (Builder $iq) => $iq->where('vendor_id', $vendorId)));

        return [
            'all' => Tab::make('All Orders')
                ->badge($baseQuery()->count()),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::PENDING->value))
                ->badge($baseQuery()->where('status', OrderStatus::PENDING->value)->count())
                ->badgeColor('warning'),
            'processing' => Tab::make('Processing')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::PROCESSING->value))
                ->badge($baseQuery()->where('status', OrderStatus::PROCESSING->value)->count())
                ->badgeColor('primary'),
            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', [OrderStatus::DELIVERED->value, OrderStatus::SHIPPED->value]))
                ->badge($baseQuery()->whereIn('status', [OrderStatus::DELIVERED->value, OrderStatus::SHIPPED->value])->count())
                ->badgeColor('success'),
            'cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::CANCELLED->value))
                ->badge($baseQuery()->where('status', OrderStatus::CANCELLED->value)->count())
                ->badgeColor('danger'),
        ];
    }
}
