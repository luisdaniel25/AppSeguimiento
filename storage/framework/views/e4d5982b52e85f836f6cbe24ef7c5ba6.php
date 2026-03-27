<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('title', 'Ver Tipo de Documento'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Tipo de Documento</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Información</h3>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>NIS:</label>
                        <input type="text" class="form-control" value="<?php echo e($tiposdocumento->nis); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Denominación:</label>
                        <input type="text" class="form-control" value="<?php echo e($tiposdocumento->denominacion); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Observaciones:</label>
                        <textarea class="form-control" rows="3" disabled><?php echo e($tiposdocumento->observaciones); ?></textarea>
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="<?php echo e(route('tiposdocumento.index')); ?>" class="btn btn-secondary">Volver</a>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\tiposdocumento\show.blade.php ENDPATH**/ ?>