<?php $__env->startSection('title', 'Detalle Instructor'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del instructor</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($instructor->Nombres); ?> <?php echo e($instructor->Apellidos); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($instructor->NIS); ?></p>
            <p><strong>Documento:</strong> <?php echo e($instructor->NumDoc); ?></p>
            <p><strong>Nombres:</strong> <?php echo e($instructor->Nombres); ?></p>
            <p><strong>Apellidos:</strong> <?php echo e($instructor->Apellidos); ?></p>
            <p><strong>Dirección:</strong> <?php echo e($instructor->Direccion ?? 'N/A'); ?></p>
            <p><strong>Teléfono:</strong> <?php echo e($instructor->Telefono ?? 'N/A'); ?></p>
            <p><strong>Correo Institucional:</strong> <?php echo e($instructor->CorreoInstitucional ?? 'N/A'); ?></p>
            <p><strong>Correo Personal:</strong> <?php echo e($instructor->CorreoPersonal ?? 'N/A'); ?></p>

            
            <p><strong>Sexo:</strong>
                <?php switch($instructor->Sexo):
                    case (1): ?>
                        Masculino
                    <?php break; ?>

                    <?php case (2): ?>
                        Femenino
                    <?php break; ?>

                    <?php default: ?>
                        N/A
                <?php endswitch; ?>
            </p>

            
            <p>
                <strong>Fecha Nacimiento:</strong>
                <?php echo e($instructor->FechaNac ? \Carbon\Carbon::parse($instructor->FechaNac)->format('d-m-Y') : 'N/A'); ?>

            </p>

            <hr>


            <p><strong>Tipo de Documento:</strong>
                <?php echo e($instructor->tiposdocumento?->denominacion ?? 'N/A'); ?>


            </p>

            <p><strong>EPS:</strong>
                <?php echo e($instructor->eps?->denominacion ?? 'N/A'); ?>


            </p>


            <hr>
            <p><strong>Fecha de Creación:</strong>
                <?php echo e($instructor->created_at ? $instructor->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>
            <p><strong>Última Actualización:</strong>
                <?php echo e($instructor->updated_at ? $instructor->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        
        <div class="card-footer">
            <a href="<?php echo e(route('instructores.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="<?php echo e(route('instructores.edit', $instructor->NIS)); ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\Instructores\show.blade.php ENDPATH**/ ?>