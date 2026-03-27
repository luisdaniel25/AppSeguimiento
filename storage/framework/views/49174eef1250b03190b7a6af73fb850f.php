<?php $__env->startSection('title', 'Detalle EPS'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle de la EPS</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($ep->denominacion); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($ep->nis); ?></p>
            <p><strong>Documento:</strong> <?php echo e($ep->numdoc); ?></p>
            <p><strong>Observaciones:</strong> <?php echo e($ep->observaciones); ?></p>

            <hr>
            <p><strong>Fecha de Creación:</strong>
                <?php echo e($ep->created_at ? $ep->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>
            <p><strong>Última Actualización:</strong>
                <?php echo e($ep->updated_at ? $ep->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        
        <div class="card-footer">
            <a href="<?php echo e(route('eps.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="<?php echo e(route('eps.edit', $ep->nis)); ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\eps\show.blade.php ENDPATH**/ ?>