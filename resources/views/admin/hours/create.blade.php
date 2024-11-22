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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_time">Hora Inicio</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                                value="{{ old('start_time') }}" placeholder="Hora Inicio" required>
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-6">
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
                </div>

                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ url('hours') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="card card-outline card-primary col-md-10">
            <div class="card-header">
                <h3 class="card-title">Calendario de Atención de Doctores</h3>
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
