<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'product_name' => fake()->name(),
            'description' => fake()->paragraph(4),
            'price' => $this->faker->numberBetween(500, 12000),
            'quantity' =>$this->faker->numberBetween(1, 100),
            'weight' => $this->faker->numberBetween(1, 12),
            'category_id' => Category::factory(),
            'admin_id' => Admin::factory(),
        ];
    }
}
