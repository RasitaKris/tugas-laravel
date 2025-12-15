{{-- resources/views/products/list.blade.php --}}
<x-layout :pageTitle="'Payments & Products'">

<div class="container py-4">

 
  <div class="col-12 mb-4">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div>
        <h3 class="mb-0">Payments & Product Management</h3>
        <div class="subtitle text-white-50">
          PKBM Bread of Life Adventist Homeschool Community
        </div>
      </div>

      <div class="d-flex gap-2">
        <a href="{{ route('products.create') }}" class="btn btn-light fw-semibold">
          + Add New Product
        </a>
        <a href="{{ route('products') }}" class="btn btn-warning fw-semibold">
          Refresh
        </a>
      </div>
    </div>
  </div>

  
  <form method="GET" action="{{ route('products') }}"
        class="row g-2 align-items-end mb-4 p-3 bg-light rounded shadow-sm">

    <div class="col-md-3">
      <label class="form-label">Search</label>
      <input type="text" name="search"
             value="{{ request('search') }}"
             class="form-control"
             placeholder="Name or description">
    </div>

    <div class="col-md-2">
      <label class="form-label">Category</label>
      <select name="category" class="form-select">
        <option value="">All</option>
        @foreach($categories as $key => $label)
          <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
            {{ $label }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-md-2">
      <label class="form-label">Min Price</label>
      <input type="number" name="min_price"
             value="{{ request('min_price') }}"
             class="form-control">
    </div>

    <div class="col-md-2">
      <label class="form-label">Max Price</label>
      <input type="number" name="max_price"
             value="{{ request('max_price') }}"
             class="form-control">
    </div>

    <div class="col-md-2">
      <label class="form-label">Sort</label>
      <select name="sort" class="form-select">
        <option value="">Default</option>
        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A–Z)</option>
        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low → High</option>
        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High → Low</option>
      </select>
    </div>

    <div class="col-md-1 d-grid">
      <button class="btn btn-success">Apply</button>
    </div>
  </form>

  
  <div class="row g-3">

    @forelse($products as $p)
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card h-100 shadow-sm">

       
        @php
          $name = strtolower($p->name ?? '');

          $img = match ($p->category ?? '') {

            'books' => \Illuminate\Support\Str::contains($name, ['bible'])
                ? asset('images/products/bible.jpg')
                : asset('images/products/books.jpg'),

            'exams' => asset('images/products/exams.jpg'),

            'registration' => asset('images/products/registration.jpg'),

            'programs' => \Illuminate\Support\Str::contains($name, ['smp', 'junior'])
                ? asset('images/products/programs-smp.jpg')
                : asset('images/products/programs-sd.jpg'),

            'graduation' => \Illuminate\Support\Str::contains($name, ['smp', 'junior'])
                ? asset('images/products/graduation-smp.jpg')
                : asset('images/products/graduation-sd.jpg'),

            'items' => \Illuminate\Support\Str::contains($name, ['seragam', 'uniform', 'baju'])
                ? asset('images/products/item-seragam.jpg')
                : (\Illuminate\Support\Str::contains($name, ['id', 'card'])
                    ? asset('images/products/item-id-card.jpg')
                    : (\Illuminate\Support\Str::contains($name, ['lanyard'])
                        ? asset('images/products/item-lanyard.jpg')
                        : asset('images/products/item-toga.jpg')
                      )
                  ),


            default => asset('images/products/books.jpg'),
          };
        @endphp

        <div style="height:150px; overflow:hidden;">
          <img src="{{ $img }}" class="w-100" style="height:150px; object-fit:cover;">
        </div>

        <div class="card-body d-flex flex-column">
          <h6 class="fw-bold mb-1">{{ $p->name }}</h6>
          <div class="text-muted small mb-2">
            {{ \Illuminate\Support\Str::limit($p->description, 70) }}
          </div>

          <div class="mt-auto d-flex justify-content-between align-items-center">
            <div class="fw-bold">
              Rp {{ number_format($p->price,0,',','.') }}
            </div>
            <span class="badge bg-secondary">
              {{ $categories[$p->category] ?? $p->category }}
            </span>
          </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="card-footer d-flex flex-wrap gap-2 justify-content-center">

          <form action="{{ route('cart.add', $p->id) }}" method="POST">
            @csrf
            <button class="btn btn-primary btn-sm product-action-btn">Add to Cart</button>
          </form>

          <a href="{{ route('products.show', $p->id) }}"
             class="btn btn-primary btn-sm product-action-btn">Detail</a>

          <a href="{{ route('products.edit', $p->id) }}"
             class="btn btn-primary btn-sm product-action-btn">Edit</a>

          <form action="{{ route('products.delete', $p->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary btn-sm product-action-btn"
                    onclick="return confirm('Delete this product?')">
              Delete
            </button>
          </form>

        </div>

      </div>
    </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center">No products found.</div>
      </div>
    @endforelse

  </div>

  <div class="mt-4 d-flex justify-content-center">
    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
  </div>

</div>

<style>
  .page-header {
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
    color: #fff;
    border-radius: 12px;
    padding: 18px 22px;
    border-left: 6px solid #ffc107;
    box-shadow: 0 6px 16px rgba(0,0,0,0.06);
  }
  .product-action-btn {
    font-size: 13px;
    padding: 6px 12px;
    height: 36px;
  }
</style>

</x-layout>
