<x-layout>

<style>
    body {
        background: #e8f1ff !important;
    }

    .page-header {
        background: linear-gradient(135deg, #b6d8ff, #ffe9a8);
        padding: 25px 30px;
        border-radius: 18px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: left;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #2a3d66;
        margin: 0;
    }

    .sub-text {
        color: #4a4a4a;
        font-size: 15px;
        margin-top: 6px;
    }

    .filter-box {
        background: #ffffff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .btn-pastel-blue {
        background: #90bfff;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-pastel-blue:hover {
        background: #76aef3;
    }

    .btn-pastel-yellow {
        background: #ffe083;
        border: none;
        font-weight: 600;
        color: #5a4c00;
        border-radius: 10px;
    }

    .btn-pastel-yellow:hover {
        background: #ffd76b;
    }

    .custom-table {
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #d4e3ff;
    }

    .custom-table thead {
        background: #dbe9ff !important;
        color: #2a3d66;
        font-weight: 700;
        font-size: 15px;
        border-bottom: 2px solid #c7d9ff;
    }

    .custom-table tbody tr {
        background: #76aef3;
        transition: 0.2s ease;
        border-bottom: 1px solid #eef3ff;
    }

    .custom-table tbody tr:nth-child(even) {
        background: #f7faff;
    }

    .custom-table tbody tr:hover {
        background: #e8f1ff !important;
    }

    .custom-table td {
        vertical-align: middle;
        padding: 12px 14px !important;
        color: #334a7d;
    }

    /* garis pembatas antar kolom */
    .custom-table td, 
    .custom-table th {
        border-right: 1px solid #dce6ff !important;
    }

    /* hapus garis kanan kolom terakhir */
    .custom-table td:last-child,
    .custom-table th:last-child {
        border-right: none !important;
    }

    /* garis pembatas antar baris */
    .custom-table tbody tr {
        border-bottom: 1px solid #dce6ff !important;
    }

    /* header garis bawah lebih tegas */
    .custom-table thead tr {
        border-bottom: 2px solid #c7d9ff !important;
    }

    .empty-row {
        padding: 50px;
        font-size: 16px;
        color: #647aa3;
    }
</style>

<div class="page-header">
    <h2 class="page-title">Payments & Product Management</h2>
    <div class="sub-text">PKBM Bread of Life Adventist Homeschooler Community</div>
    <div class="sub-text"><em>"Nurture Together, Grow Together"</em></div>
</div>

<div class="filter-box">
    <form method="GET" action="{{ route('products') }}" class="row g-3">

        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}"
                class="form-control" placeholder="Search product name or description...">
        </div>

        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">All categories</option>
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="number" name="min_price" value="{{ request('min_price') }}"
                class="form-control" placeholder="Min price">
        </div>

        <div class="col-md-2">
            <input type="number" name="max_price" value="{{ request('max_price') }}"
                class="form-control" placeholder="Max price">
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="">Sort by...</option>
                <option value="name" {{ request('sort')=='name'?'selected':'' }}>Name (A–Z)</option>
                <option value="price" {{ request('sort')=='price'?'selected':'' }}>Price (Low → High)</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-pastel-blue w-100">Apply</button>
        </div>
    </form>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-pastel-yellow">
        + Add New Product
    </a>

    <div class="text-muted">
        Showing <strong>{{ count($products) }}</strong> result(s)
    </div>
</div>

<div class="card shadow-sm custom-table">
    <table class="table table-hover mb-0">

        <thead>
            <tr>
                <th style="width:60px">#</th>
                <th style="width:200px">Product</th>
                <th>Description</th>
                <th style="width:150px">Category</th>
                <th style="width:150px">Price (IDR)</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $p)
                <tr>
                    <td>{{ $p['id'] }}</td>
                    <td>{{ $p['name'] }}</td>
                    <td>{{ $p['description'] }}</td>
                    <td>{{ $categories[$p['category']] ?? '' }}</td>
                    <td>{{ number_format($p['price']) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center empty-row">
                        No products found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-layout>
