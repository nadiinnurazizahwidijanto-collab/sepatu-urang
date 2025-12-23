@extends('layouts.user')
@section('content')
    <div class="container-fluid pt-5 p-0 min-vh-100 d-flex flex-column justify-content-center align-items-center bg-white">
        <div class="row w-100 container">
            <div class="col-12 col-lg-6 pt-3 pb-3 text-center">
                <img src="{{ asset('img/'.$product->image_path) }}" class="rounded-2 shadow-sm" width="300px" alt="">
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
                <div class="container">
                    <h1 class="mb-0">{{ $product->name }}</h1>
                    <h6>{{ $product->category->name }}'s Shoes</h6>
                    <h5>Rp{{ $product->price }}</h5>
                    <p style="text-align: justify;text-justify: inter-word;">{{ $product->description }}</p>
                    <form action="{{ route('cartStore') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
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

    {{-- Toast --}}
    @if ((session('success')) || (session('failed')))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast {{ (session('success')) ? 'bg-success' : 'bg-danger' }} text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <img src="{{ asset('img/unnamed-removebg-preview.png') }}" width="30px" class="rounded me-2" alt="logo">
                <strong class="me-auto">sepatu urang</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ (session('success')) ? session('success') : session('failed') }}
                </div>
            </div>
        </div>
    @endif

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
@endsection
