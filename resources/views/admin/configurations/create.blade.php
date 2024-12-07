@extends('layouts.admin')
@section('title', 'Crear Configuracion')

@section('content')
    <div class="row">
        <h1>Crear Configuracion</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Crear Configuracion</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.configurations.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombre </label>
                            <input type="text" class="form-control" id="name" name="name"
                                value ="{{ old('name') }}" placeholder="Nombre de Usuario" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" placeholder="Correo">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value ="{{ old('phone') }}" placeholder="Teléfono">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address') }}" placeholder="Dirección">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ url('configurations') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection()
