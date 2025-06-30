<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPenjualanExport implements FromCollection, WithHeadings
{
    private $tanggal_awal;
    private $tanggal_akhir;

    public function __construct($tanggal_awal = null, $tanggal_akhir = null)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Order::with('user')->orderBy('created_at', 'desc');
        if ($this->tanggal_awal && $this->tanggal_akhir) {
            $query->whereBetween('created_at', [
                $this->tanggal_awal . ' 00:00:00',
                $this->tanggal_akhir . ' 23:59:59'
            ]);
        }
        $orders = $query->get();
        return $orders->map(function($order) {
            return [
                'tanggal' => $order->created_at->format('d-m-Y H:i'),
                'pelanggan' => $order->user ? $order->user->name : '-',
                'total' => $order->total,
                'status' => $order->status,
            ];
        });
    }

    public function headings(): array
    {
        return ['Tanggal', 'Pelanggan', 'Total', 'Status'];
    }
}
