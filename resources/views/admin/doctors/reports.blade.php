@extends('layouts.admin')
@section('title', 'Reporte de Doctores')

@section('content')
    <div class="row">
        <h1>Reporte de Doctores</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">

                <div class="card-header">
                    <h3 class="card-title">Generar Reporte</h3>
                </div>
                <div class="card-body">
                    <a href="{{ url('doctors/pdf') }}" class="btn btn-secondary"><i class="bi bi-printer-fill"></i>  Listado del Personal de Medicos  </a>
                </div>
            </div>
        </div>
    </div>
@endsection()
