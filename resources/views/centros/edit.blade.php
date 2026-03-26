@extends('adminlte::page')

@section('title','Editar Centro')

@section('content_header')
    <h1>Editar Centro</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('centros.update', $centro->NIS) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Código</label>
                    <input type="number"
                           name="Codigo"
                           value="{{ old('Codigo', $centro->Codigo) }}"
                           class="form-control @error('Codigo') is-invalid @enderror"
                           required>

                    @error('Codigo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Denominación</label>
                    <input type="text"
                           name="Denominacion"
                           value="{{ old('Denominacion', $centro->Denominacion) }}"
                           class="form-control @error('Denominacion') is-invalid @enderror"
                           required>

                    @error('Denominacion')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text"
                           name="Direccion"
                           value="{{ old('Direccion', $centro->Direccion) }}"
                           class="form-control @error('Direccion') is-invalid @enderror"
                           required>

                    @error('Direccion')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="Observaciones"
                              class="form-control @error('Observaciones') is-invalid @enderror">{{ old('Observaciones', $centro->Observaciones) }}</textarea>

                    @error('Observaciones')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Regional</label>

                    <select name="tbl_regionales_NIS" class="form-control @error('tbl_regionales_NIS') is-invalid @enderror" required>

                        <option value="">Seleccione una regional</option>

                        @foreach($regionales as $regional)
                            <option value="{{ $regional->NIS }}"
                                {{ old('tbl_regionales_NIS', $centro->tbl_regionales_NIS) == $regional->NIS ? 'selected' : '' }}>
                                {{ $regional->Denominacion }}

                            </option>
                        @endforeach

                    </select>

                    @error('tbl_regionales_NIS')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar
                </button>

                <a href="{{ route('centros.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>

            </form>

        </div>
    </div>

@stop
