@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Crear Rol Administrativo')

@section('content_header')
    <h1>Crear Rol Administrativo</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="{{ route('rolesadministrativos.store') }}" method="POST" class="form-guardar">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label>Descripción *</label>
                            <input type="text" name="Descripcion"
                                class="form-control @error('Descripcion') is-invalid @enderror"
                                value="{{ old('Descripcion') }}" required>

                            @error('Descripcion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Rol</button>
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
                        text: "Se registrará el nuevo rol administrativo.",
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
