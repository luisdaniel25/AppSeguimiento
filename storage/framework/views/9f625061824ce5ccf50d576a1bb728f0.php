<?php $__env->startSection('title', 'Ver Archivo'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Archivo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Información del Archivo</h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Nombre:</th>
                                    <td><?php echo e($archivo->nombre_original); ?></td>
                                </tr>
                                <tr>
                                    <th>Aprendiz:</th>
                                    <td>
                                        <?php if($archivo->aprendiz): ?>
                                            <strong><?php echo e($archivo->aprendiz->Nombres); ?> <?php echo e($archivo->aprendiz->Apellidos); ?></strong>
                                            <br>
                                            <small class="text-muted">Documento: <?php echo e($archivo->aprendiz->NumDoc); ?></small>
                                        <?php else: ?>
                                            <span class="badge badge-danger">No asignado</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tipo MIME:</th>
                                    <td><span class="badge badge-info"><?php echo e($archivo->tipo_mime); ?></span></td>
                                </tr>
                                <tr>
                                    <th>Tamaño:</th>
                                    <td><strong><?php echo e($archivo->tamano_formateado); ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td><?php echo e($archivo->descripcion ?? 'Sin descripción'); ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha subida:</th>
                                    <td><?php echo e($archivo->created_at->format('d/m/Y H:i:s')); ?></td>
                                </tr>
                                <tr>
                                    <th>Última actualización:</th>
                                    <td><?php echo e($archivo->updated_at->format('d/m/Y H:i:s')); ?></td>
                                </tr>
                            </table>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="text-center">
                                <?php if(Str::startsWith($archivo->tipo_mime, 'image')): ?>
                                    
                                    <img src="<?php echo e(asset('storage/' . $archivo->ruta)); ?>"
                                         class="img-fluid rounded"
                                         style="max-height: 300px;"
                                         alt="<?php echo e($archivo->nombre_original); ?>">

                                <?php elseif(Str::contains($archivo->tipo_mime, 'pdf')): ?>
                                    
                                    <iframe src="<?php echo e(asset('storage/' . $archivo->ruta)); ?>"
                                            width="100%"
                                            height="400px"
                                            style="border: 1px solid #ddd;">
                                    </iframe>

                                <?php else: ?>
                                    
                                    <div class="text-center p-5">
                                        <i class="fas fa-file fa-5x text-secondary mb-3"></i>
                                        <p class="mb-3">Vista previa no disponible para este tipo de archivo</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="<?php echo e(route('archivos.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="<?php echo e(route('archivos.download', $archivo->id)); ?>" class="btn btn-success">
                            <i class="fas fa-download"></i> Descargar
                        </a>
                        <a href="<?php echo e(route('archivos.edit', $archivo->id)); ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\archivos\show.blade.php ENDPATH**/ ?>