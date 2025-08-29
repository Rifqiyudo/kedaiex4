<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Midtrans\Config;


class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notif = new Notification();

        // order_id dari Midtrans biasanya "orderId-timestamp"
        $orderId = explode('-', $notif->order_id)[0];

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        if ($notif->transaction_status == 'settlement' || $notif->transaction_status == 'capture') {
            $order->update([
                'status_pembayaran' => 'paid',
            ]);
        } elseif ($notif->transaction_status == 'expire') {
            $order->update([
                'status_pembayaran' => 'Expired',
            ]);
        } elseif ($notif->transaction_status == 'cancel' || $notif->transaction_status == 'deny') {
            $order->update([
                'status_pembayaran' => 'Canceled',
            ]);
        }

        return response()->json(['message' => 'Callback processed']);
    }
}
