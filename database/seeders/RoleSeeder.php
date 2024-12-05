<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //------------------------ seeders para roles y permisos ----------------------------------
        //----- Admin, Secretaria, Doctor, Paciente, Usuario --------------------------------------
        $admin = Role::create(['name' => 'admin']);
        $secretary = Role::create(['name' => 'secretary']);
        $doctor = Role::create(['name' => 'doctor']);
        $patient = Role::create(['name' => 'patient']);
        $user = Role::create(['name' => 'user']);

        // Permission::create(['name' => 'admin.index'])->syncRoles([$admin]);

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
        Permission::create(['name' => 'admin.patients.index'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.patients.create'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.patients.store'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.patients.show'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.patients.edit'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.patients.update'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.patients.destroy'])->syncRoles([$admin, $secretary]);

        //------Rutas para el admin Offices ------------------
        Permission::create(['name' => 'admin.offices.index'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.offices.create'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.offices.store'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.offices.show'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.offices.edit'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.offices.update'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.offices.destroy'])->syncRoles([$admin, $secretary]);

        //------Rutas para el admin Doctors ------------------
        Permission::create(['name' => 'admin.doctors.index'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.doctors.create'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.doctors.store'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.doctors.show'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.doctors.edit'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.doctors.update'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.doctors.destroy'])->syncRoles([$admin, $secretary]);

        //------Rutas para el admin Hours ------------------
        Permission::create(['name' => 'admin.hours.index'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.hours.create'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.hours.store'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.hours.show'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.hours.edit'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.hours.update'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.hours.destroy'])->syncRoles([$admin, $secretary]);
        //ajax
        Permission::create(['name' => 'admin.hours.offices_data'])->syncRoles([$admin, $secretary]);

        //------Rutas para el admin Users ------------------
        Permission::create(['name' => 'offices_data'])->syncRoles([$admin, $user]);
        Permission::create(['name' => 'doctors_reservations'])->syncRoles([$admin, $user]);
        Permission::create(['name' => 'admin.see_reservations'])->syncRoles([$admin, $user]);
        Permission::create(['name' => 'admin.events.store'])->syncRoles([$admin, $user]);
        Permission::create(['name' => 'admin.events.destroy'])->syncRoles([$admin, $user]);

        //------Rutas para el admin Configurations ------------------
        Permission::create(['name' => 'admin.Configurations.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.Configurations.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.Configurations.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.Configurations.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.Configurations.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.Configurations.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.Configurations.destroy'])->syncRoles([$admin]);
    }
}
