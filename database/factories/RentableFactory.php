<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rentable>
 */
class RentableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-1 year');

        return [
            'rentable_name' => fake()->unique()->words(3, true),
            'rentable_type' => fake()->unique()->words(1, true),
            'total_number' => fake()->unique()->randomNumber(5),
            'image' => fake()->imageUrl,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
