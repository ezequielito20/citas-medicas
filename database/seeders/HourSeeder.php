<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activeOffices = \App\Models\Office::where('status', 'activo')->get();
        $doctors = \App\Models\Doctor::all();
        $days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];

        foreach ($activeOffices as $office) {
            foreach ($doctors as $doctor) {
                // Asignar horarios aleatorios para cada doctor en consultorios activos
                $randomDay = $days[array_rand($days)];
                
                \App\Models\Hour::create([
                    'day' => $randomDay,
                    'start_time' => '08:00:00',
                    'end_time' => '12:00:00',
                    'doctor_id' => $doctor->id,
                    'office_id' => $office->id
                ]);

                // Crear otro horario para el mismo doctor en la tarde
                $randomDay = $days[array_rand($days)]; 
                \App\Models\Hour::create([
                    'day' => $randomDay,
                    'start_time' => '14:00:00', 
                    'end_time' => '18:00:00',
                    'doctor_id' => $doctor->id,
                    'office_id' => $office->id
                ]);
            }
        }
    }
}
