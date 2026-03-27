<?php $__env->startSection('title', 'Listado de fichas'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Fichas de Caracterización</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <a href="<?php echo e(route('fichas.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Ficha
            </a>
        </div>

        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check mr-2"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-exclamation-triangle mr-2"></i> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>NIS</th>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Cupo</th>
                        <th>Instructor</th>
                        <th>Programa</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th width="120px">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $fichas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ficha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($ficha->NIS); ?></td>
                            <td><?php echo e($ficha->Codigo); ?></td>
                            <td><?php echo e($ficha->Denominacion); ?></td>
                            <td class="text-center"><?php echo e($ficha->Cupo); ?></td>

                            
                            <td>
                                <?php if($ficha->instructor): ?>
                                    <?php echo e($ficha->instructor->Nombres); ?> <?php echo e($ficha->instructor->Apellidos); ?>

                                <?php else: ?>
                                    <span class="text-muted">Sin asignar</span>
                                <?php endif; ?>
                            </td>

                            
                            <td>
                                <?php if($ficha->programaDeFormacion): ?>
                                    <?php echo e($ficha->programaDeFormacion->Denominacion); ?>

                                <?php else: ?>
                                    <span class="text-muted">Sin programa</span>
                                <?php endif; ?>
                            </td>

                            
                            <td>
                                <?php if($ficha->FechaInicio && $ficha->FechaFin): ?>
                                    <small>
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo e($ficha->FechaInicio->format('d/m/Y')); ?><br>
                                        <i class="far fa-calendar-check"></i>
                                        <?php echo e($ficha->FechaFin->format('d/m/Y')); ?>

                                    </small>
                                <?php else: ?>
                                    <span class="text-muted">
                                        <i class="far fa-calendar-times"></i> No definidas
                                    </span>
                                <?php endif; ?>
                            </td>

                            
                            <td class="text-center">
                                <?php if($ficha->FechaInicio && $ficha->FechaFin): ?>
                                    <?php
                                        $hoy = now();
                                        $activa = $hoy->between($ficha->FechaInicio, $ficha->FechaFin);
                                    ?>
                                    <?php if($activa): ?>
                                        <span class="badge badge-success">Activa</span>
                                    <?php elseif($hoy > $ficha->FechaFin): ?>
                                        <span class="badge badge-secondary">Finalizada</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Próxima</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge badge-light">Sin fechas</span>
                                <?php endif; ?>
                            </td>

                            
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('fichas.show', $ficha)); ?>"
                                       class="btn btn-sm btn-info"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="<?php echo e(route('fichas.edit', $ficha)); ?>"
                                       class="btn btn-sm btn-warning"
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="<?php echo e(route('fichas.destroy', $ficha)); ?>"
                                          method="POST"
                                          style="display:inline;"
                                          class="form-eliminar">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Eliminar ficha">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No hay fichas registradas</p>
                                <a href="<?php echo e(route('fichas.create')); ?>" class="btn btn-primary btn-sm mt-3">
                                    <i class="fas fa-plus"></i> Crear primera ficha
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($fichas->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Confirmación eliminar
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede revertir",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Auto-cerrar alertas después de 5 segundos
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/fichas/index.blade.php ENDPATH**/ ?>