@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')
    <h1>Mi Perfil</h1>
@stop

@section('content')

    @if(session('success'))
        <x-adminlte-alert theme="success" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <div class="row">


        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body text-center">

                    {{--  foto --}}
                    <img src="{{ auth()->user()->adminlte_image() }}"
                         class="profile-user-img img-fluid img-circle elevation-2"
                         style="width:120px; height:120px; object-fit:cover;"
                         alt="Foto de perfil">

                    <h5 class="mt-3 mb-0">{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->adminlte_desc() }}</p>
                </div>
            </div>
        </div>

        {{--Formulario --}}
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar información</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nombre --}}
                        <x-adminlte-input
                            name="name"
                            label="Nombre completo"
                            value="{{ auth()->user()->name }}"
                            required/>

                        {{-- Email --}}
                        <x-adminlte-input
                            name="email"
                            label="Correo electrónico"
                            type="email"
                            value="{{ auth()->user()->email }}"
                            required/>

                        {{-- Avatar --}}
                        <div class="form-group">
                            <label>Foto de perfil</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input @error('avatar') is-invalid @enderror"
                                           id="avatar"
                                           name="avatar"
                                           accept="image/*">
                                    <label class="custom-file-label" for="avatar">
                                        Seleccionar imagen...
                                    </label>
                                </div>
                            </div>
                            @error('avatar')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">JPG,PNG. Máximo 2MB.</small>
                        </div>

                        {{-- Vista previa de la foto  --}}
                        <div class="mb-3" id="preview-container" style="display:none;">
                            <img id="preview-img"
                                 class="img-thumbnail"
                                 style="max-height: 150px;">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Guardar cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop

@section('js')
    <script>
        document.getElementById('avatar').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            document.querySelector('.custom-file-label').textContent = file.name;

            const reader = new FileReader();
            reader.onload = (ev) => {
                document.getElementById('preview-img').src = ev.target.result;
                document.getElementById('preview-container').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    </script>
@stop
