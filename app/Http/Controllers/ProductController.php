<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private function categories()
{
    return [
        'registration' => __('product.categories.registration'),
        'exams'        => __('product.categories.exams'),
        'book'        => __('product.categories.book'),
        'items'        => __('product.categories.items'),
        'programs'     => __('product.categories.programs'),
    ];
}


    public function index(Request $request)
    {
        $query  = Product::query();
        $locale = app()->getLocale();

        // SEARCH
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($q) use ($keyword) {
                $q->where('name_id', 'like', "%{$keyword}%")
                  ->orWhere('description_id', 'like', "%{$keyword}%")
                  ->orWhere('name_en', 'like', "%{$keyword}%")
                  ->orWhere('description_en', 'like', "%{$keyword}%");
            });
        }

        // FILTER CATEGORY
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // FILTER HARGA
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // SORT
        if ($request->filled('sort')) {
            if ($request->sort === 'price_low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_high') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        return view('products.list', [
            'products'   => $query->paginate(8)->withQueryString(),
            'categories' => $this->categories(),
            'cartCount'  => CartItem::where('user_id', Auth::id())->sum('quantity'),
            'locale'     => $locale,
        ]);
    }

    // CREATE DIPINDAHKAN KE LUAR INDEX
    public function create()
{
    $categories = $this->categories();
    return view('products.form', compact('categories'));
}

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', [
            'product'   => $product,
            'cartCount' => CartItem::where('user_id', Auth::id())->sum('quantity'),
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = $this->categories();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name_id'        => $request->name,
            'description_id' => $request->description,
            'category'       => $request->category,
            'price'          => $request->price,
        ]);

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', __('product.updated_success'));
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
            ->route('products')
            ->with('success', __('product.deleted_success'));
    }

}
