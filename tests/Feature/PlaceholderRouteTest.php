<?php

declare(strict_types=1);

test('it renders storefront placeholder with Henley branding and 200 OK', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('HENLEY');
    $response->assertSee('Pure leaf. Pure intent.');
    $response->assertSee('Fifteen quiet minutes for the senses.');
});
