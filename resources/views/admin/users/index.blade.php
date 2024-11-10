@extends('layouts.admin')
@section('title', 'Usuarios')

@section('content')
<div class="row">
    <h1>Listado de Usuarios</h1>
</div>
<hr>
<div class="row">
    @foreach ($users as $user)
        <div class="col-md-4 ">
            <div class="card">
                <div class="card-body" style="background-color: #aafff4;">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        
    @endforeach
</div>

@endsection()