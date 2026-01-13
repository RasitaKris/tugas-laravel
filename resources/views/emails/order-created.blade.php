<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>

<h2>Terima kasih atas order Anda 🙏</h2>

<p>Halo {{ $order->user->name }},</p>

<p>
Order Anda dengan nomor:
<strong>#{{ $order->id }}</strong>
berhasil dibuat.
</p>

<p><strong>Total Pembayaran:</strong><br>
Rp {{ number_format($order->total_amount, 0, ',', '.') }}
</p>

<p><strong>Metode Pembayaran:</strong><br>
{{ $order->payment_channel }}
</p>

<p>
Silakan lakukan pembayaran sesuai instruksi yang akan kami informasikan.
</p>

<hr>

<p>
PKBM Bread of Life<br>
Tuhan memberkati 🙏
</p>

</body>
</html>

