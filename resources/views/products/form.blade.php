{{-- resources/views/products/form.blade.php --}}
<x-layout :pageTitle="'Add New Product'">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="soft-card">
        <h4 class="mb-3">Add New Product</h4>

        <form action="{{ route('products.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select" required>
              @foreach($categories as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Price (IDR)</label>
            <input type="number" name="price" class="form-control" required>
          </div>

          <div class="d-flex gap-2">
            <button class="btn btn-accent" type="submit">Submit</button>
            <a href="{{ route('products') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>
