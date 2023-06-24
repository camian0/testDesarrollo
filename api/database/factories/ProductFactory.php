<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = ['Male', 'Female'];
        return [
            'name'        => $this->faker->firstName($gender[$this->faker->numberBetween(0, 1)]),
            'description' => $this->faker->text(100),
            'price'       => $this->faker->randomNumber(5),
        ];
    }
}
