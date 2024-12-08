<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();

        return [
            'product_id' => $product->id,
            'user_id' => User::factory(),
            'quantity' => fake()->numberBetween(1, 100),
            'price' => $product->price,
            'created_date' => fake()->dateTimeThisYear()
        ];
    }
}
