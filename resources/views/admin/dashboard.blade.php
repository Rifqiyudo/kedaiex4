@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Dashboard Admin</h1>
    <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
            <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control"
                value="{{ request('tanggal_awal') }}">
        </div>
        <div class="col-md-4">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filter
            </button>
        </div>
    </form>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Penghasilan</h5>
                    <p class="card-text fs-4">Rp {{ number_format($totalPenghasilan,0,',','.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Produk Terjual</h5>
                    <p class="card-text fs-4">{{ $cardStokKeluar }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Produk Masuk</h5>
                    <p class="card-text fs-4">{{ $cardStokMasuk }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Total Penghasilan per Bulan</div>
                <div class="card-body">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Produk Terjual per Kategori</div>
                <div class="card-body">
                    <canvas id="productChart" style="width: 250px !important; height: 250px !important;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">Riwayat Stok Keluar/Masuk</div>
                <div class="card-body">
                    <canvas id="stockChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">Riwayat Transaksi</div>
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data dari controller
const penghasilanPerBulan = @json($penghasilanPerBulan);
const produkPerKategori = @json($produkPerKategori);

// Bulan dalam bahasa Indonesia
const bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
const incomeLabels = Object.keys(penghasilanPerBulan).map(b => bulanLabels[parseInt(b)-1]);
const incomeData = Object.values(penghasilanPerBulan);

const ctxIncome = document.getElementById('incomeChart').getContext('2d');
new Chart(ctxIncome, {
    type: 'bar',
    data: {
        labels: incomeLabels,
        datasets: [{
            label: 'Penghasilan',
            data: incomeData,
            backgroundColor: 'rgba(54, 162, 235, 0.5)'
        }]
    }
});

const productLabels = Object.keys(produkPerKategori);
const productData = Object.values(produkPerKategori);
const ctxProduct = document.getElementById('productChart').getContext('2d');
new Chart(ctxProduct, {
    type: 'pie',
    data: {
        labels: productLabels,
        datasets: [{
            data: productData,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ]
        }]
    }
});

    // Stok keluar/masuk: placeholder (bisa diisi data real jika ada)
   

    const ctxStock = document.getElementById('stockChart').getContext('2d');
    new Chart(ctxStock, {
        type: 'line',
        data: {
            labels: bulanLabels,
            datasets: [
                {
                    label: 'Stok Masuk',
                    data: {!! json_encode($stokMasuk) !!},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                },
                {
                    label: 'Stok Keluar',
                    data: {!! json_encode($stokKeluar) !!},
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                }
            ]
        }
    });
</script>
@endsection 