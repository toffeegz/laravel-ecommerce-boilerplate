<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {

        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'is_available' => true,
            'price' => $this->faker->randomFloat(2, 10, 200), 
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
