@extends('layouts.admin')
@section('title', 'Ver Configuracion')

@section('content')
    <div class="row">
        <h1>Configuracion</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title"> Configuracion</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('admin.configurations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre </label>
                                <input type="text" class="form-control" id="name" name="name" disabled
                                    value="{{ $configuration->name }}" placeholder="Nombre de Usuario" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" disabled
                                    value="{{ $configuration->email }}" placeholder="Correo">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Phone">Teléfono</label>
                                <input type="text" class="form-control" id="phone" name="phone" disabled
                                    value="{{ $configuration->phone }}" placeholder="Teléfono">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input type="text" class="form-control" id="address" name="address" disabled
                                    value="{{ $configuration->address }}" placeholder="Dirección">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-center">
                        <label for="file" class="form-label">Logotipo</label>
                        <br>
                        <div
                            style="display: inline-block; border: 1px solid #ddd; border-radius: 8px; padding: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); max-width: 300px;">
                            <img src="{{ asset('storage/' . $configuration->logo) }}" alt="Logo de la configuración"
                                style="width: 100%; height: auto; border-radius: 8px;">
                        </div>
                        @error('logo')
                            <span class="text-danger d-block mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            {{-- <button type="submit" class="btn btn-primary">Crear</button> --}}
            <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
            {{-- </form> --}}
        </div>
    </div>

@endsection()
