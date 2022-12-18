<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRoleUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_role_users')->delete();
        
        \DB::table('admin_role_users')->insert(array (
            0 => 
            array (
                'created_at' => '2022-12-13 06:36:59',
                'role_id' => 1,
                'updated_at' => '2022-12-13 06:36:59',
                'user_id' => 1,
            ),
        ));
        
        
    }
}