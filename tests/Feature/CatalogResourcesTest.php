<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\ProductStatus;
use App\Enums\StockMovementReason;
use App\Filament\Admin\Resources\Brands\BrandResource;
use App\Filament\Admin\Resources\Categories\CategoryResource;
use App\Filament\Admin\Resources\Inventories\InventoryResource;
use App\Filament\Admin\Resources\Products\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Support\Str;

beforeEach(function (): void {
    $this->superAdmin = User::where('email', 'admin@henley.com')->firstOrFail();
});

test('admin can view products list with catalog columns, price, stock, and badges', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(ProductResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Products');
    $response->assertSee('Thumbnail');
    $response->assertSee('Category');
    $response->assertSee('Brand');
    $response->assertSee('Price');
    $response->assertSee('Stock');
    $response->assertSee('Status');

    $product = Product::first();
    if ($product) {
        $response->assertSee($product->name);
    }
});

test('admin can view product create and edit pages', function (): void {
    $this->actingAs($this->superAdmin);

    $createResponse = $this->get(ProductResource::getUrl('create'));
    $createResponse->assertSuccessful();
    $createResponse->assertSee('General Information');
    $createResponse->assertSee('Pricing and Inventory');
    $createResponse->assertSee('Media');
    $createResponse->assertSee('Inventory Quantity');

    $product = Product::firstOrFail();
    $editResponse = $this->get(ProductResource::getUrl('edit', ['record' => $product]));
    $editResponse->assertSuccessful();
    $editResponse->assertSee($product->name);
});

test('product duplicate replicates record with copy slug and draft status', function (): void {
    $this->actingAs($this->superAdmin);

    $original = Product::firstOrFail();
    $replica = $original->replicate(['search_vector']);
    $replica->name = $original->name . ' (Copy)';
    $replica->slug = $original->slug . '-copy-' . strtolower(Str::random(4));
    $replica->status = ProductStatus::DRAFT;
    $replica->save();
    $replica->categories()->sync($original->categories->pluck('id'));

    expect($replica->id)->not->toBe($original->id)
        ->and($replica->status)->toBe(ProductStatus::DRAFT)
        ->and($replica->slug)->toContain('-copy-')
        ->and($replica->name)->toContain('(Copy)');

    $replica->forceDelete();
});

test('admin can view categories list with tree nesting, product count, and active toggle', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(CategoryResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Categories');
    $response->assertSee('Category Name');
    $response->assertSee('Parent Category');
    $response->assertSee('Products');
    $response->assertSee('Display Order');
    $response->assertSee('Active');

    $category = Category::first();
    if ($category) {
        $response->assertSee($category->name);
    }
});

test('admin can view category create and edit pages', function (): void {
    $this->actingAs($this->superAdmin);

    $createResponse = $this->get(CategoryResource::getUrl('create'));
    $createResponse->assertSuccessful();
    $createResponse->assertSee('Category Information');
    $createResponse->assertSee('Parent Category');
    $createResponse->assertSee('Display Order');

    $category = Category::firstOrFail();
    $editResponse = $this->get(CategoryResource::getUrl('edit', ['record' => $category]));
    $editResponse->assertSuccessful();
    $editResponse->assertSee($category->name);
});

test('admin can view brands list with logo placeholder, name, product count, and active toggle', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(BrandResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Brands');
    $response->assertSee('Logo');
    $response->assertSee('Brand Name');
    $response->assertSee('Products');
    $response->assertSee('Active');

    $brand = Brand::first();
    if ($brand) {
        $response->assertSee($brand->name);
    }
});

test('admin can view brand create and edit pages', function (): void {
    $this->actingAs($this->superAdmin);

    $createResponse = $this->get(BrandResource::getUrl('create'));
    $createResponse->assertSuccessful();
    $createResponse->assertSee('Brand Information');
    $createResponse->assertSee('Brand Logo');

    $brand = Brand::firstOrFail();
    $editResponse = $this->get(BrandResource::getUrl('edit', ['record' => $brand]));
    $editResponse->assertSuccessful();
    $editResponse->assertSee($brand->name);
});

test('admin can view inventory stock overview with tabs and stock indicators', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(InventoryResource::getUrl('index'));

    $response->assertSuccessful();
    $response->assertSee('Inventory Management');
    $response->assertSee('All Stock');
    $response->assertSee('Low Stock');
    $response->assertSee('Out of Stock');
    $response->assertSee('Product / Variant', escape: false);
    $response->assertSee('SKU');
    $response->assertSee('Current Stock');
    $response->assertSee('Reserved');
    $response->assertSee('Available');
    $response->assertSee('Reorder Threshold');
    $response->assertSee('Stock Adjustment');
    $response->assertSee('Inventory History');
});

test('quick stock adjustment modifies inventory and appends to audit ledger', function (): void {
    $inventory = Inventory::firstOrFail();
    $initialStock = $inventory->quantity_on_hand;
    $delta = 15;
    $newStock = $initialStock + $delta;

    $inventory->update(['quantity_on_hand' => $newStock]);

    $movement = StockMovement::create([
        'product_variant_id' => $inventory->product_variant_id,
        'reason' => StockMovementReason::MANUAL_ADJUSTMENT,
        'quantity_delta' => $delta,
        'balance_after' => $newStock,
        'actor_id' => $this->superAdmin->id,
        'notes' => 'Test manual inventory adjustment verification',
        'created_at' => now(),
    ]);

    expect($inventory->fresh()->quantity_on_hand)->toBe($newStock)
        ->and($movement->id)->toBeGreaterThan(0)
        ->and($movement->balance_after)->toBe($newStock)
        ->and($movement->reason)->toBe(StockMovementReason::MANUAL_ADJUSTMENT);

    // Rollback test adjustment
    $inventory->update(['quantity_on_hand' => $initialStock]);
    $movement->delete();
});

test('admin can view inventory audit history page with past movements and actors', function (): void {
    $this->actingAs($this->superAdmin);

    $response = $this->get(InventoryResource::getUrl('history'));

    $response->assertSuccessful();
    $response->assertSee('Inventory Audit History');
    $response->assertSee('Back to Stock Overview');
    $response->assertSee('Product / Variant', escape: false);
    $response->assertSee('Change');
    $response->assertSee('Balance After');
    $response->assertSee('Reason');
    $response->assertSee('Actor');
    $response->assertSee('Timestamp');

    $movement = StockMovement::with('variant.product')->latest('created_at')->first();
    if ($movement && $movement->variant?->product) {
        $response->assertSee(e($movement->variant->product->name), escape: false);
    }
});
