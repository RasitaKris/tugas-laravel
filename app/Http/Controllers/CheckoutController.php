<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function form()
    {
        $items = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $items->sum(fn($i) => $i->quantity * $i->product->price);

        return view('checkout.form', compact('items', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required',
            'shipping_phone' => 'required',
            'shipping_address' => 'required',
            'payment_method' => 'required',
        ]);

        $items = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($items->count() == 0) {
            return back()->with('error', 'Cart is empty.');
        }

        $total = $items->sum(fn($i) => $i->quantity * $i->product->price);

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_name' => $request->shipping_name,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($items as $i) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $i->product_id,
                'quantity' => $i->quantity,
                'price' => $i->product->price,
                'subtotal' => $i->quantity * $i->product->price,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')->with('success', 'Checkout successful!');
    }
}
