<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Doctor;
use App\Models\Office;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos los IDs existentes
        $userIds = User::pluck('id')->toArray();
        $doctorIds = Doctor::pluck('id')->toArray();
        $officeIds = Office::pluck('id')->toArray();

        // Títulos comunes para citas médicas
        $titles = [
            'Consulta general',
            'Revisión rutinaria',
            'Control médico',
            'Cita de seguimiento',
            'Primera consulta',
            'Emergencia',
            'Chequeo anual',
            'Valoración médica',
            'Consulta especializada',
            'Revisión post-tratamiento'
        ];

        // Colores para los eventos
        $colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];

        // Crear 100 eventos
        for ($i = 0; $i < 100; $i++) {
            // Generar fecha aleatoria en los próximos 30 días
            $startDate = Carbon::now()->addDays(rand(0, 30));
            // La cita dura entre 30 minutos y 2 horas
            $endDate = clone $startDate;
            $endDate->addMinutes(rand(30, 120));

            Event::create([
                'title' => $titles[array_rand($titles)],
                'start' => $startDate,
                'end' => $endDate,
                'color' => $colors[array_rand($colors)],
                'user_id' => $userIds[array_rand($userIds)],
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'office_id' => $officeIds[array_rand($officeIds)]
            ]);
        }
    }
}
