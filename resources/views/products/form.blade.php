<x-layout>
    <h2 class="mb-4">School Payment / Product Form</h2>

    <form action="{{ route('products.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" required />
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>
</x-layout>
