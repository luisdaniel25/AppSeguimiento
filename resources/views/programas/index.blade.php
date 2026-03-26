@extends('adminlte::page')

@section('title', 'Listado de programas de Formación')

@section('content_header')
    <h1>Programas de Formación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('programas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Programa
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th>Fichas de Caracterización</th>
                    <th>Aprendices</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($programas as $programa)
                    <tr>
                        <td>{{ $programa->NIS }}</td>
                        <td>{{ $programa->Codigo }}</td>
                        <td>{{ $programa->Denominacion }}</td>
                        <td>{{ $programa->Observaciones ?? '-' }}</td>

                        {{-- fichas de Caracterización --}}
                        <td>
                            @if ($programa->fichasCaracterizacion && $programa->fichasCaracterizacion->count() > 0)
                                @foreach($programa->fichasCaracterizacion as $ficha)
                                    <span class="badge badge-info">
                                            Ficha #{{ $ficha->NIS }} - {{ $ficha->Denominacion }}
                                        </span>
                                    <br>
                                @endforeach
                            @else
                                <span class="badge badge-secondary">Sin fichas</span>
                            @endif
                        </td>
                        {{-- Contador de aprendices --}}
                        <td>
                            <span class="badge badge-info">{{ $programa->aprendices_count }} aprendices</span>
                        </td>

                        <td>
                            <a href="{{ route('programas.show', $programa->NIS) }}" class="btn btn-sm btn-info"
                               title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('programas.edit', $programa->NIS) }}" class="btn btn-sm btn-warning"
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('programas.destroy', $programa->NIS) }}" method="POST"
                                  style="display: inline;" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"
                                    {{ $programa->aprendices_count > 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay programas registrados</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                {{ $programas->links() }}
            </div>
        </div>
    </div>
@stop

@include('sweetalert::alert')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación para eliminar
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
