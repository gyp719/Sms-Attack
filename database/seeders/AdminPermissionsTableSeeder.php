<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_permissions')->delete();
        
        \DB::table('admin_permissions')->insert(array (
            0 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'http_method' => '',
                'http_path' => '',
                'id' => 1,
                'name' => 'Auth management',
                'order' => 1,
                'parent_id' => 0,
                'slug' => 'auth-management',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'http_method' => '',
                'http_path' => '/auth/users*',
                'id' => 2,
                'name' => 'Users',
                'order' => 2,
                'parent_id' => 1,
                'slug' => 'users',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'http_method' => '',
                'http_path' => '/auth/roles*',
                'id' => 3,
                'name' => 'Roles',
                'order' => 3,
                'parent_id' => 1,
                'slug' => 'roles',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'http_method' => '',
                'http_path' => '/auth/permissions*',
                'id' => 4,
                'name' => 'Permissions',
                'order' => 4,
                'parent_id' => 1,
                'slug' => 'permissions',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'http_method' => '',
                'http_path' => '/auth/menu*',
                'id' => 5,
                'name' => 'Menu',
                'order' => 5,
                'parent_id' => 1,
                'slug' => 'menu',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'http_method' => '',
                'http_path' => '/auth/extensions*',
                'id' => 6,
                'name' => 'Extension',
                'order' => 6,
                'parent_id' => 1,
                'slug' => 'extension',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}