@extends('layouts.admin')
@section('title', 'Crear Horario')

@section('content')
    <div class="row">
        <h1>Crear Horario</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Crear Horario</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.hours.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="office_id">Seleccionar Consultorio</label>
                            <select class="form-control" id="office_id" name="office_id" required>
                                <option value="" disabled selected>Selecciona un consultorio</option>
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
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="day">Dia de la semana </label>
                            <select class="form-control" id="day" name="day" required>
                                <option value="" disabled {{ old('day') ? '' : 'selected' }}>Seleccione un día
                                </option>
                                <option value="Lunes" {{ old('day') === 'Lunes' ? 'selected' : '' }}>Lunes</option>
                                <option value="Martes" {{ old('day') === 'Martes' ? 'selected' : '' }}>Martes</option>
                                <option value="Miercoles" {{ old('day') === 'Miercoles' ? 'selected' : '' }}>Miércoles
                                </option>
                                <option value="Jueves" {{ old('day') === 'Jueves' ? 'selected' : '' }}>Jueves</option>
                                <option value="Viernes" {{ old('day') === 'Viernes' ? 'selected' : '' }}>Viernes</option>
                                <option value="Sabado" {{ old('day') === 'Sabado' ? 'selected' : '' }}>Sábado</option>
                            </select>
                            @error('day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_time">Hora Inicio</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                                value="{{ old('start_time') }}" placeholder="Hora Inicio" required>
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="end_time">Hora de Fin</label>
                            <input type="time" class="form-control" id="end_time" name="end_time"
                                value="{{ old('end_time') }}" placeholder="Hora de Fin" required>
                            @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doctor_id">Seleccionar Doctor</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <option value="" disabled selected>Selecciona un doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->names }} ({{ $doctor->user->email }})
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
                <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card card-outline card-primary col-md-10">
            <div class="card-header">
                <h3 class="card-title">Calendario de Atención de Doctores Y Consultorios</h3><br>
                <hr>
                <script>
                    $(document).ready(function() {
                        $('#office_id').on('change', function() {
                            var consultorio_id = $('#office_id').val();

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

        </div>
    </div>

@endsection()
