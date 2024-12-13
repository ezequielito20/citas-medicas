@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-2 text-gray-800">Reporte de Reservaciones</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.reservations.pdf') }}" class="btn btn-danger mr-2">
                    <i class="fas fa-file-pdf"></i> Exportar PDF
                </a>
                <a href="{{ route('admin.reservations.pdf', ['type' => 'all']) }}" class="btn btn-primary mr-2">
                    <i class="fas fa-list"></i> Listar Todas las Reservas
                </a>
                <a href="{{ route('admin.reservations.pdf', ['type' => 'dates']) }}" class="btn btn-info">
                    <i class="fas fa-calendar-alt"></i> Reporte por Fechas
                </a>
            </div>
        </div>

        <!-- Tarjetas de Estadísticas -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Reservaciones</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['total_events'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Reservaciones Este Mes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $statistics['current_month_events'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Próximas Reservaciones</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['upcoming_events'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Reservaciones Pasadas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['past_events'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Reservaciones por Mes -->
        @foreach ($eventsByMonth as $month => $monthEvents)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                        <span class="badge badge-secondary">{{ count($monthEvents) }} {{ count($monthEvents) == 1 ? 'reservación' : 'reservaciones' }}</span>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>Paciente</th>
                                    <th>Doctor</th>
                                    <th>Consultorio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthEvents as $event)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($event->start)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $event->user->name }}</td>
                                        <td>{{ $event->doctor->names }} {{ $event->doctor->last_names }}</td>
                                        <td>{{ $event->office->name }}</td>
                                        <td>
                                            @if (\Carbon\Carbon::parse($event->start)->isFuture())
                                                <span class="badge badge-success">Próxima</span>
                                            @else
                                                <span class="badge badge-secondary">Pasada</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Generar Reporte por Rango de Fechas</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.reservations.pdf') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Fecha Inicial</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">Fecha Final</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 ">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-file-export"></i> Generar Reporte
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card-body {
            padding: 1.25rem;
        }

        .table th {
            background-color: #f8f9fc;
        }

        .badge {
            font-size: 0.85rem;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Establecer fecha máxima como hoy
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('start_date').setAttribute('max', today);
        document.getElementById('end_date').setAttribute('max', today);

        // Validar que la fecha final no sea menor que la inicial
        document.getElementById('start_date').addEventListener('change', function() {
            document.getElementById('end_date').setAttribute('min', this.value);
        });

        document.getElementById('end_date').addEventListener('change', function() {
            document.getElementById('start_date').setAttribute('max', this.value);
        });
    </script>
@endsection
