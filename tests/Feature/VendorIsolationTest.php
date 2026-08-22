<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

test('vendor global scope isolates products between different vendors', function (): void {
    $vendorA = Vendor::where('slug', 'darjeeling-himalayan-tea-estate')->firstOrFail();
    $vendorB = Vendor::where('slug', 'kerala-spicery-botanicals')->firstOrFail();

    $userVendorA = User::where('vendor_id', $vendorA->id)->firstOrFail();
    $userVendorB = User::where('vendor_id', $vendorB->id)->firstOrFail();

    $productA = Product::where('vendor_id', $vendorA->id)->firstOrFail();
    $productB = Product::where('vendor_id', $vendorB->id)->firstOrFail();

    // 1. Authenticate as Vendor A
    Auth::login($userVendorA);

    // Vendor A should see their own products
    expect(Product::where('id', $productA->id)->exists())->toBeTrue();

    // Vendor A query for Vendor B's product by ID must return null due to VendorScope
    $isolatedProduct = Product::find($productB->id);
    expect($isolatedProduct)->toBeNull();

    // Total products for Vendor A should only match Vendor A count
    $vendorACount = Product::count();
    $actualVendorACount = Product::withoutGlobalScopes()->where('vendor_id', $vendorA->id)->count();
    expect($vendorACount)->toBe($actualVendorACount);

    // 2. Authenticate as Vendor B
    Auth::login($userVendorB);

    expect(Product::find($productA->id))->toBeNull();
    expect(Product::find($productB->id))->not->toBeNull();

    // 3. Super Admin should see all products across all vendors
    $superAdmin = User::where('role', UserRole::SUPER_ADMIN)->firstOrFail();
    Auth::login($superAdmin);

    expect(Product::find($productA->id))->not->toBeNull();
    expect(Product::find($productB->id))->not->toBeNull();
    expect(Product::count())->toBe(Product::withoutGlobalScopes()->count());

    Auth::logout();
});
