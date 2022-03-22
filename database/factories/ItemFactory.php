<?php

namespace Database\Factories;

use App\Models\Cat;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{

 /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */


    protected $model=Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'itemProductCode'=>$this->faker->numerify('#######'),
            'itemProductName'=>$this->faker->word(),
            'itemUnitProductCode'=>$this->faker->numerify('#######'),
            'itemOnlyProduct'=>$this->faker->word(),
            'itemProductNotes'=>$this->faker->word(),
            'cat_id'=>Cat::factory(),
        ];
    }
}
