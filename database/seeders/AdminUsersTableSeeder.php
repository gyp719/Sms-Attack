<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$pMjB.01lbuiz4R1odOCQGugnNjl/zy9b3iTYzuKpghVM9TAYCosN.',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => 'ipjRcnL4y4hLZP0hrNAQm0iEMpKoVeJgDpOSwUQpnkCbI0OawaDTPalQc1Bc',
                'created_at' => '2022-12-13 06:36:59',
                'updated_at' => '2022-12-13 06:36:59',
            ),
        ));
        
        
    }
}