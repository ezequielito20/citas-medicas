@extends('layouts.admin')
@section('title', 'Crear Usuario')

@section('content')
    <div class="row">
        <h1> Editar {{$user->name}} </h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">

                <div class="card-header">
                    <h3 class="card-title">Editar Usuario</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('users/'.$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="name" name="name" value ="{{$user->name}}" placeholder="Nombre de Usuario" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  value="{{$user->email}}" placeholder="Email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Contraseña">
                                @error('password')                    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}"
                                placeholder="Confirmar Contraseña" >
                                @error('password_confirmation')                    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <a href="{{ url('users') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection()
