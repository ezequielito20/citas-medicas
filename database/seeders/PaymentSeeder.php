<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos los IDs existentes de doctores y pacientes
        $doctorIds = Doctor::pluck('id')->toArray();
        $patientIds = Patient::pluck('id')->toArray();

        // Descripciones comunes de pagos médicos
        $descriptions = [
            'Consulta general',
            'Consulta de seguimiento',
            'Procedimiento médico',
            'Examen de rutina',
            'Tratamiento especializado',
            'Control mensual',
            'Emergencia médica',
            'Consulta especializada',
            'Revisión post-operatoria',
            'Terapia de rehabilitación'
        ];

        // Crear 200 pagos
        for ($i = 0; $i < 200; $i++) {
            Payment::create([
                'patient_id' => $patientIds[array_rand($patientIds)],
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'amount' => rand(2000, 50000) / 100, // Genera montos entre $20 y $500
                'payment_date' => Carbon::now()->subDays(rand(0, 365)), // Pagos en el último año
                'description' => $descriptions[array_rand($descriptions)]
            ]);
        }
    }
}
