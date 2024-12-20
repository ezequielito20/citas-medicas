@extends('layouts.admin')
@section('title', 'Búsqueda de Historial Clínico')

@section('content')
    <div class="container-fluid">
        <!-- Encabezado -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">Búsqueda de Historial Clínico</h1>
            </div>
        </div>

        <!-- Formulario de Búsqueda -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Buscar Paciente</h6>
            </div>
            <div class="card-body">
               <form action="{{ route('admin.historial.search_patient') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ci">Cédula de Identidad</label>
                                <input type="text" class="form-control" id="ci" name="ci" 
                                       placeholder="Buscar por CI...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="names">Nombres</label>
                                <input type="text" class="form-control" id="names" name="names" 
                                       placeholder="Buscar por nombres...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_names">Apellidos</label>
                                <input type="text" class="form-control" id="last_names" name="last_names" 
                                       placeholder="Buscar por apellidos...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" id="clearBtn" class="btn btn-secondary mr-2 btn-clear">
                                <i class="fas fa-eraser"></i> Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Loader -->
        <div id="loader" class="text-center d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>

        <!-- Resultados de la búsqueda -->
        <div id="searchResults" class="search-results-container">
            @if(isset($patients))
                @if($patients->count() > 0)
                    @foreach($patients as $patient)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                                <h6 class="m-0 font-weight-bold">
                                    Paciente: {{ $patient->names }} {{ $patient->last_names }}
                                </h6>
                                <div>
                                    <span class="mr-3">CI: {{ $patient->ci }}</span>
                                    <a href="{{ route('admin.historial.print_historial', $patient->id) }}" 
                                       class="btn btn-light btn-sm" 
                                       target="_blank">
                                        <i class="fas fa-file-pdf"></i> Generar PDF
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Información del paciente -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p><strong>Teléfono:</strong> {{ $patient->phone ?? 'No registrado' }}</p>
                                        <p><strong>Email:</strong> {{ $patient->email ?? 'No registrado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Dirección:</strong> {{ $patient->address ?? 'No registrada' }}</p>
                                    </div>
                                </div>

                                <!-- Historiales médicos -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Doctor</th>
                                                <th>Especialidad</th>
                                                <th>Diagnóstico</th>
                                                <th width="120">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($patient->historial as $historial)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($historial->visit_date)->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $historial->doctor->names }} {{ $historial->doctor->last_names }}</td>
                                                    <td>{{ $historial->doctor->specialization }}</td>
                                                    <td>{{ Str::limit($historial->detail, 100) }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.historial.show', $historial->id) }}" 
                                                           class="btn btn-info btn-sm" 
                                                           title="Ver detalle">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.historial.edit', $historial->id) }}" 
                                                           class="btn btn-warning btn-sm"
                                                           title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        No hay historiales médicos registrados para este paciente
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No se encontraron resultados para la búsqueda
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clearBtn = document.getElementById('clearBtn');
        
        clearBtn.addEventListener('click', function() {
            // Redireccionar a la ruta base de búsqueda sin parámetros
            window.location.href = "{{ route('admin.historial.search_patient') }}";
        });
    });
</script>

@push('styles')
<style>
    .table td { 
        vertical-align: middle; 
    }
    #loader {
        padding: 20px;
    }
    .btn-search {
        margin-top: 32px;
    }
    .search-results-container {
        margin-top: 20px;
    }
</style>
@endpush


