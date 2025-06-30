<?php

namespace App\Http\Controllers\Barista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class TransaksiController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('barista.transaksi.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('barista.transaksi.show', compact('order'));
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_pembayaran = 'paid';
        if ($order->status === 'pending') {
            $order->status = 'proses';
        }
        $order->save();
        return redirect()->route('barista.transaksi.show', $id)->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    public function cetakStruk($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('barista.transaksi.cetak_struk', compact('order'));
    }
} 