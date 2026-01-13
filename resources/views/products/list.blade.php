<x-layout :pageTitle="__('product.title')">

<style>
    /* CUSTOM STYLES KHUSUS PRODUK */
    :root {
        --pastel-blue: #3f6df7;
        --pastel-dark: #2c4ebf;
        --soft-bg: #f4f9ff;
    }

    /* Header */
    .page-header {
        background: linear-gradient(135deg, var(--pastel-blue), var(--pastel-dark));
        color: #fff;
        border-radius: 16px;
        padding: 24px 30px;
        box-shadow: 0 10px 20px rgba(63, 109, 247, 0.15);
        position: relative;
        overflow: hidden;
    }
    .page-header::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0;
        width: 100px;
        background: rgba(255,255,255,0.1);
        transform: skewX(-20deg);
    }

    /* Filter Box */
    .filter-box {
        background: white;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .form-label { font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 6px; }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        font-size: 14px;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--pastel-blue);
        box-shadow: 0 0 0 3px rgba(63, 109, 247, 0.1);
    }

    /* Product Card */
    .product-card {
        border: none;
        border-radius: 16px;
        background: white;
        transition: all 0.3s ease;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }

    /* Image Area */
    .card-img-wrap {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: #f1f5f9;
    }
    .card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }
    .product-card:hover .card-img-wrap img { transform: scale(1.05); }

    /* Admin Dropdown */
    .admin-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }
    .btn-glass-icon {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1e293b;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: 0.2s;
    }
    .btn-glass-icon:hover { background: white; color: var(--pastel-blue); }

    /* Category Badge */
    .cat-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(255, 255, 255, 0.95);
        color: #1e293b;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 50px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
    }

    /* Card Content */
    .card-body { padding: 18px; display: flex; flex-direction: column; flex-grow: 1; }
    .product-title {
        font-weight: 700;
        font-size: 16px;
        color: #1e293b;
        margin-bottom: 6px;
        text-decoration: none;
        display: block;
        line-height: 1.4;
    }
    .product-title:hover { color: var(--pastel-blue); }
    .product-desc { font-size: 13px; color: #64748b; line-height: 1.5; margin-bottom: 12px; }
    
    .product-price {
        font-size: 18px;
        font-weight: 800;
        color: var(--pastel-blue);
        margin-top: auto; 
    }

    /* Action Buttons */
    .card-footer-custom {
        padding: 18px;
        padding-top: 0;
        background: white;
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-buy {
        flex-grow: 1;
        background: var(--pastel-blue);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        padding: 10px;
        transition: 0.2s;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(63, 109, 247, 0.25);
    }
    .btn-buy:hover { background: var(--pastel-dark); color: white; transform: translateY(-2px); }

    .btn-icon-action {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: white;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        font-size: 18px;
    }
    .btn-icon-action:hover { border-color: var(--pastel-blue); color: var(--pastel-blue); background: #f8fafc; }
    .btn-icon-action.wishlist-btn:hover { border-color: #ef4444; color: #ef4444; background: #fef2f2; }

    /* CUSTOM PAGINATION */
    .pagination {
        gap: 5px;
        flex-wrap: wrap; 
    
    .page-item .page-link {
        border-radius: 8px; 
        border: none;
        color: #64748b;
        font-weight: 600;
        padding: 8px 14px;
        background: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        font-size: 14px;
        transition: 0.2s;
    }

    /* Hover effect */
    .page-item .page-link:hover {
        background: #f1f5f9;
        color: var(--pastel-blue);
        transform: translateY(-2px);
    }

    /* Halaman Aktif (Biru) */
    .page-item.active .page-link {
        background: var(--pastel-blue);
        color: white;
        box-shadow: 0 4px 10px rgba(63, 109, 247, 0.3);
    }

    /* Tombol Disabled */
    .page-item.disabled .page-link {
        background: #f8fafc;
        color: #cbd5e1;
        cursor: not-allowed;
    }
</style>

<div class="container py-4">

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-radius:12px;">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

   // HEADER 
    <div class="col-12 mb-4">
      <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
          <h2 class="mb-1 fw-bold">{{ __('product.title') }}</h2>
          <div class="opacity-75" style="font-size: 15px;">
            {{ __('product.subtitle') }}
          </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('products.create') }}" class="btn btn-light text-primary fw-bold shadow-sm border-0 px-4 py-2" style="border-radius: 50px;">
                <i class="bi bi-plus-lg me-1"></i> {{ __('product.add') }}
            </a>
        </div>
      </div>
    </div>

   // FILTER BOX 
    <form method="GET" action="{{ route('products') }}" class="filter-box mb-5">
      <div class="row g-3 align-items-end">
          <div class="col-md-3">
            <label class="form-label">{{ __('product.search') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 ps-0" placeholder="{{ __('product.search_placeholder') }}">
            </div>
          </div>

          <div class="col-md-2">
            <label class="form-label">{{ __('product.category') }}</label>
            <select name="category" class="form-select">
              <option value="">{{ __('product.all') }}</option>
              @foreach ($categories as $key => $label)
                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                  {{ $label }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">{{ __('product.min_price') }}</label>
            <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control" placeholder="0">
          </div>

          <div class="col-md-2">
            <label class="form-label">{{ __('product.max_price') }}</label>
            <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="∞">
          </div>

          <div class="col-md-2">
            <label class="form-label">{{ __('product.sort') }}</label>
            <select name="sort" class="form-select">
              <option value="">{{ __('product.default') }}</option>
              <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('product.sort_low') }}</option>
              <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('product.sort_high') }}</option>
            </select>
          </div>

          <div class="col-md-1 d-grid">
            <button class="btn btn-primary fw-bold text-white" style="background: var(--pastel-blue); border:none; padding:10px; border-radius:10px;">
                <i class="bi bi-funnel"></i>
            </button>
          </div>
      </div>
    </form>

    // PRODUCT GRID 
    <div class="row g-4">
    @forelse($products as $p)
      <div class="col-12 col-sm-6 col-lg-4 col-xl-3"> <div class="product-card">

            // LOGIKA GAMBAR 
            @php
            if (!empty($p->image)) {
                $img = asset('storage/' . $p->image);
            } else {
                $path = 'images/products/' . $p->category . '.jpg';
                $img = file_exists(public_path($path)) ? asset($path) : asset('images/products/default.jpg');
            }
            @endphp

            <div class="card-img-wrap">
                <span class="cat-badge">
                    {{ __('product.categories.' . $p->category) }}
                </span>

                <div class="dropdown admin-actions">
                    <button class="btn-glass-icon" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px; overflow:hidden;">
                        <li>
                            <a class="dropdown-item py-2 small fw-bold" href="{{ route('products.edit', $p->id) }}">
                                <i class="bi bi-pencil-square text-primary me-2"></i> {{ __('product.edit') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-0"></li>
                        <li>
                            <form action="{{ route('products.delete', $p->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="dropdown-item py-2 small fw-bold text-danger" onclick="return confirm('{{ __('product.confirm_delete') }}')">
                                    <i class="bi bi-trash me-2"></i> {{ __('product.delete') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('products.show', $p->id) }}">
                    <img src="{{ $img }}" alt="{{ $p->name }}">
                </a>
            </div>

            <div class="card-body">
                <a href="{{ route('products.show', $p->id) }}" class="product-title">
                    {{ app()->getLocale() === 'en' ? ($p->name_en ?? $p->name) : $p->name }}
                </a>

                <div class="product-desc">
                    {{ \Illuminate\Support\Str::limit(app()->getLocale() === 'en' ? ($p->description_en ?? $p->description) : $p->description, 60) }}
                </div>

                <div class="product-price">
                    Rp {{ number_format($p->price, 0, ',', '.') }}
                </div>
            </div>

            <div class="card-footer-custom">
                <form action="{{ route('wishlist.toggle', $p->id) }}" method="POST">
                    @csrf
                    <button class="btn-icon-action wishlist-btn" title="{{ __('product.wishlist') }}">
                        <i class="bi bi-heart"></i>
                    </button>
                </form>

                <form action="{{ route('cart.add', $p->id) }}" method="POST">
                    @csrf
                    <button class="btn-icon-action" title="{{ __('product.add_to_cart') }}">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </form>

                <a href="{{ route('buy.now', $p->id) }}" class="btn-buy">
                    {{ __('product.buy_now') }}
                </a>
            </div>

        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="text-center py-5">
            <div class="mb-3 text-muted" style="font-size: 50px;"><i class="bi bi-box-seam"></i></div>
            <h5 class="fw-bold text-muted">{{ __('product.empty') }}</h5>
            <p class="text-muted small">Coba ubah filter pencarian Anda.</p>
        </div>
      </div>
    @endforelse
    </div>

    // PAGINATION 
<div class="mt-5 d-flex justify-content-center">
  {{ $products->onEachSide(1)->withQueryString()->links('pagination::bootstrap-5') }}
</div>

</div>

</x-layout>