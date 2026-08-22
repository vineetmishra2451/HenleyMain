<?php

declare(strict_types=1);

test('admin panel responds and redirects or renders login screen', function () {
    $response = $this->get('/admin');

    // Admin should redirect to /admin/login for unauthenticated users
    $response->assertRedirect('/admin/login');

    $loginResponse = $this->get('/admin/login');
    $loginResponse->assertStatus(200);
});

test('vendor panel responds and redirects or renders login screen', function () {
    $response = $this->get('/vendor');

    // Vendor should redirect to /vendor/login for unauthenticated users
    $response->assertRedirect('/vendor/login');

    $loginResponse = $this->get('/vendor/login');
    $loginResponse->assertStatus(200);
});
