<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-5 p-0 min-vh-100 d-flex flex-column justify-content-center align-items-center bg-white">
        <div class="row w-100 container">
            <div class="col-12 col-lg-6 pt-3 pb-3 text-center">
                <img src="<?php echo e(asset('img/'.$product->image_path)); ?>" class="rounded-2 shadow-sm" width="300px" alt="">
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
                <div class="container">
                    <h1 class="mb-0"><?php echo e($product->name); ?></h1>
                    <h6><?php echo e($product->category->name); ?>'s Shoes</h6>
                    <h5>Rp<?php echo e($product->price); ?></h5>
                    <p style="text-align: justify;text-justify: inter-word;"><?php echo e($product->description); ?></p>
                    <form action="<?php echo e(route('cartStore')); ?>" method="POST" class="d-flex">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <div class="d-flex me-2">
                            <button type="button" class="btn btn-dark rounded-end-0 border-1 border-light-subtle" id="btn-minus">-</button>
                            <input type="text" class="form-control text-center rounded-0 bg-white border-0 border-top border-bottom border-light-subtle" style="width: 60px;" id="quantity" name="quantity" value="1" readonly>
                            <button type="button" class="btn btn-dark rounded-start-0 border-1 border-light-subtle" id="btn-plus">+</button>
                        </div>
                        <button type="submit" class="btn btn-dark">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <?php if((session('success')) || (session('failed'))): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast <?php echo e((session('success')) ? 'bg-success' : 'bg-danger'); ?> text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <img src="<?php echo e(asset('img/unnamed-removebg-preview.png')); ?>" width="30px" class="rounded me-2" alt="logo">
                <strong class="me-auto">sepatu urang</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo e((session('success')) ? session('success') : session('failed')); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <script>
        const minus = document.querySelector("#btn-minus");
        const plus = document.querySelector("#btn-plus");
        const quantity = document.querySelector("#quantity");

        let nilai = 1;

        minus.addEventListener("click", () => {
            if (quantity.value > 1) {
                nilai--;
            }
            quantity.value = nilai;
        });
        plus.addEventListener("click", () => {
            nilai++;
            quantity.value = nilai;
        });

        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('liveToast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sepatuku\resources\views/user/detail.blade.php ENDPATH**/ ?>