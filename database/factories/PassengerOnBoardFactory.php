<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PassengerOnBoard>
 */
class PassengerOnBoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 20),
            'vessel_id' => fake()->numberBetween(1, 10),
            'operator_id' => fake()->numberBetween(1, 10),
            'no_of_passengers' => fake()->numberBetween(1, 30)
        ];
    }
}
