<x-layout :pageTitle="__('order.title')">

<div class="container py-4">

    // HEADER
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-white p-2 rounded-circle shadow-sm text-primary d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
            <i class="bi bi-bag-check fs-4"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-0 text-dark">{{ __('order.title') }}</h2>
            <p class="text-muted small mb-0">Riwayat transaksi dan status pesanan Anda.</p>
        </div>
    </div>

    // ALERT SUKSES
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i> {{ session('success') }}
        </div>
    @endif

    // DAFTAR PESANAN
    @forelse($orders as $order)
        <div class="soft-card mb-3 p-4 d-flex flex-wrap align-items-center justify-content-between gap-3 shadow-sm border border-light position-relative">
            
            {{-- Info Utama --}}
            <div class="d-flex align-items-center gap-3">
                <div class="bg-light p-3 rounded-3 text-center border" style="min-width: 90px;">
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size: 10px;">ID Pesanan</small>
                    <span class="fw-bold text-primary fs-5">#{{ $order->id }}</span>
                </div>
                <div>
                    <div class="fw-bold text-dark fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                    <div class="text-muted small d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border">
                            <i class="bi bi-calendar3 me-1"></i> {{ $order->created_at->format('d M Y') }}
                        </span>
                        <span class="badge bg-light text-secondary border">
                            {{ $order->payment_method == 'bank_transfer' ? 'Transfer Bank' : 'E-Wallet' }}
                        </span>
                    </div>
                </div>
            </div>

            // Status & Tombol
            <div class="d-flex align-items-center gap-3 ms-md-auto flex-wrap">
                
            // Badge Status
                @if($order->status == 'pending')
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 border border-warning-subtle">
                        <i class="bi bi-hourglass-split me-1"></i> {{ __('order.status_pending') }}
                    </span>
                @elseif($order->status == 'success')
                    <span class="badge bg-success rounded-pill px-3 py-2 border border-success-subtle">
                        <i class="bi bi-check-circle me-1"></i> {{ __('order.status_success') }}
                    </span>
                @else
                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                        {{ ucfirst($order->status) }}
                    </span>
                @endif
                
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary rounded-pill btn-sm px-4 fw-bold shadow-sm">
                    {{ __('order.order_detail') }} <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

        </div>
    @empty
        {{-- KONDISI KOSONG (Fix Error $cart) --}}
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-light">
            <div class="text-muted mb-3" style="font-size: 4rem; opacity: 0.3;">
                <i class="bi bi-clipboard-x"></i>
            </div>
            <h4 class="fw-bold text-muted">{{ __('order.empty') }}</h4>
            <p class="text-muted small mb-4">Anda belum pernah melakukan pemesanan.</p>
            <a href="{{ route('products') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="bi bi-shop me-1"></i> {{ __('order.shop_now') }}
            </a>
        </div>
    @endforelse

    // PAGINATION
    <div class="mt-4 d-flex justify-content-center">
        {{ $orders->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>

</div>

</x-layout>