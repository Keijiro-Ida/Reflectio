<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reflection>
 */
class ReflectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quote' => $this->faker->sentence(),
            'response' => $this->faker->paragraph(),
            'user_id' => User::factory(), // Assuming you have a UserFactory
        ];
    }
}
