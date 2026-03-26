@extends('adminlte::page')

@section('title', 'Detalle Aprendiz')

@section('content_header')
    <h1>Detalle del Aprendiz</h1>
@stop

@section('content')
    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $aprendice->Nombres }} {{ $aprendice->Apellidos }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $aprendice->NIS }}</p>
            <p><strong>Documento:</strong> {{ $aprendice->NumDoc }}</p>
            <p><strong>Nombres:</strong> {{ $aprendice->Nombres }}</p>
            <p><strong>Apellidos:</strong> {{ $aprendice->Apellidos }}</p>
            <p><strong>Dirección:</strong> {{ $aprendice->Direccion ?? 'N/A' }}</p>
            <p><strong>Teléfono:</strong> {{ $aprendice->Telefono ?? 'N/A' }}</p>
            <p><strong>Correo Institucional:</strong> {{ $aprendice->CorreoInstitucional ?? 'N/A' }}</p>
            <p><strong>Correo Personal:</strong> {{ $aprendice->CorreoPersonal ?? 'N/A' }}</p>

            {{-- Sexo --}}
            <p><strong>Sexo:</strong>
                @switch($aprendice->Sexo)
                    @case(1) Masculino @break
                    @case(2) Femenino @break
                    @default N/A
                @endswitch
            </p>

            {{-- Fecha --}}
            <p>
                <strong>Fecha Nacimiento:</strong>
                {{ $aprendice->FechaNac ? \Carbon\Carbon::parse($aprendice->FechaNac)->format('d-m-Y') : 'N/A' }}
            </p>

            <hr>


            <p><strong>Tipo de Documento:</strong>
                {{ $aprendice->tiposdocumento?->denominacion ?? 'N/A' }}

            </p>

            <p><strong>Programa de Formación:</strong>
                {{ $aprendice->programasdeformacion?->Denominacion ?? 'N/A' }}

            </p>

            <p><strong>Centro de Formación:</strong>
                {{ $aprendice->centrodeformacion?->Denominacion ?? 'N/A' }}

            </p>

            <p><strong>EPS:</strong>
                {{ $aprendice->eps?->denominacion ?? 'N/A' }}

            </p>


            <hr>
            <p><strong>Fecha de Creación:</strong>
                {{ $aprendice->created_at ? $aprendice->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>
            <p><strong>Última Actualización:</strong>
                {{ $aprendice->updated_at ? $aprendice->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}
        <div class="card-footer">
            <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('aprendices.edit', $aprendice->NIS) }}"
               class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
@stop
