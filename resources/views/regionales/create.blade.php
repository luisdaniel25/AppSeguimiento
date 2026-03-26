@extends('adminlte::page')

@section('title', 'Crear Regional')


@section('content_header')
    <h1>Crear Nueva Regional</h1>
@stop



@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="{{ route('regionales.store') }}" method="POST">
                    @csrf

                    <div class="card-body">


                        <div class="form-group">
                            <label for="Codigo">Código *</label>
                            <input type="number" class="form-control @error('Codigo') is-invalid @enderror" id="Codigo"
                                name="Codigo" value="{{ old('Codigo') }}" required>

                            @error('Codigo')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="Denominacion">Denominación *</label>
                            <input type="text" class="form-control @error('Denominacion') is-invalid @enderror"
                                id="Denominacion" name="Denominacion" value="{{ old('Denominacion') }}" required>

                            @error('Denominacion')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="Observaciones">Observaciones</label>
                            <textarea class="form-control @error('Observaciones') is-invalid @enderror" id="Observaciones" name="Observaciones"
                                rows="3">{{ old('Observaciones') }}</textarea>

                            @error('Observaciones')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>


                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('regionales.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Guardar Regional
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@stop
@include('sweetalert::alert')
