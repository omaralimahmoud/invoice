<?php

namespace Database\Factories;

use App\Models\Cat;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model=Cat::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'storeCode'=>$this->faker->numerify('#######'),
            'StoreName'=>$this->faker->word(),
            'Notes'=>$this->faker->word(),
        ];
    }
}
