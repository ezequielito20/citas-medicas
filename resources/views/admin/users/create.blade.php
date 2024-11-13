@extends('layouts.admin')
@section('title', 'Crear Usuario')

@section('content')
    <div class="row">
        <h1>Crear Usuario</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-header">
            <h3 class="card-title">Crear Usuario</h3>
        </div>
        <div class="card-body">
            @if ($message = Session::get('error'))
                <h2>hola</h2>
                {{-- <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "{{$message}}",
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script> --}}
            @endif
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Usuario" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                        required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirmar Contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ url('users') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection()
