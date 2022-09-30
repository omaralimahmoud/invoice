<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReturnOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'user_id'=>User::factory(),
        'returnInvoiceType'=>$this->faker->word(),
        'returnNumberInvoice'=>$this->faker->numerify('########'),
        'returnCustomerType'=>$this->faker->word(),
         'returnCustomerCodeInvoice'=>$this->faker->numerify('########'),
         'returnCustomerNameInvoice'=>$this->faker->word(),
          'returnCustomerPhoneNumberInvoice'=>$this->faker->numerify('###########'),
          'returnDiscountBercentageInvoice'=>$this->faker->numerify('#'),
          'returnRemoveDecimal'=>$this->faker->numerify('#'),
          'returnNetInvoice'=>$this->faker->numerify('#####'),
          'returnTotalItems'=>$this->faker->numerify('#'),

        ];
    }
}
