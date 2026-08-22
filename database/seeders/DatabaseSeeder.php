<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default Spatie roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $vendorRole = Role::firstOrCreate(['name' => 'vendor', 'guard_name' => 'web']);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        // Seed primary Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@henleytea.com'],
            [
                'name' => 'Henley Master Curator',
                'phone' => '+919876543210',
                'password' => Hash::make('password'),
                'role' => UserRole::SUPER_ADMIN,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        // Seed demo Vendor Partner
        $vendor = User::firstOrCreate(
            ['email' => 'estates@henleytea.com'],
            [
                'name' => 'Darjeeling Bio Estate Partner',
                'phone' => '+919876543211',
                'password' => Hash::make('password'),
                'role' => UserRole::VENDOR,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $vendor->assignRole($vendorRole);

        // Seed demo Customer
        $customer = User::firstOrCreate(
            ['email' => 'collector@henleytea.com'],
            [
                'name' => 'Alistair Vance',
                'phone' => '+919876543212',
                'password' => Hash::make('password'),
                'role' => UserRole::CUSTOMER,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $customer->assignRole($customerRole);
    }
}
