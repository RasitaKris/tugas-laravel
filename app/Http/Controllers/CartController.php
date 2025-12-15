<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ===============================
    // TAMPIL KERANJANG
    // ===============================
    public function index()
    {
        $cart = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cart->sum(fn($i) => $i->quantity * $i->product->price);

        return view('cart.index', compact('cart', 'total'));
    }

    // ===============================
    // TAMBAH PRODUK KE KERANJANG
    // ===============================
    public function add(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // ===============================
    // UPDATE JUMLAH PRODUK
    // ===============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Jumlah diperbarui.');
    }

    // ===============================
    // HAPUS PRODUK DARI KERANJANG
    // ===============================
    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Item dihapus.');
    }
}
