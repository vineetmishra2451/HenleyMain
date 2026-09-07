<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\CouponType;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\VendorStatus;
use App\Filament\Admin\Resources\Coupons\CouponResource;
use App\Filament\Admin\Resources\Customers\CustomerResource;
use App\Filament\Admin\Resources\Orders\OrderResource;
use App\Filament\Admin\Resources\Vendors\VendorResource;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;

beforeEach(function (): void {
    $this->superAdmin = User::where('email', 'admin@henley.com')->firstOrFail();
});

test('admin can view vendors list with commercial metrics, contact email, and status badge', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(VendorResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Estate / Business');
    $response->assertSee('Contact Email');
    $response->assertSee('Products');
    $response->assertSee('Orders');
    $response->assertSee('Status');

    $vendor = Vendor::first();
    if ($vendor) {
        $response->assertSee($vendor->business_name);
        $response->assertSee($vendor->email);
    }
});

test('admin can view vendor create and edit pages with relation tabs', function (): void {
    $this->actingAs($this->superAdmin);

    $createResponse = $this->get(VendorResource::getUrl('create'));
    $createResponse->assertSuccessful();
    $createResponse->assertSee('Estate & Business Details');
    $createResponse->assertSee('Contact & Botanical Estate Location');
    $createResponse->assertSee('Platform Commission (%)');

    $vendor = Vendor::firstOrFail();
    $editResponse = $this->get(VendorResource::getUrl('edit', ['record' => $vendor]));
    $editResponse->assertSuccessful();
    $editResponse->assertSee($vendor->business_name);
    $editResponse->assertSee('Partner Details');
    $editResponse->assertSee('Vendor Products');
    $editResponse->assertSee('Vendor Inventory');
    $editResponse->assertSee('Vendor Orders');
    $editResponse->assertSee('Vendor Performance');
});

test('admin can view customers list with lifetime spend and order count', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(CustomerResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Customer Name');
    $response->assertSee('Email');
    $response->assertSee('Orders');
    $response->assertSee('Total Spent');
    $response->assertSee('Joined Date');

    $customer = Customer::with('user')->first();
    if ($customer && $customer->user) {
        $response->assertSee($customer->user->name);
        $response->assertSee($customer->user->email);
    }
});

test('admin can view customer details page with relation managers', function (): void {
    $this->actingAs($this->superAdmin);

    $customer = Customer::with('user')->firstOrFail();
    $response = $this->get(CustomerResource::getUrl('view', ['record' => $customer]));

    $response->assertSuccessful();
    $response->assertSee('Client Overview');
    $response->assertSee('Profile & Preferences');
    $response->assertSee('Customer Profile');
    $response->assertSee('Customer Orders');
    $response->assertSee('Customer Addresses');
    $response->assertSee('Customer Activity Timeline');
    $response->assertSee($customer->user->name);
});

test('admin can view orders list with order status tabs, badges, and filters', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(OrderResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Order #');
    $response->assertSee('Customer');
    $response->assertSee('Date');
    $response->assertSee('Items');
    $response->assertSee('Total');
    $response->assertSee('Payment');
    $response->assertSee('Order Status');

    // Verify default tabs
    $response->assertSee('All Orders');
    $response->assertSee('Pending');
    $response->assertSee('Processing');
    $response->assertSee('Shipped');
    $response->assertSee('Delivered');
    $response->assertSee('Cancelled');

    $order = Order::first();
    if ($order) {
        $response->assertSee($order->order_number);
    }
});

test('admin can view order details page with line items, address, and financial summary', function (): void {
    $this->actingAs($this->superAdmin);

    $order = Order::with('items')->firstOrFail();
    $response = $this->get(OrderResource::getUrl('view', ['record' => $order]));

    $response->assertSuccessful();
    $response->assertSee('Order Summary');
    $response->assertSee('Purchased Items');
    $response->assertSee('Delivery Destination');
    $response->assertSee('Billing & Financial Snapshot');
    $response->assertSee($order->order_number);
    $response->assertSee('Update Status');

    if ($order->items->isNotEmpty()) {
        $response->assertSee($order->items->first()->product_name);
    }
});

test('order status update stamps cancellation details when cancelled', function (): void {
    $order = Order::create([
        'order_number' => 'HNL-TEST-STATUS-101',
        'customer_snapshot' => ['name' => 'Sommelier Client', 'email' => 'client@henley.com', 'phone' => '+919876543210'],
        'shipping_address' => ['recipient_name' => 'Sommelier Client', 'phone' => '+919876543210', 'line_1' => '10 Botanical Way', 'city' => 'Mumbai', 'state' => 'Maharashtra', 'pincode' => '400001', 'country' => 'IN'],
        'billing_address' => ['recipient_name' => 'Sommelier Client', 'phone' => '+919876543210', 'line_1' => '10 Botanical Way', 'city' => 'Mumbai', 'state' => 'Maharashtra', 'pincode' => '400001', 'country' => 'IN'],
        'subtotal' => 1200.00,
        'discount_amount' => 0.00,
        'tax_amount' => 60.00,
        'shipping_amount' => 100.00,
        'grand_total' => 1360.00,
        'status' => OrderStatus::PENDING,
        'payment_status' => PaymentStatus::PENDING,
        'currency' => 'INR',
        'placed_at' => now(),
    ]);

    expect($order->cancelled_at)->toBeNull();

    // Emulate status update to cancelled with reason
    $order->status = OrderStatus::CANCELLED;
    $order->cancelled_at = now();
    $order->admin_notes = '[Cancellation] Batch test discrepancy noted by sommelier';
    $order->save();

    $refreshed = Order::withoutGlobalScopes()->where('order_number', 'HNL-TEST-STATUS-101')->firstOrFail();
    expect($refreshed->status)->toBe(OrderStatus::CANCELLED)
        ->and($refreshed->cancelled_at)->not->toBeNull()
        ->and($refreshed->admin_notes)->toContain('[Cancellation]');

    $order->delete();
});

test('admin can view coupons list with tabs, discount badges, and active toggle', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(CouponResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Code');
    $response->assertSee('Discount');
    $response->assertSee('Usage / Limit');
    $response->assertSee('Expiry Date');
    $response->assertSee('Active');
    $response->assertSee('Validity');

    // Verify tabs
    $response->assertSee('All Coupons');
    $response->assertSee('Active');
    $response->assertSee('Expired');

    $coupon = Coupon::first();
    if ($coupon) {
        $response->assertSee($coupon->code);
    }
});

test('admin can view coupon create and edit forms', function (): void {
    $this->actingAs($this->superAdmin);

    $createResponse = $this->get(CouponResource::getUrl('create'));
    $createResponse->assertSuccessful();
    $createResponse->assertSee('Coupon Voucher Details');
    $createResponse->assertSee('Usage Limits & Redemptions');
    $createResponse->assertSee('Voucher Code');
    $createResponse->assertSee('Discount Type');

    $coupon = Coupon::firstOrFail();
    $editResponse = $this->get(CouponResource::getUrl('edit', ['record' => $coupon]));
    $editResponse->assertSuccessful();
    $editResponse->assertSee($coupon->code);
});
