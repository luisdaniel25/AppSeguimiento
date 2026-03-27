<?php $__env->startSection('title', 'Listado de usuarios'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Usuarios Registrados</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Usuarios</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($usuario->id); ?></td>
                            <td><?php echo e($usuario->name); ?></td>
                            <td><?php echo e($usuario->email); ?></td>
                            <td><?php echo e($usuario->password); ?></td>
                            <td><?php echo e($usuario->created_at->format('d/m/Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                No hay usuarios registrados
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($usuarios->links()); ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views\usuarios\index.blade.php ENDPATH**/ ?>