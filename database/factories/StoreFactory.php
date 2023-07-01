<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $warehouse = Warehouse::with('location')
            ->inRandomOrder()
            ->first();
        return [
            'warehouse_id' => $warehouse->id,
            'name' => $this->faker->name . ' Store, ' . $warehouse->name,
            'location' => $warehouse->location->name,
        ];
    }
}
