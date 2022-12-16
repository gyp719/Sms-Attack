<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SmsTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sms_templates')->delete();
        
        \DB::table('sms_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sign_name' => '省心科技-加油卡短信',
                'url' => 'https://life-api.cars.shengxintech.com/api/verification/mobile/send',
                'method' => 'GET',
                'request_option' => 'multipart',
                'options' => '[]',
                'status' => 1,
                'source' => 'h5',
                'source_url' => NULL,
                'source_image' => 'images/400x400.jpeg',
                'created_at' => '2022-12-13 09:32:05',
                'updated_at' => '2022-12-14 22:54:17',
            ),
            1 => 
            array (
                'id' => 3,
                'sign_name' => '12312',
                'url' => 'https://www.baidu.com',
                'method' => 'POST',
                'request_option' => 'form_params',
                'options' => '',
                'status' => 2,
                'source' => 'web',
                'source_url' => '',
                'source_image' => '',
                'created_at' => '2022-12-13 23:16:05',
                'updated_at' => '2022-12-13 23:17:12',
            ),
            2 => 
            array (
                'id' => 4,
                'sign_name' => '加油',
                'url' => 'https://learnku.com/laravel',
                'method' => 'GET',
                'request_option' => 'multipart',
                'options' => '',
                'status' => 1,
                'source' => 'web',
                'source_url' => '',
                'source_image' => '',
                'created_at' => '2022-12-13 23:21:16',
                'updated_at' => '2022-12-13 23:21:16',
            ),
            3 => 
            array (
                'id' => 5,
                'sign_name' => '加油',
                'url' => 'https://learnku.com/laravel',
                'method' => 'POST',
                'request_option' => 'form_params',
                'options' => '',
                'status' => 1,
                'source' => 'web',
                'source_url' => '',
                'source_image' => '',
                'created_at' => '2022-12-13 23:31:06',
                'updated_at' => '2022-12-13 23:31:06',
            ),
            4 => 
            array (
                'id' => 6,
                'sign_name' => '加油',
                'url' => 'https://learnku.com/laravel',
                'method' => 'POST',
                'request_option' => 'form_params',
                'options' => '{"address":"phone"}',
                'status' => 1,
                'source' => 'web',
                'source_url' => '',
                'source_image' => '',
                'created_at' => '2022-12-13 23:47:59',
                'updated_at' => '2022-12-13 23:47:59',
            ),
        ));
        
        
    }
}