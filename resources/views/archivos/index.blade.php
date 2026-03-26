@extends('adminlte::page')

@section('title', 'Bitácoras')

@section('content_header')
    <h1>Gestión de Bitácoras</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de Bitácoras Registradas</h3>
                    <div class="card-tools">
                        <a href="{{ route('archivos.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nueva Bitácora
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    {{-- Tabla de bitácoras --}}
                    @if($archivos->count() > 0)
                        <table id="tabla-bitacoras" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Archivo</th>
                                    <th>Descripción</th>
                                    <th>Aprendiz</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($archivos as $index => $archivo)
                                    <tr>
                                        <td>{{ $archivos->firstItem() + $index }}</td>

                                        {{-- Nombre e icono según tipo MIME --}}
                                        <td>
                                            <i class="fas fa-file-{{ $archivo->tipo_mime == 'application/pdf' ? 'pdf' : 'alt' }} text-primary mr-1"></i>
                                            {{ $archivo->nombre_original }}
                                            <br>
                                            <small class="text-muted">{{ $archivo->tamano_formateado }}</small>
                                        </td>

                                        <td>{{ $archivo->descripcion ?? 'Sin descripción' }}</td>

                                        {{-- Datos del aprendiz relacionado --}}
                                        <td>
                                            @if($archivo->aprendiz)
                                                {{ $archivo->aprendiz->Nombres }} {{ $archivo->aprendiz->Apellidos }}
                                                <br>
                                                <small class="text-muted">NIS: {{ $archivo->aprendiz->NIS }}</small>
                                            @else
                                                <span class="badge badge-secondary">N/A</span>
                                            @endif
                                        </td>

                                        <td>{{ $archivo->created_at->format('d/m/Y H:i') }}</td>

                                        {{-- Acciones: ver, descargar, eliminar --}}
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('archivos.show', $archivo->id) }}"
                                                   class="btn btn-info btn-sm" target="_blank" title="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('archivos.download', $archivo->id) }}"
                                                   class="btn btn-success btn-sm" title="Descargar">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <form action="{{ route('archivos.destroy', $archivo->id) }}"
                                                      method="POST"
                                                      class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Paginación --}}
                        <div class="mt-3">
                            {{ $archivos->links() }}
                        </div>

                    {{-- Estado vacío --}}
                    @else
                        <div class="text-center p-5">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay bitácoras registradas</h5>
                            <a href="{{ route('archivos.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus"></i> Subir primera bitácora
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@include('sweetalert::alert')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Inicializa DataTable con búsqueda y ordenamiento, sin paginación propia
            $('#tabla-bitacoras').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros",
                    "emptyTable": "No hay datos disponibles"
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {

            // Confirmación SweetAlert antes de eliminar
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Mensajes flash de sesión
            @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
            @endif

            @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
            @endif
        });
    </script>
@stop