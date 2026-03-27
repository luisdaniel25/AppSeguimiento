<?php $__env->startSection('title', 'Crear Ente Conformador'); ?>


<?php $__env->startSection('content_header'); ?>
    <h1>Crear Registro Nuevo</h1>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="<?php echo e(route('enteconformador.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="card-body">


                        <div class="form-group">
                            <label for="NumDoc">Numero Documento *</label>
                            <input type="number" class="form-control <?php $__errorArgs = ['NumDoc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="NumDoc"
                                name="NumDoc" value="<?php echo e(old('NumDoc')); ?>" required>

                            <?php $__errorArgs = ['NumDoc'];
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
                            <label for="RazonSocial">Razon Social *</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['RazonSocial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="RazonSocial" name="RazonSocial" value="<?php echo e(old('RazonSocial')); ?>" required>

                            <?php $__errorArgs = ['RazonSocial'];
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
                            <label for="Direccion">Direccion *</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['Direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="Direccion" name="Direccion" value="<?php echo e(old('Direccion')); ?>" required>

                            <?php $__errorArgs = ['Direccion'];
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
                            <label for="Telefono">Telefono *</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['Telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="Telefono" name="Telefono" value="<?php echo e(old('Telefono')); ?>" required>

                            <?php $__errorArgs = ['Telefono'];
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
                            <label for="CorreoInstitucional">Correo Institucional *</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['CorreoInstitucional'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="CorreoInstitucional" name="CorreoInstitucional" value="<?php echo e(old('CorreoInstitucional')); ?>"
                                required>

                            <?php $__errorArgs = ['CorreoInstitucional'];
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
                            <label>Tipo Documento *</label>
                            <select name="tbl_tiposdocumentos_nis"
                                class="form-control <?php $__errorArgs = ['tbl_tiposdocumentos_nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Seleccione un Tipo de Documento...</option>
                                <?php $__currentLoopData = $listaTiposDocumentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoDoc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tipoDoc->nis); ?>"
                                        <?php echo e(old('tbl_tiposdocumentos_nis') == $tipoDoc->nis ? 'selected' : ''); ?>>
                                        <?php echo e($tipoDoc->denominacion); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tbl_tiposdocumentos_nis'];
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
                        <div class="form-group">
                            <label>Rol *</label>
                            <select name="tbl_rolesadministrativos_NIS"
                                class="form-control <?php $__errorArgs = ['tbl_rolesadministrativos_NIS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Seleccione un rol</option>
                                <?php $__currentLoopData = $listaRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($rol->NIS); ?>"
                                        <?php echo e(old('tbl_rolesadministrativos_NIS') == $rol->NIS ? 'selected' : ''); ?>>
                                        <?php echo e($rol->Descripcion); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tbl_rolesadministrativos_NIS'];
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
                        <a href="<?php echo e(route('enteconformador.index')); ?>" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Guardar Ente Conformador
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\enteconformador\create.blade.php ENDPATH**/ ?>