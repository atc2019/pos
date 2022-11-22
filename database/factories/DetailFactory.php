<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sale_id' => 1,
            'product_id' =>$this->faker->numberBetween(22, 32),
            'quantity' =>$this->faker->numberBetween(2, 5),
            'price' =>$this->faker->numberBetween([10, 20, 30]),
        ];
    }
}
