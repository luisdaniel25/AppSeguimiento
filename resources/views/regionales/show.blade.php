@extends('adminlte::page')

@section('title', 'Detalle Regional')

{{-- HEADER --}}
@section('content_header')
    <h1>Detalles de la Regional</h1>
@stop


{{-- CONTENIDO --}}
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">Información de la Regional</h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th style="width:200px;">NIS</th>
                            <td>{{ $regionale->NIS }}</td>
                        </tr>

                        <tr>
                            <th>Código</th>
                            <td>{{ $regionale->Codigo }}</td>
                        </tr>

                        <tr>
                            <th>Denominación</th>
                            <td>{{ $regionale->Denominacion }}</td>
                        </tr>

                        <tr>
                            <th>Observaciones</th>
                            <td>{{ $regionale->Observaciones ?? 'Sin observaciones' }}</td>
                        </tr>

                        <tr>
                            <th>Fecha de creación</th>
                            <td>
                                {{ $regionale->created_at ? $regionale->created_at->format('d/m/Y H:i') : 'No disponible' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Última actualización</th>
                            <td>
                                {{ $regionale->updated_at ? $regionale->updated_at->format('d/m/Y H:i') : 'No disponible' }}
                            </td>
                        </tr>
                    </table>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">

                    <a href="{{ route('regionales.index') }}" class="btn btn-secondary">
                        Volver
                    </a>

                    <div>
                        <a href="{{ route('regionales.edit', $regionale) }}" class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('regionales.destroy', $regionale) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar esta regional?')">
                                Eliminar
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>

@stop
