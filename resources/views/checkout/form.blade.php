<x-layout pageTitle="{{ __('checkout.title') }}">

    <style>
        .checkout-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #eef2f6;
            box-shadow: 0 4px 24px rgba(0,0,0,0.02);
        }
        .checkout-header {
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .form-label-bold {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        .form-control, .form-select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus, .form-select:focus {
            border-color: #888;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }
        .total-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: #2c3e50;
        }
        .btn-checkout {
            padding: 14px;
            font-weight: bold;
            font-size: 1rem;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>

    <div class="container py-4">
        
        <div class="mb-4">
            <h2 class="fw-bold mb-1">{{ __('checkout.title') }}</h2>
            <p class="text-muted">{{ __('checkout.subtitle') }}</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger mb-4 shadow-sm border-0">{{ session('error') }}</div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                
                {{-- KOLOM KIRI --}}
                <div class="col-lg-8">
                    <div class="checkout-card p-4">
                        <div class="checkout-header">
                            <h5 class="fw-bold m-0"><i class="bi bi-geo-alt me-2"></i>{{ __('checkout.shipping_info') }}</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-bold">{{ __('checkout.recipient') }}</label>
                                <input type="text"
                                    name="shipping_name"
                                    class="form-control"
                                    placeholder="{{ __('checkout.placeholder_name') }}"
                                    value="{{ old('shipping_name', auth()->user()->name ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-bold">{{ __('checkout.phone') }}</label>
                                <input type="text"
                                    name="shipping_phone"
                                    class="form-control"
                                    placeholder="{{ __('checkout.placeholder_phone') }}"
                                    value="{{ old('shipping_phone') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-bold">{{ __('checkout.address') }}</label>
                            <textarea
                                name="shipping_address"
                                class="form-control"
                                rows="3"
                                placeholder="{{ __('checkout.placeholder_address') }}">{{ old('shipping_address') }}</textarea>
                        </div>

                        <div class="checkout-header mt-4">
                            <h5 class="fw-bold m-0"><i class="bi bi-truck me-2"></i>{{ __('checkout.method_info') }}</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-bold">{{ __('checkout.shipping') }}</label>
                                <select name="shipping_service" class="form-select">
                                    <option value="">{{ __('checkout.choose_shipping') }}</option>
                                    <option value="JNE REG|20000">JNE REG (Rp 20.000)</option>
                                    <option value="J&T|18000">J&T Express (Rp 18.000)</option>
                                    <option value="SiCepat|22000">SiCepat (Rp 22.000)</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-bold">{{ __('checkout.payment') }}</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="">{{ __('checkout.choose_payment') }}</option>
                                    <option value="bank_transfer">Bank Transfer (BCA/Mandiri)</option>
                                    <option value="ewallet">E-Wallet (QRIS/Gopay/OVO)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN --}}
                <div class="col-lg-4">
                    <div class="checkout-card p-4 sticky-top" style="top: 20px; z-index: 1;">
                        <div class="checkout-header">
                            <h5 class="fw-bold m-0">{{ __('checkout.summary_title') }}</h5>
                        </div>

                        <div class="mb-3">
                            @foreach($items as $item)
                                <div class="summary-item border-bottom pb-2 mb-2">
                                    <div>
                                        <div class="fw-bold">{{ $item->product->name ?? $item->name }}</div>
                                        <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->product->price ?? $item->price, 0, ',', '.') }}</small>
                                    </div>
                                    <div class="fw-bold">
                                        Rp {{ number_format(($item->product->price ?? $item->price) * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-2 border-top">
                            <span class="text-muted fw-bold">{{ __('checkout.subtotal_product') }}</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="alert alert-info mt-3 py-2 px-3 small">
                            <i class="bi bi-info-circle me-1"></i> {{ __('checkout.shipping_note') }}
                        </div>

                        <button class="btn btn-primary-accent w-100 btn-checkout mt-3 shadow">
                            {{ __('checkout.place_order') }}
                        </button>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted"><i class="bi bi-shield-lock"></i> {{ __('checkout.secure_msg') }}</small>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

</x-layout>