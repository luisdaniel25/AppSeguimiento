@extends('adminlte::page')

@section('title', 'Listado de aprendices')

@section('content_header')
    <h1>Aprendices</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('aprendices.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Aprendiz
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Documento</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Tipo Documento</th>
                        <th>Programa</th>
                        <th>Centro</th>
                        <th>EPS</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aprendices as $aprendice)
                        <tr>
                            <td>{{ $aprendice->NIS }}</td>
                            <td>{{ $aprendice->NumDoc }}</td>
                            <td>{{ $aprendice->Nombres }}</td>
                            <td>{{ $aprendice->Apellidos }}</td>

                            {{-- Tipo de Documento --}}
                            <td>
                                @if ($aprendice->tiposdocumento)
                                    {{ $aprendice->tiposdocumento->denominacion }}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif
                            </td>

                            {{-- Programa de Formación --}}
                            <td>
                                @if ($aprendice->programasdeformacion)
                                    {{ $aprendice->programasdeformacion->Denominacion }}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif
                            </td>

                            {{-- Centro de Formación --}}
                            <td>
                                @if ($aprendice->centrodeformacion)
                                    {{ $aprendice->centrodeformacion->Denominacion }}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif
                            </td>

                            {{-- EPS --}}
                            <td>
                                @if ($aprendice->eps)
                                    {{ $aprendice->eps->denominacion }}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('aprendices.show', $aprendice->NIS) }}" class="btn btn-sm btn-info"
                                    title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('aprendices.edit', $aprendice->NIS) }}" class="btn btn-sm btn-warning"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('aprendices.destroy', $aprendice->NIS) }}" method="POST"
                                    style="display: inline;" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No hay aprendices registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                {{ $aprendices->links() }}
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
