@extends('layouts.admin')
@section('title', 'Configuraciones')

@section('content')
    <div class="row">
        <h1>Listado de Configuraciones</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Configuraciones Registradas</h3>

            <div class="card-tools">
                <a href="{{ url('configurations/create') }}" class="btn btn-primary">
                    Crear Configuracion
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Nombre</th>
                        <th scope="col" style="text-align: center;">Direccion</th>
                        <th scope="col" style="text-align: center;">Telefono</th>
                        <th scope="col" style="text-align: center;">Correo</th>
                        <th scope="col" style="text-align: center;">Logo</th>
                        <th scope="col" style="text-align: center;">Aciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($configurations as $configuration)
                        <tr>
                            <th scope="row" style="text-align: center;">{{ $cont++ }}</th>
                            <td>{{ $configuration->name }}</td>
                            <td>{{ $configuration->address }}</td>
                            <td>{{ $configuration->phone }}</td>
                            <td>{{ $configuration->email }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $configuration->logo) }}" alt="logo" width="70px">
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('configurations/' . $configuration->id) }}" class="btn btn-info"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ url('configurations/' . $configuration->id . '/edit') }}" class="btn btn-success btn-sm"><i
                                            class="bi bi-pencil"></i></a>
                                    <a href="{{ url('configurations/' . $configuration->id . '/delete') }}"
                                        class="btn btn-danger btn-sm delete-link"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                            
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
                            "info": "Mostrando START a END de TOTAL Configuraciones",
                            "infoEmpty": "Mostrando 0 a 0 de 0 Configuraciones",
                            "infoFiltered": "(Filtrado de MAX total Configuraciones)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar MENU Configuraciones",
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
