<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle($product_id)
    {
        $user = Auth::user();

        if ($user->wishlist()->where('product_id', $product_id)->exists()) {
            $user->wishlist()->detach($product_id);
            return back()->with('success', __('product.wishlist_removed'));
        }

        $user->wishlist()->attach($product_id);
        return back()->with('success', __('product.wishlist_added'));
    }

    public function index()
    {
        $wishlist = Auth::user()->wishlist()->paginate(9);
        return view('products.wishlist', compact('wishlist'));
    }
}
