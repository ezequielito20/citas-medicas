@extends('layouts.admin')
@section('title', 'Editar Configuracion')

@section('content')
    <div class="row">
        <h1>Editar Configuracion</h1>
    </div>
    <hr>

    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title">Editar Configuracion</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('configurations/' . $configuration->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value ="{{ $configuration->name }}" placeholder="Nombre de Usuario" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input type="email" class="form-control" id="email" name="email"
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
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value ="{{ $configuration->phone }}" placeholder="Teléfono">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Dirección</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $configuration->address }}" placeholder="Dirección">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file">Logo</label>
                            <input type="file" class="form-control" id="file" name="file">
                            <center><output id="list"></output></center>
                            <div id="current-logo-container"
                                style="display: inline-block; border: 1px solid #ddd; border-radius: 8px; padding: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); max-width: 300px;">
                                <img src="{{ asset('storage/' . $configuration->logo) }}" alt="Logo de la configuración"
                                    style="width: 100%; height: auto; border-radius: 8px;">
                            </div>
                            @error('logo')
                                <span class="text-danger d-block mt-2">{{ $message }}</span>
                            @enderror
                            <script>
                                function archivo(evt) {
                                    var files = evt.target.files; // Filelist object

                                    // Obtenemos la imagen del campo "file"
                                    for (var i = 0, f; f = files[i]; i++) {
                                        // Solo admitimos imágenes.
                                        if (!f.type.match('image.*')) {
                                            continue;
                                        }

                                        // Ocultamos el contenedor de la imagen actual
                                        const currentLogoContainer = document.getElementById('current-logo-container');
                                        if (currentLogoContainer) {
                                            currentLogoContainer.style.display = 'none';
                                        }

                                        var reader = new FileReader();
                                        reader.onload = (function(theFile) {
                                            return function(e) {
                                                // Insertamos la nueva imagen
                                                document.getElementById('list').innerHTML = ['<img class="thumb thumbnail" src="', e
                                                    .target.result, '" width="100%" title="', escape(theFile.name), '"/>'
                                                ].join('');
                                            };
                                        })(f);
                                        reader.readAsDataURL(f);
                                    }
                                }

                                document.getElementById('file').addEventListener('change', archivo, false);
                            </script>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ url('configurations') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

@endsection()
