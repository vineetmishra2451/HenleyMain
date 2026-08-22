<?php

declare(strict_types=1);

use App\Livewire\Storefront\NewsletterSignup;
use App\Livewire\Storefront\SearchOverlay;
use App\Models\HomepageSection;
use App\Services\HomepageService;
use Livewire\Livewire;

use function Pest\Laravel\get;

beforeEach(function (): void {
    HomepageService::clearCache();
});

test('storefront home page renders successfully with 200 OK and complete brand shell', function (): void {
    $response = get(route('home'));

    $response->assertOk()
        ->assertSee('HENLEY')
        ->assertSee('Pure leaf. Pure intent.')
        ->assertSee('Curated Collections')
        ->assertSee('The Seasonal Reserve')
        ->assertSee('The Definitive Bestsellers')
        ->assertSee('The Architecture of Purity')
        ->assertSee('The Botanical Journal')
        ->assertSee('Rituals from the Field')
        ->assertSee('The Inner Circle')
        ->assertSee('https://schema.org', false)
        ->assertSee('Organization', false)
        ->assertSee('WebSite', false);
});

test('homepage sections dynamically reflect sort order changes', function (): void {
    // Swap sort order of hero and story band
    HomepageSection::where('type', 'hero')->update(['sort_order' => 10]);
    HomepageSection::where('type', 'story_band')->update(['sort_order' => 1]);

    HomepageService::clearCache();

    $response = get(route('home'));
    $response->assertOk();

    $content = $response->getContent();
    $storyPos = strpos((string) $content, 'The Architecture of Purity');
    $heroPos = strpos((string) $content, 'Explore the Reserve');

    expect($storyPos)->toBeLessThan($heroPos);
});

test('homepage gracefully handles disabled sections', function (): void {
    // Disable journal preview
    HomepageSection::where('type', 'journal_preview')->update(['is_active' => false]);
    HomepageService::clearCache();

    $response = get(route('home'));
    $response->assertOk()
        ->assertDontSee('The Botanical Journal');
});

test('homepage renders graceful fallback when all sections are removed from database', function (): void {
    HomepageSection::query()->delete();
    HomepageService::clearCache();

    $response = get(route('home'));
    $response->assertOk()
        ->assertSee('HENLEY')
        ->assertSee('Pure leaf. Pure intent.');
});

test('live search overlay returns live product matches when queried', function (): void {
    Livewire::test(SearchOverlay::class)
        ->call('open')
        ->assertSet('isOpen', true)
        ->set('query', 'Darjeeling')
        ->assertSee('Castleton')
        ->set('query', 'NonExistentHerbXYZ')
        ->assertSee('No harvests found matching');
});

test('newsletter signup validates email and confirms subscription', function (): void {
    Livewire::test(NewsletterSignup::class)
        ->set('email', 'invalid-email')
        ->call('subscribe')
        ->assertHasErrors(['email'])
        ->set('email', 'lady.margaret@henleytea.com')
        ->call('subscribe')
        ->assertHasNoErrors()
        ->assertSet('subscribed', true)
        ->assertSee('Welcome to the Inner Circle');
});
