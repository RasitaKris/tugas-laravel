<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // LIST + FILTER + PAGINATION
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'name') {
                $query->orderBy('name', 'asc');
            } elseif ($request->sort == 'price_low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('price', 'desc');
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(9)->withQueryString();

        return view('products.list', [
            'products' => $products,
            'categories' => $this->getCategories()
        ]);
    }

    // FORM ADD
    public function create()
    {
        return view('products.form', [
            'categories' => $this->getCategories()
        ]);
    }

    // SIMPAN DATA 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'nullable'
        ]);

        Product::create($request->all());

        return redirect()->route('products')
            ->with('success', 'Product added successfully!');
    }

    // DETAIL
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // FORM EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', [   
            'product' => $product,
            'categories' => $this->getCategories()
        ]);
    }


    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products')
            ->with('success', 'Product updated!');
    }

    // DELETE
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }


    // CATEGORY
    private function getCategories()
    {
        return [
            'books' => 'Books',
            'exams' => 'Exams',
            'registration' => 'Registration',
            'items' => 'Items',
            'programs' => 'Programs'
        ];
    }
}
