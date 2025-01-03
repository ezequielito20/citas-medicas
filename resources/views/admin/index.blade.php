@extends('layouts.admin')
@section('title', 'Reserva de Citas Medicas')

@section('content')
    <div class="row">
        <h1>Bienvenido: {{ Auth::user()->name }}</h1>
    </div>

    <div class="row">
        @can('admin.users.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_users }}</h3>
                        <p>{{ $total_users === 1 ? 'Usuario' : 'Usuarios' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-file-earmark-person"></i></i>
                    </div>
                    <a href="{{ url('users') }}" class="small-box-footer">Mas Información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.secretaries.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total_secretaries }}</h3>
                        <p>{{ $total_secretaries === 1 ? 'Secretaria' : 'Secretarias' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-check"></i>
                    </div>
                    <a href={{ url('secretaries') }} class="small-box-footer">Mas Información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.patients.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #e768f5;">
                    <div class="inner">
                        <h3>{{ $total_patients }}</h3>
                        <p>{{ $total_patients === 1 ? 'Paciente' : 'Pacientes' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-fill-add"></i>
                    </div>
                    <a href="{{ url('patients') }}" class="small-box-footer">Mas Información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.offices.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #61e2c2;">
                    <div class="inner">
                        <h3>{{ $total_offices }}</h3>
                        <p>{{ $total_offices === 1 ? 'Consultorio' : 'Consultorios' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-house-fill"></i>
                    </div>
                    <a href="{{ url('offices') }}" class="small-box-footer">Mas Información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.doctors.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #d7e261;">
                    <div class="inner">
                        <h3>{{ $total_doctors }}</h3>
                        <p>{{ $total_doctors === 1 ? 'Doctor' : 'Doctores' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-hearts"></i>
                    </div>
                    <a href="{{ url('doctors') }}" class="small-box-footer">Mas Información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.hours.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #c07dec;">
                    <div class="inner">
                        <h3>{{ $total_hours }}</h3>
                        <p>{{ $total_hours === 1 ? 'Horario' : 'Horarios' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar3"></i>
                    </div>
                    <a href="{{ url('hours') }}" class="small-box-footer">Mas Información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.hours.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #f66161;">
                    <div class="inner">
                        <h3>{{ $total_events }}</h3>
                        <p>{{ $total_events === 1 ? 'Evento' : 'Eventos' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar-event-fill"></i>
                    </div>
                    <a href="" class="small-box-footer"> <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.hours.index')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #6f83f3;">
                    <div class="inner">
                        <h3>{{ $total_configurations }}</h3>
                        <p>{{ $total_configurations === 1 ? 'Configuración' : 'Configuraciones' }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-wrench-adjustable"></i>
                    </div>
                    <a href="{{ url('configurations') }}" class="small-box-footer">Mas Información <i
                        class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('offices_data')
            <div class="row col-md-12">
                <div class=" justify-content-center col-md-12">
                    <div class="card card-outline card-primary ">
                        <div class="card-header">
                            <h3 class="card-title">Calendario de Atención de Doctores Y Consultorios</h3><br>
                            <hr>
                            <div class="form-group">
                                <select class="form-control" id="office_select" name="office_id">
                                    <option value="" disabled selected>Selecciona un consultorio</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}"
                                            {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                            {{ $office->name }} ({{ $office->address }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#office_select').on('change', function() {
                                        var consultorio_id = $('#office_select').val();

                                        var url = "{{ route('offices_data', ':id') }}";
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

                    </div>
                </div>
            </div>
            <div class="row col-md-12">
                <div class=" justify-content-center col-md-12">
                    <div class="card card-outline card-warning ">
                        <div class="card-header">
                            <h3 class="card-title">Calendario de Reserva de Citas Medicas</h3><br>
                            <hr>
                            <div class="form-group">
                                <select class="form-control" id="doctor_select" name="doctor_id">
                                    <option value="" disabled selected>Selecciona un Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}"
                                            {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->names }} ({{ $doctor->specialization }})
                                        </option>
                                    @endforeach
                                </select>
                                <script>
                                    $(document).ready(function() {
                                        $('#doctor_select').on('change', function() {
                                            var doctor_id = $('#doctor_select').val();
                                            // alert(doctor_id)
                                            var calendarEl = document.getElementById('calendar');
                                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                                initialView: 'dayGridMonth',
                                                locale: 'es',
                                                events: []
                                            });


                                            if (doctor_id) {
                                                var url = "{{ route('doctors_reservations', ':id') }}";
                                                url = url.replace(':id', doctor_id);
                                                console.log("url: " + url)
                                                $.ajax({
                                                    url: url,
                                                    type: 'GET',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        calendar.addEventSource(data);
                                                    },
                                                    error: function() {
                                                        alert('Error al obtener los datos del consultorio');
                                                    }
                                                });
                                            } else {
                                                $('#doctor_info').html('');
                                            }
                                            calendar.render();

                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Registrar cita
                            </button>

                            <a href="{{ url('/see_reservations', Auth::user()->id) }}" class="btn btn-success"> <i
                                    class="bi bi-eye-fill"></i> Ver las reservas</a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reserva de Cita Medica</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="modal-body card card-outline card-primary col-md-11 ">
                                                {{-- <div class="card card-outline card-primary">
        
                                                <div class="card-header">
                                                    <h3 class="card-title">Crear Horario</h3>
                                                </div>
                                                <div class="card-body"> --}}
                                                <form action="{{ route('admin.events.store') }}" method="POST">
                                                    @csrf
                                                    {{-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="office_id">Seleccionar Consultorio</label>
                                                            <select class="form-control" id="office_id" name="office_id"
                                                                required>
                                                                <option value="" disabled selected>Selecciona un
                                                                    consultorio</option>
                                                                @foreach ($offices as $office)
                                                                    <option value="{{ $office->id }}"
                                                                        {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                                                        {{ $office->name }} ({{ $office->address }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('office_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="title">Título</label>
                                                            <input type="text" class="form-control" id="title"
                                                                name="title" value="{{ old('title') }}"
                                                                placeholder="Título" required>
                                                            @error('title')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                    {{-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="day">Dia de la semana </label>
                                                            <select class="form-control" id="day" name="day"
                                                                required>
                                                                <option value="" disabled
                                                                    {{ old('day') ? '' : 'selected' }}>Seleccione un día
                                                                </option>
                                                                <option value="Lunes"
                                                                    {{ old('day') === 'Lunes' ? 'selected' : '' }}>Lunes
                                                                </option>
                                                                <option value="Martes"
                                                                    {{ old('day') === 'Martes' ? 'selected' : '' }}>Martes
                                                                </option>
                                                                <option value="Miercoles"
                                                                    {{ old('day') === 'Miercoles' ? 'selected' : '' }}>
                                                                    Miércoles
                                                                </option>
                                                                <option value="Jueves"
                                                                    {{ old('day') === 'Jueves' ? 'selected' : '' }}>Jueves
                                                                </option>
                                                                <option value="Viernes"
                                                                    {{ old('day') === 'Viernes' ? 'selected' : '' }}>Viernes
                                                                </option>
                                                                <option value="Sabado"
                                                                    {{ old('day') === 'Sabado' ? 'selected' : '' }}>Sábado
                                                                </option>
                                                            </select>
                                                            @error('day')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}

                                                    <div class="row">
                                                        <div class=" col-md-6">
                                                            <div class="form-group">
                                                                <label for="date">Fecha de Reserva</label>
                                                                <input type="date" class="form-control" id="date"
                                                                    name="date" value="{{ old('date') }}"
                                                                    placeholder="Fecha de Reserva" required>
                                                                @error('date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                    const fechaReservaInput = document.getElementById('date');

                                                                    // Escuchar el evento de cambio en el campo de fecha de reserva
                                                                    fechaReservaInput.addEventListener('change', function() {
                                                                        let selectedDate = this.value; // Obtener la fecha seleccionada

                                                                        // Obtener la fecha actual en formato ISO (yyyy-mm-dd)
                                                                        let today = new Date().toISOString().slice(0, 10);

                                                                        // Verificar si la fecha seleccionada es anterior a la fecha actual
                                                                        if (selectedDate < today) {
                                                                            // Si es así, establecer la fecha seleccionada en null
                                                                            this.value = null;
                                                                            alert('No puede seleccionar una fecha pasada.');
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="hour">Hora de Inicio</label>
                                                                <input type="time" class="form-control" id="hour"
                                                                    name="hour" value="{{ old('hour') }}"
                                                                    placeholder="Hora de Inicio" required>
                                                                @error('hour')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                    const horaReservaInput = document.getElementById('hour');

                                                                    horaReservaInput.addEventListener('change', function() {
                                                                        let selectedTime = this.value; // Obtener el valor de la hora seleccionada

                                                                        // Asegurar que solo se capture la parte de la hora
                                                                        if (selectedTime) {
                                                                            selectedTime = selectedTime.split(':'); // Dividir la cadena en horas y minutos
                                                                            selectedTime = selectedTime[0] + ':00'; // Conservar solo la hora, ignorar los minutos
                                                                            this.value = selectedTime; // Establecer la hora modificada en el campo de entrada
                                                                        }

                                                                        // Verificar si la hora seleccionada está fuera del rango permitido
                                                                        if (selectedTime < '08:00' || selectedTime >= '20:00') {
                                                                            // Si es así, establecer la hora seleccionada en null
                                                                            this.value = null;
                                                                            alert('Por favor, seleccione una hora entre las 08:00 y las 19:59.');
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="end_time">Hora de Fin</label>
                                                            <input type="time" class="form-control" id="end_time"
                                                                name="end_time" value="{{ old('end_time') }}"
                                                                placeholder="Hora de Fin" required>
                                                            @error('end_time')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="doctor_id">Seleccionar Doctor</label>
                                                                <select class="form-control" id="doctor_id" name="doctor_id"
                                                                    required>
                                                                    <option value="" disabled selected>Selecciona un
                                                                        doctor
                                                                    </option>
                                                                    @foreach ($doctors as $doctor)
                                                                        <option value="{{ $doctor->id }}"
                                                                            {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                                            {{ $doctor->names }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('doctor_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Crear</button>
                                                    <a href="{{ url('/index') }}" class="btn btn-secondary">Cancelar</a>
                                                </form>
                                                {{-- </div>
                                            </div> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary">Registrar</button>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div id="calendar"></div>
                        </div>

                    </div>
                </div>
            </div>
            @if ($errors->any())
                <script>
                    $(document).ready(function() {
                        $('#exampleModal').modal('show');
                    });
                </script>
            @endif
        @endcan
    </div>
    @if (Auth::check() && Auth::user()->roles->first()->name == 'doctor')
        <div class="row">
            <div class="row col-md-12">
                <div class=" justify-content-center col-md-12">
                    <div class="card card-outline card-primary ">
                        <div class="card-header">
                            <h3 class="card-title">Calendario de Reservas</h3><br>
                            <hr>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;">#</th>
                                        <th scope="col" style="text-align: center;">Usuario</th>
                                        <th scope="col" style="text-align: center;">Fecha de Reserva</th>
                                        <th scope="col" style="text-align: center;">Hora de Reserva</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($events as $event)
                                        @if (Auth::user()->doctor->id == $event->doctor_id)
                                            @php
                                                [$day, $hour] = explode(' ', $event->start);
                                            @endphp
                                            <tr style="text-align: center;">
                                                <th scope="row">{{ $cont++ }}</th>
                                                <td>{{ $event->user->name }}</td>
                                                <td>{{ $day }}</td>
                                                <td>{{ $hour }}</td>


                                            </tr>
                                        @endif
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
                                            "info": "Mostrando START a END de TOTAL Reservas",
                                            "infoEmpty": "Mostrando 0 a 0 de 0 Reservas",
                                            "infoFiltered": "(Filtrado de MAX total Reservas)",
                                            "infoPostFix": "",
                                            "thousands": ",",
                                            "lengthMenu": "Mostrar MENU Reservas",
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
            </div>
        </div>
    @endif

@endsection()
