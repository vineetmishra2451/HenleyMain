<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Gate;

test('vendor user can view and update their own products but is denied for another vendor product', function (): void {
    $vendorA = Vendor::where('slug', 'darjeeling-himalayan-tea-estate')->firstOrFail();
    $vendorB = Vendor::where('slug', 'kerala-spicery-botanicals')->firstOrFail();

    $userA = User::where('vendor_id', $vendorA->id)->firstOrFail();
    $userB = User::where('vendor_id', $vendorB->id)->firstOrFail();

    $productA = Product::withoutGlobalScopes()->where('vendor_id', $vendorA->id)->firstOrFail();
    $productB = Product::withoutGlobalScopes()->where('vendor_id', $vendorB->id)->firstOrFail();

    // User A on Product A -> Allowed
    expect(Gate::forUser($userA)->allows('update', $productA))->toBeTrue()
        ->and(Gate::forUser($userA)->allows('view', $productA))->toBeTrue();

    // User A on Product B -> Denied
    expect(Gate::forUser($userA)->allows('update', $productB))->toBeFalse();

    // User B on Product A -> Denied
    expect(Gate::forUser($userB)->allows('update', $productA))->toBeFalse();
});

test('vendor user is denied access to an order belonging exclusively to another vendor', function (): void {
    $vendorA = Vendor::where('slug', 'darjeeling-himalayan-tea-estate')->firstOrFail();
    $vendorB = Vendor::where('slug', 'kerala-spicery-botanicals')->firstOrFail();

    $userA = User::where('vendor_id', $vendorA->id)->firstOrFail();

    // Order with only Vendor B items
    $orderWithOnlyVendorB = Order::whereHas('items', function ($query) use ($vendorB) {
        $query->where('vendor_id', $vendorB->id);
    })->whereDoesntHave('items', function ($query) use ($vendorA) {
        $query->where('vendor_id', $vendorA->id);
    })->firstOrFail();

    expect(Gate::forUser($userA)->allows('view', $orderWithOnlyVendorB))->toBeFalse()
        ->and(Gate::forUser($userA)->allows('updateStatus', $orderWithOnlyVendorB))->toBeFalse();
});

test('super admin holds universal policy authorization across all models and vendors', function (): void {
    $superAdmin = User::where('email', 'admin@henleytea.com')->firstOrFail();

    $product = Product::withoutGlobalScopes()->firstOrFail();
    $order = Order::firstOrFail();
    $shipment = Shipment::withoutGlobalScopes()->firstOrFail();

    expect(Gate::forUser($superAdmin)->allows('update', $product))->toBeTrue()
        ->and(Gate::forUser($superAdmin)->allows('view', $order))->toBeTrue()
        ->and(Gate::forUser($superAdmin)->allows('update', $shipment))->toBeTrue();
});
