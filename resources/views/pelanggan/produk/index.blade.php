@extends('layouts.pelanggan')

@section('title', 'Daftar Produk')

@section('content')
<h1 class="page-title">Daftar Produk</h1>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<form action="{{ route('pelanggan.produk.index') }}" method="GET" class="mb-4">
    <div class="row g-2">
        <div class="col-md-8">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari produk...">
        </div>
        <div class="col-md-3">
            <select name="category_id" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <a href="{{ route('pelanggan.produk.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </div>
</form>
<div class="row">
    @foreach($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            @if($product->foto)
                <img src="{{ asset('storage/' . $product->foto) }}" class="card-img-top" alt="{{ $product->nama }}" style="object-fit:cover; height:220px; border-top-left-radius:15px; border-top-right-radius:15px;">
            @else
                <div class="d-flex align-items-center justify-content-center bg-light" style="height:220px; border-top-left-radius:15px; border-top-right-radius:15px; color:#aaa; font-size:2rem;">
                    <i class="bi bi-image"></i>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->nama }}</h5>
                <p class="card-text mb-1"><strong>Kategori:</strong> {{ $product->category ? $product->category->nama : '-' }}</p>
                @if(isset($promo) && $promo)
                    @php
                        $hargaDiskon = $product->harga - ($product->harga * $promo->diskon / 100);
                    @endphp
                    <span class="badge bg-success mb-2">Promo {{ $promo->diskon }}%!</span><br>
                    <span class="text-muted text-decoration-line-through">Rp {{ number_format($product->harga,0,',','.') }}</span>
                    <span class="fw-bold text-danger fs-5 ms-2">Rp {{ number_format($hargaDiskon,0,',','.') }}</span>
                @else
                    <span class="fw-bold">Rp {{ number_format($product->harga,0,',','.') }}</span>
                @endif
                <p class="card-text mb-1"><strong>Stok:</strong> {{ $product->stok }}</p>
                <p class="card-text">{{ $product->deskripsi }}</p>
                @if($product->stok > 0)
                <form action="{{ route('pelanggan.produk.order') }}" method="POST" class="d-flex align-items-center gap-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="col-auto">
                        <select name="tipe_pesanan" id="tipe_pesanan" class="form-select form-select-sm" required>
                            <option value="" disabled selected>Pilih Tipe Pesanan</option>
                            <option value="dikirim">Dikirim</option>
                            <option value="makan_di_tempat">Makan di Tempat</option>
                        </select>
                    </div>
                    <input type="number" name="qty" value="1" min="1" max="{{ $product->stok }}" class="form-control form-control-sm" style="width: 70px;">
                    <button type="submit" class="btn btn-sm btn-primary">Pesan</button>
                </form>
                @else
                <span class="badge bg-danger">Stok Habis</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection 