<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $user = session('user');
        $orders = Order::with('orderItems.product')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pelanggan.pesanan.index', compact('orders'));
    }

    public function show($id)
    {
        $user = session('user');
        $order = Order::with('orderItems.product')
            ->where('user_id', $user->id)
            ->findOrFail($id);
        return view('pelanggan.pesanan.show', compact('order'));
    }

    public function bayarForm($id)
    {
        $user = session('user');
        $order = Order::where('user_id', $user->id)->findOrFail($id);
        if ($order->status_pembayaran === 'paid') {
            return redirect()->route('pelanggan.pesanan.show', $order->id)->with('success', 'Pesanan sudah dibayar.');
        }
        return view('pelanggan.pesanan.bayar', compact('order'));
    }

    public function bayarProses(Request $request, $id)
    {
        $user = session('user');
        $order = Order::where('user_id', $user->id)->findOrFail($id);
        $request->validate([
            'metode_pembayaran' => 'required|in:qris,kredit,tunai',
            'bukti_pembayaran' => 'nullable|image|max:2048',
            'kartu_nama' => 'nullable|string|max:100',
            'kartu_nomor' => 'nullable|string|max:20',
            'kartu_exp' => 'nullable|string|max:7',
            'kartu_cvv' => 'nullable|string|max:4',
        ]);
        $order->metode_pembayaran = $request->metode_pembayaran;
        if ($request->metode_pembayaran === 'qris') {
            if ($request->hasFile('bukti_pembayaran')) {
                $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
                $order->bukti_pembayaran = $path;
            }
            $order->status_pembayaran = 'pending';
            $order->status = 'proses';
        } elseif ($request->metode_pembayaran === 'kredit') {
            $order->status_pembayaran = 'paid';
            $order->status = 'proses';
        } elseif ($request->metode_pembayaran === 'tunai') {
            $order->status_pembayaran = 'pending';
            $order->status = 'proses';
        }
        $order->save();
        return redirect()->route('pelanggan.pesanan.show', $order->id)->with('success', 'Pembayaran berhasil dikirim!');
    }
}
