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
                  @csrf
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
                            <button type="button" id="clearBtn" class="btn btn-secondary mr-2">
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
        <div id="searchResults">
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
                                    <a href="{{ route('admin.historial.pdf', $patient->id) }}" 
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

@push('scripts')
<script>
$(document).ready(function() {
    // Manejar el envío del formulario
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            ci: $('#ci').val(),
            names: $('#names').val(),
            last_names: $('#last_names').val()
        };

        // Verificar si al menos un campo tiene contenido
        if (!formData.ci && !formData.names && !formData.last_names) {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Por favor, ingrese al menos un criterio de búsqueda'
            });
            return;
        }

        // Mostrar loader
        $('#loader').removeClass('d-none');
        $('#searchResults').html('');

        // Realizar la búsqueda
        $.ajax({
            url: "{{ route('admin.historial.search_patient') }}",
            method: 'GET',
            data: formData,
            success: function(response) {
                $('#loader').addClass('d-none');
                $('#searchResults').html(response);
            },
            error: function(xhr) {
                $('#loader').addClass('d-none');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al realizar la búsqueda'
                });
                console.error('Error en la búsqueda:', xhr);
            }
        });
    });

    // Limpiar formulario
    $('#clearBtn').click(function() {
        $('#searchForm')[0].reset();
        $('#searchResults').html('');
    });
});
</script>
@endpush

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


