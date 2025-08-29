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
            <div class="col-md-4">
                <h5>Informasi Pesanan</h5>
                <p><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
                <p><strong>Status:</strong> <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'info') }}">{{ ucfirst($order->status) }}</span></p>
                <p><strong>Tipe Pesanan: {{  \Illuminate\Support\Str::headline($order->tipe_pesanan) }}</strong></p>
                <p><strong>Metode Pembayaran: {{  \Illuminate\Support\Str::headline($order->metode_pembayaran) }}</strong></p>
            </div>
            <div class="col-md-4">
                <h5>Informasi Pelanggan</h5>
                <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                <p><strong>Alamat:</strong> {{ $order->user->alamat }}</p>
                <p><strong>No. Telepon:</strong> {{ $order->user->no_telp }}</p>
            </div>
            <div class="col-md-4">
                <h5>Total Pembayaran</h5>
                <h3 class="text-primary">Rp {{ number_format($order->total,0,',','.') }} 
                    <span style="font-size: 14px;" class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status_pembayaran == 'completed' ? 'success' : 'info') }}">{{ ucfirst($order->status_pembayaran) }}
                </span>
                </h3>
                @if ($order->status === 'selesai')
                    @if ($order->ulasan)
                        <div class="mt-3">
                            <h5>Ulasan Anda</h5>
                            <div class="mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if($i <= $order->ulasan->rating)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-muted"></i>
                                    @endif
                                @endfor
                                 <p class="mb-1 fst-italic">"{{ $order->ulasan->review }}"</p>
                            </div>
                            
                        </div>
                    @else
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#reviewModal">
                            Beri Ulasan
                        </button>
                    @endif
                @endif
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
            
            @if ($order->status_pembayaran === 'pending')
                <button class="btn btn-primary me-2" disabled>Menunggu Konfirmasi</button>
            @endif

            <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-outline-primary">Kembali ke Daftar Pesanan</a>
        </div>
    </div>
</div>
<!-- Modal Ulasan -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('pelanggan.ulasan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Beri Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <label class="form-label">Rating</label>
                        <div id="starRating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill star" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" required>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Ulasan</label>
                        <textarea class="form-control" name="review" id="review" rows="3" placeholder="Tulis ulasan Anda..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection 
