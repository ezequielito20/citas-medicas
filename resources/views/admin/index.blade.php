@extends('layouts.admin')
@section('title', 'Reserva de Citas Medicas')

@section('content')
    <div class="row">
        <h1>Panel Principal</h1>
    </div>

    <div class="row">
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
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #dd26f1;">
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
    </div>

@endsection()
