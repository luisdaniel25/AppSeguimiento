@extends('adminlte::page')

@section('title', 'Crear Ente Conformador')


@section('content_header')
    <h1>Crear Registro Nuevo</h1>
@stop



@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="{{ route('enteconformador.store') }}" method="POST">
                    @csrf

                    <div class="card-body">


                        <div class="form-group">
                            <label for="NumDoc">Numero Documento *</label>
                            <input type="number" class="form-control @error('NumDoc') is-invalid @enderror" id="NumDoc"
                                name="NumDoc" value="{{ old('NumDoc') }}" required>

                            @error('NumDoc')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="RazonSocial">Razon Social *</label>
                            <input type="text" class="form-control @error('RazonSocial') is-invalid @enderror"
                                id="RazonSocial" name="RazonSocial" value="{{ old('RazonSocial') }}" required>

                            @error('RazonSocial')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="Direccion">Direccion *</label>
                            <input type="text" class="form-control @error('Direccion') is-invalid @enderror"
                                id="Direccion" name="Direccion" value="{{ old('Direccion') }}" required>

                            @error('Direccion')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Telefono">Telefono *</label>
                            <input type="text" class="form-control @error('Telefono') is-invalid @enderror"
                                id="Telefono" name="Telefono" value="{{ old('Telefono') }}" required>

                            @error('Telefono')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="CorreoInstitucional">Correo Institucional *</label>
                            <input type="email" class="form-control @error('CorreoInstitucional') is-invalid @enderror"
                                id="CorreoInstitucional" name="CorreoInstitucional" value="{{ old('CorreoInstitucional') }}"
                                required>

                            @error('CorreoInstitucional')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tipo Documento *</label>
                            <select name="tbl_tiposdocumentos_nis"
                                class="form-control @error('tbl_tiposdocumentos_nis') is-invalid @enderror" required>
                                <option value="">Seleccione un Tipo de Documento...</option>
                                @foreach ($listaTiposDocumentos as $tipoDoc)
                                    <option value="{{ $tipoDoc->nis }}"
                                        {{ old('tbl_tiposdocumentos_nis') == $tipoDoc->nis ? 'selected' : '' }}>
                                        {{ $tipoDoc->denominacion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tbl_tiposdocumentos_nis')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Rol *</label>
                            <select name="tbl_rolesadministrativos_NIS"
                                class="form-control @error('tbl_rolesadministrativos_NIS') is-invalid @enderror" required>
                                <option value="">Seleccione un rol</option>
                                @foreach ($listaRoles as $rol)
                                    <option value="{{ $rol->NIS }}"
                                        {{ old('tbl_rolesadministrativos_NIS') == $rol->NIS ? 'selected' : '' }}>
                                        {{ $rol->Descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tbl_rolesadministrativos_NIS')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('enteconformador.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Guardar Ente Conformador
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@stop
@include('sweetalert::alert')
