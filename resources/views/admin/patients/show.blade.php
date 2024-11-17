@extends('layouts.admin')
@section('title', 'Mostrar Paciente')

@section('content')
    <div class="row">
        <h1>Mostrar Paciente</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Mostrar Paciente</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('admin.patients.store') }}" method="POST">
                @csrf --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Nombres </label>
                        <input type="text" class="form-control" disabled id="name" name="name"
                            value ="{{ $patient->names }}" placeholder="Nombre de Usuario" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="last_names">Apellidos</label>
                        <input type="text" class="form-control" disabled id="last_names" name="last_names"
                            value ="{{ $patient->last_names }}" placeholder="Apellidos" required>
                        @error('last_names')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ci">C.I</label>
                        <input type="ci" class="form-control" disabled id="ci" name="ci" value="{{ $patient->ci }}"
                            placeholder="C.I" required>
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
                        <input type="email" class="form-control" disabled id="email" name="email"
                            value ="{{ $patient->email }}" placeholder="Email" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" class="form-control" disabled id="phone" name="phone"
                            value ="{{ $patient->phone }}" placeholder="Teléfono">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="birthdate">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" disabled id="birthdate" name="birthdate"
                            value="{{ $patient->birthdate }}" placeholder="Fecha de Nacimiento">
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
                        <select class="form-control" disabled id="gender" name="gender">
                            <option value="" disabled selected>Selecciona un genero</option>
                            <option value="M" {{ ($patient->gender ?? old('gender')) == 'M' ? 'selected' : '' }}>
                                Masculino</option>
                            <option value="F" {{ ($patient->gender ?? old('gender')) == 'F' ? 'selected' : '' }}>
                                Femenino</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="blood_type">Tipo de sangre</label>
                        <select class="form-control" disabled id="blood_type" name="blood_type">
                            <option value="" disabled {{ $patient->blood_type == null ? 'selected' : '' }}>Tipo de
                                sangre</option>
                            <option value="A+"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="O+"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'O-' ? 'selected' : '' }}>O-</option>
                            <option value="AB+"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-"
                                {{ ($patient->blood_type ?? old('blood_type')) == 'AB-' ? 'selected' : '' }}>AB-</option>
                        </select>

                        @error('blood_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="allergies">Alergias</label>
                        <input type="text" class="form-control" disabled id="allergies" name="allergies"
                            value ="{{ $patient->allergies ?? old('allergies') }}" placeholder="Alergias">
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
                        <input type="text" class="form-control" disabled id="emergency_contact" name="emergency_contact"
                            value ="{{ $patient->emergency_contact ?? old('emergency_contact') }}"
                            placeholder="Contacto de emergencia">
                        @error('emergency_contact')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="health_insurance_number">Número de seguro</label>
                        <input type="text" class="form-control" disabled id="health_insurance_number"
                            name="health_insurance_number" value ="{{ $patient->health_insurance_number ?? old('health_insurance_number') }}"
                            placeholder="Número de seguro">
                        @error('health_insurance_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="observations">Observaciones</label>
                        <input type="text" class="form-control" disabled id="observations" name="observations"
                            value ="{{$patient->observations ?? old('observations') }}"
                            placeholder="Observaciones">
                        @error('observations')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" disabled id="address" name="address" value="{{ $patient->address ?? old('address') }}"
                    placeholder="Dirección">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {{-- <button type="submit" class="btn btn-primary">Crear</button> --}}
            <a href="{{ url('patients') }}" class="btn btn-secondary">Cancelar</a>
            {{-- </form> --}}
        </div>
    </div>

@endsection()
