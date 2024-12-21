<?php

namespace Database\Seeders;

use App\Models\Historial;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HistorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos los IDs existentes
        $doctorIds = Doctor::pluck('id')->toArray();
        $patientIds = Patient::pluck('id')->toArray();

        // Array de posibles diagnósticos y detalles médicos
        $diagnostics = [
            'Paciente presenta síntomas de gripe común. Se receta acetaminofén y reposo.',
            'Control rutinario. Signos vitales normales. Se recomienda mantener hábitos saludables.',
            'Dolor muscular en zona lumbar. Se prescribe antiinflamatorios y terapia física.',
            'Consulta por migraña. Se ajusta medicación actual y se solicitan exámenes.',
            'Revisión post-operatoria. Evolución favorable, herida cicatrizando correctamente.',
            'Presión arterial elevada. Se ajusta medicación y se recomienda dieta baja en sodio.',
            'Infección respiratoria leve. Se prescribe antibiótico por 7 días.',
            'Control de diabetes. Niveles de glucosa estables. Continuar con tratamiento actual.',
            'Alergia estacional. Se receta antihistamínicos y spray nasal.',
            'Dolor abdominal. Se solicitan exámenes de laboratorio y ecografía.',
            'Ansiedad y problemas de sueño. Se recomienda terapia y ejercicios de relajación.',
            'Control de peso. Se ajusta plan alimenticio y se recomienda actividad física.',
            'Problemas digestivos. Se prescribe protector gástrico y dieta blanda.',
            'Revisión cardiológica. ECG normal. Mantener medicación actual.',
            'Dolor articular. Se recomienda fisioterapia y antiinflamatorios.'
        ];

        // Crear 500 historiales
        for ($i = 0; $i < 500; $i++) {
            // Generar fecha aleatoria en el último año
            $visitDate = Carbon::now()->subDays(rand(0, 365))->subHours(rand(0, 24));

            // Combinar diagnósticos aleatorios para crear detalles más extensos
            $detail = $diagnostics[array_rand($diagnostics)] . "\n\n";
            $detail .= "Observaciones adicionales: " . $diagnostics[array_rand($diagnostics)];

            Historial::create([
                'detail' => $detail,
                'visit_date' => $visitDate,
                'patient_id' => $patientIds[array_rand($patientIds)],
                'doctor_id' => $doctorIds[array_rand($doctorIds)]
            ]);
        }
    }
}
