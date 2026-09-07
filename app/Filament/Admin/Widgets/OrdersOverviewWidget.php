<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrdersOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 3;

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
        return [
            Stat::make('Total Orders', '1,248')
                ->description('+8.2% from last month')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart([22, 28, 25, 34, 38, 44, 49])
                ->color('primary'),

            Stat::make('Pending', '32')
                ->description('Requires review & curation')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Processing', '58')
                ->description('In packaging & fulfillment')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info'),

            Stat::make('Delivered', '1,158')
                ->description('92.8% fulfillment completion')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
