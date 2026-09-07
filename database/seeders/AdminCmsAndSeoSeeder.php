<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PromotionalContent;
use App\Models\SeoMetadata;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class AdminCmsAndSeoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Promotional Content
        $promotions = [
            [
                'key' => 'header_announcement_ribbon',
                'title' => 'Storewide Announcement Ribbon',
                'placement' => 'header_ribbon',
                'headline' => 'Complimentary Express Air Delivery on all Himalayan reserve orders over ₹1,500',
                'body' => 'Orders hand-packed in UV-protective dark violet apothecary glass within 48 hours of lot approval.',
                'coupon_code' => null,
                'button_label' => 'Explore Reserves',
                'button_url' => '/collections',
                'is_active' => true,
            ],
            [
                'key' => 'first_ritual_welcome',
                'title' => 'First Ritual Welcome Offer',
                'placement' => 'cart_drawer',
                'headline' => 'Enjoy 10% privilege on your first single-origin harvest collection',
                'body' => 'Apply code at checkout on orders exceeding ₹1,500. Handcrafted brass tasting spoons included.',
                'coupon_code' => 'RITUAL10',
                'button_label' => 'Apply Privilege',
                'button_url' => null,
                'is_active' => true,
            ],
            [
                'key' => 'checkout_guarantee',
                'title' => 'Apothecary Freshness Guarantee',
                'placement' => 'checkout_summary',
                'headline' => '100% Single-Estate Biodynamic Harvest Guarantee',
                'body' => 'Direct from high-altitude gardens at peak diurnal elevation with full lot traceability.',
                'coupon_code' => null,
                'button_label' => null,
                'button_url' => null,
                'is_active' => true,
            ],
            [
                'key' => 'seasonal_allocation_notice',
                'title' => 'Spring First Flush Allocation Notice',
                'placement' => 'collection_header',
                'headline' => 'Micro-lot Makaibari Estate Single Flush now released',
                'body' => 'Strictly limited to 250 numbered apothecary vessels worldwide for the 2026 spring harvest.',
                'coupon_code' => 'ESTATE2026',
                'button_label' => 'Reserve Vessel',
                'button_url' => '/products/makaibari-estate-first-flush-silver-tips',
                'is_active' => true,
            ],
        ];

        foreach ($promotions as $promo) {
            PromotionalContent::updateOrCreate(
                ['key' => $promo['key']],
                $promo
            );
        }

        // 2. SEO Metadata
        $routes = [
            [
                'route_name' => 'home',
                'path' => '/',
                'meta_title' => 'Henley Botanicals — Pure Leaf. Pure Intent. Single-Estate Artisanal Tea',
                'meta_description' => 'High-altitude botanical infusions, single-estate teas, and rare apothecary reserves sourced directly from Himalayan biodiversity sanctuaries.',
                'og_image_url' => '/images/brand/homepage.jpeg',
                'is_indexable' => true,
            ],
            [
                'route_name' => 'collections.index',
                'path' => '/collections',
                'meta_title' => 'Single-Origin & Rare Tea Collections | Henley Botanicals',
                'meta_description' => 'Explore our seasonal flushes, biodynamic herbal tisanes, and ceremonial accessories. Hand-plucked at peak diurnal elevation.',
                'og_image_url' => '/images/brand/collectionpage.jpeg',
                'is_indexable' => true,
            ],
            [
                'route_name' => 'about',
                'path' => '/about',
                'meta_title' => 'The Botanical Philosophy & Terroir | Our Story — Henley',
                'meta_description' => 'Founded on the principles of unhurried biodynamic agriculture, chemical purity, and single-lot transparency.',
                'og_image_url' => '/images/brand/brandstory.jpeg',
                'is_indexable' => true,
            ],
            [
                'route_name' => 'journal.index',
                'path' => '/journal',
                'meta_title' => 'The Botanical Journal — Field Notes & Brewing Alchemy | Henley',
                'meta_description' => 'Essays on high-altitude terroir, aromatic chemistry, volatile compounds, and the mindful ritual of tea extraction.',
                'og_image_url' => '/images/brand/journal.jpeg',
                'is_indexable' => true,
            ],
            [
                'route_name' => 'cart',
                'path' => '/cart',
                'meta_title' => 'Your Apothecary Vessel Cart | Henley Botanicals',
                'meta_description' => 'Review your curated selection of artisanal teas and botanical preparations.',
                'og_image_url' => '/images/brand/cart.jpeg',
                'is_indexable' => false,
            ],
        ];

        foreach ($routes as $route) {
            SeoMetadata::updateOrCreate(
                ['route_name' => $route['route_name']],
                $route
            );
        }

        // 3. Settings for Admin ManageSettings page
        $extraSettings = [
            // General
            ['group' => 'general', 'key' => 'store_name', 'value' => 'Henley Artisanal Botanicals', 'type' => 'string'],
            ['group' => 'general', 'key' => 'store_description', 'value' => 'Luxury artisanal single-estate tea and herbal apothecaries.', 'type' => 'string'],
            ['group' => 'general', 'key' => 'currency_code', 'value' => 'INR', 'type' => 'string'],
            ['group' => 'general', 'key' => 'support_hours', 'value' => 'Monday – Saturday: 09:00 – 18:00 IST', 'type' => 'string'],

            // Payment (Razorpay masked keys)
            ['group' => 'payment', 'key' => 'gateway', 'value' => 'razorpay', 'type' => 'string'],
            ['group' => 'payment', 'key' => 'razorpay_key_id', 'value' => 'rzp_live_henley_prod_9921', 'type' => 'string'],
            ['group' => 'payment', 'key' => 'razorpay_key_secret', 'value' => 'sec_live_HenleyReserve_9824X8yZ', 'type' => 'string'],
            ['group' => 'payment', 'key' => 'razorpay_webhook_secret', 'value' => 'whsec_HenleyWebhooks_Token_2026', 'type' => 'string'],
            ['group' => 'payment', 'key' => 'cod_enabled', 'value' => '0', 'type' => 'boolean'],

            // Email
            ['group' => 'email', 'key' => 'mail_provider', 'value' => 'resend', 'type' => 'string'],
            ['group' => 'email', 'key' => 'mail_from_name', 'value' => 'Henley Botanicals Concierge', 'type' => 'string'],
            ['group' => 'email', 'key' => 'mail_from_address', 'value' => 'concierge@henleytea.com', 'type' => 'string'],
            ['group' => 'email', 'key' => 'smtp_host', 'value' => 'smtp.resend.com', 'type' => 'string'],
            ['group' => 'email', 'key' => 'smtp_port', 'value' => '587', 'type' => 'integer'],
            ['group' => 'email', 'key' => 'smtp_username', 'value' => 'resend', 'type' => 'string'],
            ['group' => 'email', 'key' => 'smtp_password', 'value' => 're_123456789_HenleySecretToken', 'type' => 'string'],

            // Shipping
            ['group' => 'shipping', 'key' => 'shipping_origin_country', 'value' => 'India', 'type' => 'string'],
            ['group' => 'shipping', 'key' => 'shipping_origin_city', 'value' => 'Darjeeling / Siliguri', 'type' => 'string'],
            ['group' => 'shipping', 'key' => 'express_shipping_rate_paise', 'value' => '25000', 'type' => 'integer'],
            ['group' => 'shipping', 'key' => 'international_shipping_enabled', 'value' => '1', 'type' => 'boolean'],

            // Tax
            ['group' => 'tax', 'key' => 'tax_calculation_mode', 'value' => 'inclusive', 'type' => 'string'],
            ['group' => 'tax', 'key' => 'hsn_default_tea', 'value' => '0902', 'type' => 'string'],
            ['group' => 'tax', 'key' => 'gstin_number', 'value' => '19AAACH7409R1ZZ', 'type' => 'string'],

            // SEO Defaults
            ['group' => 'seo', 'key' => 'default_meta_title', 'value' => 'Henley — Pure Leaf. Pure Intent.', 'type' => 'string'],
            ['group' => 'seo', 'key' => 'default_meta_description', 'value' => 'Rare single-origin tea flushes, botanical tisanes, and apothecary accessories.', 'type' => 'string'],
            ['group' => 'seo', 'key' => 'default_og_image', 'value' => '/images/brand/homepage.jpeg', 'type' => 'string'],
            ['group' => 'seo', 'key' => 'google_analytics_id', 'value' => 'G-HENLEY2026', 'type' => 'string'],

            // System
            ['group' => 'system', 'key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean'],
            ['group' => 'system', 'key' => 'cache_driver', 'value' => 'redis', 'type' => 'string'],
            ['group' => 'system', 'key' => 'order_auto_archive_days', 'value' => '90', 'type' => 'integer'],
            ['group' => 'system', 'key' => 'inventory_low_stock_threshold', 'value' => '15', 'type' => 'integer'],
        ];

        foreach ($extraSettings as $s) {
            Setting::updateOrCreate(
                ['group' => $s['group'], 'key' => $s['key']],
                $s
            );
        }
    }
}
