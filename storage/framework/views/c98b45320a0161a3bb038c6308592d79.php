<?php $__env->startSection('title', 'Detalle Ficha de Caracterización'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-file-alt mr-2"></i>
            Detalle de la Ficha #<?php echo e($ficha->NIS); ?>

        </h1>

        
        <?php
            $estado = 'Sin fechas';
            $color = 'secondary';

            if ($ficha->FechaInicio && $ficha->FechaFin) {
                $hoy = now();
                if ($hoy->between($ficha->FechaInicio, $ficha->FechaFin)) {
                    $estado = 'Activa';
                    $color = 'success';
                } elseif ($hoy > $ficha->FechaFin) {
                    $estado = 'Finalizada';
                    $color = 'secondary';
                } else {
                    $estado = 'Próxima';
                    $color = 'warning';
                }
            }
        ?>
        <span class="badge badge-<?php echo e($color); ?> badge-lg">
            <i class="fas fa-<?php echo e($color == 'success' ? 'check-circle' : ($color == 'warning' ? 'clock' : 'calendar')); ?> mr-1"></i>
            <?php echo e($estado); ?>

        </span>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Información de la Ficha
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="30%">NIS:</th>
                            <td>
                                <span class="badge badge-dark"><?php echo e($ficha->NIS); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Código:</th>
                            <td><?php echo e($ficha->Codigo); ?></td>
                        </tr>
                        <tr>
                            <th>Denominación:</th>
                            <td><?php echo e($ficha->Denominacion); ?></td>
                        </tr>
                        <tr>
                            <th>Cupo:</th>
                            <td>
                                <span class="badge badge-<?php echo e($ficha->Cupo > 0 ? 'success' : 'danger'); ?> badge-pill">
                                    <?php echo e($ficha->Cupo); ?> cupos
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Instructor:</th>
                            <td>
                                <?php if($ficha->instructor): ?>
                                    <i class="fas fa-chalkboard-teacher mr-1 text-primary"></i>
                                    <?php echo e($ficha->instructor->Nombres); ?> <?php echo e($ficha->instructor->Apellidos); ?>

                                    <small class="text-muted ml-2">(NIS: <?php echo e($ficha->instructor->NIS); ?>)</small>
                                <?php else: ?>

                                    <span class="text-muted">No asignado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha Inicio:</th>
                            <td>
                                <?php if($ficha->FechaInicio): ?>
                                    <i class="fas fa-calendar-alt mr-1 text-success"></i>
                                    <?php echo e($ficha->FechaInicio->format('d-m-Y')); ?>

                                <?php else: ?>
                                    <span class="text-muted">No definida</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha Fin:</th>
                            <td>
                                <?php if($ficha->FechaFin): ?>
                                    <i class="fas fa-calendar-check mr-1 text-warning"></i>
                                    <?php echo e($ficha->FechaFin->format('d-m-Y')); ?>

                                <?php else: ?>
                                    <span class="text-muted">No definida</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Observaciones:</th>
                            <td>
                                <?php echo e($ficha->Observaciones ?? 'Sin observaciones'); ?>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-2"></i>
                        Auditoría
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th><i class="fas fa-clock mr-1"></i> Creado:</th>
                            <td>
                                <?php echo e($ficha->created_at ? $ficha->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-sync-alt mr-1"></i> Actualizado:</th>
                            <td>
                                <?php echo e($ficha->updated_at ? $ficha->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            
            <div class="card card-info card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Resumen
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th>Días transcurridos:</th>
                            <td>
                                <?php if($ficha->FechaInicio): ?>
                                    <?php echo e($ficha->FechaInicio->diffInDays(now())); ?> días
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Días restantes:</th>
                            <td>
                                <?php if($ficha->FechaFin && $ficha->FechaFin > now()): ?>
                                    <?php echo e(now()->diffInDays($ficha->FechaFin)); ?> días
                                <?php elseif($ficha->FechaFin && $ficha->FechaFin <= now()): ?>
                                    0 días
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Programa de Formación Asociado
                    </h3>
                </div>

                <div class="card-body p-0">
                    <?php if($ficha->programaDeFormacion): ?>
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Denominación</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><?php echo e($ficha->programaDeFormacion->Codigo ?? 'N/A'); ?></td>
                                <td><?php echo e($ficha->programaDeFormacion->Denominacion); ?></td>
                                <td>
                                    <a href="<?php echo e(route('programas.show', $ficha->programaDeFormacion)); ?>"
                                       class="btn btn-xs btn-info"
                                       title="Ver programa">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="text-center p-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">No hay programa asociado a esta ficha</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card-footer bg-white d-flex justify-content-between">
                <a href="<?php echo e(route('fichas.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Volver al listado
                </a>

                <div>
                    <a href="<?php echo e(route('fichas.edit', $ficha)); ?>" class="btn btn-warning">
                        <i class="fas fa-edit mr-1"></i> Editar Ficha
                    </a>

                    <form action="<?php echo e(route('fichas.destroy', $ficha)); ?>"
                          method="POST"
                          style="display:inline;"
                          class="form-eliminar">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger ml-2">
                            <i class="fas fa-trash mr-1"></i> Eliminar Ficha
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .table th {
            background-color: #f4f6f9;
            font-weight: 600;
        }
        .badge-lg {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        .card-footer {
            border-top: 1px solid #dee2e6;
            background-color: #fff;
        }
        .table-sm th, .table-sm td {
            padding: 0.75rem;
        }
    </style>
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
                        title: '¿Eliminar ficha?',
                        text: "Esta acción no se puede revertir",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Deshabilitar botón para evitar doble envío
                            const btn = this.querySelector('button[type="submit"]');
                            if (btn) btn.disabled = true;
                            this.submit();
                        }
                    });
                });
            });

            // Tooltips automáticos de Bootstrap
            $('[title]').tooltip();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\fichas\show.blade.php ENDPATH**/ ?>