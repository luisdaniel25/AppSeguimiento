@extends('adminlte::page')

@section('title', 'Listado de fichas')

@section('content_header')
    <h1>Fichas de Caracterización</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('fichas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Ficha
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>NIS</th>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Cupo</th>
                        <th>Instructor</th>
                        <th>Programa</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th width="120px">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($fichas as $ficha)
                        <tr>
                            <td>{{ $ficha->NIS }}</td>
                            <td>{{ $ficha->Codigo }}</td>
                            <td>{{ $ficha->Denominacion }}</td>
                            <td class="text-center">{{ $ficha->Cupo }}</td>

                            {{-- Instructor CORREGIDO --}}
                            <td>
                                @if($ficha->instructor)
                                    {{ $ficha->instructor->Nombres }} {{ $ficha->instructor->Apellidos }}
                                @else
                                    <span class="text-muted">Sin asignar</span>
                                @endif
                            </td>

                            {{-- Programa --}}
                            <td>
                                @if($ficha->programaDeFormacion)
                                    {{ $ficha->programaDeFormacion->Denominacion }}
                                @else
                                    <span class="text-muted">Sin programa</span>
                                @endif
                            </td>

                            {{-- Fechas --}}
                            <td>
                                @if($ficha->FechaInicio && $ficha->FechaFin)
                                    <small>
                                        <i class="far fa-calendar-alt"></i>
                                        {{ $ficha->FechaInicio->format('d/m/Y') }}<br>
                                        <i class="far fa-calendar-check"></i>
                                        {{ $ficha->FechaFin->format('d/m/Y') }}
                                    </small>
                                @else
                                    <span class="text-muted">
                                        <i class="far fa-calendar-times"></i> No definidas
                                    </span>
                                @endif
                            </td>

                            {{-- Estado de la ficha --}}
                            <td class="text-center">
                                @if($ficha->FechaInicio && $ficha->FechaFin)
                                    @php
                                        $hoy = now();
                                        $activa = $hoy->between($ficha->FechaInicio, $ficha->FechaFin);
                                    @endphp
                                    @if($activa)
                                        <span class="badge badge-success">Activa</span>
                                    @elseif($hoy > $ficha->FechaFin)
                                        <span class="badge badge-secondary">Finalizada</span>
                                    @else
                                        <span class="badge badge-warning">Próxima</span>
                                    @endif
                                @else
                                    <span class="badge badge-light">Sin fechas</span>
                                @endif
                            </td>

                            {{-- Acciones CORREGIDAS (con formulario) --}}
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('fichas.show', $ficha) }}"
                                       class="btn btn-sm btn-info"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('fichas.edit', $ficha) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('fichas.destroy', $ficha) }}"
                                          method="POST"
                                          style="display:inline;"
                                          class="form-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Eliminar ficha">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No hay fichas registradas</p>
                                <a href="{{ route('fichas.create') }}" class="btn btn-primary btn-sm mt-3">
                                    <i class="fas fa-plus"></i> Crear primera ficha
                                </a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $fichas->links() }}
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación eliminar
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede revertir",
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

            // Auto-cerrar alertas después de 5 segundos
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
@stop
