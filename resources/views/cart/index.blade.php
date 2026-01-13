<x-layout :pageTitle="__('cart.title')">

<div class="container py-4">

    // HEADER: Judul & Ikon
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-white p-2 rounded-circle shadow-sm text-primary d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
            <i class="bi bi-cart3 fs-4"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-0 text-dark">{{ __('cart.title') }}</h2>
            <p class="text-muted small mb-0">Kelola item belanjaan Anda sebelum checkout.</p>
        </div>
    </div>

    //ALERT: Pesan Sukses
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i> {{ session('success') }}
        </div>
    @endif

    //KONDISI: Jika Keranjang Kosong
    @if($cart->count() == 0)
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-light">
            <div class="text-muted mb-3" style="font-size: 4rem; opacity: 0.3;">
                <i class="bi bi-cart-x"></i>
            </div>
            <h4 class="fw-bold text-muted">{{ __('cart.empty') }}</h4>
            <p class="text-muted small mb-4">Keranjang Anda masih kosong. Yuk cari produk menarik!</p>
            <a href="{{ route('products') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> {{ __('app.menu.products') }}
            </a>
        </div>
    @else
    
    // KONDISI: Ada Barang
    <div class="row g-4">
        
        // Daftar Item
        <div class="col-lg-8">
            <div class="d-flex flex-column gap-3">
                @foreach($cart as $item)
                @php
                    // Logika Gambar (Sama seperti halaman Produk)
                    if (!empty($item->product->image)) {
                        $img = asset('storage/' . $item->product->image);
                    } else {
                        $path = 'images/products/' . ($item->product->category ?? 'default') . '.jpg';
                        $img = file_exists(public_path($path)) ? asset($path) : asset('images/products/default.jpg');
                    }
                    
                    $subtotal = $item->quantity * $item->product->price;
                @endphp

                <div class="bg-white p-3 rounded-4 shadow-sm d-flex align-items-center gap-3 border border-light position-relative">
                    
                    {{-- Gambar Produk --}}
                    <div style="width: 90px; height: 90px; flex-shrink: 0; border-radius: 12px; overflow: hidden; background: #f8f9fa;">
                        <img src="{{ $img }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->product->name }}">
                    </div>

                    {{-- Info Produk --}}
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1 text-dark">{{ $item->product->name }}</h6>
                        <div class="text-primary fw-bold mb-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                        
                        {{-- Input Quantity --}}
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <div class="input-group input-group-sm bg-light rounded-3 p-1" style="width: 120px;">
                                <input type="number" min="1" name="quantity" value="{{ $item->quantity }}" class="form-control border-0 bg-transparent text-center fw-bold shadow-none">
                                <button class="btn btn-white shadow-sm rounded-2 text-primary fw-bold" type="submit" style="font-size: 12px;">Update</button>
                            </div>
                        </form>
                    </div>

                    {{-- Subtotal & Hapus (Desktop) --}}
                    <div class="text-end d-none d-md-block ps-3 border-start">
                        <small class="text-muted d-block mb-1" style="font-size: 11px;">Subtotal</small>
                        <h5 class="fw-bold mb-3 text-dark">Rp {{ number_format($subtotal, 0, ',', '.') }}</h5>
                        
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-light text-danger rounded-pill px-3 fw-bold" onclick="return confirm('{{ __('cart.remove_confirm') }}')">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>

                    {{-- Tombol Hapus (Mobile / Kecil) --}}
                    <div class="d-md-none position-absolute top-0 end-0 m-2">
                         <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" style="width: 30px; height: 30px; padding: 0;">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>
        </div>

        // Ringkasan Belanja
        <div class="col-lg-4">
            <div class="bg-white p-4 rounded-4 shadow-sm border border-light sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-receipt text-primary"></i> Ringkasan
                </h5>
                
                <div class="d-flex justify-content-between mb-2 text-muted">
                    <span>Total Item</span>
                    <span>{{ $cart->sum('quantity') }} pcs</span>
                </div>
                <div class="d-flex justify-content-between mb-4 text-muted">
                    <span>Subtotal Produk</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                <hr class="border-dashed">

                <div class="d-flex justify-content-between mb-4 align-items-center">
                    <span class="fw-bold fs-5 text-dark">Total</span>
                    <span class="fw-bold fs-4 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout.form') }}" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm transition-all hover-scale">
                    {{ __('cart.checkout') }} <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                </a>
                
                <div class="text-center mt-3">
                    <a href="{{ route('products') }}" class="text-decoration-none small text-muted fw-semibold">
                        <i class="bi bi-arrow-left"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>

    </div>
    @endif

</div>

// Style Efek Hover
<style>
    .hover-scale:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(63, 109, 247, 0.25) !important;
    }
</style>

</x-layout>