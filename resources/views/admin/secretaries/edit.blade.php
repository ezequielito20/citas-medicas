@extends('layouts.admin')
@section('title', 'Crear Usuario')

@section('content')
    <div class="row">
        <h1> Editar {{ $secretary->names }} </h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">

                <div class="card-header">
                    <h3 class="card-title">Editar Secretaria</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('secretaries/' . $secretary->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nombres</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value ="{{ $secretary->names }}" placeholder="Nombre de Usuario" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_names">Apellidos</label>
                                    <input type="text" class="form-control" id="last_names" name="last_names"
                                        value ="{{ $secretary->last_names }}" placeholder="Apellidos" required>
                                    @error('last_names')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Phone">Teléfono</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value ="{{ $secretary->phone }}" placeholder="Teléfono" >
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_id">Seleccionar Usuario</label>
                                    <select class="form-control" id="user_id" name="user_id" required>
                                        <option value="" disabled selected>Selecciona un usuario</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ (old('user_id', $secretary->user_id) == $user->id) ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ci">C.I</label>
                                    <input type="ci" class="form-control" id="ci" name="ci"
                                        value="{{ $secretary->ci }}" placeholder="C.I" required>
                                    @error('ci')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="birthdate">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                                        value="{{ $secretary->birthdate }}" placeholder="Fecha de Nacimiento" >
                                    @error('birthdate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $secretary->address }}" placeholder="Dirección" >
                            @error('address')
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
