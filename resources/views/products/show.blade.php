<x-layout :pageTitle="$product->name">

<div class="container py-4">
    
    //Tombol Kembali
    <div class="mb-4">
        <a href="{{ route('products') }}" class="btn btn-light rounded-pill shadow-sm fw-bold text-secondary border px-4">
            <i class="bi bi-arrow-left me-2"></i> {{ __('product.cancel') }}
        </a>
    </div>

    <div class="soft-card overflow-hidden p-0">
        <div class="row g-0">
            
            // GAMBAR PRODUK
            <div class="col-lg-5 bg-light d-flex align-items-center justify-content-center p-4" style="min-height: 350px;">
                @php
                    if (!empty($product->image)) {
                        $img = asset('storage/' . $product->image);
                    } else {
                        $path = 'images/products/' . ($product->category ?? 'default') . '.jpg';
                        $img = file_exists(public_path($path)) ? asset($path) : asset('images/products/default.jpg');
                    }
                @endphp
                <img src="{{ $img }}" alt="{{ $product->name }}" class="img-fluid rounded-4 shadow-sm" style="max-height: 300px; width: auto;">
            </div>

            // DETAIL INFO 
            <div class="col-lg-7 p-4 p-lg-5 d-flex flex-column">
                
                // Kategori Badge 
                <div class="mb-3">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 text-uppercase fw-bold" style="font-size: 12px; letter-spacing: 0.5px;">
                        {{ __('product.categories.' . $product->category) }}
                    </span>
                </div>

                // Nama Produk 
                <h2 class="fw-bold text-dark mb-3">
                    {{ app()->getLocale() === 'en' ? ($product->name_en ?? $product->name) : $product->name }}
                </h2>

                // Harga 
                <div class="mb-4">
                    <h3 class="text-primary fw-bold display-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h3>
                </div>

                // Deskripsi 
                <div class="mb-4 text-muted" style="line-height: 1.8;">
                    {{ app()->getLocale() === 'en' ? ($product->description_en ?? $product->description) : $product->description }}
                </div>

                <hr class="border-secondary-subtle my-4">

                // AREA TOMBOL AKSI
                <div class="d-flex flex-wrap gap-2 mt-auto">
                    
                    //1. Tambah ke Keranjang (Form)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1 flex-md-grow-0">
                        @csrf
                        <button class="btn btn-outline-primary fw-bold w-100 h-100 px-4 py-2 rounded-pill d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-cart-plus fs-5"></i> {{ __('product.add_to_cart') }}
                        </button>
                    </form>

                    // 2. Bayar Sekarang
                    <a href="{{ route('buy.now', $product->id) }}" class="btn btn-primary fw-bold flex-grow-1 px-4 py-2 rounded-pill d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        {{ __('product.buy_now') }} <i class="bi bi-arrow-right"></i>
                    </a>

                    // 3. Edit (Hanya Admin/User tertentu - Opsional)
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning text-dark fw-bold px-3 py-2 rounded-pill d-flex align-items-center justify-content-center" title="{{ __('product.edit') }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                </div>

            </div>
        </div>
    </div>

</div>

</x-layout>