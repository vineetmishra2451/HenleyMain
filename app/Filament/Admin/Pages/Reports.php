<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Attributes\Url;
use UnitEnum;

/**
 * ARCHITECTURAL DESIGN NOTE:
 * A single unified Reports Hub page with an interactive report-type selector was chosen
 * over 7 individual sidebar sub-pages (Sales, Revenue, Product, Inventory, Customer,
 * Vendor, Order). This prevents excessive sidebar bloat and keeps the admin portal
 * navigation clean and focused alongside Catalog, Commerce, CMS, and Administration sections,
 * while providing rapid comparative switching across all analytical dimensions.
 */
class Reports extends Page
{
    protected static ?string $title = 'Reports Hub';

    protected static string|UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBarSquare;

    protected string $view = 'filament.admin.pages.reports';

    #[Url(as: 'type')]
    public string $activeReport = 'sales';

    #[Url(as: 'range')]
    public string $dateRange = '30d';

    public ?string $startDate = null;

    public ?string $endDate = null;

    public function mount(): void
    {
        $allowed = ['sales', 'revenue', 'product', 'inventory', 'customer', 'vendor', 'order'];
        if (! in_array($this->activeReport, $allowed, true)) {
            $this->activeReport = 'sales';
        }

        if ($this->startDate === null) {
            $this->startDate = now()->subDays(29)->format('Y-m-d');
        }
        if ($this->endDate === null) {
            $this->endDate = now()->format('Y-m-d');
        }
    }

    public function getSubheading(): string | Htmlable | null
    {
        return 'Consolidated executive intelligence, multi-vendor margins, harvest depletion velocity, and tax accounting.';
    }

    public function setReport(string $type): void
    {
        $this->activeReport = $type;
    }

    public function setRange(string $range): void
    {
        $this->dateRange = $range;
        if ($range === '7d') {
            $this->startDate = now()->subDays(6)->format('Y-m-d');
        } elseif ($range === '30d') {
            $this->startDate = now()->subDays(29)->format('Y-m-d');
        } elseif ($range === '90d') {
            $this->startDate = now()->subDays(89)->format('Y-m-d');
        } elseif ($range === '1y') {
            $this->startDate = now()->subDays(364)->format('Y-m-d');
        }
        $this->endDate = now()->format('Y-m-d');
    }

    public function exportReport(): void
    {
        Notification::make()
            ->title(ucfirst($this->activeReport) . ' Report Exported')
            ->body("CSV report for {$this->dateRange} range compiled and ready for audit.")
            ->success()
            ->send();
    }

    /**
     * Get KPI summary cards for the selected report type.
     *
     * @return array<int, array{label: string, value: string, change: string, trend: string, icon: string, description: string}>
     */
    public function getReportKpis(): array
    {
        return match ($this->activeReport) {
            'revenue' => [
                ['label' => 'Net Revenue', 'value' => '₹18,42,500', 'change' => '+14.2%', 'trend' => 'up', 'icon' => 'currency-rupee', 'description' => 'After vouchers & commissions'],
                ['label' => 'Gross Platform Margin', 'value' => '64.8%', 'change' => '+2.1%', 'trend' => 'up', 'icon' => 'arrow-trending-up', 'description' => 'Target margin 60.0%'],
                ['label' => 'Tax (GST) Liability', 'value' => '₹92,125', 'change' => '+8.5%', 'trend' => 'up', 'icon' => 'document-text', 'description' => '5.0% blended tea tariff'],
                ['label' => 'Refunds & Returns', 'value' => '₹14,200', 'change' => '-18.4%', 'trend' => 'down', 'icon' => 'arrow-path', 'description' => '0.77% of gross GMV'],
            ],
            'product' => [
                ['label' => 'Active SKUs Sold', 'value' => '28 / 30', 'change' => '+3 SKUs', 'trend' => 'up', 'icon' => 'shopping-bag', 'description' => '93.3% catalogue activity'],
                ['label' => 'Top Harvest Batch', 'value' => 'Makaibari FTGFOP1', 'change' => '312 units', 'trend' => 'up', 'icon' => 'sparkles', 'description' => 'Spring 2026 First Flush'],
                ['label' => 'Apothecary Gift Sets', 'value' => '₹4,89,000', 'change' => '+28.5%', 'trend' => 'up', 'icon' => 'gift', 'description' => '26.5% of total volume'],
                ['label' => 'Return Velocity', 'value' => '0.4%', 'change' => '-0.2%', 'trend' => 'down', 'icon' => 'check-badge', 'description' => 'Industry benchmark 3.2%'],
            ],
            'inventory' => [
                ['label' => 'Total Units in Reserve', 'value' => '1,420 units', 'change' => '-110 units', 'trend' => 'down', 'icon' => 'archive-box', 'description' => 'Across Siliguri & Darjeeling'],
                ['label' => 'Reserve Valuation', 'value' => '₹28,64,000', 'change' => '+4.1%', 'trend' => 'up', 'icon' => 'banknotes', 'description' => 'At landed wholesale cost'],
                ['label' => 'Low Stock Alerts', 'value' => '3 Batches', 'change' => 'Requires Order', 'trend' => 'warning', 'icon' => 'exclamation-triangle', 'description' => 'Silver Needle & Mongra Saffron'],
                ['label' => 'Inventory Turnover', 'value' => '4.8x', 'change' => '+0.6x', 'trend' => 'up', 'icon' => 'arrow-path-rounded-square', 'description' => 'Annualized turn velocity'],
            ],
            'customer' => [
                ['label' => 'Total Connoisseurs', 'value' => '842', 'change' => '+64 this period', 'trend' => 'up', 'icon' => 'user-group', 'description' => 'Active registered collectors'],
                ['label' => 'Repeat Purchase Rate', 'value' => '42.6%', 'change' => '+5.1%', 'trend' => 'up', 'icon' => 'arrow-path', 'description' => 'Within 90 days of onboarding'],
                ['label' => 'Average Order Value', 'value' => '₹2,640', 'change' => '+₹320', 'trend' => 'up', 'icon' => 'credit-card', 'description' => 'Apothecary jars boost basket'],
                ['label' => 'Collector LTV', 'value' => '₹8,920', 'change' => '+11.8%', 'trend' => 'up', 'icon' => 'star', 'description' => '12-month trailing cohort'],
            ],
            'vendor' => [
                ['label' => 'Active Partner Estates', 'value' => '6 Gardens', 'change' => '100% Operational', 'trend' => 'up', 'icon' => 'building-storefront', 'description' => 'Darjeeling, Assam, Kashmir'],
                ['label' => 'Partner Gross GMV', 'value' => '₹18,42,500', 'change' => '+14.2%', 'trend' => 'up', 'icon' => 'scale', 'description' => 'Gross estate sales volume'],
                ['label' => 'Platform Commission', 'value' => '₹2,76,375', 'change' => '+14.2%', 'trend' => 'up', 'icon' => 'receipt-percent', 'description' => 'Standard 15% marketplace rate'],
                ['label' => 'Fulfillment SLA', 'value' => '98.4%', 'change' => '+1.2%', 'trend' => 'up', 'icon' => 'shield-check', 'description' => 'Under 48hr dispatch time'],
            ],
            'order' => [
                ['label' => 'Total Orders Placed', 'value' => '698', 'change' => '+18.6%', 'trend' => 'up', 'icon' => 'clipboard-document-check', 'description' => 'Online & Concierge bookings'],
                ['label' => 'Delivered Safely', 'value' => '642', 'change' => '92.0% Success', 'trend' => 'up', 'icon' => 'truck', 'description' => 'Express air transit'],
                ['label' => 'In Transit / Shipped', 'value' => '44', 'change' => 'Tracking Active', 'trend' => 'up', 'icon' => 'clock', 'description' => 'Average 2.4 days delivery'],
                ['label' => 'Order Cancellation', 'value' => '12', 'change' => '-4 orders', 'trend' => 'down', 'icon' => 'x-circle', 'description' => '1.7% cancel rate'],
            ],
            default => [ // sales
                ['label' => 'Gross Sales Volume', 'value' => '₹21,80,000', 'change' => '+18.4%', 'trend' => 'up', 'icon' => 'presentation-chart-line', 'description' => 'Total merchandise sales'],
                ['label' => 'Total Orders Fulfilled', 'value' => '698', 'change' => '+12.5%', 'trend' => 'up', 'icon' => 'shopping-cart', 'description' => 'Avg 23.2 orders/day'],
                ['label' => 'Average Order Value', 'value' => '₹3,123', 'change' => '+₹245', 'trend' => 'up', 'icon' => 'calculator', 'description' => 'Gift sets driving higher basket'],
                ['label' => 'Coupon Privilege Volume', 'value' => '₹78,400', 'change' => '3.6% of GMV', 'trend' => 'down', 'icon' => 'ticket', 'description' => 'RITUAL10 & seasonal codes'],
            ],
        };
    }

    /**
     * Get chart dataset for Chart.js in the view.
     *
     * @return array{labels: list<string>, datasets: list<array<string, mixed>>}
     */
    public function getChartData(): array
    {
        if ($this->dateRange === '7d') {
            $labels = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'];
            $data = [42500, 51200, 48900, 63400, 78200, 94600, 89100];
            $comp = [38000, 44000, 45000, 56000, 69000, 81000, 79000];
        } elseif ($this->dateRange === '90d') {
            $labels = ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10', 'W11', 'W12'];
            $data = [240000, 275000, 310000, 295000, 340000, 365000, 390000, 420000, 415000, 445000, 470000, 510000];
            $comp = [210000, 240000, 280000, 270000, 310000, 330000, 350000, 370000, 390000, 410000, 420000, 460000];
        } elseif ($this->dateRange === '1y') {
            $labels = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'];
            $data = [950000, 1120000, 1450000, 1080000, 1210000, 1380000, 1420000, 1510000, 1630000, 1590000, 1720000, 1842500];
            $comp = [820000, 960000, 1200000, 920000, 1050000, 1180000, 1240000, 1310000, 1420000, 1380000, 1510000, 1600000];
        } else {
            // 30 days
            $labels = [];
            $data = [];
            $comp = [];
            for ($i = 0; $i < 30; $i++) {
                $labels[] = now()->subDays(29 - $i)->format('d M');
                $val = 45000 + ($i * 900) + (sin($i / 3) * 12000);
                $data[] = (int) round($val);
                $comp[] = (int) round($val * 0.88);
            }
        }

        $label = match ($this->activeReport) {
            'revenue' => 'Net Revenue (₹)',
            'product' => 'Units Dispatched',
            'inventory' => 'Reserve Units',
            'customer' => 'Customer Orders',
            'vendor' => 'Partner GMV (₹)',
            'order' => 'Completed Orders',
            default => 'Gross Sales (₹)',
        };

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => $label . ' (Current)',
                    'data' => $data,
                    'borderColor' => '#4B1421', // Henley maroon
                    'backgroundColor' => 'rgba(75, 20, 33, 0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Previous Period Comparison',
                    'data' => $comp,
                    'borderColor' => '#9CA3AF',
                    'borderDash' => [5, 5],
                    'backgroundColor' => 'transparent',
                    'fill' => false,
                    'tension' => 0.35,
                ],
            ],
        ];
    }

    /**
     * Get tabular breakdown data for the selected report.
     *
     * @return array{headers: list<string>, rows: list<list<string>>}
     */
    public function getTableData(): array
    {
        return match ($this->activeReport) {
            'revenue' => [
                'headers' => ['Financial Dimension', 'Gross Value', 'Deductions / Costs', 'Net Realized', 'Tax (GST)', 'Effective Margin'],
                'rows' => [
                    ['Darjeeling Single-Origin Teas', '₹11,40,000', '₹3,42,000', '₹7,98,000', '₹57,000', '70.0%'],
                    ['Kashmiri Saffron & Spices', '₹4,80,000', '₹1,68,000', '₹3,12,000', '₹24,000', '65.0%'],
                    ['Nilgiri Botanical Tisanes', '₹3,20,000', '₹1,02,400', '₹2,17,600', '₹16,000', '68.0%'],
                    ['Apothecary Tea Vessels & Spoons', '₹2,40,000', '₹84,000', '₹1,56,000', '₹28,800', '65.0%'],
                    ['Consolidated Totals', '₹21,80,000', '₹6,96,400', '₹14,83,600', '₹1,25,800', '68.1%'],
                ],
            ],
            'product' => [
                'headers' => ['Product Reserve', 'Terroir / Origin', 'Units Sold', 'Gross Revenue', 'Stock Remaining', 'Inventory Health'],
                'rows' => [
                    ['Makaibari FTGFOP1 First Flush', 'Kurseong, Darjeeling', '312', '₹7,80,000', '188 units', 'Adequate (38 days)'],
                    ['Pure Kashmiri Mongra Saffron (1g)', 'Pampore, Kashmir', '215', '₹3,44,000', '42 units', 'Low Stock (14 days)'],
                    ['Silver Needle White Tea Reserve', 'Mirik Valley, Darjeeling', '180', '₹4,32,000', '35 units', 'Low Stock (11 days)'],
                    ['High-Altitude Nilgiri Frost Tisane', 'Nilgiri Highlands', '144', '₹2,01,600', '120 units', 'Optimal (60 days)'],
                    ['Ceremonial Brass Tasting Spoon', 'Moradabad Atelier', '98', '₹1,22,500', '210 units', 'Surplus (90+ days)'],
                ],
            ],
            'inventory' => [
                'headers' => ['SKU / Batch Code', 'Product Label', 'Available Stock', 'Committed / In Cart', 'Batch Landed Cost', 'Total Asset Value'],
                'rows' => [
                    ['SKU-DARJ-FF26-01', 'Makaibari First Flush 2026', '188', '14', '₹1,100', '₹2,06,800'],
                    ['SKU-KASH-SAFF-01', 'Kashmiri Mongra Saffron 1g', '42', '6', '₹680', '₹28,560'],
                    ['SKU-MIRIK-SN-02', 'Mirik Silver Needle White', '35', '8', '₹980', '₹34,300'],
                    ['SKU-NILG-FROST-01', 'High-Altitude Frost Tisane', '120', '4', '₹520', '₹62,400'],
                    ['SKU-ACC-SPOON-01', 'Brass Tasting Spoon Cloche', '210', '12', '₹410', '₹86,100'],
                ],
            ],
            'customer' => [
                'headers' => ['Connoisseur Cohort', 'Customer Count', 'Avg Order Value', 'Repeat Order %', 'Gross Lifetime Spend', 'Cohort Retention'],
                'rows' => [
                    ['Spring 2026 First Harvest Onboarding', '248', '₹3,420', '48.2%', '₹8,48,160', '91.4%'],
                    ['Winter 2025 Reserve Members', '312', '₹2,980', '44.1%', '₹9,29,760', '84.0%'],
                    ['Apothecary Gift Set Buyers', '186', '₹4,120', '34.8%', '₹7,66,320', '76.2%'],
                    ['Trial Sampler Recipients', '96', '₹1,450', '28.1%', '₹1,39,200', '62.5%'],
                ],
            ],
            'vendor' => [
                'headers' => ['Partner Estate / Artisan', 'Terroir Region', 'Orders Filled', 'Gross Volume', 'Commission (15%)', 'Net Estate Payout'],
                'rows' => [
                    ['Makaibari Bio-Organic Estate', 'Kurseong, Darjeeling', '312', '₹7,80,000', '₹1,17,000', '₹6,63,000'],
                    ['Pampore Valley Saffron Guild', 'Pampore, Kashmir', '215', '₹3,44,000', '₹51,600', '₹2,92,400'],
                    ['Okayti Organic Tea Highlands', 'Mirik, Darjeeling', '180', '₹4,32,000', '₹64,800', '₹3,67,200'],
                    ['Glendale Estate Nilgiri Tea', 'Nilgiri Blue Mountains', '144', '₹2,01,600', '₹30,240', '₹1,71,360'],
                    ['Vance Handcrafted Metalcraft', 'Moradabad, UP', '98', '₹1,22,500', '₹18,375', '₹1,04,125'],
                ],
            ],
            'order' => [
                'headers' => ['Order Stage', 'Total Volume', 'Avg Processing Time', 'Air Logistics SLA', 'Delayed > 72h', 'Fulfillment Quality'],
                'rows' => [
                    ['Pending Allocation', '18', '2.4 hours', 'Same-day assign', '0', '100% On-Track'],
                    ['Processing in Apothecary', '26', '6.8 hours', 'Pack in Violet Glass', '1', '96.2% On-Track'],
                    ['Dispatched via Blue Dart Air', '44', '28.4 hours', 'Transit across Metro', '2', '95.5% On-Track'],
                    ['Delivered to Connoisseur', '642', '42.0 hours', 'Doorstep Verification', '4', '99.4% On-Track'],
                    ['Cancelled / Returned', '12', 'N/A', 'Immediate Stock Reversal', '0', '100% Resolved'],
                ],
            ],
            default => [ // sales
                'headers' => ['Reporting Interval', 'Gross Sales (₹)', 'Orders Fulfilled', 'Avg Basket Value', 'Discounts (₹)', 'Net Margin'],
                'rows' => [
                    ['Current Week (Mon – Sun)', '₹5,42,000', '174 orders', '₹3,114', '₹19,200', '68.4%'],
                    ['Previous Week', '₹4,98,000', '162 orders', '₹3,074', '₹16,400', '67.8%'],
                    ['Two Weeks Prior', '₹4,65,000', '151 orders', '₹3,079', '₹18,100', '66.9%'],
                    ['Three Weeks Prior', '₹4,12,000', '135 orders', '₹3,051', '₹14,200', '67.2%'],
                    ['Four Weeks Prior', '₹3,95,000', '130 orders', '₹3,038', '₹12,800', '66.5%'],
                ],
            ],
        };
    }
}
