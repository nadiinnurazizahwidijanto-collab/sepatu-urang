@extends('layouts.user')

@section('content')
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
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 small">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="fw-bold">{{ $order->user->name }}</td>
                        <td class="text-success fw-bold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $order->payment_method }}</span></td>
                        <td>
                            @if($order->status == 'P')
                                <form action="{{ route('admin.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning fw-bold px-3 rounded-pill shadow-sm">
                                        PENDING
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-success py-2 px-3 rounded-pill">SELESAI</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-5 text-muted">Belum ada pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
