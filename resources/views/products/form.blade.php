<x-layout :pageTitle="'Add Product'">

<div class="container py-4">
<div class="soft-card">

<h4 class="mb-3 text-primary">Add New Product</h4>

<form action="{{ route('products.store') }}" method="POST">
@csrf

<div class="mb-3">
  <label>Product Name</label>
  <input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
  <label>Description</label>
  <textarea name="description" class="form-control"></textarea>
</div>

<div class="mb-3">
  <label>Category</label>
  <select name="category" class="form-select" required>
    @foreach($categories as $key => $label)
      <option value="{{ $key }}">{{ $label }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label>Price</label>
  <input type="number" name="price" class="form-control" required>
</div>

<div class="d-flex gap-2">
  <button class="btn btn-success">Save</button>
  <a href="{{ route('products') }}" class="btn btn-secondary">Cancel</a>
</div>

</form>
</div>
</div>

</x-layout>
