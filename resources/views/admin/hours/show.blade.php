@extends('layouts.admin')
@section('title', 'Mostrar Horario')

@section('content')
    <div class="row">
        <h1>Mostrar Horario</h1>
    </div>
    <hr>
    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Mostrar Horario</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('admin.hours.edit') }}" method="POST">
                @csrf --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="day">Dia </label>
                            <input type="text" class="form-control" id="day" name="day"
                                value="{{ $hour->day }}" placeholder="Dia" disabled>
                            @error('day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_time">Hora Inicio</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                                value="{{ $hour->start_time }}" placeholder="Hora Inicio" disabled>
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_time">Hora de Fin</label>
                            <input type="time" class="form-control" id="end_time" name="end_time"
                                value="{{ $hour->end_time }}" disabled>
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
                            <select class="form-control" id="doctor_id" name="doctor_id" disabled>
                                {{-- <option value="" disabled selected>Selecciona un doctor</option>
                                @foreach ($doctors as $doctor) --}}
                                    <option value="{{ $hour->doctor->id }}" selected>
                                        {{ $hour->doctor->names }} ({{ $hour->doctor->specialization }})
                                    </option>
                                {{-- @endforeach --}}
                            </select>
                            @error('doctor_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="office_id">Seleccionar Consultorio</label>
                            <select class="form-control" id="office_id" name="office_id" disabled>
                                <option value="" disabled selected>Selecciona un consultorio</option>
                                {{-- @foreach ($offices as $office) --}}
                                    <option value="{{ $hour->office->id }}" selected>
                                        {{ $hour->office->name }} ({{ $hour->office->address }})
                                    </option>
                                {{-- @endforeach --}}
                            </select>
                            @error('office_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- <button type="submit" class="btn btn-primary">Crear</button> --}}
                <a href="{{ url('hours') }}" class="btn btn-secondary">Cancelar</a>
            {{-- </form> --}}
        </div>
    </div>

@endsection()
