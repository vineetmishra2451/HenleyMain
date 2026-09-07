<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Pages;

use App\Filament\Vendor\Widgets\VendorEstateHeaderWidget;
use App\Filament\Vendor\Widgets\VendorInventoryAlertsWidget;
use App\Filament\Vendor\Widgets\VendorOrdersOverviewWidget;
use App\Filament\Vendor\Widgets\VendorRevenueWidget;
use App\Filament\Vendor\Widgets\VendorSalesOverviewChartWidget;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    public function getTitle(): string | Htmlable
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $vendor = $user?->vendor;

        if ($vendor && ! empty($vendor->business_name)) {
            return "{$vendor->business_name} — Partner Cellar Dashboard";
        }

        return 'Estate Partner Cellar Dashboard';
    }

    public function getSubheading(): string | Htmlable | null
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $vendor = $user?->vendor;
        $vendorName = $vendor?->business_name ?? 'your artisanal estate';

        return "Single-estate reserve analytics, real-time dispatch queue, and stock depletion alerts scoped exclusively to {$vendorName}.";
    }

    /**
     * @return array<class-string>
     */
    public function getWidgets(): array
    {
        return [
            VendorEstateHeaderWidget::class,
            VendorOrdersOverviewWidget::class,
            VendorRevenueWidget::class,
            VendorSalesOverviewChartWidget::class,
            VendorInventoryAlertsWidget::class,
        ];
    }

    /**
     * Responsive widget grid:
     * - Mobile (< md): 1 column (vertical stack)
     * - Desktop (>= md): 2 columns
     *
     * @return int | array<string, ?int>
     */
    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'sm' => 1,
            'md' => 2,
            'lg' => 2,
            'xl' => 2,
        ];
    }
}
