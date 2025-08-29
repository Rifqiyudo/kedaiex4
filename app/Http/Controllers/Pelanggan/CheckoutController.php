<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promo;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $user = session('user');

        $cartIds = $request->cart_ids ?? [];
        if (empty($cartIds)) {
            return response()->json([
                'error' => 'Tidak ada item dipilih!'
            ], 400);
        }

        $carts = Cart::with('product')
            ->whereIn('id', $cartIds)
            ->where('user_id', $user->id)
            ->where('status', 'Belum Checkout')
            ->get();

        if ($carts->isEmpty()) {
            return response()->json([
                'error' => 'Keranjang kosong atau sudah diproses!'
            ], 400);
        }

        // cek promo
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
        }

        // buat order
        $order = Order::create([
            'user_id' => $user->id,
            'tipe_pesanan' => $request->tipe_pesanan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total' => $total,
            'status' => 'pending',
            'status_pembayaran' => $request->metode_pembayaran === 'Transfer Bank' 
                ? 'paid'  // langsung dianggap lunas
                : 'pending',
        ]);

        foreach ($carts as $item) {
            $harga = $item->product->harga;
            if ($promo) {
                $harga -= ($harga * $promo->diskon / 100);
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'qty' => $item->qty,
                'harga' => $harga,
                'subtotal' => $harga * $item->qty,
            ]);

            $item->product->stok -= $item->qty;
            $item->product->save();
        }

        Cart::whereIn('id', $cartIds)
            ->where('user_id', $user->id)
            ->update(['status' => 'Sudah Checkout']);

        $redirectUrl = route('pelanggan.pesanan.show', $order->id);

        // kalau transfer bank → generate snap token
        if ($request->metode_pembayaran === 'Transfer Bank') {
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->id . '-' . time(),
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->no_telp,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            $order->update([
                'payment_token' => $snapToken,
                'status_pembayaran' => 'paid',
            ]);

            return response()->json([
                'snap_token' => $snapToken,
                'redirect_url' => $redirectUrl,
            ]);
        }

        // kalau kasir
        return response()->json([
            'redirect_url' => $redirectUrl
        ]);
    }


}
