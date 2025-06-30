@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Laporan Penjualan</h1>
    <form method="GET" class="row g-3 mb-3">
        <div class="col-auto">
            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}" required>
        </div>
        <div class="col-auto">
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Reset</a>
        </div>
        <div class="col-auto ms-auto">
            <a href="{{ route('admin.laporan.export', ['tanggal_awal'=>request('tanggal_awal'), 'tanggal_akhir'=>request('tanggal_akhir')]) }}" class="btn btn-success">Ekspor Excel</a>
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
                            <th>Detail</th>
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
                                <a href="{{ route('admin.laporan.index', ['show' => $order->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $order->id }}">Detail</a>
                                <!-- Modal Detail -->
                                <div class="modal fade" id="modalDetail{{ $order->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $order->id }}" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="modalDetailLabel{{ $order->id }}">Detail Order #{{ $order->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
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
                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data penjualan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 