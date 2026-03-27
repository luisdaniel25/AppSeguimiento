<?php $__env->startSection('title', 'Detalle Programa de Formación'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Programa de Formación</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($programa->Denominacion); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($programa->NIS); ?></p>
            <p><strong>Código:</strong> <?php echo e($programa->Codigo); ?></p>
            <p><strong>Denominación:</strong> <?php echo e($programa->Denominacion); ?></p>
            <p><strong>Observaciones:</strong> <?php echo e($programa->Observaciones ?? 'N/A'); ?></p>

            <hr>

            
            <p><strong>Fichas de Caracterización:</strong></p>
            <?php if($programa->fichasCaracterizacion && $programa->fichasCaracterizacion->count() > 0): ?>
                <div class="ml-3">
                    <?php $__currentLoopData = $programa->fichasCaracterizacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ficha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-2 p-2 border-left border-info">
                            <strong>Ficha #<?php echo e($ficha->NIS); ?></strong><br>
                            <small>Denominación: <?php echo e($ficha->Denominacion); ?></small><br>
                            <small>Cupo: <?php echo e($ficha->Cupo); ?></small><br>
                            <small>Instructor: <?php echo e($ficha->instructor->Nombres ?? 'N/A'); ?> <?php echo e($ficha->instructor->Apellidos ?? ''); ?></small><br>
                            <small>Vigencia: <?php echo e(\Carbon\Carbon::parse($ficha->FechaInicio)->format('d-m-Y')); ?> al <?php echo e(\Carbon\Carbon::parse($ficha->FechaFin)->format('d-m-Y')); ?></small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p><span class="badge badge-secondary">No hay fichas asociadas</span></p>
            <?php endif; ?>

            
            <p><strong>Aprendices Asignados:</strong></p>
            <?php if($programa->aprendices && $programa->aprendices->count() > 0): ?>
                <ul class="list-group mb-3">
                    <?php $__currentLoopData = $programa->aprendices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aprendiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <?php echo e($aprendiz->Nombres); ?> <?php echo e($aprendiz->Apellidos); ?>

                            <small class="text-muted">(Doc: <?php echo e($aprendiz->NumDoc); ?>)</small>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <p><span class="badge badge-secondary">No hay aprendices asignados</span></p>
            <?php endif; ?>

            <hr>
            <p><strong>Fecha de Creación:</strong>
                <?php echo e($programa->created_at ? $programa->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>
            <p><strong>Última Actualización:</strong>
                <?php echo e($programa->updated_at ? $programa->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        
        <div class="card-footer">
            <a href="<?php echo e(route('programas.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="<?php echo e(route('programas.edit', $programa->NIS)); ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\programas\show.blade.php ENDPATH**/ ?>