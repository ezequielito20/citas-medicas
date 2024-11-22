@extends('layouts.admin')
@section('title', 'Horarios')

@section('content')
    <div class="row">
        <h1>Listado de Horarios</h1>
    </div>
    <hr>
    <div class="row">
        <div class="card card-outline card-primary col-md-12">
            <div class="card-header">
                <h3 class="card-title">Horarios Registrados</h3>

                <div class="card-tools">
                    <a href="{{ url('hours/create') }}" class="btn btn-primary">
                        Registrar Nuevo
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center;">#</th>
                            <th scope="col" style="text-align: center;">Doctor</th>
                            <th scope="col" style="text-align: center;">Dia de Atención</th>
                            <th scope="col" style="text-align: center;">Hora de Inicio</th>
                            <th scope="col" style="text-align: center;">Hora de Fin</th>
                            <th scope="col" style="text-align: center;">Consultorio</th>
                            <th scope="col" style="text-align: center;">Aciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cont = 1;
                        @endphp
                        @foreach ($hours as $hour)
                            <tr>
                                <th scope="row" style="text-align: center;">{{ $cont++ }}</th>
                                <td>{{ $hour->doctor->names }}</td>
                                <td>{{ $hour->day }}</td>
                                <td>{{ $hour->start_time }}</td>
                                <td>{{ $hour->end_time }}</td>
                                <td>{{ $hour->office->name }}</td>
                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('hours/' . $hour->id) }}" class="btn btn-info"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="{{ url('hours/' . $hour->id . '/edit') }}"
                                            class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ url('hours/' . $hour->id . '/delete') }}"
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
                                "info": "Mostrando START a END de TOTAL Horarios",
                                "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                                "infoFiltered": "(Filtrado de MAX total Horarios)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mostrar MENU Horarios",
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
    </div>

    <div class="row justify-content-center">
        <div class="card card-outline card-primary col-md-10">
            <div class="card-header">
                <h3 class="card-title">Calendario de Atención de Doctores Y Consultorios</h3><br>
                <hr>
                <div class="form-group">
                    <select class="form-control" id="office_select" name="office_id">
                        <option value="" disabled selected>Selecciona un consultorio</option>
                        @foreach ($offices as $office)
                            <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                {{ $office->name }} ({{ $office->address }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#office_select').on('change', function() {
                            var consultorio_id = $('#office_select').val();
                            
                            var url = "{{ route('admin.hours.offices_data', ':id') }}";
                            url = url.replace(':id', consultorio_id);

                            if (consultorio_id) {
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    success: function(data) {
                                        $('#consultorio_info').html(data);
                                    },
                                    error: function() {
                                        alert('Error al obtener los datos del consultorio');
                                    }
                                });
                            } else {
                                $('#consultorio_info').html('');
                            }
                        });
                    });
                </script>
                <div id="consultorio_info"></div>
            </div>
            <div class="card-body">
                <table style="font-size: 15px; text-align: center;"
                    class="table table-striped table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Hora</th>
                            <th scope="col">Lunes</th>
                            <th scope="col">Martes</th>
                            <th scope="col">Miercoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                            <th scope="col">Sabado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $hours_worker = [
                                '08:00:00 - 09:00:00',
                                '09:00:00 - 10:00:00',
                                '10:00:00 - 11:00:00',
                                '11:00:00 - 12:00:00',
                                '12:00:00 - 13:00:00',
                                '13:00:00 - 14:00:00',
                                '14:00:00 - 15:00:00',
                                '15:00:00 - 16:00:00',
                                '16:00:00 - 17:00:00',
                                '17:00:00 - 18:00:00',
                                '18:00:00 - 19:00:00',
                                '19:00:00 - 20:00:00',
                            ];
                            $days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
                        @endphp
                        @foreach ($hours_worker as $hour_worker)
                            @php
                                [$start_time, $end_time] = explode(' - ', $hour_worker);
                            @endphp
                            <tr>
                                <td>{{ $hour_worker }}</td>
                                @foreach ($days as $day)
                                    @php
                                        $doctor_name = '';
                                        foreach ($hours as $hour) {
                                            if (
                                                strtoupper($hour->day) == strtoupper($day) &&
                                                // $start_time >= $hour->start_time &&
                                                // $end_time <= $hour->end_time
                                                ($start_time >= $hour->start_time || $hour->start_time < $end_time) &&
                                                ($end_time <= $hour->end_time || $hour->end_time > $start_time)
                                            ) {
                                                $doctor_name = $hour->doctor->names;

                                                if ($day == 'Miercoles') {
                                                    // dd($start_time, $hour->start_time, $end_time, $hour->end_time, $day);
                                                }
                                                break;
                                            }
                                        }
                                    @endphp
                                    <td> {{ $doctor_name }} </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection()
