<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

test('product query scopes filter active catalog accurately', function (): void {
    expect(Product::published()->count())->toBeGreaterThanOrEqual(15)
        ->and(Product::featured()->count())->toBeGreaterThanOrEqual(5)
        ->and(Product::bestseller()->count())->toBeGreaterThanOrEqual(4)
        ->and(Product::inStock()->count())->toBeGreaterThanOrEqual(10);
});

test('postgresql full-text search retrieves matching products', function (): void {
    $results = Product::search('Darjeeling')->get();
    expect($results)->not->toBeEmpty()
        ->and($results->first()->name)->toContain('Darjeeling');

    $chamomileResults = Product::search('Chamomile')->get();
    expect($chamomileResults)->not->toBeEmpty();
});

test('faceted filtering computes product counts across all terms in a single query', function (): void {
    $facetCounts = DB::table('taxonomies')
        ->join('taxonomy_terms', 'taxonomies.id', '=', 'taxonomy_terms.taxonomy_id')
        ->join('product_taxonomy_term', 'taxonomy_terms.id', '=', 'product_taxonomy_term.taxonomy_term_id')
        ->join('products', 'products.id', '=', 'product_taxonomy_term.product_id')
        ->where('products.status', 'published')
        ->whereNull('products.deleted_at')
        ->select([
            'taxonomies.slug as facet',
            'taxonomy_terms.slug as term_slug',
            'taxonomy_terms.name as term_name',
            DB::raw('count(products.id) as count'),
        ])
        ->groupBy('taxonomies.slug', 'taxonomy_terms.slug', 'taxonomy_terms.name')
        ->orderBy('count', 'desc')
        ->get();

    expect($facetCounts)->not->toBeEmpty();

    $facets = $facetCounts->pluck('facet')->unique();
    expect($facets)->toContain('benefit', 'type', 'caffeine');
});

test('coupon active scope and calculations work accurately', function (): void {
    $activeCoupon = Coupon::where('code', 'RITUAL15')->firstOrFail();
    expect($activeCoupon->isValidForOrder(1500.00))->toBeTrue()
        ->and($activeCoupon->calculateDiscount(2000.00))->toBe(300.00);

    $expiredCoupon = Coupon::where('code', 'SPRING10')->firstOrFail();
    expect($expiredCoupon->isValidForOrder(1000.00))->toBeFalse();

    $exhaustedCoupon = Coupon::where('code', 'WELCOME100')->firstOrFail();
    expect($exhaustedCoupon->isValidForOrder(1000.00))->toBeFalse();
});
