<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Database\Factories\PatientFactory;
use Database\Factories\SecretaryFactory;

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
        SecretaryFactory::times(10)->create();

        //------------------------ seeders para roles y permisos ----------------------------------
        //----- Admin, Secretaria, Doctor, Paciente, Usuario --------------------------------------
        $admin = Role::create(['name' => 'admin']);
        $secretary = Role::create(['name' => 'secretary']);
        $doctor = Role::create(['name' => 'doctor']);
        $patient = Role::create(['name' => 'patient']);
        $user = Role::create(['name' => 'user']);


        
    }
}
