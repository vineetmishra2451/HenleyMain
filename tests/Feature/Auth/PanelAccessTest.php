<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;

test('super admin can access both admin and vendor panels', function (): void {
    $superAdmin = User::where('email', 'admin@henleytea.com')->firstOrFail();

    $this->actingAs($superAdmin);

    $adminResponse = $this->get('/admin');
    $adminResponse->assertSuccessful();

    $vendorResponse = $this->get('/vendor');
    $vendorResponse->assertSuccessful();
});

test('curator admin can access admin panel but receives 403 on vendor panel', function (): void {
    $curator = User::where('email', 'curator@henleytea.com')->firstOrFail();

    $this->actingAs($curator);

    $adminResponse = $this->get('/admin');
    $adminResponse->assertSuccessful();

    $vendorResponse = $this->get('/vendor');
    $vendorResponse->assertForbidden();
});

test('vendor can access vendor panel but receives 403 on admin panel', function (): void {
    $vendor = User::where('email', 'estates@henleytea.com')->firstOrFail();

    $this->actingAs($vendor);

    $vendorResponse = $this->get('/vendor');
    $vendorResponse->assertSuccessful();

    $adminResponse = $this->get('/admin');
    $adminResponse->assertForbidden();
});

test('customer receives 403 on both admin and vendor panels', function (): void {
    $customer = User::where('email', 'collector@henleytea.com')->firstOrFail();

    $this->actingAs($customer);

    $adminResponse = $this->get('/admin');
    $adminResponse->assertForbidden();

    $vendorResponse = $this->get('/vendor');
    $vendorResponse->assertForbidden();
});
