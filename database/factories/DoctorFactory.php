<?php

namespace Database\Factories;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
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
            'phone' => $this->faker->phoneNumber(),
            'medical_leave' => $this->faker->sentence(4),
            'specialization' => $this->faker->word(),
            'user_id' => User::inRandomOrder()->first()->id,
            'office_id' => Office::inRandomOrder()->first()->id,

            
        ];
    }
}
