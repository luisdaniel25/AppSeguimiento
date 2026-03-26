@extends('adminlte::page')

@section('title', 'Detalle Programa de Formación')

@section('content_header')
    <h1>Detalle del Programa de Formación</h1>
@stop

@section('content')
    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $programa->Denominacion }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $programa->NIS }}</p>
            <p><strong>Código:</strong> {{ $programa->Codigo }}</p>
            <p><strong>Denominación:</strong> {{ $programa->Denominacion }}</p>
            <p><strong>Observaciones:</strong> {{ $programa->Observaciones ?? 'N/A' }}</p>

            <hr>

            {{-- fichas de Caracterización --}}
            <p><strong>Fichas de Caracterización:</strong></p>
            @if ($programa->fichasCaracterizacion && $programa->fichasCaracterizacion->count() > 0)
                <div class="ml-3">
                    @foreach($programa->fichasCaracterizacion as $ficha)
                        <div class="mb-2 p-2 border-left border-info">
                            <strong>Ficha #{{ $ficha->NIS }}</strong><br>
                            <small>Denominación: {{ $ficha->Denominacion }}</small><br>
                            <small>Cupo: {{ $ficha->Cupo }}</small><br>
                            <small>Instructor: {{ $ficha->instructor->Nombres ?? 'N/A' }} {{ $ficha->instructor->Apellidos ?? '' }}</small><br>
                            <small>Vigencia: {{ \Carbon\Carbon::parse($ficha->FechaInicio)->format('d-m-Y') }} al {{ \Carbon\Carbon::parse($ficha->FechaFin)->format('d-m-Y') }}</small>
                        </div>
                    @endforeach
                </div>
            @else
                <p><span class="badge badge-secondary">No hay fichas asociadas</span></p>
            @endif

            {{-- aprendices Asignados --}}
            <p><strong>Aprendices Asignados:</strong></p>
            @if ($programa->aprendices && $programa->aprendices->count() > 0)
                <ul class="list-group mb-3">
                    @foreach ($programa->aprendices as $aprendiz)
                        <li class="list-group-item">
                            {{ $aprendiz->Nombres }} {{ $aprendiz->Apellidos }}
                            <small class="text-muted">(Doc: {{ $aprendiz->NumDoc }})</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p><span class="badge badge-secondary">No hay aprendices asignados</span></p>
            @endif

            <hr>
            <p><strong>Fecha de Creación:</strong>
                {{ $programa->created_at ? $programa->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>
            <p><strong>Última Actualización:</strong>
                {{ $programa->updated_at ? $programa->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}
        <div class="card-footer">
            <a href="{{ route('programas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('programas.edit', $programa->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
@stop
