@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Ver Tipo de Documento')

@section('content_header')
    <h1>Detalle del Tipo de Documento</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Información</h3>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>NIS:</label>
                        <input type="text" class="form-control" value="{{ $tiposdocumento->nis }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Denominación:</label>
                        <input type="text" class="form-control" value="{{ $tiposdocumento->denominacion }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Observaciones:</label>
                        <textarea class="form-control" rows="3" disabled>{{ $tiposdocumento->observaciones }}</textarea>
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('tiposdocumento.index') }}" class="btn btn-secondary">Volver</a>
                </div>

            </div>
        </div>
    </div>
@stop
