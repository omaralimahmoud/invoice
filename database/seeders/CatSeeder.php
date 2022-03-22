<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Item;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cat::factory()->has(
            Item::factory()->count(5)
        )-> count(5)->create();
    }
}
