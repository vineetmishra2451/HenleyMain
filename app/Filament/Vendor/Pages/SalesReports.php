<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Pages;

use App\Filament\Vendor\Widgets\VendorSalesOverviewChartWidget;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class SalesReports extends Page
{
    protected static \UnitEnum|string|null $navigationGroup = 'Sales';

    protected static ?string $navigationLabel = 'Sales Reports';

    protected static ?string $slug = 'sales/reports';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartLine;

    protected string $view = 'filament.vendor.pages.sales-reports';

    public string $startDate = '2026-08-01';
    public string $endDate = '2026-09-06';
    public string $periodPreset = '30d';

    public function getTitle(): string | Htmlable
    {
        return 'Periodic Sales & Tax Reports';
    }

    public function getSubheading(): string | Htmlable | null
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $estate = $user?->vendor?->business_name ?? 'your estate';

        return "Detailed revenue velocity, GST compliance reporting, and reconciliation ledgers for {$estate}.";
    }

    public function setPreset(string $preset): void
    {
        $this->periodPreset = $preset;
        match ($preset) {
            '7d' => [
                $this->startDate = now()->subDays(7)->format('Y-m-d'),
                $this->endDate = now()->format('Y-m-d'),
            ],
            '90d' => [
                $this->startDate = now()->subDays(90)->format('Y-m-d'),
                $this->endDate = now()->format('Y-m-d'),
            ],
            '1y' => [
                $this->startDate = now()->subYear()->format('Y-m-d'),
                $this->endDate = now()->format('Y-m-d'),
            ],
            default => [
                $this->startDate = now()->subDays(30)->format('Y-m-d'),
                $this->endDate = now()->format('Y-m-d'),
            ],
        };
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportCsv')
                ->label('Export Report (CSV)')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->action(function () {
                    Notification::make()
                        ->title('Sales Report Generated')
                        ->body("CSV report for {$this->startDate} to {$this->endDate} is ready.")
                        ->success()
                        ->send();
                }),
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getWeeklyBreakdown(): array
    {
        return [
            [
                'period' => 'Week 36 (01 Sep – 06 Sep 2026)',
                'orders' => 12,
                'units' => 28,
                'gross' => 134200,
                'tax' => 6710,
                'commission' => 20130,
                'net' => 114070,
                'status' => 'In Accrual',
            ],
            [
                'period' => 'Week 35 (25 Aug – 31 Aug 2026)',
                'orders' => 14,
                'units' => 36,
                'gross' => 152800,
                'tax' => 7640,
                'commission' => 22920,
                'net' => 129880,
                'status' => 'Settled',
            ],
            [
                'period' => 'Week 34 (18 Aug – 24 Aug 2026)',
                'orders' => 10,
                'units' => 22,
                'gross' => 125600,
                'tax' => 6280,
                'commission' => 18840,
                'net' => 106760,
                'status' => 'Settled',
            ],
            [
                'period' => 'Week 33 (11 Aug – 17 Aug 2026)',
                'orders' => 9,
                'units' => 20,
                'gross' => 98400,
                'tax' => 4920,
                'commission' => 14760,
                'net' => 83640,
                'status' => 'Settled',
            ],
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            VendorSalesOverviewChartWidget::class,
        ];
    }
}
