<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

class ManageSettings extends Page
{
    protected static ?string $title = 'Platform Settings';

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected string $view = 'filament.admin.pages.manage-settings';

    /**
     * Form state data array holding all key-value settings.
     *
     * @var array<string, mixed>
     */
    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::all();
        $state = [];

        foreach ($settings as $setting) {
            $value = $setting->value;
            if ($setting->type === 'boolean') {
                $value = (bool) $value;
            } elseif ($setting->type === 'integer') {
                $value = (int) $value;
            } elseif ($setting->type === 'float') {
                $value = (float) $value;
            }
            $state[$setting->key] = $value;
        }

        $this->form->fill($state);
    }

    public function getSubheading(): string | Htmlable | null
    {
        return 'Configure global commerce parameters, Razorpay API credentials, mail dispatches, and tax rules.';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Tabs::make('SettingsTabs')
                    ->tabs([
                        // Tab 1: General
                        Tab::make('General')
                            ->icon(Heroicon::OutlinedBuildingStorefront)
                            ->schema([
                                Section::make('Storefront Identity & Contact')
                                    ->description('Brand credentials displayed in storefront headers, footers, and invoices.')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('store_name')
                                                    ->label('Store Legal Name')
                                                    ->required(),
                                                TextInput::make('brand_tagline')
                                                    ->label('Brand Tagline / Ethos')
                                                    ->placeholder('Pure leaf. Pure intent.')
                                                    ->required(),
                                            ]),
                                        Textarea::make('store_description')
                                            ->label('Storefront Elevator Summary')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('contact_email')
                                                    ->label('Concierge Support Email')
                                                    ->email()
                                                    ->required(),
                                                TextInput::make('contact_phone')
                                                    ->label('Concierge Phone')
                                                    ->placeholder('+91 800 436539'),
                                                TextInput::make('support_hours')
                                                    ->label('Support Hours')
                                                    ->placeholder('Mon – Sat: 09:00 – 18:00 IST'),
                                            ]),
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('currency_symbol')
                                                    ->label('Currency Symbol')
                                                    ->default('₹')
                                                    ->required(),
                                                TextInput::make('currency_code')
                                                    ->label('Currency Code (ISO-4217)')
                                                    ->default('INR')
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),

                        // Tab 2: Payment
                        Tab::make('Payment')
                            ->icon(Heroicon::OutlinedCreditCard)
                            ->schema([
                                Section::make('Razorpay Payment Gateway')
                                    ->description('API credentials for payment captures, webhooks, and automatic payouts.')
                                    ->schema([
                                        Select::make('gateway')
                                            ->label('Primary Gateway')
                                            ->options([
                                                'razorpay' => 'Razorpay (Standard)',
                                                'stripe' => 'Stripe International',
                                                'cashfree' => 'Cashfree Payments',
                                            ])
                                            ->default('razorpay')
                                            ->required(),
                                        TextInput::make('razorpay_key_id')
                                            ->label('Razorpay Key ID')
                                            ->helperText('Public merchant ID starting with rzp_live_ or rzp_test_')
                                            ->required(),
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('razorpay_key_secret')
                                                    ->label('Razorpay Key Secret')
                                                    ->password()
                                                    ->revealable()
                                                    ->helperText('Secret merchant credential — masked for security.')
                                                    ->required(),
                                                TextInput::make('razorpay_webhook_secret')
                                                    ->label('Webhook Signing Secret')
                                                    ->password()
                                                    ->revealable()
                                                    ->helperText('Signature secret used to verify webhook integrity.')
                                                    ->required(),
                                            ]),
                                        Toggle::make('cod_enabled')
                                            ->label('Enable Cash on Delivery (COD)')
                                            ->helperText('Allow connoisseurs to pay at doorstep upon air shipment delivery.'),
                                    ]),
                            ]),

                        // Tab 3: Email
                        Tab::make('Email')
                            ->icon(Heroicon::OutlinedEnvelope)
                            ->schema([
                                Section::make('Transactional Mail Services')
                                    ->description('Order notifications, shipping dispatches, and gift certificate emails.')
                                    ->schema([
                                        Select::make('mail_provider')
                                            ->label('Mailing Provider')
                                            ->options([
                                                'resend' => 'Resend (Modern Cloud SMTP / API)',
                                                'smtp' => 'Standard SMTP Relay',
                                                'brevo' => 'Brevo (formerly Sendinblue)',
                                                'mailgun' => 'Mailgun by Sinch',
                                            ])
                                            ->default('resend')
                                            ->required(),
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('mail_from_name')
                                                    ->label('Default Sender Name')
                                                    ->default('Henley Botanicals Concierge')
                                                    ->required(),
                                                TextInput::make('mail_from_address')
                                                    ->label('Default Sender Email')
                                                    ->email()
                                                    ->default('concierge@henleytea.com')
                                                    ->required(),
                                            ]),
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('smtp_host')
                                                    ->label('SMTP Server Host')
                                                    ->default('smtp.resend.com'),
                                                TextInput::make('smtp_port')
                                                    ->label('SMTP Port')
                                                    ->default(587),
                                                TextInput::make('smtp_username')
                                                    ->label('SMTP Username')
                                                    ->default('resend'),
                                            ]),
                                        TextInput::make('smtp_password')
                                            ->label('SMTP Password / API Key')
                                            ->password()
                                            ->revealable()
                                            ->helperText('Encrypted mail server token — masked for operational security.'),
                                    ]),
                            ]),

                        // Tab 4: Shipping
                        Tab::make('Shipping')
                            ->icon(Heroicon::OutlinedTruck)
                            ->schema([
                                Section::make('Air Logistics & Freight Tariffs')
                                    ->description('Dispatch thresholds, flat rates, and origin fulfilment centres.')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('shipping_origin_country')
                                                    ->label('Origin Country')
                                                    ->default('India')
                                                    ->required(),
                                                TextInput::make('shipping_origin_city')
                                                    ->label('Fulfilment Hub')
                                                    ->default('Darjeeling / Siliguri')
                                                    ->required(),
                                            ]),
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('free_shipping_threshold_paise')
                                                    ->label('Free Shipping Threshold (Paise)')
                                                    ->numeric()
                                                    ->helperText('150000 paise = ₹1,500 complimentary delivery threshold')
                                                    ->required(),
                                                TextInput::make('standard_shipping_rate_paise')
                                                    ->label('Standard Shipping (Paise)')
                                                    ->numeric()
                                                    ->helperText('9000 paise = ₹90 standard delivery')
                                                    ->required(),
                                                TextInput::make('express_shipping_rate_paise')
                                                    ->label('Express Air Delivery (Paise)')
                                                    ->numeric()
                                                    ->helperText('25000 paise = ₹250 expedited delivery')
                                                    ->required(),
                                            ]),
                                        Toggle::make('international_shipping_enabled')
                                            ->label('Enable Cross-Border Worldwide Dispatch')
                                            ->helperText('Allows overseas collectors to place orders with international air freight.'),
                                    ]),
                            ]),

                        // Tab 5: Tax
                        Tab::make('Tax')
                            ->icon(Heroicon::OutlinedReceiptPercent)
                            ->schema([
                                Section::make('Goods and Services Tax (GST) Compliance')
                                    ->description('National tariff percentages, tea HSN classifications, and invoice GSTIN.')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                Select::make('tax_calculation_mode')
                                                    ->label('Tax Pricing Mode')
                                                    ->options([
                                                        'inclusive' => 'Prices Inclusive of GST (Retail Recommended)',
                                                        'exclusive' => 'Tax Added at Checkout (B2B Mode)',
                                                    ])
                                                    ->default('inclusive')
                                                    ->required(),
                                                TextInput::make('default_gst_rate_percent')
                                                    ->label('Standard GST Rate (%)')
                                                    ->numeric()
                                                    ->default('5.0')
                                                    ->suffix('%')
                                                    ->required(),
                                            ]),
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('hsn_default_tea')
                                                    ->label('Default HSN Code for Tea')
                                                    ->default('0902')
                                                    ->helperText('Harmonized System Nomenclature for tea leaf preparations')
                                                    ->required(),
                                                TextInput::make('gstin_number')
                                                    ->label('Henley Botanicals GSTIN')
                                                    ->default('19AAACH7409R1ZZ')
                                                    ->helperText('15-digit alphanumeric state tax identification number')
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),

                        // Tab 6: SEO Defaults
                        Tab::make('SEO Defaults')
                            ->icon(Heroicon::OutlinedGlobeAlt)
                            ->schema([
                                Section::make('Global Meta Tags & Crawl Policies')
                                    ->description('Fallback tags when specific route overrides are absent.')
                                    ->schema([
                                        TextInput::make('default_meta_title')
                                            ->label('Default Meta Title')
                                            ->default('Henley — Pure Leaf. Pure Intent.')
                                            ->required(),
                                        Textarea::make('default_meta_description')
                                            ->label('Default Meta Description')
                                            ->rows(3)
                                            ->default('Rare single-origin tea flushes, botanical tisanes, and apothecary accessories.')
                                            ->required(),
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('default_og_image')
                                                    ->label('Default OG Social Image URL')
                                                    ->default('/images/brand/homepage.jpeg'),
                                                TextInput::make('google_analytics_id')
                                                    ->label('Google Analytics Measurement ID')
                                                    ->placeholder('G-XXXXXXXXXX'),
                                            ]),
                                    ]),
                            ]),

                        // Tab 7: System
                        Tab::make('System')
                            ->icon(Heroicon::OutlinedCpuChip)
                            ->schema([
                                Section::make('Runtime & Platform Health')
                                    ->description('Operational thresholds, auto-archival intervals, and cache layer.')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                Select::make('cache_driver')
                                                    ->label('Active Cache Driver')
                                                    ->options([
                                                        'redis' => 'Redis Memory Cluster',
                                                        'database' => 'PostgreSQL Database',
                                                        'file' => 'Local File Cache',
                                                    ])
                                                    ->default('redis')
                                                    ->required(),
                                                TextInput::make('inventory_low_stock_threshold')
                                                    ->label('Default Low Stock Threshold')
                                                    ->numeric()
                                                    ->default(15)
                                                    ->helperText('Triggers admin inventory alerts')
                                                    ->required(),
                                                TextInput::make('order_auto_archive_days')
                                                    ->label('Auto-Archive Delivered Orders (Days)')
                                                    ->numeric()
                                                    ->default(90)
                                                    ->required(),
                                            ]),
                                        Toggle::make('maintenance_mode')
                                            ->label('Storefront Maintenance Mode')
                                            ->helperText('When enabled, public storefront displays an unhurried cellar maintenance message.'),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            $group = match (true) {
                in_array($key, ['store_name', 'brand_tagline', 'store_description', 'contact_email', 'contact_phone', 'support_hours', 'currency_symbol', 'currency_code'], true) => 'general',
                in_array($key, ['gateway', 'razorpay_key_id', 'razorpay_key_secret', 'razorpay_webhook_secret', 'cod_enabled'], true) => 'payment',
                in_array($key, ['mail_provider', 'mail_from_name', 'mail_from_address', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password'], true) => 'email',
                in_array($key, ['shipping_origin_country', 'shipping_origin_city', 'free_shipping_threshold_paise', 'standard_shipping_rate_paise', 'express_shipping_rate_paise', 'international_shipping_enabled'], true) => 'shipping',
                in_array($key, ['tax_calculation_mode', 'default_gst_rate_percent', 'hsn_default_tea', 'gstin_number'], true) => 'tax',
                in_array($key, ['default_meta_title', 'default_meta_description', 'default_og_image', 'google_analytics_id'], true) => 'seo',
                in_array($key, ['cache_driver', 'inventory_low_stock_threshold', 'order_auto_archive_days', 'maintenance_mode'], true) => 'system',
                default => 'custom',
            };

            $type = match (true) {
                is_bool($value) => 'boolean',
                is_int($value) => 'integer',
                is_float($value) => 'float',
                default => 'string',
            };

            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'group' => $group,
                    'value' => is_bool($value) ? ($value ? '1' : '0') : (string) $value,
                    'type' => $type,
                ]
            );
        }

        Notification::make()
            ->title('Platform Settings Saved')
            ->body('All configurations and encrypted secret keys have been updated successfully.')
            ->success()
            ->send();
    }
}
