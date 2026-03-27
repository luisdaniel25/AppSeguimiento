<?php $__env->startSection('title', 'Editar Archivo'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Editar Archivo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modificar información del archivo</h3>
                </div>

                <form action="<?php echo e(route('archivos.update', $archivo->id)); ?>"
                      method="POST"
                      enctype="multipart/form-data"
                      class="form-actualizar">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="card-body">

                        
                        <div class="form-group">
                            <label>Seleccionar Aprendiz *</label>
                            <select name="tbl_aprendices_NIS"
                                    class="form-control <?php $__errorArgs = ['tbl_aprendices_NIS'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>
                                <option value="">-- Seleccione --</option>
                                <?php $__currentLoopData = $aprendices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aprendiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($aprendiz->NIS); ?>"
                                        <?php echo e(old('tbl_aprendices_NIS', $archivo->tbl_aprendices_NIS) == $aprendiz->NIS ? 'selected' : ''); ?>>
                                        <?php echo e($aprendiz->Nombres); ?> <?php echo e($aprendiz->Apellidos); ?>

                                        (<?php echo e($aprendiz->programaDeFormacion->Denominacion ?? 'Sin programa'); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tbl_aprendices_NIS'];
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
                            <label>Descripción</label>
                            <input type="text"
                                   name="descripcion"
                                   class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('descripcion', $archivo->descripcion)); ?>"
                                   placeholder="Descripción del archivo">
                            <?php $__errorArgs = ['descripcion'];
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
                            <label>Archivo actual</label><br>
                            <div class="d-flex align-items-center">
                                <?php if(Str::startsWith($archivo->tipo_mime, 'image')): ?>
                                    <img src="<?php echo e(asset('storage/' . $archivo->ruta)); ?>"
                                         width="50" height="50"
                                         class="rounded mr-2"
                                         style="object-fit: cover;">
                                <?php else: ?>
                                    <?php if(Str::contains($archivo->tipo_mime, 'pdf')): ?>
                                        <i class="fas fa-file-pdf text-danger fa-2x mr-2"></i>
                                    <?php elseif(Str::contains($archivo->tipo_mime, 'word') || Str::contains($archivo->tipo_mime, 'document')): ?>
                                        <i class="fas fa-file-word text-primary fa-2x mr-2"></i>
                                    <?php elseif(Str::contains($archivo->tipo_mime, 'excel') || Str::contains($archivo->tipo_mime, 'sheet')): ?>
                                        <i class="fas fa-file-excel text-success fa-2x mr-2"></i>
                                    <?php else: ?>
                                        <i class="fas fa-file text-secondary fa-2x mr-2"></i>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <span class="ml-2"><?php echo e($archivo->nombre_original); ?></span>
                                <a href="<?php echo e(route('archivos.show', $archivo->id)); ?>"
                                   class="btn btn-info btn-sm ml-3" target="_blank">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="<?php echo e(route('archivos.download', $archivo->id)); ?>"
                                   class="btn btn-success btn-sm ml-2">
                                    <i class="fas fa-download"></i> Descargar
                                </a>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label>Reemplazar archivo (opcional)</label>
                            <div class="custom-file">
                                <input type="file"
                                       name="archivo"
                                       class="custom-file-input <?php $__errorArgs = ['archivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="customFile"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">
                                    <?php echo e($archivo->nombre_original); ?>

                                </label>
                            </div>
                            <?php $__errorArgs = ['archivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                Si no seleccionas uno, se mantiene el actual. Permitidos: PDF, Word, Excel, Imágenes (Máx 10MB)
                            </small>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo e(route('archivos.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
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

            // Actualiza el label con el nombre del nuevo archivo seleccionado
            const inputFile = document.getElementById('customFile');
            if (inputFile) {
                inputFile.addEventListener('change', function(e) {
                    let fileName = e.target.files[0]?.name || 'Elegir nuevo archivo';
                    e.target.nextElementSibling.innerText = fileName;
                });
            }

            // Confirmación SweetAlert antes de guardar cambios
            const form = document.querySelector('.form-actualizar');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Actualizar archivo?',
                        text: "Los cambios serán guardados permanentemente",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#ffc107',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }

            // Muestra error de sesión si existe
            <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo e(session('error')); ?>',
                timer: 5000,
                showConfirmButton: true
            });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\archivos\edit.blade.php ENDPATH**/ ?>