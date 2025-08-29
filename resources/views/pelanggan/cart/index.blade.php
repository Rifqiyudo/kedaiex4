@extends('layouts.pelanggan')

@section('title', 'Keranjang Saya')

@section('content')
<h1 class="page-title">Keranjang Saya</h1>
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
        <form action="{{ route('pelanggan.cart.checkout') }}" method="POST" id="cartForm">
            @csrf
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carts as $cart)
                        @php
                            $harga = $cart->product->harga;
                            if(isset($promo) && $promo){
                                $hargaDiskon = $harga - ($harga * $promo->diskon / 100);
                            } else {
                                $hargaDiskon = $harga;
                            }
                            $subtotal = $hargaDiskon * $cart->qty;
                        @endphp
                        <tr>
                            <td>
                                <input type="checkbox" 
                                    name="cart_ids[]" 
                                    value="{{ $cart->id }}" 
                                    class="cart-check" 
                                    data-subtotal="{{ $subtotal }}">
                            </td>
                            <td>{{ $cart->product->nama }}</td>
                            <td>
                                @if(isset($promo) && $promo)
                                    <span class="text-muted text-decoration-line-through">
                                        Rp {{ number_format($harga,0,',','.') }}
                                    </span><br>
                                    <span class="text-danger fw-bold">
                                        Rp {{ number_format($hargaDiskon,0,',','.') }}
                                    </span>
                                @else
                                    Rp {{ number_format($harga,0,',','.') }}
                                @endif
                            </td>
                            <td>
                                <input type="number" value="{{ $cart->qty }}" class="form-control form-control-sm" style="width:70px;" readonly>
                            </td>
                            <td>Rp {{ number_format($subtotal,0,',','.') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="if(confirm('Hapus produk ini dari keranjang?')) document.getElementById('delete-form-{{ $cart->id }}').submit();">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Keranjang masih kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($carts->count() > 0)
                <div class="d-flex justify-content-between align-items-center mt-3 float-end mb-5">
                    <h5 class="mb-0"><b>Total: <span id="totalHarga">Rp 0</span></b></h5>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100">Checkout</button>
                </div>
            @endif
        </form>

        {{-- form hapus dipisah dari checkout --}}
        @foreach($carts as $cart)
            <form id="delete-form-{{ $cart->id }}" action="{{ route('pelanggan.cart.destroy', $cart->id) }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach

    </div>
</div>

{{-- Javascript untuk check all + total harga --}}
<script>
    const checkAll = document.getElementById('checkAll');
    const cartChecks = document.querySelectorAll('.cart-check');
    const totalHarga = document.getElementById('totalHarga');

    function updateTotal() {
        let total = 0;
        cartChecks.forEach(cb => {
            if (cb.checked) {
                total += parseInt(cb.dataset.subtotal);
            }
        });
        totalHarga.textContent = "Rp " + total.toLocaleString('id-ID');
    }

    checkAll?.addEventListener('change', function(){
        cartChecks.forEach(cb => cb.checked = this.checked);
        updateTotal();
    });

    cartChecks.forEach(cb => cb.addEventListener('change', updateTotal));
</script>
@endsection
