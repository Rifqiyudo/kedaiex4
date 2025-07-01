@extends('layouts.pelanggan')

@section('title', 'Riwayat Pesanan')

@section('content')
<h1 class="page-title">Riwayat Pesanan Saya</h1>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status Pesanan</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <span class="text-{{ 
                                $order->status_pembayaran == 'belum dibayar' ? 'danger' : 
                                ($order->status_pembayaran == 'pending' ? 'warning' : 'success') 
                            }}">
                                {{ ucfirst($order->status_pembayaran) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('pelanggan.pesanan.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 