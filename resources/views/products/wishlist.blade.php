<x-layout :pageTitle="__('products.my_wishlist')">

<div class="container py-4">

    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">❤️ {{ __('product.my_wishlist') }}</h2>
        <p class="text-muted">Simpan produk impian Anda di sini.</p>
    </div>

    <div class="row g-4">
    @forelse($wishlist as $p)
      <div class="col-md-6 col-lg-4 col-xl-3">
        {{-- Menggunakan Style Produk Card yang sudah ada --}}
        <div class="bg-white rounded-4 shadow-sm h-100 d-flex flex-column border border-light overflow-hidden position-relative product-card-hover">
            
            {{-- Gambar --}}
            @php
            if (!empty($p->image)) {
                $img = asset('storage/' . $p->image);
            } else {
                $path = 'images/products/' . $p->category . '.jpg';
                $img = file_exists(public_path($path)) ? asset($path) : asset('images/products/default.jpg');
            }
            @endphp

            <div style="height: 180px; overflow: hidden; position: relative;">
                <img src="{{ $img }}" class="w-100 h-100 object-fit-cover">
                <span class="badge bg-white text-dark shadow-sm position-absolute top-0 start-0 m-3 rounded-pill px-3 py-1 small fw-bold">
                    {{ __('product.categories.' . $p->category) }}
                </span>
            </div>

            <div class="p-3 flex-grow-1 d-flex flex-column">
                <h6 class="fw-bold mb-1">{{ $p->name }}</h6>
                <div class="text-primary fw-bold mb-2">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                <p class="text-muted small mb-3 flex-grow-1" style="line-height: 1.4;">
                    {{ \Illuminate\Support\Str::limit($p->description, 60) }}
                </p>

                <div class="d-flex gap-2 mt-auto">
                    <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1 rounded-pill fw-bold">
                        {{ __('product.detail') }}
                    </a>
                    
                    <form action="{{ route('wishlist.toggle', $p->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="{{ __('product.remove_wishlist') }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <div class="text-muted mb-3" style="font-size: 3rem;">💔</div>
            <h5 class="fw-bold text-muted">{{ __('products.wishlist_empty') }}</h5>
            <a href="{{ route('products') }}" class="btn btn-primary rounded-pill px-4 mt-3">Lihat Produk</a>
        </div>
      </div>
    @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
      {{ $wishlist->links('pagination::bootstrap-5') }}
    </div>

</div>

</x-layout>