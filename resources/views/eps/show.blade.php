@extends('adminlte::page')

@section('title', 'Detalle EPS')

@section('content_header')
    <h1>Detalle de la EPS</h1>
@stop

@section('content')
    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $ep->denominacion }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $ep->nis }}</p>
            <p><strong>Documento:</strong> {{ $ep->numdoc }}</p>
            <p><strong>Observaciones:</strong> {{ $ep->observaciones }}</p>

            <hr>
            <p><strong>Fecha de Creación:</strong>
                {{ $ep->created_at ? $ep->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>
            <p><strong>Última Actualización:</strong>
                {{ $ep->updated_at ? $ep->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}
        <div class="card-footer">
            <a href="{{ route('eps.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('eps.edit', $ep->nis) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
@stop

@include('sweetalert::alert')
