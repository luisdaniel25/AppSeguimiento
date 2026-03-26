@extends('adminlte::page')
@include('sweetalert::alert')
@section('title', 'Editar Regional')

{{-- HEADER --}}
@section('content_header')
    <h1>Editar Regional</h1>
@stop


{{-- CONTENIDO --}}
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-warning">

                <div class="card-header">
                    <h3 class="card-title">Modificar Información</h3>
                </div>

                <form action="{{ route('regionales.update', $regionale) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- NIS (solo lectura) --}}
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="number" class="form-control" value="{{ $regionale->NIS }}" disabled>

                            <small class="text-muted">
                                El NIS no se puede modificar
                            </small>
                        </div>

                        {{-- Código --}}
                        <div class="form-group">
                            <label for="Codigo">Código *</label>
                            <input type="number" class="form-control @error('Codigo') is-invalid @enderror" id="Codigo"
                                name="Codigo" value="{{ old('Codigo', $regionale->Codigo) }}" required>

                            @error('Codigo')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Denominación --}}
                        <div class="form-group">
                            <label for="Denominacion">Denominación *</label>
                            <input type="text" class="form-control @error('Denominacion') is-invalid @enderror"
                                id="Denominacion" name="Denominacion"
                                value="{{ old('Denominacion', $regionale->Denominacion) }}" required>

                            @error('Denominacion')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label for="Observaciones">Observaciones</label>
                            <textarea class="form-control @error('Observaciones') is-invalid @enderror" id="Observaciones" name="Observaciones"
                                rows="3">{{ old('Observaciones', $regionale->Observaciones) }}</textarea>

                            @error('Observaciones')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('regionales.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-warning">
                            Actualizar Regional
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@stop
@include('sweetalert::alert')
