@extends('layouts.pelanggan')

@section('title', 'Pembayaran Pesanan')

@section('content')
<h1 class="page-title">Pembayaran Pesanan #{{ $order->id }}</h1>
<div class="card mb-4">
    <div class="card-body">
        <h5>Total Tagihan: <span class="text-primary">Rp {{ number_format($order->total,0,',','.') }}</span></h5>
        <form action="{{ route('pelanggan.pesanan.bayar.proses', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Pilih Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required onchange="showFormPembayaran()">
                    <option value="">-- Pilih --</option>
                    <option value="qris" {{ old('metode_pembayaran')=='qris'?'selected':'' }}>QRIS</option>
                    <option value="kredit" {{ old('metode_pembayaran')=='kredit'?'selected':'' }}>Kartu Kredit</option>
                    <option value="tunai" {{ old('metode_pembayaran')=='tunai'?'selected':'' }}>Tunai di Kasir</option>
                </select>
            </div>
            <div id="form-qris" style="display:none;">
                <div class="mb-3">
                    <label class="form-label">Scan QRIS untuk pembayaran</label><br>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=KedaiExFlour-Order-{{ $order->id }}" alt="QRIS" class="mb-2" style="border-radius:12px;">
                </div>
                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">
                </div>
            </div>
            <div id="form-kredit" style="display:none;">
                <div class="mb-3">
                    <label for="kartu_nama" class="form-label">Nama di Kartu</label>
                    <input type="text" name="kartu_nama" id="kartu_nama" class="form-control" value="{{ old('kartu_nama') }}">
                </div>
                <div class="mb-3">
                    <label for="kartu_nomor" class="form-label">Nomor Kartu</label>
                    <input type="text" name="kartu_nomor" id="kartu_nomor" class="form-control" value="{{ old('kartu_nomor') }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kartu_exp" class="form-label">Masa Berlaku (MM/YY)</label>
                        <input type="text" name="kartu_exp" id="kartu_exp" class="form-control" value="{{ old('kartu_exp') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kartu_cvv" class="form-label">CVV</label>
                        <input type="text" name="kartu_cvv" id="kartu_cvv" class="form-control" value="{{ old('kartu_cvv') }}">
                    </div>
                </div>
                <div class="alert alert-info">Simulasi pembayaran, data tidak disimpan.</div>
            </div>
            <div id="form-tunai" style="display:none;">
                <div class="alert alert-warning">Silakan lakukan pembayaran tunai di kasir. Pesanan Anda akan diproses setelah pembayaran diterima.</div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Konfirmasi Pembayaran</button>
            <a href="{{ route('pelanggan.pesanan.show', $order->id) }}" class="btn btn-outline-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>
<script>
function showFormPembayaran() {
    var metode = document.getElementById('metode_pembayaran').value;
    document.getElementById('form-qris').style.display = metode === 'qris' ? 'block' : 'none';
    document.getElementById('form-kredit').style.display = metode === 'kredit' ? 'block' : 'none';
    document.getElementById('form-tunai').style.display = metode === 'tunai' ? 'block' : 'none';
}
document.addEventListener('DOMContentLoaded', showFormPembayaran);
</script>
@endsection 