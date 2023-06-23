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
            // 'id'          => $this->faker->numberBetween(1, 5),
            'name'        => $this->faker->name(),
            'description' => $this->faker->text(100),
            'price'       => $this->faker->randomNumber(5),
        ];
    }
}
