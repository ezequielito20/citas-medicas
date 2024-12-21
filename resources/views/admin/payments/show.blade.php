@extends('layouts.admin')
@section('title', 'Ver Pago')

@section('content')
    <div class="row">
        <h1>Ver Pago</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detalles del Pago</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Paciente</label>
                        <input type="text" class="form-control" disabled
                            value="{{ $payment->patient->names }} {{ $payment->patient->last_names }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Doctor</label>
                        <input type="text" class="form-control" disabled
                            value="{{ $payment->doctor->names }} {{ $payment->doctor->last_names }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Monto</label>
                        <input type="text" class="form-control" disabled
                            value="{{ number_format($payment->amount, 2) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha de Pago</label>
                        <input type="text" class="form-control" disabled
                            value="{{ $payment->payment_date->format('d/m/Y') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" disabled>{{ $payment->description }}</textarea>
            </div>

            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection()