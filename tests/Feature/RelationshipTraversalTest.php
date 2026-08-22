<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Taxonomy;
use App\Models\User;
use App\Models\Vendor;

test('all domain models support seamless bidirectional relationship traversal', function (): void {
    // 1. User <-> Customer <-> Address <-> Orders
    $customerUser = User::with(['customer.addresses', 'orders', 'reviews', 'wishlist'])->where('email', 'collector@henleytea.com')->firstOrFail();
    $customerProfile = $customerUser->customer;
    expect($customerProfile)->toBeInstanceOf(Customer::class)
        ->and($customerProfile->user()->first()?->id)->toBe($customerUser->id)
        ->and($customerProfile->addresses)->not->toBeEmpty()
        ->and($customerProfile->addresses->first()->customer()->first()?->id)->toBe($customerProfile->id);

    // 2. Vendor <-> Products <-> Users
    $vendor = Vendor::with(['users', 'products.variants.inventory', 'shipments'])->where('slug', 'darjeeling-himalayan-tea-estate')->firstOrFail();
    expect($vendor->users)->not->toBeEmpty()
        ->and($vendor->users->first()->vendor()->first()?->id)->toBe($vendor->id)
        ->and($vendor->products)->not->toBeEmpty()
        ->and($vendor->products->first()->vendor()->first()?->id)->toBe($vendor->id);

    // 3. Category <-> Subcategories <-> Products
    $category = Category::with('products.categories')->where('slug', 'restorative-sleep')->firstOrFail();
    expect($category->products)->not->toBeEmpty()
        ->and($category->products->first()->categories->pluck('id'))->toContain($category->id);

    // 4. Brand <-> Products
    $brand = Brand::with('products.brand')->firstOrFail();
    expect($brand->products)->not->toBeEmpty()
        ->and($brand->products->first()->brand()->first()?->id)->toBe($brand->id);

    // 5. Product <-> Variants <-> Inventory <-> StockMovements
    $product = Product::with(['variants.inventory', 'variants.stockMovements', 'attributes', 'images', 'taxonomyTerms.taxonomy', 'reviews.user'])->where('slug', 'restorative-sleep-nighttime-infusion')->firstOrFail();
    expect($product->variants)->not->toBeEmpty();

    $variant = $product->variants->first();
    expect($variant->product()->first()?->id)->toBe($product->id)
        ->and($variant->inventory)->toBeInstanceOf(Inventory::class)
        ->and($variant->inventory->variant()->first()?->id)->toBe($variant->id)
        ->and($variant->stockMovements)->not->toBeEmpty()
        ->and($variant->stockMovements->first()->variant()->first()?->id)->toBe($variant->id);

    // 6. Product <-> Attributes & Images
    expect($product->attributes)->not->toBeEmpty()
        ->and($product->attributes->first()->product()->first()?->id)->toBe($product->id)
        ->and($product->images)->not->toBeEmpty()
        ->and($product->images->first()->product()->first()?->id)->toBe($product->id);

    // 7. Product <-> Taxonomy Terms <-> Taxonomy
    expect($product->taxonomyTerms)->not->toBeEmpty();
    $term = $product->taxonomyTerms->first();
    expect($term->taxonomy)->toBeInstanceOf(Taxonomy::class)
        ->and($term->products()->pluck('id'))->toContain($product->id);

    // 8. Product <-> Reviews <-> User / Customer
    expect($product->reviews)->not->toBeEmpty();
    $review = $product->reviews->first();
    expect($review->product()->first()?->id)->toBe($product->id)
        ->and($review->user)->toBeInstanceOf(User::class);

    // 9. Order <-> Items <-> Payments <-> Shipments <-> User
    $order = Order::with(['user', 'items.product', 'items.variant', 'payments', 'shipments'])->where('status', 'delivered')->firstOrFail();
    expect($order->user)->toBeInstanceOf(User::class)
        ->and($order->items)->not->toBeEmpty()
        ->and($order->items->first()->order()->first()?->id)->toBe($order->id)
        ->and($order->payments)->not->toBeEmpty()
        ->and($order->payments->first()->order()->first()?->id)->toBe($order->id)
        ->and($order->shipments)->not->toBeEmpty()
        ->and($order->shipments->first()->order()->first()?->id)->toBe($order->id);

    // 10. Coupon <-> Redemptions <-> Order
    $coupon = Coupon::with('redemptions.order')->where('code', 'RITUAL15')->firstOrFail();
    expect($coupon->redemptions)->not->toBeEmpty()
        ->and($coupon->redemptions->first()->coupon()->first()?->id)->toBe($coupon->id)
        ->and($coupon->redemptions->first()->order)->toBeInstanceOf(Order::class);
});
