{{-- resources/views/products/list.blade.php --}}
<x-layout :pageTitle="'Products - School'">

  <div class="row g-4">
    {{-- LEFT: hero / title --}}
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h3 class="mb-0">Payments & Product Management</h3>
          <div class="text-muted">PKBM Bread of Life Adventist Homeschooler Community</div>
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('products.create') }}" class="btn btn-sm btn-muted">+ Add New Product</a>
          <a href="{{ route('products') }}" class="btn btn-sm btn-accent">Refresh</a>
        </div>
      </div>
    </div>

    {{-- SIDEBAR FILTER --}}
    <div class="col-lg-4">
      <div class="filter-box">
        <form method="GET" action="{{ route('products') }}">
          <div class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name or description...">
          </div>

          <div class="mb-3">
            <select name="category" class="form-select">
              <option value="">All categories</option>
              @foreach($categories as $key => $label)
                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
          </div>

          <div class="row g-2 mb-3">
            <div class="col">
              <input type="number" name="min_price" class="form-control" placeholder="Min price" value="{{ request('min_price') }}">
            </div>
            <div class="col">
              <input type="number" name="max_price" class="form-control" placeholder="Max price" value="{{ request('max_price') }}">
            </div>
          </div>

          <div class="mb-3">
            <select name="sort" class="form-select">
              <option value="">Sort by...</option>
              <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A–Z)</option>
              <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price (Low → High)</option>
              <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price (High → Low)</option>
            </select>
          </div>

          <div class="d-grid">
            <button class="btn btn-accent">Apply</button>
          </div>
        </form>
      </div>

      {{-- Small info card --}}
      <div class="soft-card mt-3">
        <div class="small text-muted">Showing <strong>{{ $products->count() > 20 ? 20 : $products->count() }}</strong> of {{ $products->count() }} products</div>
        <div class="mt-2 text-muted" style="font-size:13px;">Tip: gunakan fitur pencarian untuk menemukan produk lebih cepat.</div>
      </div>
    </div>

    {{-- MAIN: cards / table --}}
    <div class="col-lg-8">
      {{-- Grid cards (show up to 20 products) --}}
      <div class="row g-3">
        @foreach($products->take(20) as $p)
          <div class="col-12 col-sm-6">
            <div class="soft-card product-card h-100 d-flex flex-column">
              <div class="mb-2" style="min-height:150px;">
                {{-- Placeholder image based on category (free pics) --}}
                @php
                  $img = match($p->category ?? '') {
                    'books' => 'https://images.pexels.com/photos/590493/pexels-photo-590493.jpeg',
                    'exams' => 'https://images.pexels.com/photos/4145198/pexels-photo-4145198.jpeg',
                    'registration' => 'https://images.pexels.com/photos/3184438/pexels-photo-3184438.jpeg',
                    'items' => 'https://images.pexels.com/photos/159711/book-open-pages-read-159711.jpeg',
                    'programs' => 'https://images.pexels.com/photos/1181396/pexels-photo-1181396.jpeg',
                    default => 'https://images.pexels.com/photos/4145198/pexels-photo-4145198.jpeg',
                  };
                @endphp

                <img src="{{ $img }}?auto=compress&cs=tinysrgb&dpr=1&w=800" alt="product" class="w-100 rounded-2">
              </div>

              <div class="mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div>
                    <div class="fw-bold">{{ $p->name }}</div>
                    <div class="text-muted" style="font-size:13px;">{{ Str::limit($p->description, 80) }}</div>
                  </div>
                  <div class="text-end">
                    <div class="fw-bold">Rp {{ number_format($p->price,0,',','.') }}</div>
                    <div class="text-muted" style="font-size:13px;">{{ $categories[$p->category] ?? $p->category }}</div>
                  </div>
                </div>

                <div class="d-flex gap-2">
                  <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                  <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- If you prefer table (optional), keep it below as fallback --}}
      <div class="mt-4 soft-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="fw-bold">Table view (first 20)</div>
          <div class="text-muted">Quick overview</div>
        </div>

        <div class="table-responsive">
          <table class="table custom-table mb-0">
            <thead>
              <tr>
                <th style="width:60px">#</th>
                <th>Product</th>
                <th>Description</th>
                <th style="width:160px">Category</th>
                <th style="width:160px">Price (IDR)</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products->take(20) as $p)
                <tr>
                  <td>{{ $p->id }}</td>
                  <td>{{ $p->name }}</td>
                  <td>{{ Str::limit($p->description, 60) }}</td>
                  <td>{{ $categories[$p->category] ?? $p->category }}</td>
                  <td>Rp {{ number_format($p->price,0,',','.') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted p-4">No products found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

</x-layout>
