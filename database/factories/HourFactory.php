<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hour>
 */
class HourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => $this->faker->randomElement(['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo']),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'doctor_id' => Doctor::inRandomOrder()->first()->id,
            'office_id' => Office::inRandomOrder()->first()->id,
        ];
    }
}
