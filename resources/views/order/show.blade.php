<x-layout pageTitle="Order Detail">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📄 Order Detail</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm">← Back to Orders</a>
    </div>

    {{-- ORDER INFO CARD --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-2">Order #{{ $order->id }}</h5>

            <div class="row mb-2">
                <div class="col-md-3 text-muted">Order Date</div>
                <div class="col-md-9">{{ $order->created_at->format('d M Y, H:i') }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-muted">Shipping Address</div>
                <div class="col-md-9">{{ $order->shipping_address }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-muted">Payment Method</div>
                <div class="col-md-9 text-capitalize">{{ $order->payment_method }}</div>
            </div>

            <div class="row">
                <div class="col-md-3 text-muted">Total Amount</div>
                <div class="col-md-9 fw-bold text-success">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    {{-- ORDER ITEMS TABLE --}}
    <h4 class="fw-bold mb-3">🛒 Items in this Order</h4>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Product</th>
                <th width="120">Price</th>
                <th width="90">Qty</th>
                <th width="150">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>

                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>

                    <td>{{ $item->quantity }}</td>

                    <td class="fw-bold">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end mt-3">
        <h4>Total: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></h4>
    </div>

</x-layout>
