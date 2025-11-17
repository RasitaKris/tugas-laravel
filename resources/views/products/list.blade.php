<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Payments & Products Management</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add new product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">Number</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width:120px">Price (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td>{{ $p['id'] }}</td>
                            <td>{{ $p['name'] }}</td>
                            <td>{{ $p['description'] }}</td>
                            <td>{{ number_format($p['price']) }}</td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
