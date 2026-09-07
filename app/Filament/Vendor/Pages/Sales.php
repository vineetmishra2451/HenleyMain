<?php

declare(strict_types=1);

namespace App\Filament\Vendor\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class Sales extends Page
{
    protected static \UnitEnum|string|null $navigationGroup = 'Sales';

    protected static ?string $navigationLabel = 'Sales Dashboard';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected string $view = 'filament.vendor.pages.sales';

    public ?string $dateRange = '30d';

    public function getTitle(): string | Htmlable
    {
        return 'Sales & Settlement Analytics';
    }

    public function getSubheading(): string | Htmlable | null
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $estate = $user?->vendor?->business_name ?? 'your estate';

        return "Sales ledger, commission deduction breakdown, and bi-weekly payouts for {$estate}.";
    }

    public function setRange(string $range): void
    {
        $this->dateRange = $range;
    }

    /**
     * @return array<string, mixed>
     */
    public function getFinancialMetrics(): array
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $vendor = $user?->vendor;
        $commissionRate = (float) ($vendor?->commission_rate ?? 15.0);

        return match ($this->dateRange) {
            '7d' => [
                'gross' => 223900,
                'commission' => (int) round(223900 * ($commissionRate / 100)),
                'net' => (int) round(223900 * (1 - ($commissionRate / 100))),
                'orders' => 14,
                'avg_order' => 15992,
            ],
            '90d' => [
                'gross' => 1980000,
                'commission' => (int) round(1980000 * ($commissionRate / 100)),
                'net' => (int) round(1980000 * (1 - ($commissionRate / 100))),
                'orders' => 118,
                'avg_order' => 16779,
            ],
            '1y' => [
                'gross' => 7150000,
                'commission' => (int) round(7150000 * ($commissionRate / 100)),
                'net' => (int) round(7150000 * (1 - ($commissionRate / 100))),
                'orders' => 462,
                'avg_order' => 15476,
            ],
            default => [
                'gross' => 482500,
                'commission' => (int) round(482500 * ($commissionRate / 100)),
                'net' => (int) round(482500 * (1 - ($commissionRate / 100))),
                'orders' => 42,
                'avg_order' => 11488,
            ],
        };
    }
}
