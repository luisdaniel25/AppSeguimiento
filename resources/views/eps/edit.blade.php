@extends('adminlte::page')

@section('title', 'Editar EPS')

@section('content_header')
    <h1>Editar Registro de EPS</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>

                <form action="{{ route('eps.update', $ep->nis) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label for="numdoc">Número Documento *</label>
                            <input type="number" class="form-control @error('numdoc') is-invalid @enderror" id="numdoc"
                                name="numdoc" value="{{ old('numdoc', $ep->numdoc) }}" required>
                            @error('numdoc')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="denominacion">Denominación *</label>
                            <input type="text" class="form-control @error('denominacion') is-invalid @enderror"
                                id="denominacion" name="denominacion" value="{{ old('denominacion', $ep->denominacion) }}"
                                required>
                            @error('denominacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observaciones *</label>
                            <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones"
                                rows="3" required>{{ old('observaciones', $ep->observaciones) }}</textarea>
                            @error('observaciones')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('eps.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar EPS</button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@stop

@include('sweetalert::alert')
