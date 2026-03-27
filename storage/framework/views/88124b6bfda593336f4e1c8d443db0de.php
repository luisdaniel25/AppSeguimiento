<?php $__env->startSection('title', 'Listado de programas de Formación'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Programas de Formación</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <a href="<?php echo e(route('programas.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Programa
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th>Fichas de Caracterización</th>
                    <th>Aprendices</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $programas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($programa->NIS); ?></td>
                        <td><?php echo e($programa->Codigo); ?></td>
                        <td><?php echo e($programa->Denominacion); ?></td>
                        <td><?php echo e($programa->Observaciones ?? '-'); ?></td>

                        
                        <td>
                            <?php if($programa->fichasCaracterizacion && $programa->fichasCaracterizacion->count() > 0): ?>
                                <?php $__currentLoopData = $programa->fichasCaracterizacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ficha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge badge-info">
                                            Ficha #<?php echo e($ficha->NIS); ?> - <?php echo e($ficha->Denominacion); ?>

                                        </span>
                                    <br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <span class="badge badge-secondary">Sin fichas</span>
                            <?php endif; ?>
                        </td>
                        
                        <td>
                            <span class="badge badge-info"><?php echo e($programa->aprendices_count); ?> aprendices</span>
                        </td>

                        <td>
                            <a href="<?php echo e(route('programas.show', $programa->NIS)); ?>" class="btn btn-sm btn-info"
                               title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('programas.edit', $programa->NIS)); ?>" class="btn btn-sm btn-warning"
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('programas.destroy', $programa->NIS)); ?>" method="POST"
                                  style="display: inline;" class="form-eliminar">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"
                                    <?php echo e($programa->aprendices_count > 0 ? 'disabled' : ''); ?>>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay programas registrados</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($programas->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación para eliminar
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/programas/index.blade.php ENDPATH**/ ?>