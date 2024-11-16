<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\PatientFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        User::factory()->create([
            'name' => 'Secretaria',
            'email' => 'secretaria@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        User::factory()->create([
            'name' => 'Doctor1',
            'email' => 'doctor1@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        User::factory()->create([
            'name' => 'Paciente1',
            'email' => 'paciente1@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        PatientFactory::times(200)->create();

        
    }
}
