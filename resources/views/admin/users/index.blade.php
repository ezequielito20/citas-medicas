@extends('layouts.admin')
@section('title', 'Usuarios')

@section('content')
    <div class="row">
        <h1>Listado de Usuarios</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Usuarios Registrados</h3>

            <div class="card-tools">
                <a href="{{ url('users/create') }}" class="btn btn-primary">
                    Registrar Nuevo
                </a>
            </div>
        </div>
        <div class="card-body">
            
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aciones</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row" style="text-align: center;">{{ $cont++ }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                ver / editar / eliminar
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>



@endsection()
