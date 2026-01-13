<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Keranjang 
        $cart = CartItem::where('user_id', Auth::id())
            ->whereHas('product')
            ->with('product')
            ->get();

        // 2. Hitung Total Harga
        $total = $cart->sum(function ($item) {
            return $item->product ? $item->quantity * $item->product->price : 0;
        });

        // 3.Hitung Jumlah Item untuk Badge Notifikasi di Navigasi
        $cartCount = $cart->sum('quantity');

        // 4. Kirim semua variabel ke View (termasuk cartCount)
        return view('cart.index', compact('cart', 'total', 'cartCount'));
    }

    public function add($product_id)
    {
        // Mencari Produk
        $product = Product::findOrFail($product_id);

        $item = CartItem::firstOrCreate(
            [
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => 0,
            ]
        );

        $item->increment('quantity');

        return back()->with('success', __('app.cart_added'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::with('product')->findOrFail($id);

        // Security check
        abort_if($item->user_id !== Auth::id(), 403);

        // Jika product sudah tidak ada, hapus item
        if (!$item->product) {
            $item->delete();
            return back()->with('success', __('app.cart_removed'));
        }

        $item->update([
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', __('app.cart_updated'));
    }

    public function remove($id)
    {
        $item = CartItem::findOrFail($id);

        abort_if($item->user_id !== Auth::id(), 403);

        $item->delete();

        return back()->with('success', __('app.cart_removed'));
    }
}
