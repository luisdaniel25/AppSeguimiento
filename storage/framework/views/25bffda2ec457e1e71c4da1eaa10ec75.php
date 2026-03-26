<?php $__env->startSection('title', 'Nueva Bitácora'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Subir Nueva Bitácora</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Bitácora</h3>
                </div>

                <form action="<?php echo e(route('archivos.store')); ?>" method="POST" enctype="multipart/form-data" id="form-bitacora">
                    <?php echo csrf_field(); ?>

                    <div class="card-body">

                        
                        <?php if(isset($aprendiz)): ?>
                            <div class="alert alert-info">
                                <strong>Aprendiz:</strong> <?php echo e($aprendiz->Nombres); ?> <?php echo e($aprendiz->Apellidos); ?><br>
                                <strong>NIS:</strong> <?php echo e($aprendiz->NIS); ?><br>
                                <?php if($aprendiz->programaDeFormacion): ?>
                                    <strong>Programa:</strong> <?php echo e($aprendiz->programaDeFormacion->Denominacion ?? 'No asignado'); ?>

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        
                        <div class="form-group">
                            <label for="archivo">Archivo (Bitácora) *</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input <?php $__errorArgs = ['archivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="archivo"
                                           name="archivo"
                                           required>
                                    <label class="custom-file-label" for="archivo">Seleccionar archivo</label>
                                </div>
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
                            <small class="form-text text-muted">
                                Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG (Máx. 10MB)
                            </small>
                        </div>

                        
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion"
                                      id="descripcion"
                                      class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      rows="4"
                                      placeholder="Describe brevemente el contenido de la bitácora..."><?php echo e(old('descripcion')); ?></textarea>
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
                            <small class="form-text text-muted">Máximo 500 caracteres (opcional)</small>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo e(route('archivos.index')); ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Subir Bitácora</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Muestra el nombre del archivo seleccionado en el input
        $(document).ready(function() {
            bsCustomFileInput.init();
        });

        document.getElementById('form-bitacora').addEventListener('submit', function(e) {
            e.preventDefault();

            const archivo = document.getElementById('archivo');

            // Validar que haya archivo seleccionado
            if (!archivo.files || archivo.files.length === 0) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Debes seleccionar un archivo' });
                return;
            }

            // Validar tamaño máximo 10MB
            if (archivo.files[0].size > 10485760) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'El archivo no puede superar los 10MB' });
                return;
            }

            // Confirmación antes de enviar
            Swal.fire({
                title: '¿Subir bitácora?',
                text: "El archivo se guardará en el sistema",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, subir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Envía el formulario si confirma
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AppSeguimiento\resources\views/archivos/create.blade.php ENDPATH**/ ?>