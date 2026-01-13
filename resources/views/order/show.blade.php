<x-layout :pageTitle="__('order.order_detail')">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">📄 {{ __('order.order_detail') }}</h2>
            <p class="text-muted small mb-0">{{ __('order.order_id') }} #{{ $order->id }}</p>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-light rounded-pill shadow-sm fw-bold text-secondary border">
            <i class="bi bi-arrow-left me-1"></i> {{ __('order.back') }}
        </a>
    </div>

    <div class="row g-4">
        // KOLOM KIRI
        <div class="col-lg-8">
            <div class="soft-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h5 class="fw-bold mb-0 text-primary">📦 {{ __('order.shipping_info') }}</h5>
                    <span class="badge {{ $order->status == 'pending' ? 'bg-warning text-dark' : 'bg-success' }} px-3 py-2 rounded-pill">
                        {{ $order->status == 'pending' ? __('order.pending') : ucfirst($order->status) }}
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="small text-muted fw-bold">{{ __('order.recipient') }}</label>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle text-secondary fs-5"></i>
                            <span class="fw-semibold text-dark">{{ $order->shipping_name }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="small text-muted fw-bold">{{ __('order.contact') }}</label>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-telephone-fill text-secondary"></i>
                            <span class="text-dark">{{ $order->shipping_phone }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="small text-muted fw-bold">{{ __('order.address') }}</label>
                        <div class="d-flex align-items-start gap-2 bg-light p-3 rounded-3 border">
                            <i class="bi bi-geo-alt-fill text-danger mt-1"></i>
                            <span class="text-dark">{{ $order->shipping_address }}</span>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mt-5 mb-3 text-primary">🛒 {{ __('order.order_items') }}</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="bg-light text-secondary small">
                            <tr>
                                <th class="ps-3 rounded-start py-2">{{ __('order.product') }}</th>
                                <th class="py-2">{{ __('order.price') }}</th>
                                <th class="text-center py-2">{{ __('order.qty') }}</th>
                                <th class="text-end pe-3 rounded-end py-2">{{ __('order.total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr class="border-bottom">
                                    <td class="ps-3 py-3 fw-semibold text-dark">{{ $item->product->name }}</td>
                                    <td class="text-muted">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center"><span class="bg-light px-2 py-1 rounded border text-dark">{{ $item->quantity }}</span></td>
                                    <td class="text-end pe-3 fw-bold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        // KOLOM KANAN 
        <div class="col-lg-4">
            <div class="soft-card h-100">
                <h5 class="fw-bold mb-4 border-bottom pb-3 text-primary">💳 {{ __('order.payment_info') }}</h5>
                
                <div class="d-flex justify-content-between mb-2 small">
                    <span class="text-muted">{{ __('order.method') }}</span>
                    <span class="fw-bold text-uppercase text-dark">{{ $order->payment_method }}</span>
                </div>
                <div class="d-flex justify-content-between mb-4 small">
                    <span class="text-muted">{{ __('order.channel') }}</span>
                    <span class="fw-bold text-dark">{{ $order->payment_channel }}</span>
                </div>

                <div class="p-3 bg-light rounded-3 mb-4 border">
                    <div class="d-flex justify-content-between mb-1 text-muted small">
                        <span>{{ __('order.shipping_cost') }} ({{ $order->shipping_service }})</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark">{{ __('order.total_pay') }}</span>
                        <span class="fw-bold text-success fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($order->status == 'pending')
                <button class="btn btn-primary w-100 py-2 rounded-pill fw-bold">
                    {{ __('order.confirm_payment') }}
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
</x-layout>