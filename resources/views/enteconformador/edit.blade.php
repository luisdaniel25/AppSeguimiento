@extends('adminlte::page')

@section('title', 'Editar Ente Conformador')

@section('content_header')
    <h1>Editar Registro</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>

                <form action="{{ route('enteconformador.update', $enteconformador->NIS) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label for="NumDoc">Número Documento *</label>
                            <input type="number" class="form-control @error('NumDoc') is-invalid @enderror" id="NumDoc"
                                name="NumDoc" value="{{ old('NumDoc', $enteconformador->NumDoc) }}" required>
                            @error('NumDoc')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="RazonSocial">Razón Social *</label>
                            <input type="text" class="form-control @error('RazonSocial') is-invalid @enderror"
                                id="RazonSocial" name="RazonSocial"
                                value="{{ old('RazonSocial', $enteconformador->RazonSocial) }}" required>
                            @error('RazonSocial')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Direccion">Dirección *</label>
                            <input type="text" class="form-control @error('Direccion') is-invalid @enderror"
                                id="Direccion" name="Direccion" value="{{ old('Direccion', $enteconformador->Direccion) }}"
                                required>
                            @error('Direccion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Telefono">Teléfono *</label>
                            <input type="text" class="form-control @error('Telefono') is-invalid @enderror"
                                id="Telefono" name="Telefono" value="{{ old('Telefono', $enteconformador->Telefono) }}"
                                required>
                            @error('Telefono')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="CorreoInstitucional">Correo Institucional *</label>
                            <input type="email" class="form-control @error('CorreoInstitucional') is-invalid @enderror"
                                id="CorreoInstitucional" name="CorreoInstitucional"
                                value="{{ old('CorreoInstitucional', $enteconformador->CorreoInstitucional) }}" required>
                            @error('CorreoInstitucional')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tipo Documento *</label>
                            <select name="tbl_tiposdocumentos_nis"
                                class="form-control @error('tbl_tiposdocumentos_nis') is-invalid @enderror" required>
                                <option value="">Seleccione un Tipo de Documento...</option>
                                @foreach ($listaTiposDocumentos as $tipo)
                                    <option value="{{ $tipo->nis }}"
                                        {{ old('tbl_tiposdocumentos_nis', $enteconformador->tbl_tiposdocumentos_nis) == $tipo->nis ? 'selected' : '' }}>
                                        {{ $tipo->denominacion }}
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
                                <option value="">Seleccione un Rol...</option>
                                @foreach ($listaRoles as $rol)
                                    {{-- ✅ CORREGIDO: nis → NIS y denominacion → Descripcion --}}
                                    <option value="{{ $rol->NIS }}"
                                        {{ old('tbl_rolesadministrativos_NIS', $enteconformador->tbl_rolesadministrativos_NIS) == $rol->NIS ? 'selected' : '' }}>
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
                        <a href="{{ route('enteconformador.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar Registro</button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@stop
@include('sweetalert::alert')
