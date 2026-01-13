<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class CheckoutController extends Controller
{

    // TAMPILKAN FORM CHECKOUT
    public function form()
    {
        // BUY NOW
        if(session()->has('buy_now')){
            $item = (object) session('buy_now');

            $items = collect([$item]);
            $total = $item->price * $item->quantity;

            return view('checkout.form', compact('items', 'total'));
        }

        // CART
        $items = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $items->sum(fn($i) => $i->quantity * $i->product->price);

        return view('checkout.form', compact('items', 'total'));
    }


    
     // PROSES CHECKOUT & BUAT ORDER
    
    public function process(Request $request)
    {
        // VALIDASI
        $request->validate([
            'shipping_name'    => 'nullable|string',
            'shipping_phone'   => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'shipping_service' => 'nullable|string',
            'payment_method'   => 'required|string',
        ]);


        // TENTUKAN SUMBER DATA BUY NOW dan CART
    
        if(session()->has('buy_now')){
            
        // BUY NOW
            $bn = session('buy_now');

            $items = collect([
                (object)[
                    'product_id' => $bn['product_id'],
                    'quantity'   => $bn['quantity'],
                    'product'    => (object)['price' => $bn['price']]
                ]
            ]);

            $subtotal = $bn['price'] * $bn['quantity'];

            // hapus session setelah dipakai
            session()->forget('buy_now');
        } 
        else {
            // CART
            $items = CartItem::where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($items->isEmpty()) {
                return back()->with('error', __('app.cart_empty'));
            }

            $subtotal = $items->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        }


        // ONGKIR

        $service = 'non-shipping';
        $shippingCost = 0;

        if ($request->filled('shipping_service')) {
            [$service, $shippingCost] = explode('|', $request->shipping_service);
            $shippingCost = (int) $shippingCost;
        }

        $total = $subtotal + $shippingCost;


        
        // BUAT ORDER
        $order = Order::create([
            'user_id'          => Auth::id(),
            'shipping_name'    => $request->shipping_name,
            'shipping_phone'   => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_service' => $service,
            'shipping_cost'    => $shippingCost,
            'payment_method'   => $request->payment_method,
            'payment_channel'  => $request->payment_method === 'bank_transfer'
                ? 'BCA / BRI / Mandiri'
                : 'DANA / OVO / GoPay',
            'total'            => $total,
            'status'           => 'pending',
        ]);


        // SIMPAN ORDER ITEM

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
                'subtotal'   => $item->quantity * $item->product->price,
            ]);
        }

         // KOSONGKAN CART 

        CartItem::where('user_id', Auth::id())->delete();

        // KIRIM EMAIL
    
        Mail::to(Auth::user()->email)
            ->send(new OrderPlacedMail($order));


       // SELESAI
     
        return redirect()
            ->route('orders.index')
            ->with('success', __('app.order_success'));
    }

        // BUY NOW BUTTON
 
    public function buyNow($product_id)
    {
        $product = \App\Models\Product::findOrFail($product_id);

        session([
            'buy_now' => [
                'product_id' => $product->id,
                'name'       => $product->name_id ?? $product->name,
                'price'      => $product->price,
                'quantity'   => 1,
            ]
        ]);

        return redirect()->route('checkout.form');
    }
}
