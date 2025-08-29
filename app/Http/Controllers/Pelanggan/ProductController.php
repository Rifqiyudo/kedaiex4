<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Promo;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filtering kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search nama produk
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        // Cari promo aktif
        $today = date('Y-m-d');
        $promo = Promo::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_berakhir', '>=', $today)
            ->orderByDesc('diskon')
            ->first();

        $categories = Category::all();
        

        return view('pelanggan.produk.index', compact('products', 'promo', 'categories'));
    }

    // public function order(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'tipe_pesanan' => 'required|in:dikirim,makan_di_tempat',
    //         'qty' => 'required|integer|min:1',
    //     ]);
    //     $user = session('user');
    //     $product = Product::findOrFail($request->product_id);
    //     $today = date('Y-m-d');
    //     $promo = \App\Models\Promo::where('status', 'aktif')
    //         ->where('tanggal_mulai', '<=', $today)
    //         ->where('tanggal_berakhir', '>=', $today)
    //         ->orderByDesc('diskon')
    //         ->first();
    //     $harga = $product->harga;
    //     if ($promo) {
    //         $harga = $harga - ($harga * $promo->diskon / 100);
    //     }
    //     $total = $harga * $request->qty;
    //     $order = Order::create([
    //         'user_id' => $user->id,        
    //         'tipe_pesanan' => $request->tipe_pesanan,
    //         'total' => $total,
    //         'status' => 'pending',
    //         'status_pembayaran' => 'belum dibayar',
    //     ]);
    //     OrderItem::create([
    //         'order_id' => $order->id,
    //         'product_id' => $product->id,
    //         'qty' => $request->qty,
    //         'harga' => $harga,
    //         'subtotal' => $total,
    //     ]);
    //     $product->stok -= $request->qty;
    //     $product->save();
    //     $product->stockHistories()->create([
    //         'product_id' => $product->id,
    //         'jumlah' => -$request->qty, 
    //         'tipe' => 'keluar', 
    //     ]);
    //     return redirect()->route('pelanggan.pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    // }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $user = session('user');
        $product = Product::findOrFail($request->product_id);

        // cek apakah sudah ada produk ini di cart
        $cartItem = \App\Models\Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('status', 'Belum Checkout')
            ->first();

        if ($cartItem) {
            $cartItem->qty += $request->qty;
            $cartItem->save();
        } else {
            \App\Models\Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'status' => 'Belum Checkout',
            ]);
        }

        return redirect()->route('pelanggan.produk.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

}
