@extends('adminlte::page')

@section('title', 'Detalle Ficha de Caracterización')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-file-alt mr-2"></i>
            Detalle de la Ficha #{{ $ficha->NIS }}
        </h1>

        {{-- Badge de estado --}}
        @php
            $estado = 'Sin fechas';
            $color = 'secondary';

            if ($ficha->FechaInicio && $ficha->FechaFin) {
                $hoy = now();
                if ($hoy->between($ficha->FechaInicio, $ficha->FechaFin)) {
                    $estado = 'Activa';
                    $color = 'success';
                } elseif ($hoy > $ficha->FechaFin) {
                    $estado = 'Finalizada';
                    $color = 'secondary';
                } else {
                    $estado = 'Próxima';
                    $color = 'warning';
                }
            }
        @endphp
        <span class="badge badge-{{ $color }} badge-lg">
            <i class="fas fa-{{ $color == 'success' ? 'check-circle' : ($color == 'warning' ? 'clock' : 'calendar') }} mr-1"></i>
            {{ $estado }}
        </span>
    </div>
@stop

@section('content')
    <div class="row">
        {{-- Información principal --}}
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Información de la Ficha
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="30%">NIS:</th>
                            <td>
                                <span class="badge badge-dark">{{ $ficha->NIS }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Código:</th>
                            <td>{{ $ficha->Codigo }}</td>
                        </tr>
                        <tr>
                            <th>Denominación:</th>
                            <td>{{ $ficha->Denominacion }}</td>
                        </tr>
                        <tr>
                            <th>Cupo:</th>
                            <td>
                                <span class="badge badge-{{ $ficha->Cupo > 0 ? 'success' : 'danger' }} badge-pill">
                                    {{ $ficha->Cupo }} cupos
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Instructor:</th>
                            <td>
                                @if($ficha->instructor)
                                    <i class="fas fa-chalkboard-teacher mr-1 text-primary"></i>
                                    {{ $ficha->instructor->Nombres }} {{ $ficha->instructor->Apellidos }}
                                    <small class="text-muted ml-2">(NIS: {{ $ficha->instructor->NIS }})</small>
                                @else

                                    <span class="text-muted">No asignado</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha Inicio:</th>
                            <td>
                                @if($ficha->FechaInicio)
                                    <i class="fas fa-calendar-alt mr-1 text-success"></i>
                                    {{ $ficha->FechaInicio->format('d-m-Y') }}
                                @else
                                    <span class="text-muted">No definida</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha Fin:</th>
                            <td>
                                @if($ficha->FechaFin)
                                    <i class="fas fa-calendar-check mr-1 text-warning"></i>
                                    {{ $ficha->FechaFin->format('d-m-Y') }}
                                @else
                                    <span class="text-muted">No definida</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Observaciones:</th>
                            <td>
                                {{ $ficha->Observaciones ?? 'Sin observaciones' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Información de auditoría --}}
        <div class="col-md-4">
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-2"></i>
                        Auditoría
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th><i class="fas fa-clock mr-1"></i> Creado:</th>
                            <td>
                                {{ $ficha->created_at ? $ficha->created_at->format('d-m-Y H:i:s') : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-sync-alt mr-1"></i> Actualizado:</th>
                            <td>
                                {{ $ficha->updated_at ? $ficha->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Card de resumen rápido --}}
            <div class="card card-info card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Resumen
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th>Días transcurridos:</th>
                            <td>
                                @if($ficha->FechaInicio)
                                    {{ $ficha->FechaInicio->diffInDays(now()) }} días
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Días restantes:</th>
                            <td>
                                @if($ficha->FechaFin && $ficha->FechaFin > now())
                                    {{ now()->diffInDays($ficha->FechaFin) }} días
                                @elseif($ficha->FechaFin && $ficha->FechaFin <= now())
                                    0 días
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Programa asociado --}}
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Programa de Formación Asociado
                    </h3>
                </div>

                <div class="card-body p-0">
                    @if($ficha->programaDeFormacion)
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Denominación</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $ficha->programaDeFormacion->Codigo ?? 'N/A' }}</td>
                                <td>{{ $ficha->programaDeFormacion->Denominacion }}</td>
                                <td>
                                    <a href="{{ route('programas.show', $ficha->programaDeFormacion) }}"
                                       class="btn btn-xs btn-info"
                                       title="Ver programa">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="text-center p-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">No hay programa asociado a esta ficha</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Botones de acción --}}
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card-footer bg-white d-flex justify-content-between">
                <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Volver al listado
                </a>

                <div>
                    <a href="{{ route('fichas.edit', $ficha) }}" class="btn btn-warning">
                        <i class="fas fa-edit mr-1"></i> Editar Ficha
                    </a>

                    <form action="{{ route('fichas.destroy', $ficha) }}"
                          method="POST"
                          style="display:inline;"
                          class="form-eliminar">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ml-2">
                            <i class="fas fa-trash mr-1"></i> Eliminar Ficha
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .table th {
            background-color: #f4f6f9;
            font-weight: 600;
        }
        .badge-lg {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        .card-footer {
            border-top: 1px solid #dee2e6;
            background-color: #fff;
        }
        .table-sm th, .table-sm td {
            padding: 0.75rem;
        }
    </style>
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
                        title: '¿Eliminar ficha?',
                        text: "Esta acción no se puede revertir",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Deshabilitar botón para evitar doble envío
                            const btn = this.querySelector('button[type="submit"]');
                            if (btn) btn.disabled = true;
                            this.submit();
                        }
                    });
                });
            });

            // Tooltips automáticos de Bootstrap
            $('[title]').tooltip();
        });
    </script>
@stop
