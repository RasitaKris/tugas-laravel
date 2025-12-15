<x-layout pageTitle="Checkout">

    <h2 class="fw-bold mb-3">Checkout</h2>

    <p class="text-muted">Please confirm your information before placing order.</p>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" class="soft-card mt-3">
        @csrf

       
        <div class="mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <input type="text" name="shipping_name" 
                   class="form-control"
                   value="{{ auth()->user()->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Phone Number</label>
            <input type="text" name="shipping_phone" 
                   class="form-control" 
                   placeholder="085xxxxxxx" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Shipping Address</label>
            <textarea name="shipping_address" 
                      class="form-control" 
                      rows="3"
                      placeholder="Enter your full address..."
                      required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Payment Method</label>
            <select name="payment_method" class="form-select" required>
                <option value="">-- Choose Method --</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="cash">Cash</option>
            </select>
        </div>

        
        <div class="border rounded p-3 mt-4 bg-light">
            <h5 class="mb-0">Your Items</h5>

            <ul class="mt-2">
                @foreach($items as $item)
                <li>
                    {{ $item->product->name }} × {{ $item->quantity }}  
                    <span class="text-muted">
                        Rp {{ number_format($item->product->price * $item->quantity) }}
                    </span>
                </li>
                @endforeach
            </ul>

            <hr>

            <strong>Total: Rp {{ number_format($total) }}</strong>
        </div>

        <button type="submit" class="btn btn-primary-accent mt-3 w-100 py-2">
            Place Order
        </button>
    </form>

</x-layout>
