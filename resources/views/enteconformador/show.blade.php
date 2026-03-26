@extends('adminlte::page')

@section('title', 'Detalle Ente Conformador')

@section('content_header')
    <h1>Detalle del Ente Conformador</h1>
@stop

@section('content')
    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $enteconformador->RazonSocial }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $enteconformador->NIS }}</p>
            <p><strong>Número Documento:</strong> {{ $enteconformador->NumDoc }}</p>
            <p><strong>Razón Social:</strong> {{ $enteconformador->RazonSocial }}</p>
            <p><strong>Dirección:</strong> {{ $enteconformador->Direccion ?? 'N/A' }}</p>
            <p><strong>Teléfono:</strong> {{ $enteconformador->Telefono ?? 'N/A' }}</p>
            <p><strong>Correo Institucional:</strong> {{ $enteconformador->CorreoInstitucional ?? 'N/A' }}</p>

            <hr>

            <p><strong>Tipo de Documento:</strong>
                {{ $enteconformador->tiposdocumento?->denominacion ?? 'N/A' }}
            </p>

            <p><strong>Rol Administrativo:</strong>
                {{ $enteconformador->rolesadministrativo?->Descripcion ?? 'N/A' }}
            </p>

            <hr>

            <p><strong>Fecha de Creación:</strong>
                {{ $enteconformador->created_at ? $enteconformador->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>
            <p><strong>Última Actualización:</strong>
                {{ $enteconformador->updated_at ? $enteconformador->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}
        <div class="card-footer">
            <a href="{{ route('enteconformador.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('enteconformador.edit', $enteconformador->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
@stop
