<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customer = $this->faker->boolean(40) ? Customer::inRandomOrder()->first() : null;
        $product = Product::inRandomOrder()->first();
        $reviewer = $customer ? $customer->name : $this->faker->firstName();
        return [
            'customer_id' => $customer ? $customer->id : null,
            'product_id' => $product->id,
            'reviewer' => $reviewer,
            'content' => $this->faker->realText(rand(100, 200)),
        ];
    }
}
