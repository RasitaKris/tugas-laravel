<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Order</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6">

    <h2>Halo {{ $order->shipping_name }},</h2>

    <p>Terima kasih telah melakukan pemesanan di <strong>PKBM Bread of Life</strong>.</p>

    <p><strong>Detail Order:</strong></p>

    <ul>
        <li><strong>No Order:</strong> #{{ $order->id }}</li>
        <li><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</li>
        <li><strong>Metode Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</li>
        <li><strong>Channel Pembayaran:</strong> {{ $order->payment_channel }}</li>
        <li><strong>Ongkir:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</li>
        <li><strong>Alamat Pengiriman:</strong><br>{{ $order->shipping_address }}</li>
    </ul>

    <hr>

    <h3>💳 Informasi Pembayaran</h3>

    @if($order->payment_method === 'bank_transfer')
        <p>Silakan transfer ke salah satu rekening berikut:</p>
        <ul>
            <li>BCA – 1234567890 a.n PKBM Bread of Life</li>
            <li>BRI – 0987654321 a.n PKBM Bread of Life</li>
            <li>Mandiri – 1122334455 a.n PKBM Bread of Life</li>
        </ul>
    @else
        <p>Silakan lakukan pembayaran melalui:</p>
        <ul>
            <li>DANA – 0812xxxxxxx</li>
            <li>OVO – 0813xxxxxxx</li>
            <li>GoPay – 0814xxxxxxx</li>
        </ul>
    @endif

    <p>
        Setelah melakukan pembayaran, mohon simpan bukti pembayaran Anda.
    </p>

    <p>
        Terima kasih,<br>
        <strong>PKBM Bread of Life</strong>
    </p>

</body>
</html>
