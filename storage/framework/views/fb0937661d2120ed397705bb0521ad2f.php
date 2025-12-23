<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyShoes - 404</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    
    <link rel="icon" href="<?php echo e(asset('img/men5.png')); ?>" type="image/png">

    
    <style>
      .scale-in{
        transition: transform 0.5s ease;
      }
      .scale-in:hover{
        transform: scale(1.2);
      }
    </style>
</head>
<body class="text-white" style="background: #1a202c;">
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="mb-0" style="font-size: 100px;"><i class="bi bi-emoji-frown-fill"></i></h1>
        <h1>Oops!</h1>
        <h5>404 - PAGE NOT FOUND</h5>
        <p class="col-12 col-lg-6 text-center">The page you are looking for might have been removed had its name changed or is temporarily unavailable</p>
        <a href="<?php echo e(url('')); ?>" class="btn btn-outline-light scale-in">GO TO HOME PAGE</a>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\sepatuku\resources\views/errors/404page.blade.php ENDPATH**/ ?>