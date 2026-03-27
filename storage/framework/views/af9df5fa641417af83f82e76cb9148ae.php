<?php $__env->startSection('title', 'Detalle Regional'); ?>


<?php $__env->startSection('content_header'); ?>
    <h1>Detalles de la Regional</h1>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">Información de la Regional</h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th style="width:200px;">NIS</th>
                            <td><?php echo e($regionale->NIS); ?></td>
                        </tr>

                        <tr>
                            <th>Código</th>
                            <td><?php echo e($regionale->Codigo); ?></td>
                        </tr>

                        <tr>
                            <th>Denominación</th>
                            <td><?php echo e($regionale->Denominacion); ?></td>
                        </tr>

                        <tr>
                            <th>Observaciones</th>
                            <td><?php echo e($regionale->Observaciones ?? 'Sin observaciones'); ?></td>
                        </tr>

                        <tr>
                            <th>Fecha de creación</th>
                            <td>
                                <?php echo e($regionale->created_at ? $regionale->created_at->format('d/m/Y H:i') : 'No disponible'); ?>

                            </td>
                        </tr>

                        <tr>
                            <th>Última actualización</th>
                            <td>
                                <?php echo e($regionale->updated_at ? $regionale->updated_at->format('d/m/Y H:i') : 'No disponible'); ?>

                            </td>
                        </tr>
                    </table>

                </div>

                
                <div class="card-footer d-flex justify-content-between">

                    <a href="<?php echo e(route('regionales.index')); ?>" class="btn btn-secondary">
                        Volver
                    </a>

                    <div>
                        <a href="<?php echo e(route('regionales.edit', $regionale)); ?>" class="btn btn-warning">
                            Editar
                        </a>

                        <form action="<?php echo e(route('regionales.destroy', $regionale)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar esta regional?')">
                                Eliminar
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\regionales\show.blade.php ENDPATH**/ ?>