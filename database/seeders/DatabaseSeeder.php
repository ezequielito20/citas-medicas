<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\HourFactory;
use Illuminate\Support\Facades\Hash;
use Database\Factories\DoctorFactory;
use Database\Factories\OfficeFactory;
use Database\Factories\PatientFactory;
use Database\Factories\SecretaryFactory;
use Spatie\Permission\Models\Permission;
use Database\Seeders\ConfigurationSeeder;
use Database\Seeders\HistorialSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Secretaria',
            'email' => 'secretaria@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('secretary');

        User::factory()->create([
            'name' => 'Doctor1',
            'email' => 'doctor1@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('doctor');

        User::factory()->create([
            'name' => 'Paciente1',
            'email' => 'paciente1@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('patient');

        User::factory()->create([
            'name' => 'Usuario1',
            'email' => 'usuario1@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('user');

        PatientFactory::times(200)->create()->each(function ($user) {
            $user->assignRole('patient');
        });
        SecretaryFactory::times(10)->create();
        OfficeFactory::times(20)->create();
        DoctorFactory::times(12)->create();
        HourFactory::times(25)->create();

        $this->call([
            ConfigurationSeeder::class,
            PaymentSeeder::class,
            EventSeeder::class,
            HistorialSeeder::class,
        ]);

        





        
    }
}
