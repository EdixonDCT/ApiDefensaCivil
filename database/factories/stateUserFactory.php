<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class stateUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'state' => fake()->name()
        ];
    }
}
