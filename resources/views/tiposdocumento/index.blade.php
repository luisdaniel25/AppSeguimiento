@extends('adminlte::page')

@section('title', 'Tipos de Documento')

@section('content_header')
    <h1>Listado de Tipos de Documento</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('tiposdocumento.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Nuevo Tipo de Documento
            </a>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tipos de Documento Registrados</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Denominación</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($tipos as $tipo)
                            <tr>
                                <td>{{ $tipo->nis }}</td>
                                <td>{{ $tipo->denominacion }}</td>
                                <td>{{ $tipo->observaciones }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('tiposdocumento.show', $tipo->nis) }}"
                                           class="btn btn-info btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('tiposdocumento.edit', $tipo->nis) }}"
                                           class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('tiposdocumento.destroy', $tipo->nis) }}" method="POST"
                                              class="d-inline form-eliminar">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    No hay tipos de documento registrados
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $tipos->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@include('sweetalert::alert')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación para eliminar con SweetAlert2
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Este tipo de documento será eliminado.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Mostrar mensaje de éxito si existe
            @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
            @endif
        });
    </script>
@stop
