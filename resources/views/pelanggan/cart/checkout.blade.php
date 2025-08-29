@extends('layouts.pelanggan')

@section('title', 'Checkout')

@section('content')
<h1 class="page-title">Checkout</h1>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('pelanggan.checkout.store') }}" method="POST">
            @csrf

            {{-- kirimkan list cart_ids yang dipilih --}}
            @foreach($cartIds as $id)
                <input type="hidden" name="cart_ids[]" value="{{ $id }}">
            @endforeach
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informasi Pelanggan</h5>
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
                    <p><strong>No. Telepon:</strong> {{ $user->no_telp ?? '-' }}</p>
                </div>

                <div class="col-md-6">
                    <h5>Ringkasan Pesanan</h5>
                    <h3 class="text-primary">Rp {{ number_format($total,0,',','.') }}</h3>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Tipe Pesanan</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipe_pesanan" id="dineIn" value="makan_di_tempat" required>
                        <label class="form-check-label" for="dineIn">Makan di Tempat</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipe_pesanan" id="delivery" value="diantar" required>
                        <label class="form-check-label" for="delivery">Diantar</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>Metode Pembayaran</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" id="transfer" value="Transfer Bank" required>
                        <label class="form-check-label" for="transfer">Transfer Bank</label>
                    </div>
                    <div class="form-check" id="kasirWrapper">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" id="kasir" value="Bayar di Kasir" required>
                        <label class="form-check-label" for="kasir">Bayar di Kasir</label>
                    </div>
                </div>
                
            </div>

            <h5>Detail Item</h5>
            <div class="table-responsive mb-4">
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
                        @foreach($carts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->nama }}</td>
                            <td>
                                Rp {{ number_format($item->final_price,0,',','.') }}
                                @if($promo && $item->final_price < $item->product->harga)
                                    <br><small class="text-danger"><s>Rp {{ number_format($item->product->harga,0,',','.') }}</s></small>
                                @endif
                            </td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('pelanggan.cart.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" id="btnCheckout" class="btn btn-primary">Checkout Pesanan</button>
            </div>
        </form>
    </div>
</div>

{{-- Javascript untuk disable bayar di kasir kalau pilih "Diantar" --}}
<script>
    const dineIn = document.getElementById('dineIn');
    const delivery = document.getElementById('delivery');
    const kasirWrapper = document.getElementById('kasirWrapper');
    const kasirRadio = document.getElementById('kasir');

    function updateMetodePembayaran() {
        if (delivery.checked) {
            // kalau pilih diantar → sembunyikan bayar di kasir
            kasirWrapper.style.display = 'none';
            kasirRadio.checked = false; // pastikan tidak terpilih
        } else {
            // kalau pilih makan di tempat → tampilkan bayar di kasir
            kasirWrapper.style.display = 'block';
        }
    }

    dineIn?.addEventListener('change', updateMetodePembayaran);
    delivery?.addEventListener('change', updateMetodePembayaran);
</script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-N16T_C34nKcSAqJe"></script>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    fetch("{{ route('pelanggan.checkout.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.snap_token) {
            snap.pay(data.snap_token, {
                onSuccess: function(result){ window.location.href = data.redirect_url; },
                onPending: function(result){ window.location.href = data.redirect_url; },
                onError: function(result){ alert("Pembayaran gagal!"); },
                onClose: function(){ console.log("popup closed"); }
            });
        } else {
            window.location.href = data.redirect_url;
        }
    })
    .catch(err => console.error(err));
});

</script>

@endsection
