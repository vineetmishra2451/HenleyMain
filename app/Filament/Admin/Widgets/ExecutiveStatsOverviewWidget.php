<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExecutiveStatsOverviewWidget extends BaseWidget
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
        return [
            Stat::make('Revenue', '₹1,842,500')
                ->description('+14.8% from last month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([32, 38, 35, 46, 52, 58, 64])
                ->color('success'),

            Stat::make('Customers', '2,840')
                ->description('+142 new this period')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([14, 18, 22, 25, 29, 34, 40])
                ->color('info'),

            Stat::make('Average Order Value', '₹4,790')
                ->description('+5.2% vs target ₹4,550')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([41, 42, 44, 43, 46, 47, 48])
                ->color('primary'),

            Stat::make('Repeat Purchase Rate', '34.8%')
                ->description('+3.1% customer retention')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->chart([28, 29, 31, 30, 32, 33, 35])
                ->color('warning'),
        ];
    }
}
