@extends('adminlte::page')

@section('title','Nuevo Centro')

@section('content_header')
    <h1>Registrar Centro de Formación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-dark">
            <h3 class="card-title">Formulario de Registro</h3>
        </div>

        <form action="{{ route('centros.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">

                    {{-- Código --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Código *</label>
                            <input type="number" name="Codigo"
                                   class="form-control @error('Codigo') is-invalid @enderror"
                                   value="{{ old('Codigo') }}" placeholder="Código" required>
                            @error('Codigo')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Denominación --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Denominación *</label>
                            <input type="text" name="Denominacion"
                                   class="form-control @error('Denominacion') is-invalid @enderror"
                                   value="{{ old('Denominacion') }}" placeholder="Denominación" required>
                            @error('Denominacion')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Dirección --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dirección *</label>
                            <input type="text" name="Direccion"
                                   class="form-control @error('Direccion') is-invalid @enderror"
                                   value="{{ old('Direccion') }}" placeholder="Dirección" required>
                            @error('Direccion')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Observaciones --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Observaciones</label>
                            <input type="text" name="Observaciones"
                                   class="form-control @error('Observaciones') is-invalid @enderror"
                                   value="{{ old('Observaciones') }}" placeholder="Observaciones">
                            @error('Observaciones')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Regional --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Regional *</label>
                            <select name="tbl_regionales_NIS"
                                    class="form-control @error('tbl_regionales_NIS') is-invalid @enderror" required>
                                <option value="">Seleccione una regional...</option>
                                @foreach ($regionales as $regional)
                                    <option value="{{ $regional->NIS }}"
                                        {{ old('tbl_regionales_NIS') == $regional->NIS ? 'selected' : '' }}>
                                        {{ $regional->Denominacion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tbl_regionales_NIS')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-dark">Registrar</button>
                <a href="{{ route('centros.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@stop
@include('sweetalert::alert') 