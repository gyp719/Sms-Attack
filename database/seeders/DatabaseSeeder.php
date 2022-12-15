<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AdminRolesTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminRoleUsersTableSeeder::class);
        $this->call(AdminRolePermissionsTableSeeder::class);
        $this->call(AdminRoleMenuTableSeeder::class);
        $this->call(AdminPermissionMenuTableSeeder::class);
        $this->call(AdminSettingsTableSeeder::class);
        $this->call(AdminExtensionsTableSeeder::class);
        $this->call(AdminExtensionHistoriesTableSeeder::class);

        $this->call(AttackUserTableSeeder::class);

    }
}
