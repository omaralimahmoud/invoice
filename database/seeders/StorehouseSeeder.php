<?php

namespace Database\Seeders;

use App\Models\Storehouse;
use Illuminate\Database\Seeder;

class StorehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storehouse::factory(10)->create();
    }
}
