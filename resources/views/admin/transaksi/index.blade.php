@extends('layouts.admin')

@section('title', 'Kelola Transaksi')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Kelola Transaksi</h1>
    <form method="GET" class="row g-3 mb-3">
        <div class="col-auto">
            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
        </div>
        <div class="col-auto">
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-auto">
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="proses" {{ request('status')=='proses'?'selected':'' }}>Proses</option>
                <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                <option value="batal" {{ request('status')=='batal'?'selected':'' }}>Batal</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $order->user ? $order->user->name : '-' }}</td>
                            <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ route('admin.transaksi.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 