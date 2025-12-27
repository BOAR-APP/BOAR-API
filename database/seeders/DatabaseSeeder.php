<?php

namespace Database\Seeders;

use App\Models\ConsumableType;
use App\Models\Recommendation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        ConsumableType::factory()->count(50)->create();
        ConsumableType::factory()->count(10)->create();
        Recommendation::factory()->count(15)->create();
        Review::factory()->count(100)->create();
    }
}
