<x-layout :pageTitle="$product->name">

<div class="container py-4">
<div class="soft-card">

<h3>{{ $product->name }}</h3>
<p class="text-muted">{{ $product->description }}</p>

<div class="fw-bold mb-2">Price: Rp {{ number_format($product->price,0,',','.') }}</div>
<div class="badge bg-secondary">{{ $product->category }}</div>

<div class="mt-3">
  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
  <a href="{{ route('products') }}" class="btn btn-secondary">Back</a>
<form action="{{ route('cart.add', $product->id) }}" method="POST">
  @csrf
  <button class="btn btn-primary-accent btn-lg mt-3">Add to Cart</button>
</form>


</div>

</div>
</div>

</x-layout>
