@extends('layouts.barista')

@section('title', 'Daftar Transaksi')

@section('content')
<h1 class="mb-4">Daftar Transaksi</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB</td>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                        <td><span class="badge bg-{{ $order->status == 'proses' ? 'info' : ($order->status == 'selesai' ? 'success' : 'warning') }}">{{ ucfirst($order->status) }}</span></td>
                        <td>
                            <span class="badge bg-{{ 
                                $order->status_pembayaran == 'paid' ? 'success' : 
                                ($order->status_pembayaran == 'pending' ? 'warning' : 'danger') 
                            }}">
                                {{ ucfirst($order->status_pembayaran) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('barista.transaksi.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 