<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'extension' => '',
                'icon' => 'feather icon-bar-chart-2',
                'id' => 1,
                'order' => 1,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Index',
                'updated_at' => NULL,
                'uri' => '/',
            ),
            1 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'extension' => '',
                'icon' => 'feather icon-settings',
                'id' => 2,
                'order' => 2,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Admin',
                'updated_at' => NULL,
                'uri' => '',
            ),
            2 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'extension' => '',
                'icon' => '',
                'id' => 3,
                'order' => 3,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Users',
                'updated_at' => NULL,
                'uri' => 'auth/users',
            ),
            3 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'extension' => '',
                'icon' => '',
                'id' => 4,
                'order' => 4,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Roles',
                'updated_at' => NULL,
                'uri' => 'auth/roles',
            ),
            4 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'extension' => '',
                'icon' => '',
                'id' => 5,
                'order' => 5,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Permission',
                'updated_at' => NULL,
                'uri' => 'auth/permissions',
            ),
            5 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'extension' => '',
                'icon' => '',
                'id' => 6,
                'order' => 6,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Menu',
                'updated_at' => NULL,
                'uri' => 'auth/menu',
            ),
            6 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'extension' => '',
                'icon' => '',
                'id' => 7,
                'order' => 7,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Extensions',
                'updated_at' => NULL,
                'uri' => 'auth/extensions',
            ),
            7 => 
            array (
                'created_at' => '2022-12-13 07:29:11',
                'extension' => '',
                'icon' => 'fa-phone-square',
                'id' => 8,
                'order' => 8,
                'parent_id' => 0,
                'show' => 1,
                'title' => '短信模版',
                'updated_at' => '2022-12-13 07:29:11',
                'uri' => '/sms_templates',
            ),
            8 => 
            array (
                'created_at' => '2022-12-13 22:36:35',
                'extension' => '',
                'icon' => 'fa-user-circle-o',
                'id' => 9,
                'order' => 9,
                'parent_id' => 0,
                'show' => 1,
                'title' => '用户列表',
                'updated_at' => '2022-12-13 22:36:35',
                'uri' => '/users',
            ),
            9 => 
            array (
                'created_at' => '2022-12-18 17:40:44',
                'extension' => '',
                'icon' => 'fa-comments',
                'id' => 10,
                'order' => 10,
                'parent_id' => 0,
                'show' => 1,
                'title' => '短信日志',
                'updated_at' => '2022-12-18 17:40:44',
                'uri' => '/sms_logs',
            ),
        ));
        
        
    }
}