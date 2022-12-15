<?php

namespace Database\Seeders;

use App\Models\AttackUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttackUserTableSeeder extends Seeder
{
    public function run()
    {
        AttackUser::factory()->count(1000)->create();
    }
}
