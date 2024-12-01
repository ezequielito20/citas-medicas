<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Office>
 */
class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'capacity' => $this->faker->numberBetween(1, 20),
            'phone' => $this->faker->phoneNumber(),
            'specialization' => $this->faker->word(),
            'status' => $this->faker->randomElement(['activo', 'inactivo'])
        ];
    }
}
