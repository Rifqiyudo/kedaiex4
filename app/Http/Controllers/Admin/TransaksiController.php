<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->orderBy('created_at', 'desc');
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $status = $request->status;
        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('created_at', [
                $tanggal_awal . ' 00:00:00',
                $tanggal_akhir . ' 23:59:59'
            ]);
        }
        if ($status) {
            $query->where('status', $status);
        }
        $orders = $query->get();
        return view('admin.transaksi.index', compact('orders', 'tanggal_awal', 'tanggal_akhir', 'status'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.transaksi.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal',
        ]);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('admin.transaksi.show', $id)->with('success', 'Status transaksi berhasil diupdate');
    }
}
