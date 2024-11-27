<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Database\Factories\PatientFactory;
use Database\Factories\SecretaryFactory;
use Spatie\Permission\Models\Permission;

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

        User::factory()->create([
            'name' => 'Usuario1',
            'email' => 'usuario1@gmail.com',
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

        //-------Rutas para el admin Users -------------------
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$admin]);

        //-------Rutas para el admin Secretaries -----------------
        Permission::create(['name' => 'admin.secretaries.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretaries.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretaries.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretaries.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretaries.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretaries.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretaries.destroy'])->syncRoles([$admin]);

        //------Rutas para el admin Patients ------------------
        Permission::create(['name' => 'admin.patients.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.patients.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.patients.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.patients.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.patients.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.patients.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.patients.destroy'])->syncRoles([$admin]);

        //------Rutas para el admin Offices ------------------
        Permission::create(['name' => 'admin.offices.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.offices.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.offices.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.offices.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.offices.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.offices.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.offices.destroy'])->syncRoles([$admin]);

        //------Rutas para el admin Doctors ------------------
        Permission::create(['name' => 'admin.doctors.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctors.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctors.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctors.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctors.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctors.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.doctors.destroy'])->syncRoles([$admin]);

        //------Rutas para el admin Hours ------------------
        Permission::create(['name' => 'admin.hours.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.hours.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.hours.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.hours.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.hours.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.hours.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.hours.destroy'])->syncRoles([$admin]);




        
    }
}
