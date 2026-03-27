<?php $__env->startSection('title', 'Detalle Centro'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Centro de Formación</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($centro->Denominacion); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($centro->NIS); ?></p>

            <p><strong>Código:</strong> <?php echo e($centro->Codigo); ?></p>

            <p><strong>Denominación:</strong> <?php echo e($centro->Denominacion); ?></p>

            <p><strong>Dirección:</strong>
                <?php echo e($centro->Direccion ?? 'N/A'); ?>

            </p>

            <p><strong>Observaciones:</strong>
                <?php echo e($centro->Observaciones ?? 'N/A'); ?>

            </p>

            <hr>

            <p><strong>Regional:</strong>
                <?php echo e($centro->regionale?->Nombre ?? 'Sin regional asignada'); ?>

            </p>

            <hr>

            <p><strong>Fecha de Creación:</strong>
                <?php echo e($centro->created_at ? $centro->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

            <p><strong>Última Actualización:</strong>
                <?php echo e($centro->updated_at ? $centro->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        
        <div class="card-footer">

            <a href="<?php echo e(route('centros.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="<?php echo e(route('centros.edit', $centro->NIS)); ?>"
               class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\centros\show.blade.php ENDPATH**/ ?>