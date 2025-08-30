<h2>Halo {{ $order->user->name }},</h2>

<p>Terima kasih! Pembayaran untuk pesanan <strong>#{{ $order->id }}</strong> telah <b>berhasil</b>.</p>

<ul>
    <li><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</li>
    <li><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</li>
    <li><strong>Metode Pembayaran:</strong> {{ ucfirst($order->metode_pembayaran) }}</li>
    <li><strong>Tipe Pesanan:</strong> {{ ucfirst($order->tipe_pesanan) }}</li>
</ul>

<p>Pesanan Anda sedang diproses. Kami akan segera menyiapkannya.</p>

<p>Salam hangat,<br>Kedai ExFour</p>
