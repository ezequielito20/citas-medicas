<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <table style="width: 100%; table-layout: fixed; border-collapse: collapse; font-size: 8px;">
        <tr>
            <!-- Columna de información -->
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
    
    <h2 style="text-align: center;"><u>Personal de Medicos</u></h2>
    <br>
    <table class="table table-bordered table-hover table-sm table-striped">
        <thead>
            <tr style="background-color: #d0e1f3;">
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Nombres y Apellidos</th>
                <th style="text-align: center;">Telefono</th>
                <th style="text-align: center;">Licencia Medica</th>
                <th style="text-align: center;">Especialidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">{{ $doctor->names }} {{ $doctor->last_names }}</td>
                    <td style="text-align: center;">{{ $doctor->phone }}</td>
                    <td style="text-align: center;">{{ $doctor->medical_leave }}</td>
                    <td style="text-align: center;">{{ $doctor->specialization }}</td>
                </tr>
                
            @endforeach
        </tbody>
    </table>

</body>
</html>