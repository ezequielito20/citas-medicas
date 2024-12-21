<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos</title>
    <style>
        @page {
            margin: 3cm 2cm 3cm 2cm;
        }
        body {
            font-family: 'Helvetica', sans-serif;
            color: #2D3748;
            line-height: 1.6;
        }
        .header {
            position: fixed;
            top: -2cm;
            left: 0;
            right: 0;
            height: 2cm;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 20px;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
        }
        .logo-container {
            float: left;
            width: 20%;
        }
        .logo {
            max-height: 60px;
            object-fit: contain;
        }
        .company-info {
            float: right;
            width: 40%;
            text-align: right;
            font-size: 9pt;
            color: #4A5568;
        }
        .report-title {
            text-align: center;
            font-size: 24pt;
            color: #2B6CB0;
            margin: 20px 0;
            clear: both;
        }
        .period-info {
            text-align: center;
            font-size: 10pt;
            color: #718096;
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 9pt;
        }
        .table th {
            background-color: #EBF8FF;
            color: #2C5282;
            font-weight: bold;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #BEE3F8;
        }
        .table td {
            padding: 10px;
            border-bottom: 1px solid #E2E8F0;
        }
        .table tr:nth-child(even) {
            background-color: #F7FAFC;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
            padding: 15px;
            background-color: #F7FAFC;
            border-radius: 5px;
        }
        .total-amount {
            font-size: 14pt;
            color: #2B6CB0;
            font-weight: bold;
        }
        .security-section {
            text-align: center;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .qr-wrapper {
            display: inline-block;
        }
        .qr-code {
            width: 150px;
            height: 150px;
        }
        .security-text {
            font-size: 8pt;
            margin-top: 5px;
            color: #666;
        }
        .footer {
            position: fixed;
            bottom: -2cm;
            left: 0;
            right: 0;
            height: 1cm;
            text-align: center;
            font-size: 8pt;
            color: #718096;
            border-top: 1px solid #E2E8F0;
            padding-top: 10px;
        }
        .page-number {
            font-size: 8pt;
            color: #A0AEC0;
            text-align: right;
        }
        .amount-cell {
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        .qr-container {
            position: fixed;
            bottom: 100px;  /* Ajusta según necesites */
            right: 50px;    /* Ajusta según necesites */
            text-align: center;
        }
        /* Clase especial para el QR que solo aparece en la última página */
        .last-page-only {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            visibility: hidden;
        }
        /* Esta regla CSS hace visible el contenido solo en la última página */
        @page :last {
            .last-page-only {
                visibility: visible;
            }
            .security-section {
                visibility: visible;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo-container">
                <img src="{{ public_path('storage/' . $configuration->logo) }}" alt="Logo" class="logo">
            </div>
            <div class="company-info">
                <strong>{{ $configuration->name }}</strong><br>
                {{ $configuration->address }}<br>
                Tel: {{ $configuration->phone }}<br>
                {{ $configuration->email }}
            </div>
        </div>
    </div>

    <div class="report-title">Reporte de Pagos</div>
    
    @if(request('start_date') && request('end_date'))
    <div class="period-info">
        Período del {{ date('d/m/Y', strtotime(request('start_date'))) }} 
        al {{ date('d/m/Y', strtotime(request('end_date'))) }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                <td>{{ $payment->patient->names }} {{ $payment->patient->last_names }}</td>
                <td>{{ $payment->doctor->names }}</td>
                <td>{{ $payment->description }}</td>
                <td class="amount-cell">${{ number_format($payment->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <span>Total Recaudado: </span>
        <span class="total-amount">${{ number_format($payments->sum('amount'), 2) }}</span>
    </div>

    <div style="page-break-inside: avoid;">
        <div class="security-section">
            <div class="qr-wrapper">
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR" class="qr-code">
                <div class="security-text">
                    Código de Verificación Digital<br>
                    {{ now()->format('d/m/Y H:i:s') }}
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        Documento generado automáticamente por el sistema<br>
        {{ $configuration->name }} © {{ date('Y') }}
    </div>

    <div class="page-number">
        {{-- Página {PAGE_NUM} de {PAGE_COUNT} --}}
    </div>
    
    
</body>
</html>