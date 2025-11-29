<x-layout>

    <h2 class="mb-4 text-primary fw-bold">Add New Product</h2>

    <div class="card p-4">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
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
                <button class="btn btn-primary" type="submit">Submit</button>
                <a href="{{ route('products') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</x-layout>
