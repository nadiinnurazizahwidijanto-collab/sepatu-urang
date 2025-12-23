<?php $__env->startSection('content'); ?>
    <div class="container-fluid min-vh-100 d-flex align-items-center" style="padding-top: 57px;">
        <div class="container-fluid h-100 m-0 justify-content-evenly">
            <div class="shadow p-3 rounded-3 overflow-auto">
                <h3 class="mb-3">Orders</h3>
                <table class="table table-hover text-center table-striped">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Address</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Delivery Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="align-middle text-center">
                            <td><img src="<?php echo e(asset('img/unnamed-removebg-preview.png')); ?>" width="150px" alt="logo"></td>
                            <td>Rp<?php echo e($order->total_price); ?></td>
                            <td><?php echo e($order->address); ?></td>
                            <td><?php echo e($order->payment_method); ?></td>
                            <td><strong title="<?php echo e(($order->delivery_status == 'P')? 'pending' : (($order->delivery_status == 'S')? 'success' : (($order->delivery_status == 'C')? 'cancel' : ''))); ?>" class="p-2 ps-3 pe-3 rounded-2 text-white <?php echo e(($order->delivery_status == 'P')? 'bg-warning' : (($order->delivery_status == 'S')? 'bg-success' : (($order->delivery_status == 'C')? 'bg-danger' : ''))); ?>"><?php echo e($order->delivery_status); ?></strong></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sepatuku\resources\views/user/order.blade.php ENDPATH**/ ?>