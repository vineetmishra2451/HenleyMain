<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Filament\Vendor\Pages\Account;
use App\Filament\Vendor\Pages\Dashboard;
use App\Filament\Vendor\Pages\Sales;
use App\Filament\Vendor\Resources\Inventories\Pages\ListInventories;
use App\Filament\Vendor\Resources\Orders\Pages\ListOrders;
use App\Filament\Vendor\Resources\Products\Pages\ListProducts;
use App\Filament\Vendor\Widgets\VendorEstateHeaderWidget;
use App\Filament\Vendor\Widgets\VendorInventoryAlertsWidget;
use App\Filament\Vendor\Widgets\VendorOrdersOverviewWidget;
use App\Filament\Vendor\Widgets\VendorRevenueWidget;
use App\Filament\Vendor\Widgets\VendorSalesOverviewChartWidget;
use App\Models\User;
use App\Models\Vendor;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Tests\TestCase;

class VendorDashboardAndNavigationTest extends TestCase
{
    private User $vendorUser;
    private Vendor $vendor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vendorUser = User::where('email', 'vendor@henley.com')->firstOrFail();
        $this->vendor = $this->vendorUser->vendor;
    }

    public function test_unauthenticated_visitor_is_redirected_to_login_from_vendor_dashboard(): void
    {
        $response = $this->get('http://vendor.henley.com/');
        $response->assertRedirect('http://vendor.henley.com/login');
    }

    public function test_authenticated_vendor_can_access_vendor_dashboard_with_status_200(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/');
        $response->assertSuccessful();
        $response->assertSee('Henley — Vendor');
        $response->assertSee('HENLEY');
    }

    public function test_vendor_dashboard_renders_scoped_welcome_heading_with_estate_name(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/');
        $response->assertSuccessful();
        $response->assertSee($this->vendor->business_name);
        $response->assertSee('Partner Cellar Dashboard');
        $response->assertSee('Single-estate reserve analytics');
    }

    public function test_vendor_panel_navigation_shell_displays_all_six_scoped_nav_items(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/');
        $response->assertSuccessful();

        $response->assertSee('Dashboard');
        $response->assertSee('Products');
        $response->assertSee('Inventory');
        $response->assertSee('Orders');
        $response->assertSee('Sales');
        $response->assertSee('Account');

        // Admin-only groups/items must NOT be in the vendor sidebar
        $response->assertDontSee('Staff Roles & Policies');
        $response->assertDontSee('Audit & Activity Logs');
        $response->assertDontSee('Platform Settings');
        $response->assertDontSee('SEO Route Metadatas');
    }

    public function test_vendor_dashboard_renders_all_required_widgets(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/');
        $response->assertSuccessful();

        // 1. Estate Header Widget
        $response->assertSee('Verified Estate Partner');
        $response->assertSee('Contract Rate');

        // 2. Orders Overview Widget
        $response->assertSee('Total Estate Orders');
        $response->assertSee('Pending Review');
        $response->assertSee('In Processing');
        $response->assertSee('Completed Deliveries');

        // 3. Revenue Widget
        $response->assertSee('Gross Period Sales');
        $response->assertSee('Estimated Net Payout');
        $response->assertSee('Active Harvest Reserves');

        // 4. Sales Overview ChartWidget
        $response->assertSee('Sales Overview');

        // 5. Inventory Alerts TableWidget
        $response->assertSee('Inventory Alerts');
    }

    public function test_inventory_alerts_widget_is_scoped_to_authenticated_vendor_only(): void
    {
        // 1. Vendor 1 (Darjeeling Estate) has low-stock products
        $this->actingAs($this->vendorUser);

        $vendorAAlerts = \App\Models\Inventory::query()
            ->whereColumn('quantity_on_hand', '<=', 'low_stock_threshold')
            ->count();

        $this->assertGreaterThan(0, $vendorAAlerts);

        Livewire::test(VendorInventoryAlertsWidget::class)
            ->assertSuccessful()
            ->assertSee('Inventory Alerts');

        // 2. Vendor 2 (Kerala Spicery) has 0 low stock products
        $vendor2User = User::where('email', 'kerala.spices@henleytea.com')->firstOrFail();
        $this->actingAs($vendor2User);

        $vendorBAlerts = \App\Models\Inventory::query()
            ->whereColumn('quantity_on_hand', '<=', 'low_stock_threshold')
            ->count();

        $this->assertEquals(0, $vendorBAlerts);

        Livewire::test(VendorInventoryAlertsWidget::class)
            ->assertSuccessful();
    }

    public function test_vendor_orders_overview_widget_scopes_counts_to_authenticated_vendor(): void
    {
        $this->actingAs($this->vendorUser);

        $expectedCount = \App\Models\Order::count();

        Livewire::test(VendorOrdersOverviewWidget::class)
            ->assertSuccessful()
            ->assertSee((string) $expectedCount);
    }

    public function test_vendor_can_view_scoped_products_page(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/products');
        $response->assertSuccessful();
        $response->assertSee('Products');

        Livewire::test(ListProducts::class)
            ->assertSuccessful();
    }

    public function test_vendor_can_view_scoped_inventory_page(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/inventory');
        $response->assertSuccessful();
        $response->assertSee('Inventory');

        Livewire::test(ListInventories::class)
            ->assertSuccessful();
    }

    public function test_vendor_can_view_scoped_orders_page(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/orders');
        $response->assertSuccessful();
        $response->assertSee('Orders');

        Livewire::test(ListOrders::class)
            ->assertSuccessful();
    }

    public function test_vendor_can_view_scoped_sales_page(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/sales');
        $response->assertSuccessful();
        $response->assertSee('Sales & Settlement Analytics');
        $response->assertSee('Gross Merchandise Value');
        $response->assertSee('Net Estate Payout');

        Livewire::test(Sales::class)
            ->assertSuccessful()
            ->call('setRange', '7d')
            ->assertSet('dateRange', '7d')
            ->call('setRange', '90d')
            ->assertSet('dateRange', '90d');
    }

    public function test_vendor_can_view_scoped_account_page(): void
    {
        $this->actingAs($this->vendorUser);

        $response = $this->get('http://vendor.henley.com/account');
        $response->assertSuccessful();
        $response->assertSee('Estate Account & Profile');
        $response->assertSee($this->vendor->business_name);
        $response->assertSee('Tax & Bank Disbursements', false);

        Livewire::test(Account::class)
            ->assertSuccessful();
    }

    public function test_non_vendor_roles_are_rejected_from_vendor_panel(): void
    {
        $superAdmin = User::where('email', 'admin@henley.com')->firstOrFail();
        $customer = User::where('role', UserRole::CUSTOMER)->firstOrFail();
        $vendorPanel = Filament::getPanel('vendor');

        $this->assertFalse($superAdmin->canAccessPanel($vendorPanel));
        $this->assertFalse($customer->canAccessPanel($vendorPanel));
    }
}
