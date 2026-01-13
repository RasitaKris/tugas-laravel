<x-layout :pageTitle="__('product.add_new')">

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="soft-card">
                <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-plus-lg fs-5"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-primary">{{ __('product.add_new') }}</h4>
                        <p class="text-muted small mb-0">Isi form berikut untuk menambahkan produk baru.</p>
                    </div>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">{{ __('product.name') }}</label>
                        <input type="text" name="name" class="form-control form-control-lg fs-6" placeholder="Contoh: Seragam Sekolah SD" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">{{ __('product.description') }}</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan detail produk..."></textarea>
                    </div>

                    <div class="row">
                        {{-- Kategori --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted">{{ __('product.category') }}</label>
                            <select name="category" class="form-select" required>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-muted">{{ __('product.price') }} (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 fw-bold text-muted">Rp</span>
                                <input type="number" name="price" class="form-control border-start-0" placeholder="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="{{ route('products') }}" class="btn btn-light rounded-pill px-4 fw-bold text-secondary">
                            {{ __('product.cancel') }}
                        </a>
                        <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                            <i class="bi bi-save me-1"></i> {{ __('product.save') }}
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

</x-layout>