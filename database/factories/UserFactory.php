<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'username' => fake()->userName(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => fake()->password(),
            'verified' => fake()->boolean(),
            'created_at' => fake()->dateTime(),
            'last_activity' => fake()->dateTime(),
            'status' => fake()->numberBetween(-10000, 10000),
            'photo_profile' => fake()->word(),
        ];
    }
}
