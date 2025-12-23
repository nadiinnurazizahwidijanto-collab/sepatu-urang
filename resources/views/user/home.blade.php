@extends('layouts.user')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,400;1,400&family=Inter:wght@200;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<style>
    :root {
        --gold: #4d3815ff;
        --deep-black: #0a0a0a;
        --soft-white: #ffffff;
        --luxury-gray: #f2f2f2;
    }

    body {
        background-color: var(--soft-white);
        font-family: 'Inter', sans-serif;
        color: var(--deep-black);
        overflow-x: hidden;
    }

    /* --- Preloader --- */
    #loader {
        position: fixed;
        width: 100%; height: 100vh;
        background: #fff; z-index: 9999;
        display: flex; align-items: center; justify-content: center;
        transition: opacity 1s ease;
    }

    .loader-text {
        font-family: 'Bodoni Moda', serif;
        font-size: 1.5rem;
        letter-spacing: 10px;
        text-transform: uppercase;
        animation: pulse 2s infinite;
    }

    @keyframes pulse { 0%, 100% { opacity: 0.2; } 50% { opacity: 1; } }

    /* --- Hero Section --- */
    .hero-wrapper {
        height: 100vh;
        display: flex;
        align-items: center;
        background: #fff;
        padding: 0 5%;
    }

    .hero-content { z-index: 2; }

    .hero-title {
        font-family: 'Bodoni Moda', serif;
        font-size: clamp(4rem, 12vw, 8rem);
        line-height: 0.8;
        font-weight: 700;
        letter-spacing: -4px;
        margin-bottom: 2rem;
    }

    .hero-title span {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-weight: 400;
        font-size: 0.6em;
        display: block;
        color: var(--gold);
        letter-spacing: 0;
    }

    .hero-image-box {
        position: relative;
        text-align: right;
    }

    .floating-main {
        width: 100%;
        max-width: 650px;
        filter: drop-shadow(0 50px 80px rgba(0,0,0,0.12));
        animation: luxFloat 8s ease-in-out infinite;
    }

    @keyframes luxFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(3deg); }
    }

    /* --- Luxury Buttons --- */
    .lux-btn {
        text-decoration: none;
        color: var(--deep-black);
        font-size: 0.75rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        padding: 18px 45px;
        border: 1px solid #d1d1d1;
        transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        display: inline-block;
        background: transparent;
    }

    .lux-btn:hover {
        background: var(--deep-black);
        color: #fff;
        border-color: var(--deep-black);
        letter-spacing: 6px;
    }

    /* --- Product Grid --- */
    .product-container { padding: 120px 0; }

    .product-card {
        border: none;
        margin-bottom: 60px;
        transition: 0.6s;
    }

    .product-img-wrapper {
        background: var(--luxury-gray);
        aspect-ratio: 1/1.3;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
    }

    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 1.5s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .product-card:hover img {
        transform: scale(1.1);
    }

    .prod-meta {
        font-size: 0.65rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .prod-name {
        font-family: 'Bodoni Moda', serif;
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .prod-price {
        font-weight: 200;
        font-size: 0.95rem;
        letter-spacing: 1px;
    }

    /* --- Floating Cart --- */
    .floating-cart {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }

    .cart-box {
        width: 60px;
        height: 60px;
        background: var(--deep-black);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        transition: 0.3s;
    }

    .cart-box:hover {
        transform: translateY(-5px);
        color: var(--gold);
    }

    .cart-box .badge {
        position: absolute;
        top: 0;
        right: 0;
        background: var(--gold);
        color: white;
        border: 2px solid white;
        font-size: 0.7rem;
        padding: 0.4em 0.65em;
    }

    /* Scroll Indicator */
    .scroll-down {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.6rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        opacity: 0.4;
    }
</style>

<div id="loader">
    <div class="loader-text">Sapatu Urang</div>
</div>

{{-- Floating Cart Icon --}}
@auth
    @php
        $badgeCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
    @endphp
    @if($badgeCount > 0)
    <div class="floating-cart" data-aos="fade-left" data-aos-offset="0">
        <a href="{{ route('cart') }}" class="cart-box position-relative">
            <i class="fa-solid fa-cart-shopping fs-5"></i>
            <span class="badge rounded-pill translate-middle-y">
                {{ $badgeCount }}
            </span>
        </a>
    </div>
    @endif
@endauth

{{-- Hero Section --}}
<section class="hero-wrapper">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-5 hero-content" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title">
                    <span>The Art of</span>
                    Sapatu Urang
                </h1>
                <p class="mb-5 text-muted" style="max-width: 400px; line-height: 2; font-weight: 300; text-align: justify;">
                Menawarkan produk terbaik untuk fashion, didesain dengan penuh makna
                atas kekentalan budaya lokal daerah di Indonesia dengan bahan kayu
                premium serta awet dan tahan lama.
            </p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="#products" class="lux-btn me-2">Shop Now</a>
                    <a href="#products" class="btn btn-outline-dark px-3 py-2">Men <i class="fa-solid fa-circle-right ms-1"></i></a>
                    <a href="#products" class="btn btn-outline-dark px-3 py-2">Women <i class="fa-solid fa-circle-right ms-1"></i></a>
                    <a href="#products" class="btn btn-outline-dark px-3 py-2">Kids <i class="fa-solid fa-circle-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-lg-7 hero-image-box">
                <img src="{{ asset('img/sendalsepatu_tradisional.png') }}" class="floating-main" alt="Iconic Piece" data-aos="zoom-in" data-aos-duration="2000">
            </div>
        </div>
    </div>
    <div class="scroll-down">Explore Our Collections</div>
</section>

{{-- Product Section --}}
<section class="product-container" id="products">
    <div class="container">
        <div class="row mb-5 pb-5">
            <div class="col-12 text-center" data-aos="fade-up">
                <h2 style="font-family: 'Bodoni Moda', serif; font-size: 3rem;">Seasonal Selection</h2>
                <div style="width: 40px; height: 1px; background: #000; margin: 20px auto;"></div>
            </div>
        </div>

        <div class="row g-5">
            @foreach ($products as $product)
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <a href="{{ url('detail/'.$product->id) }}" class="text-decoration-none text-dark product-card d-block">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('img/'.$product->image_path) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="text-center">
                        <div class="prod-meta">{{ $product->category->name }}</div>
                        <h3 class="prod-name">{{ $product->name }}</h3>
                        <p class="prod-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="py-5 border-top bg-white">
    <div class="container text-center">
        <h4 style="font-family: 'Bodoni Moda', serif; letter-spacing: 5px;" class="mb-4">SAPATU URANG</h4>
        <p class="text-muted mb-0" style="font-size: 0.6rem; letter-spacing: 3px;">&copy; 2024 COLLECTION. CRAFTED IN INDONESIA.</p>
    </div>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    // Initialize Animations
    AOS.init({ once: true });

    // Hide Loader
    window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.display = 'none'; }, 1000);
        }, 1500);
    });
</script>

@endsection
