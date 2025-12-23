@extends('layouts.user')
@section('content')
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
                      @foreach ($orders as $order)
                        <tr class="align-middle text-center">
                            <td><img src="{{ asset('img/unnamed-removebg-preview.png') }}" width="150px" alt="logo"></td>
                            <td>Rp{{ $order->total_price }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td><strong title="{{ ($order->delivery_status == 'P')? 'pending' : (($order->delivery_status == 'S')? 'success' : (($order->delivery_status == 'C')? 'cancel' : ''))}}" class="p-2 ps-3 pe-3 rounded-2 text-white {{ ($order->delivery_status == 'P')? 'bg-warning' : (($order->delivery_status == 'S')? 'bg-success' : (($order->delivery_status == 'C')? 'bg-danger' : ''))}}">{{ $order->delivery_status }}</strong></td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
