@extends('adminlte::page')

@section('title', 'Ver Archivo')

@section('content_header')
    <h1>Detalle del Archivo</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Información del Archivo</h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        {{-- Columna izquierda: datos del archivo --}}
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Nombre:</th>
                                    <td>{{ $archivo->nombre_original }}</td>
                                </tr>
                                <tr>
                                    <th>Aprendiz:</th>
                                    <td>
                                        @if($archivo->aprendiz)
                                            <strong>{{ $archivo->aprendiz->Nombres }} {{ $archivo->aprendiz->Apellidos }}</strong>
                                            <br>
                                            <small class="text-muted">Documento: {{ $archivo->aprendiz->NumDoc }}</small>
                                        @else
                                            <span class="badge badge-danger">No asignado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tipo MIME:</th>
                                    <td><span class="badge badge-info">{{ $archivo->tipo_mime }}</span></td>
                                </tr>
                                <tr>
                                    <th>Tamaño:</th>
                                    <td><strong>{{ $archivo->tamano_formateado }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $archivo->descripcion ?? 'Sin descripción' }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha subida:</th>
                                    <td>{{ $archivo->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Última actualización:</th>
                                    <td>{{ $archivo->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>

                        {{-- Columna derecha: vista previa según tipo MIME --}}
                        <div class="col-md-6">
                            <div class="text-center">
                                @if(Str::startsWith($archivo->tipo_mime, 'image'))
                                    {{-- Previsualización de imagen --}}
                                    <img src="{{ asset('storage/' . $archivo->ruta) }}"
                                         class="img-fluid rounded"
                                         style="max-height: 300px;"
                                         alt="{{ $archivo->nombre_original }}">

                                @elseif(Str::contains($archivo->tipo_mime, 'pdf'))
                                    {{-- Previsualización de PDF en iframe --}}
                                    <iframe src="{{ asset('storage/' . $archivo->ruta) }}"
                                            width="100%"
                                            height="400px"
                                            style="border: 1px solid #ddd;">
                                    </iframe>

                                @else
                                    {{-- Sin vista previa disponible --}}
                                    <div class="text-center p-5">
                                        <i class="fas fa-file fa-5x text-secondary mb-3"></i>
                                        <p class="mb-3">Vista previa no disponible para este tipo de archivo</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('archivos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="{{ route('archivos.download', $archivo->id) }}" class="btn btn-success">
                            <i class="fas fa-download"></i> Descargar
                        </a>
                        <a href="{{ route('archivos.edit', $archivo->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop