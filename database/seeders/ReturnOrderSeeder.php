<?php

namespace Database\Seeders;

use App\Models\ReturnOrder;
use Illuminate\Database\Seeder;

class ReturnOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReturnOrder::factory(10)->create();
    }
}
