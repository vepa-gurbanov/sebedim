<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = Location::whereHas('parent')
            ->with('parent')
            ->inRandomOrder()
            ->first();
        return [
            'location_id' => $location->id,
            'name' => $this->faker->name . ' Warehouse, ' . $location->parent->name,
        ];
    }
}
