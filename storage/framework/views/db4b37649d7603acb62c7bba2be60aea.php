<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sapatu-urang - <?php echo e($titlePage ?? 'Luxury Footwear'); ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    
    <link rel="icon" href="<?php echo e(asset('img/unnamed-removebg-preview.png')); ?>" type="image/png">

    
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    <meta name="theme-color" content="#000000">
    <link rel="apple-touch-icon" href="<?php echo e(asset('img/icons/icon-192x192.png')); ?>">

    <style>
      :root {
        --lux-gold: #4d3815;
        --lux-black: #0a0a0a;
      }

      body {
        font-family: 'Poppins', sans-serif;
        background-color: #ffffff;
      }

      .navbar {
        transition: all 0.3s ease-in-out;
        background-color: #ffffff !important;
      }

      .navbar-brand {
        font-family: 'Bodoni Moda', serif;
        letter-spacing: 1px;
      }

      .nav-link {
        color: var(--lux-black) !important;
        font-weight: 400;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        transition: 0.3s;
      }

      .nav-link:hover {
        color: var(--lux-gold) !important;
      }

      /* SweetAlert Style */
      .swal2-popup {
          font-family: 'Poppins', sans-serif !important;
          border-radius: 0 !important;
      }
      .swal2-confirm {
          border-radius: 0 !important;
          background-color: var(--lux-black) !important;
          letter-spacing: 1px;
          text-transform: uppercase;
          font-size: 0.8rem !important;
      }

      #scrollToTopButton {
        right: 20px;
        bottom: 20px;
        display: none;
        z-index: 1000;
        border-radius: 0;
        background: var(--lux-black);
        color: white;
        border: none;
        padding: 10px 15px;
      }

      /* Install PWA Button */
      #installAppBtn {
        position: fixed;
        bottom: 80px;
        right: 20px;
        display: none;
        z-index: 1000;
        border-radius: 0;
        background: var(--lux-black);
        color: white;
        border: none;
        padding: 10px 15px;
        font-weight: bold;
      }

      /* Admin Styling */
      .admin-link {
          color: #dc3545 !important;
          font-weight: 600 !important;
      }

      .dropdown-item.small {
          font-size: 0.75rem;
          letter-spacing: 1px;
      }
    </style>
</head>
<body>

  
  <button id="scrollToTopButton" class="btn btn-dark position-fixed shadow">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  
  <button id="installAppBtn">
    <i class="fa-solid fa-download me-1"></i> Install App
  </button>

  <nav class="navbar navbar-expand-lg shadow-sm sticky-top">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('img/unnamed-removebg-preview.png')); ?>" alt="Logo" width="40px" class="me-2">
            SAPATU-URANG
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home', ['category_id' => 1])); ?>">Men</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home', ['category_id' => 2])); ?>">Women</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home', ['category_id' => 3])); ?>">Kids</a></li>

            
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->is_admin == 1): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle admin-link text-danger" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user-shield me-1"></i> ADMIN
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm rounded-0">
                        <li><a class="dropdown-item small fw-bold" href="<?php echo e(route('admin.orders')); ?>">PESANAN MASUK</a></li>
                        <li><a class="dropdown-item small fw-bold" href="<?php echo e(route('admin.dashboard')); ?>">KELOLA KATALOG</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            <?php endif; ?>
          </ul>

          <div class="d-flex align-items-center gap-3">
            <?php if(auth()->guard()->guest()): ?>
              <a href="<?php echo e(route('login')); ?>" class="nav-link p-0" title="Login">
                <i class="fa-solid fa-user-lock me-1"></i> LOGIN
              </a>
            <?php else: ?>
              <a href="<?php echo e(route('order')); ?>" class="text-dark position-relative" title="My Orders"><i class="fa-solid fa-bag-shopping fs-5"></i></a>
              <a href="<?php echo e(route('cart')); ?>" class="text-dark position-relative" title="Shopping Cart"><i class="fa-solid fa-cart-shopping fs-5"></i></a>
              <a href="javascript:void(0)" class="text-danger ms-2" title="Logout" onclick="confirmLogout()"><i class="fa-solid fa-power-off fs-5"></i></a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline"><?php echo csrf_field(); ?></form>
            <?php endif; ?>
          </div>
        </div>
      </div>
  </nav>

  <main>
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <footer class="mt-5 py-5 bg-light border-top">
    <div class="container text-center">
      <div class="social-links mb-4">
        <a class="text-dark mx-3 fs-4" target="_blank" href="https://www.instagram.com/sapatu_urang.official"><i class="fa-brands fa-instagram"></i></a>
        <a class="text-dark mx-3 fs-4" target="_blank" href="https://www.tiktok.com/@USERNAME_TIKTOK_KAMU"><i class="fa-brands fa-tiktok"></i></a>
        <a class="text-dark mx-3 fs-4" target="_blank" href="https://wa.me/6285880816462"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
      <p class="small text-muted mb-0">© 2025 SAPATU-URANG OFFICIAL. ALL RIGHTS RESERVED.</p>
    </div>
  </footer>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
      // SweetAlert untuk session
      <?php if(session('success')): ?>
          Swal.fire({
              icon: 'success',
              title: 'SUCCESS',
              text: "<?php echo e(session('success')); ?>",
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true
          });
      <?php endif; ?>

      <?php if(session('error')): ?>
          Swal.fire({
              icon: 'error',
              title: 'ERROR',
              text: "<?php echo e(session('error')); ?>",
              confirmButtonText: 'CLOSE'
          });
      <?php endif; ?>

      // Logout dengan konfirmasi
      function confirmLogout() {
          Swal.fire({
              title: 'LOGOUT?',
              text: "Are you sure you want to leave?",
              icon: 'question',
              showCancelButton: true,
              confirmButtonText: 'YES, LOGOUT',
              cancelButtonText: 'CANCEL',
              confirmButtonColor: '#0a0a0a',
              reverseButtons: true
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('logout-form').submit();
              }
          });
      }

      // Scroll to top button
      const scrollBtn = document.getElementById("scrollToTopButton");
      window.onscroll = function() {
          if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
              scrollBtn.style.display = "block";
          } else {
              scrollBtn.style.display = "none";
          }
      };
      scrollBtn.onclick = function() {
          window.scrollTo({top: 0, behavior: 'smooth'});
      }

      // PWA Install button
      let deferredPrompt;
      const installBtn = document.getElementById('installAppBtn');

      window.addEventListener('beforeinstallprompt', (e) => {
          e.preventDefault();
          deferredPrompt = e;
          installBtn.style.display = 'block';
      });

      installBtn.addEventListener('click', async () => {
          installBtn.style.display = 'none';
          deferredPrompt.prompt();
          const { outcome } = await deferredPrompt.userChoice;
          deferredPrompt = null;
      });

      // Service Worker
      if ('serviceWorker' in navigator) {
          window.addEventListener('load', function() {
              navigator.serviceWorker.register('/service-worker.js')
              .then(registration => console.log('Service Worker registered with scope:', registration.scope))
              .catch(err => console.log('Service Worker registration failed:', err));
          });
      }
  </script>

</body>
</html>
<?php /**PATH C:\laragon\www\sepatuku\resources\views/layouts/user.blade.php ENDPATH**/ ?>