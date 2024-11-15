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
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion fas bi bi-file-earmark-person"></i></i>
                </div>
                <a href="{{ url('users') }}" class="small-box-footer">Mas Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

@endsection()
