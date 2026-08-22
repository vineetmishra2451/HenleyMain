<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Henley Brand & Business Constants
    |--------------------------------------------------------------------------
    |
    | Centralized configuration for all brand-level constants, financial rules,
    | tax rates, shipping thresholds, and operational parameters.
    | No monetary or brand literals should be scattered in application code.
    |
    */

    'brand' => [
        'name' => 'Henley',
        'legal_name' => 'Henley Tea & Botanicals Private Limited',
        'tagline' => 'Pure leaf. Pure intent.',
        'support_email' => env('HENLEY_SUPPORT_EMAIL', 'care@henleytea.com'),
        'founder_note' => 'Fifteen quiet minutes for the senses.',
    ],

    'currency' => [
        'code' => env('APP_CURRENCY', 'INR'),
        'symbol' => '₹',
        'name' => 'Indian Rupee',
        'sub_unit' => 'paise',
        'sub_unit_factor' => 100,
    ],

    'storefront' => [
        'url' => env('APP_URL', 'http://localhost'),
        'timezone' => env('APP_TIMEZONE', 'Asia/Kolkata'),
        'locale' => 'en',
    ],

    'commerce' => [
        // Monetary thresholds represented in integer paise (100 paise = ₹1.00)
        'free_shipping_threshold_paise' => (int) env('HENLEY_FREE_SHIPPING_THRESHOLD_PAISE', 100000), // ₹1,000.00
        'standard_shipping_paise' => (int) env('HENLEY_STANDARD_SHIPPING_PAISE', 15000),             // ₹150.00
        'express_shipping_paise' => (int) env('HENLEY_EXPRESS_SHIPPING_PAISE', 35000),               // ₹350.00
        'cod_handling_fee_paise' => (int) env('HENLEY_COD_FEE_PAISE', 5000),                         // ₹50.00

        // Product catalogue constraints (₹300 - ₹4,000 range)
        'price_range' => [
            'min_paise' => 30000,   // ₹300.00
            'max_paise' => 400000,  // ₹4,000.00
        ],

        // Default GST / Tax rate on tea & botanical goods (5%)
        'default_gst_rate_percent' => (float) env('HENLEY_DEFAULT_GST_RATE', 5.0),
        'prices_include_tax' => true,
    ],

    'panels' => [
        'admin_path' => 'admin',
        'vendor_path' => 'vendor',
    ],

    'auth' => [
        'otp_enabled' => (bool) env('HENLEY_OTP_LOGIN_ENABLED', false),
        'otp_expiry_minutes' => 5,
        'otp_max_attempts' => 3,
        'sms_driver' => env('HENLEY_SMS_DRIVER', 'log'),
        'max_login_attempts' => 5,
        'lockout_minutes' => 15,
        'guest_checkout_enabled' => true,
        'min_password_length' => 12,
    ],
];
