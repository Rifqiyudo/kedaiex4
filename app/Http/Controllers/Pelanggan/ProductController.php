<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Promo;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        // Cari promo aktif (status aktif, tanggal berlaku)
        $today = date('Y-m-d');
        $promo = Promo::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->orderByDesc('diskon')
            ->first();
        return view('pelanggan.produk.index', compact('products', 'promo'));
    }

    public function order(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);
        $user = session('user');
        $product = Product::findOrFail($request->product_id);
        // Cek promo aktif
        $today = date('Y-m-d');
        $promo = \App\Models\Promo::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->orderByDesc('diskon')
            ->first();
        $harga = $product->harga;
        if ($promo) {
            $harga = $harga - ($harga * $promo->diskon / 100);
        }
        $total = $harga * $request->qty;
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
            'status_pembayaran' => 'pending',
        ]);
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'qty' => $request->qty,
            'harga' => $harga,
            'subtotal' => $total,
        ]);
        // Kurangi stok produk
        $product->stok -= $request->qty;
        $product->save();
        return redirect()->route('pelanggan.pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
