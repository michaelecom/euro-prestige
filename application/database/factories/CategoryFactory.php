<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'property' => $this->faker->randomElements($array = array('a', 'b', 'c', 'd', 'e'), $count = rand(1, 5))
        ];
    }
}
