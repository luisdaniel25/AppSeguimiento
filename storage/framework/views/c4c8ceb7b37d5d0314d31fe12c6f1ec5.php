<?php $__env->startSection('title', 'Detalle Aprendiz'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Aprendiz</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($aprendice->Nombres); ?> <?php echo e($aprendice->Apellidos); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($aprendice->NIS); ?></p>
            <p><strong>Documento:</strong> <?php echo e($aprendice->NumDoc); ?></p>
            <p><strong>Nombres:</strong> <?php echo e($aprendice->Nombres); ?></p>
            <p><strong>Apellidos:</strong> <?php echo e($aprendice->Apellidos); ?></p>
            <p><strong>Dirección:</strong> <?php echo e($aprendice->Direccion ?? 'N/A'); ?></p>
            <p><strong>Teléfono:</strong> <?php echo e($aprendice->Telefono ?? 'N/A'); ?></p>
            <p><strong>Correo Institucional:</strong> <?php echo e($aprendice->CorreoInstitucional ?? 'N/A'); ?></p>
            <p><strong>Correo Personal:</strong> <?php echo e($aprendice->CorreoPersonal ?? 'N/A'); ?></p>

            
            <p><strong>Sexo:</strong>
                <?php switch($aprendice->Sexo):
                    case (1): ?> Masculino <?php break; ?>
                    <?php case (2): ?> Femenino <?php break; ?>
                    <?php default: ?> N/A
                <?php endswitch; ?>
            </p>

            
            <p>
                <strong>Fecha Nacimiento:</strong>
                <?php echo e($aprendice->FechaNac ? \Carbon\Carbon::parse($aprendice->FechaNac)->format('d-m-Y') : 'N/A'); ?>

            </p>

            <hr>


            <p><strong>Tipo de Documento:</strong>
                <?php echo e($aprendice->tiposdocumento?->denominacion ?? 'N/A'); ?>


            </p>

            <p><strong>Programa de Formación:</strong>
                <?php echo e($aprendice->programasdeformacion?->Denominacion ?? 'N/A'); ?>


            </p>

            <p><strong>Centro de Formación:</strong>
                <?php echo e($aprendice->centrodeformacion?->Denominacion ?? 'N/A'); ?>


            </p>

            <p><strong>EPS:</strong>
                <?php echo e($aprendice->eps?->denominacion ?? 'N/A'); ?>


            </p>


            <hr>
            <p><strong>Fecha de Creación:</strong>
                <?php echo e($aprendice->created_at ? $aprendice->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>
            <p><strong>Última Actualización:</strong>
                <?php echo e($aprendice->updated_at ? $aprendice->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        
        <div class="card-footer">
            <a href="<?php echo e(route('aprendices.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="<?php echo e(route('aprendices.edit', $aprendice->NIS)); ?>"
               class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\aprendices\show.blade.php ENDPATH**/ ?>