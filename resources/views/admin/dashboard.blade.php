@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Dashboard Admin</h1>
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
                    <h5 class="card-title">Produk Terjual</h5>
                    <p class="card-text fs-4">{{ $produkTerjual }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Stok Keluar/Masuk</h5>
                    <p class="card-text fs-4">{{ $stok }}</p>
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
                    <canvas id="productChart"></canvas>
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
        datasets: [{
            label: 'Stok Masuk',
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            borderColor: 'rgba(75, 192, 192, 1)',
            fill: false
        }, {
            label: 'Stok Keluar',
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            borderColor: 'rgba(255, 99, 132, 1)',
            fill: false
        }]
    }
});
</script>
@endsection 