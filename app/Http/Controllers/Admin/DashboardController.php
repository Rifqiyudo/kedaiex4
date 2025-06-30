<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Hanya order yang sudah selesai atau sudah dibayar
        $orderQuery = Order::where(function($q) {
            $q->where('status', 'selesai')
              ->orWhere('status_pembayaran', 'paid');
        });

        // Total penghasilan dari order valid
        $totalPenghasilan = $orderQuery->sum('total');

        // Produk terjual dari order_items yang order-nya valid
        $orderIds = $orderQuery->pluck('id');
        $produkTerjual = OrderItem::whereIn('order_id', $orderIds)->sum('qty');

        // Total stok produk (sisa stok)
        $stok = Product::sum('stok');

        // Data penghasilan per bulan (order valid)
        $penghasilanPerBulan = Order::where(function($q) {
            $q->where('status', 'selesai')
              ->orWhere('status_pembayaran', 'paid');
        })
        ->selectRaw('MONTH(created_at) as bulan, SUM(total) as total')
        ->groupBy('bulan')
        ->pluck('total', 'bulan');

        // Data produk terjual per kategori (order valid)
        $produkPerKategori = Category::with(['products.orderItems' => function($q) use ($orderIds) {
            $q->whereIn('order_id', $orderIds);
        }])->get()->mapWithKeys(function($cat) {
            $qty = 0;
            foreach ($cat->products as $prod) {
                $qty += $prod->orderItems->sum('qty');
            }
            return [$cat->nama => $qty];
        });

        return view('admin.dashboard', compact('totalPenghasilan', 'produkTerjual', 'stok', 'penghasilanPerBulan', 'produkPerKategori'));
    }
} 