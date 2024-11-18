<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Secretary>
 */
class SecretaryFactory extends Factory
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
            'phone' => $this->faker->phoneNumber(),
            'birthdate' => $this->faker->date(),
            'address' => $this->faker->address(),
            'user_id' => User::inRandomOrder()->first()->id,


        ];
    }
}
