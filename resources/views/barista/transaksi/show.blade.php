@extends('layouts.barista')

@section('title', 'Detail Transaksi')

@section('content')
<h1 class="mb-4">Detail Transaksi #{{ $order->id }}</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <div class="row mb-3 align-items-center">
            <div class="col-md-6 mb-2 mb-md-0">
                <div class="mb-2"><strong>Pelanggan:</strong> {{ $order->user->name ?? '-' }}</div>
                <div class="mb-2"><strong>Email:</strong> {{ $order->user->email ?? '-' }}</div>
                <div class="mb-2"><strong>Bukti Pembayaran:</strong><br>
                    @if($order->bukti_pembayaran)
                        <div class="p-2 bg-light border rounded" style="max-width:220px;">
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width:200px; border-radius:8px;">
                        </div>
                    @else
                        <span class="text-danger">Belum ada</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="mb-2"><strong>Tanggal:</strong> {{ $order->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB</div>
                <div class="mb-2">
                    <strong>Status:</strong> <span class="badge bg-{{ $order->status == 'proses' ? 'info' : ($order->status == 'selesai' ? 'success' : 'warning') }} fs-6">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="mb-2">
                    <strong>Status Pembayaran:</strong> <span class="badge bg-{{ $order->status_pembayaran == 'paid' ? 'success' : 'warning' }} fs-6">{{ ucfirst($order->status_pembayaran) }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mb-3">
            @if($order->status_pembayaran !== 'paid')
                <form action="{{ route('barista.transaksi.verifikasi', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Verifikasi Pembayaran</button>
                </form>
            @endif
            <a href="{{ route('barista.transaksi.cetak_struk', $order->id) }}" class="btn btn-secondary" target="_blank">Cetak Struk</a>
            <a href="{{ route('barista.transaksi.index') }}" class="btn btn-outline-primary">Kembali</a>
        </div>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Item Produk</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
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
        <div class="text-end mt-2">
            <span class="fw-bold fs-5">Total: Rp {{ number_format($order->total,0,',','.') }}</span>
        </div>
    </div>
</div>
@endsection 