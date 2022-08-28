<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'provider_id' => fake()->numberBetween(1, 10),
            'name' => fake()->text(30),
            'stock' => fake()->numberBetween(0, 100),
            'sale_price' => fake()->randomFloat(2, 100, 500),
            'purchase_price' => fake()->randomFloat(2, 10, 100),
            'description' => implode( '<br/>', fake()->paragraphs()),
        ];
    }
}
