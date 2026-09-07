<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;

test('super admin can access admin panel on admin subdomain', function (): void {
    $superAdmin = User::where('email', 'admin@henleytea.com')->firstOrFail();

    $this->actingAs($superAdmin);

    $adminResponse = $this->get('http://admin.henley.com/');
    $adminResponse->assertSuccessful();
});

test('curator admin can access admin panel but receives 403 on vendor panel', function (): void {
    $curator = User::where('email', 'curator@henleytea.com')->firstOrFail();

    $this->actingAs($curator);

    $adminResponse = $this->get('http://admin.henley.com/');
    $adminResponse->assertSuccessful();

    $vendorResponse = $this->get('http://vendor.henley.com/');
    $vendorResponse->assertForbidden();
});

test('vendor can access vendor panel but receives 403 on admin panel', function (): void {
    $vendor = User::where('email', 'estates@henleytea.com')->firstOrFail();

    $this->actingAs($vendor);

    $vendorResponse = $this->get('http://vendor.henley.com/');
    $vendorResponse->assertSuccessful();

    $adminResponse = $this->get('http://admin.henley.com/');
    $adminResponse->assertForbidden();
});

test('customer receives 403 on both admin and vendor panels', function (): void {
    $customer = User::where('email', 'collector@henleytea.com')->firstOrFail();

    $this->actingAs($customer);

    $adminResponse = $this->get('http://admin.henley.com/');
    $adminResponse->assertForbidden();

    $vendorResponse = $this->get('http://vendor.henley.com/');
    $vendorResponse->assertForbidden();
});
