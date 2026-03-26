@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Editar Aprendiz')

{{-- HEADER --}}
@section('content_header')
    <h1>Editar Aprendiz</h1>
@stop

{{-- CONTENIDO --}}
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-warning">

                <div class="card-header">
                    <h3 class="card-title">Modificar Información</h3>
                </div>

                <form action="{{ route('aprendices.update', $aprendice) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- Numero Documento --}}
                        <div class="form-group">
                            <label>Número de Documento *</label>
                            <input type="number" name="NumDoc" class="form-control @error('NumDoc') is-invalid @enderror"
                                value="{{ old('NumDoc', $aprendice->NumDoc) }}" required>

                            @error('NumDoc')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Nombres --}}
                        <div class="form-group">
                            <label>Nombres *</label>
                            <input type="text" name="Nombres" class="form-control @error('Nombres') is-invalid @enderror"
                                value="{{ old('Nombres', $aprendice->Nombres) }}" required>

                            @error('Nombres')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Apellidos --}}
                        <div class="form-group">
                            <label>Apellidos *</label>
                            <input type="text" name="Apellidos"
                                class="form-control @error('Apellidos') is-invalid @enderror"
                                value="{{ old('Apellidos', $aprendice->Apellidos) }}" required>

                            @error('Apellidos')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Dirección --}}
                        <div class="form-group">
                            <label>Dirección *</label>
                            <textarea name="Direccion" class="form-control @error('Direccion') is-invalid @enderror" rows="3" required>{{ old('Direccion', $aprendice->Direccion) }}</textarea>

                            @error('Direccion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div class="form-group">
                            <label>Teléfono *</label>
                            <input type="tel" name="Telefono"
                                class="form-control @error('Telefono') is-invalid @enderror"
                                value="{{ old('Telefono', $aprendice->Telefono) }}" required>

                            @error('Telefono')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Correo Institucional --}}
                        <div class="form-group">
                            <label>Correo Institucional *</label>
                            <input type="email" name="CorreoInstitucional"
                                class="form-control @error('CorreoInstitucional') is-invalid @enderror"
                                value="{{ old('CorreoInstitucional', $aprendice->CorreoInstitucional) }}" required>

                            @error('CorreoInstitucional')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Correo Personal --}}
                        <div class="form-group">
                            <label>Correo Personal *</label>
                            <input type="email" name="CorreoPersonal"
                                class="form-control @error('CorreoPersonal') is-invalid @enderror"
                                value="{{ old('CorreoPersonal', $aprendice->CorreoPersonal) }}" required>

                            @error('CorreoPersonal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Sexo --}}
                        <div class="form-group">
                            <label>Sexo *</label>
                            <select name="Sexo" class="form-control @error('Sexo') is-invalid @enderror" required>
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('Sexo', $aprendice->Sexo) == 1 ? 'selected' : '' }}>Masculino
                                </option>
                                <option value="2" {{ old('Sexo', $aprendice->Sexo) == 2 ? 'selected' : '' }}>Femenino
                                </option>
                            </select>

                            @error('Sexo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Fecha Nacimiento --}}
                        <div class="form-group">
                            <label>Fecha de Nacimiento *</label>
                            <input type="date" name="FechaNac"
                                class="form-control @error('FechaNac') is-invalid @enderror"
                                value="{{ old('FechaNac', $aprendice->FechaNac) }}" required>

                            @error('FechaNac')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        {{-- Tipo Documento --}}
                        <div class="form-group">
                            <label>Tipo de Documento *</label>
                            <select name="tbl_tiposdocumentos_nis"
                                class="form-control @error('tbl_tiposdocumentos_nis') is-invalid @enderror" required>
                                <option value="">Seleccione un tipo...</option>
                                @foreach ($tiposdoc as $tipo)
                                    <option value="{{ $tipo->nis }}"
                                        {{ old('tbl_tiposdocumentos_nis', $aprendice->tbl_tiposdocumentos_nis) == $tipo->nis ? 'selected' : '' }}>
                                        {{ $tipo->denominacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('tbl_tiposdocumentos_nis')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Programa --}}
                        <div class="form-group">
                            <label>Programa de Formación *</label>
                            <select name="tbl_programasdeformacion_NIS"
                                class="form-control @error('tbl_programasdeformacion_NIS') is-invalid @enderror" required>
                                <option value="">Seleccione un programa...</option>
                                @foreach ($programas as $programa)
                                    <option value="{{ $programa->NIS }}"
                                        {{ old('tbl_programasdeformacion_NIS', $aprendice->tbl_programasdeformacion_NIS) == $programa->NIS ? 'selected' : '' }}>
                                        {{ $programa->Denominacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('tbl_programasdeformacion_NIS')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Centro --}}
                        <div class="form-group">
                            <label>Centro de Formación *</label>
                            <select name="tbl_centrodeformacion_NIS"
                                class="form-control @error('tbl_centrodeformacion_NIS') is-invalid @enderror" required>
                                <option value="">Seleccione un centro...</option>
                                @foreach ($centros as $centro)
                                    <option value="{{ $centro->NIS }}"
                                        {{ old('tbl_centrodeformacion_NIS', $aprendice->tbl_centrodeformacion_NIS) == $centro->NIS ? 'selected' : '' }}>
                                        {{ $centro->Denominacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('tbl_centrodeformacion_NIS')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- EPS --}}
                        <div class="form-group">
                            <label>EPS *</label>
                            <select name="tbl_eps_nis" class="form-control @error('tbl_eps_nis') is-invalid @enderror"
                                required>
                                <option value="">Seleccione una EPS...</option>
                                @foreach ($listaEps as $epsItem)
                                    <option value="{{ $epsItem->nis }}"
                                        {{ old('tbl_eps_nis', $aprendice->tbl_eps_nis) == $epsItem->nis ? 'selected' : '' }}>
                                        {{ $epsItem->denominacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('tbl_eps_nis')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-warning">
                            Actualizar Aprendiz
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@stop

@include('sweetalert::alert')
