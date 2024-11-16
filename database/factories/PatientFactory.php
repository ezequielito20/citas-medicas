<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'names' => $this->faker->name(),
            'last_names' => $this->faker->lastName(),
            'ci' => $this->faker->unique()->randomNumber(9),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'allergies' => $this->faker->sentence(),
            'emergency_contact' => $this->faker->email(),
            'health_insurance_number' => $this->faker->unique()->randomNumber(9),
            'observations' => $this->faker->sentence(),
            'address' => $this->faker->address(),

        ];
    }
}
