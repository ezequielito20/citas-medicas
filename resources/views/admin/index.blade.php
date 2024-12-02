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
    </div>
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
                    {{-- <div class="form-group">
                        <select class="form-control" id="office_select" name="office_id">
                            <option value="" disabled selected>Selecciona un consultorio</option>
                            @foreach ($offices as $office)
                                <option value="{{ $office->id }}"
                                    {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                    {{ $office->name }} ({{ $office->address }})
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>

            </div>
        </div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
          });
          calendar.render();
        });
  
      </script>
@endsection()
