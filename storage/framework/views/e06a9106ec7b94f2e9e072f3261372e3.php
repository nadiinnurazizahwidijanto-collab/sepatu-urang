<?php $__env->startSection('content'); ?>
<div class="container py-5" style="margin-top: 50px;">
    <h2 class="fw-bold mb-4" style="font-family: 'Bodoni Moda', serif;">📦 Pesanan Masuk</h2>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0 text-center">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ps-4 small"><?php echo e($order->created_at->format('d/m/Y')); ?></td>
                        <td class="fw-bold"><?php echo e($order->user->name); ?></td>
                        <td class="text-success fw-bold">Rp<?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                        <td><span class="badge bg-light text-dark border"><?php echo e($order->payment_method); ?></span></td>
                        <td>
                            <?php if($order->status == 'P'): ?>
                                <form action="<?php echo e(route('admin.updateStatus', $order->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-warning fw-bold px-3 rounded-pill shadow-sm">
                                        PENDING
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="badge bg-success py-2 px-3 rounded-pill">SELESAI</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="py-5 text-muted">Belum ada pesanan masuk.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sepatuku\resources\views/admin/orders.blade.php ENDPATH**/ ?>