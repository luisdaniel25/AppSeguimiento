@extends('adminlte::page')

@section('title', 'Crear Programa de Formación')

@section('content_header')
    <h1>Registro de Programa de Formación</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="{{ route('programas.store') }}" method="POST" class="form-guardar">
                    @csrf

                    <div class="card-body">

                        {{-- Código --}}
                        <div class="form-group">
                            <label>Código *</label>
                            <input type="number" name="Codigo" class="form-control @error('Codigo') is-invalid @enderror"
                                   value="{{ old('Codigo') }}" required>

                            @error('Codigo')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Denominación --}}
                        <div class="form-group">
                            <label>Denominación *</label>
                            <input type="text" name="Denominacion"
                                   class="form-control @error('Denominacion') is-invalid @enderror"
                                   value="{{ old('Denominacion') }}" required>

                            @error('Denominacion')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="Observaciones" class="form-control @error('Observaciones') is-invalid @enderror" rows="3">{{ old('Observaciones') }}</textarea>

                            @error('Observaciones')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('programas.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Guardar Programa
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop

@include('sweetalert::alert')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación para guardar
            document.querySelectorAll('.form-guardar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) return;

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Deseas guardar?',
                        text: "Se registrará el nuevo programa de formación.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, guardar',
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
