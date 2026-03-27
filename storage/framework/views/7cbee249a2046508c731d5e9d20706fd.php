<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('title', 'Detalle del Rol Administrativo'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Rol Administrativo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Información del Rol</h3>
                </div>

                <div class="card-body">
                    <p><strong>NIS:</strong> <?php echo e($rolesadministrativo->NIS); ?></p>
                    <p><strong>Descripción:</strong> <?php echo e($rolesadministrativo->Descripcion); ?></p>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="<?php echo e(route('rolesadministrativos.index')); ?>" class="btn btn-secondary">Volver</a>
                    <a href="<?php echo e(route('rolesadministrativos.edit', $rolesadministrativo->NIS)); ?>"
                        class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\rolesadministrativos\show.blade.php ENDPATH**/ ?>