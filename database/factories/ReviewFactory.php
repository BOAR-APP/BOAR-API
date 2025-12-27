<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'rate' => fake()->numberBetween(-10000, 10000),
            'comment' => fake()->word(),
        ];
    }
}
