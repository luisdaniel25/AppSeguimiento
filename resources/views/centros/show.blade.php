@extends('adminlte::page')

@section('title', 'Detalle Centro')

@section('content_header')
    <h1>Detalle del Centro de Formación</h1>
@stop

@section('content')

    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $centro->Denominacion }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $centro->NIS }}</p>

            <p><strong>Código:</strong> {{ $centro->Codigo }}</p>

            <p><strong>Denominación:</strong> {{ $centro->Denominacion }}</p>

            <p><strong>Dirección:</strong>
                {{ $centro->Direccion ?? 'N/A' }}
            </p>

            <p><strong>Observaciones:</strong>
                {{ $centro->Observaciones ?? 'N/A' }}
            </p>

            <hr>

            <p><strong>Regional:</strong>
                {{ $centro->regionale?->Nombre ?? 'Sin regional asignada' }}
            </p>

            <hr>

            <p><strong>Fecha de Creación:</strong>
                {{ $centro->created_at ? $centro->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

            <p><strong>Última Actualización:</strong>
                {{ $centro->updated_at ? $centro->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}
        <div class="card-footer">

            <a href="{{ route('centros.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('centros.edit', $centro->NIS) }}"
               class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>

        </div>

    </div>

@stop
