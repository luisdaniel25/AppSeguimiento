<?php $__env->startSection('title', 'Detalle Ente Conformador'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Ente Conformador</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($enteconformador->RazonSocial); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($enteconformador->NIS); ?></p>
            <p><strong>Número Documento:</strong> <?php echo e($enteconformador->NumDoc); ?></p>
            <p><strong>Razón Social:</strong> <?php echo e($enteconformador->RazonSocial); ?></p>
            <p><strong>Dirección:</strong> <?php echo e($enteconformador->Direccion ?? 'N/A'); ?></p>
            <p><strong>Teléfono:</strong> <?php echo e($enteconformador->Telefono ?? 'N/A'); ?></p>
            <p><strong>Correo Institucional:</strong> <?php echo e($enteconformador->CorreoInstitucional ?? 'N/A'); ?></p>

            <hr>

            <p><strong>Tipo de Documento:</strong>
                <?php echo e($enteconformador->tiposdocumento?->denominacion ?? 'N/A'); ?>

            </p>

            <p><strong>Rol Administrativo:</strong>
                <?php echo e($enteconformador->rolesadministrativo?->Descripcion ?? 'N/A'); ?>

            </p>

            <hr>

            <p><strong>Fecha de Creación:</strong>
                <?php echo e($enteconformador->created_at ? $enteconformador->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>
            <p><strong>Última Actualización:</strong>
                <?php echo e($enteconformador->updated_at ? $enteconformador->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        
        <div class="card-footer">
            <a href="<?php echo e(route('enteconformador.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="<?php echo e(route('enteconformador.edit', $enteconformador->NIS)); ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\enteconformador\show.blade.php ENDPATH**/ ?>