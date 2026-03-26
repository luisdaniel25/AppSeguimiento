@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Editar Tipo de Documento')

@section('content_header')
    <h1>Editar Tipo de Documento #{{ $tiposdocumento->nis }}</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>

                <form action="{{ route('tiposdocumento.update', $tiposdocumento) }}" method="POST" class="form-guardar">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- NIS (solo lectura) --}}
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control"
                                value="{{ old('nis', $tiposdocumento->nis) }}" readonly>
                        </div>

                        {{-- Denominación --}}
                        <div class="form-group">
                            <label>Denominación *</label>
                            <input type="text" name="denominacion"
                                class="form-control @error('denominacion') is-invalid @enderror"
                                value="{{ old('denominacion', $tiposdocumento->denominacion) }}" required>

                            @error('denominacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" rows="3" class="form-control @error('observaciones') is-invalid @enderror">{{ old('observaciones', $tiposdocumento->observaciones) }}</textarea>

                            @error('observaciones')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('tiposdocumento.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-warning">
                            Actualizar Tipo de Documento
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
            document.querySelectorAll('.form-guardar').forEach(form => {
                form.addEventListener('submit', function(e) {

                    if (!form.checkValidity()) return;

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Deseas actualizar?',
                        text: "Se modificarán los datos del tipo de documento.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });
            });
        });
    </script>
@stop
