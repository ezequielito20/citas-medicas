@extends('layouts.admin')
@section('title', 'Crear Historial')

@section('content')
    <div class="row">
        <h1>Crear Historial</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Crear Historial</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.historial.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="patient_id">Paciente</label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                <option value="" disabled selected>Selecciona un paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->names }} {{ $patient->last_names }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="doctor_id">Doctor</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <option value="" disabled selected>Selecciona un doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->names }} {{ $doctor->last_names }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="visit_date">Fecha y hora de la visita</label>
                            <input type="datetime-local" class="form-control" id="visit_date" name="visit_date" 
                                value="{{ old('visit_date') }}" required>
                            @error('visit_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="detail">Detalles de la visita médica</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3" required>{{ old('detail') }}</textarea>
                            @error('detail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection() 