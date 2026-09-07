<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets\Reports;

use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class ReportTrendChartWidget extends ChartWidget
{
    protected ?string $heading = 'Report Analytical Trends';

    protected ?string $maxHeight = '280px';

    protected int | string | array $columnSpan = 'full';

    public ?string $filter = '30d';

    public function getDescription(): string | Htmlable | null
    {
        return 'Consolidated metric velocity and period-over-period variance across Henley operations.';
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
            $current = [42500, 51200, 48900, 63400, 78200, 94600, 89100];
            $prior = [38000, 44000, 45000, 56000, 69000, 81000, 79000];
        } elseif ($activeFilter === '90d') {
            $labels = ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10', 'W11', 'W12'];
            $current = [240000, 275000, 310000, 295000, 340000, 365000, 390000, 420000, 415000, 445000, 470000, 510000];
            $prior = [210000, 240000, 280000, 270000, 310000, 330000, 350000, 370000, 390000, 410000, 420000, 460000];
        } elseif ($activeFilter === '1y') {
            $labels = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'];
            $current = [950000, 1120000, 1450000, 1080000, 1210000, 1380000, 1420000, 1510000, 1630000, 1590000, 1720000, 1842500];
            $prior = [820000, 960000, 1200000, 920000, 1050000, 1180000, 1240000, 1310000, 1420000, 1380000, 1510000, 1600000];
        } else {
            $labels = [];
            $current = [];
            $prior = [];
            $baseDate = now()->subDays(29);
            for ($i = 0; $i < 30; $i++) {
                $date = $baseDate->copy()->addDays($i);
                $labels[] = $date->format('M d');
                $val = 45000 + ($i * 900) + (sin($i / 3) * 12000);
                $current[] = (int) round($val);
                $prior[] = (int) round($val * 0.88);
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Current Period (₹)',
                    'data' => $current,
                    'borderColor' => '#4B1421', // Henley maroon
                    'backgroundColor' => 'rgba(75, 20, 33, 0.08)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Prior Baseline (₹)',
                    'data' => $prior,
                    'borderColor' => '#9CA3AF',
                    'borderDash' => [4, 4],
                    'fill' => false,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
