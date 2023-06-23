<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'    => $this->faker->numberBetween(1, 5),
            'product_id' => $this->faker->numberBetween(1, 5),
            'date'       => $this->faker->date(),
            'quantity'   => $this->faker->randomNumber(3),
        ];
    }
}
