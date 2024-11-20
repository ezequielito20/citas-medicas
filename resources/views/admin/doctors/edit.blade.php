@extends('layouts.admin')
@section('title', 'Editar Doctor')

@section('content')
    <div class="row">
        <h1>Editar Doctor</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Editar Doctor</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('doctors/' . $doctor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombres </label>
                            <input type="text" class="form-control" id="name" name="name"
                                value ="{{ $doctor->names }}" placeholder="Nombre de Usuario" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_names">Apellidos</label>
                            <input type="text" class="form-control" id="last_names" name="last_names"
                                value ="{{ $doctor->last_names }}" placeholder="Apellidos" required>
                            @error('last_names')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value ="{{ $doctor->phone }}" placeholder="Teléfono">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="medical_leave">Licencia Medica</label>
                            <input type="text" class="form-control" id="medical_leave" name="medical_leave"
                                value="{{ $doctor->medical_leave }}" placeholder="Licencia Medica" required>
                            @error('medical_leave')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="specialization">Especialidad</label>
                            <input type="text" class="form-control" id="specialization" name="specialization"
                                value="{{ $doctor->specialization }}" placeholder="Especialidad" required>
                            @error('specialization')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">Seleccionar Usuario</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="" disabled selected>Selecciona un usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $doctor->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="office_id">Seleccionar Consultorio</label>
                            <select class="form-control" id="office_id" name="office_id" required>
                                <option value="" disabled selected>Selecciona un consultorio</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}" {{ $doctor->office_id == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }} ({{ $office->address }})
                                    </option>
                                @endforeach
                            </select>
                            @error('office_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ url('doctors') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection()
