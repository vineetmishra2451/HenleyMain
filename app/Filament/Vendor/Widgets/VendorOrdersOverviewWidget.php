<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VendorOrdersOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    /**
     * @var int | array<string, ?int> | null
     */
    protected int | array | null $columns = [
        'default' => 1,
        'sm' => 2,
        'md' => 4,
    ];

    protected function getStats(): array
    {
        // Because of #[ScopedBy([VendorScope::class])], Order::query() is automatically scoped to orders containing this vendor's items
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', OrderStatus::PENDING)->count();
        $processingOrders = Order::where('status', OrderStatus::PROCESSING)->count();
        $completedOrders = Order::where('status', OrderStatus::DELIVERED)->count();

        return [
            Stat::make('Total Estate Orders', number_format($totalOrders))
                ->description('All customer orders allocated')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart([12, 16, 19, 24, 28, 35, $totalOrders])
                ->color('primary'),

            Stat::make('Pending Review', number_format($pendingOrders))
                ->description('Awaiting batch cellar confirmation')
                ->descriptionIcon('heroicon-m-clock')
                ->chart([3, 2, 4, 1, 2, 3, $pendingOrders])
                ->color('warning'),

            Stat::make('In Processing', number_format($processingOrders))
                ->description('Flushes being packed & sealed')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->chart([2, 4, 3, 5, 4, 6, $processingOrders])
                ->color('info'),

            Stat::make('Completed Deliveries', number_format($completedOrders))
                ->description('Successfully delivered to collectors')
                ->descriptionIcon('heroicon-m-check-badge')
                ->chart([10, 14, 18, 22, 26, 30, $completedOrders])
                ->color('success'),
        ];
    }
}
