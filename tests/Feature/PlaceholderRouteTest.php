<?php

declare(strict_types=1);

test('it renders storefront home page with Henley branding and 200 OK', function (): void {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('HENLEY');
    $response->assertSee('Pure leaf. Pure intent.');
    $response->assertSee('The Seasonal Reserve');
});
