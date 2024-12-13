<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Reporte de Reservaciones</title>
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

        .company-info {
            margin-bottom: 15px;
            font-size: 12px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .page-title {
            color: #2c3e50;
            margin: 20px 0;
            font-size: 24px;
            font-weight: bold;
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
    </style>
</head>

<body>
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

    <h1 class="page-title text-center">Reporte de Reservaciones</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha y Hora</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Consultorio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->start)->format('d/m/Y H:i') }}</td>
                    <td>{{ $event->user->name }}</td>
                    <td>{{ $event->doctor->names }} {{ $event->doctor->last_names }}</td>
                    <td>{{ $event->office->name }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($event->start)->isFuture() ? 'Próxima' : 'Realizada' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
