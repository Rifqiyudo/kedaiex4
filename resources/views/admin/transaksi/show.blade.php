@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Detail Transaksi #{{ $order->id }}</h1>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Pelanggan:</strong> {{ $order->user ? $order->user->name : '-' }}<br>
                    <strong>Email:</strong> {{ $order->user ? $order->user->email : '-' }}<br>
                    <strong>Telepon:</strong> {{ $order->user ? $order->user->no_telp : '-' }}<br>
                    <strong>Alamat:</strong> {{ $order->user ? $order->user->alamat : '-' }}<br>
                    <strong>Tipe Pesanan: {{  \Illuminate\Support\Str::headline($order->tipe_pesanan) }}</strong><br>

                </div>
                <div class="col-md-6">
                    <strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y H:i') }}<br>
                    <strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                    @if($order->status === 'selesai' && $order->ulasan)
                    
                        <div class="mb-2">
                            <strong>Rating:</strong>
                            @for ($i = 1; $i <= 5; $i++)
                                @if($i <= $order->ulasan->rating)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @else
                                    <i class="bi bi-star text-muted"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="mb-2">
                            <strong>Ulasan:</strong>
                            <div class="fst-italic">"{{ $order->ulasan->review }}"</div>
                        </div>
                    @endif
                </div>
            </div>
            <form action="{{ route('admin.transaksi.updateStatus', $order->id) }}" method="POST" class="mb-3">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="status" class="col-form-label">Ubah Status:</label>
                    </div>
                    <div class="col-auto">
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="proses" {{ $order->status=='proses'?'selected':'' }}>Proses</option>
                            <option value="selesai" {{ $order->status=='selesai'?'selected':'' }}>Selesai</option>
                            <option value="batal" {{ $order->status=='batal'?'selected':'' }}>Batal</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5>Item Produk</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product ? $item->product->nama : '-' }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                            <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                <strong>Total: Rp {{ number_format($order->total,0,',','.') }}</strong>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <strong>Bukti Pembayaran:</strong><br>
        @if($order->bukti_pembayaran)
            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width:300px; border-radius:8px;">
        @else
            <span class="text-danger">Belum ada</span>
        @endif
    </div>
</div>
@endsection 