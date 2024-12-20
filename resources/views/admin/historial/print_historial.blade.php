<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Clínico - {{ $patient->names }} {{ $patient->last_names }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4a5568;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 10px;
        }
        .company-info {
            margin-bottom: 15px;
        }
        .patient-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .patient-info h3 {
            margin: 0 0 10px 0;
            color: #2d3748;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .medical-history {
            margin-top: 20px;
        }
        .visit {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #e2e8f0;
            page-break-inside: avoid;
        }
        .visit-header {
            background-color: #f1f5f9;
            padding: 5px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            padding: 10px 0;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="header">
        @if($configuration && $configuration->logo)
            <img src="{{ public_path('storage/' . $configuration->logo) }}" alt="Logo" class="logo">
        @endif
        <div class="company-info">
            <h2>{{ $configuration->name ?? 'Centro Médico' }}</h2>
            <p>{{ $configuration->address ?? '' }}</p>
            <p>Tel: {{ $configuration->phone ?? '' }}</p>
        </div>
        <h1>Historial Clínico</h1>
    </div>

    <div class="patient-info">
        <h3>Información del Paciente</h3>
        <table>
            <tr>
                <th width="25%">Nombre Completo:</th>
                <td>{{ $patient->names }} {{ $patient->last_names }}</td>
                <th width="15%">CI:</th>
                <td>{{ $patient->ci }}</td>
            </tr>
            <tr>
                <th>Fecha de Nacimiento:</th>
                <td>{{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') : 'No registrada' }}</td>
                <th>Edad:</th>
                <td>{{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->age . ' años' : 'No registrada' }}</td>
            </tr>
            <tr>
                <th>Teléfono:</th>
                <td>{{ $patient->phone ?? 'No registrado' }}</td>
                <th>Email:</th>
                <td>{{ $patient->email ?? 'No registrado' }}</td>
            </tr>
            <tr>
                <th>Dirección:</th>
                <td colspan="3">{{ $patient->address ?? 'No registrada' }}</td>
            </tr>
        </table>
    </div>

    <div class="medical-history">
        <h3>Historial de Visitas Médicas</h3>
        @forelse($patient->historial->sortByDesc('visit_date') as $historial)
            <div class="visit">
                <div class="visit-header">
                    <strong>Fecha de Visita:</strong> {{ \Carbon\Carbon::parse($historial->visit_date)->format('d/m/Y H:i') }}
                    <br>
                    <strong>Doctor:</strong> {{ $historial->doctor->names }} {{ $historial->doctor->last_names }}
                    ({{ $historial->doctor->specialization }})
                </div>
                <div class="visit-detail">
                    <strong>Diagnóstico y Tratamiento:</strong>
                    <p style="white-space: pre-line;">{{ $historial->detail }}</p>
                </div>
            </div>
        @empty
            <p>No hay registros de visitas médicas.</p>
        @endforelse
    </div>

    <div class="footer">
        <p>Documento generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>Este es un documento confidencial y de uso exclusivo para el personal médico autorizado.</p>
    </div>
</body>
</html>