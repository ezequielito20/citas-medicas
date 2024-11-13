@extends('layouts.admin')
@section('title', 'Crear Usuario')

@section('content')
    <div class="row">
        <h1>Usuario {{$user->name}} </h1>
    </div>
    <hr>

    <div class="card card-outline card-info">

        <div class="card-header">
            <h3 class="card-title">Editar Usuario</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('admin.users.store') }}" method="POST"> --}}
                {{-- @csrf --}}
                <div class="form-group">
                    <label for="name">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Nombre de Usuario" required disabled>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"  value="{{ $user->email }}" placeholder="Email" required disabled>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- <button type="submit" class="btn btn-primary">Crear</button> --}}
                <a href="{{ url('users') }}" class="btn btn-secondary">Cancelar</a>
            {{-- </form> --}}
        </div>
    </div>

@endsection()
