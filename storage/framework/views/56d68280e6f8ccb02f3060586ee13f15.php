<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->startSection('title', 'Editar Regional'); ?>


<?php $__env->startSection('content_header'); ?>
    <h1>Editar Regional</h1>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-warning">

                <div class="card-header">
                    <h3 class="card-title">Modificar Información</h3>
                </div>

                <form action="<?php echo e(route('regionales.update', $regionale)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="card-body">

                        
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="number" class="form-control" value="<?php echo e($regionale->NIS); ?>" disabled>

                            <small class="text-muted">
                                El NIS no se puede modificar
                            </small>
                        </div>

                        
                        <div class="form-group">
                            <label for="Codigo">Código *</label>
                            <input type="number" class="form-control <?php $__errorArgs = ['Codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Codigo"
                                name="Codigo" value="<?php echo e(old('Codigo', $regionale->Codigo)); ?>" required>

                            <?php $__errorArgs = ['Codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="form-group">
                            <label for="Denominacion">Denominación *</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['Denominacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="Denominacion" name="Denominacion"
                                value="<?php echo e(old('Denominacion', $regionale->Denominacion)); ?>" required>

                            <?php $__errorArgs = ['Denominacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="form-group">
                            <label for="Observaciones">Observaciones</label>
                            <textarea class="form-control <?php $__errorArgs = ['Observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Observaciones" name="Observaciones"
                                rows="3"><?php echo e(old('Observaciones', $regionale->Observaciones)); ?></textarea>

                            <?php $__errorArgs = ['Observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                    </div>

                    
                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo e(route('regionales.index')); ?>" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-warning">
                            Actualizar Regional
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\regionales\edit.blade.php ENDPATH**/ ?>