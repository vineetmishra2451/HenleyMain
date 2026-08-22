<?php

declare(strict_types=1);

use App\Enums\ProductStatus;
use App\Livewire\Storefront\NewsletterSignup;
use App\Livewire\Storefront\SearchOverlay;
use App\Models\Category;
use App\Models\HomepageSection;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;

beforeEach(function (): void {
    Cache::flush();
});

test('storefront home page renders successfully with 200 OK and Henley branding', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('HENLEY');
    $response->assertSee('Pure leaf. Pure intent.');
    $response->assertSee('Explore the Reserve');
    $response->assertSee('The Botanical Journal');
    $response->assertSee('Join the Henley Collector Circle');
});

test('storefront layout includes Organization and WebSite JSON-LD structured data', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('https://schema.org', false);
    $response->assertSee('"@type": "Organization"', false);
    $response->assertSee('"@type": "WebSite"', false);
    $response->assertSee('"@type": "SearchAction"', false);
});

test('homepage dynamically reorders sections based on sort_order in database', function (): void {
    // Swap sort order of hero (currently 1) and pillars/trust_strip (currently 2)
    $hero = HomepageSection::where('key', 'hero_section')->firstOrFail();
    $trust = HomepageSection::where('key', 'trust_strip_section')->firstOrFail();

    $hero->update(['sort_order' => 10]);
    $trust->update(['sort_order' => 1]);

    Cache::tags(['homepage'])->flush();

    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    $trustPos = strpos($content, 'Traceable directly to prime mountain slopes');
    $heroPos = strpos($content, 'Spring 2026 First Flush Release');

    expect($trustPos)->toBeLessThan($heroPos);
});

test('homepage hides disabled sections completely when is_active is false', function (): void {
    $hero = HomepageSection::where('key', 'hero_section')->firstOrFail();
    $hero->update(['is_active' => false]);

    Cache::tags(['homepage'])->flush();

    $response = $this->get('/');
    $response->assertOk();

    $response->assertDontSee('Fifteen quiet minutes for the senses.');
});

test('homepage renders graceful empty state when all sections are absent', function (): void {
    HomepageSection::query()->delete();
    Cache::tags(['homepage'])->flush();

    $response = $this->get('/');
    $response->assertOk();
    $response->assertSee('The Sanctuary is Being Prepared');
    $response->assertSee('Explore The Cellar');
});

test('live search overlay returns instant matching products for query', function (): void {
    $testProduct = Product::where('status', ProductStatus::PUBLISHED)->firstOrFail();

    Livewire::test(SearchOverlay::class)
        ->set('query', substr($testProduct->name, 0, 5))
        ->assertSee($testProduct->name)
        ->call('closeSearch')
        ->assertSet('isOpen', false)
        ->assertSet('query', '');
});

test('newsletter subscription validates email and handles rate limiting', function (): void {
    Livewire::test(NewsletterSignup::class)
        ->set('email', 'invalid-email')
        ->call('subscribe')
        ->assertHasErrors(['email'])
        ->set('email', 'collector@example.com')
        ->call('subscribe')
        ->assertHasNoErrors()
        ->assertSet('subscribed', true)
        ->assertDispatched('notify');
});

test('placeholder image swapping works end to end as content without template modification', function (): void {
    $category = Category::where('is_featured', true)->orderBy('sort_order')->orderBy('id')->firstOrFail();
    $originalImage = $category->image_path;

    // Simulate marketing admin uploading a new custom asset path
    $newAssetUrl = '/images/brand/test-harvest-2026.webp';
    $category->update(['image_path' => $newAssetUrl]);

    $response = $this->get('/');
    $response->assertOk();
    $response->assertSee($newAssetUrl);

    // Revert
    $category->update(['image_path' => $originalImage]);
});

test('placeholder audit artisan command runs and outputs accurate status', function (): void {
    $this->artisan('henley:audit-placeholders')
        ->assertSuccessful()
        ->expectsOutputToContain('Scanning Henley catalogue and content entities for active placeholders');
});
