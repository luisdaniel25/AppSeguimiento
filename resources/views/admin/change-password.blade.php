@extends('adminlte::page')

@section('title', 'Cambiar Contraseña')

@section('content_header')
    <h1><i class="fas fa-lock mr-2"></i> Cambiar Contraseña</h1>
@stop

@section('content')

    @if(session('success'))
        <x-adminlte-alert theme="success" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">Nueva contraseña</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.change.password.update') }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <x-adminlte-input
                            name="current_password"
                            label="Contraseña actual"
                            type="password"
                            placeholder="••••••••"
                            required/>

                        <x-adminlte-input
                            name="password"
                            label="Nueva contraseña"
                            type="password"
                            placeholder="••••••••"
                            required/>

                        <x-adminlte-input
                            name="password_confirmation"
                            label="Confirmar nueva contraseña"
                            type="password"
                            placeholder="••••••••"
                            required/>

                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-key mr-1"></i> Cambiar contraseña
                        </button>

                        <a href="{{ route('admin.profile') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-arrow-left mr-1"></i> Volver al perfil
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
