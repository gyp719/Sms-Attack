<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Faker\Factory as Faker;

class AttackUserFactory extends Factory
{
    #[ArrayShape(['phone' => "string"])]
    public function definition(): array
    {
        return [
            'phone' => fake()->phoneNumber(),
        ];
    }
}
