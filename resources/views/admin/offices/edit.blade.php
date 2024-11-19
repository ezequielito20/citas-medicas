@extends('layouts.admin')
@section('title', 'Editar Consultorio')

@section('content')
    <div class="row">
        <h1>Editar Consultorio</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Datos del Consultorio</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('offices/' . $office->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombre </label>
                            <input type="text" class="form-control" id="name" name="name"
                                value ="{{ $office->name }}" placeholder="Nombre de Usuario" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $office->address }}" placeholder="Dirección">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="capacity">Capacidad</label>
                            <input type="text" class="form-control" id="capacity" name="capacity"
                                value="{{ $office->capacity }}" placeholder="Capacidad">
                            @error('capacity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value ="{{ $office->phone }}" placeholder="Teléfono">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="specialization">Especialidad</label>
                            <input type="text" class="form-control" id="specialization" name="specialization"
                                value="{{ $office->specialization }}" placeholder="Especialidad">
                            @error('specialization')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control"  id="status" name="status">
                                <option value="" disabled {{ empty($office->status) ? 'selected' : '' }}>Selecciona un status</option>
                                <option value="Activo" {{ (old('status', $office->status) == 'Activo') ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ (old('status', $office->status) == 'Inactivo') ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Editar</button>
                <a href="{{ url('offices') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection()
