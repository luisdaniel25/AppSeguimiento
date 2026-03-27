<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('title', 'Editar Rol Administrativo'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Editar Rol Administrativo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>

                <form action="<?php echo e(route('rolesadministrativos.update', $rolesadministrativo->NIS)); ?>" method="POST"
                    class="form-guardar">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Descripción *</label>
                            <input type="text" name="Descripcion"
                                class="form-control <?php $__errorArgs = ['Descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('Descripcion', $rolesadministrativo->Descripcion)); ?>" required>

                            <?php $__errorArgs = ['Descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo e(route('rolesadministrativos.index')); ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar Rol</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.form-guardar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) return;
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Deseas actualizar?',
                        text: "Los datos del rol administrativo serán modificados.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\rolesadministrativos\edit.blade.php ENDPATH**/ ?>