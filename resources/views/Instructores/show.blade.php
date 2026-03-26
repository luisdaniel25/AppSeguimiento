@extends('adminlte::page')

@section('title', 'Detalle Instructor')

@section('content_header')
    <h1>Detalle del instructor</h1>
@stop

@section('content')
    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $instructor->Nombres }} {{ $instructor->Apellidos }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $instructor->NIS }}</p>
            <p><strong>Documento:</strong> {{ $instructor->NumDoc }}</p>
            <p><strong>Nombres:</strong> {{ $instructor->Nombres }}</p>
            <p><strong>Apellidos:</strong> {{ $instructor->Apellidos }}</p>
            <p><strong>Dirección:</strong> {{ $instructor->Direccion ?? 'N/A' }}</p>
            <p><strong>Teléfono:</strong> {{ $instructor->Telefono ?? 'N/A' }}</p>
            <p><strong>Correo Institucional:</strong> {{ $instructor->CorreoInstitucional ?? 'N/A' }}</p>
            <p><strong>Correo Personal:</strong> {{ $instructor->CorreoPersonal ?? 'N/A' }}</p>

            {{-- Sexo --}}
            <p><strong>Sexo:</strong>
                @switch($instructor->Sexo)
                    @case(1)
                        Masculino
                    @break

                    @case(2)
                        Femenino
                    @break

                    @default
                        N/A
                @endswitch
            </p>

            {{-- Fecha --}}
            <p>
                <strong>Fecha Nacimiento:</strong>
                {{ $instructor->FechaNac ? \Carbon\Carbon::parse($instructor->FechaNac)->format('d-m-Y') : 'N/A' }}
            </p>

            <hr>


            <p><strong>Tipo de Documento:</strong>
                {{ $instructor->tiposdocumento?->denominacion ?? 'N/A' }}

            </p>

            <p><strong>EPS:</strong>
                {{ $instructor->eps?->denominacion ?? 'N/A' }}

            </p>


            <hr>
            <p><strong>Fecha de Creación:</strong>
                {{ $instructor->created_at ? $instructor->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>
            <p><strong>Última Actualización:</strong>
                {{ $instructor->updated_at ? $instructor->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}
        <div class="card-footer">
            <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('instructores.edit', $instructor->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
@stop
