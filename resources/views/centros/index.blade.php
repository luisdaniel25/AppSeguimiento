@extends('adminlte::page')

@section('title', 'centros de Formación')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Centros de Formación</h1>

        <a href="{{ route('centros.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nuevo Centro
        </a>
    </div>
@stop

@section('content')

    {{-- TABLA --}}
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Listado de Centros
                <span class="badge badge-info">
                {{ $centros->total() }} registros
            </span>
            </h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Dirección</th>
                    <th>Observaciones</th>
                    <th>Regional</th>
                    <th width="160">Acciones</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($centros as $centro)
                    <tr>
                        <td>{{ $centro->NIS }}</td>
                        <td>{{ $centro->Codigo }}</td>
                        <td>{{ $centro->Denominacion }}</td>
                        <td>{{ $centro->Direccion }}</td>
                        <td>{{ $centro->Observaciones ?? 'Sin observaciones' }}</td>
                        <td>
                            {{ $centro->regionale?->Denominacion ?? 'N/A' }}
                        </td>

                        <td>
                            <div class="btn-group">

                                {{-- VER --}}
                                <a href="{{ route('centros.show', $centro->NIS) }}"
                                   class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- EDITAR --}}
                                <a href="{{ route('centros.edit', $centro->NIS) }}"
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- ELIMINAR --}}
                                <form action="{{ route('centros.destroy', $centro->NIS) }}"
                                      method="POST"
                                      style="display:inline"
                                      class="form-eliminar">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No hay centros registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        @if($centros->hasPages())
            <div class="card-footer">
                {{ $centros->links() }}
            </div>
        @endif

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
                        text: "¡No podrás revertir esto!",
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
