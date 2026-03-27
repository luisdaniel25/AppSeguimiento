<?php $__env->startSection('title', 'centros de Formación'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Centros de Formación</h1>

        <a href="<?php echo e(route('centros.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nuevo Centro
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Listado de Centros
                <span class="badge badge-info">
                <?php echo e($centros->total()); ?> registros
            </span>
            </h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Dirección</th>
                    <th>Observaciones</th>
                    <th>Regional</th>
                    <th width="160">Acciones</th>
                </tr>
                </thead>

                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $centros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($centro->NIS); ?></td>
                        <td><?php echo e($centro->Codigo); ?></td>
                        <td><?php echo e($centro->Denominacion); ?></td>
                        <td><?php echo e($centro->Direccion); ?></td>
                        <td><?php echo e($centro->Observaciones ?? 'Sin observaciones'); ?></td>
                        <td>
                            <?php echo e($centro->regionale?->Denominacion ?? 'N/A'); ?>

                        </td>

                        <td>
                            <div class="btn-group">

                                
                                <a href="<?php echo e(route('centros.show', $centro->NIS)); ?>"
                                   class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                
                                <a href="<?php echo e(route('centros.edit', $centro->NIS)); ?>"
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                
                                <form action="<?php echo e(route('centros.destroy', $centro->NIS)); ?>"
                                      method="POST"
                                      style="display:inline"
                                      class="form-eliminar">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No hay centros registrados
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($centros->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($centros->links()); ?>

            </div>
        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación para eliminar con SweetAlert2
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/centros/index.blade.php ENDPATH**/ ?>