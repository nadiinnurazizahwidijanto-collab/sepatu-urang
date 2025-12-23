<?php $__env->startSection('content'); ?>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@700&family=Inter:wght@200;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --gold: #4d3815ff;
        --deep-black: #0a0a0a;
        --soft-white: #ffffff;
    }

    body { font-family: 'Inter', sans-serif; background-color: var(--soft-white); }

    /* Floating Support Chat (KIRI) */
    .support-chat { position: fixed; bottom: 30px; left: 30px; z-index: 1000; }
    .support-box {
        width: 55px; height: 55px; background: var(--deep-black);
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%; color: #fff; text-decoration: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 1px solid var(--gold);
        transition: 0.3s;
    }
    .support-box:hover { background: var(--gold); transform: translateY(-5px); color: #fff; }

    /* Floating Cart (KANAN) */
    .floating-cart-fixed { position: fixed; bottom: 30px; right: 30px; z-index: 1000; }
    .cart-box-fixed {
        width: 55px; height: 55px; background: var(--deep-black);
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%; color: #fff; text-decoration: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15); transition: 0.3s;
    }
    .cart-box-fixed:hover { transform: translateY(-5px); color: var(--gold); }
    .cart-box-fixed .badge { position: absolute; top: 0; right: 0; background: var(--gold); border: 2px solid #fff; }
</style>

<div class="container-fluid min-vh-100 d-flex flex-column" style="padding-top: 100px; padding-bottom: 100px;">

    <div class="container d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <h2 class="fw-bold m-0 text-dark" style="font-family: 'Bodoni Moda', serif;">
            <i class="fa-solid fa-bag-shopping me-2 text-success"></i>Shopping Bag
        </h2>

        <div class="position-relative p-2 bg-white border rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
            <i class="fa-solid fa-cart-shopping fs-6 text-dark"></i>
            <?php $badgeCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity'); ?>
            <?php if($badgeCount > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white" style="font-size: 0.65rem;">
                    <?php echo e($badgeCount); ?>

                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="container-fluid row m-0 justify-content-evenly">
        <div class="col-12 col-lg-7 shadow-sm pb-3 rounded-4 border bg-white overflow-auto mb-4" style="max-height: 60vh;" data-aos="fade-up">
            <table class="table text-center table-hover mt-2">
                <thead class="table-light">
                    <tr class="small text-uppercase" style="letter-spacing: 1px;">
                        <th>Hapus</th>
                        <th>Produk</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php $__empty_1 = true; $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="align-middle">
                            <td>
                                <form action="<?php echo e(route('cartDelete')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($cart->id); ?>">
                                    <button type="submit" class="btn btn-sm text-danger border-0"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                            <td><img src="<?php echo e(asset('img/'.$cart->products->image_path)); ?>" width="60px" class="rounded shadow-sm"></td>
                            <td class="fw-bold text-start small"><?php echo e($cart->products->name); ?></td>
                            <td class="small">Rp<?php echo e(number_format($cart->products->price, 0, ',', '.')); ?></td>
                            <td><span class="badge bg-light text-dark border px-2"><?php echo e($cart->quantity); ?></span></td>
                            <td class="fw-bold small">Rp<?php echo e(number_format($cart->products->price * $cart->quantity, 0, ',', '.')); ?></td>
                        </tr>
                        <?php $total += $cart->products->price * $cart->quantity; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="py-5 text-muted">Keranjang masih kosong.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-lg-4" data-aos="fade-left">
            <form action="<?php echo e(route('checkout')); ?>" method="post" id="checkoutForm" class="shadow-sm p-4 rounded-4 border bg-white">
                <?php echo csrf_field(); ?>
                <h5 class="fw-bold mb-4" style="font-family: 'Bodoni Moda', serif;">keranjang Belanja</h5>
                <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold small">Alamat Pengiriman</label>
                    <textarea class="form-control bg-light border-0" id="address" name="address" rows="2" placeholder="Tulis alamat lengkap..." required><?php echo e(old('address')); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small">Metode Pembayaran</label>
                    <select class="form-select bg-light border-0 fw-bold" id="payment_method" name="payment_method">
                        <option value="COD">💵 COD (Bayar di Tempat)</option>
                        <option value="QRIS">📱 QRIS (Dana/OVO/Gopay)</option>
                        <option value="Transfer Bank">🏦 Transfer Bank</option>
                    </select>
                </div>

                <div class="p-3 rounded-3 bg-light mb-4">
                    <?php
                        $discountPercent = session('discount', 0);
                        $total_after_discount = $total - ($total * $discountPercent / 100);
                    ?>
                    <div class="d-flex justify-content-between mb-1 small">
                        <span>Subtotal</span>
                        <span>Rp<?php echo e(number_format($total, 0, ',', '.')); ?></span>
                    </div>
                    <div class="d-flex justify-content-between text-success mb-1 small">
                        <span>Diskon (<?php echo e($discountPercent); ?>%)</span>
                        <span>- Rp<?php echo e(number_format($total * $discountPercent / 100, 0, ',', '.')); ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span id="display_total">Rp<?php echo e(number_format($total_after_discount, 0, ',', '.')); ?></span>
                    </div>
                </div>

                <input type="hidden" name="discount" value="<?php echo e($discountPercent); ?>">
                <input type="hidden" name="total_price" value="<?php echo e($total_after_discount); ?>">

                <button type="button" onclick="handleCheckout()" class="btn btn-dark w-100 py-3 fw-bold rounded-pill shadow">
                    PROSES PESANAN
                </button>
            </form>
        </div>
    </div>
</div>

<div class="support-chat" data-aos="fade-right">
    <a href="https://api.whatsapp.com/send?phone=+625880816462&text=Halo%20Min%2C%20mau%20tanya%20stok%20untuk%20barang%20di%20keranjang%20saya..." target="_blank" class="support-box">
        <i class="fa-solid fa-headset fs-5"></i>
    </a>
</div>

<div class="floating-cart-fixed" data-aos="fade-left">
    <a href="<?php echo e(route('cart')); ?>" class="cart-box-fixed">
        <i class="fa-solid fa-cart-shopping fs-5"></i>
        <?php if($badgeCount > 0): ?>
            <span class="badge rounded-pill"><?php echo e($badgeCount); ?></span>
        <?php endif; ?>
    </a>
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();

    function handleCheckout() {
        const address = document.getElementById("address").value;
        const method = document.getElementById("payment_method").value;
        const total = document.getElementById("display_total").innerText;

        if (!address.trim()) {
            Swal.fire('Alamat Kosong', 'Harap isi alamat pengiriman.', 'warning');
            return;
        }

        if (method === "QRIS") {
            Swal.fire({
                title: 'Bayar via QRIS',
                text: 'Silakan scan QRIS: ' + total,
                imageUrl: 'https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg', // Ganti QRIS kamu
                imageWidth: 250,
                showCancelButton: true,
                confirmButtonText: 'Sudah Bayar',
                confirmButtonColor: '#198754'
            }).then((result) => { if (result.isConfirmed) { prosesWA(address, method, total); } });

        } else if (method === "Transfer Bank") {
            Swal.fire({
                title: 'Transfer Bank',
                html: 'Transfer ke:<br><b>BCA: 123456789 a/n Sapatu Urang</b><br>Total: ' + total,
                imageUrl: 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg', // Ganti Logo Bank
                imageWidth: 200,
                showCancelButton: true,
                confirmButtonText: 'Sudah Transfer',
                confirmButtonColor: '#198754'
            }).then((result) => { if (result.isConfirmed) { prosesWA(address, method, total); } });

        } else {
            Swal.fire({
                title: 'Konfirmasi COD',
                text: "Selesaikan pesanan sekarang?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Selesaikan'
            }).then((result) => { if (result.isConfirmed) { prosesWA(address, method, total); } });
        }
    }

    function prosesWA(address, method, total) {
        let pesan = "*PESANAN BARU*%0A";
        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> pesan += "• <?php echo e($cart->products->name); ?> (<?php echo e($cart->quantity); ?>x)%0A"; <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        pesan += `%0A*Total:* ${total}%0A*Metode:* ${method}%0A*Alamat:* ${address}`;

        window.open(`https://api.whatsapp.com/send?phone=+625880816462&text=${pesan}`, '_blank');
        document.getElementById("checkoutForm").submit();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sepatuku\resources\views/user/cart.blade.php ENDPATH**/ ?>