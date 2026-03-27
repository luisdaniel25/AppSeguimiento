<?php $__env->startSection('title', 'Bitácoras'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gestión de Bitácoras</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de Bitácoras Registradas</h3>
                    <div class="card-tools">
                        <a href="<?php echo e(route('archivos.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nueva Bitácora
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <?php if($archivos->count() > 0): ?>
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
                                <?php $__currentLoopData = $archivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $archivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($archivos->firstItem() + $index); ?></td>

                                        
                                        <td>
                                            <i class="fas fa-file-<?php echo e($archivo->tipo_mime == 'application/pdf' ? 'pdf' : 'alt'); ?> text-primary mr-1"></i>
                                            <?php echo e($archivo->nombre_original); ?>

                                            <br>
                                            <small class="text-muted"><?php echo e($archivo->tamano_formateado); ?></small>
                                        </td>

                                        <td><?php echo e($archivo->descripcion ?? 'Sin descripción'); ?></td>

                                        
                                        <td>
                                            <?php if($archivo->aprendiz): ?>
                                                <?php echo e($archivo->aprendiz->Nombres); ?> <?php echo e($archivo->aprendiz->Apellidos); ?>

                                                <br>
                                                <small class="text-muted">NIS: <?php echo e($archivo->aprendiz->NIS); ?></small>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">N/A</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?php echo e($archivo->created_at->format('d/m/Y H:i')); ?></td>

                                        
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?php echo e(route('archivos.show', $archivo->id)); ?>"
                                                   class="btn btn-info btn-sm" target="_blank" title="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('archivos.download', $archivo->id)); ?>"
                                                   class="btn btn-success btn-sm" title="Descargar">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <form action="<?php echo e(route('archivos.destroy', $archivo->id)); ?>"
                                                      method="POST"
                                                      class="d-inline form-eliminar">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        
                        <div class="mt-3">
                            <?php echo e($archivos->links()); ?>

                        </div>

                    
                    <?php else: ?>
                        <div class="text-center p-5">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay bitácoras registradas</h5>
                            <a href="<?php echo e(route('archivos.create')); ?>" class="btn btn-primary mt-3">
                                <i class="fas fa-plus"></i> Subir primera bitácora
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('js'); ?>
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
            <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?php echo e(session('success')); ?>',
                timer: 3000,
                showConfirmButton: false
            });
            <?php endif; ?>

            <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '<?php echo e(session('error')); ?>',
                timer: 3000,
                showConfirmButton: false
            });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\archivos\index.blade.php ENDPATH**/ ?>