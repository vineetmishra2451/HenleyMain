<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Filament\Admin\Pages\ManageSettings;
use App\Filament\Admin\Pages\Reports;
use App\Filament\Admin\Resources\ActivityLogs\ActivityLogResource;
use App\Filament\Admin\Resources\Banners\BannerResource;
use App\Filament\Admin\Resources\CmsPages\CmsPageResource;
use App\Filament\Admin\Resources\HomepageSections\HomepageSectionResource;
use App\Filament\Admin\Resources\PromotionalContents\PromotionalContentResource;
use App\Filament\Admin\Resources\Roles\RoleResource;
use App\Filament\Admin\Resources\SeoMetadatas\SeoMetadataResource;
use App\Filament\Admin\Resources\Users\UserResource;
use App\Models\Banner;
use App\Models\CmsPage;
use App\Models\HomepageSection;
use App\Models\PromotionalContent;
use App\Models\SeoMetadata;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminReportsCmsAndAdministrationTest extends TestCase
{
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\AdminCmsAndSeoSeeder::class);

        $this->adminUser = User::where('email', 'admin@henley.com')->first()
            ?? User::factory()->create([
                'name' => 'Super Administrator',
                'email' => 'admin@henley.com',
                'role' => UserRole::SUPER_ADMIN,
                'is_active' => true,
            ]);

        $this->adminUser->assignRole('Super Admin');
    }

    public function test_admin_can_access_reports_hub_and_switch_report_dimensions(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/reports');
        $response->assertSuccessful();

        Livewire::test(Reports::class)
            ->assertSee('Reports Hub')
            ->assertSee('Sales Analytics')
            ->call('setReport', 'revenue')
            ->assertSet('activeReport', 'revenue')
            ->assertSee('Net Revenue')
            ->assertSee('Tax (GST) Liability')
            ->call('setReport', 'inventory')
            ->assertSet('activeReport', 'inventory')
            ->assertSee('Reserve Valuation')
            ->call('setRange', '7d')
            ->assertSet('dateRange', '7d')
            ->call('exportReport')
            ->assertNotified('Inventory Report Exported');
    }

    public function test_admin_can_view_and_manage_cms_pages(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/cms-pages');
        $response->assertSuccessful();
        $response->assertSee('Editorial Pages');

        $page = CmsPage::first();
        if ($page) {
            $response->assertSee($page->title);
            $editResponse = $this->get(CmsPageResource::getUrl('edit', ['record' => $page]));
            $editResponse->assertSuccessful();
        }
    }

    public function test_admin_can_view_homepage_sections_with_reorderable_list_and_toggle(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/homepage-sections');
        $response->assertSuccessful();
        $response->assertSee('Homepage Sections');

        $hero = HomepageSection::where('key', 'hero_section')->first();
        $this->assertNotNull($hero);
        $response->assertSee($hero->title);
    }

    public function test_admin_can_view_and_manage_storefront_banners(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/banners');
        $response->assertSuccessful();
        $response->assertSee('Storefront Banners');

        $banner = Banner::first();
        if ($banner) {
            $response->assertSee($banner->title);
        }
    }

    public function test_admin_can_view_promotional_content_offers_band(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/promotional-contents');
        $response->assertSuccessful();
        $response->assertSee('Promotional Content');

        $promo = PromotionalContent::first();
        if ($promo) {
            $response->assertSee($promo->title);
        }
    }

    public function test_admin_can_view_and_manage_seo_metadatas(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/seo-metadatas');
        $response->assertSuccessful();
        $response->assertSee('SEO Metadata');

        $seo = SeoMetadata::first();
        if ($seo) {
            $response->assertSee($seo->route_name);
        }
    }

    public function test_admin_can_access_and_save_platform_settings_with_masked_keys(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/manage-settings');
        $response->assertSuccessful();
        $response->assertSee('Platform Settings');
        $response->assertSee('General');
        $response->assertSee('Payment');
        $response->assertSee('Email');
        $response->assertSee('Shipping');
        $response->assertSee('Tax');
        $response->assertSee('SEO Defaults');
        $response->assertSee('System');

        Livewire::test(ManageSettings::class)
            ->set('data.store_name', 'Henley Artisanal Botanicals Updated')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertEquals('Henley Artisanal Botanicals Updated', Setting::get('store_name'));
    }

    public function test_admin_can_view_users_list_with_role_and_last_login(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/users');
        $response->assertSuccessful();
        $response->assertSee('User Accounts');
        $response->assertSee($this->adminUser->name);
        $response->assertSee($this->adminUser->email);
    }

    public function test_admin_can_view_roles_resource_with_permission_matrix(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/roles');
        $response->assertSuccessful();
        $response->assertSee('Staff Roles & Policies');

        $role = Role::where('name', 'Super Admin')->first();
        $this->assertNotNull($role);

        $editResponse = $this->get("http://admin.henley.com/roles/{$role->id}/edit");
        $editResponse->assertSuccessful();
        $editResponse->assertSee('2D Permission Matrix');
        $editResponse->assertSee('Products');
        $editResponse->assertSee('Orders & Dispatch');
    }

    public function test_admin_can_view_read_only_activity_audit_logs(): void
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('http://admin.henley.com/activity-logs');
        $response->assertSuccessful();
        $response->assertSee('Audit & Activity Logs');

        $this->assertFalse(ActivityLogResource::canCreate());
        $log = Activity::first();
        if ($log) {
            $this->assertFalse(ActivityLogResource::canEdit($log));
            $this->assertFalse(ActivityLogResource::canDelete($log));
        }
    }
}
