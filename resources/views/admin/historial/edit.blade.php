@extends('layouts.admin')
@section('title', 'Editar Historial')

@section('content')
    <div class="row">
        <h1>Editar Historial</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Historial</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('historial/' . $historial->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="patient_id">Paciente</label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                <option value="" disabled>Selecciona un paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ $historial->patient_id == $patient->id ? 'selected' : '' }}>
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
                                <option value="" disabled>Selecciona un doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ $historial->doctor_id == $doctor->id ? 'selected' : '' }}>
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
                                value="{{ date('Y-m-d\TH:i', strtotime($historial->visit_date)) }}" required>
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
                            <textarea class="form-control" id="detail" name="detail" rows="3" required>{{ $historial->detail }}</textarea>
                            @error('detail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection() 