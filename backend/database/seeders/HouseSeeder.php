<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\House\House::factory()->count(30)->create();
    }
}
