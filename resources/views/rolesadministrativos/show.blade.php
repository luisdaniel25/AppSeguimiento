@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Detalle del Rol Administrativo')

@section('content_header')
    <h1>Detalle del Rol Administrativo</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Información del Rol</h3>
                </div>

                <div class="card-body">
                    <p><strong>NIS:</strong> {{ $rolesadministrativo->NIS }}</p>
                    <p><strong>Descripción:</strong> {{ $rolesadministrativo->Descripcion }}</p>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('rolesadministrativos.edit', $rolesadministrativo->NIS) }}"
                        class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
@stop
