@extends('layouts.user')

@section('content')
<div class="container py-5" style="margin-top: 50px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="font-family: 'Bodoni Moda', serif;">👟 Kelola Katalog Sepatu</h2>
        <button type="button" class="btn btn-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fa-solid fa-plus me-2"></i>Tambah Produk
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($products as $p)
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <img src="{{ asset('img/'.$p->image_path) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-1">{{ $p->name }}</h6>
                    <p class="text-success fw-bold small mb-3">Rp{{ number_format($p->price, 0, ',', '.') }}</p>
                    <p class="small text-muted mb-2">Kategori:
                        @if($p->category_id == 1) Men
                        @elseif($p->category_id == 2) Women
                        @elseif($p->category_id == 3) Kids
                        @else Lainnya
                        @endif
                    </p>

                    <form action="{{ route('admin.deleteProduct', $p->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill" onclick="return confirm('Hapus produk ini?')">
                            <i class="fa-solid fa-trash-can me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow">
            @csrf
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nama Sepatu</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Nike Air Jordan" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Harga (Angka Saja)</label>
                    <input type="number" name="price" class="form-control" placeholder="Contoh: 1500000" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Kategori</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="1">Men</option>
                        <option value="2">Women</option>
                        <option value="3">Kids</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Deskripsi Produk</label>
                    <textarea name="description" class="form-control" placeholder="Deskripsikan sepatu ini..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Foto Produk</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-dark px-4">Simpan Ke Katalog</button>
            </div>
        </form>
    </div>
</div>

@endsection
