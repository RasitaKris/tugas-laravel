{{-- resources/views/products/edit.blade.php --}}
<x-layout :pageTitle="__('product.edit_title')">

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card shadow-sm">
                {{-- CARD HEADER: Judul & Tombol Kembali --}}
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">{{ __('product.edit_title') }}</h5>
                    <a href="{{ route('products') }}" class="btn btn-sm btn-outline-secondary">
                        &larr; {{ __('product.cancel_button') }}
                    </a>
                </div>

                <div class="card-body p-4">
                    {{-- Info ID --}}
                    <div class="alert alert-light border mb-4 py-2 small text-muted">
                        <i class="bi bi-info-circle"></i> {{ __('product.editing_id') }} <strong>{{ $product->id }}</strong>
                    </div>

                    {{-- FORM START --}}
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        
                        {{-- NAME --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">{{ __('product.name_label') }}</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $product->name) }}"
                                   class="form-control"
                                   required>
                        </div>

                        {{-- CATEGORY --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">{{ __('product.category_label') }}</label>
                            <select name="category" class="form-select" required>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('category', $product->category) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">{{ __('product.description_label') }}</label>
                            <textarea name="description"
                                      rows="4"
                                      class="form-control">{{ old('description', $product->description) }}</textarea>
                        </div>

                        {{-- PRICE --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">{{ __('product.price_label') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number"
                                       name="price"
                                       value="{{ old('price', $product->price) }}"
                                       class="form-control"
                                       required>
                            </div>
                        </div>

                        {{-- BUTTONS --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold">
                                {{ __('product.update_button') }}
                            </button>
                        </div>

                    </form>
                   
                </div>
            </div>

        </div>
    </div>
</div>

</x-layout>