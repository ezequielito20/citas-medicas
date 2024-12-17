@extends('layouts.admin')
@section('title', 'Ver Historial')

@section('content')
    <div class="row">
        <h1>Ver Historial</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detalles del Historial</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Paciente</label>
                        <select class="form-control" disabled>
                            <option>{{ $historial->patient->names }} {{ $historial->patient->last_names }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" disabled>
                            <option>{{ $historial->doctor->names }} {{ $historial->doctor->last_names }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Detalle de la Cita Médica</label>
                <textarea class="form-control" rows="5" disabled style="resize: none;">{{ $historial->detail }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha de Visita</label>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($historial->visit_date)->format('d/m/Y H:i') }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha de Creación</label>
                        <input type="text" class="form-control" value="{{ $historial->created_at->format('d/m/Y H:i') }}" disabled>
                    </div>
                </div>
            </div>

            <a href="{{ url('historial') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection() 