<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

test('admin panel responds and redirects unauthenticated requests on admin.henley.com', function () {
    $response = $this->get('http://admin.henley.com/');
    $response->assertRedirect('http://admin.henley.com/login');

    $loginResponse = $this->get('http://admin.henley.com/login');
    $loginResponse->assertStatus(200);
    $loginResponse->assertSee('Henley — Admin');
    $loginResponse->assertSee('HENLEY');
    $loginResponse->assertSee('Forgot password?');

    $resetResponse = $this->get('http://admin.henley.com/password-reset/request');
    $resetResponse->assertStatus(200);
    $resetResponse->assertSee('Reset your password');
});

test('vendor panel responds and redirects unauthenticated requests on vendor.henley.com', function () {
    $response = $this->get('http://vendor.henley.com/');
    $response->assertRedirect('http://vendor.henley.com/login');

    $loginResponse = $this->get('http://vendor.henley.com/login');
    $loginResponse->assertStatus(200);
    $loginResponse->assertSee('Henley — Vendor');
    $loginResponse->assertSee('HENLEY');
    $loginResponse->assertSee('Forgot password?');

    $resetResponse = $this->get('http://vendor.henley.com/password-reset/request');
    $resetResponse->assertStatus(200);
    $resetResponse->assertSee('Reset your password');
});

test('RBAC: super admin and admin can access admin panel, vendor and customer are rejected', function () {
    $adminPanel = Filament::getPanel('admin');

    $superAdmin = User::where('email', 'admin@henley.com')->firstOrFail();
    $admin = User::where('role', UserRole::ADMIN)->firstOrFail();
    $vendor = User::where('email', 'vendor@henley.com')->firstOrFail();
    $customer = User::where('role', UserRole::CUSTOMER)->firstOrFail();

    // Super Admin and Admin can access
    expect($superAdmin->canAccessPanel($adminPanel))->toBeTrue()
        ->and($admin->canAccessPanel($adminPanel))->toBeTrue();

    // Vendor and Customer are rejected
    expect($vendor->canAccessPanel($adminPanel))->toBeFalse()
        ->and($customer->canAccessPanel($adminPanel))->toBeFalse();
});

test('RBAC: vendor can access vendor panel, admin super admin and customer are rejected', function () {
    $vendorPanel = Filament::getPanel('vendor');

    $superAdmin = User::where('email', 'admin@henley.com')->firstOrFail();
    $admin = User::where('role', UserRole::ADMIN)->firstOrFail();
    $vendor = User::where('email', 'vendor@henley.com')->firstOrFail();
    $customer = User::where('role', UserRole::CUSTOMER)->firstOrFail();

    // Vendor can access
    expect($vendor->canAccessPanel($vendorPanel))->toBeTrue();

    // Super Admin, Admin, and Customer are rejected
    expect($superAdmin->canAccessPanel($vendorPanel))->toBeFalse()
        ->and($admin->canAccessPanel($vendorPanel))->toBeFalse()
        ->and($customer->canAccessPanel($vendorPanel))->toBeFalse();
});

test('global VendorScope confines products, inventory and orders for authenticated vendor', function () {
    $vendorUserA = User::where('email', 'vendor@henley.com')->firstOrFail();
    $vendorId = $vendorUserA->vendor_id;
    expect($vendorId)->not->toBeNull();

    Auth::login($vendorUserA);

    // Products query is automatically scoped to vendor_id
    $scopedProducts = Product::all();
    expect($scopedProducts->every(fn (Product $p) => $p->vendor_id === $vendorId))->toBeTrue();

    // Inventory query is automatically scoped to vendor's variants
    $scopedInventory = Inventory::with('variant.product')->get();
    expect($scopedInventory->every(fn (Inventory $inv) => $inv->variant->product->vendor_id === $vendorId))->toBeTrue();

    // Orders query is automatically scoped to orders containing vendor's items
    $scopedOrders = Order::all();
    expect($scopedOrders->every(fn (Order $o) => $o->items()->where('vendor_id', $vendorId)->exists()))->toBeTrue();

    Auth::logout();
});
