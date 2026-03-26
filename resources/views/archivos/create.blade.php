@extends('adminlte::page')

@section('title', 'Nueva Bitácora')

@section('content_header')
    <h1>Subir Nueva Bitácora</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Bitácora</h3>
                </div>

                <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data" id="form-bitacora">
                    @csrf

                    <div class="card-body">

                        {{-- Datos del aprendiz autenticado --}}
                        @if(isset($aprendiz))
                            <div class="alert alert-info">
                                <strong>Aprendiz:</strong> {{ $aprendiz->Nombres }} {{ $aprendiz->Apellidos }}<br>
                                <strong>NIS:</strong> {{ $aprendiz->NIS }}<br>
                                @if($aprendiz->programaDeFormacion)
                                    <strong>Programa:</strong> {{ $aprendiz->programaDeFormacion->Denominacion ?? 'No asignado' }}
                                @endif
                            </div>
                        @endif

                        {{-- Errores de validación --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Campo: archivo obligatorio --}}
                        <div class="form-group">
                            <label for="archivo">Archivo (Bitácora) *</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input @error('archivo') is-invalid @enderror"
                                           id="archivo"
                                           name="archivo"
                                           required>
                                    <label class="custom-file-label" for="archivo">Seleccionar archivo</label>
                                </div>
                            </div>
                            @error('archivo')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">
                                Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG (Máx. 10MB)
                            </small>
                        </div>

                        {{-- Campo: descripción opcional --}}
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion"
                                      id="descripcion"
                                      class="form-control @error('descripcion') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Describe brevemente el contenido de la bitácora...">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Máximo 500 caracteres (opcional)</small>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('archivos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Subir Bitácora</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Muestra el nombre del archivo seleccionado en el input
        $(document).ready(function() {
            bsCustomFileInput.init();
        });

        document.getElementById('form-bitacora').addEventListener('submit', function(e) {
            e.preventDefault();

            const archivo = document.getElementById('archivo');

            // Validar que haya archivo seleccionado
            if (!archivo.files || archivo.files.length === 0) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Debes seleccionar un archivo' });
                return;
            }

            // Validar tamaño máximo 10MB
            if (archivo.files[0].size > 10485760) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'El archivo no puede superar los 10MB' });
                return;
            }

            // Confirmación antes de enviar
            Swal.fire({
                title: '¿Subir bitácora?',
                text: "El archivo se guardará en el sistema",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, subir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Envía el formulario si confirma
                }
            });
        });
    </script>
@stop