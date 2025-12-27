<?php

namespace Database\Seeders;

use App\Models\ConsumableType;
use Illuminate\Database\Seeder;

class ConsumableTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConsumableType::factory()->count(5)->create();
    }
}
