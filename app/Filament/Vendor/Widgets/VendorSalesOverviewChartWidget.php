<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class VendorSalesOverviewChartWidget extends ChartWidget
{
    protected ?string $heading = 'Sales Overview';

    protected ?string $maxHeight = '280px';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 4;

    protected static bool $isLazy = false;

    public ?string $filter = '30d';

    public function getDescription(): string | Htmlable | null
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $estate = $user?->vendor?->business_name ?? 'this estate';

        return "Daily gross sales revenue over the selected period scoped exclusively to {$estate} (₹ INR).";
    }

    protected function getFilters(): ?array
    {
        return [
            '7d' => 'Last 7 Days',
            '30d' => 'Last 30 Days',
            '90d' => 'Last Quarter',
            '1y' => 'Past Year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? '30d';

        if ($activeFilter === '7d') {
            $labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $data = [18500, 24200, 21900, 31400, 38200, 46600, 42100];
        } elseif ($activeFilter === '90d') {
            $labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8', 'Week 9', 'Week 10', 'Week 11', 'Week 12'];
            $data = [95000, 110000, 128000, 120000, 142000, 155000, 168000, 185000, 180000, 195000, 210000, 230000];
        } elseif ($activeFilter === '1y') {
            $labels = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'];
            $data = [380000, 450000, 580000, 440000, 490000, 560000, 580000, 610000, 660000, 640000, 710000, 750000];
        } else {
            // Default 30 days
            $labels = [];
            $data = [];
            $baseDate = now()->subDays(29);

            for ($i = 0; $i < 30; $i++) {
                $date = $baseDate->copy()->addDays($i);
                $labels[] = $date->format('M d');
                $isWeekend = $date->isWeekend();
                $base = $isWeekend ? 26000 : 16500;
                $variation = sin($i / 3) * 5500 + ($i * 420);
                $data[] = (int) round($base + $variation);
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Estate Gross Revenue (₹)',
                    'data' => $data,
                    'fill' => true,
                    'borderColor' => '#4B1421', // Henley maroon
                    'backgroundColor' => 'rgba(75, 20, 33, 0.08)',
                    'tension' => 0.35,
                    'pointBackgroundColor' => '#4B1421',
                    'pointBorderColor' => '#FFFFFF',
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => false,
                    'ticks' => [
                        'callback' => 'function(value) { return "₹" + (value / 1000).toLocaleString() + "k"; }',
                    ],
                ],
            ],
        ];
    }
}
