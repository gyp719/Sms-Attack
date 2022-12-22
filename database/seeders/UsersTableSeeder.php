<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'created_at' => '2022-12-18 23:55:00',
                'id' => 1,
                'identity' => NULL,
                'name' => NULL,
                'phone' => '15172441219',
                'updated_at' => '2022-12-18 23:55:00',
            ),
            1 => 
            array (
                'created_at' => '2022-12-22 20:51:21',
                'id' => 2,
                'identity' => NULL,
                'name' => NULL,
                'phone' => '17046920175',
                'updated_at' => '2022-12-22 20:51:21',
            ),
        ));
        
        
    }
}