<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\ProductStatus;
use App\Enums\StockMovementReason;
use App\Filament\Vendor\Pages\Account;
use App\Filament\Vendor\Pages\ProductPerformance;
use App\Filament\Vendor\Pages\Sales;
use App\Filament\Vendor\Pages\SalesReports;
use App\Filament\Vendor\Resources\Inventories\InventoryResource;
use App\Filament\Vendor\Resources\Inventories\Pages\InventoryHistory;
use App\Filament\Vendor\Resources\Inventories\Pages\ListInventories;
use App\Filament\Vendor\Resources\Orders\OrderResource;
use App\Filament\Vendor\Resources\Orders\Pages\ListOrders;
use App\Filament\Vendor\Resources\Orders\Pages\ViewOrder;
use App\Filament\Vendor\Resources\Products\Pages\CreateProduct;
use App\Filament\Vendor\Resources\Products\Pages\EditProduct;
use App\Filament\Vendor\Resources\Products\Pages\ListProducts;
use App\Filament\Vendor\Resources\Products\ProductResource;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Vendor;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class VendorSitemapResourcesTest extends TestCase
{
    private User $vendor1User;
    private Vendor $vendor1;
    private User $vendor2User;
    private Vendor $vendor2;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('vendor'));

        $this->vendor1User = User::where('email', 'vendor@henley.com')->firstOrFail();
        $this->vendor1 = $this->vendor1User->vendor;

        $this->vendor2User = User::where('email', 'vendor2@henley.com')->firstOrFail();
        $this->vendor2 = $this->vendor2User->vendor;
    }

    // ==========================================
    // 1. Multi-Vendor Isolation Verification
    // ==========================================

    public function test_vendor1_and_vendor2_have_strictly_non_overlapping_products(): void
    {
        $v1ProductIds = Product::withoutGlobalScopes()
            ->where('vendor_id', $this->vendor1->id)
            ->pluck('id')
            ->toArray();

        $v2ProductIds = Product::withoutGlobalScopes()
            ->where('vendor_id', $this->vendor2->id)
            ->pluck('id')
            ->toArray();

        $this->assertNotEmpty($v1ProductIds);
        $this->assertNotEmpty($v2ProductIds);

        $intersection = array_intersect($v1ProductIds, $v2ProductIds);
        $this->assertEmpty($intersection, 'Vendor 1 and Vendor 2 products must have 0 overlap.');
    }

    public function test_vendor1_and_vendor2_have_strictly_non_overlapping_inventories(): void
    {
        $v1InventoryIds = Inventory::withoutGlobalScopes()
            ->whereHas('variant.product', fn ($q) => $q->withoutGlobalScopes()->where('vendor_id', $this->vendor1->id))
            ->pluck('id')
            ->toArray();

        $v2InventoryIds = Inventory::withoutGlobalScopes()
            ->whereHas('variant.product', fn ($q) => $q->withoutGlobalScopes()->where('vendor_id', $this->vendor2->id))
            ->pluck('id')
            ->toArray();

        $this->assertNotEmpty($v1InventoryIds);
        $this->assertNotEmpty($v2InventoryIds);

        $intersection = array_intersect($v1InventoryIds, $v2InventoryIds);
        $this->assertEmpty($intersection, 'Vendor 1 and Vendor 2 inventories must have 0 overlap.');
    }

    // ==========================================
    // 2. Products Resource Scoping & CRUD
    // ==========================================

    public function test_vendor_can_list_only_their_own_products(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/products');
        $response->assertSuccessful();

        $v1Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor1->id)->first();
        $v2Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor2->id)->first();

        $response->assertSee($v1Product->name);
        $response->assertDontSee($v2Product->name);

        Livewire::test(ListProducts::class)
            ->assertSuccessful();
    }

    public function test_vendor_can_view_create_product_page(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/products/create');
        $response->assertSuccessful();
        $response->assertSee('Add Product to Cellar');
    }

    public function test_vendor_can_create_a_product_automatically_stamped_with_vendor_id(): void
    {
        $this->actingAs($this->vendor1User);

        $uniqueSlug = 'test-tea-' . uniqid();
        $uniqueName = 'Organic Himalayan Muscatel ' . rand(100, 999);

        Livewire::test(CreateProduct::class)
            ->fillForm([
                'name' => $uniqueName,
                'slug' => $uniqueSlug,
                'short_description' => 'A test high-grown muscatel harvest.',
                'description' => 'Detailed estate harvesting description.',
                'status' => ProductStatus::DRAFT->value,
                'base_price' => 1850,
                'inventory_quantity' => 50,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $createdProduct = Product::withoutGlobalScopes()->where('slug', $uniqueSlug)->first();
        $this->assertNotNull($createdProduct);
        $this->assertEquals($this->vendor1->id, $createdProduct->vendor_id);
        $this->assertEquals($uniqueName, $createdProduct->name);

        // Verify variant and inventory were provisioned
        $this->assertDatabaseHas('product_variants', [
            'product_id' => $createdProduct->id,
            'price' => '1850.00',
        ]);
        $this->assertDatabaseHas('inventories', [
            'quantity_on_hand' => 50,
        ]);
    }

    public function test_vendor_can_edit_own_product(): void
    {
        $this->actingAs($this->vendor1User);

        $v1Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor1->id)->first();

        $response = $this->get('http://vendor.henley.com/products/' . $v1Product->slug . '/edit');
        $response->assertSuccessful();
        $response->assertSee($v1Product->name);

        Livewire::test(EditProduct::class, ['record' => $v1Product->getRouteKey()])
            ->assertSuccessful()
            ->assertFormSet([
                'name' => $v1Product->name,
                'status' => $v1Product->status->value,
            ]);
    }

    public function test_vendor_cannot_view_or_edit_another_vendors_product(): void
    {
        $this->actingAs($this->vendor1User);

        $v2Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor2->id)->first();

        $response = $this->get('http://vendor.henley.com/products/' . $v2Product->slug . '/edit');
        $response->assertNotFound();
    }

    public function test_vendor_can_replicate_product_as_draft(): void
    {
        $this->actingAs($this->vendor1User);

        $product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor1->id)->first();

        Livewire::test(ListProducts::class)
            ->callTableAction('replicate', $product);

        $replicated = Product::withoutGlobalScopes()
            ->where('vendor_id', $this->vendor1->id)
            ->where('slug', 'like', $product->slug . '%copy%')
            ->latest('id')
            ->first();

        $this->assertNotNull($replicated);
        $this->assertEquals(ProductStatus::DRAFT, $replicated->status);
        $this->assertStringContainsString('(Copy)', $replicated->name);
    }

    // ==========================================
    // 3. Inventory Resource Scoping & Adjustments
    // ==========================================

    public function test_vendor_can_view_inventory_overview_scoped_to_their_products(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/inventory');
        $response->assertSuccessful();
        $response->assertSee('Inventory');
        $response->assertSee('Audit History');

        $v2Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor2->id)->first();
        $this->assertNotNull($v2Product);
        $response->assertDontSee($v2Product->name);

        Livewire::test(ListInventories::class)
            ->assertSuccessful();
    }

    public function test_vendor_can_adjust_stock_quantity_and_creates_stock_movement(): void
    {
        $this->actingAs($this->vendor1User);

        $inventory = Inventory::withoutGlobalScopes()
            ->whereHas('variant.product', fn ($q) => $q->withoutGlobalScopes()->where('vendor_id', $this->vendor1->id))
            ->first();

        $initialQuantity = $inventory->quantity_on_hand;
        $delta = 15;

        Livewire::test(ListInventories::class)
            ->callTableAction('adjustStock', $inventory, data: [
                'quantity_delta' => $delta,
                'reason' => StockMovementReason::RESTOCK->value,
                'notes' => 'Fresh estate autumn harvest delivery',
            ])
            ->assertHasNoTableActionErrors();

        $inventory->refresh();
        $this->assertEquals($initialQuantity + $delta, $inventory->quantity_on_hand);

        $movement = StockMovement::where('product_variant_id', $inventory->product_variant_id)
            ->where('quantity_delta', $delta)
            ->where('reason', StockMovementReason::RESTOCK)
            ->latest('id')
            ->first();

        $this->assertNotNull($movement);
        $this->assertEquals($inventory->quantity_on_hand, $movement->balance_after);
        $this->assertEquals('Fresh estate autumn harvest delivery', $movement->notes);
    }

    public function test_vendor_can_view_inventory_history_audit_page(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/inventory/history');
        $response->assertSuccessful();
        $response->assertSee('Cellar Audit & Stock History');

        Livewire::test(InventoryHistory::class)
            ->assertSuccessful();
    }

    // ==========================================
    // 4. Orders Resource Scoping & Multi-Vendor Line Item Privacy
    // ==========================================

    public function test_vendor_can_view_orders_table_scoped_to_their_orders(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/orders');
        $response->assertSuccessful();
        $response->assertSee('Orders');

        Livewire::test(ListOrders::class)
            ->assertSuccessful();
    }

    public function test_multi_vendor_order_masks_other_vendors_items_and_hides_payment_secrets(): void
    {
        $this->actingAs($this->vendor1User);

        $v1Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor1->id)->first();
        $v2Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor2->id)->first();

        $multiOrder = Order::withoutGlobalScopes()
            ->whereHas('items', fn ($q) => $q->withoutGlobalScopes()->where('vendor_id', $this->vendor1->id))
            ->whereHas('items', fn ($q) => $q->withoutGlobalScopes()->where('vendor_id', '!=', $this->vendor1->id))
            ->first();

        if (! $multiOrder) {
            $multiOrder = Order::withoutGlobalScopes()->first();
            OrderItem::withoutGlobalScopes()->create([
                'order_id' => $multiOrder->id,
                'product_id' => $v1Product->id,
                'product_variant_id' => $v1Product->variants->first()->id,
                'vendor_id' => $this->vendor1->id,
                'product_name' => $v1Product->name,
                'variant_label' => 'Standard',
                'sku' => 'TEST-V1-MULTI',
                'unit_price' => 1200,
                'quantity' => 1,
                'line_tax' => 60,
                'line_discount' => 0,
                'line_total' => 1260,
                'fulfillment_status' => 'pending',
            ]);
            OrderItem::withoutGlobalScopes()->create([
                'order_id' => $multiOrder->id,
                'product_id' => $v2Product->id,
                'product_variant_id' => $v2Product->variants->first()->id,
                'vendor_id' => $this->vendor2->id,
                'product_name' => $v2Product->name,
                'variant_label' => 'Standard',
                'sku' => 'TEST-V2-MULTI',
                'unit_price' => 1500,
                'quantity' => 1,
                'line_tax' => 75,
                'line_discount' => 0,
                'line_total' => 1575,
                'fulfillment_status' => 'pending',
            ]);
        }

        $response = $this->get('http://vendor.henley.com/orders/' . $multiOrder->getRouteKey());
        $response->assertSuccessful();

        // Vendor 1 should see their items
        $v1ItemNames = OrderItem::withoutGlobalScopes()
            ->where('order_id', $multiOrder->id)
            ->where('vendor_id', $this->vendor1->id)
            ->pluck('product_name');

        foreach ($v1ItemNames as $name) {
            $response->assertSee($name);
        }

        // Vendor 1 MUST NOT see other vendors' items
        $otherItemNames = OrderItem::withoutGlobalScopes()
            ->where('order_id', $multiOrder->id)
            ->where('vendor_id', '!=', $this->vendor1->id)
            ->pluck('product_name');

        foreach ($otherItemNames as $name) {
            $response->assertDontSee($name);
        }

        // Sensitive credentials/signatures must NOT be exposed
        $response->assertDontSee('razorpay_signature');
        $response->assertDontSee('stripe_secret_key');
        $response->assertDontSee('api_key');
    }

    public function test_vendor_cannot_view_order_belonging_only_to_another_vendor(): void
    {
        // Find order belonging to someone other than vendor 2
        $otherVendorOrder = Order::withoutGlobalScopes()
            ->whereDoesntHave('items', fn ($q) => $q->withoutGlobalScopes()->where('vendor_id', $this->vendor2->id))
            ->first();

        $this->assertNotNull($otherVendorOrder);

        $this->actingAs($this->vendor2User);
        $response = $this->get('http://vendor.henley.com/orders/' . $otherVendorOrder->getRouteKey());
        $response->assertNotFound();
    }

    public function test_vendor_can_update_fulfillment_status_on_their_line_items(): void
    {
        $this->actingAs($this->vendor1User);

        $v1Item = OrderItem::withoutGlobalScopes()->where('vendor_id', $this->vendor1->id)->first();
        $this->assertNotNull($v1Item);
        $orderWithV1 = Order::withoutGlobalScopes()->find($v1Item->order_id);
        $this->assertNotNull($orderWithV1);

        $v1Items = OrderItem::withoutGlobalScopes()
            ->where('order_id', $orderWithV1->id)
            ->where('vendor_id', $this->vendor1->id)
            ->get();

        $this->assertNotEmpty($v1Items);

        Livewire::test(ViewOrder::class, ['record' => $orderWithV1->getRouteKey()])
            ->assertSuccessful()
            ->callAction('updateFulfillment', data: [
                'item_id' => 'all',
                'fulfillment_status' => 'shipped',
                'tracking_number' => 'BLUE-DART-DARJ-9988',
                'courier_name' => 'Blue Dart Express',
            ])
            ->assertHasNoActionErrors();

        foreach ($v1Items as $item) {
            $item->refresh();
            $this->assertEquals('shipped', $item->fulfillment_status);
        }

        // Verify another vendor's item was untouched if order is multi-vendor
        $otherItem = OrderItem::withoutGlobalScopes()
            ->where('order_id', $orderWithV1->id)
            ->where('vendor_id', '!=', $this->vendor1->id)
            ->first();

        if ($otherItem) {
            $this->assertNotEquals('shipped', $otherItem->fulfillment_status);
        }
    }

    // ==========================================
    // 5. Sales Section
    // ==========================================

    public function test_vendor_can_view_sales_dashboard(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/sales');
        $response->assertSuccessful();
        $response->assertSee('Sales & Settlement Analytics');

        Livewire::test(Sales::class)
            ->assertSuccessful();
    }

    public function test_vendor_can_view_sales_reports_page(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/sales/reports');
        $response->assertSuccessful();
        $response->assertSee('Periodic Sales & Tax Reports');
        $response->assertSee('Weekly Revenue Breakdown');

        Livewire::test(SalesReports::class)
            ->assertSuccessful()
            ->call('setPreset', '7d')
            ->assertSet('periodPreset', '7d');
    }

    public function test_vendor_can_view_product_performance_page(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/sales/product-performance');
        $response->assertSuccessful();
        $response->assertSee('Harvest Product Performance & Velocity');

        $v1Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor1->id)->first();
        $v2Product = Product::withoutGlobalScopes()->where('vendor_id', $this->vendor2->id)->first();

        $response->assertSee($v1Product->name);
        $response->assertDontSee($v2Product->name);

        Livewire::test(ProductPerformance::class)
            ->assertSuccessful();
    }

    // ==========================================
    // 6. Account Section
    // ==========================================

    public function test_vendor_can_view_account_page_with_masked_bank_details(): void
    {
        $this->actingAs($this->vendor1User);

        $response = $this->get('http://vendor.henley.com/account');
        $response->assertSuccessful();
        $response->assertSee('Estate Account & Profile');
        $response->assertSee($this->vendor1->business_name);
        $response->assertSee('••••••••4819');

        Livewire::test(Account::class)
            ->assertSuccessful();
    }

    public function test_vendor_can_update_profile_and_notifications_on_account_page(): void
    {
        $this->actingAs($this->vendor1User);

        Livewire::test(Account::class)
            ->set('name', 'Estate Manager Updated')
            ->set('phone', '+91 98765 43210')
            ->call('saveProfile')
            ->assertHasNoErrors();

        $this->vendor1User->refresh();
        $this->assertEquals('Estate Manager Updated', $this->vendor1User->name);

        Livewire::test(Account::class)
            ->set('notifyNewOrders', false)
            ->set('notifyLowStock', true)
            ->call('saveNotificationSettings')
            ->assertHasNoErrors();
    }

    public function test_vendor_can_update_password_on_account_page(): void
    {
        $this->actingAs($this->vendor1User);

        $currentPassword = Hash::check('Botanical#2026!Secure', $this->vendor1User->password) ? 'Botanical#2026!Secure' : 'password';

        Livewire::test(Account::class)
            ->set('currentPassword', $currentPassword)
            ->set('newPassword', 'NewSecretKey2026!')
            ->set('newPasswordConfirmation', 'NewSecretKey2026!')
            ->call('updatePassword')
            ->assertHasNoErrors();

        $this->vendor1User->refresh();
        $this->assertTrue(Hash::check('NewSecretKey2026!', $this->vendor1User->password));

        // Restore password for test continuity
        $this->vendor1User->update(['password' => Hash::make($currentPassword)]);
    }
}
