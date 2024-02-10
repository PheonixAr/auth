<?php $__env->startSection('body'); ?>
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mb-0">List Customer</h2>
        
        <a href="<?php echo e(route('customer.create')); ?>" class="btn btn-primary">Add customer</a>
        
        
        

    </div>
    <hr />
    <?php if(Session::has('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('success')); ?>

        </div>
    <?php endif; ?>
    <table class="table table-hover">
        <thead class="table-secondary">
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($customer->count() > 0): ?>
                <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                        <td class="align-middle"><?php echo e($rs->name); ?></td>
                        <td class="align-middle"><?php echo e($rs->email); ?></td>
                        <td class="align-middle"><?php echo e($rs->phone); ?></td>
                        <td class="align-middle"><?php echo e($rs->role); ?></td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo e(route('customer.show', $rs->id)); ?>" type="button"
                                    class="btn btn-warning">Detail</a>
                                <a href="<?php echo e(route('customer.edit', $rs->id)); ?>" type="button"
                                    class="btn btn-primary">Edit</a>
                                <form action="<?php echo e(route('customer.destroy', $rs->id)); ?>" method="POST" type="button"
                                    class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td class="text-center" colspan="5">Product not found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div>
        <?php echo e($customer->links('pagination::bootstrap-4')); ?>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/auth/resources/views/customer/index.blade.php ENDPATH**/ ?>