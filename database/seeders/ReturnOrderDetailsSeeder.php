<?php

namespace Database\Seeders;

use App\Models\ReturnOrderDetails;
use Illuminate\Database\Seeder;

class ReturnOrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         ReturnOrderDetails::factory(10)->create();
    }
}
