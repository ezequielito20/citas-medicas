@extends('layouts.admin')
@section('title', 'Historial Médico')

@section('content')
    <div class="row">
        <h1>Listado de Historiales Médicos</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Historiales Registrados</h3>

            <div class="card-tools">
                <a href="{{ url('historial/create') }}" class="btn btn-primary">
                    Registrar Nuevo
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Paciente</th>
                        <th scope="col" style="text-align: center;">Doctor</th>
                        <th scope="col" style="text-align: center;">Detalle de la Cita</th>
                        <th scope="col" style="text-align: center;">Fecha de Visita</th>
                        <th scope="col" style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($historiales as $historial)
                        @if ($historial->doctor_id == auth()->user()->doctor->id || auth()->user()->hasRole('admin'))
                            <tr>
                                <th scope="row" style="text-align: center;">{{ $cont++ }}</th>
                                <td>{{ $historial->patient->names }} {{ $historial->patient->last_names }}</td>
                                <td>{{ $historial->doctor->names }} {{ $historial->doctor->last_names }}</td>
                                <td >{{ \Illuminate\Support\Str::limit($historial->detail, 100, '...') }}</td>
                                <td>{{ $historial->visit_date }}</td>
                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('historial/' . $historial->id) }}" class="btn btn-info"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="{{ url('historial/' . $historial->id . '/edit') }}"
                                            class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ url('historial/pdf/' . $historial->id ) }}"
                                            class="btn btn-secondary btn-sm"><i class="bi bi-printer"></i></a>
                                        <a href="{{ url('historial/' . $historial->id . '/delete') }}"
                                            class="btn btn-danger btn-sm delete-link"><i class="bi bi-trash"></i></a>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <!-- Script para la alerta de confirmación -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const deleteLinks = document.querySelectorAll('.delete-link');

                    deleteLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();

                            const deleteUrl = this.getAttribute('href');

                            Swal.fire({
                                title: '¿Estás seguro?',
                                text: "No podrás revertir esto",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sí, eliminar',
                                cancelButtonText: 'Cancelar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = deleteUrl;
                                }
                            });
                        });
                    });
                });
            </script>
            <script>
                $(function() {
                    $("#example1").DataTable({
                        "pageLength": 10,
                        "language": {
                            "emptyTable": "No hay información",
                            "info": "Mostrando START a END de TOTAL Historiales",
                            "infoEmpty": "Mostrando 0 a 0 de 0 Historiales",
                            "infoFiltered": "(Filtrado de MAX total Historiales)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar MENU Historiales",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscador:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
                        buttons: [{
                                extend: 'collection',
                                text: 'Reportes',
                                orientation: 'landscape',
                                buttons: [{
                                    text: 'Copiar',
                                    extend: 'copy',
                                }, {
                                    extend: 'pdf'
                                }, {
                                    extend: 'csv'
                                }, {
                                    extend: 'excel'
                                }, {
                                    text: 'Imprimir',
                                    extend: 'print'
                                }]
                            },
                            {
                                extend: 'colvis',
                                text: 'Visor de columnas',
                                collectionLayout: 'fixed three-column'
                            }
                        ],
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                });
            </script>
        </div>
    </div>
@endsection()
