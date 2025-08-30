<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk - Pesanan #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f1e9;
            font-size: 15px;
            font-family: 'Segoe UI', sans-serif;
            color: #3e3e3e;
        }

        .struk-box {
            max-width: 480px;
            margin: 40px auto;
            background: #fff;
            border: 2px dashed #a7825b;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            padding: 24px 24px;
        }

        .struk-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .struk-header h4 {
            margin-bottom: 4px;
            font-weight: 700;
            color: #5c3d28;
        }

        .struk-header small {
            color: #7c6e66;
        }

        .table th {
            background-color: #f3ece5;
            color: #5c3d28;
        }

        .table th, .table td {
            padding: 6px 10px;
            font-size: 14px;
            vertical-align: middle;
        }

        .table-bordered td, .table-bordered th {
            border-color: #d8cfc4;
        }

        .text-muted {
            color: #8b776c !important;
        }

        .struk-footer {
            text-align: center;
            font-size: 13px;
            color: #a3826c;
            margin-top: 20px;
        }

        .btn-print {
            margin-top: 15px;
        }

        .btn-primary {
            background-color: #5c3d28;
            border-color: #5c3d28;
        }

        .btn-primary:hover {
            background-color: #704b34;
            border-color: #704b34;
        }

        @media print {
            .btn-print {
                display: none;
            }

            body {
                background: #fff;
            }

            .struk-box {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body>
    <div class="struk-box">
        <div class="struk-header">
            <h4>Kedai Exfour</h4>
            <small>Jl. Pancawarna No.24 - 27, Mulung, Driyorejo, Gresik, Jawa Timur</small><br>
            <small>Tanggal: {{ $order->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB</small><br>
            <small>ID Pesanan: #{{ $order->id }}</small>
        </div>

        <div class="mb-2">
            <strong>Pelanggan:</strong> {{ $order->user->name ?? '-' }}<br>
            <strong>Email:</strong> {{ $order->user->email ?? '-' }}    <br>
            <strong>Telepon:</strong> {{ $order->user->no_telp ?? '-' }}<br>
            <strong>Alamat:</strong> {{ $order->user->alamat ?? '-' }}  <br>
            <strong>Tipe Pesanan:</strong> {{ $order->tipe_pesanan ?? '-' }}<br>
            <strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran ?? '-' }}<br>
        </div>

        <table class="table table-bordered mb-3">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->nama }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <h6 class="fw-bold">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h6>
        </div>

        <div class="struk-footer">
            Terima kasih atas pesanan Anda!<br>
            <em>- Kedai Exfour ☕️ -</em>
        </div>

        <div class="text-center btn-print">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak Struk
            </button>
        </div>
    </div>
</body>
</html>
