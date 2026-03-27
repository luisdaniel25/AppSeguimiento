<?php $__env->startSection('title', 'Listado de Instructores'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Listado de Instructores</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-primary">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Instructores Registrados</h3>

                    <a href="<?php echo e(route('instructores.create')); ?>" class="btn btn-success">
                        Nuevo Instructor
                    </a>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">

                            <thead class="thead-light">
                            <tr>
                                <th>NIS</th>
                                <th>Documento</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Correo Institucional</th>
                                <th>Tipo Documento</th>
                                <th>EPS</th>
                                <th width="180">Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $instructores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($instructor->NIS); ?></td>
                                    <td><?php echo e($instructor->NumDoc); ?></td>
                                    <td><?php echo e($instructor->Nombres); ?></td>
                                    <td><?php echo e($instructor->Apellidos); ?></td>
                                    <td><?php echo e($instructor->Telefono); ?></td>
                                    <td><?php echo e($instructor->CorreoInstitucional); ?></td>

                                    <td>
                                        <?php echo e($instructor->tiposdocumento->denominacion ?? 'N/A'); ?>

                                    </td>

                                    <td>
                                        <?php echo e($instructor->eps->denominacion ?? 'N/A'); ?>

                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            
                                            <a href="<?php echo e(route('instructores.show', $instructor->NIS)); ?>"
                                               class="btn btn-info btn-sm" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            
                                            <a href="<?php echo e(route('instructores.edit', $instructor->NIS)); ?>"
                                               class="btn btn-warning btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            
                                            <form action="<?php echo e(route('instructores.destroy', $instructor->NIS)); ?>"
                                                  method="POST" class="d-inline form-eliminar">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        No hay instructores registrados.
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>

                        </table>
                    </div>

                    
                    <div class="mt-3">
                        <?php echo e($instructores->links()); ?>

                    </div>

                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación eliminar con SweetAlert2
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "El instructor será eliminado del sistema.",
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

            // Mostrar mensaje de éxito si existe
            <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?php echo e(session('success')); ?>',
                timer: 3000,
                showConfirmButton: false
            });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\Instructores\index.blade.php ENDPATH**/ ?>