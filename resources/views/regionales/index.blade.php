@extends('adminlte::page')

@section('title', 'regionales')

{{-- HEADER SUPERIOR --}}
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Regionales</h1>

        <a href="{{ route('regionales.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nueva Regional
        </a>
    </div>
@stop

{{-- CONTENIDO PRINCIPAL --}}
@section('content')

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>NIS</th>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Observaciones</th>
                        <th width="250">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($regionales as $regional)
                        <tr>
                            <td>{{ $regional->NIS }}</td>
                            <td>{{ $regional->Codigo }}</td>
                            <td>{{ $regional->Denominacion }}</td>
                            <td>{{ $regional->Observaciones ?? 'Sin observaciones' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('regionales.show', $regional->NIS) }}" class="btn btn-sm btn-info"
                                       title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('regionales.edit', $regional->NIS) }}" class="btn btn-sm btn-warning"
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('regionales.destroy', $regional->NIS) }}" method="POST"
                                          style="display:inline;" class="form-eliminar">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay regionales registradas
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-3">
                {{ $regionales->links() }}
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
