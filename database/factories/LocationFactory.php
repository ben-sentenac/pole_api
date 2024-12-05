<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->sentence(rand(1,3)),
            "address" => fake()->address(),
            "coordinates" => json_encode(["lat" => rand(-900000,900000) / 10000,
            "lon" => rand(-1800000,1800000) / 10000])
        ];
    }
}
