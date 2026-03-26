@extends('adminlte::page')

@section('title', 'Editar Ficha de Caracterización')

@section('content_header')
    <h1>Editar Ficha #{{ $ficha->NIS }}</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>

                <form action="{{ route('fichas.update', $ficha) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        {{-- NIS (solo lectura) --}}
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="number" class="form-control bg-light" value="{{ $ficha->NIS }}" readonly>
                        </div>

                        {{-- Código --}}
                        <div class="form-group">
                            <label>Código <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="Codigo"
                                   class="form-control @error('Codigo') is-invalid @enderror"
                                   value="{{ old('Codigo', $ficha->Codigo) }}"
                                   required>
                            @error('Codigo')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Denominación --}}
                        <div class="form-group">
                            <label>Denominación <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="Denominacion"
                                   class="form-control @error('Denominacion') is-invalid @enderror"
                                   value="{{ old('Denominacion', $ficha->Denominacion) }}"
                                   maxlength="100"
                                   required>
                            <small class="form-text text-muted">Máximo 100 caracteres</small>
                            @error('Denominacion')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Cupo --}}
                        <div class="form-group">
                            <label>Cupo <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="Cupo"
                                   min="1"
                                   class="form-control @error('Cupo') is-invalid @enderror"
                                   value="{{ old('Cupo', $ficha->Cupo) }}"
                                   required>
                            @error('Cupo')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Programa de Formación --}}
                        <div class="form-group">
                            <label>Programa de Formación <span class="text-danger">*</span></label>
                            <select name="tbl_programasdeformacion_NIS"
                                    class="form-control @error('tbl_programasdeformacion_NIS') is-invalid @enderror"
                                    required>
                                <option value="">Seleccione un programa...</option>
                                @foreach($programas as $nis => $denominacion)
                                    <option value="{{ $nis }}" {{ old('tbl_programasdeformacion_NIS', $ficha->tbl_programasdeformacion_NIS) == $nis ? 'selected' : '' }}>
                                        {{ $nis }} - {{ $denominacion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tbl_programasdeformacion_NIS')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Instructor --}}
                        <div class="form-group">
                            <label>Instructor <span class="text-danger">*</span></label>
                            <select name="tbl_instructores_NIS"
                                    class="form-control @error('tbl_instructores_NIS') is-invalid @enderror"
                                    required>
                                <option value="">Seleccione un instructor...</option>
                                @foreach($instructores as $nis => $nombre)
                                    <option value="{{ $nis }}" {{ old('tbl_instructores_NIS', $ficha->tbl_instructores_NIS) == $nis ? 'selected' : '' }}>
                                        {{ $nis }} - {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tbl_instructores_NIS')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Fecha Inicio --}}
                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date"
                                   name="FechaInicio"
                                   class="form-control @error('FechaInicio') is-invalid @enderror"
                                   value="{{ old('FechaInicio', optional($ficha->FechaInicio)->format('Y-m-d')) }}">
                            <small class="form-text text-muted">Opcional. Dejar en blanco si no aplica.</small>
                            @error('FechaInicio')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Fecha Fin --}}
                        <div class="form-group">
                            <label>Fecha Fin</label>
                            <input type="date"
                                   name="FechaFin"
                                   class="form-control @error('FechaFin') is-invalid @enderror"
                                   value="{{ old('FechaFin', optional($ficha->FechaFin)->format('Y-m-d')) }}">
                            <small class="form-text text-muted">Opcional. Debe ser posterior a la fecha de inicio.</small>
                            @error('FechaFin')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="Observaciones"
                                      rows="3"
                                      class="form-control @error('Observaciones') is-invalid @enderror"
                                      maxlength="200">{{ old('Observaciones', $ficha->Observaciones) }}</textarea>
                            <small class="form-text text-muted">Máximo 200 caracteres</small>
                            @error('Observaciones')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('fichas.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar Ficha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        // Validación adicional en cliente
        document.querySelector('form').addEventListener('submit', function(e) {
            let fechaInicio = document.querySelector('input[name="FechaInicio"]').value;
            let fechaFin = document.querySelector('input[name="FechaFin"]').value;

            if (fechaInicio && fechaFin) {
                if (new Date(fechaFin) < new Date(fechaInicio)) {
                    e.preventDefault();
                    alert('La fecha de fin no puede ser menor a la fecha de inicio');
                }
            }
        });
    </script>
@stop
