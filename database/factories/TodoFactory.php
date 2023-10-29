<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(3),
            "completed" => 0
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            "completed" => 1
        ]);
    }
}
