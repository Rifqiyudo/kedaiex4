<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $user = session('user');
        $carts = Cart::with('product')->where('user_id', $user->id)->where('status', 'Belum Checkout')->get();
        $today = date('Y-m-d');
        $promo = Promo::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->orderByDesc('diskon')
            ->first();

        $total = 0;
        foreach ($carts as $item) {
            $harga = $item->product->harga;
            if ($promo) {
                $harga -= ($harga * $promo->diskon / 100);
            }
            $item->final_price = $harga; // tambahkan properti supaya bisa dipakai di Blade
            $total += $harga * $item->qty;
        }
        return view('pelanggan.cart.index', compact('carts', 'total', 'promo'));
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkoutPage(Request $request)
    {
        $user = session('user');

        $cartIds = $request->cart_ids ?? [];
        if (empty($cartIds)) {
            return back()->with('error', 'Pilih minimal 1 produk untuk checkout!');
        }

        $carts = Cart::with('product')
            ->whereIn('id', $cartIds)
            ->where('user_id', $user->id)
            ->where('status', 'Belum Checkout')
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong atau sudah di-checkout!');
        }

        // cek promo aktif
        $today = date('Y-m-d');
        $promo = Promo::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->orderByDesc('diskon')
            ->first();

        $total = 0;
        foreach ($carts as $item) {
            $harga = $item->product->harga;
            if ($promo) {
                $harga -= ($harga * $promo->diskon / 100);
            }
            $total += $harga * $item->qty;

            // simpan harga setelah diskon biar gampang dipanggil di blade
            $item->final_price = $harga;
            $item->subtotal = $harga * $item->qty;
        }

        return view('pelanggan.cart.checkout', compact('carts', 'total', 'user', 'cartIds', 'promo'));
    }



}
