<?php $__env->startSection('title', 'Editar Ficha de Caracterización'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Editar Ficha #<?php echo e($ficha->NIS); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>

                <form action="<?php echo e(route('fichas.update', $ficha)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="number" class="form-control bg-light" value="<?php echo e($ficha->NIS); ?>" readonly>
                        </div>

                        
                        <div class="form-group">
                            <label>Código <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="Codigo"
                                   class="form-control <?php $__errorArgs = ['Codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('Codigo', $ficha->Codigo)); ?>"
                                   required>
                            <?php $__errorArgs = ['Codigo'];
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
                            <label>Denominación <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="Denominacion"
                                   class="form-control <?php $__errorArgs = ['Denominacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('Denominacion', $ficha->Denominacion)); ?>"
                                   maxlength="100"
                                   required>
                            <small class="form-text text-muted">Máximo 100 caracteres</small>
                            <?php $__errorArgs = ['Denominacion'];
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
                            <label>Cupo <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="Cupo"
                                   min="1"
                                   class="form-control <?php $__errorArgs = ['Cupo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('Cupo', $ficha->Cupo)); ?>"
                                   required>
                            <?php $__errorArgs = ['Cupo'];
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
                            <label>Programa de Formación <span class="text-danger">*</span></label>
                            <select name="tbl_programasdeformacion_NIS"
                                    class="form-control <?php $__errorArgs = ['tbl_programasdeformacion_NIS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>
                                <option value="">Seleccione un programa...</option>
                                <?php $__currentLoopData = $programas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nis => $denominacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($nis); ?>" <?php echo e(old('tbl_programasdeformacion_NIS', $ficha->tbl_programasdeformacion_NIS) == $nis ? 'selected' : ''); ?>>
                                        <?php echo e($nis); ?> - <?php echo e($denominacion); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tbl_programasdeformacion_NIS'];
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
                            <label>Instructor <span class="text-danger">*</span></label>
                            <select name="tbl_instructores_NIS"
                                    class="form-control <?php $__errorArgs = ['tbl_instructores_NIS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>
                                <option value="">Seleccione un instructor...</option>
                                <?php $__currentLoopData = $instructores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nis => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($nis); ?>" <?php echo e(old('tbl_instructores_NIS', $ficha->tbl_instructores_NIS) == $nis ? 'selected' : ''); ?>>
                                        <?php echo e($nis); ?> - <?php echo e($nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tbl_instructores_NIS'];
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
                            <label>Fecha Inicio</label>
                            <input type="date"
                                   name="FechaInicio"
                                   class="form-control <?php $__errorArgs = ['FechaInicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('FechaInicio', optional($ficha->FechaInicio)->format('Y-m-d'))); ?>">
                            <small class="form-text text-muted">Opcional. Dejar en blanco si no aplica.</small>
                            <?php $__errorArgs = ['FechaInicio'];
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
                            <label>Fecha Fin</label>
                            <input type="date"
                                   name="FechaFin"
                                   class="form-control <?php $__errorArgs = ['FechaFin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('FechaFin', optional($ficha->FechaFin)->format('Y-m-d'))); ?>">
                            <small class="form-text text-muted">Opcional. Debe ser posterior a la fecha de inicio.</small>
                            <?php $__errorArgs = ['FechaFin'];
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
                            <label>Observaciones</label>
                            <textarea name="Observaciones"
                                      rows="3"
                                      class="form-control <?php $__errorArgs = ['Observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      maxlength="200"><?php echo e(old('Observaciones', $ficha->Observaciones)); ?></textarea>
                            <small class="form-text text-muted">Máximo 200 caracteres</small>
                            <?php $__errorArgs = ['Observaciones'];
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
                        <a href="<?php echo e(route('fichas.index')); ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar Ficha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // Validación adicional en cliente
        document.querySelector('form').addEventListener('submit', function(e) {
            let fechaInicio = document.querySelector('input[name="FechaInicio"]').value;
            let fechaFin = document.querySelector('input[name="FechaFin"]').value;

            if (fechaInicio && fechaFin) {
                if (new Date(fechaFin) < new Date(fechaInicio)) {
                    e.preventDefault();
                    alert('La fecha de fin no puede ser menor a la fecha de inicio');
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\fichas\edit.blade.php ENDPATH**/ ?>