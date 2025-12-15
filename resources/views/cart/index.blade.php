<x-layout pageTitle="Your Cart">

    <h2 class="mb-4 fw-bold">🛒 Your Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cart->count() == 0)
        <div class="alert alert-info">Your cart is empty.</div>
    @else

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th width="70">Image</th>
                    <th>Product</th>
                    <th width="120">Price</th>
                    <th width="150">Quantity</th>
                    <th width="120">Subtotal</th>
                    <th width="80">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cart as $item)

                    @php
                        $img = match($item->product->category ?? '') {
                            'books' => 'https://images.pexels.com/photos/590493/pexels-photo-590493.jpeg',
                            'exams' => 'https://images.pexels.com/photos/4145198/pexels-photo-4145198.jpeg',
                            'registration' => 'https://images.pexels.com/photos/3184438/pexels-photo-3184438.jpeg',
                            'items' => 'https://images.pexels.com/photos/159711/book-open-pages-read-159711.jpeg',
                            'programs' => 'https://images.pexels.com/photos/1181396/pexels-photo-1181396.jpeg',
                            default => 'https://images.pexels.com/photos/4145198/pexels-photo-4145198.jpeg',
                        };

                        $subtotal = $item->quantity * $item->product->price;
                    @endphp

                    <tr>
                        <td>
                            <img src="{{ $img }}" class="img-fluid rounded" style="width:60px;">
                        </td>

                        <td>{{ $item->product->name }}</td>

                        <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>

                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-start gap-2">
                                @csrf

                                <!-- Input number dengan dropdown custom scrollable -->
                                <div class="position-relative">
                                    <input type="number" min="1" name="quantity" value="{{ $item->quantity }}"
                                           class="form-control form-control-sm qty-input" style="max-width:80px;">

                                    <ul class="qty-dropdown list-group position-absolute p-0 m-0" 
                                        style="max-height: 200px; overflow-y: auto; display:none; z-index:1000;">
                                        @for($i = 1; $i <= 100; $i++)
                                            <li class="list-group-item list-group-item-action" style="padding:0.25rem 0.5rem; cursor:pointer;">{{ $i }}</li>
                                        @endfor
                                    </ul>
                                </div>

                                <button class="btn btn-sm btn-primary flex-shrink-0">Update</button>
                            </form>
                        </td>

                        <td>
                            <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                        </td>

                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Remove this item?')">
                                    Remove
                                </button>
                            </form>
                        </td>

                    </tr>

                @endforeach
            </tbody>
        </table>

        <div class="text-end mt-3">
            <h4>Total: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></h4>
        </div>

        <div class="text-end">
            <a href="{{ route('checkout.form') }}" class="btn btn-primary-accent mt-3">
                Proceed to Checkout →
            </a>
        </div>

    @endif

    <!-- Script untuk dropdown scrollable -->
    <script>
        document.querySelectorAll('.qty-input').forEach(function(input){
            const dropdown = input.nextElementSibling;
            input.addEventListener('focus', () => { dropdown.style.display = 'block'; });
            input.addEventListener('blur', () => { setTimeout(()=>dropdown.style.display='none', 150); });
            dropdown.querySelectorAll('li').forEach(function(li){
                li.addEventListener('click', () => { input.value = li.textContent; dropdown.style.display='none'; });
            });
        });
    </script>

</x-layout>
