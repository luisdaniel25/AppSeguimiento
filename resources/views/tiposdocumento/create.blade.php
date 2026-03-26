@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Crear Tipo de Documento')

@section('content_header')
    <h1>Registrar Tipo de Documento</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="{{ route('tiposdocumento.store') }}" method="POST" class="form-guardar">
                    @csrf

                    <div class="card-body">

                        {{-- Denominación --}}
                        <div class="form-group">
                            <label>Denominación *</label>
                            <input type="text" name="denominacion"
                                class="form-control @error('denominacion') is-invalid @enderror"
                                value="{{ old('denominacion') }}" required>

                            @error('denominacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" rows="3">{{ old('observaciones') }}</textarea>

                            @error('observaciones')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('tiposdocumento.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Tipo</button>
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
                        title: '¿Deseas guardar?',
                        text: "Se registrará el nuevo tipo de documento.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, guardar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
@stop
