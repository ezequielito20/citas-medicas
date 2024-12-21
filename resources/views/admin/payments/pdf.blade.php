<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .company-info {
            margin-bottom: 15px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 9px;
            text-align: center;
            padding: 10px 0;
        }
        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('storage/' . $configuration->logo) }}" alt="Logo" class="logo">
        <div class="company-info">
            <h2>{{ $configuration->name }}</h2>
            <p>{{ $configuration->address }}</p>
            <p>Tel: {{ $configuration->phone }} | Email: {{ $configuration->email }}</p>
        </div>
        <h1>Reporte de Pagos</h1>
        @if(request('start_date') && request('end_date'))
            <p>Período: {{ date('d/m/Y', strtotime(request('start_date'))) }} - 
               {{ date('d/m/Y', strtotime(request('end_date'))) }}</p>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Monto</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                    <td>{{ $payment->patient->names }} {{ $payment->patient->last_names }}</td>
                    <td>{{ $payment->doctor->names }} {{ $payment->doctor->last_names }}</td>
                    <td>${{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Recaudado: ${{ number_format($payments->sum('amount'), 2) }}
    </div>

    <div class="footer">
        <p>Fecha de generación: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Este es un documento generado automáticamente.</p>
    </div>
</body>
</html>