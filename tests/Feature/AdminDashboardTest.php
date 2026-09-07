<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;

test('authenticated super admin can access admin dashboard with all 7 widgets', function (): void {
    $superAdmin = User::where('email', 'admin@henley.com')->firstOrFail();

    $this->actingAs($superAdmin);

    $response = $this->get('http://admin.henley.com/');
    $response->assertSuccessful();

    // 1. Dashboard Heading & Page Shell
    $response->assertSee('Executive Dashboard');

    // 2. Sales Overview ChartWidget
    $response->assertSee('Sales Overview');

    // 3. Executive Stats: Revenue & Customers
    $response->assertSee('Revenue');
    $response->assertSee('₹1,842,500');
    $response->assertSee('+14.8% from last month');
    $response->assertSee('Customers');
    $response->assertSee('2,840');
    $response->assertSee('+142 new this period');

    // 4. Orders Overview 4-across row
    $response->assertSee('Total Orders');
    $response->assertSee('1,248');
    $response->assertSee('Pending');
    $response->assertSee('32');
    $response->assertSee('Processing');
    $response->assertSee('58');
    $response->assertSee('Delivered');
    $response->assertSee('1,158');

    // 5. Inventory Alerts TableWidget
    $response->assertSee('Inventory Alerts');
    $response->assertSee('Threshold');
    $response->assertSee('Current Stock');
    $response->assertSee('View');

    // 6. Vendor Performance TableWidget
    $response->assertSee('Vendor Performance');
    $response->assertSee('View All');
    $response->assertSee('Darjeeling Himalayan Tea Estate');

    // 7. Reports Navigation Widget
    $response->assertSee('Executive & Financial Reports', escape: false);
    $response->assertSee('Sales & Revenue', escape: false);
    $response->assertSee('Inventory Valuation');
    $response->assertSee('Vendor Settlement');
    $response->assertSee('Tax & GST Ledger', escape: false);
});

test('unauthenticated visitor is redirected to login from admin dashboard', function (): void {
    $response = $this->get('http://admin.henley.com/');
    $response->assertRedirect('http://admin.henley.com/login');
});

test('vendor partner cannot access admin dashboard', function (): void {
    $vendor = User::where('email', 'vendor@henley.com')->firstOrFail();

    $this->actingAs($vendor);

    $response = $this->get('http://admin.henley.com/');
    $response->assertForbidden();
});
