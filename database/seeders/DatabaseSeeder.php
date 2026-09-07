<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\AddressType;
use App\Enums\CouponType;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\ProductStatus;
use App\Enums\RefundStatus;
use App\Enums\ReviewStatus;
use App\Enums\ShipmentStatus;
use App\Enums\StockMovementReason;
use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\Address;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CmsPage;
use App\Models\Coupon;
use App\Models\CouponRedemption;
use App\Models\Customer;
use App\Models\HomepageSection;
use App\Models\Inventory;
use App\Models\JournalPost;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Refund;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Shipment;
use App\Models\StockMovement;
use App\Models\Taxonomy;
use App\Models\TaxonomyTerm;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('1. Seeding Roles & Permissions Matrix...');
        $this->seedRolesAndPermissions();

        $this->command->info('2. Seeding Vendors & Core Users...');
        $vendors = $this->seedVendors();
        $users = $this->seedUsersAndCustomers($vendors);

        $this->command->info('3. Seeding Taxonomies & Facet Terms...');
        $taxonomies = $this->seedTaxonomies();

        $this->command->info('4. Seeding Brand & Curated Collections...');
        $brand = $this->seedBrand();
        $categories = $this->seedCategories();

        $this->command->info('5. Seeding Henley 30-Product Catalogue with Variants, Attributes, Images & Inventory...');
        $products = $this->seedProducts($vendors, $brand, $categories, $taxonomies);

        $this->command->info('6. Seeding Product Reviews...');
        $this->seedReviews($products, $users['customers']);

        $this->command->info('7. Seeding Promotional Coupons...');
        $coupons = $this->seedCoupons();

        $this->command->info('8. Seeding 40 Orders with Payments, Shipments & Redemptions...');
        $this->seedOrders($users['customers'], $products, $coupons);

        $this->command->info('9. Seeding Editorial Content, CMS Pages, Homepage Sections & Banners...');
        $this->seedContent();

        $this->command->info('10. Seeding System Settings...');
        $this->seedSettings();

        $this->command->info('✓ Henley Database Seeding Complete!');
    }

    private function seedRolesAndPermissions(): void
    {
        $permissions = [
            // Panel Access
            'admin.access',
            'vendor.access',

            // Products & Catalog
            'products.view',
            'products.create',
            'products.update',
            'products.delete',
            'products.publish',
            'categories.manage',
            'brands.manage',
            'taxonomies.manage',

            // Inventory
            'inventory.view',
            'inventory.update',
            'inventory.adjust',

            // Orders & Shipments
            'orders.view',
            'orders.view-own',
            'orders.create',
            'orders.update-status',
            'orders.cancel',
            'shipments.view',
            'shipments.manage',

            // Payments & Refunds
            'payments.view',
            'refunds.process',

            // Promotions & Coupons
            'coupons.view',
            'coupons.manage',

            // Vendors
            'vendors.view',
            'vendors.manage',
            'vendors.approve',

            // Customers & Reviews
            'customers.view',
            'customers.manage',
            'profile.manage',
            'reviews.view',
            'reviews.create',
            'reviews.moderate',

            // Content & CMS
            'cms.manage',
            'journal.manage',
            'banners.manage',

            // Operations & Admin
            'reports.view',
            'analytics.view',
            'users.view',
            'users.manage',
            'roles.manage',
            'settings.view',
            'settings.manage',
            'wishlists.manage',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // 1. Super Admin Role
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdminRole->syncPermissions(Permission::all());
        $superAdminSnake = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdminSnake->syncPermissions(Permission::all());

        // 2. Admin Role
        $adminPermissions = [
            'admin.access',
            'products.view',
            'products.create',
            'products.update',
            'products.delete',
            'products.publish',
            'categories.manage',
            'brands.manage',
            'taxonomies.manage',
            'inventory.view',
            'inventory.update',
            'inventory.adjust',
            'orders.view',
            'orders.update-status',
            'orders.cancel',
            'shipments.view',
            'shipments.manage',
            'payments.view',
            'refunds.process',
            'coupons.view',
            'coupons.manage',
            'vendors.view',
            'vendors.approve',
            'customers.view',
            'reviews.view',
            'reviews.moderate',
            'cms.manage',
            'journal.manage',
            'banners.manage',
            'reports.view',
            'analytics.view',
            'settings.view',
        ];
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions($adminPermissions);
        $adminSnake = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminSnake->syncPermissions($adminPermissions);

        // 3. Vendor Role
        $vendorPermissions = [
            'vendor.access',
            'products.view',
            'products.create',
            'products.update',
            'products.delete',
            'inventory.view',
            'inventory.update',
            'orders.view',
            'orders.update-status',
            'shipments.view',
            'shipments.manage',
        ];
        $vendorRole = Role::firstOrCreate(['name' => 'Vendor', 'guard_name' => 'web']);
        $vendorRole->syncPermissions($vendorPermissions);
        $vendorSnake = Role::firstOrCreate(['name' => 'vendor', 'guard_name' => 'web']);
        $vendorSnake->syncPermissions($vendorPermissions);

        // 4. Customer Role
        $customerPermissions = [
            'profile.manage',
            'orders.view-own',
            'reviews.create',
            'wishlists.manage',
        ];
        $customerRole = Role::firstOrCreate(['name' => 'Customer', 'guard_name' => 'web']);
        $customerRole->syncPermissions($customerPermissions);
        $customerSnake = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);
        $customerSnake->syncPermissions($customerPermissions);

        // Assign Customer role to all existing customers
        User::where('role', UserRole::CUSTOMER)->orWhereDoesntHave('roles')->get()->each(function (User $u): void {
            $u->assignRole(['Customer', 'customer']);
        });
    }

    /**
     * @return array<string, Vendor>
     */
    private function seedVendors(): array
    {
        $vendorData = [
            'darjeeling' => [
                'business_name' => 'Darjeeling Himalayan Tea Estate',
                'legal_name' => 'Darjeeling Himalayan Tea Estate Pvt Ltd',
                'slug' => 'darjeeling-himalayan-tea-estate',
                'gstin' => '19AAACD1234F1Z5',
                'email' => 'estates@henleytea.com',
                'phone' => '+919830112233',
                'address' => [
                    'line_1' => 'Castleton Valley, Kurseong Division',
                    'city' => 'Darjeeling',
                    'state' => 'West Bengal',
                    'pincode' => '734203',
                    'country' => 'IN',
                ],
                'commission_rate' => 15.00,
                'status' => VendorStatus::APPROVED,
                'approved_at' => now()->subMonths(12),
                'bank_details' => [
                    'bank_name' => 'HDFC Bank',
                    'account_number' => '50100492817261',
                    'ifsc_code' => 'HDFC0000160',
                    'account_holder_name' => 'Darjeeling Himalayan Tea Estate Pvt Ltd',
                ],
                'notes' => 'Certified organic bio-dynamic garden at 1,800m altitude. Sole producer of our First Flush Silver Needle.',
            ],
            'kerala' => [
                'business_name' => 'Kerala Spicery & High-Grown Botanicals',
                'legal_name' => 'Malabar Botanical Cultivators LLP',
                'slug' => 'kerala-spicery-botanicals',
                'gstin' => '32AABCM5678K1Z2',
                'email' => 'kerala.spices@henleytea.com',
                'phone' => '+919447118899',
                'address' => [
                    'line_1' => 'Periyar Highland Valley, Thekkady Road',
                    'city' => 'Kumily',
                    'state' => 'Kerala',
                    'pincode' => '685509',
                    'country' => 'IN',
                ],
                'commission_rate' => 12.50,
                'status' => VendorStatus::APPROVED,
                'approved_at' => now()->subMonths(8),
                'bank_details' => [
                    'bank_name' => 'ICICI Bank',
                    'account_number' => '004705008912',
                    'ifsc_code' => 'ICIC0000047',
                    'account_holder_name' => 'Malabar Botanical Cultivators LLP',
                ],
                'notes' => 'Specializes in high-curcumin Alleppey turmeric, Tellicherry black peppercorns, and organic cardamom pods.',
            ],
            'nilgiri' => [
                'business_name' => 'Nilgiri Blue Mountain Herb Reserve',
                'legal_name' => 'Nilgiri Mountain Herbals Private Limited',
                'slug' => 'nilgiri-blue-mountain-reserve',
                'gstin' => '33AAACN9012L1Z9',
                'email' => 'nilgiri@henleytea.com',
                'phone' => '+919488223344',
                'address' => [
                    'line_1' => 'Glendale Division, Kotagiri Hills',
                    'city' => 'Coonoor',
                    'state' => 'Tamil Nadu',
                    'pincode' => '643101',
                    'country' => 'IN',
                ],
                'commission_rate' => 15.00,
                'status' => VendorStatus::APPROVED,
                'approved_at' => now()->subMonths(6),
                'bank_details' => [
                    'bank_name' => 'Axis Bank',
                    'account_number' => '916020048192837',
                    'ifsc_code' => 'UTIB0000120',
                    'account_holder_name' => 'Nilgiri Mountain Herbals Private Limited',
                ],
                'notes' => 'High-elevation frost teas and indigenous restorative botanicals (Ashwagandha, Lemongrass, Spearmint).',
            ],
        ];

        $vendors = [];
        foreach ($vendorData as $key => $data) {
            $vendors[$key] = Vendor::create($data);
        }

        return $vendors;
    }

    /**
     * @param  array<string, Vendor>  $vendors
     * @return array{super_admin: User, admin: User, vendors: list<User>, customers: list<User>}
     */
    private function seedUsersAndCustomers(array $vendors): array
    {
        // 1. Super Admin
        $superAdmin = User::create([
            'name' => 'Alistair Henley',
            'email' => 'admin@henleytea.com',
            'phone' => '+919820011223',
            'password' => Hash::make('password'),
            'role' => UserRole::SUPER_ADMIN,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole(['Super Admin', 'super_admin']);

        // Explicit testing Super Admin account (admin@henley.com)
        $superAdminTest = User::create([
            'name' => 'Henley Super Admin',
            'email' => 'admin@henley.com',
            'phone' => '+919820011999',
            'password' => Hash::make('password'),
            'role' => UserRole::SUPER_ADMIN,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $superAdminTest->assignRole(['Super Admin', 'super_admin']);

        // 2. Admin / Curator
        $admin = User::create([
            'name' => 'Evelyn Vance',
            'email' => 'curator@henleytea.com',
            'phone' => '+919820044556',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $admin->assignRole(['Admin', 'admin']);

        // 3. Vendor Accounts
        $vendorUsers = [];
        $vendorLogins = [
            'darjeeling' => ['name' => 'Tenzing Norbu', 'email' => 'estates@henleytea.com'],
            'kerala' => ['name' => 'Mathew Varghese', 'email' => 'kerala.spices@henleytea.com'],
            'nilgiri' => ['name' => 'Sundaram Pillai', 'email' => 'nilgiri@henleytea.com'],
        ];

        $vIdx = 1;
        foreach ($vendorLogins as $key => $creds) {
            $vUser = User::create([
                'name' => $creds['name'],
                'email' => $creds['email'],
                'phone' => '+91982009988'.$vIdx++,
                'password' => Hash::make('password'),
                'role' => UserRole::VENDOR,
                'vendor_id' => $vendors[$key]->id,
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $vUser->assignRole(['Vendor', 'vendor']);
            $vendorUsers[] = $vUser;
        }

        // Explicit sample testing Vendor user (vendor@henley.com)
        $sampleVendor = User::create([
            'name' => 'Sample Estate Vendor',
            'email' => 'vendor@henley.com',
            'phone' => '+919820099900',
            'password' => Hash::make('password'),
            'role' => UserRole::VENDOR,
            'vendor_id' => $vendors['darjeeling']->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $sampleVendor->assignRole(['Vendor', 'vendor']);
        $vendorUsers[] = $sampleVendor;

        // Explicit sample testing Vendor 2 user (vendor2@henley.com)
        $sampleVendor2 = User::create([
            'name' => 'Sample Kerala Spice Vendor',
            'email' => 'vendor2@henley.com',
            'phone' => '+919820099901',
            'password' => Hash::make('password'),
            'role' => UserRole::VENDOR,
            'vendor_id' => $vendors['kerala']->id,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $sampleVendor2->assignRole(['Vendor', 'vendor']);
        $vendorUsers[] = $sampleVendor2;

        // 4. Seed 12 Customers
        $customerList = [
            ['name' => 'Ananya Singhal', 'email' => 'collector@henleytea.com', 'city' => 'Mumbai', 'state' => 'Maharashtra', 'pincode' => '400050', 'line1' => 'B-402, Pali Hill Reserve, Bandra West'],
            ['name' => 'Rohan Mehra', 'email' => 'rohan.mehra@gmail.com', 'city' => 'Bengaluru', 'state' => 'Karnataka', 'pincode' => '560034', 'line1' => '12/4, 7th Main, Koramangala 3rd Block'],
            ['name' => 'Devika Sen', 'email' => 'devika.sen@outlook.com', 'city' => 'Kolkata', 'state' => 'West Bengal', 'pincode' => '700019', 'line1' => '8A, Ballygunge Circular Road'],
            ['name' => 'Arjun Kapoor', 'email' => 'arjun.kapoor@yahoo.co.in', 'city' => 'New Delhi', 'state' => 'Delhi', 'pincode' => '110003', 'line1' => '42, Golf Links Enclave'],
            ['name' => 'Priya Nair', 'email' => 'priya.nair@icloud.com', 'city' => 'Chennai', 'state' => 'Tamil Nadu', 'pincode' => '600028', 'line1' => '18, Boat Club Road, RA Puram'],
            ['name' => 'Vikramaditya Roy', 'email' => 'vikram.roy@gmail.com', 'city' => 'Pune', 'state' => 'Maharashtra', 'pincode' => '411001', 'line1' => 'Penthouse 3, Koregaon Park North'],
            ['name' => 'Zoya Akhtar', 'email' => 'zoya.akhtar@gmail.com', 'city' => 'Hyderabad', 'state' => 'Telangana', 'pincode' => '500034', 'line1' => 'Road No. 12, Banjara Hills'],
            ['name' => 'Kabir Merchant', 'email' => 'kabir.m@gmail.com', 'city' => 'Mumbai', 'state' => 'Maharashtra', 'pincode' => '400026', 'line1' => 'Villa 7, Carmichael Road'],
            ['name' => 'Tara Deshmukh', 'email' => 'tara.d@gmail.com', 'city' => 'Bengaluru', 'state' => 'Karnataka', 'pincode' => '560001', 'line1' => '504, Lavelle Road Residencies'],
            ['name' => 'Aditya Vardhan', 'email' => 'aditya.v@gmail.com', 'city' => 'Jaipur', 'state' => 'Rajasthan', 'pincode' => '302001', 'line1' => '14, Civil Lines Avenue'],
            ['name' => 'Meera Krishnamurthy', 'email' => 'meera.k@gmail.com', 'city' => 'Coimbatore', 'state' => 'Tamil Nadu', 'pincode' => '641018', 'line1' => '22, Race Course Road'],
            ['name' => 'Siddharth Bose', 'email' => 'sid.bose@gmail.com', 'city' => 'Chandigarh', 'state' => 'Punjab', 'pincode' => '160009', 'line1' => 'House 512, Sector 9-B'],
        ];

        $customerUsers = [];
        foreach ($customerList as $cIdx => $cust) {
            $user = User::create([
                'name' => $cust['name'],
                'email' => $cust['email'],
                'phone' => '+9198111000'.str_pad((string) ($cIdx + 1), 2, '0', STR_PAD_LEFT),
                'password' => Hash::make('password'),
                'role' => UserRole::CUSTOMER,
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole(['Customer', 'customer']);

            $customerProfile = Customer::create([
                'user_id' => $user->id,
                'date_of_birth' => '1992-04-18',
                'gender' => 'female',
                'preferences' => [
                    'infusion_time' => 'Evening Ritual',
                    'caffeine_tolerance' => 'Low',
                    'favorite_flavour' => 'Floral & Lavender',
                ],
                'notes' => 'Connoisseur collector; prefers porcelain cloche jars.',
            ]);

            Address::create([
                'user_id' => $user->id,
                'customer_id' => $customerProfile->id,
                'recipient_name' => $cust['name'],
                'phone' => $user->phone ?? '+919820012345',
                'line_1' => $cust['line1'],
                'line_2' => 'Opposite Botanical Gardens',
                'landmark' => 'Near Heritage Sanctuary',
                'city' => $cust['city'],
                'state' => $cust['state'],
                'pincode' => $cust['pincode'],
                'country' => 'IN',
                'type' => AddressType::HOME,
                'is_default_shipping' => true,
                'is_default_billing' => true,
                'latitude' => 19.0760,
                'longitude' => 72.8777,
            ]);

            Wishlist::create(['user_id' => $user->id]);

            $customerUsers[] = $user;
        }

        return [
            'super_admin' => $superAdmin,
            'admin' => $admin,
            'vendors' => $vendorUsers,
            'customers' => $customerUsers,
        ];
    }

    /**
     * @return array<string, array<string, TaxonomyTerm>>
     */
    private function seedTaxonomies(): array
    {
        $benefitTax = Taxonomy::create(['name' => 'Botanical Benefit', 'slug' => 'benefit', 'sort_order' => 1]);
        $typeTax = Taxonomy::create(['name' => 'Tea & Botanical Type', 'slug' => 'type', 'sort_order' => 2]);
        $caffeineTax = Taxonomy::create(['name' => 'Caffeine Profile', 'slug' => 'caffeine', 'sort_order' => 3]);

        $benefits = [
            'sleep' => 'Restorative Sleep',
            'immunity' => 'Immunity & Vitality',
            'energy' => 'Morning Energy',
            'relaxation' => 'Calm & Relaxation',
            'focus' => 'Mental Focus',
            'detox' => 'Digestive Detox',
        ];

        $types = [
            'green' => 'Single-Estate Green Tea',
            'herbal' => 'Wild Herbal Tisane',
            'black' => 'Orthodox Black Tea',
            'white' => 'Rare White Tea',
            'spice' => 'Artisanal Whole Spice',
        ];

        $caffeine = [
            'free' => '100% Caffeine Free',
            'low' => 'Low Caffeine',
            'medium' => 'Medium Elevation',
            'high' => 'High Antioxidant Lift',
        ];

        $terms = [];
        foreach ($benefits as $s => $n) {
            $terms['benefit'][$s] = TaxonomyTerm::create(['taxonomy_id' => $benefitTax->id, 'name' => $n, 'slug' => $s]);
        }
        foreach ($types as $s => $n) {
            $terms['type'][$s] = TaxonomyTerm::create(['taxonomy_id' => $typeTax->id, 'name' => $n, 'slug' => $s]);
        }
        foreach ($caffeine as $s => $n) {
            $terms['caffeine'][$s] = TaxonomyTerm::create(['taxonomy_id' => $caffeineTax->id, 'name' => $n, 'slug' => $s]);
        }

        return $terms;
    }

    private function seedBrand(): Brand
    {
        return Brand::create([
            'name' => 'Henley Botanical Reserve',
            'slug' => 'henley-reserve',
            'logo_path' => 'brand/logo.png',
            'description' => 'Single-origin high-altitude whole leaves, wild infusions and rare spices curated as daily sensory rituals.',
            'website_url' => 'https://henleytea.com',
            'is_featured' => true,
            'seo_title' => 'Henley Reserve — Pure Leaf. Pure Intent.',
            'seo_description' => 'Luxury direct-to-consumer tea, botanical infusions, and single-origin whole spices.',
        ]);
    }

    /**
     * @return array<string, Category>
     */
    private function seedCategories(): array
    {
        $collections = [
            'tea' => [
                'name' => 'Tea',
                'description' => 'Single-estate Himalayan orthodox teas and ancestral herbal infusions sealed in bone-white cloches.',
                'image_path' => '/pimages/tea.jpg',
                'is_featured' => true,
            ],
            'herbs-spices' => [
                'name' => 'Herbs & Spices',
                'description' => 'Rare single-origin whole spices, hand-harvested botanicals, and sun-dried culinary aromatics.',
                'image_path' => '/pimages/cardamom.jpg',
                'is_featured' => true,
            ],
            'flours-grains' => [
                'name' => 'Flours & Grains',
                'description' => 'Slow-milled ancient stoneground flours, unbleached heirloom wheat, and pure pulse flours.',
                'image_path' => '/pimages/besan.jpg',
                'is_featured' => true,
            ],
            'cooking-essentials' => [
                'name' => 'Cooking Essentials',
                'description' => 'Unrefined mineral-rich sugars and naturally extracted heirloom starches for intentional cooking.',
                'image_path' => '/pimages/sugarjpg.jpg',
                'is_featured' => true,
            ],
            'cocoa' => [
                'name' => 'Cocoa',
                'description' => 'Single-estate pure Dutch cocoa powder cold-pressed from heirloom Criollo cacao beans.',
                'image_path' => '/pimages/cocoa.jpg',
                'is_featured' => true,
            ],
            'restorative-sleep' => [
                'name' => 'Restorative Sleep',
                'description' => 'Evening tisanes blending wild chamomile, Kashmiri lavender, and adaptogenic ashwagandha.',
                'image_path' => '/pimages/6.jpg',
                'is_featured' => false,
            ],
            'morning-clarity' => [
                'name' => 'Morning Clarity',
                'description' => 'High-elevation green teas and mountain lemongrass crafted for gentle, sustained awakening.',
                'image_path' => '/pimages/tea.jpg',
                'is_featured' => false,
            ],
            'heritage-black' => [
                'name' => 'Heritage Black',
                'description' => 'Single-estate Darjeeling first-flush and malted Assam orthodox whole leaves.',
                'image_path' => '/pimages/tea.jpg',
                'is_featured' => false,
            ],
            'luxury-wellness' => [
                'name' => 'Luxury Wellness Infusions',
                'description' => 'Ayurvedic master-blends featuring royal Kashmiri saffron, holy basil, and licorice root.',
                'image_path' => '/pimages/saffron.jpg',
                'is_featured' => false,
            ],
            'artisanal-spices' => [
                'name' => 'Artisanal Whole Spices',
                'description' => 'High-curcumin Alleppey turmeric, royal green cardamom, and Tellicherry peppercorns.',
                'image_path' => '/pimages/cardamom.jpg',
                'is_featured' => false,
            ],
            'single-origin-reserve' => [
                'name' => 'Single-Origin Reserve',
                'description' => 'Rare, numbered micro-lot flushes harvested from distinct elevation plots above 1,800 metres.',
                'image_path' => '/pimages/saffron.jpg',
                'is_featured' => false,
            ],
            'curated-gift-sets' => [
                'name' => 'Curated Gift Sets',
                'description' => 'Bone-white porcelain cloche sets packaged with hand-carved brass measuring spoons.',
                'image_path' => '/pimages/2.jpg',
                'is_featured' => false,
            ],
        ];

        $categories = [];
        $order = 1;
        foreach ($collections as $slug => $data) {
            $categories[$slug] = Category::create([
                'name' => $data['name'],
                'slug' => $slug,
                'description' => $data['description'],
                'sort_order' => $order++,
                'is_featured' => $data['is_featured'] ?? true,
                'image_path' => $data['image_path'],
                'seo_title' => "{$data['name']} — Henley Luxury Tea",
                'seo_description' => $data['description'],
            ]);
        }

        return $categories;
    }

    /**
     * @param  array<string, Vendor>  $vendors
     * @param  array<string, Category>  $categories
     * @param  array<string, array<string, TaxonomyTerm>>  $taxonomies
     * @return list<Product>
     */
    private function seedProducts(array $vendors, Brand $brand, array $categories, array $taxonomies): array
    {
        $catalog = [
            [
                'name' => 'Saffron',
                'slug' => 'spice-saffron',
                'category' => 'herbs-spices',
                'vendor' => 'darjeeling',
                'price' => 2499.00,
                'compare_at' => 2999.00,
                'image' => '/pimages/saffron.jpg',
                'rating' => 5.0,
                'reviews' => 310,
                'bestseller' => true,
                'featured' => true,
                'short' => 'Grade A1 Super Negin Kashmiri Mogra Saffron Filaments.',
                'desc' => "The crown jewel of botanicals. Deep crimson stigmas hand-culled from purple crocus flowers in Pampore, Kashmir. Rich in crocin and safranal.\n\nA single filament transforms pure mountain spring water into luminous royal liquid gold.",
                'ingredients' => '100% Pure Grade A1 Kashmiri Mogra Saffron (Crocus sativus).',
                'guide' => "Water: 85°C\nThreads: 3-4 filaments\nInfusion: 8 mins\nBest enjoyed quietly.",
                'benefit' => 'sleep',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Herb & Spice Tea',
                'slug' => 'tea-herb-spice',
                'category' => 'tea',
                'vendor' => 'darjeeling',
                'price' => 1299.00,
                'compare_at' => 1499.00,
                'image' => '/pimages/tea.jpg',
                'rating' => 5.0,
                'reviews' => 164,
                'bestseller' => true,
                'featured' => true,
                'short' => 'Sacred Himalayan Botanical & Whole Warming Spice Infusion.',
                'desc' => "An ancient restorative tisane blending mountain holy basil (tulsi), crushed green cardamom pods, cassia bark, and dried wild ginger roots.\n\nFormulated to invigorate the spirit and restore biological equilibrium.",
                'ingredients' => 'Holy Basil (Tulsi), Green Cardamom, Cassia Bark, Wild Ginger, Clove Buds.',
                'guide' => "Water: 95°C\nLeaf: 2.5g\nSteep: 5 mins\nEnjoy warm.",
                'benefit' => 'immunity',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Cardamom',
                'slug' => 'spice-cardamom',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 1499.00,
                'compare_at' => 1799.00,
                'image' => '/pimages/cardamom.jpg',
                'rating' => 5.0,
                'reviews' => 198,
                'bestseller' => false,
                'featured' => true,
                'short' => 'High-Elevation Idukki Jumbo Green Cardamom Pods.',
                'desc' => '8mm+ emerald pods plucked from misty Kerala hillsides. Retains resinous, sweet floral essential oils that release instantly upon crushing.',
                'ingredients' => '100% Hand-Harvested Jumbo Green Cardamom (Elettaria cardamomum).',
                'guide' => 'Crush lightly before steeping into tea, milk infusions, or artisanal confections.',
                'benefit' => 'relaxation',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Cocoa',
                'slug' => 'cocoa-pure',
                'category' => 'cocoa',
                'vendor' => 'darjeeling',
                'price' => 1299.00,
                'compare_at' => 1499.00,
                'image' => '/pimages/cocoa.jpg',
                'rating' => 5.0,
                'reviews' => 188,
                'bestseller' => false,
                'featured' => true,
                'short' => 'Single-Estate 100% Pure Dutch Cocoa Powder.',
                'desc' => 'Cold-pressed from shade-grown heirloom Criollo cacao beans. Deep mahogany hue with velvety bittersweet nuance.',
                'ingredients' => '100% Organic Dutch-Processed Heirloom Criollo Cocoa (Theobroma cacao).',
                'guide' => "Whisk 1 tablespoon into 200ml warm oat milk or steaming spring water.\nSweeten to taste.",
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'low',
            ],
            [
                'name' => 'Pure & Natural Tea',
                'slug' => 'tea-pure-natural',
                'category' => 'tea',
                'vendor' => 'darjeeling',
                'price' => 1699.00,
                'compare_at' => null,
                'image' => '/pimages/6.jpg',
                'rating' => 5.0,
                'reviews' => 128,
                'bestseller' => false,
                'featured' => true,
                'short' => 'High-Altitude Single-Estate Orthodox Whole Leaf Green Tea.',
                'desc' => 'Hand-plucked first flush leaves from mist-shrouded Himalayan gardens. Steamed in small brass pans to preserve delicate sweet floral notes.',
                'ingredients' => '100% Single-Estate Spring Green Tea (Camellia sinensis).',
                'guide' => "Water: 80°C\nLeaf: 2g\nSteep: 2.5 mins\nRe-steep up to 3 times.",
                'benefit' => 'focus',
                'type' => 'green',
                'caffeine' => 'low',
            ],
            [
                'name' => 'Cinnamon',
                'slug' => 'spice-cinnamon',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 999.00,
                'compare_at' => 1199.00,
                'image' => '/pimages/cinnamon.jpg',
                'rating' => 5.0,
                'reviews' => 167,
                'bestseller' => false,
                'featured' => true,
                'short' => 'Pure Ceylon Alba Grade Thin-Quill Cinnamon Sticks.',
                'desc' => 'True Ceylon cinnamon quills hand-rolled from ultra-thin inner bark layers. Naturally low coumarin with delicate woody sweet aroma.',
                'ingredients' => '100% Pure Ceylon Alba Grade Cinnamon (Cinnamomum verum).',
                'guide' => 'Snap 1 quill into hot brew or slow-simmered herbal decoctions.',
                'benefit' => 'immunity',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Black Pepper',
                'slug' => 'spice-black-pepper',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 899.00,
                'compare_at' => 1099.00,
                'image' => '/pimages/blackoeooer.jpg',
                'rating' => 5.0,
                'reviews' => 142,
                'bestseller' => true,
                'featured' => false,
                'short' => 'Tellicherry Extra Bold Whole Peppercorns.',
                'desc' => 'Vine-ripened in the dense canopy of Wayanad, Kerala. Unusually large 4.25mm berries bursting with pungent piperine and citrus nuance.',
                'ingredients' => '100% Sun-Dried Tellicherry Garbled Extra Bold Peppercorns (Piper nigrum).',
                'guide' => 'Grind freshly over culinary preparations or crush into warming tisanes.',
                'benefit' => 'detox',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Besan',
                'slug' => 'grain-besan',
                'category' => 'flours-grains',
                'vendor' => 'nilgiri',
                'price' => 599.00,
                'compare_at' => null,
                'image' => '/pimages/besan.jpg',
                'rating' => 5.0,
                'reviews' => 112,
                'bestseller' => true,
                'featured' => false,
                'short' => 'Artisanal Chana Dal Slow-Ground Chickpea Flour.',
                'desc' => 'Naturally gluten-free pulse flour with a sweet nutty aroma. Milled from sun-dried desi brown chickpeas on slow stone mills.',
                'ingredients' => '100% Cold-Milled Desi Bengal Gram (Cicer arietinum).',
                'guide' => 'Ideal for savory culinary batters, artisanal flatbreads, and traditional confections.',
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Coriander',
                'slug' => 'spice-coriander',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 499.00,
                'compare_at' => null,
                'image' => '/pimages/coriander.jpg',
                'rating' => 4.5,
                'reviews' => 89,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Sun-Dried Malabar Whole Golden Coriander Seeds.',
                'desc' => 'Harvested at peak morning aroma. Citrusy, sweet, and lightly toasted on low-heat stone hearths before airtight sealing.',
                'ingredients' => '100% Whole Sun-Dried Coriander Seeds (Coriandrum sativum).',
                'guide' => 'Bruise seeds lightly to release essential linalool aromatics.',
                'benefit' => 'detox',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Red Chilli',
                'slug' => 'spice-red-chilli',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 599.00,
                'compare_at' => null,
                'image' => '/pimages/redchilli.jpg',
                'rating' => 5.0,
                'reviews' => 145,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Sun-Cured Guntur Whole Dried Crimson Chillies.',
                'desc' => 'Vibrant crimson pods grown without synthetic pesticides. Slow dried under southern sun for robust warmth and complex smoky sweetness.',
                'ingredients' => '100% Sun-Dried Crimson Chilli Pods (Capsicum annuum).',
                'guide' => 'Temper in warm cold-pressed oil for rich botanical aromatics.',
                'benefit' => 'energy',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Turmeric',
                'slug' => 'spice-turmeric',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 799.00,
                'compare_at' => 999.00,
                'image' => '/pimages/turmeric.jpg',
                'rating' => 5.0,
                'reviews' => 240,
                'bestseller' => true,
                'featured' => false,
                'short' => 'High-Curcumin Pure Lakadong Heritage Turmeric Root.',
                'desc' => 'Grown in the mineral-dense soils of Jaintia Hills, Meghalaya. Contains up to 9% natural curcumin for unmatched bioactive vitality.',
                'ingredients' => '100% High-Curcumin Lakadong Turmeric Rhizome (Curcuma longa).',
                'guide' => 'Brew 1/2 teaspoon into golden milk with crushed black pepper and honey.',
                'benefit' => 'immunity',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Cumin',
                'slug' => 'spice-cumin',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 549.00,
                'compare_at' => null,
                'image' => '/pimages/cumin.jpg',
                'rating' => 4.5,
                'reviews' => 96,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Hand-Harvested Whole Rajasthani Cumin Seeds.',
                'desc' => 'Intensely earthy and warm aromatic seeds hand-sifted to eliminate chaff and sealed in UV-blocking glass.',
                'ingredients' => '100% Whole Rajasthani Cumin Seeds (Cuminum cyminum).',
                'guide' => 'Toast gently on a cast-iron skillet to unlock nutty cumin aldehyde.',
                'benefit' => 'detox',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Cloves',
                'slug' => 'spice-cloves',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 849.00,
                'compare_at' => null,
                'image' => '/pimages/18.jpg',
                'rating' => 4.5,
                'reviews' => 78,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Handpicked Zanzibar-Lineage Whole Head Cloves.',
                'desc' => 'Unopened flower buds rich in natural eugenol oil. Clean, spicy-sweet profile with intense numbing warmth.',
                'ingredients' => '100% Whole Head Clove Buds (Syzygium aromaticum).',
                'guide' => 'Infuse into spiced chai, winter mulled tisanes, or restorative broths.',
                'benefit' => 'immunity',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Fennel',
                'slug' => 'spice-fennel',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 499.00,
                'compare_at' => null,
                'image' => '/pimages/fennel.jpg',
                'rating' => 4.5,
                'reviews' => 64,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Sweet Lucknow Tiny Green Whole Fennel Seeds.',
                'desc' => 'Naturally sweet and cooling aniseed aromatics harvested in early spring. Ideal for post-meal digestive infusions.',
                'ingredients' => '100% Whole Green Lucknow Fennel Seeds (Foeniculum vulgare).',
                'guide' => 'Chew 1/2 teaspoon after meals or steep in hot spring water for 5 minutes.',
                'benefit' => 'relaxation',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Star Anise',
                'slug' => 'spice-star-anise',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 699.00,
                'compare_at' => null,
                'image' => '/pimages/staranise.jpg',
                'rating' => 4.5,
                'reviews' => 52,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Wild-Harvested Whole Eight-Point Star Anise.',
                'desc' => 'Intact symmetrical stars sourced from native mountain evergreen trees. Liquorice notes essential for slow broths and spiced teas.',
                'ingredients' => '100% Whole Eight-Point Star Anise (Illicium verum).',
                'guide' => 'Float 1 star in steaming herbal tea or simmering reductions.',
                'benefit' => 'immunity',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Fenugreek',
                'slug' => 'spice-fenugreek',
                'category' => 'herbs-spices',
                'vendor' => 'kerala',
                'price' => 399.00,
                'compare_at' => null,
                'image' => '/pimages/fnugreek.jpg',
                'rating' => 4.5,
                'reviews' => 43,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Golden Whole Methi Seeds with Maple Nuances.',
                'desc' => 'Nutritious golden angular seeds prized for centuries in Ayurvedic preparations for digestive equilibrium.',
                'ingredients' => '100% Whole Golden Fenugreek Seeds (Trigonella foenum-graecum).',
                'guide' => 'Soak overnight in cool water or lightly crush into herbal blends.',
                'benefit' => 'detox',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Wheat',
                'slug' => 'grain-wheat',
                'category' => 'flours-grains',
                'vendor' => 'nilgiri',
                'price' => 699.00,
                'compare_at' => null,
                'image' => '/pimages/wheat.jpg',
                'rating' => 4.5,
                'reviews' => 88,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Single-Variety 100% Whole Sharbati Wheat Flour.',
                'desc' => 'Unbleached, whole-kernel grain milled on natural emery stones at low RPM to keep the nutrient-dense wheatgerm alive.',
                'ingredients' => '100% Whole Sharbati Wheat (Triticum aestivum).',
                'guide' => 'Mix with lukewarm water and rest dough for 30 minutes before baking.',
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Maida',
                'slug' => 'grain-maida',
                'category' => 'flours-grains',
                'vendor' => 'nilgiri',
                'price' => 499.00,
                'compare_at' => null,
                'image' => '/pimages/maida.jpg',
                'rating' => 4.5,
                'reviews' => 65,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Unbleached Fine Heirloom Wheat Pastry Flour.',
                'desc' => 'Traditional unbleached fine flour free of chemical ripening agents, benzoyl peroxide, or synthetic additives.',
                'ingredients' => '100% Unbleached Fine Heirloom Wheat Flour.',
                'guide' => 'Perfect for delicate French pastries and flaky laminated breads.',
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Corn',
                'slug' => 'grain-corn',
                'category' => 'flours-grains',
                'vendor' => 'nilgiri',
                'price' => 549.00,
                'compare_at' => null,
                'image' => '/pimages/corn.jpg',
                'rating' => 4.5,
                'reviews' => 49,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Non-GMO Stoneground Pure Yellow Maize Flour.',
                'desc' => 'Sun-ripened open-pollinated yellow heirloom maize slowly pulverized on cold water-driven mill stones.',
                'ingredients' => '100% Non-GMO Yellow Maize (Zea mays).',
                'guide' => 'Knead with hot water for authentic golden flatbreads.',
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Sugar',
                'slug' => 'ess-sugar',
                'category' => 'cooking-essentials',
                'vendor' => 'nilgiri',
                'price' => 599.00,
                'compare_at' => 699.00,
                'image' => '/pimages/sugarjpg.jpg',
                'rating' => 5.0,
                'reviews' => 132,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Unrefined Native Cane Khandsari Crystal Sugar.',
                'desc' => 'Pressed from organic mountain sugarcane juice without sulfur clarification. Golden crystals rich in molasses minerals.',
                'ingredients' => '100% Unrefined Cane Sugar Crystals (Saccharum officinarum).',
                'guide' => 'Stir 1 teaspoon into tea or coffees for rich caramel sweetness.',
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Sago',
                'slug' => 'ess-sago',
                'category' => 'cooking-essentials',
                'vendor' => 'nilgiri',
                'price' => 449.00,
                'compare_at' => null,
                'image' => '/pimages/sago.jpg',
                'rating' => 4.5,
                'reviews' => 57,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Wild Tapioca Root Translucent Pearls.',
                'desc' => 'Tender, translucent pearls processed from premium cassava roots for comforting light puddings and savory dishes.',
                'ingredients' => '100% Native Cassava Starch Pearls (Manihot esculenta).',
                'guide' => 'Rinse gently and soak for 3 hours before cooking until translucent.',
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Tapioca',
                'slug' => 'ess-tapioca',
                'category' => 'cooking-essentials',
                'vendor' => 'nilgiri',
                'price' => 499.00,
                'compare_at' => null,
                'image' => '/pimages/2.jpg',
                'rating' => 4.5,
                'reviews' => 41,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Artisanal Fine Native Cassava Starch.',
                'desc' => 'Ultra-fine gluten-free thickening starch washed in mountain spring water and naturally sun-dried.',
                'ingredients' => '100% Pure Fine Cassava Starch.',
                'guide' => 'Dissolve in cool liquid before stirring into simmering broths or fruit sauces.',
                'benefit' => 'energy',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Restorative Sleep Nighttime Infusion',
                'slug' => 'restorative-sleep-nighttime-infusion',
                'category' => 'restorative-sleep',
                'vendor' => 'nilgiri',
                'price' => 1450.00,
                'compare_at' => null,
                'image' => '/pimages/6.jpg',
                'rating' => 5.0,
                'reviews' => 48,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Organic Himalayan chamomile blossoms, lavender buds, and adaptogenic root in our bone-white cloche.',
                'desc' => "Formulated to quiet the mind before sleep. Whole chamomile heads harvested at twilight are paired with French lavender buds and wild valerian root.\n\nThe aroma releases soft notes of sweet apple, fresh herbs, and soothing floral honey.",
                'ingredients' => 'Wild Himalayan Chamomile (Matricaria chamomilla), Organic Kashmiri Lavender, Ashwagandha Root, Lemon Balm, Spearmint.',
                'guide' => "Water: 95°C\nLeaf: 2.5g (1 cloche scoop)\nSteep: 5-6 mins\nBest enjoyed 30 minutes before rest.",
                'benefit' => 'sleep',
                'type' => 'herbal',
                'caffeine' => 'free',
            ],
            [
                'name' => 'First Flush Darjeeling Castleton Estate',
                'slug' => 'first-flush-darjeeling-castleton-estate',
                'category' => 'heritage-black',
                'vendor' => 'darjeeling',
                'price' => 2400.00,
                'compare_at' => null,
                'image' => '/pimages/tea.jpg',
                'rating' => 5.0,
                'reviews' => 56,
                'bestseller' => false,
                'featured' => false,
                'short' => 'The Champagne of teas. Plucked in mid-March from the historic Castleton garden at 1,800m.',
                'desc' => 'Intensely aromatic with unmistakable notes of muscatel grape, spring peach blossom, and fresh mountain meadow. Liquor is radiant amber with brisk astringency.',
                'ingredients' => '100% Single-Estate Orthodox Whole Leaf First Flush Darjeeling (FTGFOP1).',
                'guide' => "Water: 85°C\nLeaf: 2.5g\nSteep: 3 mins\nDo not add milk.",
                'benefit' => 'energy',
                'type' => 'black',
                'caffeine' => 'medium',
            ],
            [
                'name' => 'Morning Clarity Lemongrass Green Tea',
                'slug' => 'morning-clarity-lemongrass-green-tea',
                'category' => 'morning-clarity',
                'vendor' => 'darjeeling',
                'price' => 1250.00,
                'compare_at' => null,
                'image' => '/pimages/tea.jpg',
                'rating' => 5.0,
                'reviews' => 44,
                'bestseller' => false,
                'featured' => false,
                'short' => 'High-grown pan-fired green tea leaves with freshly cut Nilgiri mountain lemongrass and ginger root.',
                'desc' => 'A brisk, bright morning cup designed for focus and vitality without the jitters. Delicate pan-fired leaves are hand-blended with sun-dried lemongrass.',
                'ingredients' => 'Organic Green Tea (Camellia sinensis), Highland Lemongrass, Crushed Ginger Root, Lemon Myrtle.',
                'guide' => "Water: 80°C\nLeaf: 2g\nSteep: 2.5 mins\nRe-steep up to 3 times.",
                'benefit' => 'focus',
                'type' => 'green',
                'caffeine' => 'low',
            ],
            [
                'name' => 'Imperial Royal Kashmiri Saffron Kehwa',
                'slug' => 'imperial-royal-kashmiri-saffron-kehwa',
                'category' => 'luxury-wellness',
                'vendor' => 'darjeeling',
                'price' => 3200.00,
                'compare_at' => 3600.00,
                'image' => '/pimages/saffron.jpg',
                'rating' => 5.0,
                'reviews' => 72,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Grade-A Pampore saffron threads, green tea, crushed green cardamom pods, and cinnamon bark.',
                'desc' => 'A centuries-old royal Himalayan recipe. Golden saffron strands infuse the liquor with an ethereal copper hue and lingering regal warmth.',
                'ingredients' => 'Organic Kashmiri Green Tea, Pampore Mongra Saffron, Green Cardamom, Ceylon Cinnamon, Almond Slivers.',
                'guide' => "Water: 90°C\nLeaf: 3g\nSteep: 4 mins\nSweeten lightly with raw acacia honey if desired.",
                'benefit' => 'immunity',
                'type' => 'green',
                'caffeine' => 'low',
            ],
            [
                'name' => 'High-Curcumin Alleppey Turmeric Infusion',
                'slug' => 'high-curcumin-alleppey-turmeric-infusion',
                'category' => 'artisanal-spices',
                'vendor' => 'kerala',
                'price' => 950.00,
                'compare_at' => null,
                'image' => '/pimages/turmeric.jpg',
                'rating' => 4.8,
                'reviews' => 38,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Single-estate Kerala turmeric (6.5% natural curcumin) with Tellicherry pepper and cardamom.',
                'desc' => 'Deep golden radiance in a cup. Formulated with black pepper piperine to enhance natural bio-availability by up to 2000%.',
                'ingredients' => 'Alleppey Organic Turmeric Rhizome, Tellicherry Black Pepper, Cardamom Pods, Ginger Root.',
                'guide' => "Water: 100°C\nLeaf: 3g\nSteep: 5-7 mins\nExcellent on its own or brewed in warm oat milk.",
                'benefit' => 'immunity',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'Himalayan Silver Needle Reserve White Tea',
                'slug' => 'himalayan-silver-needle-reserve-white-tea',
                'category' => 'single-origin-reserve',
                'vendor' => 'darjeeling',
                'price' => 3800.00,
                'compare_at' => null,
                'image' => '/pimages/6.jpg',
                'rating' => 5.0,
                'reviews' => 26,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Hand-harvested unopened spring buds cloaked in downy silver velvet.',
                'desc' => 'The purest expression of Camellia sinensis. Only the pristine terminal bud is harvested during two days of early spring sunshine. Silky, nectar-like body with honeysuckle notes.',
                'ingredients' => '100% Whole Tender Terminal White Tea Buds (Silver Needle).',
                'guide' => "Water: 75°C\nLeaf: 3g\nSteep: 4-5 mins\nRe-steep up to 4 times.",
                'benefit' => 'detox',
                'type' => 'white',
                'caffeine' => 'low',
            ],
            [
                'name' => 'Tellicherry Reserve Whole Black Peppercorns',
                'slug' => 'tellicherry-reserve-whole-black-peppercorns',
                'category' => 'artisanal-spices',
                'vendor' => 'kerala',
                'price' => 850.00,
                'compare_at' => null,
                'image' => '/pimages/blackoeooer.jpg',
                'rating' => 4.9,
                'reviews' => 34,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Extra-bold 4.75mm peppercorns left on the vine to full maturity in Malabar.',
                'desc' => 'Pungent, citrusy, and complex. Hand-sorted to ensure only uniform, oil-rich jumbo berries make it into our spice cloche.',
                'ingredients' => '100% Sun-Dried Malabar Tellicherry Garbled Extra Bold (TGSEB) Peppercorns.',
                'guide' => 'Grind freshly over savoury dishes or crush lightly into chai and savory botanical infusions.',
                'benefit' => 'detox',
                'type' => 'spice',
                'caffeine' => 'free',
            ],
            [
                'name' => 'The Henley Signature Cloche Gift Collection',
                'slug' => 'the-henley-signature-cloche-gift-collection',
                'category' => 'curated-gift-sets',
                'vendor' => 'darjeeling',
                'price' => 4500.00,
                'compare_at' => 5000.00,
                'image' => '/pimages/2.jpg',
                'rating' => 5.0,
                'reviews' => 68,
                'bestseller' => false,
                'featured' => false,
                'short' => 'Three 50g tasting cloche jars in a debossed ivory gift box with solid brass cloche scoop.',
                'desc' => 'The ultimate introduction to Henley. Includes First Flush Castleton, Restorative Sleep, and Imperial Kashmiri Kehwa.',
                'ingredients' => 'Assortment of three signature Henley botanicals and teas.',
                'guide' => 'Complete ritual tasting handbook included in the presentation box.',
                'benefit' => 'relaxation',
                'type' => 'herbal',
                'caffeine' => 'low',
            ],
        ];

        $createdProducts = [];
        $skuCounter = 100;

        foreach ($catalog as $index => $item) {
            $vendor = $vendors[$item['vendor']];
            $category = $categories[$item['category']];

            $product = Product::create([
                'vendor_id' => $vendor->id,
                'brand_id' => $brand->id,
                'name' => $item['name'],
                'slug' => $item['slug'],
                'short_description' => $item['short'],
                'description' => $item['desc'],
                'ingredients' => $item['ingredients'],
                'brewing_guide' => $item['guide'],
                'status' => ProductStatus::PUBLISHED,
                'is_featured' => $item['featured'] ?? false,
                'is_bestseller' => $item['bestseller'] ?? false,
                'base_price' => $item['price'],
                'compare_at_price' => $item['compare_at'] ?? null,
                'tax_rate_percent' => 5.00,
                'weight_grams' => 100,
                'dimensions' => ['length_cm' => 8, 'width_cm' => 8, 'height_cm' => 16],
                'rating_average' => $item['rating'] ?? 5.0,
                'rating_count' => $item['reviews'] ?? 24,
                'published_at' => now()->subDays(rand(5, 60)),
                'seo_title' => "{$item['name']} — Henley Luxury Tea",
                'seo_description' => $item['short'],
                'metadata' => [
                    'harvest_period' => 'Spring 2026',
                    'elevation' => '1,850m',
                    'certifications' => ['USDA Organic', 'India Organic', 'Fair Wild'],
                ],
            ]);

            // Assign category
            $product->categories()->attach($category->id);

            // Assign taxonomies
            if (isset($taxonomies['benefit'][$item['benefit']])) {
                $product->taxonomyTerms()->attach($taxonomies['benefit'][$item['benefit']]->id);
            }
            if (isset($taxonomies['type'][$item['type']])) {
                $product->taxonomyTerms()->attach($taxonomies['type'][$item['type']]->id);
            }
            if (isset($taxonomies['caffeine'][$item['caffeine']])) {
                $product->taxonomyTerms()->attach($taxonomies['caffeine'][$item['caffeine']]->id);
            }

            // Create Variants: 100g Porcelain Cloche Jar & 250g Refill Pouch (plus 50g tasting tin on select)
            $variantOptions = [
                ['label' => '100g Signature Porcelain Cloche Jar', 'price' => $item['price'], 'weight' => 100],
                ['label' => '250g Botanical Refill Pouch', 'price' => round($item['price'] * 2.1, 2), 'weight' => 250],
            ];
            if ($index % 2 === 0) {
                $variantOptions[] = ['label' => '50g Petite Tasting Tin', 'price' => round($item['price'] * 0.6, 2), 'weight' => 50];
            }

            foreach ($variantOptions as $vIdx => $vOpt) {
                $sku = 'HNL-'.strtoupper(substr($item['slug'], 0, 3)).'-'.(++$skuCounter);
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $sku,
                    'option_label' => $vOpt['label'],
                    'price' => $vOpt['price'],
                    'compare_at_price' => null,
                    'weight_grams' => $vOpt['weight'],
                    'barcode' => '8901'.rand(100000000, 999999999),
                    'sort_order' => $vIdx,
                    'is_active' => true,
                ]);

                // Create Inventory with realistic quantities (and a few low stock / out of stock for Darjeeling vendor)
                $qty = 45;
                if ($index === 1 && $vIdx === 0) {
                    $qty = 2; // Deliberate low stock (Darjeeling vendor)
                } elseif ($index === 3 && $vIdx === 1) {
                    $qty = 0; // Deliberate out of stock (Darjeeling vendor)
                }

                Inventory::create([
                    'product_variant_id' => $variant->id,
                    'quantity_on_hand' => $qty,
                    'quantity_reserved' => ($qty > 5) ? 2 : 0,
                    'low_stock_threshold' => 5,
                    'warehouse_location' => 'Siliguri Vault, Bin #'.rand(10, 99),
                ]);

                // Record initial stock movement in ledger
                StockMovement::create([
                    'product_variant_id' => $variant->id,
                    'reason' => StockMovementReason::INITIAL_STOCK,
                    'quantity_delta' => $qty,
                    'balance_after' => $qty,
                    'actor_id' => null,
                    'reference_type' => 'Seeder',
                    'reference_id' => 'INIT-BATCH-2026',
                    'notes' => 'Initial catalogue opening stock.',
                    'created_at' => now()->subDays(60),
                ]);
            }

            // Create Attributes
            ProductAttribute::create(['product_id' => $product->id, 'key' => 'caffeine_level', 'value' => ucfirst($item['caffeine']), 'sort_order' => 1]);
            ProductAttribute::create(['product_id' => $product->id, 'key' => 'origin_region', 'value' => $vendor->business_name, 'sort_order' => 2]);
            ProductAttribute::create(['product_id' => $product->id, 'key' => 'harvest_season', 'value' => 'Spring 2026 First Flush', 'sort_order' => 3]);
            ProductAttribute::create(['product_id' => $product->id, 'key' => 'packaging', 'value' => 'Bone-White Cloche with Apothecary Window', 'sort_order' => 4]);

            // Create Images (3 images per product using authentic /pimages photography)
            $primaryImg = $item['image'] ?? '/pimages/saffron.jpg';
            $images = [
                ['url' => $primaryImg, 'alt' => "{$item['name']} — Botanical Sanctuary", 'primary' => true],
                ['url' => '/pimages/2.jpg', 'alt' => "{$item['name']} — Botanical Details", 'primary' => false],
                ['url' => '/pimages/tea.jpg', 'alt' => "{$item['name']} — Harvest & Ritual", 'primary' => false],
            ];
            foreach ($images as $imgIdx => $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $img['url'],
                    'alt_text' => $img['alt'],
                    'sort_order' => $imgIdx,
                    'is_primary' => $img['primary'],
                ]);
            }

            $createdProducts[] = $product;
        }

        return $createdProducts;
    }

    /**
     * @param  list<Product>  $products
     * @param  list<User>  $customers
     */
    private function seedReviews(array $products, array $customers): void
    {
        $reviewPhrases = [
            ['title' => 'An exceptional daily ritual.', 'body' => 'The cloche jar arrived in bespoke packaging. The whole leaves unfurl to reveal pristine single flushes with delicate floral sweetness.', 'rating' => 5],
            ['title' => 'The purest chamomile I have ever tasted.', 'body' => 'Noticeable calming effect within twenty minutes. The bone-white cloche looks stunning on the counter.', 'rating' => 5],
            ['title' => 'Transcends everyday tea.', 'body' => 'Deep amber liquor with zero bitterness. You can easily get three infusions from a single teaspoon.', 'rating' => 5],
            ['title' => 'Unbelievable aroma.', 'body' => 'The scent fills the whole room when unboxing. Packaging design is world class.', 'rating' => 4],
            ['title' => 'Saffron notes are authentic and regal.', 'body' => 'High quality saffron strands that provide a genuine copper glow. Will definitely re-order.', 'rating' => 5],
        ];

        foreach ($products as $product) {
            $numReviews = rand(8, 15);
            $totalStars = 0;

            for ($r = 0; $r < $numReviews; $r++) {
                $user = $customers[$r % count($customers)];
                $phrase = $reviewPhrases[$r % count($reviewPhrases)];
                $rating = $phrase['rating'];
                $totalStars += $rating;

                Review::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'customer_id' => $user->customer?->id,
                    'customer_name' => $user->name,
                    'rating' => $rating,
                    'title' => $phrase['title'],
                    'body' => $phrase['body'],
                    'is_verified_purchase' => true,
                    'status' => ReviewStatus::APPROVED,
                    'published_at' => now()->subDays(rand(2, 45)),
                ]);
            }

            // Sync denormalized stats
            $product->updateQuietly([
                'rating_average' => round($totalStars / $numReviews, 2),
                'rating_count' => $numReviews,
            ]);
        }
    }

    /**
     * @return array<string, Coupon>
     */
    private function seedCoupons(): array
    {
        $coupons = [
            'RITUAL15' => Coupon::create([
                'code' => 'RITUAL15',
                'type' => CouponType::PERCENTAGE,
                'value' => 15.00,
                'min_order_amount' => 1000.00,
                'max_discount_amount' => 500.00,
                'usage_limit_total' => 1000,
                'usage_limit_per_customer' => 1,
                'total_uses' => 24,
                'applicability_scope' => 'all',
                'starts_at' => now()->subMonths(2),
                'expires_at' => now()->addMonths(6),
                'is_active' => true,
            ]),
            'FIRSTHARVEST' => Coupon::create([
                'code' => 'FIRSTHARVEST',
                'type' => CouponType::FIXED,
                'value' => 250.00,
                'min_order_amount' => 1200.00,
                'max_discount_amount' => 250.00,
                'usage_limit_total' => 500,
                'usage_limit_per_customer' => 1,
                'total_uses' => 18,
                'applicability_scope' => 'all',
                'starts_at' => now()->subMonth(),
                'expires_at' => now()->addMonths(3),
                'is_active' => true,
            ]),
            'FREESHIP' => Coupon::create([
                'code' => 'FREESHIP',
                'type' => CouponType::FREE_SHIPPING,
                'value' => 0.00,
                'min_order_amount' => 500.00,
                'max_discount_amount' => 150.00,
                'usage_limit_total' => 2000,
                'usage_limit_per_customer' => 3,
                'total_uses' => 45,
                'applicability_scope' => 'all',
                'starts_at' => now()->subMonth(),
                'expires_at' => now()->addMonths(6),
                'is_active' => true,
            ]),
            'ROYALTEA' => Coupon::create([
                'code' => 'ROYALTEA',
                'type' => CouponType::PERCENTAGE,
                'value' => 20.00,
                'min_order_amount' => 2500.00,
                'max_discount_amount' => 1000.00,
                'usage_limit_total' => 100,
                'usage_limit_per_customer' => 1,
                'total_uses' => 8,
                'applicability_scope' => 'all',
                'starts_at' => now()->subDays(10),
                'expires_at' => now()->addDays(20),
                'is_active' => true,
            ]),
            'SPRING10' => Coupon::create([
                'code' => 'SPRING10',
                'type' => CouponType::PERCENTAGE,
                'value' => 10.00,
                'min_order_amount' => 800.00,
                'max_discount_amount' => 300.00,
                'usage_limit_total' => 200,
                'usage_limit_per_customer' => 1,
                'total_uses' => 40,
                'applicability_scope' => 'all',
                'starts_at' => now()->subMonths(3),
                'expires_at' => now()->subDays(15), // Expired
                'is_active' => false,
            ]),
            'WELCOME100' => Coupon::create([
                'code' => 'WELCOME100',
                'type' => CouponType::FIXED,
                'value' => 100.00,
                'min_order_amount' => 500.00,
                'max_discount_amount' => 100.00,
                'usage_limit_total' => 100,
                'usage_limit_per_customer' => 1,
                'total_uses' => 100, // Exhausted
                'applicability_scope' => 'all',
                'starts_at' => now()->subMonth(),
                'expires_at' => now()->addMonth(),
                'is_active' => true,
            ]),
        ];

        return $coupons;
    }

    /**
     * @param  list<User>  $customers
     * @param  list<Product>  $products
     * @param  array<string, Coupon>  $coupons
     * @return list<Order>
     */
    private function seedOrders(array $customers, array $products, array $coupons): array
    {
        $statuses = [
            OrderStatus::DELIVERED,
            OrderStatus::DELIVERED,
            OrderStatus::PROCESSING,
            OrderStatus::SHIPPED,
            OrderStatus::PENDING,
            OrderStatus::CANCELLED,
            OrderStatus::REFUNDED,
        ];

        $orders = [];
        $orderNumberBase = 1001;

        for ($i = 0; $i < 40; $i++) {
            $user = $customers[$i % count($customers)];
            $customerProfile = $user->customer;
            $shippingAddr = $customerProfile?->defaultShippingAddress;

            $status = $statuses[$i % count($statuses)];
            $paymentStatus = match ($status) {
                OrderStatus::DELIVERED, OrderStatus::SHIPPED, OrderStatus::PROCESSING => PaymentStatus::CAPTURED,
                OrderStatus::PENDING => PaymentStatus::PENDING,
                OrderStatus::CANCELLED => PaymentStatus::FAILED,
                OrderStatus::REFUNDED => PaymentStatus::REFUNDED,
            };

            $orderDate = now()->subDays(round(($i / 40) * 85) + 1);

            // Select 1-3 random products
            $numItems = rand(1, 3);
            $selectedProducts = array_slice($products, ($i * 2) % (count($products) - 4), $numItems);

            $subtotal = 0.00;
            $itemsData = [];

            foreach ($selectedProducts as $prod) {
                $variant = $prod->variants->first();
                if (! $variant) {
                    continue;
                }
                $qty = rand(1, 2);
                $unitPrice = (float) $variant->price;
                $lineTax = round(($unitPrice * $qty) * 0.05, 2);
                $lineTotal = ($unitPrice * $qty) + $lineTax;

                $subtotal += ($unitPrice * $qty);

                $itemsData[] = [
                    'product' => $prod,
                    'variant' => $variant,
                    'unit_price' => $unitPrice,
                    'quantity' => $qty,
                    'line_tax' => $lineTax,
                    'line_total' => $lineTotal,
                ];
            }

            $discount = 0.00;
            $couponId = null;
            if ($i % 5 === 0 && $subtotal >= 1000) {
                $coupon = $coupons['RITUAL15'];
                $discount = $coupon->calculateDiscount($subtotal);
                $couponId = $coupon->id;
            }

            $taxAmount = round($subtotal * 0.05, 2);
            $shippingAmount = ($subtotal >= 1000) ? 0.00 : 90.00;
            $grandTotal = $subtotal - $discount + $taxAmount + $shippingAmount;

            $orderNumber = 'HNL-'.now()->format('Y').'-'.($orderNumberBase + $i);

            $customerSnapshot = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '+919820012345',
            ];

            $addressSnapshot = [
                'recipient_name' => $user->name,
                'phone' => $user->phone ?? '+919820012345',
                'line_1' => $shippingAddr !== null ? $shippingAddr->line_1 : 'Pali Hill Reserve, Bandra West',
                'city' => $shippingAddr !== null ? $shippingAddr->city : 'Mumbai',
                'state' => $shippingAddr !== null ? $shippingAddr->state : 'Maharashtra',
                'pincode' => $shippingAddr !== null ? $shippingAddr->pincode : '400050',
                'country' => 'IN',
            ];

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user->id,
                'customer_id' => $customerProfile?->id,
                'customer_snapshot' => $customerSnapshot,
                'shipping_address' => $addressSnapshot,
                'billing_address' => $addressSnapshot,
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'tax_amount' => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'grand_total' => $grandTotal,
                'coupon_id' => $couponId,
                'status' => $status,
                'payment_status' => $paymentStatus,
                'currency' => 'INR',
                'placed_at' => $orderDate,
                'fulfilled_at' => ($status === OrderStatus::DELIVERED) ? $orderDate->copy()->addDays(3) : null,
                'customer_notes' => ($i % 3 === 0) ? 'Please place packaging seal with care.' : null,
            ]);

            // Save order items
            foreach ($itemsData as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_variant_id' => $item['variant']->id,
                    'vendor_id' => $item['product']->vendor_id,
                    'product_name' => $item['product']->name,
                    'variant_label' => $item['variant']->option_label,
                    'sku' => $item['variant']->sku,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'line_tax' => $item['line_tax'],
                    'line_discount' => 0.00,
                    'line_total' => $item['line_total'],
                ]);
            }

            // Record coupon redemption
            if ($couponId) {
                CouponRedemption::create([
                    'coupon_id' => $couponId,
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'discount_amount' => $discount,
                    'redeemed_at' => $orderDate,
                ]);
            }

            // Create Payment
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_number' => 'PAY-2026-'.($orderNumberBase + $i),
                'gateway' => 'razorpay',
                'gateway_order_id' => 'order_'.Str::random(14),
                'gateway_payment_id' => ($paymentStatus === PaymentStatus::CAPTURED) ? 'pay_'.Str::random(14) : null,
                'gateway_signature' => ($paymentStatus === PaymentStatus::CAPTURED) ? hash('sha256', 'razorpay-sample-sig') : null,
                'amount' => $grandTotal,
                'currency' => 'INR',
                'status' => $paymentStatus,
                'payment_method' => ($i % 2 === 0) ? 'upi' : 'card',
                'payload' => ['gateway_status' => 'captured', 'method' => 'upi', 'vpa' => 'collector@okhdfcbank'],
                'captured_at' => ($paymentStatus === PaymentStatus::CAPTURED) ? $orderDate : null,
            ]);

            // Create Shipment for dispatched/completed orders
            if (in_array($status, [OrderStatus::DELIVERED, OrderStatus::SHIPPED], true)) {
                Shipment::create([
                    'order_id' => $order->id,
                    'vendor_id' => $selectedProducts[0]->vendor_id,
                    'shipment_number' => 'SHP-2026-'.($orderNumberBase + $i),
                    'courier_name' => 'BlueDart Apex Express',
                    'tracking_number' => 'BLUEDART'.rand(10000000, 99999999),
                    'tracking_url' => 'https://bluedart.com/track?no='.rand(10000000, 99999999),
                    'status' => ($status === OrderStatus::DELIVERED) ? ShipmentStatus::DELIVERED : ShipmentStatus::IN_TRANSIT,
                    'shipped_at' => $orderDate->copy()->addDay(),
                    'delivered_at' => ($status === OrderStatus::DELIVERED) ? $orderDate->copy()->addDays(3) : null,
                ]);
            }

            // Create Refund record for refunded orders
            if ($status === OrderStatus::REFUNDED) {
                Refund::create([
                    'order_id' => $order->id,
                    'payment_id' => $payment->id,
                    'refund_number' => 'RFD-2026-'.($orderNumberBase + $i),
                    'gateway_refund_id' => 'rfd_'.Str::random(14),
                    'amount' => $grandTotal,
                    'reason' => 'Customer modified ritual package order.',
                    'status' => RefundStatus::PROCESSED,
                    'processed_at' => $orderDate->copy()->addDays(2),
                ]);
            }

            $orders[] = $order;
        }

        return $orders;
    }

    private function seedContent(): void
    {
        // 1. CMS Pages
        $pages = [
            [
                'title' => 'Our Philosophy & Himalayan Terroir',
                'slug' => 'about-us',
                'body' => "Henley was founded on a simple premise: tea should be revered with the same meticulous craftsmanship as high fragrance.\n\nWe partner exclusively with bio-dynamic high-altitude gardens across Darjeeling, Assam, and the Nilgiris.",
            ],
            [
                'title' => 'The Cloche Infusion Ritual',
                'slug' => 'the-cloche-ritual',
                'body' => "Our custom bone-white cylindrical cloche is engineered to preserve fragile aromatic terpenes.\n\nThe arched apothecary window offers visual contemplation of the leaf before unsealing.",
            ],
            [
                'title' => 'Ethical Harvest & Direct Trade',
                'slug' => 'sourcing-ethics',
                'body' => 'By contracting directly with single-estate growers and paying a 30% premium above market prices, we support regenerative biodiverse agriculture.',
            ],
            [
                'title' => 'Shipping & Botanical Preservation',
                'slug' => 'shipping-policy',
                'body' => 'All orders are sealed at the garden in nitrogen-purged foil liners within 48 hours of harvest and dispatched via expedited temperature-controlled express.',
            ],
            [
                'title' => 'Terms of Private Reserve Access',
                'slug' => 'terms-of-service',
                'body' => 'Access to numbered micro-lot reserves is subject to seasonal harvest availability and allocation limits per household.',
            ],
        ];

        foreach ($pages as $p) {
            CmsPage::create([
                'title' => $p['title'],
                'slug' => $p['slug'],
                'body' => $p['body'],
                'is_published' => true,
                'published_at' => now()->subMonths(2),
                'seo_title' => "{$p['title']} — Henley",
                'seo_description' => substr($p['body'], 0, 150),
            ]);
        }

        // 2. Homepage Dynamic Sections (9 Reorderable Section Types)
        HomepageSection::create([
            'key' => 'hero_section',
            'title' => 'Editorial Hero Statement',
            'type' => 'hero',
            'sort_order' => 1,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Pure Leaf. Pure Intent.',
                'headline' => "Tea, The Way\nNature Intended.",
                'subhead' => 'Organically extracted from handpicked pure leaves, crafted to preserve natural aroma, antioxidants, and authentic taste in every cup.',
                'primary_cta' => ['label' => 'Shop Collection →', 'url' => '/shop'],
                'secondary_cta' => ['label' => 'Discover Our Process →', 'url' => '/story'],
                'proof_points' => [
                    '1,850m Single Estate',
                    'First Flush 2026',
                    '100% Biodynamic',
                ],
                'rating' => 5.0,
                'rating_count' => 148,
                'image_url' => '/images/brand/herobanner.png',
                'image_alt' => 'Henley — Tea, The Way Nature Intended',
            ],
        ]);

        HomepageSection::create([
            'key' => 'trust_strip_section',
            'title' => 'Brand Pillars & Quality Proofs',
            'type' => 'trust_strip',
            'sort_order' => 2,
            'is_active' => true,
            'payload' => [
                'items' => [
                    ['icon' => 'leaf', 'label' => 'Single-Estate Origin', 'caption' => 'Traceable directly to prime mountain slopes'],
                    ['icon' => 'package', 'label' => 'Apothecary Sealed', 'caption' => 'Flushed with nitrogen in porcelain tins'],
                    ['icon' => 'truck', 'label' => 'Complimentary Delivery', 'caption' => 'Express air courier on orders over ₹1,500'],
                    ['icon' => 'shield-check', 'label' => '100% Biodynamic Purity', 'caption' => 'Zero synthetic pesticides or artificial aromas'],
                ],
            ],
        ]);

        HomepageSection::create([
            'key' => 'featured_collections_section',
            'title' => 'Curated Cellar Portals',
            'type' => 'featured_collections',
            'sort_order' => 3,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Explore Our Range',
                'title' => 'Curated Collections',
                'description' => 'Discover our meticulously crafted blends, single-origin spices, and stoneground flours.',
                'limit' => 8,
            ],
        ]);

        HomepageSection::create([
            'key' => 'featured_products_section',
            'title' => 'Seasonal Reserve Harvests',
            'type' => 'featured_products',
            'sort_order' => 4,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Handpicked for You',
                'title' => 'Featured Products',
                'description' => 'A curated selection of our finest teas, spices, and flours.',
                'limit' => 8,
            ],
        ]);

        HomepageSection::create([
            'key' => 'bestsellers_section',
            'title' => 'Collector Favorites',
            'type' => 'bestsellers',
            'sort_order' => 5,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Most Loved',
                'title' => 'Best Sellers',
                'description' => 'Our customers’ favorite selections, handpicked for you.',
                'limit' => 4,
            ],
        ]);

        HomepageSection::create([
            'key' => 'story_band_section',
            'title' => 'Our Botanical Philosophy',
            'type' => 'story_band',
            'sort_order' => 6,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Our Promise',
                'title' => "From Leaf to Cup,\nWith Intention.",
                'body' => 'At Henley, we believe in purity, transparency, and gifting wellness through nature’s finest. Every blend is hand-selected from organic farms, slow-dried to preserve essential oils, and packed in small batches to ensure peak freshness.',
                'author' => 'Our apothecary-inspired tins are designed to be beautiful enough to keep and refill — because sustainability should never sacrifice style.',
                'cta_label' => 'Learn More',
                'cta_url' => '/story',
                'image_url' => '/pimages/2.jpg',
                'image_alt' => 'Henley — Our Process',
            ],
        ]);

        HomepageSection::create([
            'key' => 'offers_section',
            'title' => 'Seasonal Gift Allocation',
            'type' => 'offers',
            'sort_order' => 7,
            'is_active' => true,
            'payload' => [
                'code' => 'WELCOME10',
                'eyebrow' => 'Welcome Offer',
                'title' => '10% Off Your First Order',
                'description' => 'Use code WELCOME10 at checkout. Handcrafted teas & fresh-ground spices delivered to your door.',
                'expiry_text' => 'Valid on orders over ₹1,500',
                'cta_label' => 'Shop Now',
                'cta_url' => '/shop',
            ],
        ]);

        HomepageSection::create([
            'key' => 'why_henley_section',
            'title' => 'Why Henley — Our Promise',
            'type' => 'why_henley',
            'sort_order' => 8,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'OUR PROMISE',
                'title' => 'Why Henley?',
                'description' => 'We go beyond the ordinary to bring you teas that are pure, mindful, and exceptional in every way.',
                'tagline_primary' => 'PURE LEAF. PURE INTENT.',
                'tagline_secondary' => 'Diet the Health of Life',
                'image_url' => '/images/brand/why_henley.png',
                'image_alt' => 'Henley single-estate porcelain cloche canister with botanical leaves and spices',
                'pillars' => [
                    [
                        'icon' => 'leaf',
                        'title' => 'Organic Leaves',
                        'description' => 'Handpicked tea leaves grown in organic gardens, nurturing nature and your well-being.',
                    ],
                    [
                        'icon' => 'cycle',
                        'title' => 'Small Batch Processing',
                        'description' => 'Carefully crafted in small batches to preserve the natural flavor and goodness.',
                    ],
                    [
                        'icon' => 'flask',
                        'title' => 'No Artificial Additives',
                        'description' => 'No artificial flavors, colors, or preservatives. Just pure leaves, nothing more.',
                    ],
                    [
                        'icon' => 'sparkles',
                        'title' => 'Rich in Antioxidants',
                        'description' => 'Naturally rich in antioxidants that help you stay refreshed, revitalized, and balanced.',
                    ],
                ],
            ],
        ]);

        HomepageSection::create([
            'key' => 'journal_preview_section',
            'title' => 'The Botanical Journal',
            'type' => 'journal_preview',
            'sort_order' => 9,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'The Botanical Journal',
                'title' => 'Field Notes & Brewing Alchemy',
                'description' => 'Essays on high-altitude terroir, aromatic chemistry, and the unhurried ritual of tea extraction.',
                'limit' => 3,
            ],
        ]);

        HomepageSection::create([
            'key' => 'brewing_ritual_section',
            'title' => 'The Henley Ritual',
            'type' => 'brewing_ritual',
            'sort_order' => 10,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'The Art of Infusion',
                'title' => 'The Henley Ritual',
                'description' => 'Four mindful movements to awaken delicate floral bouquets, essential terpenes, and the authentic single-estate character of your harvest.',
                'tagline' => 'Where mountain spring meets virgin leaf.',
                'image_url' => '/pimages/tea.jpg',
                'image_alt' => 'Henley whole orthodox tea leaves infusing in clear mountain spring water',
                'cta_label' => 'Explore Loose-Leaf Harvests',
                'cta_url' => '/collections',
                'guide_label' => 'Discover Apothecary Teaware',
                'guide_url' => '/collections/accessories',
                'parameters' => [
                    [
                        'label' => 'Pure Spring Water',
                        'value' => '200 ml',
                        'note' => 'Sub-boiling mineral water',
                    ],
                    [
                        'label' => 'Thermal Precision',
                        'value' => '85°C / 185°F',
                        'note' => 'Protects delicate oils',
                    ],
                    [
                        'label' => 'The Cloche Measure',
                        'value' => '2.5g Scoop',
                        'note' => 'Unbroken whole leaf',
                    ],
                    [
                        'label' => 'Infusion Duration',
                        'value' => '3 Minutes',
                        'note' => 'Up to 3 re-steepings',
                    ],
                ],
                'steps' => [
                    [
                        'step' => '01',
                        'name' => 'The Cloche Dose',
                        'parameter' => '2.5g · Whole Orthodox Leaf',
                        'description' => 'Measure unbroken orthodox leaves into pre-warmed porcelain or glass teaware. Inhale the dry bouquet — capturing notes of wild spring blossoms, dried apricot, and high-altitude mountain pine.',
                    ],
                    [
                        'step' => '02',
                        'name' => 'Thermal Precision',
                        'parameter' => '85°C (185°F) · Spring Water',
                        'description' => 'Bring soft mountain spring water to a gentle simmer and rest for sixty seconds. Sub-boiling warmth coaxes out ethereal floral terpenes and vitamins without scorching or extracting bitter tannins.',
                    ],
                    [
                        'step' => '03',
                        'name' => 'The Unhurried Steep',
                        'parameter' => '3 Minutes · Quietude',
                        'description' => 'Pour in slow concentric circles over the leaves. Cover and rest for three quiet minutes as the curled needles gently unfurl, releasing a radiant, crystal-clear golden amber liquor.',
                    ],
                    [
                        'step' => '04',
                        'name' => 'The Evolving Infusions',
                        'parameter' => 'Up to 3 Sequential Steeps',
                        'description' => 'Never discard pristine orthodox leaves after a single cup. Second and third steepings unlock deeper tertiary notes — roasted chestnut, wild honey, and lingering mineral sweetness.',
                    ],
                ],
            ],
        ]);

        HomepageSection::create([
            'key' => 'reviews_section',
            'title' => 'Collector Reflections & Reviews',
            'type' => 'reviews',
            'sort_order' => 11,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Customer Impressions',
                'title' => 'Collector Reflections',
                'description' => 'Unfiltered words from tea collectors, herbalists, and mindful living patrons across the globe.',
                'rating_average' => 4.98,
                'rating_count' => '1,420+',
            ],
        ]);

        HomepageSection::create([
            'key' => 'newsletter_band_section',
            'title' => 'Private Allocation Dispatch',
            'type' => 'newsletter_band',
            'sort_order' => 12,
            'is_active' => true,
            'payload' => [
                'eyebrow' => 'Private Allocation Dispatch',
                'title' => 'Join the Henley Collector Circle',
                'description' => 'Receive first notification when limited single-estate spring flushes and wild saffron reserves are bottled.',
            ],
        ]);

        // 3. Storefront Banners
        Banner::create([
            'title' => 'Complimentary Brass Tasting Spoon on Orders Above ₹2,000',
            'placement' => 'promo_strip',
            'image_url' => '/images/brand/collectionpage.jpeg',
            'link_url' => '/collections/curated-gift-sets',
            'starts_at' => now()->subDays(10),
            'expires_at' => now()->addMonths(2),
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // 4. Six Journal Posts
        $posts = [
            [
                'title' => 'The Chemistry of Spring First Flush: Why Altitude Changes Everything',
                'slug' => 'chemistry-of-first-flush',
                'excerpt' => 'An exploration into the diurnal shifts and ultraviolet light of Himalayan slopes.',
                'author' => 'Dr. Alistair Henley',
                'read_time' => 5,
            ],
            [
                'title' => 'Saffron Grading in the Pampore Highlands: From Stigma to Cloche',
                'slug' => 'saffron-grading-pampore',
                'excerpt' => 'Understanding the safranal and crocin concentration in genuine Kashmiri Mongra threads.',
                'author' => 'Evelyn Vance',
                'read_time' => 4,
            ],
            [
                'title' => 'The Architecture of the Apothecary Cloche: Preserving Terpenes',
                'slug' => 'architecture-of-apothecary-cloche',
                'excerpt' => 'Why traditional tin containers oxidize delicate leaves and how porcelain solves it.',
                'author' => 'Alistair Henley',
                'read_time' => 6,
            ],
            [
                'title' => 'Water Temperature and Mineralization: The Lost Halves of Tea Extraction',
                'slug' => 'water-temperature-and-mineralization',
                'excerpt' => 'How total dissolved solids and steep curve dictate tannin release.',
                'author' => 'Tenzing Norbu',
                'read_time' => 4,
            ],
            [
                'title' => 'Wild Chamomile and Nightshade Botanicals: An Herbalist’s Field Notes',
                'slug' => 'wild-chamomile-field-notes',
                'excerpt' => 'Field notes from our Nilgiri herbal harvests at 2,000m elevation.',
                'author' => 'Sundaram Pillai',
                'read_time' => 5,
            ],
            [
                'title' => 'Single-Estate vs Commercial Blends: Traceability Across 1,800 Metres',
                'slug' => 'single-estate-vs-commercial-blends',
                'excerpt' => 'The hidden cost of supermarket tea and the renaissance of micro-lot terroir.',
                'author' => 'Dr. Alistair Henley',
                'read_time' => 7,
            ],
        ];

        foreach ($posts as $p) {
            JournalPost::create([
                'title' => $p['title'],
                'slug' => $p['slug'],
                'excerpt' => $p['excerpt'],
                'body' => "High above the clouds in the Eastern Himalayas, microclimatic shifts between day and night force the tea bush to synthesize high concentrations of aromatic linalool.\n\nWhen harvested at first light before the mountain mist evaporates, the leaves capture an ephemeral floral brightness that cannot be manufactured.\n\nAt Henley, our single-estate partners practice biodynamic agriculture, allowing the soil's natural mycorrhizal network to nourish the plant naturally.",
                'cover_image' => 'brand/productpage.jpeg',
                'author_name' => $p['author'],
                'reading_time_minutes' => $p['read_time'],
                'is_published' => true,
                'published_at' => now()->subDays(rand(2, 40)),
                'seo_title' => "{$p['title']} — The Henley Journal",
                'seo_description' => $p['excerpt'],
            ]);
        }
    }

    private function seedSettings(): void
    {
        $settings = [
            ['group' => 'general', 'key' => 'brand_tagline', 'value' => 'Pure leaf. Pure intent.', 'type' => 'string'],
            ['group' => 'general', 'key' => 'contact_email', 'value' => 'concierge@henleytea.com', 'type' => 'string'],
            ['group' => 'general', 'key' => 'contact_phone', 'value' => '+91 800 HENLEY (436539)', 'type' => 'string'],
            ['group' => 'shipping', 'key' => 'free_shipping_threshold_paise', 'value' => '150000', 'type' => 'integer'],
            ['group' => 'shipping', 'key' => 'standard_shipping_rate_paise', 'value' => '9000', 'type' => 'integer'],
            ['group' => 'tax', 'key' => 'default_gst_rate_percent', 'value' => '5.0', 'type' => 'float'],
            ['group' => 'currency', 'key' => 'currency_symbol', 'value' => '₹', 'type' => 'string'],
            [
                'group' => 'announcement',
                'key' => 'banner_enabled',
                'value' => '1',
                'type' => 'boolean',
            ],
            [
                'group' => 'announcement',
                'key' => 'banner_text',
                'value' => 'Complimentary Express Air Delivery on all Himalayan reserve orders over ₹1,500',
                'type' => 'string',
            ],
            [
                'group' => 'announcement',
                'key' => 'banner_link',
                'value' => '/collections',
                'type' => 'string',
            ],
            [
                'group' => 'navigation',
                'key' => 'main_menu',
                'value' => json_encode([
                    ['label' => 'Shop', 'url' => '/collections', 'has_mega' => false],
                    ['label' => 'Collections', 'url' => '/collections', 'has_mega' => true],
                    ['label' => 'Herbal', 'url' => '/collections', 'has_mega' => false],
                    ['label' => 'Gifts', 'url' => '/collections', 'has_mega' => false],
                    ['label' => 'Our Story', 'url' => '/about', 'has_mega' => false],
                    ['label' => 'Journal', 'url' => '/journal', 'has_mega' => false],
                ]),
                'type' => 'json',
            ],
        ];

        foreach ($settings as $s) {
            Setting::create($s);
        }
    }
}
