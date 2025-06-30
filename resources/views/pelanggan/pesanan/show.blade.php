@extends('layouts.pelanggan')

@section('title', 'Detail Pesanan')

@section('content')
<h1 class="page-title">Detail Pesanan</h1>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Informasi Pesanan</h5>
                <p><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
                <p><strong>Status:</strong> <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'info') }}">{{ ucfirst($order->status) }}</span></p>
            </div>
            <div class="col-md-6">
                <h5>Total Pembayaran</h5>
                <h3 class="text-primary">Rp {{ number_format($order->total,0,',','.') }}</h3>
            </div>
        </div>
        
        <h5>Detail Item</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product->nama }}</td>
                        <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="text-end">
            @if($order->status_pembayaran === 'pending')
                <a href="{{ route('pelanggan.pesanan.bayar.form', $order->id) }}" class="btn btn-primary me-2">Bayar</a>
            @endif
            <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-outline-primary">Kembali ke Daftar Pesanan</a>
        </div>
    </div>
</div>
@endsection 