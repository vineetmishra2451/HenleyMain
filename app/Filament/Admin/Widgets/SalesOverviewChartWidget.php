<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class SalesOverviewChartWidget extends ChartWidget
{
    protected ?string $heading = 'Sales Overview';

    protected ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    public ?string $filter = '30d';

    public function getDescription(): string | Htmlable | null
    {
        return 'Daily gross sales revenue trends across the Henley platform (₹ INR).';
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
            $data = [42500, 51200, 48900, 63400, 78200, 94600, 89100];
        } elseif ($activeFilter === '90d') {
            $labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8', 'Week 9', 'Week 10', 'Week 11', 'Week 12'];
            $data = [240000, 275000, 310000, 295000, 340000, 365000, 390000, 420000, 415000, 445000, 470000, 510000];
        } elseif ($activeFilter === '1y') {
            $labels = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'];
            $data = [950000, 1120000, 1450000, 1080000, 1210000, 1380000, 1420000, 1510000, 1630000, 1590000, 1720000, 1842500];
        } else {
            // Default 30 days
            $labels = [];
            $data = [];
            $baseDate = now()->subDays(29);

            for ($i = 0; $i < 30; $i++) {
                $date = $baseDate->copy()->addDays($i);
                $labels[] = $date->format('M d');
                // Organic progression with weekend peaks
                $isWeekend = $date->isWeekend();
                $base = $isWeekend ? 68000 : 45000;
                $variation = sin($i / 3) * 12000 + ($i * 900);
                $data[] = (int) round($base + $variation);
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Gross Sales (₹)',
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
