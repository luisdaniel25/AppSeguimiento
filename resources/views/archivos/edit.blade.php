@extends('adminlte::page')

@section('title', 'Editar Archivo')

@section('content_header')
    <h1>Editar Archivo</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modificar información del archivo</h3>
                </div>

                <form action="{{ route('archivos.update', $archivo->id) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="form-actualizar">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- Selector de aprendiz --}}
                        <div class="form-group">
                            <label>Seleccionar Aprendiz *</label>
                            <select name="tbl_aprendices_NIS"
                                    class="form-control @error('tbl_aprendices_NIS') is-invalid @enderror"
                                    required>
                                <option value="">-- Seleccione --</option>
                                @foreach($aprendices as $aprendiz)
                                    <option value="{{ $aprendiz->NIS }}"
                                        {{ old('tbl_aprendices_NIS', $archivo->tbl_aprendices_NIS) == $aprendiz->NIS ? 'selected' : '' }}>
                                        {{ $aprendiz->Nombres }} {{ $aprendiz->Apellidos }}
                                        ({{ $aprendiz->programaDeFormacion->Denominacion ?? 'Sin programa' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('tbl_aprendices_NIS')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Campo descripción --}}
                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text"
                                   name="descripcion"
                                   class="form-control @error('descripcion') is-invalid @enderror"
                                   value="{{ old('descripcion', $archivo->descripcion) }}"
                                   placeholder="Descripción del archivo">
                            @error('descripcion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Vista previa del archivo actual con icono según tipo MIME --}}
                        <div class="form-group">
                            <label>Archivo actual</label><br>
                            <div class="d-flex align-items-center">
                                @if(Str::startsWith($archivo->tipo_mime, 'image'))
                                    <img src="{{ asset('storage/' . $archivo->ruta) }}"
                                         width="50" height="50"
                                         class="rounded mr-2"
                                         style="object-fit: cover;">
                                @else
                                    @if(Str::contains($archivo->tipo_mime, 'pdf'))
                                        <i class="fas fa-file-pdf text-danger fa-2x mr-2"></i>
                                    @elseif(Str::contains($archivo->tipo_mime, 'word') || Str::contains($archivo->tipo_mime, 'document'))
                                        <i class="fas fa-file-word text-primary fa-2x mr-2"></i>
                                    @elseif(Str::contains($archivo->tipo_mime, 'excel') || Str::contains($archivo->tipo_mime, 'sheet'))
                                        <i class="fas fa-file-excel text-success fa-2x mr-2"></i>
                                    @else
                                        <i class="fas fa-file text-secondary fa-2x mr-2"></i>
                                    @endif
                                @endif
                                <span class="ml-2">{{ $archivo->nombre_original }}</span>
                                <a href="{{ route('archivos.show', $archivo->id) }}"
                                   class="btn btn-info btn-sm ml-3" target="_blank">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('archivos.download', $archivo->id) }}"
                                   class="btn btn-success btn-sm ml-2">
                                    <i class="fas fa-download"></i> Descargar
                                </a>
                            </div>
                        </div>

                        {{-- Reemplazar archivo (opcional) --}}
                        <div class="form-group">
                            <label>Reemplazar archivo (opcional)</label>
                            <div class="custom-file">
                                <input type="file"
                                       name="archivo"
                                       class="custom-file-input @error('archivo') is-invalid @enderror"
                                       id="customFile"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">
                                    {{ $archivo->nombre_original }}
                                </label>
                            </div>
                            @error('archivo')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                Si no seleccionas uno, se mantiene el actual. Permitidos: PDF, Word, Excel, Imágenes (Máx 10MB)
                            </small>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('archivos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Actualiza el label con el nombre del nuevo archivo seleccionado
            const inputFile = document.getElementById('customFile');
            if (inputFile) {
                inputFile.addEventListener('change', function(e) {
                    let fileName = e.target.files[0]?.name || 'Elegir nuevo archivo';
                    e.target.nextElementSibling.innerText = fileName;
                });
            }

            // Confirmación SweetAlert antes de guardar cambios
            const form = document.querySelector('.form-actualizar');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Actualizar archivo?',
                        text: "Los cambios serán guardados permanentemente",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#ffc107',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }

            // Muestra error de sesión si existe
            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 5000,
                showConfirmButton: true
            });
            @endif
        });
    </script>
@stop