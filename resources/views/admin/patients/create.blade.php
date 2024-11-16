@extends('layouts.admin')
@section('title', 'Crear Paciente')

@section('content')
    <div class="row">
        <h1>Crear Paciente</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Crear Paciente</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.patients.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombres </label>
                            <input type="text" class="form-control" id="name" name="name"
                                value ="{{ old('name') }}" placeholder="Nombre de Usuario" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_names">Apellidos</label>
                            <input type="text" class="form-control" id="last_names" name="last_names"
                                value ="{{ old('last_names') }}" placeholder="Apellidos" required>
                            @error('last_names')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ci">C.I</label>
                            <input type="ci" class="form-control" id="ci" name="ci" value="{{ old('ci') }}" placeholder="C.I" required>
                            @error('ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value ="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value ="{{ old('phone') }}" placeholder="Teléfono">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birthdate">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" placeholder="Fecha de Nacimiento" >
                            @error('birthdate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Genero</label>
                            <select class="form-control" id="gender" name="gender" >
                                <option value="" disabled selected>Selecciona un genero</option>
                                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="blood_type">Tipo de sangre</label>
                            <select class="form-control" id="blood_type" name="blood_type" >
                                <option value="" disabled selected>Tipo de sangre</option>
                                <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            </select>
                            @error('blood_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="allergies">Alergias</label>
                            <input type="text" class="form-control" id="allergies" name="allergies"
                                value ="{{ old('allergies') }}" placeholder="Alergias" >
                            @error('allergies')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="emergency_contact">Contacto de emergencia</label>
                            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"
                                value ="{{ old('emergency_contact') }}" placeholder="Contacto de emergencia" >
                            @error('emergency_contact')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="health_insurance_number">Número de seguro</label>
                            <input type="text" class="form-control" id="health_insurance_number" name="health_insurance_number"
                                value ="{{ old('health_insurance_number') }}" placeholder="Número de seguro" >
                            @error('health_insurance_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="observations">Observaciones</label>
                            <input type="text" class="form-control" id="observations" name="observations"
                                value ="{{ old('observations') }}" placeholder="Observaciones" >
                            @error('observations')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"
                        placeholder="Dirección" >
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ url('patients') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection()
