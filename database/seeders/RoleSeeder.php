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
        //Reportes
        Permission::create(['name' => 'admin.doctors.reports'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.doctors.pdf'])->syncRoles([$admin, $secretary]);

        //Reportes de reservaciones
        Permission::create(['name' => 'admin.reservations.reports'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.reservations.pdf'])->syncRoles([$admin]);

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
        Permission::create(['name' => 'admin.configurations.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configurations.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configurations.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configurations.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configurations.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configurations.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configurations.destroy'])->syncRoles([$admin]);

        //------Rutas para el admin Historial ------------------
        Permission::create(['name' => 'admin.historial.index'])->syncRoles([$admin, $doctor]);
        Permission::create(['name' => 'admin.historial.create'])->syncRoles([$admin, $doctor]);
        Permission::create(['name' => 'admin.historial.store'])->syncRoles([$admin, $doctor]);
        Permission::create(['name' => 'admin.historial.show'])->syncRoles([$admin, $doctor]);
        Permission::create(['name' => 'admin.historial.edit'])->syncRoles([$admin, $doctor]);
        Permission::create(['name' => 'admin.historial.update'])->syncRoles([$admin, $doctor]);
        Permission::create(['name' => 'admin.historial.destroy'])->syncRoles([$admin, $doctor]); 
        Permission::create(['name' => 'admin.historial.print_historial'])->syncRoles([$admin, $doctor]);
        Permission::create(['name' => 'admin.historial.search_patient'])->syncRoles([$admin, $doctor]);
        //Reportes
        Permission::create(['name' => 'admin.historial.pdf'])->syncRoles([$admin, $doctor]);

        // Permisos para pagos
        Permission::create(['name' => 'admin.payments.index'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.payments.create'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.payments.store'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.payments.show'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.payments.edit'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.payments.update'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.payments.destroy'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.payments.pdf'])->syncRoles([$admin, $secretary]);
        Permission::create(['name' => 'admin.payments.reports'])->syncRoles([$admin, $secretary]);
    }
}
