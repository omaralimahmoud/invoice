<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'openingBalance'=>$this->faker->numerify('#######'),
            'purchasedDate'=>now(),
            'supplier_id'=>Supplier::factory(),
            'item_id'=>Item::factory(),
            'quantity'=>$this->faker->numerify('#######'),
            'PurchasingBrice'=>$this->faker->numerify('#######'),
            'sellingBrice'=>$this->faker->numerify('#######'),
            'finalBriceEnd'=>$this->faker->numerify('#######'),
            'storehouseNotes'=>$this->faker->word(),
        ];
    }
}
