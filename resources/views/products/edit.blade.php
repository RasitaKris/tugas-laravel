{{-- resources/views/products/edit.blade.php --}}
<x-layout :pageTitle="'Edit Product'">

<div class="container py-4">

 
  <div class="mb-4">
    <h3 class="fw-bold text-primary">Edit Product</h3>
    <small class="text-muted">Update product information below</small>
  </div>

  <div class="card p-4 shadow-sm">

    <p class="text-muted small mb-3">
      Editing Product ID: <b>{{ $product->id }}</b>
    </p>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
      @csrf

     
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text"
               name="name"
               value="{{ old('name', $product->name) }}"
               class="form-control"
               required>
      </div>

      
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description"
                  rows="4"
                  class="form-control">{{ old('description', $product->description) }}</textarea>
      </div>

     
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category" class="form-select" required>
          @foreach($categories as $key => $label)
            <option value="{{ $key }}"
              {{ old('category', $product->category) == $key ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Price (IDR)</label>
        <input type="number"
               name="price"
               value="{{ old('price', $product->price) }}"
               class="form-control"
               required>
      </div>

     
      <div class="d-flex gap-2">
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('products') }}" class="btn btn-secondary">Cancel</a>
      </div>

    </form>

  </div>
</div>

</x-layout>
