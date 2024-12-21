@extends('layouts.admin')
@section('title', 'Editar Pago')

@section('content')
    <div class="row">
        <h1>Editar Pago</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Pago</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('payments/' . $payment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="patient_id">Paciente</label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                <option value="" disabled>Selecciona un paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" 
                                        {{ $payment->patient_id == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->names }} {{ $patient->last_names }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doctor_id">Doctor</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <option value="" disabled>Selecciona un doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" 
                                        {{ $payment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->names }} {{ $doctor->last_names }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Monto</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                value="{{ $payment->amount }}" required>
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_date">Fecha de Pago</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date"
                                value="{{ $payment->payment_date->format('Y-m-d') }}" required>
                            @error('payment_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $payment->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection()