<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'location' => fake()->word(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'description' => fake()->text(),
            'image' => fake()->word(),
            'logo' => fake()->word(),
            'mail' => fake()->word(),
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
