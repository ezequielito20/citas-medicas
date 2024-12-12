<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Listado de Médicos</title>
    <style>
        body { font-family: Arial, sans-serif; }
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
    </style>
</head>
<body>
    <table style="width: 100%; table-layout: fixed; border-collapse: collapse; font-size: 8px;">
        <tr>
            <!-- Encabezado -->
            <td style="width: 20%; text-align: left; vertical-align: top;">
                {{ $configuration->name }} <br>
                {{ $configuration->address }} <br>
                {{ $configuration->phone }} <br>
                {{ $configuration->email }} <br>
            </td>
            <!-- Espacio en blanco entre las dos columnas -->
            <td style="width: 50%;"></td>
            <!-- Columna de logo -->
            <td style="width: 30%; text-align: right; vertical-align: top;">
                <img src="{{ 'storage/' . $configuration->logo }}" alt="logo" style="width: 50px;">
            </td>
        </tr>
    </table>

    <h1 class="page-title text-center">Listado de Personal Médico</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombres y Apellidos</th>
                <th>Teléfono</th>
                <th>Licencia Médica</th>
                <th>Especialidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $doctor->names }} {{ $doctor->last_names }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>{{ $doctor->medical_leave }}</td>
                    <td>{{ $doctor->specialization }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>