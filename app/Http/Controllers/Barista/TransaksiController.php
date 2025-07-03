<?php

namespace App\Http\Controllers\Barista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Mail\PembayaranBerhasilMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransaksiController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('barista.transaksi.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product', 'ulasan'])->findOrFail($id);
        return view('barista.transaksi.show', compact('order'));
    }
    private function normalizePhoneNumber($number)
    {
       
        $number = preg_replace('/[^0-9]/', '', $number);

        
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        return $number;
    }
    private function kirimWhatsApp($token, $order)
    {
        $message = "Halo {$order->user->name},\n\n";
        $message .= "Terima kasih! Pembayaran untuk pesanan #{$order->id} telah *berhasil*.\n\n";
        $message .= "📅 Tanggal: " . $order->created_at->format('d M Y H:i') . "\n";
        $message .= "💰 Total: Rp " . number_format($order->total, 0, ',', '.') . "\n";
        $message .= "💳 Metode: " . ucfirst($order->metode_pembayaran) . "\n\n";
        $message .= "Pesanan Anda sedang diproses. Kami akan segera menyiapkannya.\n\n";
        $message .= "Salam hangat,\nKedai ExFour";
        $nomorTujuan = $this->normalizePhoneNumber($order->user->no_telp);
        $response = Http::withHeaders([
            'Authorization' => 'BMDGFQzMKTjXtb1NU9xV'
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $nomorTujuan,
            'message' => $message
        ]);

        // Optional: cek respon
        Log::info('Fonnte response: ', $response->json());
    }


    public function verifikasiPembayaran(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_pembayaran = 'paid';
        if ($order->status === 'pending') {
            $order->status = 'proses';
        }
        $order->save();
        Mail::to($order->user->email)->send(new PembayaranBerhasilMail($order));
        $this->kirimWhatsApp('BMDGFQzMKTjXtb1NU9xV', $order);
        return redirect()->route('barista.transaksi.show', $id)->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    public function cetakStruk($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('barista.transaksi.cetak_struk', compact('order'));
    }
} 