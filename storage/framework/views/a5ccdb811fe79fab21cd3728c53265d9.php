<?php $__env->startSection('title', 'Crear Regional'); ?>


<?php $__env->startSection('content_header'); ?>
    <h1>Crear Nueva Regional</h1>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="<?php echo e(route('regionales.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="card-body">


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
                                name="Codigo" value="<?php echo e(old('Codigo')); ?>" required>

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
                                id="Denominacion" name="Denominacion" value="<?php echo e(old('Denominacion')); ?>" required>

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
                                rows="3"><?php echo e(old('Observaciones')); ?></textarea>

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

                        <button type="submit" class="btn btn-primary">
                            Guardar Regional
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\regionales\create.blade.php ENDPATH**/ ?>