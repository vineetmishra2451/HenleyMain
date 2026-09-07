<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Panel Subdomains & Multi-Domain Routing Groundwork
    |--------------------------------------------------------------------------
    |
    | Used by Part 2 (§9 onward) to optionally bind the Filament admin and
    | vendor panels to dedicated subdomains (e.g. admin.henley.test /
    | vendor.henley.test), while keeping the storefront on the root domain.
    |
    | If null, panels fall back to path-based prefixes (e.g. /admin, /vendor)
    | on the root application domain.
    |
    */

    'admin' => env('ADMIN_DOMAIN', 'admin.henley.com'),

    'vendor' => env('VENDOR_DOMAIN', 'vendor.henley.com'),

    'storefront' => env('STOREFRONT_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),

];
