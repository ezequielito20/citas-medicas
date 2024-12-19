<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial de Operaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            font-size: 12px;
        }

        .table thead th {
            background-color: #d0e1f3;
            color: #2c3e50;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        .table tbody td {
            text-align: center;
            padding: 8px;
            border: 1px solid #dee2e6;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 10px;
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #dee2e6;
        }

        .page-title {
            color: #2c3e50;
            margin: 20px 0;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Encabezado con información de la empresa -->
    <table style="width: 100%; table-layout: fixed; border-collapse: collapse; font-size: 8px;">
        <tr>
            <td style="width: 20%; text-align: left; vertical-align: top;">
                {{ $configuration->name }} <br>
                {{ $configuration->address }} <br>
                {{ $configuration->phone }} <br>
                {{ $configuration->email }} <br>
            </td>
            <td style="width: 50%;"></td>
            <td style="width: 30%; text-align: right; vertical-align: top;">
                <img src="{{ 'storage/' . $configuration->logo }}" alt="logo" style="width: 50px;">
            </td>
        </tr>
    </table>

    <h1 class="page-title text-center">Reporte de Historial de Operaciones</h1>
    <div class="container">
        <!-- Información del Paciente -->
        <div class="card mb-4">
            <div style="background-color: #d0e1f3; padding: 8px; margin-bottom: 15px;">
                <h4 style="margin: 0; color: #2c3e50; font-size: 16px;">Información del Paciente</h4>
            </div>
            <table style="width: 100%; margin-bottom: 15px; font-size: 12px;">
                <tr>
                    <td style="width: 25%; padding: 5px; font-weight: bold;">Nombres:</td>
                    <td style="width: 25%; padding: 5px;">{{ $historial->patient->names }}</td>
                    <td style="width: 25%; padding: 5px; font-weight: bold;">Apellidos:</td>
                    <td style="width: 25%; padding: 5px;">{{ $historial->patient->last_names }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold;">CI:</td>
                    <td style="padding: 5px;">{{ $historial->patient->ci }}</td>
                    <td style="padding: 5px; font-weight: bold;">Teléfono:</td>
                    <td style="padding: 5px;">{{ $historial->patient->phone }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold;">Email:</td>
                    <td style="padding: 5px;">{{ $historial->patient->email }}</td>
                    <td style="padding: 5px; font-weight: bold;">Dirección:</td>
                    <td style="padding: 5px;">{{ $historial->patient->address }}</td>
                </tr>
            </table>
        </div>

        <!-- Información del Doctor -->
        <div class="card mb-4">
            <div style="background-color: #d0e1f3; padding: 8px; margin-bottom: 15px;">
                <h4 style="margin: 0; color: #2c3e50; font-size: 16px;">Información del Doctor</h4>
            </div>
            <table style="width: 100%; margin-bottom: 15px; font-size: 12px;">
                <tr>
                    <td style="width: 25%; padding: 5px; font-weight: bold;">Nombres:</td>
                    <td style="width: 25%; padding: 5px;">{{ $historial->doctor->names }}</td>
                    <td style="width: 25%; padding: 5px; font-weight: bold;">Apellidos:</td>
                    <td style="width: 25%; padding: 5px;">{{ $historial->doctor->last_names }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold;">Especialidad:</td>
                    <td style="padding: 5px;">{{ $historial->doctor->specialization }}</td>
                    <td style="padding: 5px; font-weight: bold;">Teléfono:</td>
                    <td style="padding: 5px;">{{ $historial->doctor->phone }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold;">Email:</td>
                    <td colspan="3" style="padding: 5px;">{{ $historial->doctor->user->email }}</td>
                </tr>
            </table>
        </div>

        <!-- Información del Diagnóstico -->
        <div class="card">
            <div style="background-color: #d0e1f3; padding: 8px; margin-bottom: 15px;">
                <h4 style="margin: 0; color: #2c3e50; font-size: 16px;">Detalles de la Consulta Médica</h4>
            </div>
            <table style="width: 100%; margin-bottom: 15px; font-size: 12px;">
                <tr>
                    <td style="width: 25%; padding: 5px; font-weight: bold;">Fecha de Visita:</td>
                    <td style="width: 75%; padding: 5px;">
                        {{ \Carbon\Carbon::parse($historial->visit_date)->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold;">Diagnóstico:</td>
                    <td style="padding: 5px;">
                        <div style="border: 1px solid #dee2e6; padding: 10px; background-color: #f8f9fa;">
                            {{ $historial->detail }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        <table style="width: 100%; font-size: 9px;">
            <tr>
                <td style="text-align: left;">
                    Fecha de impresión: {{ now()->format('d/m/Y') }}
                </td>
                <td style="text-align: center;">
                    Hora de impresión: {{ now()->format('H:i:s') }}
                </td>
                <td style="text-align: right;">
                    Página 1
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
