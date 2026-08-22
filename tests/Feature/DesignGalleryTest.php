<?php

declare(strict_types=1);

use function Pest\Laravel\get;

test('design gallery route renders successfully with 200 OK in local environment', function (): void {
    $response = get(route('design.gallery'));

    $response->assertOk()
        ->assertSee('Henley Design System')
        ->assertSee('01. Brand Foundations')
        ->assertSee('02. Typographic Scale')
        ->assertSee('03. Interactive Controls')
        ->assertSee('04. Forms & Input Wells')
        ->assertSee('05. Structural Layout')
        ->assertSee('06. Editorial Voice')
        ->assertSee('07. Commerce Components')
        ->assertSee('08. Feedback & Overlays')
        ->assertSee('09. Navigation & Disclosure')
        ->assertSee('10. Signature Geometry')
        ->assertSee('11. Line Iconography');
});

test('blade components contain zero unsemantic raw hex literals', function (): void {
    $componentFiles = glob(resource_path('views/components/**/*.blade.php'));
    $componentFiles = array_merge($componentFiles, glob(resource_path('views/components/*.blade.php')));

    foreach ($componentFiles as $file) {
        $content = file_get_contents($file);
        // Exclude SVG linearGradient stops or comments if any, check for raw inline style or tailwind hex #
        preg_match_all('/(?:bg|text|border|fill|stroke)-\[#([a-fA-F0-9]{3,6})\]/', $content, $matches);
        expect($matches[0])->toBeEmpty("Found unsemantic arbitrary hex class in {$file}");
    }
});
