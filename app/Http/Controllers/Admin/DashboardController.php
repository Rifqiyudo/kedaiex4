<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggalAwal = request('tanggal_awal');
        $tanggalAkhir = request('tanggal_akhir');

        $filterTanggal = $tanggalAwal && $tanggalAkhir;
        // Hanya order yang sudah selesai atau sudah dibayar
        $orderQuery = Order::when($filterTanggal, function ($query) use ($tanggalAwal, $tanggalAkhir) {
        $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        })
        ->where(function($q) {
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
        $penghasilanPerBulan = Order::when($filterTanggal, function ($query) use ($tanggalAwal, $tanggalAkhir) {
        $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        })
        ->where(function($q) {
            $q->where('status', 'selesai')
            ->orWhere('status_pembayaran', 'paid');
        })
        ->selectRaw('MONTH(created_at) as bulan, SUM(total) as total')
        ->groupBy('bulan')
        ->pluck('total', 'bulan');

        // Data produk terjual per kategori (order valid)
        $produkPerKategori = Category::with(['products.orderItems.order' => function ($query) use ($filterTanggal, $tanggalAwal, $tanggalAkhir) {
        if ($filterTanggal) {
            $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        }
        $query->where(function($q) {
            $q->where('status', 'selesai')
            ->orWhere('status_pembayaran', 'paid');
        });
        }])->get()->mapWithKeys(function($cat) {
            $qty = 0;
            foreach ($cat->products as $prod) {
                foreach ($prod->orderItems as $item) {
                   
                    if ($item->order) {
                        $qty += $item->qty;
                    }
                }
            }
            return [$cat->nama => $qty];
        });
        // dd($produkPerKategori);

        $stokMasuk = [];
        $stokKeluar = [];
        $bulanLabels = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulanLabels[] = Carbon::create()->month($i)->locale('id')->isoFormat('MMMM');

            $masuk = DB::table('stock_histories')
                ->when($filterTanggal, function ($query) use ($tanggalAwal, $tanggalAkhir) {
                    $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
                })
                ->whereMonth('created_at', $i)
                ->where('tipe', 'masuk')
                ->sum('jumlah');

            $keluar = DB::table('stock_histories')
                ->when($filterTanggal, function ($query) use ($tanggalAwal, $tanggalAkhir) {
                    $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
                })
                ->whereMonth('created_at', $i)
                ->where('tipe', 'keluar')
                ->sum(DB::raw('ABS(jumlah)'));

            $stokMasuk[] = $masuk;
            $stokKeluar[] = $keluar;
        }
        // dd($stokMasuk, $stokKeluar);
        $cardStokMasuk = array_sum($stokMasuk);
        $cardStokKeluar = array_sum($stokKeluar);


        // Query dasar: hanya order selesai atau sudah dibayar
        $orderQuery = Order::with('user')
            ->where(function ($q) {
                $q->where('status', 'selesai')
                ->orWhere('status_pembayaran', 'paid');
            });

        // Filter jika tanggal diberikan
        if ($tanggalAwal && $tanggalAkhir) {
            $orderQuery->whereBetween('created_at', [
                Carbon::parse($tanggalAwal)->startOfDay(),
                Carbon::parse($tanggalAkhir)->endOfDay()
            ]);
        }

        $orders = $orderQuery->latest()->get();

        return view('admin.dashboard', compact('totalPenghasilan', 'produkTerjual', 'stok', 'penghasilanPerBulan', 'produkPerKategori', 'bulanLabels','stokMasuk', 'stokKeluar', 'cardStokMasuk', 'cardStokKeluar', 'tanggalAwal',
    'tanggalAkhir', 'orders'))
            ->with('title', 'Dashboard');
    }
} 