@extends('layouts.admin')
@section('title', 'Pacientes')

@section('content')
    <div class="row">
        <h1>Listado de Pacientes</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Pacientes Registrados</h3>

            <div class="card-tools">
                <a href="{{ url('patients/create') }}" class="btn btn-primary">
                    Registrar Nuevo
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Nombres</th>
                        <th scope="col" style="text-align: center;">Apellidos</th>
                        <th scope="col" style="text-align: center;">C.I</th>
                        <th scope="col" style="text-align: center;">Email</th>
                        <th scope="col" style="text-align: center;">Telefono</th>
                        <th scope="col" style="text-align: center;">Fecha de Nacimiento</th>
                        <th scope="col" style="text-align: center;">Genero</th>
                        <th scope="col" style="text-align: center;">Tipo de sangre</th>
                        <th scope="col" style="text-align: center;">Aciones</th>
                        <th scope="col" style="text-align: center;">Alergias</th>
                        <th scope="col" style="text-align: center;">Contacto de emergencia</th>
                        <th scope="col" style="text-align: center;">Número de seguro</th>
                        <th scope="col" style="text-align: center;">Observaciones</th>
                        <th scope="col" style="text-align: center;">Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($patients as $patient)
                        <tr>
                            <th scope="row" style="text-align: center;">{{ $cont++ }}</th>
                            <td>{{ $patient->names }}</td>
                            <td>{{ $patient->last_names }}</td>
                            <td>{{ $patient->ci }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->birthdate }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->blood_type }}</td>
                            <td style="text-align: center;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('patients/' . $patient->id) }}" class="btn btn-info"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ url('patients/' . $patient->id . '/edit') }}" class="btn btn-success btn-sm"><i
                                            class="bi bi-pencil"></i></a>
                                    <a href="{{ url('patients/' . $patient->id . '/delete') }}"
                                        class="btn btn-danger btn-sm delete-link"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                            <td>{{ $patient->allergies }}</td>
                            <td>{{ $patient->emergency_contact }}</td>
                            <td>{{ $patient->health_insurance_number }}</td>
                            <td>{{ $patient->observations }}</td>
                            <td>{{ $patient->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Script para la alerta de confirmación -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Seleccionar todos los enlaces de eliminación
                    const deleteLinks = document.querySelectorAll('.delete-link');

                    deleteLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault(); // Evita el redireccionamiento inmediato

                            const deleteUrl = this.getAttribute('href'); // Obtiene la URL de eliminación

                            // Muestra la alerta de confirmación
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
                                    // Si el usuario confirma, redirige a la URL de eliminación
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
                            "info": "Mostrando START a END de TOTAL Pacientes",
                            "infoEmpty": "Mostrando 0 a 0 de 0 Pacientes",
                            "infoFiltered": "(Filtrado de MAX total Pacientes)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar MENU Pacientes",
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
