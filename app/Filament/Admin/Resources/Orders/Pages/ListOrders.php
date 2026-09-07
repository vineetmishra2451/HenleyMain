<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Filament\Admin\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Orders')
                ->badge(Order::count()),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::PENDING))
                ->badge(Order::where('status', OrderStatus::PENDING)->count())
                ->badgeColor('warning'),
            'processing' => Tab::make('Processing')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::PROCESSING))
                ->badge(Order::where('status', OrderStatus::PROCESSING)->count())
                ->badgeColor('primary'),
            'shipped' => Tab::make('Shipped')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::SHIPPED))
                ->badge(Order::where('status', OrderStatus::SHIPPED)->count())
                ->badgeColor('info'),
            'delivered' => Tab::make('Delivered')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::DELIVERED))
                ->badge(Order::where('status', OrderStatus::DELIVERED)->count())
                ->badgeColor('success'),
            'cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::CANCELLED))
                ->badge(Order::where('status', OrderStatus::CANCELLED)->count())
                ->badgeColor('danger'),
        ];
    }
}
