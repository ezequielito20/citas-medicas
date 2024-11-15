@extends('layouts.admin')
@section('title', 'Mostrar Secretaria')

@section('content')
    <div class="row">
        <h1>Secretaria {{ $secretary->names}}</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Secretaria</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('admin.secretaries.sho') }}" method="POST">
                @csrf --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value ="{{ $secretary->names }}" placeholder="Nombre de Usuario" disabled>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_names">Apellidos</label>
                            <input type="text" class="form-control" id="last_names" name="last_names"
                                value ="{{ $secretary->last_names }}" placeholder="Apellidos" disabled>
                            @error('last_names')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value ="{{ $secretary->phone }}" placeholder="Teléfono" disabled>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user_id">Usuario</label>
                            <select class="form-control" id="user_id" name="user_id" disabled>
                                    <option value="{{ $secretary->user_id }}" selected>
                                        {{ $secretary->user->name }} ({{ $secretary->user->email }})
                                    </option>
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ci">C.I</label>
                            <input type="ci" class="form-control" id="ci" name="ci" value="{{ $secretary->ci }}" placeholder="C.I" disabled>
                            @error('ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birthdate">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate"
                                value="{{ $secretary->birthdate }}" placeholder="Fecha de Nacimiento" disabled>
                            @error('birthdate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $secretary->address }}"
                        placeholder="Dirección" disabled>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ url('secretaries') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection()
