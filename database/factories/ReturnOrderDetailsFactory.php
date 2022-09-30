<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ReturnOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReturnOrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'return_orders_id'=>ReturnOrder::factory(),
            'item_id'=>Item::factory(),
            'returnQuantityInvoice'=>$this->faker->numerify('##'),
             'returnUnitSaleBriceInvoice'=>$this->faker->numerify('##'),
             'returnNotesInvoice'=>$this->faker->word(),
        ];
    }
}
