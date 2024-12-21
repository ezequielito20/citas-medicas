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
            'name' => 'Consultorio-' . fake()->unique()->numberBetween(1, 100),
            'address' => fake()->address(),
            'capacity' => fake()->numberBetween(5, 20) . ' personas',
            'phone' => fake()->phoneNumber(),
            'specialization' => fake()->randomElement(['Cardiología', 'Pediatría', 'Dermatología', 'Neurología', 'Ginecología', 'Oftalmología', 'Traumatología', 'Psiquiatría', 'Odontología', 'Medicina General']),
            'status' => fake()->randomElement(['activo', 'inactivo'])
        ];
    }
}
