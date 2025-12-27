<?php

namespace Database\Factories;

use App\Models\Bar;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecommendationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => Bar::factory(),
        ];
    }
}
